<?php
/**
 * Prints a htmltag, plus optional content with endtag
 *
 * @param string $t1    tagname, attributes
 * @param string $cont  optional content, triggers a $t1 endtag
 *
 * @return void
 */
function tt(string $t1, string $cont = '')
{
    $t2 = '';
    if ($cont != '') {
        $t2 = '</' . $t1 . '>';
    }
    echo '<' . $t1 . '>' . $cont . $t2;
}
