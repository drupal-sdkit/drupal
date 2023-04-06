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

/* themes/contrib/socialbase/templates/views/views-view--activity-stream-notifications--page.html.twig */
class __TwigTemplate_343886db2f5154c8435d86815692ce97ebe7a4d69aeac1f5be367776774e42b6 extends \Twig\Template
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
        // line 35
        echo "
";
        // line 37
        $context["error_classes"] = [0 => (((        // line 38
($context["display_id"] ?? null) == "page")) ? ("alert alert-info") : ("")), 1 => (((        // line 39
($context["display_id"] ?? null) != "page")) ? ("small card__block dropdown-header") : (""))];
        // line 42
        echo "
<div class=\"card\">
  <div class=\"card__block\">
    ";
        // line 45
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 45, $this->source), "html", null, true);
        echo "
    ";
        // line 46
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 46, $this->source), "html", null, true);
        echo "
    ";
        // line 47
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 47, $this->source), "html", null, true);
        echo "
    ";
        // line 48
        if ( !($context["empty"] ?? null)) {
            // line 49
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["rows"] ?? null), 49, $this->source), "html", null, true);
            echo "
    ";
        }
        // line 51
        echo "
    ";
        // line 52
        if (($context["empty"] ?? null)) {
            // line 53
            echo "      <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => ($context["error_classes"] ?? null)], "method", false, false, true, 53), 53, $this->source), "html", null, true);
            echo "\" role=\"alert\">
        <h4 class=\"sr-only\">";
            // line 54
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Informative message"));
            echo "</h4>
        ";
            // line 55
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["empty"] ?? null), 55, $this->source), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 58
        echo "  </div>
</div>

";
        // line 61
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pager"] ?? null), 61, $this->source), "html", null, true);
        echo "
";
        // line 62
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["more"] ?? null), 62, $this->source), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/views/views-view--activity-stream-notifications--page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 62,  96 => 61,  91 => 58,  85 => 55,  81 => 54,  76 => 53,  74 => 52,  71 => 51,  65 => 49,  63 => 48,  59 => 47,  55 => 46,  51 => 45,  46 => 42,  44 => 39,  43 => 38,  42 => 37,  39 => 35,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/views/views-view--activity-stream-notifications--page.html.twig", "/app/web/themes/contrib/socialbase/templates/views/views-view--activity-stream-notifications--page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 37, "if" => 48);
        static $filters = array("escape" => 45, "t" => 54);
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
