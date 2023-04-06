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

/* themes/contrib/socialbase/templates/form/datetime-wrapper.html.twig */
class __TwigTemplate_13bfe18fa4f600e78ae0c9c0be30b693348102fead7cb382ee9b18e14150c3fe extends \Twig\Template
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
        // line 19
        $context["title_classes"] = [0 => "control-label", 1 => ((        // line 21
($context["required"] ?? null)) ? ("form-required") : (""))];
        // line 24
        echo "
";
        // line 26
        $context["classes"] = [0 => ((        // line 27
($context["errors"] ?? null)) ? ("error has-error") : (""))];
        // line 30
        echo "
<div";
        // line 31
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 31), 31, $this->source), "html", null, true);
        echo ">
";
        // line 32
        if (($context["title"] ?? null)) {
            // line 33
            echo "  <label";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method", false, false, true, 33), 33, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 33, $this->source), "html", null, true);
            echo "</label>
  ";
            // line 34
            if (($context["required"] ?? null)) {
                // line 35
                echo "    <span class=\"form-required\">*</span>
  ";
            }
        }
        // line 38
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 38, $this->source), "html", null, true);
        echo "
";
        // line 39
        if (($context["errors"] ?? null)) {
            // line 40
            echo "  <div class=\"form-item--error-message alert alert-danger alert-sm alert-dismissible form-control-radius\">
    ";
            // line 41
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 41, $this->source), "html", null, true);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
            // line 42
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Close"));
            echo "\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>
  <br />
";
        }
        // line 48
        if (($context["description"] ?? null)) {
            // line 49
            echo "  <div class=\"help-block\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 49, $this->source), "html", null, true);
            echo "</div>
";
        }
        // line 51
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/form/datetime-wrapper.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 51,  95 => 49,  93 => 48,  84 => 42,  80 => 41,  77 => 40,  75 => 39,  71 => 38,  66 => 35,  64 => 34,  57 => 33,  55 => 32,  51 => 31,  48 => 30,  46 => 27,  45 => 26,  42 => 24,  40 => 21,  39 => 19,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/form/datetime-wrapper.html.twig", "/app/web/themes/contrib/socialbase/templates/form/datetime-wrapper.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 19, "if" => 32);
        static $filters = array("escape" => 31, "t" => 42);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 't'],
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
