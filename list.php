<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("inc/head.php"); ?>
        <link href="css/default.css" rel="stylesheet" media="screen" />
        <style media="screen">

        </style>
    </head>
    <body>
        <?php require("inc/menuTrigger.php") ?>
        <?php require("inc/menu.php") ?>
        <div id="colophon"></div>
        <div id="content" class="animate">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="title">As<span>Saggi</span></h1>
                        <h2 class="subtitle">Leggere saggi</h2>
                    </div>
                </div>
                <div class="row section">
                    <h3>Sfoglia catalogo per <strong>"<span><?php echo $_GET['filter'] ?></span>"</strong></h3>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <ul id="lista" class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
        <?php require("inc/lib.php"); ?>
        <script type="text/javascript">
            ['load', 'orientationchange'].map(function(e) { window.addEventListener(e, colophon); });
            filter = '<?php echo $_GET['filter']; ?>';
            $(document).ready(function(){
                $.ajax({
                    url: 'connector/connect.list.php',
                    type: 'POST',
                    data: {func:filter},
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $.each(data, function(k,v){
                            imgUrl = "img/copertine/"+v.copertina;
                            ul = $("#lista");
                            li = $("<li/>",{class:'list-group-item'}).appendTo(ul);
                            imgDiv = $("<div/>",{class:'col-xs-3'}).appendTo(li);
                            datiDiv = $("<div/>",{class:'col-xs-9'}).appendTo(li);
                            $("<div/>",{class:'clearfix'}).appendTo(li);
                            $("<img/>",{class:'img-responsive',height:"100px", src:imgUrl}).appendTo(imgDiv);
                            $("<label/>",{class:'titolo'}).text(v.titolo).appendTo(datiDiv);
                        });
                    }
                });

            });
        </script>
    </body>
</html>
