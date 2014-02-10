<?php
/**
 *  return in json format ,and status should be success or failed
 */


include('config.php');
include('function.php');
/**
 *  validate
 */
if (empty($_GET['validate']) || $_GET['validate'] != 'bjzhush') {
    exit('validate failed');

}

if (empty($_GET['url'])) {
    exit('Bad url');
}
/**
 *  bad url got
 */
if (file_get_contents($_GET['url']) === FALSE) {
    exit(json_encode(array(
                    'status' => 'failed',
                    'info'   => 'bad url '.$_GET['url'],
                    )));
}

$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_dbname);
if ($mysqli->connect_errno) {
    exit('Connect to mysql error');
}

$urlHash = md5($_GET['url']);
$resCheck = $mysqli->query(sprintf('select * from urlcount where urlhash = "%s"',$urlHash));
while ($row = $resCheck->fetch_assoc()) {
    exit(json_encode(array(
                    'status' => 'failed',
                    'info'   => 'existed url '.$_GET['url'],
                    )));
}

$htmlSource = @file_get_contents($_GET['url']);
if ($htmlSource === FALSE) {
    errorShow('url ' . $url . ' reading error');
}

$arrPond = wordParse($htmlSource);

$wordCount = json_encode($arrPond);

$sqlRecord = sprintf("insert into urlcount (url, html, urlhash, wordcount) values( '%s', '%s' , '%s', '%s')", $_GET['url'], addslashes($htmlSource), $urlHash, $wordCount);

$resRecord = $mysqli->query($sqlRecord);

if ($mysqli->error) {
    exit(json_encode(array(
                    'status' => 'failed',
                    'info'   => 'mysql error 008 : '.$mysqli->error,
                    )));
}

// add total count 
$resOriginal = $mysqli->query('select * from totallist where op_name = "totalcount"');
while ( $row = $resOriginal->fetch_array()) {
    $oriArray = json_decode($row['op_value'], TRUE);
}

foreach ($arrPond as $k => $v) {
    if (isset($oriArray[$k])) {
        $oriArray[$k] = (int)$oriArray[$k] + (int)$v;
    } else {
        $oriArray[$k] = $v;
    }
}

$resUpCount = $mysqli->query(sprintf("update totallist set op_value = '%s' where op_name = 'totalcount'", json_encode($oriArray)));
if ($mysqli->error) {
    exit(json_encode(array(
                    'status' => 'failed',
                    'info'   => 'mysql error 009 : '.$mysqli->error,
                    )));
}

exit(json_encode(array(
                'status' => 'success',
                'info'   => 'record success !',
                )));



