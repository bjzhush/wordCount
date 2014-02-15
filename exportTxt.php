<?php

include('config.php');



$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_dbname);
if ($mysqli->connect_errno) {
    exit('Connect to mysql error');
}

$resCheck = $mysqli->query('select * from totallist where op_name = "totalcount"');
$row = $resCheck->fetch_assoc();
$wordList = json_decode($row['op_value'], TRUE);

include('exportTxt.tpl');
