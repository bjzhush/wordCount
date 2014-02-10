<?php

include('config.php');

$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_dbname);
if ($mysqli->connect_errno) {
    exit('Connect to mysql error');
}
$crtFlag = $_POST['flag'];
$delete = $_POST['word'];
$delete = trim(strip_tags($delete));


$resCheck = $mysqli->query(sprintf('select * from totallist where op_name = "%s"',$crtFlag));
$row = $resCheck->fetch_assoc();
$wordList = json_decode($row['op_value'], TRUE);
$wordList = array_flip($wordList);
if (isset($wordList[$delete])) {
    unset($wordList[$delete]);
}
$wordList = array_flip($wordList);
$jsonValue = json_encode($wordList);
$mysqli->query(sprintf("update totallist set op_value = '%s' where op_name = '%s'", $jsonValue, $crtFlag ));
echo 'ok';
