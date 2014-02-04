<?php
//This file contains functions that helps to clean incoming strings
//Ensures there are no tags injections

function cleanString($string)
{
    if (is_string($string)) {
        $clean1 = stripslashes($string);
        return cleanxss($clean1);
    }


}

function cleanxss($input)
{
/// Prevents XXS Attacks www.itshacked.com
    $search = array(
        '@&amp;lt;script[^&amp;gt;]*?&amp;gt;.*?&amp;lt;/script&amp;gt;@si', // Strip out javascript
        '@&amp;lt;[\/\!]*?[^&amp;lt;&amp;gt;]*?&amp;gt;@si', // Strip out HTML tags
        '@&amp;lt;style[^&amp;gt;]*?&amp;gt;.*?&amp;lt;/style&amp;gt;@siU', // Strip style tags properly
        '@&amp;lt;![\s\S]*?--[ \t\n\r]*&amp;gt;@' // Strip multi-line comments
    );

    $inputx = preg_replace($search, '', $input);
    $inputx = trim($inputx);
    if (get_magic_quotes_gpc()) {
        $inputx = stripslashes($inputx);
    }
//$inputx = mysql_real_escape_string($inputx);
    return stripHtmlXters($inputx);

}

function stripHtmlXters($input)
{
    $final = htmlspecialchars($input, ENT_QUOTES);
    return $final;
}

$arr = array_keys($_REQUEST);

for ($i = 0; $i < count($arr); ++$i) {
    $_REQUEST[$arr[$i]] = cleanString($_REQUEST[$arr[$i]]);
}