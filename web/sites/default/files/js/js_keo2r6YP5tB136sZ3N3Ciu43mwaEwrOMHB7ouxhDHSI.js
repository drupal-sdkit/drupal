/**
 * @file
 * Defines the behaviors needed for cropper integration.
 */

(function ($, Drupal, debounce) {
  'use strict';

  var $window = $(window);

  /**
   * @class Drupal.ImageWidgetCrop
   *
   * @param {HTMLElement|jQuery} element
   *   The wrapper element.
   */
  Drupal.ImageWidgetCrop = function (element) {

    /**
     * The wrapper element.
     *
     * @type {jQuery}
     */
    this.$wrapper = $(element);

    /**
     * The summary element.
     *
     * @type {jQuery}
     */
    this.$summary = this.$wrapper.find(this.selectors.summary).first();

    /**
     * Flag indicating whether the instance has been initialized.
     *
     * @type {Boolean}
     */
    this.initialized = false;

    /**
     * The current summary text.
     *
     * @type {String}
     */
    this.summary = Drupal.t('Crop image');

    /**
     * The individual ImageWidgetCropType instances.
     *
     * @type {Array.<Drupal.ImageWidgetCropType>}
     */
    this.types = [];

    // Initialize the instance.
    this.init();
  };

  /**
   * The selectors used to identify elements for this module.
   *
   * @type {Object.<String, String>}
   */
  Drupal.ImageWidgetCrop.prototype.selectors = {
    // Unfortunately, core does not provide a way to inject attributes into the
    // wrapper element's "summary" in a stable way. So, we can only target
    // the immediate children known to be the likely elements. Contrib can
    // extend this selector if needed.
    summary: '> summary, > legend',
    types: '[data-drupal-iwc=type]',
    wrapper: '[data-drupal-iwc=wrapper]'
  };

  /**
   * Destroys this instance.
   */
  Drupal.ImageWidgetCrop.prototype.destroy = function () {
    this.types.forEach(function (type) {
      type.destroy();
    });
  };

  /**
   * Initializes the instance.
   */
  Drupal.ImageWidgetCrop.prototype.init = function () {
    if (this.initialized) {
      return;
    }

    // Find all the types.
    var _this = this;
    this.$wrapper.find(this.selectors.types).each(function () {
      _this.types.push(new Drupal.ImageWidgetCropType(_this, this));
    });

    // Debounce resize event to prevent any issues.
    $window.on('resize.iwc', debounce(this.resize.bind(this), 250));

    // Update the summary when triggered from vertical tabs underneath it.
    this.$wrapper.on('summaryUpdated', this.updateSummary.bind(this));

    // Trigger the initial summaryUpdate event.
    this.$wrapper.trigger('summaryUpdated');

    // Disable triggering the "Reset crop" button when ENTER is pressed in the
    // form.
    this.$wrapper.closest('form').find('input').on('keypress', function(e) {
      return e.which !== 13;
    });
  };

  /**
   * The "resize" event callback.
   *
   * @see Drupal.ImageWidgetCropType.prototype.resize
   */
  Drupal.ImageWidgetCrop.prototype.resize = function () {
    var args = arguments;

    // Proxy the resize event to each ImageWidgetCropType instance.
    this.types.forEach(function (type) {
      type.resize.apply(type, args);
    });
  };

  /**
   * Updates the summary of the wrapper.
   */
  Drupal.ImageWidgetCrop.prototype.updateSummary = function () {
    var text = Drupal.t('Crop image');

    // Determine if any ImageWidgetCropType has been applied.
    for (var i = 0, l = this.types.length; i < l; i++) {
      var type = this.types[i];
      if (type.getValue('applied')) {
        text = Drupal.t('Crop image (cropping applied)');
        break;
      }
    }

    if (this.summary !== text) {
      this.$summary.text(this.summary = text);
    }
  };

}(jQuery, Drupal, Drupal.debounce));
;
/**
 * @file
 * Defines the behaviors needed for cropper integration.
 */

