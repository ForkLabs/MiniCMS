<?php require(PROTECT);

$html_div_open = "<div class='";
$html_div_closeClass = "'>";
$html_div_close = "</div>";
define('ERROR_FATAL_OPEN', $html_div_open . 'FATALERROR' . $html_div_closeClass );
define('ERROR_FATAL_CLOSE', $html_div_close);
define('FATAL_ERROR_OPEN', $html_div_open . 'FATALERROR' . $html_div_closeClass );
define('FATAL_ERROR_CLOSE', $html_div_close);