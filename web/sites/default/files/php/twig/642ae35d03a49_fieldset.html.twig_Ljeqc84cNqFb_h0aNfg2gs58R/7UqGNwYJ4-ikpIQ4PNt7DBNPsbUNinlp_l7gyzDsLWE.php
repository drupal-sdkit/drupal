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

/* themes/contrib/socialbase/templates/form/fieldset.html.twig */
class __TwigTemplate_00e54a21f36996acd3e0fcfe33fd392c9e813be46122a2fe62699ea505c25165 extends \Twig\Template
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
        // line 26
        $context["classes"] = [0 => ((        // line 27
($context["form_group"] ?? null)) ? ("form-group") : ("")), 1 => (( !        // line 28
($context["form_group"] ?? null)) ? ("js-form-wrapper") : ("")), 2 => (( !        // line 29
($context["form_group"] ?? null)) ? ("form-wrapper") : (""))];
        // line 32
        echo "
";
        // line 33
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("socialbase/popover"), "html", null, true);
        echo "

<fieldset";
        // line 35
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 35), 35, $this->source), "html", null, true);
        echo ">
  ";
        // line 37
        $context["label_classes"] = [0 => ((        // line 38
($context["form_group"] ?? null)) ? ("control-label") : ("")), 1 => ((        // line 39
($context["required"] ?? null)) ? ("js-form-required") : ("")), 2 => ((        // line 40
($context["required"] ?? null)) ? ("form-required") : ("")), 3 => (((        // line 41
($context["title_display"] ?? null) == "invisible")) ? ("sr-only") : (""))];
        // line 44
        echo "  ";
        // line 45
        echo "  <legend";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "attributes", [], "any", false, false, true, 45), "addClass", [0 => ($context["label_classes"] ?? null)], "method", false, false, true, 45), 45, $this->source), "html", null, true);
        echo ">
    <span";
        // line 46
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["legend_span"] ?? null), "attributes", [], "any", false, false, true, 46), 46, $this->source), "html", null, true);
        echo ">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "title", [], "any", false, false, true, 46), 46, $this->source), "html", null, true);
        echo "</span>";
        // line 48
        if (($context["required"] ?? null)) {
            // line 49
            echo "<span class=\"form-required\">*</span>";
        }
        // line 52
        if ( !twig_test_empty(($context["popover"] ?? null))) {
            // line 53
            echo "      ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["popover"] ?? null), 53, $this->source), "html", null, true);
            echo "
    ";
        }
        // line 55
        echo "  </legend>

  ";
        // line 57
        if (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 57)) {
            // line 58
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 58), "addClass", [0 => "help-block"], "method", false, false, true, 58), 58, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 58), 58, $this->source), "html", null, true);
            echo "</div>
  ";
        }
        // line 60
        echo "
  <div class=\"fieldset-wrapper\">
    ";
        // line 62
        if (($context["prefix"] ?? null)) {
            // line 63
            echo "      <span class=\"field-prefix\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 63, $this->source), "html", null, true);
            echo "</span>
    ";
        }
        // line 65
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 65, $this->source), "html", null, true);
        echo "
    ";
        // line 66
        if (($context["suffix"] ?? null)) {
            // line 67
            echo "      <span class=\"field-suffix\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null), 67, $this->source), "html", null, true);
            echo "</span>
    ";
        }
        // line 69
        echo "  </div>

  ";
        // line 71
        if (($context["errors"] ?? null)) {
            // line 72
            echo "    <div class=\"form-item--error-message alert alert-danger alert-sm alert-dismissible form-control-radius\">
      ";
            // line 73
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 73, $this->source), "html", null, true);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
            // line 74
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Close"));
            echo "\">
        <span aria-hidden=\"true\">×</span>
      </button>
    </div>
  ";
        }
        // line 79
        echo "
";
        // line 83
        echo "
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/form/fieldset.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 83,  147 => 79,  139 => 74,  135 => 73,  132 => 72,  130 => 71,  126 => 69,  120 => 67,  118 => 66,  113 => 65,  107 => 63,  105 => 62,  101 => 60,  93 => 58,  91 => 57,  87 => 55,  81 => 53,  79 => 52,  76 => 49,  74 => 48,  69 => 46,  64 => 45,  62 => 44,  60 => 41,  59 => 40,  58 => 39,  57 => 38,  56 => 37,  52 => 35,  47 => 33,  44 => 32,  42 => 29,  41 => 28,  40 => 27,  39 => 26,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/form/fieldset.html.twig", "/app/web/themes/contrib/socialbase/templates/form/fieldset.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 26, "if" => 48);
        static $filters = array("escape" => 33, "t" => 74);
        static $functions = array("attach_library" => 33);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
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
