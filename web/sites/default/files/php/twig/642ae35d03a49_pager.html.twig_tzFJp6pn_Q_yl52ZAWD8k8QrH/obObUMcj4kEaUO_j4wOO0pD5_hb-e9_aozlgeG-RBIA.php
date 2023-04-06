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

/* themes/contrib/socialbase/templates/system/pager.html.twig */
class __TwigTemplate_300c532a899e3c6b8ca99043e1146c0183bad8e54fa6beedb505d7d938107bbe extends \Twig\Template
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
        // line 34
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("socialbase/pagination"), "html", null, true);
        echo "

";
        // line 36
        if (($context["items"] ?? null)) {
            // line 37
            echo "  <nav class=\"pager-nav text-center\" role=\"navigation\" aria-labelledby=\"pagination-heading\">
    <h4 id=\"pagination-heading\" class=\"visually-hidden\">";
            // line 38
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Pagination"));
            echo "</h4>
    <ul class=\"pagination js-pager__items\">

      ";
            // line 42
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "first", [], "any", false, false, true, 42)) {
                // line 43
                echo "        <li class=\"pager__item pager__item--first\">
          <a href=\"";
                // line 44
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "first", [], "any", false, false, true, 44), "href", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
                echo "\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to first page"));
                echo "\" rel=\"prev\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "first", [], "any", false, false, true, 44), "attributes", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 45
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("First page"));
                echo "</span>
            ";
                // line 46
                $context["default_first"] = t("first");
                // line 47
                echo "            <span aria-hidden=\"true\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "first", [], "any", false, true, true, 47), "text", [], "any", true, true, true, 47)) ? (_twig_default_filter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "first", [], "any", false, true, true, 47), "text", [], "any", false, false, true, 47), 47, $this->source), $this->sandbox->ensureToStringAllowed(($context["default_first"] ?? null), 47, $this->source))) : (($context["default_first"] ?? null))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 51
            echo "
      ";
            // line 53
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 53)) {
                // line 54
                echo "        <li class=\"pager__item pager__item--previous\">
          <a href=\"";
                // line 55
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 55), "href", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
                echo "\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to previous page"));
                echo "\" rel=\"prev\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 55), "attributes", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 56
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Previous page"));
                echo "</span>
            ";
                // line 57
                $context["default_previous"] = t("previous");
                // line 58
                echo "            <span aria-hidden=\"true\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, true, true, 58), "text", [], "any", true, true, true, 58)) ? (_twig_default_filter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, true, true, 58), "text", [], "any", false, false, true, 58), 58, $this->source), $this->sandbox->ensureToStringAllowed(($context["default_previous"] ?? null), 58, $this->source))) : (($context["default_previous"] ?? null))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 62
            echo "
      ";
            // line 64
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "pages", [], "any", false, false, true, 64));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 65
                echo "        <li class=\"pager__item";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["current"] ?? null) == $context["key"])) ? (" is-active active") : ("")));
                echo "\">
          ";
                // line 66
                if ((($context["current"] ?? null) == $context["key"])) {
                    // line 67
                    echo "            ";
                    $context["title"] = t("Current page");
                    // line 68
                    echo "          ";
                } else {
                    // line 69
                    echo "            ";
                    $context["title"] = t("Go to page @key", ["@key" => $context["key"]]);
                    // line 70
                    echo "          ";
                }
                // line 71
                echo "          <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "href", [], "any", false, false, true, 71), 71, $this->source), "html", null, true);
                echo "\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 71, $this->source), "html", null, true);
                echo "\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 71), 71, $this->source), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">
              ";
                // line 73
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["current"] ?? null) == $context["key"])) ? (t("Current page")) : (t("Page"))));
                echo "
            </span>";
                // line 75
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["key"], 75, $this->source), "html", null, true);
                // line 76
                echo "</a>
        </li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "
      ";
            // line 81
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 81)) {
                // line 82
                echo "        <li class=\"pager__item pager__item--next\">
          <a href=\"";
                // line 83
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 83), "href", [], "any", false, false, true, 83), 83, $this->source), "html", null, true);
                echo "\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to next page"));
                echo "\" rel=\"next\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 83), "attributes", [], "any", false, false, true, 83), 83, $this->source), "html", null, true);
                echo ">
            <span class=\"visually-hidden\">";
                // line 84
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Next page"));
                echo "</span>
            ";
                // line 85
                $context["default_next"] = t("next");
                // line 86
                echo "            <span aria-hidden=\"true\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, true, true, 86), "text", [], "any", true, true, true, 86)) ? (_twig_default_filter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, true, true, 86), "text", [], "any", false, false, true, 86), 86, $this->source), $this->sandbox->ensureToStringAllowed(($context["default_next"] ?? null), 86, $this->source))) : (($context["default_next"] ?? null))), "html", null, true);
                echo "</span>
          </a>
        </li>
      ";
            }
            // line 90
            echo "
      ";
            // line 92
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "last", [], "any", false, false, true, 92)) {
                // line 93
                echo "      <li class=\"pager__item pager__item--last\">
        <a href=\"";
                // line 94
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "last", [], "any", false, false, true, 94), "href", [], "any", false, false, true, 94), 94, $this->source), "html", null, true);
                echo "\" title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to last page"));
                echo "\" rel=\"last\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "last", [], "any", false, false, true, 94), "attributes", [], "any", false, false, true, 94), 94, $this->source), "html", null, true);
                echo ">
          <span class=\"visually-hidden\">";
                // line 95
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Last page"));
                echo "</span>
          ";
                // line 96
                $context["default_last"] = t("last");
                // line 97
                echo "          <span aria-hidden=\"true\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "last", [], "any", false, true, true, 97), "text", [], "any", true, true, true, 97)) ? (_twig_default_filter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["items"] ?? null), "last", [], "any", false, true, true, 97), "text", [], "any", false, false, true, 97), 97, $this->source), $this->sandbox->ensureToStringAllowed(($context["default_last"] ?? null), 97, $this->source))) : (($context["default_last"] ?? null))), "html", null, true);
                echo "</span>
        </a>
      </li>
      ";
            }
            // line 101
            echo "
    </ul>
  </nav>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/system/pager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  227 => 101,  219 => 97,  217 => 96,  213 => 95,  205 => 94,  202 => 93,  199 => 92,  196 => 90,  188 => 86,  186 => 85,  182 => 84,  174 => 83,  171 => 82,  168 => 81,  165 => 79,  157 => 76,  155 => 75,  151 => 73,  141 => 71,  138 => 70,  135 => 69,  132 => 68,  129 => 67,  127 => 66,  122 => 65,  117 => 64,  114 => 62,  106 => 58,  104 => 57,  100 => 56,  92 => 55,  89 => 54,  86 => 53,  83 => 51,  75 => 47,  73 => 46,  69 => 45,  61 => 44,  58 => 43,  55 => 42,  49 => 38,  46 => 37,  44 => 36,  39 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/system/pager.html.twig", "/app/web/themes/contrib/socialbase/templates/system/pager.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 36, "set" => 46, "for" => 64);
        static $filters = array("escape" => 34, "t" => 38, "default" => 47);
        static $functions = array("attach_library" => 34);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 't', 'default'],
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
