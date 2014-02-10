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
            flg=$('#flag').attr('value');
            $.post("./delete.php",{word:txt,flag:flg},function(result){
            });
            $(this).parent().hide();
            });
        });
        </script>
    </head>
    <body>
    <div id="flag" value="<?php echo $crtFlag; ?>"></div>
    <form name="forma" method="post">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='./word.php?flag=myword'>->ViewMy</a> <a href='./word.php?flag=sysword'>->ViewSys</a> </br>

    &nbsp;&nbsp;&nbsp;  Add:<input  class="input-large search-query" "type="text" name='wordAdd'> </br>
    Search:<input class="input-large search-query" type="text" name='wordSearch'> </br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input class="input-large search-query"  type="submit" value='Go !' name='submit'>
    </form>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['wordAdd']) && strlen($_POST['wordAdd'])) {
        echo $postResult;
    } elseif (isset($_POST['wordSearch']) && strlen($_POST['wordSearch'])) {
        foreach ($searchResult as $k => $v) {
            echo '<div class="word"><h2>'.$v.'</h2></div>';
        }
    }
} else {
        foreach ($wordList as $k => $v) {
            echo '<span class="word"> <span  style="width:200px;display:-moz-inline-box;display:inline-block;" class="tip"> <h2>'.$v.'</h2></span><span class="delete">X</span></span><br>';
        }
}

?>

    </body>
</html>
