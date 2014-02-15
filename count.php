<?php

include('config.php');

if(isset($_GET['sort'])) {
    if(!in_array($_GET['sort'], array('count'))) {
        exit('Bad sort parameter');
    } else {
        $sortMethod = 'count';
    }
}




$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_dbname);
if ($mysqli->connect_errno) {
    exit('Connect to mysql error');
}

$resCheck = $mysqli->query('select * from totallist where op_name = "totalcount"');
$row = $resCheck->fetch_assoc();
$wordList = json_decode($row['op_value'], TRUE);


$resCheck = $mysqli->query('select * from totallist where op_name = "myword"');
$row = $resCheck->fetch_assoc();
$myWord = json_decode($row['op_value'], TRUE);

$resCheck = $mysqli->query('select * from totallist where op_name = "sysword"');
$row = $resCheck->fetch_assoc();
$sysWord = json_decode($row['op_value'], TRUE);

foreach ($myWord as $k => $v) {
    if (isset($wordList[$v])) {
        unset($wordList[$v]);
    }
}

foreach ($sysWord as $k => $v) {
    if (isset($wordList[$v])) {
        unset($wordList[$v]);
    }
}

if (isset($sortMethod)) {
    $newList = array();
    foreach ($wordList as $k => $v ) {
        if (isset($newList[$v])) {
            array_push($newList[$v], $k);
        } else {
            $newList[$v] = array($k);
        }
    }
    krsort($newList);
} else {
    krsort($wordList);
}

include('showNewWord.tpl');