(function ($, Drupal) {
  'use strict';

  /**
   * @class Drupal.ImageWidgetCropType
   *
   * @param {Drupal.ImageWidgetCrop} instance
   *   The main ImageWidgetCrop instance that created this one.
   *
   * @param {HTMLElement|jQuery} element
   *   The wrapper element.
   */
  Drupal.ImageWidgetCropType = function (instance, element) {

    /**
     * The ImageWidgetCrop instance responsible for creating this type.
     *
     * @type {Drupal.ImageWidgetCrop}
     */
    this.instance = instance;

    /**
     * The Cropper plugin wrapper element.
     *
     * @type {jQuery}
     */
    this.$cropperWrapper = $();

    /**
     * The wrapper element.
     *
     * @type {jQuery}
     */
    this.$wrapper = $(element);

    /**
     * The table element, if any.
     *
     * @type {jQuery}
     */
    this.$table = this.$wrapper.find(this.selectors.table);

    /**
     * The image element.
     *
     * @type {jQuery}
     */
    this.$image = this.$wrapper.find(this.selectors.image);

    /**
     * The reset element.
     *
     * @type {jQuery}
     */
    this.$reset = this.$wrapper.find(this.selectors.reset);

    /**
     * @type {Cropper}
     */
    this.cropper = null;

    /**
     * Flag indicating whether this instance is enabled.
     *
     * @type {Boolean}
     */
    this.enabled = true;

    /**
     * The hard limit of the crop.
     *
     * @type {{height: Number, width: Number, reached: {height: Boolean, width: Boolean}}}
     */
    this.hardLimit = {
      height: null,
      width: null,
      reached: {
        height: false,
        width: false
      }
    };

    /**
     * The unique identifier for this ImageWidgetCrop type.
     *
     * @type {String}
     */
    this.id = null;

    /**
     * Flag indicating whether the instance has been initialized.
     *
     * @type {Boolean}
     */
    this.initialized = false;

    /**
     * An object of recorded setInterval instances.
     *
     * @type {Object.<Number, jQuery>}
     */
    this.intervals = {};

    /**
     * The delta ratio of image based on its natural dimensions.
     *
     * @type {Number}
     */
    this.naturalDelta = null;

    /**
     * The natural height of the image.
     *
     * @type {Number}
     */
    this.naturalHeight = null;

    /**
     * The natural width of the image.
     *
     * @type {Number}
     */
    this.naturalWidth = null;

    /**
     * The original height of the image.
     *
     * @type {Number}
     */
    this.originalHeight = 0;

    /**
     * The original width of the image.
     *
     * @type {Number}
     */
    this.originalWidth = 0;

    /**
     * The current Cropper options.
     *
     * @type {Cropper.options}
     */
    this.options = {};

    /**
     * Flag indicating whether to show the default crop.
     *
     * @type {Boolean}
     */
    this.showDefaultCrop = true;

    /**
     * Flag indicating whether to show the default crop.
     *
     * @type {Boolean}
     */
    this.isRequired = false;

    /**
     * The soft limit of the crop.
     *
     * @type {{height: Number, width: Number, reached: {height: Boolean, width: Boolean}}}
     */
    this.softLimit = {
      height: null,
      width: null,
      reached: {
        height: false,
        width: false
      }
    };

    /**
     * The numeric representation of a ratio.
     *
     * @type {Number}
     */
    this.ratio = NaN;

    /**
     * The value elements.
     *
     * @type {Object.<String, jQuery>}
     */
    this.values = {
      applied: this.$wrapper.find(this.selectors.values.applied),
      height: this.$wrapper.find(this.selectors.values.height),
      width: this.$wrapper.find(this.selectors.values.width),
      x: this.$wrapper.find(this.selectors.values.x),
      y: this.$wrapper.find(this.selectors.values.y)
    };

    /**
     * Flag indicating whether the instance is currently visible.
     *
     * @type {Boolean}
     */
    this.visible = false;

    // Initialize the instance.
    this.init();
  };

  /**
   * The prefix used for all Image Widget Crop data attributes.
   *
   * @type {RegExp}
   */
  Drupal.ImageWidgetCropType.prototype.dataPrefix = /^drupalIwc/;

  /**
   * Default options to pass to the Cropper plugin.
   *
   * @type {Object}
   */
  Drupal.ImageWidgetCropType.prototype.defaultOptions = {
    autoCropArea: 1,
    background: false,
    responsive: false,
    viewMode: 1,
    zoomable: false
  };

  /**
   * The selectors used to identify elements for this module.
   *
   * @type {Object}
   */
  Drupal.ImageWidgetCropType.prototype.selectors = {
    image: '[data-drupal-iwc=image]',
    reset: '[data-drupal-iwc=reset]',
    table: '[data-drupal-iwc=table]',
    values: {
      applied: '[data-drupal-iwc-value=applied]',
      height: '[data-drupal-iwc-value=height]',
      width: '[data-drupal-iwc-value=width]',
      x: '[data-drupal-iwc-value=x]',
      y: '[data-drupal-iwc-value=y]'
    }
  };

  /**
   * The "ready" event handler for the Cropper plugin.
   */
  Drupal.ImageWidgetCropType.prototype.cropperReady = function () {
    // Set crop limits.
    this.built();

    // Restore saved crop box data.
    if (this.getValue('applied')) {
      // Convert data.
      var canvasData = this.cropper.getCanvasData();
      var cropBoxData = this.getValues(this.originalHeight / canvasData.height);
      cropBoxData.left = cropBoxData.x + canvasData.left;
      cropBoxData.top = cropBoxData.y + canvasData.top;

      // TEMP Bind height and width to max to avoid cropper.js bug.
      var containerData = this.cropper.getContainerData();
      var limited = this.options.viewMode === 1 || this.options.viewMode === 2;
      var maxCropBoxWidth = Math.min(containerData.width, limited ? canvasData.width : containerData.width);
      var maxCropBoxHeight = Math.min(containerData.height, limited ? canvasData.height : containerData.height);
      if (this.ratio) {
        if (maxCropBoxHeight * this.ratio > maxCropBoxWidth) {
          maxCropBoxHeight = maxCropBoxWidth / this.ratio;
        } else {
          maxCropBoxWidth = maxCropBoxHeight * this.ratio;
        }
      }
      cropBoxData.width = Math.min(cropBoxData.width, maxCropBoxWidth);
      cropBoxData.height = Math.min(cropBoxData.height, maxCropBoxHeight);

      // Restore data.
      this.cropper.setCropBoxData(cropBoxData);
    }
  }

  /**
   * The "built" event handler for the Cropper plugin.
   */
  Drupal.ImageWidgetCropType.prototype.built = function () {
    this.$cropperWrapper = this.$wrapper.find('.cropper-container');
    this.updateHardLimits();
    this.updateSoftLimits();
  };

  /**
   * The "cropend" event handler for the Cropper plugin.
   */
  Drupal.ImageWidgetCropType.prototype.cropEnd = function () {
    // Immediately return if there is no cropper instance (for whatever reason).
    if (!this.cropper) {
      return;
    }

    // Retrieve the cropper data.
    var data = this.cropper.getData();

    // Ensure the applied state is enabled.
    data.applied = 1;

    // Data returned by Cropper plugin should be multiplied with delta in order
    // to get the proper crop sizes for the original image.
    this.setValues(data, this.naturalDelta);

    // Trigger summary updates.
    this.$wrapper.trigger('summaryUpdated');
  };

  /**
   * The "cropmove" event handler for the Cropper plugin.
   */
  Drupal.ImageWidgetCropType.prototype.cropMove = function () {
    this.built();
  };

  /**
   * Destroys this instance.
   */
  Drupal.ImageWidgetCropType.prototype.destroy = function () {
    this.destroyCropper();

    this.$image.off('.iwc');
    this.$reset.off('.iwc');

    // Clear any intervals that were set.
    for (var interval in this.intervals) {
      if (this.intervals.hasOwnProperty(interval)) {
        clearInterval(interval);
        delete this.intervals[interval];
      }
    }
  };

  /**
   * Destroys the Cropper plugin instance.
   */
  Drupal.ImageWidgetCropType.prototype.destroyCropper = function () {
    this.$image.off('.iwc.cropper');
    if (this.cropper) {
      this.cropper.destroy();
      this.cropper = null;
    }
  };

  /**
   * Disables this instance.
   */
  Drupal.ImageWidgetCropType.prototype.disable = function () {
    if (this.cropper) {
      this.cropper.disable();
    }
    this.$table.removeClass('responsive-enabled--opened');
  };

  /**
   * Enables this instance.
   */
  Drupal.ImageWidgetCropType.prototype.enable = function () {
    if (this.cropper) {
      this.cropper.enable();
    }
    this.$table.addClass('responsive-enabled--opened');
  };

  /**
   * Retrieves a crop value.
   *
   * @param {'applied'|'height'|'width'|'x'|'y'} name
   *   The name of the crop value to retrieve.
   * @param {Number} [delta]
   *   The delta amount to divide value by, if any.
   *
   * @return {Number}
   *   The crop value.
   */
  Drupal.ImageWidgetCropType.prototype.getValue = function (name, delta) {
    var value = 0;
    if (this.values[name] && this.values[name][0]) {
      value = parseInt(this.values[name][0].value, 10) || 0;
    }
    return name !== 'applied' && value && delta ? Math.floor(value / delta) : value;
  };

  /**
   * Retrieves all crop values.
   *
   * @param {Number} [delta]
   *   The delta amount to divide value by, if any.
   *
   * @return {{applied: Number, height: Number, width: Number, x: Number, y: Number}}
   *   The crop value key/value pairs.
   */
  Drupal.ImageWidgetCropType.prototype.getValues = function (delta) {
    var values = {};
    for (var name in this.values) {
      if (this.values.hasOwnProperty(name)) {
        values[name] = this.getValue(name, delta);
      }
    }
    return values;
  };

  /**
   * Initializes the instance.
   */
  Drupal.ImageWidgetCropType.prototype.init = function () {
    // Immediately return if already initialized.
    if (this.initialized) {
      return;
    }

    // Set the default options.
    this.options = $.extend({}, this.defaultOptions);
    this.isRequired = this.$wrapper.data('drupalIwcRequired');

    // Extend this instance with data from the wrapper.
    var data = this.$wrapper.data();
    for (var i in data) {
      if (data.hasOwnProperty(i) && this.dataPrefix.test(i)) {
        // Remove Drupal + module prefix and lowercase the first letter.
        var prop = i.replace(this.dataPrefix, '');
        prop = prop.charAt(0).toLowerCase() + prop.slice(1);

        // Check if data attribute exists on this object.
        if (prop && this.hasOwnProperty(prop)) {
          var value = data[i];

          // Parse the ratio value.
          if (prop === 'ratio') {
            value = this.parseRatio(value);
          }
          this[prop] = typeof value === 'object' ? $.extend(true, {}, this[prop], value) : value;
        }
      }
    }

    // Bind necessary events.
    this.$image
      .on('visible.iwc', function () {
        this.visible = true;
        this.naturalHeight = parseInt(this.$image.prop('naturalHeight'), 10);
        this.naturalWidth = parseInt(this.$image.prop('naturalWidth'), 10);
        // Calculate delta between original and thumbnail images.
        this.naturalDelta = this.originalHeight && this.naturalHeight ? this.originalHeight / this.naturalHeight : null;
      }.bind(this))
      // Only initialize the cropper plugin once.
      .one('visible.iwc', this.initializeCropper.bind(this))
      .on('hidden.iwc', function () {
        this.visible = false;
      }.bind(this));

    this.$reset
      .on('click.iwc', this.reset.bind(this));

    // Star polling visibility of the image that should be able to be cropped.
    this.pollVisibility(this.$image);

    // Bind the drupalSetSummary callback.
    this.$wrapper.drupalSetSummary(this.updateSummary.bind(this));

    // Trigger the initial summaryUpdate event.
    this.$wrapper.trigger('summaryUpdated');
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    if (isIE) {
      var $image = this.$image;
      $('.image-data__crop-wrapper > summary').on('click', function () {
        setTimeout(function () {$image.trigger('visible.iwc')}, 100);
      });
    }
  };

  /**
   * Initializes the Cropper plugin.
   */
  Drupal.ImageWidgetCropType.prototype.initializeCropper = function () {
    // Calculate minimal height for cropper container (minimal width is 200).
    var minDelta = (this.originalWidth / 200);
    this.options.minContainerHeight = this.originalHeight / minDelta;

    // Only autoCrop if 'Show default crop' is checked or if there is a crop already set.
    this.options.autoCrop = this.showDefaultCrop || !!this.getValue('applied');

    // Set aspect ratio.
    this.options.aspectRatio = this.ratio;

    this.$image
      .on('ready.iwc.cropper', this.cropperReady.bind(this))
      .on('cropend.iwc.cropper', this.cropEnd.bind(this))
      .on('cropmove.iwc.cropper', this.cropMove.bind(this))
      .cropper(this.options);

    this.cropper = this.$image.data('cropper');
    this.options = this.cropper.options;

    // If "Show default crop" is checked apply default crop.
    if (this.showDefaultCrop) {
      // All data returned by cropper plugin multiple with delta in order to get
      // proper crop sizes for original image.
      this.setValue(this.$image.cropper('getData'), this.naturalDelta);
      this.$wrapper.trigger('summaryUpdated');
    }
  };

  /**
   * Creates a poll that checks visibility of an item.
   *
   * @param {HTMLElement|jQuery} element
   *   The element to poll.
   *
   * Replace once vertical tabs have proper events ?
   * When following issue are fixed @see https://www.drupal.org/node/2653570.
   */
  Drupal.ImageWidgetCropType.prototype.pollVisibility = function (element) {
    var $element = $(element);

    // Immediately return if there's no element.
    if (!$element[0]) {
      return;
    }

    var isElementVisible = function (el) {
      var rect = el.getBoundingClientRect();
      var vWidth = window.innerWidth || document.documentElement.clientWidth;
      var vHeight = window.innerHeight || document.documentElement.clientHeight;

      // Immediately Return false if it's not in the viewport.
      if (rect.right < 0 || rect.bottom < 0 || rect.left > vWidth || rect.top > vHeight) {
        return false;
      }

      // Return true if any of its four corners are visible.
      var efp = function (x, y) {
        return document.elementFromPoint(x, y);
      };
      return (
        el.contains(efp(rect.left, rect.top))
        || el.contains(efp(rect.right, rect.top))
        || el.contains(efp(rect.right, rect.bottom))
        || el.contains(efp(rect.left, rect.bottom))
      );
    };

    var value = null;
    var interval = setInterval(function () {
      var visible = isElementVisible($element[0]);
      if (value !== visible) {
        $element.trigger((value = visible) ? 'visible.iwc' : 'hidden.iwc');
      }
    }, 250);
    this.intervals[interval] = $element;
  };

  /**
   * Parses a ration value into a numeric one.
   *
   * @param {String} ratio
   *   A string representation of the ratio.
   *
   * @return {Number.<float>|NaN}
   *   The numeric representation of the ratio.
   */
  Drupal.ImageWidgetCropType.prototype.parseRatio = function (ratio) {
    if (ratio && /:/.test(ratio)) {
      var parts = ratio.split(':');
      var num1 = parseInt(parts[0], 10);
      var num2 = parseInt(parts[1], 10);
      return num1 / num2;
    }
    return parseFloat(ratio);
  };

  /**
   * Reset cropping for an element.
   *
   * @param {Event} e
   *   The event object.
   */
  Drupal.ImageWidgetCropType.prototype.reset = function (e) {
    if (!this.cropper) {
      return;
    }

    if (e instanceof Event || e instanceof $.Event) {
      e.preventDefault();
      e.stopPropagation();
    }

    this.options = $.extend({}, this.cropper.options, this.defaultOptions);

    var delta = null;

    // Retrieve all current values and zero (0) them out.
    var values = this.getValues();
    for (var name in values) {
      if (values.hasOwnProperty(name)) {
        values[name] = 0;
      }
    }

    // If 'Show default crop' is not checked just re-initialize the cropper.
    if (!this.showDefaultCrop) {
      this.destroyCropper();
      this.initializeCropper();
    }
    // Reset cropper to the original values.
    else {
      this.cropper.reset();
      this.cropper.options = this.options;

      // Set the delta.
      delta = this.naturalDelta;

      // Merge in the original cropper values.
      values = $.extend(values, this.cropper.getData());
    }

    this.setValues(values, delta);
    this.$wrapper.trigger('summaryUpdated');
  };

  /**
   * The "resize" event handler proxied from the main instance.
   *
   * @see Drupal.ImageWidgetCrop.prototype.resize
   */
  Drupal.ImageWidgetCropType.prototype.resize = function () {
    // Immediately return if currently not visible.
    if (!this.visible) {
      return;
    }

    // Get previous data for cropper.
    var canvasDataOld = this.$image.cropper('getCanvasData');
    var cropBoxData = this.$image.cropper('getCropBoxData');

    // Re-render cropper.
    this.$image.cropper('render');

    // Get new data for cropper and calculate resize ratio.
    var canvasDataNew = this.$image.cropper('getCanvasData');
    var ratio = 1;
    if (canvasDataOld.width !== 0) {
      ratio = canvasDataNew.width / canvasDataOld.width;
    }

    // Set new data for crop box.
    $.each(cropBoxData, function (index, value) {
      cropBoxData[index] = value * ratio;
    });
    this.$image.cropper('setCropBoxData', cropBoxData);

    this.updateHardLimits();
    this.updateSoftLimits();
    this.$wrapper.trigger('summaryUpdated');
  };

  /**
   * Sets a single crop value.
   *
   * @param {'applied'|'height'|'width'|'x'|'y'} name
   *   The name of the crop value to set.
   * @param {Number} value
   *   The value to set.
   * @param {Number} [delta]
   *   A delta to modify the value with.
   */
  Drupal.ImageWidgetCropType.prototype.setValue = function (name, value, delta) {
    if (!this.values.hasOwnProperty(name) || !this.values[name][0]) {
      return;
    }
    value = value ? parseFloat(value) : 0;
    if (delta && name !== 'applied') {
      value = Math.floor(value * delta);

      // Bind height and width to image size when below hard limit. Solves floating-point bug.
      if (value < this.hardLimit[name]) {
        value = name === 'width' ? this.originalWidth : name === 'height' ? this.originalHeight : null;
      }
    }

    value = this.sanitizeSizes(name, value);

    this.values[name][0].value = value;
    this.values[name].trigger('change.iwc, input.iwc');
  };

    /**
     * Validate and sanitize with or height sizes to avoid overflow.
     *
     * @param {'applied'|'height'|'width'|'x'|'y'} name
     *   The name of the crop value to set.
     * @param {Number} value
     *   The value to set.
     */
    Drupal.ImageWidgetCropType.prototype.sanitizeSizes = function (name, value) {
        if (name === "width" || name === "height") {
            return this.recalculateOverflowSizes(name, value);
        }

        return value;
    };

    /**
     * Recalculate with or height sizes to avoid overflow for width or height.
     *
     * @param {'height'|'width'} name
     *   The name of the crop value to set.
     * @param {Number} value
     *   The value to set.
     */
    Drupal.ImageWidgetCropType.prototype.recalculateOverflowSizes = function (name, value) {
        var originalValue = 'original' + name.capitalize();
        if (value > this[originalValue]) {
            value--;
            return value;
        }

        return value;
    };

    String.prototype.capitalize = function() {
      return this.charAt(0).toUpperCase() + this.slice(1);
    };

  /**
   * Sets multiple crop values.
   *
   * @param {{applied: Number, height: Number, width: Number, x: Number, y: Number}} obj
   *   An object of key/value pairs of values to set.
   * @param {Number} [delta]
   *   A delta to modify the value with.
   */
  Drupal.ImageWidgetCropType.prototype.setValues = function (obj, delta) {
    for (var name in obj) {
      if (!obj.hasOwnProperty(name)) {
        continue;
      }
      this.setValue(name, obj[name], delta);
    }
  };

  /**
   * Converts horizontal and vertical dimensions to canvas dimensions.
   *
   * @param {Number} x - horizontal dimension in image space.
   * @param {Number} y - vertical dimension in image space.
   */
  Drupal.ImageWidgetCropType.prototype.toCanvasDimensions = function (x, y) {
    var imageData = this.cropper.getImageData();
    return {
      width: imageData.width * (x / this.originalWidth),
      height: imageData.height * (y / this.originalHeight)
    }
  };

  /**
   * Converts horizontal and vertical dimensions to image dimensions.
   *
   * @param {Number} x - horizontal dimension in canvas space.
   * @param {Number} y - vertical dimension in canvas space.
   */
  Drupal.ImageWidgetCropType.prototype.toImageDimensions = function (x, y) {
    var imageData = this.cropper.getImageData();
    return {
      width: x * (this.originalWidth / imageData.width),
      height: y * (this.originalHeight / imageData.height)
    }
  };

  /**
   * Update hard limits.
   */
  Drupal.ImageWidgetCropType.prototype.updateHardLimits = function () {
    // Immediately return if there is no cropper plugin instance or hard limits.
    if (!this.cropper || !this.hardLimit.width || !this.hardLimit.height) {
      return;
    }

    var options = this.cropper.options;

    // Limits works in canvas so we need to convert dimensions.
    var converted = this.toCanvasDimensions(this.hardLimit.width, this.hardLimit.height);
    options.minCropBoxWidth = converted.width;
    options.minCropBoxHeight = converted.height;

    // After updating the options we need to limit crop box.
    this.cropper.limitCropBox(true, false);
  };

  /**
   * Update soft limits.
   */
  Drupal.ImageWidgetCropType.prototype.updateSoftLimits = function () {
    // Immediately return if there is no cropper plugin instance or soft limits.
    if (!this.cropper || !this.softLimit.width || !this.softLimit.height) {
      return;
    }

    // We do comparison in image dimensions so lets convert first.
    var cropBoxData = this.cropper.getCropBoxData();
    var converted = this.toImageDimensions(cropBoxData.width, cropBoxData.height);

    var dimensions = ['width', 'height'];
    for (var i = 0, l = dimensions.length; i < l; i++) {
      var dimension = dimensions[i];
      if (converted[dimension] < this.softLimit[dimension]) {
        if (!this.softLimit.reached[dimension]) {
          this.softLimit.reached[dimension] = true;
        }
      }
      else if (this.softLimit.reached[dimension]) {
        this.softLimit.reached[dimension] = false;
      }
      this.$cropperWrapper.toggleClass('cropper--' + dimension + '-soft-limit-reached', this.softLimit.reached[dimension]);
    }
    this.$wrapper.trigger('summaryUpdated');
  };

  /**
   * Updates the summary of the wrapper.
   */
  Drupal.ImageWidgetCropType.prototype.updateSummary = function () {
    var summary = [];
    if (this.getValue('applied')) {
      summary.push(Drupal.t('Cropping applied.'));
    }
    if (this.softLimit.reached.height || this.softLimit.reached.width) {
      summary.push(Drupal.t('Soft limit reached.'));
    }
    return summary.join('<br>');
  };

}(jQuery, Drupal));
;
/**
 * @file
 * Defines the Drupal behaviors needed for the Image Widget Crop module.
 */

