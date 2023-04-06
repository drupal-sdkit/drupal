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

/* themes/contrib/socialbase/templates/block/block--views-exposed-filter-block.html.twig */
class __TwigTemplate_4db529ec905f92c05386ef3c6ac170a4457837ac247cbba743c4b28b983c9836 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 48
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("socialbase/offcanvas"), "html", null, true);
        echo "

<div";
        // line 50
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 50, $this->source), "html", null, true);
        echo " data-class=\"exposed-filter-block\">
  <div class=\"btn--offcanvas-trigger\">
    <a href=\"#block-filter\" class=\"btn btn-default btn-raised\" title=\"";
        // line 52
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Click to open filter"));
        echo "\">
      <svg class=\"btn-icon\" aria-hidden=\"true\">
        <title>";
        // line 54
        echo t("Open filter", array());
        echo "</title>
        <use xlink:href=\"#icon-filter_list\"></use>
      </svg>
      ";
        // line 57
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 57, $this->source), "html", null, true);
        echo "
    </a>
  </div>
  <div id=\"block-filter\" class=\"off-canvas off-canvas-right off-canvas-xs-only\">
    <div class=\"offcanvas-head\">

    ";
        // line 63
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 63, $this->source), "html", null, true);
        echo "
    ";
        // line 64
        if (($context["label"] ?? null)) {
            // line 65
            echo "      <h2 ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => "complementary-title", 1 => "no-margin"], "method", false, false, true, 65), 65, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 65, $this->source), "html", null, true);
            echo "</h2>
    ";
        }
        // line 67
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 67, $this->source), "html", null, true);
        echo "

      <div class=\"offcanvas-tools\">
        <a href=\"#\" class=\"btn btn-icon-toggle pull-right\" title=\"";
        // line 70
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Click to close search box"));
        echo "\">
          <svg class=\"pull-left btn-icon icon-black\" aria-hidden=\"true\">
            <title>";
        // line 72
        echo t("Close filter", array());
        echo "</title>
            <use xlink:href=\"#icon-close\"></use>
          </svg>
        </a>
      </div>
    </div>

    <div class=\"offcanvas-body\">

      ";
        // line 81
        $this->displayBlock('content', $context, $blocks);
        // line 84
        echo "
    </div>
  </div>
</div>
";
    }

    // line 81
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 82
        echo "        ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 82, $this->source), "html", null, true);
        echo "
      ";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/block/block--views-exposed-filter-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 82,  118 => 81,  110 => 84,  108 => 81,  96 => 72,  91 => 70,  84 => 67,  76 => 65,  74 => 64,  70 => 63,  61 => 57,  55 => 54,  50 => 52,  45 => 50,  40 => 48,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/block/block--views-exposed-filter-block.html.twig", "/app/web/themes/contrib/socialbase/templates/block/block--views-exposed-filter-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 54, "if" => 64, "block" => 81);
        static $filters = array("escape" => 48, "t" => 52);
        static $functions = array("attach_library" => 48);

        try {
            $this->sandbox->checkSecurity(
                ['trans', 'if', 'block'],
                ['escape', 't'],
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
