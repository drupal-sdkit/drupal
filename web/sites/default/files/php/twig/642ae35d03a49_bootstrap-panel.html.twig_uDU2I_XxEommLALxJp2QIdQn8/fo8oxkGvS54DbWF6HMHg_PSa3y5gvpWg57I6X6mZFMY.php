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

/* themes/contrib/socialbase/templates/card/bootstrap-panel.html.twig */
class __TwigTemplate_a27f635acb9616c5a4d522fe05eeb2d28bf06fa4192f87874e7ed5c738ea8c3e extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'heading' => [$this, 'block_heading'],
            'body' => [$this, 'block_body'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
";
        // line 45
        echo "
";
        // line 47
        $context["classes"] = [0 => "card", 1 => ((        // line 49
($context["collapsible"] ?? null)) ? ("panel") : ("")), 2 => (((        // line 50
($context["collapsible"] ?? null) && ($context["errors"] ?? null))) ? ("panel-danger") : (("panel-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["panel_type"] ?? null), 50, $this->source)))))];
        // line 53
        echo "
";
        // line 54
        if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(($context["body"] ?? null))) {
            // line 55
            echo "  <fieldset ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 55), 55, $this->source), "html", null, true);
            echo ">

    ";
            // line 58
            echo "    ";
            if (($context["heading"] ?? null)) {
                // line 59
                echo "      ";
                $this->displayBlock('heading', $context, $blocks);
                // line 68
                echo "    ";
            }
            // line 69
            echo "
    ";
            // line 71
            echo "    ";
            $this->displayBlock('body', $context, $blocks);
            // line 104
            echo "
    ";
            // line 106
            echo "    ";
            if (($context["footer"] ?? null)) {
                // line 107
                echo "      ";
                $this->displayBlock('footer', $context, $blocks);
                // line 115
                echo "    ";
            }
            // line 116
            echo "
  </fieldset>
";
        }
    }

    // line 59
    public function block_heading($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 60
        echo "        <legend class=\"card__title card__title--underline\">
          ";
        // line 61
        if (($context["collapsible"] ?? null)) {
            // line 62
            echo "            <a";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["heading_attributes"] ?? null), 62, $this->source), "html", null, true);
            echo " href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["target"] ?? null), 62, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["heading"] ?? null), 62, $this->source), "html", null, true);
            echo "</a>
          ";
        } else {
            // line 64
            echo "            <span";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["heading_attributes"] ?? null), 64, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["heading"] ?? null), 64, $this->source), "html", null, true);
            echo "</span>
          ";
        }
        // line 66
        echo "        </legend>
      ";
    }

    // line 71
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 72
        echo "      ";
        // line 73
        $context["body_classes"] = [0 => "card__block", 1 => ((        // line 75
($context["collapsible"] ?? null)) ? ("panel-collapse") : ("")), 2 => ((        // line 76
($context["collapsible"] ?? null)) ? ("collapse") : ("")), 3 => ((        // line 77
($context["collapsible"] ?? null)) ? ("fade") : ("")), 4 => (((        // line 78
($context["errors"] ?? null) || (($context["collapsible"] ?? null) &&  !($context["collapsed"] ?? null)))) ? ("in") : (""))];
        // line 81
        echo "      ";
        // line 82
        $context["description_classes"] = [0 => "help-block", 1 => (((        // line 84
($context["description"] ?? null) && (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "position", [], "any", false, false, true, 84) == "invisible"))) ? ("sr-only") : (""))];
        // line 87
        echo "
      ";
        // line 88
        if (($context["errors"] ?? null)) {
            // line 89
            echo "        <div class=\"alert alert-danger\" role=\"alert\">
          <strong>";
            // line 90
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 90, $this->source), "html", null, true);
            echo "</strong>
        </div>
      ";
        }
        // line 93
        echo "
      <div";
        // line 94
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["body_attributes"] ?? null), "addClass", [0 => ($context["body_classes"] ?? null)], "method", false, false, true, 94), 94, $this->source), "html", null, true);
        echo ">
        ";
        // line 95
        if ((($context["description"] ?? null) && (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "position", [], "any", false, false, true, 95) == "before"))) {
            // line 96
            echo "          <p";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 96), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 96), 96, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 96), 96, $this->source), "html", null, true);
            echo "</p>
        ";
        }
        // line 98
        echo "        ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["body"] ?? null), 98, $this->source), "html", null, true);
        echo "
        ";
        // line 99
        if (((($context["description"] ?? null) && (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "position", [], "any", false, false, true, 99) == "after")) || (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "position", [], "any", false, false, true, 99) == "invisible"))) {
            // line 100
            echo "          <p";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 100), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 100), 100, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 100), 100, $this->source), "html", null, true);
            echo "</p>
        ";
        }
        // line 102
        echo "      </div>
    ";
    }

    // line 107
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 108
        echo "        ";
        // line 109
        $context["footer_classes"] = [0 => "card__actionbar"];
        // line 113
        echo "        <div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["footer_attributes"] ?? null), "addClass", [0 => ($context["footer_classes"] ?? null)], "method", false, false, true, 113), 113, $this->source), "html", null, true);
        echo ">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer"] ?? null), 113, $this->source), "html", null, true);
        echo "</div>
      ";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/card/bootstrap-panel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 113,  203 => 109,  201 => 108,  197 => 107,  192 => 102,  184 => 100,  182 => 99,  177 => 98,  169 => 96,  167 => 95,  163 => 94,  160 => 93,  154 => 90,  151 => 89,  149 => 88,  146 => 87,  144 => 84,  143 => 82,  141 => 81,  139 => 78,  138 => 77,  137 => 76,  136 => 75,  135 => 73,  133 => 72,  129 => 71,  124 => 66,  116 => 64,  106 => 62,  104 => 61,  101 => 60,  97 => 59,  90 => 116,  87 => 115,  84 => 107,  81 => 106,  78 => 104,  75 => 71,  72 => 69,  69 => 68,  66 => 59,  63 => 58,  57 => 55,  55 => 54,  52 => 53,  50 => 50,  49 => 49,  48 => 47,  45 => 45,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/card/bootstrap-panel.html.twig", "/app/web/themes/contrib/socialbase/templates/card/bootstrap-panel.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 47, "if" => 54, "block" => 59);
        static $filters = array("clean_class" => 50, "render" => 54, "escape" => 55);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'render', 'escape'],
                []
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
