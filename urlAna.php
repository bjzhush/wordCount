<?php

include('function.php');
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

$arrPond = wordParse($htmlSource);


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
echo json_encode($arrPond);exit;

$timeEnd = microtime();

$timeCost = $timeEnd-$timeStart;
$memUse = round(memory_get_usage()/1048576,2);

include('template.tpl');