(function ($, Drupal) {
  'use strict';

  /**
   * Drupal behavior for the Image Widget Crop module.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the behavior and creates Cropper instances.
   * @prop {Drupal~behaviorAttach} detach
   *   Detaches the behavior and destroys Cropper instances.
   */
  Drupal.behaviors.imageWidgetCrop = {
    attach: function (context) {
      this.createInstances(context);
    },
    detach: function (context, settings, trigger) {
      if (trigger === "unload") {
        this.destroyInstances(context);
      }
    },

    /**
     * Creates necessary instances of Drupal.ImageWidgetCrop.
     *
     * @param {HTMLElement|jQuery} [context=document]
     *   The context which to find elements in.
     */
    createInstances: function (context) {
      var $context = $(context || document);
      $context.find(Drupal.ImageWidgetCrop.prototype.selectors.wrapper).each(function () {
        var $element = $(this);
        if (!$element.data('ImageWidgetCrop')) {
          $element.data('ImageWidgetCrop', new Drupal.ImageWidgetCrop($element));
        }
      });
    },

    /**
     * Destroys any instances of Drupal.ImageWidgetCrop.
     *
     * @param {HTMLElement|jQuery} [context=document]
     *   The context which to find elements in.
     */
    destroyInstances: function (context) {
      var $context = $(context || document);
      $context.find(Drupal.ImageWidgetCrop.prototype.selectors.wrapper).each(function () {
        var $element = $(this);
        var instance = $element.data('ImageWidgetCrop');
        if (instance) {
          instance.destroy();
          $element.removeData('ImageWidgetCrop');
        }
      });
    }
  };

}(jQuery, Drupal));
;
/*!
 * jQuery Form Plugin
 * version: 4.3.0
 * Requires jQuery v1.7.2 or later
 * Project repository: https://github.com/jquery-form/form

 * Copyright 2017 Kevin Morris
 * Copyright 2006 M. Alsup

 * Dual licensed under the LGPL-2.1+ or MIT licenses
 * https://github.com/jquery-form/form#license

 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 */
