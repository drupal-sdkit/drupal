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

/* themes/contrib/socialbase/templates/node/node-add-list.html.twig */
class __TwigTemplate_ba5c7d33a40cb9036b4984df0c72cad52827d056781ff9f1c27be810d19cf446 extends \Twig\Template
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
        // line 18
        echo "<div class=\"card\">
  <div class=\"card__block\">

    ";
        // line 21
        if ( !twig_test_empty(($context["types"] ?? null))) {
            // line 22
            echo "
      ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["types"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                // line 24
                echo "        <dl class=\"list-item list-item--withlabel\">
          <dt class=\"list-item__label\"><span class=\"btn btn-flat\">";
                // line 25
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["type"], "add_link", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
                echo "</span></dt>
          <dd class=\"list-item__text\">";
                // line 26
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["type"], "description", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
                echo "</dd>
        </dl>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
            echo "
    ";
        } else {
            // line 31
            echo "      <div class=\"list-item\">
        ";
            // line 32
            $context["create_content"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("node.type_add");
            // line 33
            echo "          ";
            echo t("You have not created any content types yet. Go to the <a href=\"@create_content\">content type creation page</a> to add a new content type.", array("@create_content" =>             // line 34
($context["create_content"] ?? null), ));
            // line 36
            echo "      </div>
    ";
        }
        // line 38
        echo "  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/socialbase/templates/node/node-add-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 38,  82 => 36,  80 => 34,  78 => 33,  76 => 32,  73 => 31,  69 => 29,  60 => 26,  56 => 25,  53 => 24,  49 => 23,  46 => 22,  44 => 21,  39 => 18,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/socialbase/templates/node/node-add-list.html.twig", "/app/web/themes/contrib/socialbase/templates/node/node-add-list.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 21, "for" => 23, "set" => 32, "trans" => 33);
        static $filters = array("escape" => 25);
        static $functions = array("path" => 32);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set', 'trans'],
                ['escape'],
                ['path']
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
