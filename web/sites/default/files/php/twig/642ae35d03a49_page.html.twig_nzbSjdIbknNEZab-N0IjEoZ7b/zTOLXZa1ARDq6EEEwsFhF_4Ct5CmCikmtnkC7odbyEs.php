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

/* themes/contrib/socialbase/templates/layout/page.html.twig */
class __TwigTemplate_edb91220fb1339b6e1f578395005a623eb82ba94e2a9c0edb2f2cea155ede3a6 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'section' => [$this, 'block_section'],
            'content' => [$this, 'block_content'],
            'sidebar_first' => [$this, 'block_sidebar_first'],
            'sidebar_second' => [$this, 'block_sidebar_second'],
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
        // line 36
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 36)) {
            // line 37
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
            echo "
";
        }
        // line 39
        echo "
<main id=\"content\" class=\"main-container\" role=\"main\">

  ";
        // line 42
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 42)) {
            // line 43
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 45
        echo "
  ";
        // line 46
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "hero", [], "any", false, false, true, 46)) {
            // line 47
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "hero", [], "any", false, false, true, 47), 47, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 49
        echo "
  ";
        // line 50
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secondary_navigation", [], "any", false, false, true, 50)) {
            // line 51
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secondary_navigation", [], "any", false, false, true, 51), 51, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 53
        echo "
  ";
        // line 54
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_top", [], "any", false, false, true, 54)) {
            // line 55
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_top", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 57
        echo "
  ";
        // line 59
        echo "  ";
        $this->displayBlock('section', $context, $blocks);
        // line 98
        echo "
  ";
        // line 99
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_bottom", [], "any", false, false, true, 99)) {
            // line 100
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_bottom", [], "any", false, false, true, 100), 100, $this->source), "html", null, true);
            echo "
  ";
        }
        // line 102
        echo "
</main>

";
        // line 105
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 105)) {
            // line 106
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
            echo "
";
        }
    }

    // line 59
    public function block_section($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 60
        echo "    <section";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_attributes"] ?? null), 60, $this->source), "html", null, true);
        echo ">

      ";
        // line 62
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, true, 62) && ($context["display_page_title"] ?? null))) {
            // line 63
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, true, 63), 63, $this->source), "html", null, true);
            echo "
      ";
        }
        // line 65
        echo "
      ";
        // line 66
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_top", [], "any", false, false, true, 66) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_bottom", [], "any", false, false, true, 66))) {
            // line 67
            echo "        <aside class=\"region--complementary\" role=\"complementary\">
          ";
            // line 68
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_top", [], "any", false, false, true, 68)) {
                // line 69
                echo "            ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_top", [], "any", false, false, true, 69), 69, $this->source), "html", null, true);
                echo "
          ";
            }
            // line 71
            echo "          ";
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_bottom", [], "any", false, false, true, 71)) {
                // line 72
                echo "            ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_bottom", [], "any", false, false, true, 72), 72, $this->source), "html", null, true);
                echo "
          ";
            }
            // line 74
            echo "        </aside>
      ";
        }
        // line 76
        echo "
      ";
        // line 77
        $this->displayBlock('content', $context, $blocks);
        // line 81
        echo "
      ";
        // line 83
        echo "      ";
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 83) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_top", [], "any", false, false, true, 83)) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_bottom", [], "any", false, false, true, 83))) {
            // line 84
            echo "        ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 87
            echo "      ";
        }
        // line 88
        echo "
      ";
        // line 90
        echo "      ";
        if (((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 90) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_top", [], "any", false, false, true, 90)) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "complementary_bottom", [], "any", false, false, true, 90))) {
            // line 91
            echo "        ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 94
            echo "      ";
        }
        // line 95
        echo "
    </section>
  ";
    }

    // line 77
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 78
        echo "        <a id=\"main-content\" tabindex=\"-1\"></a>
        ";
        // line 79
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 79), 79, $this->source), "html", null, true);
        echo "
      ";
    }

    // line 84
    public function block_sidebar_first($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 85
        echo "          ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
        echo "
        ";
    }

    // line 91
    public function block_sidebar_second($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 92
        echo "          ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 92), 92, $this->source), "html", null, true);
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 92,  238 => 91,  231 => 85,  227 => 84,  221 => 79,  218 => 78,  214 => 77,  208 => 95,  205 => 94,  202 => 91,  199 => 90,  196 => 88,  193 => 87,  190 => 84,  187 => 83,  184 => 81,  182 => 77,  179 => 76,  175 => 74,  169 => 72,  166 => 71,  160 => 69,  158 => 68,  155 => 67,  153 => 66,  150 => 65,  144 => 63,  142 => 62,  136 => 60,  132 => 59,  124 => 106,  122 => 105,  117 => 102,  111 => 100,  109 => 99,  106 => 98,  103 => 59,  100 => 57,  94 => 55,  92 => 54,  89 => 53,  83 => 51,  81 => 50,  78 => 49,  72 => 47,  70 => 46,  67 => 45,  61 => 43,  59 => 42,  54 => 39,  48 => 37,  46 => 36,  43 => 35,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/layout/page.html.twig", "/app/web/themes/contrib/socialbase/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 36, "block" => 59);
        static $filters = array("escape" => 37);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block'],
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
