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

/* themes/contrib/socialbase/templates/system/details--collapsible.html.twig */
class __TwigTemplate_2853b7c5628ed09ab80467d82ef763d02af8f6dedd09b29a4bf5128741fcacfc extends \Twig\Template
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
        echo "<details";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "removeAttribute", [0 => "open"], "method", false, false, true, 19), "addClass", [0 => "form-horizontal form-item js-form-item form-wrapper js-form-wrapper card panel panel-default"], "method", false, false, true, 19), 19, $this->source), "html", null, true);
        echo ">";
        // line 20
        if (($context["title"] ?? null)) {
            // line 21
            echo "<summary";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["summary_attributes"] ?? null), "addClass", [0 => "card__title"], "method", false, false, true, 21), 21, $this->source), "html", null, true);
            echo ">
      ";
            // line 22
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 22, $this->source), "html", null, true);
            echo "
      <svg class=\"icon-summary-arrow\" aria-hidden=\"true\">
        <title>";
            // line 24
            echo t("Collapsible", array());
            echo "</title>
        <use xlink:href=\"#icon-expand_more\"></use>
      </svg>
    </summary>";
        }
        // line 30
        echo "<div class=\"card__block\">
    ";
        // line 31
        if (($context["errors"] ?? null)) {
            // line 32
            echo "      <div>
        ";
            // line 33
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 33, $this->source), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 36
        echo "
    ";
        // line 37
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 37, $this->source), "html", null, true);
        echo "
    ";
        // line 38
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 38, $this->source), "html", null, true);
        echo "
    ";
        // line 39
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 39, $this->source), "html", null, true);
        echo "
  </div>
</details>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/system/details--collapsible.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 39,  83 => 38,  79 => 37,  76 => 36,  70 => 33,  67 => 32,  65 => 31,  62 => 30,  55 => 24,  50 => 22,  45 => 21,  43 => 20,  39 => 19,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/system/details--collapsible.html.twig", "/app/web/themes/contrib/socialbase/templates/system/details--collapsible.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 20, "trans" => 24);
        static $filters = array("escape" => 19);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape'],
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
