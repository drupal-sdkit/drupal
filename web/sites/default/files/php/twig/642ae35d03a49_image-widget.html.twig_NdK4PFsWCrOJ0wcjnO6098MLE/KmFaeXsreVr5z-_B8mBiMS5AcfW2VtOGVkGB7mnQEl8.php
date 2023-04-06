<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/socialbase/templates/file/image-widget.html.twig */
class __TwigTemplate_bd86aebd46056cd445dea87fcb650d596b5f68e7fa7b899ad32b773efcea6594 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 15
        echo "
";
        // line 16
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("socialbase/image-widget"), "html", null, true);
        echo "
";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("image_widget_crop/cropper"), "html", null, true);
        echo "
";
        // line 18
        $context["in_post"] = (is_string($__internal_compile_0 = (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "upload", [], "any", false, false, true, 18)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["#id"] ?? null) : null)) && is_string($__internal_compile_1 = "edit-field-post-image-0-upload") && ('' === $__internal_compile_1 || 0 === strpos($__internal_compile_0, $__internal_compile_1)));
        // line 19
        echo "
";
        // line 20
        if (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "preview", [], "any", false, false, true, 20)) {
            // line 21
            echo "  <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "image-widget"], "method", false, false, true, 21), "removeClass", [0 => "clearfix"], "method", false, false, true, 21), 21, $this->source), "html", null, true);
            echo ">
    <div class=\"preview\">
      ";
            // line 23
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "preview", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
            echo "
    </div>
    <div class=\"data image-widget-data\">

      ";
            // line 27
            if (($context["in_post"] ?? null)) {
                // line 28
                echo "        ";
                // line 29
                echo "        ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["data"] ?? null), 29, $this->source), "preview", "image_crop", ("file_" . $this->sandbox->ensureToStringAllowed((($__internal_compile_3 = (($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "fids", [], "any", false, false, true, 29)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["#value"] ?? null) : null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[0] ?? null) : null), 29, $this->source)), "remove_button"), "html", null, true);
                echo "
      ";
            } else {
                // line 31
                echo "        ";
                // line 32
                echo "        ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["data"] ?? null), 32, $this->source), "preview", "image_crop"), "html", null, true);
                echo "
      ";
            }
            // line 34
            echo "
    </div>
  </div>

  ";
            // line 38
            if (($context["in_post"] ?? null)) {
                // line 39
                echo "    ";
                // line 40
                echo "    <div class=\"hidden\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "remove_button", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
                echo "</div>
    <button type=\"button\" id=\"post-photo-remove\" class=\"btn--post-remove-image\" title=\"";
                // line 41
                echo t("Remove image", array());
                echo "\">
      <svg class=\"btn-icon\" aria-hidden=\"true\">
        <title>";
                // line 43
                echo t("Remove image", array());
                echo "</title>
        <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-close\"></use>
      </svg>
    </button>

  ";
            } else {
                // line 49
                echo "
    ";
                // line 50
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "image_crop", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
                echo "

  ";
            }
            // line 53
            echo "
";
        } else {
            // line 55
            echo "
  ";
            // line 56
            if (($context["in_post"] ?? null)) {
                // line 57
                echo "
    ";
                // line 59
                echo "    <div";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null), 1 => "hidden"], "method", false, false, true, 59), 59, $this->source), "html", null, true);
                echo ">
      ";
                // line 60
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["data"] ?? null), 60, $this->source), "html", null, true);
                echo "
    </div>
    <button type=\"button\" id=\"post-photo-add\" class=\"btn btn-default\">
      <svg class=\"btn-icon\" aria-hidden=\"true\">
        <title>";
                // line 64
                echo t("Add image", array());
                echo "</title>
        <use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#icon-plus\"></use>
      </svg>
      <span>
        ";
                // line 68
                echo t("Add image", array());
                // line 69
                echo "      </span>
    </button>

  ";
            } else {
                // line 73
                echo "
    <div";
                // line 74
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 74), 74, $this->source), "html", null, true);
                echo ">
      ";
                // line 75
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["data"] ?? null), 75, $this->source), "html", null, true);
                echo "
    </div>

  ";
            }
            // line 79
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/file/image-widget.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 79,  172 => 75,  168 => 74,  165 => 73,  159 => 69,  157 => 68,  150 => 64,  143 => 60,  138 => 59,  135 => 57,  133 => 56,  130 => 55,  126 => 53,  120 => 50,  117 => 49,  108 => 43,  103 => 41,  98 => 40,  96 => 39,  94 => 38,  88 => 34,  82 => 32,  80 => 31,  74 => 29,  72 => 28,  70 => 27,  63 => 23,  57 => 21,  55 => 20,  52 => 19,  50 => 18,  46 => 17,  42 => 16,  39 => 15,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/file/image-widget.html.twig", "/app/web/themes/contrib/socialbase/templates/file/image-widget.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 18, "if" => 20, "trans" => 41);
        static $filters = array("escape" => 16, "without" => 29);
        static $functions = array("attach_library" => 16);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans'],
                ['escape', 'without'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
