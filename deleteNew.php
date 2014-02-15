<?php
include('config.php');

$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_dbname);
if ($mysqli->connect_errno) {
    exit('Connect to mysql error');
}
$delete = $_POST['word'];
$delete = trim(strip_tags($delete));
$delete = explode('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $delete);
$delete = $delete[0];


//add to my word
$resCheck = $mysqli->query('select * from totallist where op_name = "myword"');
$row = $resCheck->fetch_assoc();
$wordList = json_decode($row['op_value'], TRUE);
if (!isset($wordList[$delete])) {
    array_push($wordList, $delete);
}
$jsonValue = json_encode($wordList);
$mysqli->query(sprintf("update totallist set op_value = '%s' where op_name = 'myword'", $jsonValue));

//remove from totalcount
$resCheck = $mysqli->query('select * from totallist where op_name = "totalcount"');
$row = $resCheck->fetch_assoc();
$wordList = json_decode($row['op_value'], TRUE);
unset($wordList[$delete]);
$jsonValue = json_encode($wordList);
$mysqli->query(sprintf("update totallist set op_value = '%s' where op_name = 'totalcount'", $jsonValue));
echo 'ok';
