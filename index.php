<?php
$timeStart = microtime();

function errorShow($errorInfo) {
    include('template.tpl');
    exit;
}

/**
 *  init variables
 */
$errorInfo = '';

/**
 *  show form and exit 
 */
if(count($_POST) == 0 ) {
    errorShow('no url');
}
$url = @$_POST['url'];
if (strlen($url) == 0 ) {
    errorShow('No url got');
}

$htmlSource = @file_get_contents($url);
if ($htmlSource === FALSE) {
    errorShow('url ' . $url . ' reading error');
}

/**
 *  strip html tags
 */
$stripedSource = strip_tags($htmlSource);

/**
 *  remove escape chars
 */
$stripedSource = str_replace(
        array('&gt;','&lt;','&quot;','&amp;'),
        array(' ', ' ', ' ', ' '),
        $stripedSource
        );


/**
 *  strtolower
 */
$stripedSource = strtolower($stripedSource);

/**
 *  remove non a-z - breakLine chars
 */
$stripedSource = preg_replace('/[^a-z-]/s',' ',$stripedSource);
$arrSource = explode(' ', $stripedSource);
/**
 *   arrPond  the => 3
 */
$arrPond = array();


foreach ($arrSource as $k => $v) {
    if (strlen($v) < 3) {
        // remove common word shorter than 3 chars such as a , an
        unset($arrSource[$k]);
    } else {
        if (isset($arrPond[$v])) {
            $arrPond[$v] = $arrPond[$v]+1;
        } else {
            $arrPond[$v] = 1;
        }
    }
}

/**
 *  arrCount 15=>array('test','word')
 */
$arrCount = array();
foreach ($arrPond as $k => $v) {
    if (isset($arrCount[$v])) {
        array_push($arrCount[$v], $k);
    } else {
        $arrCount[$v] = array($k);
    }
}

krsort($arrCount);

$timeEnd = microtime();

$timeCost = $timeEnd-$timeStart;
$memUse = round(memory_get_usage()/1048576,2);

include('template.tpl');
