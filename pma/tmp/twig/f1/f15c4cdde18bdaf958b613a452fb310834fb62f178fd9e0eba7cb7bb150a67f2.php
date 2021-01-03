<?php

/* database/search/results.twig */
class __TwigTemplate_e2dc633a381faed1ee59f74b04803f6695ca519d1c1b4cf7f42bd96eb9dd30b0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<table class=\"data\">
    <caption class=\"tblHeaders\">
        ";
        // line 3
        echo sprintf("Search results for \"<em>%s</em>\" %s:",         // line 4
($context["criteria_search_string"] ?? null),         // line 5
($context["search_type_description"] ?? null));
        // line 6
        echo "
    </caption>
    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 9
            echo "        <tr class=\"noclick\">
            <td>
                ";
            // line 11
            ob_start();
            // line 12
            echo "                    ";
            echo _ngettext("%1\$s match in <strong>%2\$s</strong>", "%1\$s matches in <strong>%2\$s</strong>", abs($this->getAttribute(            // line 14
$context["row"], "result_count", [])));
            // line 17
            echo "                ";
            $context["result_message"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 18
            echo "                ";
            echo sprintf(($context["result_message"] ?? null), $this->getAttribute($context["row"], "result_count", []), $this->getAttribute($context["row"], "table", []));
            echo "
            </td>
            ";
            // line 20
            if (($this->getAttribute($context["row"], "result_count", []) > 0)) {
                // line 21
                echo "                ";
                $context["url_params"] = ["db" =>                 // line 22
($context["db"] ?? null), "table" => $this->getAttribute(                // line 23
$context["row"], "table", []), "goto" => "db_sql.php", "pos" => 0, "is_js_confirmed" => 0];
                // line 28
                echo "                <td>
                    <a name=\"browse_search\"
                        class=\"ajax browse_results\"
                        href=\"sql.php";
                // line 31
                echo PhpMyAdmin\Url::getCommon(($context["url_params"] ?? null));
                echo "\"
                        data-browse-sql=\"";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["row"], "new_search_sqls", []), "select_columns", []), "html", null, true);
                echo "\"
                        data-table-name=\"";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "table", []), "html", null, true);
                echo "\">
                        ";
                // line 34
                echo _gettext("Browse");
                // line 35
                echo "                    </a>
                </td>
                <td>
                    <a name=\"delete_search\"
                        class=\"ajax delete_results\"
                        href=\"sql.php";
                // line 40
                echo PhpMyAdmin\Url::getCommon(($context["url_params"] ?? null));
                echo "\"
                        data-delete-sql=\"";
                // line 41
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["row"], "new_search_sqls", []), "delete", []), "html", null, true);
                echo "\"
                        data-table-name=\"";
                // line 42
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "table", []), "html", null, true);
                echo "\">
                        ";
                // line 43
                echo _gettext("Delete");
                // line 44
                echo "                    </a>
                </td>
            ";
            } else {
                // line 47
                echo "                <td></td>
                <td></td>
            ";
            }
            // line 50
            echo "        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "</table>

";
        // line 54
        if ((twig_length_filter($this->env, ($context["criteria_tables"] ?? null)) > 1)) {
            // line 55
            echo "    <p>
        ";
            // line 56
            echo strtr(_ngettext("<strong>Total:</strong> <em>%count%</em> match", "<strong>Total:</strong> <em>%count%</em> matches", abs(            // line 58
($context["result_total"] ?? null))), array("%count%" => abs(($context["result_total"] ?? null)), "%count%" => abs(($context["result_total"] ?? null)), ));
            // line 61
            echo "    </p>
";
        }
    }

    public function getTemplateName()
    {
        return "database/search/results.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 61,  128 => 58,  127 => 56,  124 => 55,  122 => 54,  118 => 52,  111 => 50,  106 => 47,  101 => 44,  99 => 43,  95 => 42,  91 => 41,  87 => 40,  80 => 35,  78 => 34,  74 => 33,  70 => 32,  66 => 31,  61 => 28,  59 => 23,  58 => 22,  56 => 21,  54 => 20,  48 => 18,  45 => 17,  43 => 14,  41 => 12,  39 => 11,  35 => 9,  31 => 8,  27 => 6,  25 => 5,  24 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/search/results.twig", "/var/www/html/pma/templates/database/search/results.twig");
    }
}
