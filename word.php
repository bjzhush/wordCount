<?php

include('config.php');

$flagArr = array(
        'myword' ,
        'sysword',
        );


$crtFlag = @$_GET['flag'];
if (!in_array($crtFlag, $flagArr)) {
    exit('Bad flag get');
}


$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_dbname);
if ($mysqli->connect_errno) {
    exit('Connect to mysql error');
}

$resCheck = $mysqli->query(sprintf('select * from totallist where op_name = "%s"',$crtFlag));
$row = $resCheck->fetch_assoc();
$wordList = json_decode($row['op_value'], TRUE);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['wordAdd']) && strlen($_POST['wordAdd'])) {
        if (!in_array($_POST['wordAdd'], $wordList)) {
            array_push($wordList, $_POST['wordAdd']);
        }
        $jsonValue = json_encode($wordList);
        $mysqli->query(sprintf("update totallist set op_value = '%s' where op_name = '%s'", $jsonValue, $crtFlag ));
        $postResult = 'add successfully';
    } elseif (isset($_POST['wordSearch']) && strlen($_POST['wordSearch'])) {
        $searchResult = array();
        foreach ($wordList as $k => $v) {
            if (strpos($v, $_POST['wordSearch']) !== FALSE) {
                array_push($searchResult, $v);
            }
        }
    }
} else {
}







include('showWord.tpl');
