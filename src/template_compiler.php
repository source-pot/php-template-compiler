<?php
/*

This is the main entry point to the template compiler.

*/

echo 'hello';

$in = __DIR__ . '/../demo/template.tpl';
$out = __DIR__ . '/../demo/compiled/template.php';

$in_contents = file_get_contents( $in );

