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

/* themes/contrib/socialblue/templates/profile/profile--profile--default--sky.html.twig */
class __TwigTemplate_79d36b7773f8326dd576996b85886c06cfd5bba6e94f15e8fd2a7d7e0d40a5d5 extends \Twig\Template
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
        // line 68
        echo "
<div class=\"card\">
  <div class=\"card__body card--content-merged\">
    ";
        // line 71
        if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_self_introduction", [], "any", false, false, true, 71))) {
            // line 72
            echo "      <div class=\"card--content-merged__list\">
        <div class=\"list-item__text\">
          ";
            // line 74
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_self_introduction", [], "any", false, false, true, 74), 74, $this->source), "html", null, true);
            echo "
        </div>
      </div>
    ";
        }
        // line 78
        echo "
    ";
        // line 79
        if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_phone_number", [], "any", false, false, true, 79))) {
            // line 80
            echo "      <div class=\"list-item card--content-merged__list\">
          <div class=\"list-item__label\">";
            // line 81
            echo t("Phone", array());
            echo "</div>
          <div class=\"list-item__text\">";
            // line 82
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_phone_number", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
            echo "</div>
      </div>
    ";
        }
        // line 85
        echo "
    ";
        // line 86
        if (($context["user_mail"] ?? null)) {
            // line 87
            echo "      <div class=\"list-item card--content-merged__list\">
          <div class=\"list-item__label\">";
            // line 88
            echo t("E-mail", array());
            echo "</div>
          <div class=\"list-item__text\">";
            // line 89
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["user_mail"] ?? null), 89, $this->source), "html", null, true);
            echo "</a></div>
      </div>
    ";
        }
        // line 92
        echo "
    ";
        // line 93
        if (($context["user_lang"] ?? null)) {
            // line 94
            echo "      <div class=\"list-item card--content-merged__list\">
        <div class=\"list-item__label\">";
            // line 95
            echo t("Language", array());
            echo "</div>
        <div class=\"list-item__text\">";
            // line 96
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["user_lang"] ?? null), 96, $this->source), "html", null, true);
            echo "</a></div>
      </div>
    ";
        }
        // line 99
        echo "
    ";
        // line 100
        if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_address", [], "any", false, false, true, 100))) {
            // line 101
            echo "      <div class=\"list-item card--content-merged__list\">
          <div class=\"list-item__label\">";
            // line 102
            echo t("Address", array());
            echo "</div>
          <div class=\"list-item__text\">
              ";
            // line 104
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_address", [], "any", false, false, true, 104), 104, $this->source), "html", null, true);
            echo "
          </div>
      </div>
    ";
        }
        // line 108
        echo "
    ";
        // line 109
        if ((($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_expertise", [], "any", false, false, true, 109)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["#items"] ?? null) : null)) {
            // line 110
            echo "      <div class=\"card--content-merged__list\">
        <h5>";
            // line 111
            echo t("Expertise", array());
            echo "</h5>
        <div class=\"list-item__text\">
          ";
            // line 113
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_expertise", [], "any", false, false, true, 113)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["#items"] ?? null) : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 114
                echo "            <div class=\"badge badge--pill badge--large badge-default\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, true, 114), "label", [], "any", false, false, true, 114), 114, $this->source), "html", null, true);
                echo "</div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            echo "        </div>
      </div>
    ";
        }
        // line 119
        echo "
    ";
        // line 120
        if ((($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_interests", [], "any", false, false, true, 120)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["#items"] ?? null) : null)) {
            // line 121
            echo "      <div class=\"card--content-merged__list\">
        <h5>";
            // line 122
            echo t("Interests", array());
            echo "</h5>
        <div class=\"list-item__text\">
          ";
            // line 124
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_interests", [], "any", false, false, true, 124)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["#items"] ?? null) : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 125
                echo "            <div class=\"badge badge--pill badge--large badge-default\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, true, 125), "label", [], "any", false, false, true, 125), 125, $this->source), "html", null, true);
                echo "</div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 127
            echo "        </div>
      </div>
    ";
        }
        // line 130
        echo "
    ";
        // line 131
        if (((($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_profile_profile_tag", [], "any", false, false, true, 131)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["#items"] ?? null) : null) && ($context["profile_tagging_active"] ?? null))) {
            // line 132
            echo "      ";
            if (($context["profile_tagging_allow_split"] ?? null)) {
                // line 133
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["profile_tagging_hierarchy"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 134
                    echo "          <div class=\"card--content-merged__list\">
            <h5>";
                    // line 135
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 135), 135, $this->source), "html", null, true);
                    echo "</h5>
            <div class=\"list-item__text\">
              ";
                    // line 137
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "tags", [], "any", false, false, true, 137));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 138
                        echo "                <a href=\"";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "url", [], "any", false, false, true, 138), 138, $this->source), "html", null, true);
                        echo "\">
                  <div class=\"badge badge--pill badge--large badge-default\">";
                        // line 139
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, true, 139), 139, $this->source), "html", null, true);
                        echo "</div>
                </a>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 142
                    echo "            </div>
          </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 145
                echo "      ";
            } else {
                // line 146
                echo "        <div class=\"card--content-merged__list\">
          <h5>";
                // line 147
                echo t("Profile tags", array());
                echo "</h5>
          <div class=\"list-item__text\">
            ";
                // line 149
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["profile_tagging_hierarchy"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 150
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "tags", [], "any", false, false, true, 150));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 151
                        echo "                <a href=\"";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "url", [], "any", false, false, true, 151), 151, $this->source), "html", null, true);
                        echo "\">
                  <div class=\"badge badge--pill badge--large badge-default\">";
                        // line 152
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, true, 152), 152, $this->source), "html", null, true);
                        echo "</div>
                </a>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 155
                    echo "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 156
                echo "          </div>
        </div>
      ";
            }
            // line 159
            echo "    ";
        }
        // line 160
        echo "
    ";
        // line 161
        if (((($__internal_compile_5 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "social_tagging", [], "any", false, false, true, 161)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["#items"] ?? null) : null) && ($context["social_tagging_profile_active"] ?? null))) {
            // line 162
            echo "      ";
            if (($context["social_tagging_allow_split"] ?? null)) {
                // line 163
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["social_tagging_hierarchy"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 164
                    echo "          <div class=\"card--content-merged__list\">
            <h5>";
                    // line 165
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 165), 165, $this->source), "html", null, true);
                    echo "</h5>
            <div class=\"list-item__text\">
              ";
                    // line 167
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "tags", [], "any", false, false, true, 167));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 168
                        echo "                <a href=\"";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "url", [], "any", false, false, true, 168), 168, $this->source), "html", null, true);
                        echo "\">
                  <div class=\"badge badge--pill badge--large badge-default\">";
                        // line 169
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, true, 169), 169, $this->source), "html", null, true);
                        echo "</div>
                </a>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 172
                    echo "            </div>
          </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 175
                echo "      ";
            } else {
                // line 176
                echo "        <div class=\"card--content-merged__list\">
          <h5>";
                // line 177
                echo t("Tags", array());
                echo "</h5>
          <div class=\"list-item__text\">
            ";
                // line 179
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["social_tagging_hierarchy"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 180
                    echo "              ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "tags", [], "any", false, false, true, 180));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 181
                        echo "                <a href=\"";
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "url", [], "any", false, false, true, 181), 181, $this->source), "html", null, true);
                        echo "\">
                  <div class=\"badge badge--pill badge--large badge-default\">";
                        // line 182
                        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, true, 182), 182, $this->source), "html", null, true);
                        echo "</div>
                </a>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 185
                    echo "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 186
                echo "          </div>
        </div>
      ";
            }
            // line 189
            echo "    ";
        }
        // line 190
        echo "
    ";
        // line 191
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 191, $this->source), "field_profile_phone_number", "user_mail", "field_profile_address", "field_profile_self_introduction", "field_profile_interests", "field_profile_expertise", "field_profile_profile_tag", "field_manager_notes", "social_tagging", "user_lang"), "html", null, true);
        // line 193
        echo "

    ";
        // line 195
        if (((twig_test_empty($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(($context["content"] ?? null))) && twig_test_empty(($context["user_mail"] ?? null))) && twig_test_empty(($context["user_lang"] ?? null)))) {
            // line 196
            echo "        ";
            echo t("@profile_name @profile_name_extra has not shared profile information.", array("@profile_name" => ($context["profile_name"] ?? null), "@profile_name_extra" => ($context["profile_name_extra"] ?? null), ));
            // line 197
            echo "    ";
        }
        // line 198
        echo "
  </div>
