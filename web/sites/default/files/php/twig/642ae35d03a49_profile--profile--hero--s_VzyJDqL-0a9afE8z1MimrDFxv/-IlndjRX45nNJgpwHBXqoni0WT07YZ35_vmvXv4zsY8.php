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

/* themes/contrib/socialblue/templates/profile/profile--profile--hero--sky.html.twig */
class __TwigTemplate_a7cec31d288cc2994848946fbdb1ee99ef8e4b940ed812485fae789179071bcf extends \Twig\Template
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
        // line 1
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("socialbase/hero"), "html", null, true);
        echo "

";
        // line 3
        if (($context["profile_hero_styled_image_url"] ?? null)) {
            // line 4
            echo "<div style=\"background-image: url('";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_hero_styled_image_url"] ?? null), 4, $this->source), "html", null, true);
            echo "')\" class=\"cover cover-img cover-img-gradient\">
  ";
        } else {
            // line 6
            echo "<div class=\"cover\">
  ";
        }
        // line 8
        echo "  <div class=\"hero__bgimage-overlay\"></div>
    ";
        // line 9
        if (($context["profile_edit_url"] ?? null)) {
            // line 10
            echo "      <div class=\"hero-action-button\">
        <a href=\"";
            // line 11
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_edit_url"] ?? null), 11, $this->source), "html", null, true);
            echo "\" title=\"";
            echo t("Edit profile information", array());
            echo "\"
           class=\"btn btn-raised btn-default btn-floating\">
          <svg class=\"icon-medium\" aria-hidden=\"true\">
            <title>";
            // line 14
            echo t("Edit profile information", array());
            echo "</title>
            <use xlink:href=\"#icon-edit\"></use>
          </svg>
        </a>
      </div>
    ";
        }
        // line 20
        echo "    <div class=\"cover-wrap\">
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialblue/templates/profile/profile--profile--hero--sky.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 20,  72 => 14,  64 => 11,  61 => 10,  59 => 9,  56 => 8,  52 => 6,  46 => 4,  44 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialblue/templates/profile/profile--profile--hero--sky.html.twig", "/app/web/themes/contrib/socialblue/templates/profile/profile--profile--hero--sky.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 3, "trans" => 11);
        static $filters = array("escape" => 1);
        static $functions = array("attach_library" => 1);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape'],
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
