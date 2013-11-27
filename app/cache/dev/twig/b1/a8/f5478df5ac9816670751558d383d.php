<?php

/* AcmeHelloBundle:Default:map.html.twig */
class __TwigTemplate_b1a8f5478df5ac9816670751558d383d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html >
  <head>
    <meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\" />
    <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\"/>
    <title>PHP/MySQL & Google Maps Example</title>
    <script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?sensor=false\"></script>
    <script type=\"text/javascript\" src=\"src/Acme/HelloBundle/Resources/public/js/javascript.js\"></script>
  </head>

  <body onload=\"load()\">
    <div id=\"map\" style=\"width: 800px; height: 500px; border: solid 1px;\" ></div>
\t
\t";
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "address"));
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            // line 14
            echo "\t";
            echo twig_escape_filter($this->env, $this->getContext($context, "a"), "html", null, true);
            echo "
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 16
        echo "  </body>

</html>";
    }

    public function getTemplateName()
    {
        return "AcmeHelloBundle:Default:map.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 16,  37 => 14,  33 => 13,  19 => 1,);
    }
}
