<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig */
class __TwigTemplate_111fe2757f192ca03dd35c4926ba8096 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 62
        $context["classes"] = ["node", ("node--type-" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source,         // line 64
($context["node"] ?? null), "bundle", [], "any", false, false, true, 64))), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 65
($context["node"] ?? null), "isPromoted", [], "method", false, false, true, 65)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("node--promoted") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 66
($context["node"] ?? null), "isSticky", [], "method", false, false, true, 66)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("node--sticky") : ("")), (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source,         // line 67
($context["node"] ?? null), "isPublished", [], "method", false, false, true, 67)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("node--unpublished") : ("")), (((($tmp =         // line 68
($context["view_mode"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("node--view-mode-" . \Drupal\Component\Utility\Html::getClass(($context["view_mode"] ?? null)))) : (""))];
        // line 71
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("umami/classy.node"), "html", null, true);
        yield "

";
        // line 73
        $context["read_more"] = ('' === $tmp = implode('', iterator_to_array((function () use (&$context, $macros, $blocks) {
            // line 74
            yield t("View @node.type.entity.label", ["@node.type.entity.label" => $this->env->getExtension(\Drupal\Core\Template\TwigExtension::class)->renderVar(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "type", [], "any", false, false, true, 74), "entity", [], "any", false, false, true, 74), "label", [], "method", false, false, true, 74)), ]);
            yield from [];
        })(), false))) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 76
        yield "
";
        // line 77
        yield from $this->load("core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", 77, 658856260)->unwrap()->yield(CoreExtension::toArray(["attributes" => CoreExtension::getAttribute($this->env, $this->source,         // line 78
($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 78), "content" =>         // line 79
($context["content"] ?? null), "content_attributes" =>         // line 80
($context["content_attributes"] ?? null), "label" =>         // line 81
($context["label"] ?? null), "title_attributes" =>         // line 82
($context["title_attributes"] ?? null), "title_prefix" =>         // line 83
($context["title_prefix"] ?? null), "title_suffix" =>         // line 84
($context["title_suffix"] ?? null), "read_more" =>         // line 85
($context["read_more"] ?? null), "url" =>         // line 86
($context["url"] ?? null)]));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["node", "view_mode", "attributes", "content", "content_attributes", "label", "title_attributes", "title_prefix", "title_suffix", "url"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  74 => 86,  73 => 85,  72 => 84,  71 => 83,  70 => 82,  69 => 81,  68 => 80,  67 => 79,  66 => 78,  65 => 77,  62 => 76,  58 => 74,  56 => 73,  51 => 71,  49 => 68,  48 => 67,  47 => 66,  46 => 65,  45 => 64,  44 => 62,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", "C:\\Users\\khumb\\Github\\bluevine\\drupal\\sample_project\\sample\\web\\core\\profiles\\demo_umami\\themes\\umami\\templates\\content\\node--card-common.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 62, "trans" => 74, "embed" => 77];
        static $filters = ["clean_class" => 64, "escape" => 71];
        static $functions = ["attach_library" => 71];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans', 'embed'],
                ['clean_class', 'escape'],
                ['attach_library'],
                $this->source
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


/* core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig */
class __TwigTemplate_111fe2757f192ca03dd35c4926ba8096___658856260 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 77
        return "umami:card";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("umami:card", 77);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["title_attributes", "label", "content", "title_prefix", "title_suffix", "read_more", "url", "content_attributes"]);    }

    // line 88
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 89
        yield "    ";
        yield from $this->load("core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", 89, 866855185)->unwrap()->yield(CoreExtension::toArray(["attributes" => CoreExtension::getAttribute($this->env, $this->source,         // line 90
($context["title_attributes"] ?? null), "addClass", ["umami-card__title"], "method", false, false, true, 90), "label" => (((($tmp =         // line 91
($context["label"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (($context["label"] ?? null)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_title", [], "any", false, false, true, 91))), "title_prefix" =>         // line 92
($context["title_prefix"] ?? null), "title_suffix" =>         // line 93
($context["title_suffix"] ?? null)]));
        // line 102
        yield "    ";
        yield from $this->load("core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", 102, 795622048)->unwrap()->yield(CoreExtension::toArray(["attributes" => $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["class" => ["umami-card__read-more"]]), "read_more" =>         // line 104
($context["read_more"] ?? null), "label" =>         // line 105
($context["label"] ?? null), "url" =>         // line 106
($context["url"] ?? null)]));
        // line 115
        yield "    <div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", ["umami-card__content"], "method", false, false, true, 115), "html", null, true);
        yield ">
      ";
        // line 116
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["content"] ?? null), "html", null, true);
        yield "
    </div>
  ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  201 => 116,  196 => 115,  194 => 106,  193 => 105,  192 => 104,  190 => 102,  188 => 93,  187 => 92,  186 => 91,  185 => 90,  183 => 89,  176 => 88,  164 => 77,  74 => 86,  73 => 85,  72 => 84,  71 => 83,  70 => 82,  69 => 81,  68 => 80,  67 => 79,  66 => 78,  65 => 77,  62 => 76,  58 => 74,  56 => 73,  51 => 71,  49 => 68,  48 => 67,  47 => 66,  46 => 65,  45 => 64,  44 => 62,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", "C:\\Users\\khumb\\Github\\bluevine\\drupal\\sample_project\\sample\\web\\core\\profiles\\demo_umami\\themes\\umami\\templates\\content\\node--card-common.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["extends" => 77, "embed" => 89];
        static $filters = ["escape" => 115];
        static $functions = ["create_attribute" => 103];

        try {
            $this->sandbox->checkSecurity(
                ['extends', 'embed'],
                ['escape'],
                ['create_attribute'],
                $this->source
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


/* core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig */
class __TwigTemplate_111fe2757f192ca03dd35c4926ba8096___866855185 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title_prefix' => [$this, 'block_title_prefix'],
            'title_suffix' => [$this, 'block_title_suffix'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 89
        return "umami:title";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("umami:title", 89);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["title_prefix", "title_suffix"]);    }

    // line 95
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title_prefix(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 96
        yield "        ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_prefix"] ?? null), "html", null, true);
        yield "
      ";
        yield from [];
    }

    // line 98
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title_suffix(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 99
        yield "        ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_suffix"] ?? null), "html", null, true);
        yield "
      ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  328 => 99,  321 => 98,  313 => 96,  306 => 95,  294 => 89,  201 => 116,  196 => 115,  194 => 106,  193 => 105,  192 => 104,  190 => 102,  188 => 93,  187 => 92,  186 => 91,  185 => 90,  183 => 89,  176 => 88,  164 => 77,  74 => 86,  73 => 85,  72 => 84,  71 => 83,  70 => 82,  69 => 81,  68 => 80,  67 => 79,  66 => 78,  65 => 77,  62 => 76,  58 => 74,  56 => 73,  51 => 71,  49 => 68,  48 => 67,  47 => 66,  46 => 65,  45 => 64,  44 => 62,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", "C:\\Users\\khumb\\Github\\bluevine\\drupal\\sample_project\\sample\\web\\core\\profiles\\demo_umami\\themes\\umami\\templates\\content\\node--card-common.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["extends" => 89];
        static $filters = ["escape" => 96];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['extends'],
                ['escape'],
                [],
                $this->source
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


