<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://dict.cn/hc/" type="text/javascript"></script>
        <script type="text/javascript" src="./js/jquery-1.8.3.min.js" charset="UTF-8"></script>
        <script type="text/javascript" src="./js/bootstrap.min.js"></script>
        <script type="text/javascript" >
        $(function(){
            $(".delete").click(function(){
            txt=$(this).prev().html();
            $.post("./deleteNew.php",{word:txt},function(result){
            });
            $(this).parent().hide();
            });
        });
        </script>
    </head>
    <body>
    <a href='./count.php'>Sort By Word</a>
    <a href='./count.php?sort=count'>Sort By Count</a>
    </br>
<?php
        if (isset($newList)) {
            foreach ($newList as $k => $v) {
                foreach ($v as $kb => $vb) {
                    echo '<span class="word"> <span  style="width:200px;display:-moz-inline-box;display:inline-block;" class="tip"> <h2>'.$kb.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$vb.'</h2></span><span class="delete">X</span></span><br>';
                }
            }
        } else {
            foreach ($wordList as $k => $v) {
                echo '<span class="word"> <span  style="width:200px;display:-moz-inline-box;display:inline-block;" class="tip"> <h2>'.$k.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$v.'</h2></span><span class="delete">X</span></span><br>';
            }
        }

?>

    </body>
</html>
