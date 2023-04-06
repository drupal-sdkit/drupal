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

/* themes/contrib/socialblue/templates/profile/profile--profile--statistic.html.twig */
class __TwigTemplate_0a575e0455bc3b869e491ec5484a8478788de52685e7a46b4b33a649db16c967 extends \Twig\Template
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

<div class=\"card__info-user\">
  ";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_image", [], "any", false, false, true, 4), 4, $this->source), "html", null, true);
        echo "
  <h2 class=\"card__info-user--name\">
    ";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_name"] ?? null), 6, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_name_extra"] ?? null), 6, $this->source), "html", null, true);
        echo "
  </h2>

  <div class=\"card__info-user--about\">
    <div class=\"card__info-user--about-job\">";
        // line 10
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_function", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
        echo "</div>
    <div class=\"card__info-user--about-organization\">";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_organization", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
        echo "</div>
    <div class=\"card__info-user--about-address\">
      ";
        // line 13
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 13, $this->source), "field_profile_first_name", "field_profile_last_name", "field_profile_image", "field_profile_function", "field_profile_organization", "flag_follow_user", "followers", "following"), "html", null, true);
        echo "
    </div>
  </div>
</div>

";
        // line 18
        if ((twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "followers", [], "any", false, false, true, 18) || twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "following", [], "any", false, false, true, 18))) {
            // line 19
            echo "  <div class=\"follow-user--counter\">
    ";
            // line 20
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "followers", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
            echo "
    ";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "following", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo "
  </div>
";
        }
        // line 24
        echo "
";
        // line 25
        if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "flag_follow_user", [], "any", false, false, true, 25)) {
            // line 26
            echo "  <div class=\"follow-user-wrapper\">
    ";
            // line 27
            if (($context["following_enabled"] ?? null)) {
                // line 28
                echo "      ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "flag_follow_user", [], "any", false, false, true, 28), 28, $this->source), "html", null, true);
                echo "
    ";
            }
            // line 30
            echo "    ";
            if ((($context["profile_contact_label"] ?? null) == "private_message")) {
                // line 31
                echo "      <div class=\"hero-footer__cta\">
        <a href=\"";
                // line 32
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_contact_url"] ?? null), 32, $this->source), "html", null, true);
                echo "\" class=\"btn btn-default\">
          ";
                // line 33
                echo t("Message", array());
                // line 34
                echo "        </a>
      </div>
    ";
            } elseif (            // line 36
($context["profile_edit_url"] ?? null)) {
                // line 37
                echo "      <div class=\"hero-footer__cta card__link\">
        <a href=\"";
                // line 38
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_edit_url"] ?? null), 38, $this->source), "html", null, true);
                echo "\" title=\"";
                echo t("Edit profile information", array());
                echo "\" class=\"btn btn-default\">
          ";
                // line 39
                echo t("Edit profile", array());
                // line 40
                echo "        </a>
      </div>
    ";
            }
            // line 43
            echo "  </div>
";
        } else {
            // line 45
            echo "  <div class=\"card__counter\">
    <ul>
      <li>
        <span class=\"card__counter-quantity\">";
            // line 48
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_events"] ?? null), 48, $this->source), "html", null, true);
            echo "</span>
        <span class=\"card__counter-text\">";
            // line 49
            echo \Drupal::translation()->formatPlural(abs(($context["profile_events"] ?? null)), "event", "events", array());
            echo "</span>
      </li>
      <li>
        <span class=\"card__counter-quantity\">";
            // line 52
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_topics"] ?? null), 52, $this->source), "html", null, true);
            echo "</span>
        <span class=\"card__counter-text\">";
            // line 53
            echo \Drupal::translation()->formatPlural(abs(($context["profile_topics"] ?? null)), "topic", "topics", array());
            echo "</span>
      </li>
      <li>
        <span class=\"card__counter-quantity\">";
            // line 56
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_groups"] ?? null), 56, $this->source), "html", null, true);
            echo "</span>
        <span class=\"card__counter-text\">";
            // line 57
            echo \Drupal::translation()->formatPlural(abs(($context["profile_groups"] ?? null)), "group", "groups", array());
            echo "</span>
      </li>
    </ul>
  </div>

  ";
            // line 62
            if ((($context["profile_contact_label"] ?? null) == "private_message")) {
                // line 63
                echo "    <div class=\"hero-footer__cta\">
      <a href=\"";
                // line 64
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_contact_url"] ?? null), 64, $this->source), "html", null, true);
                echo "\" class=\"btn btn-accent\">
        ";
                // line 65
                echo t("Private message", array());
                // line 66
                echo "      </a>
    </div>
  ";
            } elseif (            // line 68
($context["profile_edit_url"] ?? null)) {
                // line 69
                echo "    <div class=\"hero-footer__cta card__link\">
      <a href=\"";
                // line 70
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_edit_url"] ?? null), 70, $this->source), "html", null, true);
                echo "\" title=\"";
                echo t("Edit profile information", array());
                echo "\" class=\"btn btn-default\">
        ";
                // line 71
                echo t("Edit profile", array());
                // line 72
                echo "      </a>
    </div>
  ";
            }
            // line 75
            echo "
  ";
            // line 76
            if (($context["profile_info_url"] ?? null)) {
                // line 77
                echo "    <footer class=\"card__actionbar\">
      <a href=\"";
                // line 78
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["profile_info_url"] ?? null), 78, $this->source), "html", null, true);
                echo "\" class=\"card__link\">
        ";
                // line 79
                echo t("See full profile", array());
                // line 80
                echo "      </a>
    </footer>
  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialblue/templates/profile/profile--profile--statistic.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 80,  227 => 79,  223 => 78,  220 => 77,  218 => 76,  215 => 75,  210 => 72,  208 => 71,  202 => 70,  199 => 69,  197 => 68,  193 => 66,  191 => 65,  187 => 64,  184 => 63,  182 => 62,  174 => 57,  170 => 56,  164 => 53,  160 => 52,  154 => 49,  150 => 48,  145 => 45,  141 => 43,  136 => 40,  134 => 39,  128 => 38,  125 => 37,  123 => 36,  119 => 34,  117 => 33,  113 => 32,  110 => 31,  107 => 30,  101 => 28,  99 => 27,  96 => 26,  94 => 25,  91 => 24,  85 => 21,  81 => 20,  78 => 19,  76 => 18,  68 => 13,  63 => 11,  59 => 10,  50 => 6,  45 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialblue/templates/profile/profile--profile--statistic.html.twig", "/app/web/themes/contrib/socialblue/templates/profile/profile--profile--statistic.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 18, "trans" => 33);
        static $filters = array("escape" => 1, "without" => 13);
        static $functions = array("attach_library" => 1);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape', 'without'],
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
