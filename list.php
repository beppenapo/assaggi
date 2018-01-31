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
                    <div id="filtri"></div>
                    <div id="filtriDel"></div>
                </div>
                <div class="row section">
                    <div class="col-xs-12" id="lista"></div>
                </div>
            </div>
        </div>
        <?php require("inc/lib.php"); ?>
        <script type="text/javascript">
            ['load', 'orientationchange'].map(function(e) { window.addEventListener(e, colophon); });
            filter = '<?php echo $_GET['filter']; ?>';
            lista = $("#lista");
            if (filter == 'autore') {buildAuth();}
            else if (filter == 'titolo') {buildTitle();}
            else if (filter == 'immagini') {buildImg();}

        </script>
    </body>
</html>
