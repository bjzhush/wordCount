<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> 词频分析器</title>

        <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
         
        <script type="text/javascript" src="./js/jquery-1.8.3.min.js" charset="UTF-8"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('#toggle').click(function(){
                $('.num').toggle();
            })
        });
        </script>
    </head>
    <body>
    <button id="toggle">Toggle</button><br>
<?php
    $arrSort = array();
    foreach ($wordList as $k => $v) {
        if (isset($arrSort[$v])) {
            array_push($arrSort[$v], $k);
        } else {
            $arrSort[$v] = array($k);
        }
    }
    krsort($arrSort);
    foreach ($arrSort as $k => $v) {
            foreach ($v as $kb => $vb) {
                echo $vb.'&nbsp;&nbsp;&nbsp;&nbsp;<span class="num">'.$k.'</span><br>';
            }
    }

?>
    </body>
</html>
