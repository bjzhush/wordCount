<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> 词频分析器</title>

        <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
         
        <script type="text/javascript" src="./js/jquery-1.8.3.min.js" charset="UTF-8"></script>
        <script type="text/javascript" src="./js/bootstrap.min.js"></script>
        <script type="text/javascript">

    
    </script>
    </head>
    <body>
    <div align="center">

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div id="errorInfo">
                    <font color="#ff0000">
                    <?php
                    echo $errorInfo;
                    ?>
                    </font>
                    </div>
                    <form class="form-search" action="" method="post">
                        URL:<input class="input-large search-query" name="url" type="text" /><button class="btn" type="submit">分析</button>
                    </form>
                    <ul class="unstyled" contenteditable="true">
                        <?php
                        if (isset($timeCost)) {
                        echo 'url      : '.$url.' <br>';
                        echo 'timeCost : '.$timeCost.' S<br>';
                        echo 'memUse   : '.$memUse.' Mb<br>';
                        echo '<br><br>';
                        }
                        if (isset($arrCount)) {
                            foreach($arrCount as $ka => $va) {
                                foreach ($va as $kb => $vb) {
                                    echo $ka.'   '.$vb.'<Br>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    </body>
</html>