/* core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig */
class __TwigTemplate_111fe2757f192ca03dd35c4926ba8096___795622048 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'a11y' => [$this, 'block_a11y'],
            'text' => [$this, 'block_text'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 102
        return "umami:read-more";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("umami:read-more", 102);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["label", "read_more"]);    }

    // line 108
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_a11y(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 109
        yield "        ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
        yield "
      ";
        yield from [];
    }

    // line 111
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_text(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 112
        yield "        ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["read_more"] ?? null), "html", null, true);
        yield "
      ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  455 => 112,  448 => 111,  440 => 109,  433 => 108,  421 => 102,  328 => 99,  321 => 98,  313 => 96,  306 => 95,  294 => 89,  201 => 116,  196 => 115,  194 => 106,  193 => 105,  192 => 104,  190 => 102,  188 => 93,  187 => 92,  186 => 91,  185 => 90,  183 => 89,  176 => 88,  164 => 77,  74 => 86,  73 => 85,  72 => 84,  71 => 83,  70 => 82,  69 => 81,  68 => 80,  67 => 79,  66 => 78,  65 => 77,  62 => 76,  58 => 74,  56 => 73,  51 => 71,  49 => 68,  48 => 67,  47 => 66,  46 => 65,  45 => 64,  44 => 62,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/profiles/demo_umami/themes/umami/templates/content/node--card-common.html.twig", "C:\\Users\\khumb\\Github\\bluevine\\drupal\\sample_project\\sample\\web\\core\\profiles\\demo_umami\\themes\\umami\\templates\\content\\node--card-common.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["extends" => 102];
        static $filters = ["escape" => 109];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['extends'],
                ['escape'],
                [],
                $this->source
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
