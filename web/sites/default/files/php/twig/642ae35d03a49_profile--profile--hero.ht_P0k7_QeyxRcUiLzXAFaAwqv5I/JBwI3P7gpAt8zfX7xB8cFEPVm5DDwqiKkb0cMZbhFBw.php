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

/* themes/contrib/socialbase/templates/profile/profile--profile--hero.html.twig */
class __TwigTemplate_9ee6ad44c375c0b3d54523e13dab5c400cce902e4eb9f827dd01c14f5bddde4a extends \Twig\Template
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
        // line 22
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("socialbase/hero"), "html", null, true);
        echo "

";
        // line 24
        if (($context["profile_hero_styled_image_url"] ?? null)) {
            // line 25
            echo "  <div style=\"background-image: url('";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_hero_styled_image_url"] ?? null), 25, $this->source), "html", null, true);
            echo "')\" class=\"cover cover-img cover-img-gradient\">
";
        } else {
            // line 27
            echo "  <div class=\"cover\">
";
        }
        // line 29
        echo "    <div class=\"hero__bgimage-overlay\"></div>
";
        // line 30
        if (($context["profile_edit_url"] ?? null)) {
            // line 31
            echo "  <div class=\"hero-action-button\">
    <a href=\"";
            // line 32
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_edit_url"] ?? null), 32, $this->source), "html", null, true);
            echo "\" title=\"";
            echo t("Edit profile information", array());
            echo "\" class=\"btn btn-raised btn-default btn-floating\">
      <svg class=\"icon-medium\" aria-hidden=\"true\">
        <title>";
            // line 34
            echo t("Edit profile information", array());
            echo "</title>
        <use xlink:href=\"#icon-edit\"></use>
      </svg>
    </a>
  </div>
";
        }
        // line 40
        echo "
  <div class=\"cover-wrap\">

    <header>
      ";
        // line 44
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_image", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
        echo "
      <h1 class=\"page-title\">
        ";
        // line 46
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_name"] ?? null), 46, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_name_extra"] ?? null), 46, $this->source), "html", null, true);
        echo "
      </h1>
    </header>


  ";
        // line 51
        if ((($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_function", [], "any", false, false, true, 51)) || $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_organization", [], "any", false, false, true, 51))) || (($context["profile_contact_label"] ?? null) == "private_message"))) {
            // line 52
            echo "    <footer class=\"hero-footer\">
  ";
        }
        // line 54
        echo "
    <div class=\"hero-footer__text\">
      ";
        // line 56
        if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_function", [], "any", false, false, true, 56))) {
            // line 57
            echo "        <strong>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_function", [], "any", false, false, true, 57), 57, $this->source), "html", null, true);
            echo "</strong>
      ";
        }
        // line 59
        echo "      ";
        if (($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_function", [], "any", false, false, true, 59)) && $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_organization", [], "any", false, false, true, 59)))) {
            // line 60
            echo "      &nbsp;-&nbsp;
      ";
        }
        // line 62
        echo "        ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_organization", [], "any", false, false, true, 62), 62, $this->source), "html", null, true);
        echo "
    </div>

    ";
        // line 65
        if ((($context["profile_contact_label"] ?? null) == "private_message")) {
            // line 66
            echo "      <div class=\"hero-footer__cta\">
        <a href=\"";
            // line 67
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_contact_url"] ?? null), 67, $this->source), "html", null, true);
            echo "\" class=\"btn btn-accent btn-lg btn-raised\">
          ";
            // line 68
            echo t("Private message", array());
            // line 69
            echo "        </a>
      </div>
    ";
        }
        // line 72
        echo "
  ";
        // line 73
        if ((($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_function", [], "any", false, false, true, 73)) || $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_organization", [], "any", false, false, true, 73))) || (($context["profile_contact_label"] ?? null) == "private_message"))) {
            // line 74
            echo "    </footer>
  ";
        }
        // line 76
        echo "
    ";
        // line 78
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 78, $this->source), "field_profile_first_name", "field_profile_last_name", "field_profile_image", "field_profile_function", "field_profile_organization"), "html", null, true);
        echo "
  </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/profile/profile--profile--hero.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 78,  158 => 76,  154 => 74,  152 => 73,  149 => 72,  144 => 69,  142 => 68,  138 => 67,  135 => 66,  133 => 65,  126 => 62,  122 => 60,  119 => 59,  113 => 57,  111 => 56,  107 => 54,  103 => 52,  101 => 51,  91 => 46,  86 => 44,  80 => 40,  71 => 34,  64 => 32,  61 => 31,  59 => 30,  56 => 29,  52 => 27,  46 => 25,  44 => 24,  39 => 22,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/profile/profile--profile--hero.html.twig", "/app/web/themes/contrib/socialbase/templates/profile/profile--profile--hero.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 24, "trans" => 32);
        static $filters = array("escape" => 22, "render" => 51, "without" => 78);
        static $functions = array("attach_library" => 22);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape', 'render', 'without'],
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