</div>

";
        // line 202
        if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_manager_notes", [], "any", false, false, true, 202))) {
            // line 203
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_manager_notes", [], "any", false, false, true, 203), 203, $this->source), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialblue/templates/profile/profile--profile--default--sky.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  408 => 203,  406 => 202,  400 => 198,  397 => 197,  394 => 196,  392 => 195,  388 => 193,  386 => 191,  383 => 190,  380 => 189,  375 => 186,  369 => 185,  360 => 182,  355 => 181,  350 => 180,  346 => 179,  341 => 177,  338 => 176,  335 => 175,  327 => 172,  318 => 169,  313 => 168,  309 => 167,  304 => 165,  301 => 164,  296 => 163,  293 => 162,  291 => 161,  288 => 160,  285 => 159,  280 => 156,  274 => 155,  265 => 152,  260 => 151,  255 => 150,  251 => 149,  246 => 147,  243 => 146,  240 => 145,  232 => 142,  223 => 139,  218 => 138,  214 => 137,  209 => 135,  206 => 134,  201 => 133,  198 => 132,  196 => 131,  193 => 130,  188 => 127,  179 => 125,  175 => 124,  170 => 122,  167 => 121,  165 => 120,  162 => 119,  157 => 116,  148 => 114,  144 => 113,  139 => 111,  136 => 110,  134 => 109,  131 => 108,  124 => 104,  119 => 102,  116 => 101,  114 => 100,  111 => 99,  105 => 96,  101 => 95,  98 => 94,  96 => 93,  93 => 92,  87 => 89,  83 => 88,  80 => 87,  78 => 86,  75 => 85,  69 => 82,  65 => 81,  62 => 80,  60 => 79,  57 => 78,  50 => 74,  46 => 72,  44 => 71,  39 => 68,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialblue/templates/profile/profile--profile--default--sky.html.twig", "/app/web/themes/contrib/socialblue/templates/profile/profile--profile--default--sky.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 71, "trans" => 81, "for" => 113);
        static $filters = array("render" => 71, "escape" => 74, "without" => 191);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans', 'for'],
                ['render', 'escape', 'without'],
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