!function(r){"function"==typeof define&&define.amd?define(["jquery"],r):"object"==typeof module&&module.exports?module.exports=function(e,t){return void 0===t&&(t="undefined"!=typeof window?require("jquery"):require("jquery")(e)),r(t),t}:r(jQuery)}(function(q){"use strict";var m=/\r?\n/g,S={};S.fileapi=void 0!==q('<input type="file">').get(0).files,S.formdata=void 0!==window.FormData;var _=!!q.fn.prop;function o(e){var t=e.data;e.isDefaultPrevented()||(e.preventDefault(),q(e.target).closest("form").ajaxSubmit(t))}function i(e){var t=e.target,r=q(t);if(!r.is("[type=submit],[type=image]")){var a=r.closest("[type=submit]");if(0===a.length)return;t=a[0]}var n,o=t.form;"image"===(o.clk=t).type&&(void 0!==e.offsetX?(o.clk_x=e.offsetX,o.clk_y=e.offsetY):"function"==typeof q.fn.offset?(n=r.offset(),o.clk_x=e.pageX-n.left,o.clk_y=e.pageY-n.top):(o.clk_x=e.pageX-t.offsetLeft,o.clk_y=e.pageY-t.offsetTop)),setTimeout(function(){o.clk=o.clk_x=o.clk_y=null},100)}function N(){var e;q.fn.ajaxSubmit.debug&&(e="[jquery.form] "+Array.prototype.join.call(arguments,""),window.console&&window.console.log?window.console.log(e):window.opera&&window.opera.postError&&window.opera.postError(e))}q.fn.attr2=function(){if(!_)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);return e&&e.jquery||"string"==typeof e?e:this.attr.apply(this,arguments)},q.fn.ajaxSubmit=function(M,e,t,r){if(!this.length)return N("ajaxSubmit: skipping submit process - no element selected"),this;var O,a,n,o,X=this;"function"==typeof M?M={success:M}:"string"==typeof M||!1===M&&0<arguments.length?(M={url:M,data:e,dataType:t},"function"==typeof r&&(M.success=r)):void 0===M&&(M={}),O=M.method||M.type||this.attr2("method"),n=(n=(n="string"==typeof(a=M.url||this.attr2("action"))?q.trim(a):"")||window.location.href||"")&&(n.match(/^([^#]+)/)||[])[1],o=/(MSIE|Trident)/.test(navigator.userAgent||"")&&/^https/i.test(window.location.href||"")?"javascript:false":"about:blank",M=q.extend(!0,{url:n,success:q.ajaxSettings.success,type:O||q.ajaxSettings.type,iframeSrc:o},M);var i={};if(this.trigger("form-pre-serialize",[this,M,i]),i.veto)return N("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(M.beforeSerialize&&!1===M.beforeSerialize(this,M))return N("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var s=M.traditional;void 0===s&&(s=q.ajaxSettings.traditional);var u,c,C=[],l=this.formToArray(M.semantic,C,M.filtering);if(M.data&&(c=q.isFunction(M.data)?M.data(l):M.data,M.extraData=c,u=q.param(c,s)),M.beforeSubmit&&!1===M.beforeSubmit(l,this,M))return N("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[l,this,M,i]),i.veto)return N("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var f=q.param(l,s);u&&(f=f?f+"&"+u:u),"GET"===M.type.toUpperCase()?(M.url+=(0<=M.url.indexOf("?")?"&":"?")+f,M.data=null):M.data=f;var d,m,p,h=[];M.resetForm&&h.push(function(){X.resetForm()}),M.clearForm&&h.push(function(){X.clearForm(M.includeHidden)}),!M.dataType&&M.target?(d=M.success||function(){},h.push(function(e,t,r){var a=arguments,n=M.replaceTarget?"replaceWith":"html";q(M.target)[n](e).each(function(){d.apply(this,a)})})):M.success&&(q.isArray(M.success)?q.merge(h,M.success):h.push(M.success)),M.success=function(e,t,r){for(var a=M.context||this,n=0,o=h.length;n<o;n++)h[n].apply(a,[e,t,r||X,X])},M.error&&(m=M.error,M.error=function(e,t,r){var a=M.context||this;m.apply(a,[e,t,r,X])}),M.complete&&(p=M.complete,M.complete=function(e,t){var r=M.context||this;p.apply(r,[e,t,X])});var v=0<q("input[type=file]:enabled",this).filter(function(){return""!==q(this).val()}).length,g="multipart/form-data",x=X.attr("enctype")===g||X.attr("encoding")===g,y=S.fileapi&&S.formdata;N("fileAPI :"+y);var b,T=(v||x)&&!y;!1!==M.iframe&&(M.iframe||T)?M.closeKeepAlive?q.get(M.closeKeepAlive,function(){b=w(l)}):b=w(l):b=(v||x)&&y?function(e){for(var r=new FormData,t=0;t<e.length;t++)r.append(e[t].name,e[t].value);if(M.extraData){var a=function(e){var t,r,a=q.param(e,M.traditional).split("&"),n=a.length,o=[];for(t=0;t<n;t++)a[t]=a[t].replace(/\+/g," "),r=a[t].split("="),o.push([decodeURIComponent(r[0]),decodeURIComponent(r[1])]);return o}(M.extraData);for(t=0;t<a.length;t++)a[t]&&r.append(a[t][0],a[t][1])}M.data=null;var n=q.extend(!0,{},q.ajaxSettings,M,{contentType:!1,processData:!1,cache:!1,type:O||"POST"});M.uploadProgress&&(n.xhr=function(){var e=q.ajaxSettings.xhr();return e.upload&&e.upload.addEventListener("progress",function(e){var t=0,r=e.loaded||e.position,a=e.total;e.lengthComputable&&(t=Math.ceil(r/a*100)),M.uploadProgress(e,r,a,t)},!1),e});n.data=null;var o=n.beforeSend;return n.beforeSend=function(e,t){M.formData?t.data=M.formData:t.data=r,o&&o.call(this,e,t)},q.ajax(n)}(l):q.ajax(M),X.removeData("jqxhr").data("jqxhr",b);for(var j=0;j<C.length;j++)C[j]=null;return this.trigger("form-submit-notify",[this,M]),this;function w(e){var t,r,l,f,o,d,m,p,a,n,h,v,i=X[0],g=q.Deferred();if(g.abort=function(e){p.abort(e)},e)for(r=0;r<C.length;r++)t=q(C[r]),_?t.prop("disabled",!1):t.removeAttr("disabled");(l=q.extend(!0,{},q.ajaxSettings,M)).context=l.context||l,o="jqFormIO"+(new Date).getTime();var s=i.ownerDocument,u=X.closest("body");if(l.iframeTarget?(n=(d=q(l.iframeTarget,s)).attr2("name"))?o=n:d.attr2("name",o):(d=q('<iframe name="'+o+'" src="'+l.iframeSrc+'" />',s)).css({position:"absolute",top:"-1000px",left:"-1000px"}),m=d[0],p={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(e){var t="timeout"===e?"timeout":"aborted";N("aborting upload... "+t),this.aborted=1;try{m.contentWindow.document.execCommand&&m.contentWindow.document.execCommand("Stop")}catch(e){}d.attr("src",l.iframeSrc),p.error=t,l.error&&l.error.call(l.context,p,t,e),f&&q.event.trigger("ajaxError",[p,l,t]),l.complete&&l.complete.call(l.context,p,t)}},(f=l.global)&&0==q.active++&&q.event.trigger("ajaxStart"),f&&q.event.trigger("ajaxSend",[p,l]),l.beforeSend&&!1===l.beforeSend.call(l.context,p,l))return l.global&&q.active--,g.reject(),g;if(p.aborted)return g.reject(),g;(a=i.clk)&&(n=a.name)&&!a.disabled&&(l.extraData=l.extraData||{},l.extraData[n]=a.value,"image"===a.type&&(l.extraData[n+".x"]=i.clk_x,l.extraData[n+".y"]=i.clk_y));var x=1,y=2;function b(t){var r=null;try{t.contentWindow&&(r=t.contentWindow.document)}catch(e){N("cannot get iframe.contentWindow document: "+e)}if(r)return r;try{r=t.contentDocument?t.contentDocument:t.document}catch(e){N("cannot get iframe.contentDocument: "+e),r=t.document}return r}var c=q("meta[name=csrf-token]").attr("content"),T=q("meta[name=csrf-param]").attr("content");function j(){var e=X.attr2("target"),t=X.attr2("action"),r=X.attr("enctype")||X.attr("encoding")||"multipart/form-data";i.setAttribute("target",o),O&&!/post/i.test(O)||i.setAttribute("method","POST"),t!==l.url&&i.setAttribute("action",l.url),l.skipEncodingOverride||O&&!/post/i.test(O)||X.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),l.timeout&&(v=setTimeout(function(){h=!0,A(x)},l.timeout));var a=[];try{if(l.extraData)for(var n in l.extraData)l.extraData.hasOwnProperty(n)&&(q.isPlainObject(l.extraData[n])&&l.extraData[n].hasOwnProperty("name")&&l.extraData[n].hasOwnProperty("value")?a.push(q('<input type="hidden" name="'+l.extraData[n].name+'">',s).val(l.extraData[n].value).appendTo(i)[0]):a.push(q('<input type="hidden" name="'+n+'">',s).val(l.extraData[n]).appendTo(i)[0]));l.iframeTarget||d.appendTo(u),m.attachEvent?m.attachEvent("onload",A):m.addEventListener("load",A,!1),setTimeout(function e(){try{var t=b(m).readyState;N("state = "+t),t&&"uninitialized"===t.toLowerCase()&&setTimeout(e,50)}catch(e){N("Server abort: ",e," (",e.name,")"),A(y),v&&clearTimeout(v),v=void 0}},15);try{i.submit()}catch(e){document.createElement("form").submit.apply(i)}}finally{i.setAttribute("action",t),i.setAttribute("enctype",r),e?i.setAttribute("target",e):X.removeAttr("target"),q(a).remove()}}T&&c&&(l.extraData=l.extraData||{},l.extraData[T]=c),l.forceSync?j():setTimeout(j,10);var w,S,k,D=50;function A(e){if(!p.aborted&&!k){if((S=b(m))||(N("cannot access response document"),e=y),e===x&&p)return p.abort("timeout"),void g.reject(p,"timeout");if(e===y&&p)return p.abort("server abort"),void g.reject(p,"error","server abort");if(S&&S.location.href!==l.iframeSrc||h){m.detachEvent?m.detachEvent("onload",A):m.removeEventListener("load",A,!1);var t,r="success";try{if(h)throw"timeout";var a="xml"===l.dataType||S.XMLDocument||q.isXMLDoc(S);if(N("isXml="+a),!a&&window.opera&&(null===S.body||!S.body.innerHTML)&&--D)return N("requeing onLoad callback, DOM not available"),void setTimeout(A,250);var n=S.body?S.body:S.documentElement;p.responseText=n?n.innerHTML:null,p.responseXML=S.XMLDocument?S.XMLDocument:S,a&&(l.dataType="xml"),p.getResponseHeader=function(e){return{"content-type":l.dataType}[e.toLowerCase()]},n&&(p.status=Number(n.getAttribute("status"))||p.status,p.statusText=n.getAttribute("statusText")||p.statusText);var o,i,s,u=(l.dataType||"").toLowerCase(),c=/(json|script|text)/.test(u);c||l.textarea?(o=S.getElementsByTagName("textarea")[0])?(p.responseText=o.value,p.status=Number(o.getAttribute("status"))||p.status,p.statusText=o.getAttribute("statusText")||p.statusText):c&&(i=S.getElementsByTagName("pre")[0],s=S.getElementsByTagName("body")[0],i?p.responseText=i.textContent?i.textContent:i.innerText:s&&(p.responseText=s.textContent?s.textContent:s.innerText)):"xml"===u&&!p.responseXML&&p.responseText&&(p.responseXML=F(p.responseText));try{w=E(p,u,l)}catch(e){r="parsererror",p.error=t=e||r}}catch(e){N("error caught: ",e),r="error",p.error=t=e||r}p.aborted&&(N("upload aborted"),r=null),p.status&&(r=200<=p.status&&p.status<300||304===p.status?"success":"error"),"success"===r?(l.success&&l.success.call(l.context,w,"success",p),g.resolve(p.responseText,"success",p),f&&q.event.trigger("ajaxSuccess",[p,l])):r&&(void 0===t&&(t=p.statusText),l.error&&l.error.call(l.context,p,r,t),g.reject(p,"error",t),f&&q.event.trigger("ajaxError",[p,l,t])),f&&q.event.trigger("ajaxComplete",[p,l]),f&&!--q.active&&q.event.trigger("ajaxStop"),l.complete&&l.complete.call(l.context,p,r),k=!0,l.timeout&&clearTimeout(v),setTimeout(function(){l.iframeTarget?d.attr("src",l.iframeSrc):d.remove(),p.responseXML=null},100)}}}var F=q.parseXML||function(e,t){return window.ActiveXObject?((t=new ActiveXObject("Microsoft.XMLDOM")).async="false",t.loadXML(e)):t=(new DOMParser).parseFromString(e,"text/xml"),t&&t.documentElement&&"parsererror"!==t.documentElement.nodeName?t:null},L=q.parseJSON||function(e){return window.eval("("+e+")")},E=function(e,t,r){var a=e.getResponseHeader("content-type")||"",n=("xml"===t||!t)&&0<=a.indexOf("xml"),o=n?e.responseXML:e.responseText;return n&&"parsererror"===o.documentElement.nodeName&&q.error&&q.error("parsererror"),r&&r.dataFilter&&(o=r.dataFilter(o,t)),"string"==typeof o&&(("json"===t||!t)&&0<=a.indexOf("json")?o=L(o):("script"===t||!t)&&0<=a.indexOf("javascript")&&q.globalEval(o)),o};return g}},q.fn.ajaxForm=function(e,t,r,a){if(("string"==typeof e||!1===e&&0<arguments.length)&&(e={url:e,data:t,dataType:r},"function"==typeof a&&(e.success=a)),(e=e||{}).delegation=e.delegation&&q.isFunction(q.fn.on),e.delegation||0!==this.length)return e.delegation?(q(document).off("submit.form-plugin",this.selector,o).off("click.form-plugin",this.selector,i).on("submit.form-plugin",this.selector,e,o).on("click.form-plugin",this.selector,e,i),this):(e.beforeFormUnbind&&e.beforeFormUnbind(this,e),this.ajaxFormUnbind().on("submit.form-plugin",e,o).on("click.form-plugin",e,i));var n={s:this.selector,c:this.context};return!q.isReady&&n.s?(N("DOM not ready, queuing ajaxForm"),q(function(){q(n.s,n.c).ajaxForm(e)})):N("terminating; zero elements found by selector"+(q.isReady?"":" (DOM not ready)")),this},q.fn.ajaxFormUnbind=function(){return this.off("submit.form-plugin click.form-plugin")},q.fn.formToArray=function(e,t,r){var a=[];if(0===this.length)return a;var n,o,i,s,u,c,l,f,d,m,p=this[0],h=this.attr("id"),v=(v=e||void 0===p.elements?p.getElementsByTagName("*"):p.elements)&&q.makeArray(v);if(h&&(e||/(Edge|Trident)\//.test(navigator.userAgent))&&(n=q(':input[form="'+h+'"]').get()).length&&(v=(v||[]).concat(n)),!v||!v.length)return a;for(q.isFunction(r)&&(v=q.map(v,r)),o=0,c=v.length;o<c;o++)if((m=(u=v[o]).name)&&!u.disabled)if(e&&p.clk&&"image"===u.type)p.clk===u&&(a.push({name:m,value:q(u).val(),type:u.type}),a.push({name:m+".x",value:p.clk_x},{name:m+".y",value:p.clk_y}));else if((s=q.fieldValue(u,!0))&&s.constructor===Array)for(t&&t.push(u),i=0,l=s.length;i<l;i++)a.push({name:m,value:s[i]});else if(S.fileapi&&"file"===u.type){t&&t.push(u);var g=u.files;if(g.length)for(i=0;i<g.length;i++)a.push({name:m,value:g[i],type:u.type});else a.push({name:m,value:"",type:u.type})}else null!=s&&(t&&t.push(u),a.push({name:m,value:s,type:u.type,required:u.required}));return e||!p.clk||(m=(d=(f=q(p.clk))[0]).name)&&!d.disabled&&"image"===d.type&&(a.push({name:m,value:f.val()}),a.push({name:m+".x",value:p.clk_x},{name:m+".y",value:p.clk_y})),a},q.fn.formSerialize=function(e){return q.param(this.formToArray(e))},q.fn.fieldSerialize=function(n){var o=[];return this.each(function(){var e=this.name;if(e){var t=q.fieldValue(this,n);if(t&&t.constructor===Array)for(var r=0,a=t.length;r<a;r++)o.push({name:e,value:t[r]});else null!=t&&o.push({name:this.name,value:t})}}),q.param(o)},q.fn.fieldValue=function(e){for(var t=[],r=0,a=this.length;r<a;r++){var n=this[r],o=q.fieldValue(n,e);null==o||o.constructor===Array&&!o.length||(o.constructor===Array?q.merge(t,o):t.push(o))}return t},q.fieldValue=function(e,t){var r=e.name,a=e.type,n=e.tagName.toLowerCase();if(void 0===t&&(t=!0),t&&(!r||e.disabled||"reset"===a||"button"===a||("checkbox"===a||"radio"===a)&&!e.checked||("submit"===a||"image"===a)&&e.form&&e.form.clk!==e||"select"===n&&-1===e.selectedIndex))return null;if("select"!==n)return q(e).val().replace(m,"\r\n");var o=e.selectedIndex;if(o<0)return null;for(var i=[],s=e.options,u="select-one"===a,c=u?o+1:s.length,l=u?o:0;l<c;l++){var f=s[l];if(f.selected&&!f.disabled){var d=(d=f.value)||(f.attributes&&f.attributes.value&&!f.attributes.value.specified?f.text:f.value);if(u)return d;i.push(d)}}return i},q.fn.clearForm=function(e){return this.each(function(){q("input,select,textarea",this).clearFields(e)})},q.fn.clearFields=q.fn.clearInputs=function(r){var a=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var e=this.type,t=this.tagName.toLowerCase();a.test(e)||"textarea"===t?this.value="":"checkbox"===e||"radio"===e?this.checked=!1:"select"===t?this.selectedIndex=-1:"file"===e?/MSIE/.test(navigator.userAgent)?q(this).replaceWith(q(this).clone(!0)):q(this).val(""):r&&(!0===r&&/hidden/.test(e)||"string"==typeof r&&q(this).is(r))&&(this.value="")})},q.fn.resetForm=function(){return this.each(function(){var t=q(this),e=this.tagName.toLowerCase();switch(e){case"input":this.checked=this.defaultChecked;case"textarea":return this.value=this.defaultValue,!0;case"option":case"optgroup":var r=t.parents("select");return r.length&&r[0].multiple?"option"===e?this.selected=this.defaultSelected:t.find("option").resetForm():r.resetForm(),!0;case"select":return t.find("option").each(function(e){if(this.selected=this.defaultSelected,this.defaultSelected&&!t[0].multiple)return t[0].selectedIndex=e,!1}),!0;case"label":var a=q(t.attr("for")),n=t.find("input,select,textarea");return a[0]&&n.unshift(a[0]),n.resetForm(),!0;case"form":return"function"!=typeof this.reset&&("object"!=typeof this.reset||this.reset.nodeType)||this.reset(),!0;default:return t.find("form,input,label,select,textarea").resetForm(),!0}})},q.fn.enable=function(e){return void 0===e&&(e=!0),this.each(function(){this.disabled=!e})},q.fn.selected=function(r){return void 0===r&&(r=!0),this.each(function(){var e,t=this.type;"checkbox"===t||"radio"===t?this.checked=r:"option"===this.tagName.toLowerCase()&&(e=q(this).parent("select"),r&&e[0]&&"select-one"===e[0].type&&e.find("option").selected(!1),this.selected=r)})},q.fn.ajaxSubmit.debug=!1});

;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, window) {
  function TableResponsive(table) {
    this.table = table;
    this.$table = $(table);
    this.showText = Drupal.t('Show all columns');
    this.hideText = Drupal.t('Hide lower priority columns');
    this.$headers = this.$table.find('th');
    this.$link = $('<button type="button" class="link tableresponsive-toggle"></button>').attr('title', Drupal.t('Show table cells that were hidden to make the table fit within a small screen.')).on('click', $.proxy(this, 'eventhandlerToggleColumns'));
    this.$table.before($('<div class="tableresponsive-toggle-columns"></div>').append(this.$link));
    $(window).on('resize.tableresponsive', $.proxy(this, 'eventhandlerEvaluateColumnVisibility')).trigger('resize.tableresponsive');
  }

  Drupal.behaviors.tableResponsive = {
    attach: function attach(context, settings) {
      once('tableresponsive', 'table.responsive-enabled', context).forEach(function (table) {
        TableResponsive.tables.push(new TableResponsive(table));
      });
    }
  };
  $.extend(TableResponsive, {
    tables: []
  });
  $.extend(TableResponsive.prototype, {
    eventhandlerEvaluateColumnVisibility: function eventhandlerEvaluateColumnVisibility(e) {
      var pegged = parseInt(this.$link.data('pegged'), 10);
      var hiddenLength = this.$headers.filter('.priority-medium:hidden, .priority-low:hidden').length;

      if (hiddenLength > 0) {
        this.$link.show();
        this.$link[0].textContent = this.showText;
      }

      if (!pegged && hiddenLength === 0) {
        this.$link.hide();
        this.$link[0].textContent = this.hideText;
      }
    },
    eventhandlerToggleColumns: function eventhandlerToggleColumns(e) {
      e.preventDefault();
      var self = this;
      var $hiddenHeaders = this.$headers.filter('.priority-medium:hidden, .priority-low:hidden');
      this.$revealedCells = this.$revealedCells || $();

      if ($hiddenHeaders.length > 0) {
        $hiddenHeaders.each(function (index, element) {
          var $header = $(this);
          var position = $header.prevAll('th').length;
          self.$table.find('tbody tr').each(function () {
            var $cells = $(this).find('td').eq(position);
            $cells.show();
            self.$revealedCells = $().add(self.$revealedCells).add($cells);
          });
          $header.show();
          self.$revealedCells = $().add(self.$revealedCells).add($header);
        });
        this.$link[0].textContent = this.hideText;
        this.$link.data('pegged', 1);
      } else {
        this.$revealedCells.hide();
        this.$revealedCells.each(function (index, element) {
          var $cell = $(this);
          var properties = $cell.attr('style').split(';');
          var newProps = [];
          var match = /^display\s*:\s*none$/;

          for (var i = 0; i < properties.length; i++) {
            var prop = properties[i];
            prop.trim();
            var isDisplayNone = match.exec(prop);

            if (isDisplayNone) {
              continue;
            }

            newProps.push(prop);
          }

          $cell.attr('style', newProps.join(';'));
        });
        this.$link[0].textContent = this.showText;
        this.$link.data('pegged', 0);
        $(window).trigger('resize.tableresponsive');
      }
    }
  });
  Drupal.TableResponsive = TableResponsive;
})(jQuery, Drupal, window);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal) {
  Drupal.behaviors.claroTableDrag = {
    attach: function attach(context, settings) {
      var createItemWrapBoundaries = function createItemWrapBoundaries(row) {
        var $row = $(row);
        var $firstCell = $row.find('td:first-of-type').eq(0).wrapInner(Drupal.theme('tableDragCellContentWrapper')).wrapInner($(Drupal.theme('tableDragCellItemsWrapper')).addClass('js-tabledrag-cell-content'));
        var $targetElem = $firstCell.find('.js-tabledrag-cell-content');
        $targetElem.eq(0).find('> .tabledrag-cell-content__item > .js-tabledrag-handle, > .tabledrag-cell-content__item > .js-indentation').prependTo($targetElem);
      };

      Object.keys(settings.tableDrag || {}).forEach(function (base) {
        once('claroTabledrag', $(context).find("#".concat(base)).find('> tr.draggable, > tbody > tr.draggable')).forEach(createItemWrapBoundaries);
      });
    }
  };
  $.extend(Drupal.tableDrag.prototype.row.prototype, {
    markChanged: function markChanged() {
      var marker = $(Drupal.theme('tableDragChangedMarker')).addClass('js-tabledrag-changed-marker');
      var cell = $(this.element).find('td:first-of-type');

      if (cell.find('.js-tabledrag-changed-marker').length === 0) {
        cell.find('.js-tabledrag-handle').after(marker);
      }
    },
    onIndent: function onIndent() {
      $(this.table).find('.tabledrag-cell > .js-indentation').each(function (index, indentToMove) {
        var $indentToMove = $(indentToMove);
        var $cellContent = $indentToMove.siblings('.tabledrag-cell-content');
        $indentToMove.prependTo($cellContent);
      });
    }
  });
  $.extend(Drupal.theme, {
    tableDragIndentation: function tableDragIndentation() {
      return '<div class="js-indentation indentation"><svg xmlns="http://www.w3.org/2000/svg" class="tree" width="25" height="25" viewBox="0 0 25 25"><path class="tree__item tree__item-child-ltr tree__item-child-last-ltr tree__item-horizontal tree__item-horizontal-right" d="M12,12.5 H25" stroke="#888"/><path class="tree__item tree__item-child-rtl tree__item-child-last-rtl tree__item-horizontal tree__horizontal-left" d="M0,12.5 H13" stroke="#888"/><path class="tree__item tree__item-child-ltr tree__item-child-rtl tree__item-child-last-ltr tree__item-child-last-rtl tree__vertical tree__vertical-top" d="M12.5,12 v-99" stroke="#888"/><path class="tree__item tree__item-child-ltr tree__item-child-rtl tree__vertical tree__vertical-bottom" d="M12.5,12 v99" stroke="#888"/></svg></div>';
    },
    tableDragChangedWarning: function tableDragChangedWarning() {
      return "<div class=\"tabledrag-changed-warning messages messages--warning\" role=\"alert\">".concat(Drupal.theme('tableDragChangedMarker'), " ").concat(Drupal.t('You have unsaved changes.'), "</div>");
    },
    tableDragHandle: function tableDragHandle() {
      return "<a href=\"#\" title=\"".concat(Drupal.t('Drag to re-order'), "\" class=\"tabledrag-handle js-tabledrag-handle\"></a>");
    },
    tableDragToggle: function tableDragToggle() {
      return "<div class=\"tabledrag-toggle-weight-wrapper\" data-drupal-selector=\"tabledrag-toggle-weight-wrapper\">\n            <button type=\"button\" class=\"link action-link tabledrag-toggle-weight\" data-drupal-selector=\"tabledrag-toggle-weight\"></button>\n            </div>";
    },
    toggleButtonContent: function toggleButtonContent(show) {
      var classes = ['action-link', 'action-link--extrasmall', 'tabledrag-toggle-weight'];
      var text = '';

      if (show) {
        classes.push('action-link--icon-hide');
        text = Drupal.t('Hide row weights');
      } else {
        classes.push('action-link--icon-show');
        text = Drupal.t('Show row weights');
      }

      return "<span class=\"".concat(classes.join(' '), "\">").concat(text, "</a>");
    },
    tableDragCellContentWrapper: function tableDragCellContentWrapper() {
      return '<div class="tabledrag-cell-content__item"></div>';
    },
    tableDragCellItemsWrapper: function tableDragCellItemsWrapper() {
      return '<div class="tabledrag-cell-content"></div>';
    }
  });
})(jQuery, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, once) {
  Drupal.behaviors.claroAutoCompete = {
    attach: function attach(context) {
      once('claroAutoComplete', 'input.form-autocomplete', context).forEach(function (value) {
        var $input = $(value);
        var timeout = 400;
        var classRemoveTimeout;

        var classRemove = function classRemove($autoCompleteElem) {
          $autoCompleteElem.removeClass('is-autocompleting');
          $autoCompleteElem.siblings('[data-drupal-selector="autocomplete-message"]').addClass('hidden');
        };

        $input.on('input autocompletesearch autocompleteresponses', function (event) {
          if (event && event.type && event.type === 'autocompletesearch') {
            $(event.target).addClass('is-autocompleting');
            $(event.target).siblings('[data-drupal-selector="autocomplete-message"]').removeClass('hidden');
          }

          clearTimeout(classRemoveTimeout);
          classRemoveTimeout = setTimeout(classRemove, timeout, $(event.target));
        });
      });
    }
  };
})(jQuery, Drupal, once);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal) {
  function init(tab) {
    var $tab = $(tab);
    var $target = $tab.find('[data-drupal-nav-tabs-target]');
    var $active = $target.find('.js-active-tab');

    var openMenu = function openMenu() {
      $target.toggleClass('is-open');
    };

    var toggleOrder = function toggleOrder(reset) {
      var current = $active.index();
      var original = $active.data('original-order');

      if (original === 0 || reset === (current === original)) {
        return;
      }

      var siblings = {
        first: '[data-original-order="0"]',
        previous: "[data-original-order=\"".concat(original - 1, "\"]")
      };
      var $first = $target.find(siblings.first);
      var $previous = $target.find(siblings.previous);

      if (reset && current !== original) {
        $active.insertAfter($previous);
      } else if (!reset && current === original) {
        $active.insertBefore($first);
      }
    };

    var toggleCollapsed = function toggleCollapsed() {
      if (window.matchMedia('(min-width: 48em)').matches) {
        if ($tab.hasClass('is-horizontal') && !$tab.attr('data-width')) {
          var width = 0;
          $target.find('.js-tabs-link').each(function (index, value) {
            width += $(value).outerWidth();
          });
          $tab.attr('data-width', width);
        }

        var isHorizontal = $tab.attr('data-width') <= $tab.outerWidth();
        $tab.toggleClass('is-horizontal', isHorizontal);
        toggleOrder(isHorizontal);
      } else {
        toggleOrder(false);
      }
    };

    $tab.addClass('position-container is-horizontal-enabled');
    $target.find('.js-tab').each(function (index, element) {
      var $item = $(element);
      $item.attr('data-original-order', $item.index());
    });
    $tab.on('click.tabs', '[data-drupal-nav-tabs-trigger]', openMenu);
    $(window).on('resize.tabs', Drupal.debounce(toggleCollapsed, 150)).trigger('resize.tabs');
  }

  Drupal.behaviors.navTabs = {
    attach: function attach(context) {
      once('nav-tabs', '[data-drupal-nav-tabs].is-collapsible', context).forEach(init);
    }
  };
})(jQuery, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings) {
  var activeItem = Drupal.url(drupalSettings.path.currentPath);

  $.fn.drupalToolbarMenu = function () {
    var ui = {
      handleOpen: Drupal.t('Extend'),
      handleClose: Drupal.t('Collapse')
    };

    function toggleList($item, switcher) {
      var $toggle = $item.children('.toolbar-box').children('.toolbar-handle');
      switcher = typeof switcher !== 'undefined' ? switcher : !$item.hasClass('open');
      $item.toggleClass('open', switcher);
      $toggle.toggleClass('open', switcher);
      $toggle.find('.action').each(function (index, element) {
        element.textContent = switcher ? ui.handleClose : ui.handleOpen;
      });
    }

    function toggleClickHandler(event) {
      var $toggle = $(event.target);
      var $item = $toggle.closest('li');
      toggleList($item);
      var $openItems = $item.siblings().filter('.open');
      toggleList($openItems, false);
    }

    function linkClickHandler(event) {
      if (!Drupal.toolbar.models.toolbarModel.get('isFixed')) {
        Drupal.toolbar.models.toolbarModel.set('activeTab', null);
      }

      event.stopPropagation();
    }

    function initItems($menu) {
      var options = {
        class: 'toolbar-icon toolbar-handle',
        action: ui.handleOpen,
        text: ''
      };
      $menu.find('li > a').wrap('<div class="toolbar-box">');
      $menu.find('li').each(function (index, element) {
        var $item = $(element);

        if ($item.children('ul.toolbar-menu').length) {
          var $box = $item.children('.toolbar-box');
          var $link = $box.find('a');
          options.text = Drupal.t('@label', {
            '@label': $link.length ? $link[0].textContent : ''
          });
          $item.children('.toolbar-box').append(Drupal.theme('toolbarMenuItemToggle', options));
        }
      });
    }

    function markListLevels($lists, level) {
      level = !level ? 1 : level;
      var $lis = $lists.children('li').addClass("level-".concat(level));
      $lists = $lis.children('ul');

      if ($lists.length) {
        markListLevels($lists, level + 1);
      }
    }

    function openActiveItem($menu) {
      var pathItem = $menu.find("a[href=\"".concat(window.location.pathname, "\"]"));

      if (pathItem.length && !activeItem) {
        activeItem = window.location.pathname;
      }

      if (activeItem) {
        var $activeItem = $menu.find("a[href=\"".concat(activeItem, "\"]")).addClass('menu-item--active');
        var $activeTrail = $activeItem.parentsUntil('.root', 'li').addClass('menu-item--active-trail');
        toggleList($activeTrail, true);
      }
    }

    return this.each(function (selector) {
      var menu = once('toolbar-menu', this);

      if (menu.length) {
        var $menu = $(menu);
        $menu.on('click.toolbar', '.toolbar-box', toggleClickHandler).on('click.toolbar', '.toolbar-box a', linkClickHandler);
        $menu.addClass('root');
        initItems($menu);
        markListLevels($menu);
        openActiveItem($menu);
      }
    });
  };

  Drupal.theme.toolbarMenuItemToggle = function (options) {
    return "<button class=\"".concat(options.class, "\"><span class=\"action\">").concat(options.action, "</span> <span class=\"label\">").concat(options.text, "</span></button>");
  };
})(jQuery, Drupal, drupalSettings);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings) {
  var options = $.extend({
    breakpoints: {
      'toolbar.narrow': '',
      'toolbar.standard': '',
      'toolbar.wide': ''
    }
  }, drupalSettings.toolbar, {
    strings: {
      horizontal: Drupal.t('Horizontal orientation'),
      vertical: Drupal.t('Vertical orientation')
    }
  });
  Drupal.behaviors.toolbar = {
    attach: function attach(context) {
      if (!window.matchMedia('only screen').matches) {
        return;
      }

      once('toolbar', '#toolbar-administration', context).forEach(function (toolbar) {
        var model = new Drupal.toolbar.ToolbarModel({
          locked: JSON.parse(localStorage.getItem('Drupal.toolbar.trayVerticalLocked')),
          activeTab: document.getElementById(JSON.parse(localStorage.getItem('Drupal.toolbar.activeTabID'))),
          height: $('#toolbar-administration').outerHeight()
        });
        Drupal.toolbar.models.toolbarModel = model;
        Object.keys(options.breakpoints).forEach(function (label) {
          var mq = options.breakpoints[label];
          var mql = window.matchMedia(mq);
          Drupal.toolbar.mql[label] = mql;
          mql.addListener(Drupal.toolbar.mediaQueryChangeHandler.bind(null, model, label));
          Drupal.toolbar.mediaQueryChangeHandler.call(null, model, label, mql);
        });
        Drupal.toolbar.views.toolbarVisualView = new Drupal.toolbar.ToolbarVisualView({
          el: toolbar,
          model: model,
          strings: options.strings
        });
        Drupal.toolbar.views.toolbarAuralView = new Drupal.toolbar.ToolbarAuralView({
          el: toolbar,
          model: model,
          strings: options.strings
        });
        Drupal.toolbar.views.bodyVisualView = new Drupal.toolbar.BodyVisualView({
          el: toolbar,
          model: model
        });
        model.trigger('change:isFixed', model, model.get('isFixed'));
        model.trigger('change:activeTray', model, model.get('activeTray'));
        var menuModel = new Drupal.toolbar.MenuModel();
        Drupal.toolbar.models.menuModel = menuModel;
        Drupal.toolbar.views.menuVisualView = new Drupal.toolbar.MenuVisualView({
          el: $(toolbar).find('.toolbar-menu-administration').get(0),
          model: menuModel,
          strings: options.strings
        });
        Drupal.toolbar.setSubtrees.done(function (subtrees) {
          menuModel.set('subtrees', subtrees);
          var theme = drupalSettings.ajaxPageState.theme;
          localStorage.setItem("Drupal.toolbar.subtrees.".concat(theme), JSON.stringify(subtrees));
          model.set('areSubtreesLoaded', true);
        });
        Drupal.toolbar.views.toolbarVisualView.loadSubtrees();
        $(document).on('drupalViewportOffsetChange.toolbar', function (event, offsets) {
          model.set('offsets', offsets);
        });
        model.on('change:orientation', function (model, orientation) {
          $(document).trigger('drupalToolbarOrientationChange', orientation);
        }).on('change:activeTab', function (model, tab) {
          $(document).trigger('drupalToolbarTabChange', tab);
        }).on('change:activeTray', function (model, tray) {
          $(document).trigger('drupalToolbarTrayChange', tray);
        });

        if (Drupal.toolbar.models.toolbarModel.get('orientation') === 'horizontal' && Drupal.toolbar.models.toolbarModel.get('activeTab') === null) {
          Drupal.toolbar.models.toolbarModel.set({
            activeTab: $('.toolbar-bar .toolbar-tab:not(.home-toolbar-tab) a').get(0)
          });
        }

        $(window).on({
          'dialog:aftercreate': function dialogAftercreate(event, dialog, $element, settings) {
            var $toolbar = $('#toolbar-bar');
            $toolbar.css('margin-top', '0');

            if (settings.drupalOffCanvasPosition === 'top') {
              var height = Drupal.offCanvas.getContainer($element).outerHeight();
              $toolbar.css('margin-top', "".concat(height, "px"));
              $element.on('dialogContentResize.off-canvas', function () {
                var newHeight = Drupal.offCanvas.getContainer($element).outerHeight();
                $toolbar.css('margin-top', "".concat(newHeight, "px"));
              });
            }
          },
          'dialog:beforeclose': function dialogBeforeclose() {
            $('#toolbar-bar').css('margin-top', '0');
          }
        });
      });
    }
  };
  Drupal.toolbar = {
    views: {},
    models: {},
    mql: {},
    setSubtrees: new $.Deferred(),
    mediaQueryChangeHandler: function mediaQueryChangeHandler(model, label, mql) {
      switch (label) {
        case 'toolbar.narrow':
          model.set({
            isOriented: mql.matches,
            isTrayToggleVisible: false
          });

          if (!mql.matches || !model.get('orientation')) {
            model.set({
              orientation: 'vertical'
            }, {
              validate: true
            });
          }

          break;

        case 'toolbar.standard':
          model.set({
            isFixed: mql.matches
          });
          break;

        case 'toolbar.wide':
          model.set({
            orientation: mql.matches && !model.get('locked') ? 'horizontal' : 'vertical'
          }, {
            validate: true
          });
          model.set({
            isTrayToggleVisible: mql.matches
          });
          break;

        default:
          break;
      }
    }
  };

  Drupal.theme.toolbarOrientationToggle = function () {
    return '<div class="toolbar-toggle-orientation"><div class="toolbar-lining">' + '<button class="toolbar-icon" type="button"></button>' + '</div></div>';
  };

  Drupal.AjaxCommands.prototype.setToolbarSubtrees = function (ajax, response, status) {
    Drupal.toolbar.setSubtrees.resolve(response.subtrees);
  };
})(jQuery, Drupal, drupalSettings);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Backbone, Drupal) {
  Drupal.toolbar.MenuModel = Backbone.Model.extend({
    defaults: {
      subtrees: {}
    }
  });
})(Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Backbone, Drupal) {
  Drupal.toolbar.ToolbarModel = Backbone.Model.extend({
    defaults: {
      activeTab: null,
      activeTray: null,
      isOriented: false,
      isFixed: false,
      areSubtreesLoaded: false,
      isViewportOverflowConstrained: false,
      orientation: 'horizontal',
      locked: false,
      isTrayToggleVisible: true,
      height: null,
      offsets: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
      }
    },
    validate: function validate(attributes, options) {
      if (attributes.orientation === 'horizontal' && this.get('locked') && !options.override) {
        return Drupal.t('The toolbar cannot be set to a horizontal orientation when it is locked.');
      }
    }
  });
})(Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, Backbone) {
  Drupal.toolbar.BodyVisualView = Backbone.View.extend({
    initialize: function initialize() {
      this.listenTo(this.model, 'change:activeTray ', this.render);
      this.listenTo(this.model, 'change:isFixed change:isViewportOverflowConstrained', this.isToolbarFixed);
    },
    isToolbarFixed: function isToolbarFixed() {
      var isViewportOverflowConstrained = this.model.get('isViewportOverflowConstrained');
      $('body').toggleClass('toolbar-fixed', isViewportOverflowConstrained || this.model.get('isFixed'));
    },
    render: function render() {
      $('body').toggleClass('toolbar-tray-open', !!this.model.get('activeTray'));
    }
  });
})(jQuery, Drupal, Backbone);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Backbone, Drupal) {
  Drupal.toolbar.MenuVisualView = Backbone.View.extend({
    initialize: function initialize() {
      this.listenTo(this.model, 'change:subtrees', this.render);
    },
    render: function render() {
      var _this = this;

      var subtrees = this.model.get('subtrees');
      Object.keys(subtrees || {}).forEach(function (id) {
        $(once('toolbar-subtrees', _this.$el.find("#toolbar-link-".concat(id)))).after(subtrees[id]);
      });

      if ('drupalToolbarMenu' in $.fn) {
        this.$el.children('.toolbar-menu').drupalToolbarMenu();
      }
    }
  });
})(jQuery, Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Backbone, Drupal) {
  Drupal.toolbar.ToolbarAuralView = Backbone.View.extend({
    initialize: function initialize(options) {
      this.strings = options.strings;
      this.listenTo(this.model, 'change:orientation', this.onOrientationChange);
      this.listenTo(this.model, 'change:activeTray', this.onActiveTrayChange);
    },
    onOrientationChange: function onOrientationChange(model, orientation) {
      Drupal.announce(Drupal.t('Tray orientation changed to @orientation.', {
        '@orientation': orientation
      }));
    },
    onActiveTrayChange: function onActiveTrayChange(model, tray) {
      var relevantTray = tray === null ? model.previous('activeTray') : tray;

      if (!relevantTray) {
        return;
      }

      var action = tray === null ? Drupal.t('closed') : Drupal.t('opened');
      var trayNameElement = relevantTray.querySelector('.toolbar-tray-name');
      var text;

      if (trayNameElement !== null) {
        text = Drupal.t('Tray "@tray" @action.', {
          '@tray': trayNameElement.textContent,
          '@action': action
        });
      } else {
        text = Drupal.t('Tray @action.', {
          '@action': action
        });
      }

      Drupal.announce(text);
    }
  });
})(Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings, Backbone) {
  Drupal.toolbar.ToolbarVisualView = Backbone.View.extend({
    events: function events() {
      var touchEndToClick = function touchEndToClick(event) {
        event.preventDefault();
        event.target.click();
      };

      return {
        'click .toolbar-bar .toolbar-tab .trigger': 'onTabClick',
        'click .toolbar-toggle-orientation button': 'onOrientationToggleClick',
        'touchend .toolbar-bar .toolbar-tab .trigger': touchEndToClick,
        'touchend .toolbar-toggle-orientation button': touchEndToClick
      };
    },
    initialize: function initialize(options) {
      this.strings = options.strings;
      this.listenTo(this.model, 'change:activeTab change:orientation change:isOriented change:isTrayToggleVisible', this.render);
      this.listenTo(this.model, 'change:mqMatches', this.onMediaQueryChange);
      this.listenTo(this.model, 'change:offsets', this.adjustPlacement);
      this.listenTo(this.model, 'change:activeTab change:orientation change:isOriented', this.updateToolbarHeight);
      this.$el.find('.toolbar-tray .toolbar-lining').has('.toolbar-menu').append(Drupal.theme('toolbarOrientationToggle'));
      this.model.trigger('change:activeTab');
    },
    updateToolbarHeight: function updateToolbarHeight() {
      var toolbarTabOuterHeight = $('#toolbar-bar').find('.toolbar-tab').outerHeight() || 0;
      var toolbarTrayHorizontalOuterHeight = $('.is-active.toolbar-tray-horizontal').outerHeight() || 0;
      this.model.set('height', toolbarTabOuterHeight + toolbarTrayHorizontalOuterHeight);
      $('body').css({
        'padding-top': this.model.get('height')
      });
      $('html').css({
        'scroll-padding-top': this.model.get('height')
      });
      this.triggerDisplace();
    },
    triggerDisplace: function triggerDisplace() {
      _.defer(function () {
        Drupal.displace(true);
      });
    },
    render: function render() {
      this.updateTabs();
      this.updateTrayOrientation();
      this.updateBarAttributes();
      $('body').removeClass('toolbar-loading');

      if (this.model.changed.orientation === 'vertical' || this.model.changed.activeTab) {
        this.loadSubtrees();
      }

      return this;
    },
    onTabClick: function onTabClick(event) {
      if (event.currentTarget.hasAttribute('data-toolbar-tray')) {
        var activeTab = this.model.get('activeTab');
        var clickedTab = event.currentTarget;
        this.model.set('activeTab', !activeTab || clickedTab !== activeTab ? clickedTab : null);
        event.preventDefault();
        event.stopPropagation();
      }
    },
    onOrientationToggleClick: function onOrientationToggleClick(event) {
      var orientation = this.model.get('orientation');
      var antiOrientation = orientation === 'vertical' ? 'horizontal' : 'vertical';
      var locked = antiOrientation === 'vertical';

      if (locked) {
        localStorage.setItem('Drupal.toolbar.trayVerticalLocked', 'true');
      } else {
        localStorage.removeItem('Drupal.toolbar.trayVerticalLocked');
      }

      this.model.set({
        locked: locked,
        orientation: antiOrientation
      }, {
        validate: true,
        override: true
      });
      event.preventDefault();
      event.stopPropagation();
    },
    updateTabs: function updateTabs() {
      var $tab = $(this.model.get('activeTab'));
      $(this.model.previous('activeTab')).removeClass('is-active').prop('aria-pressed', false);
      $(this.model.previous('activeTray')).removeClass('is-active');

      if ($tab.length > 0) {
        $tab.addClass('is-active').prop('aria-pressed', true);
        var name = $tab.attr('data-toolbar-tray');
        var id = $tab.get(0).id;

        if (id) {
          localStorage.setItem('Drupal.toolbar.activeTabID', JSON.stringify(id));
        }

        var $tray = this.$el.find("[data-toolbar-tray=\"".concat(name, "\"].toolbar-tray"));

        if ($tray.length) {
          $tray.addClass('is-active');
          this.model.set('activeTray', $tray.get(0));
        } else {
          this.model.set('activeTray', null);
        }
      } else {
        this.model.set('activeTray', null);
        localStorage.removeItem('Drupal.toolbar.activeTabID');
      }
    },
    updateBarAttributes: function updateBarAttributes() {
      var isOriented = this.model.get('isOriented');

      if (isOriented) {
        this.$el.find('.toolbar-bar').attr('data-offset-top', '');
      } else {
        this.$el.find('.toolbar-bar').removeAttr('data-offset-top');
      }

      this.$el.toggleClass('toolbar-oriented', isOriented);
    },
    updateTrayOrientation: function updateTrayOrientation() {
      var orientation = this.model.get('orientation');
      var antiOrientation = orientation === 'vertical' ? 'horizontal' : 'vertical';
      $('body').toggleClass('toolbar-vertical', orientation === 'vertical').toggleClass('toolbar-horizontal', orientation === 'horizontal');
      var removeClass = antiOrientation === 'horizontal' ? 'toolbar-tray-horizontal' : 'toolbar-tray-vertical';
      var $trays = this.$el.find('.toolbar-tray').removeClass(removeClass).addClass("toolbar-tray-".concat(orientation));
      var iconClass = "toolbar-icon-toggle-".concat(orientation);
      var iconAntiClass = "toolbar-icon-toggle-".concat(antiOrientation);
      var $orientationToggle = this.$el.find('.toolbar-toggle-orientation').toggle(this.model.get('isTrayToggleVisible'));
      var $orientationToggleButton = $orientationToggle.find('button');
      $orientationToggleButton[0].value = antiOrientation;
      $orientationToggleButton.attr('title', this.strings[antiOrientation]).removeClass(iconClass).addClass(iconAntiClass);
      $orientationToggleButton[0].textContent = this.strings[antiOrientation];
      var dir = document.documentElement.dir;
      var edge = dir === 'rtl' ? 'right' : 'left';
      $trays.removeAttr('data-offset-left data-offset-right data-offset-top');
      $trays.filter('.toolbar-tray-vertical.is-active').attr("data-offset-".concat(edge), '');
      $trays.filter('.toolbar-tray-horizontal.is-active').attr('data-offset-top', '');
    },
    adjustPlacement: function adjustPlacement() {
      var $trays = this.$el.find('.toolbar-tray');

      if (!this.model.get('isOriented')) {
        $trays.removeClass('toolbar-tray-horizontal').addClass('toolbar-tray-vertical');
      }
    },
    loadSubtrees: function loadSubtrees() {
      var $activeTab = $(this.model.get('activeTab'));
      var orientation = this.model.get('orientation');

      if (!this.model.get('areSubtreesLoaded') && typeof $activeTab.data('drupal-subtrees') !== 'undefined' && orientation === 'vertical') {
        var subtreesHash = drupalSettings.toolbar.subtreesHash;
        var theme = drupalSettings.ajaxPageState.theme;
        var endpoint = Drupal.url("toolbar/subtrees/".concat(subtreesHash));
        var cachedSubtreesHash = localStorage.getItem("Drupal.toolbar.subtreesHash.".concat(theme));
        var cachedSubtrees = JSON.parse(localStorage.getItem("Drupal.toolbar.subtrees.".concat(theme)));
        var isVertical = this.model.get('orientation') === 'vertical';

        if (isVertical && subtreesHash === cachedSubtreesHash && cachedSubtrees) {
          Drupal.toolbar.setSubtrees.resolve(cachedSubtrees);
        } else if (isVertical) {
          localStorage.removeItem("Drupal.toolbar.subtreesHash.".concat(theme));
          localStorage.removeItem("Drupal.toolbar.subtrees.".concat(theme));
          Drupal.ajax({
            url: endpoint
          }).execute();
          localStorage.setItem("Drupal.toolbar.subtreesHash.".concat(theme), subtreesHash);
        }
      }
    }
  });
})(jQuery, Drupal, drupalSettings, Backbone);;
(function ($, Drupal) {
  Drupal.behaviors.adminToolbar = {
    attach: function (context, settings) {

      $('a.toolbar-icon', context).removeAttr('title');

      // Make the toolbar menu navigable with keyboard.
      $('ul.toolbar-menu li.menu-item--expanded a', context).on('focusin', function () {
        $('li.menu-item--expanded', context).removeClass('hover-intent');
        $(this).parents('li.menu-item--expanded').addClass('hover-intent');
      });

      $('ul.toolbar-menu li.menu-item a', context).keydown(function (e) {
        if ((e.shiftKey && (e.keyCode || e.which) == 9)) {
          if ($(this).parent('.menu-item').prev().hasClass('menu-item--expanded')) {
            $(this).parent('.menu-item').prev().addClass('hover-intent');
          }
        }
      });

      $('.toolbar-menu:first-child > .menu-item:not(.menu-item--expanded) a, .toolbar-tab > a', context).on('focusin', function () {
        $('.menu-item--expanded').removeClass('hover-intent');
      });

      $('.toolbar-menu:first-child > .menu-item', context).on('hover', function () {
        $(this, 'a').css("background: #fff;");
      });

      $('ul:not(.toolbar-menu)', context).on({
        mousemove: function () {
          $('li.menu-item--expanded').removeClass('hover-intent');
        },
        hover: function () {
          $('li.menu-item--expanded').removeClass('hover-intent');
        }
      });

      // Always hide the dropdown menu on mobile.
      if (window.matchMedia("(max-width: 767px)").matches && $('body').hasClass('toolbar-tray-open')) {
        $('body').removeClass('toolbar-tray-open');
        $('#toolbar-item-administration').removeClass('is-active');
        $('#toolbar-item-administration-tray').removeClass('is-active');
      };

    }
  };
})(jQuery, Drupal);
;
;/*!
 * hoverIntent v1.8.1 // 2014.08.11 // jQuery v1.9.1+
 * http://briancherne.github.io/jquery-hoverIntent/
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2014 Brian Cherne
 */

/* hoverIntent is similar to jQuery's built-in "hover" method except that
 * instead of firing the handlerIn function immediately, hoverIntent checks
 * to see if the user's mouse has slowed down (beneath the sensitivity
 * threshold) before firing the event. The handlerOut function is only
 * called after a matching handlerIn.
 *
 * // basic usage ... just like .hover()
 * .hoverIntent( handlerIn, handlerOut )
 * .hoverIntent( handlerInOut )
 *
 * // basic usage ... with event delegation!
 * .hoverIntent( handlerIn, handlerOut, selector )
 * .hoverIntent( handlerInOut, selector )
 *
 * // using a basic configuration object
 * .hoverIntent( config )
 *
 * @param  handlerIn   function OR configuration object
 * @param  handlerOut  function OR selector for delegation OR undefined
 * @param  selector    selector OR undefined
 * @author Brian Cherne <brian(at)cherne(dot)net>
 */(function (factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (jQuery && !jQuery.fn.hoverIntent) {
    factory(jQuery);
  }
})(function ($) {
  'use strict';

  // default configuration values
  var _cfg = {
    interval: 100,
    sensitivity: 6,
    timeout: 0
  };

  // counter used to generate an ID for each instance
  var INSTANCE_COUNT = 0;

  // current X and Y position of mouse, updated during mousemove tracking (shared across instances)
  var cX, cY;

  // saves the current pointer position coordinates based on the given mousemove event
  var track = function (ev) {
    cX = ev.pageX;
    cY = ev.pageY;
  };

  // compares current and previous mouse positions
  var compare = function (ev,$el,s,cfg) {
    // compare mouse positions to see if pointer has slowed enough to trigger `over` function
    if ( Math.sqrt( (s.pX - cX) * (s.pX - cX) + (s.pY - cY) * (s.pY - cY) ) < cfg.sensitivity ) {
      $el.off(s.event,track);
      delete s.timeoutId;
      // set hoverIntent state as active for this element (permits `out` handler to trigger)
      s.isActive = true;
      // overwrite old mouseenter event coordinates with most recent pointer position
      ev.pageX = cX; ev.pageY = cY;
      // clear coordinate data from state object
      delete s.pX; delete s.pY;
      return cfg.over.apply($el[0],[ev]);
    } else {
      // set previous coordinates for next comparison
      s.pX = cX; s.pY = cY;
      // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
      s.timeoutId = setTimeout( function () {compare(ev, $el, s, cfg);} , cfg.interval );
    }
  };

  // triggers given `out` function at configured `timeout` after a mouseleave and clears state
  var delay = function (ev,$el,s,out) {
    delete $el.data('hoverIntent')[s.id];
    return out.apply($el[0],[ev]);
  };

  $.fn.hoverIntent = function (handlerIn,handlerOut,selector) {
    // instance ID, used as a key to store and retrieve state information on an element
    var instanceId = INSTANCE_COUNT++;

    // extend the default configuration and parse parameters
    var cfg = $.extend({}, _cfg);
    if ( $.isPlainObject(handlerIn) ) {
      cfg = $.extend(cfg, handlerIn);
      if ( !$.isFunction(cfg.out) ) {
        cfg.out = cfg.over;
      }
    } else if ( $.isFunction(handlerOut) ) {
      cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
    } else {
      cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
    }

    // A private function for handling mouse 'hovering'
    var handleHover = function (e) {
      // cloned event to pass to handlers (copy required for event object to be passed in IE)
      var ev = $.extend({},e);

      // the current target of the mouse event, wrapped in a jQuery object
      var $el = $(this);

      // read hoverIntent data from element (or initialize if not present)
      var hoverIntentData = $el.data('hoverIntent');
      if (!hoverIntentData) { $el.data('hoverIntent', (hoverIntentData = {})); }

      // read per-instance state from element (or initialize if not present)
      var state = hoverIntentData[instanceId];
      if (!state) { hoverIntentData[instanceId] = state = { id: instanceId }; }

      // state properties:
      // id = instance ID, used to clean up data
      // timeoutId = timeout ID, reused for tracking mouse position and delaying "out" handler
      // isActive = plugin state, true after `over` is called just until `out` is called
      // pX, pY = previously-measured pointer coordinates, updated at each polling interval
      // event = string representing the namespaced event used for mouse tracking

      // clear any existing timeout
      if (state.timeoutId) { state.timeoutId = clearTimeout(state.timeoutId); }

      // namespaced event used to register and unregister mousemove tracking
      var mousemove = state.event = 'mousemove.hoverIntent.hoverIntent' + instanceId;

      // handle the event, based on its type
      if (e.type === 'mouseenter') {
        // do nothing if already active
        if (state.isActive) { return; }
        // set "previous" X and Y position based on initial entry point
        state.pX = ev.pageX; state.pY = ev.pageY;
        // update "current" X and Y position based on mousemove
        $el.off(mousemove,track).on(mousemove,track);
        // start polling interval (self-calling timeout) to compare mouse coordinates over time
        state.timeoutId = setTimeout( function () {compare(ev,$el,state,cfg);} , cfg.interval );
      } else { // "mouseleave"
        // do nothing if not already active
        if (!state.isActive) { return; }
        // unbind expensive mousemove event
        $el.off(mousemove,track);
        // if hoverIntent state is true, then call the mouseOut function after the specified delay
        state.timeoutId = setTimeout( function () {delay(ev,$el,state,cfg.out);} , cfg.timeout );
      }
    };

    // listen for mouseenter and mouseleave
    return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
  };
});
;
(function ($) {
  $(document).ready(function () {
    $('.toolbar-tray-horizontal li.menu-item--expanded, .toolbar-tray-horizontal ul li.menu-item--expanded .menu-item').hoverIntent({
      over: function () {
        // At the current depth, we should delete all "hover-intent" classes.
        // Other wise we get unwanted behaviour where menu items are expanded while already in hovering other ones.
        $(this).parent().find('li').removeClass('hover-intent');
        $(this).addClass('hover-intent');
      },
      out: function () {
        $(this).removeClass('hover-intent');
      },
      timeout: 250
    });
  });
})(jQuery);
;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings) {
  var pathInfo = drupalSettings.path;
  var escapeAdminPath = sessionStorage.getItem('escapeAdminPath');
  var windowLocation = window.location;

  if (!pathInfo.currentPathIsAdmin && !/destination=/.test(windowLocation.search)) {
    sessionStorage.setItem('escapeAdminPath', windowLocation);
  }

  Drupal.behaviors.escapeAdmin = {
    attach: function attach() {
      var toolbarEscape = once('escapeAdmin', '[data-toolbar-escape-admin]');

      if (toolbarEscape.length && pathInfo.currentPathIsAdmin) {
        if (escapeAdminPath !== null) {
          $(toolbarEscape).attr('href', escapeAdminPath);
        } else {
          toolbarEscape[0].textContent = Drupal.t('Home');
        }
      }
    }
  };
})(jQuery, Drupal, drupalSettings);;
