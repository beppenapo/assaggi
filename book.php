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
        <input type="hidden" name="book" value="<?php echo $_GET['book']; ?>">
        <div id="colophon"></div>
        <div id="content" class="animate">
            <div class="container" id="popoverContainer">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="title">As<span>Saggi</span></h1>
                        <h2 class="subtitle">Leggere saggi</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="titolo"></h2>
                        <h3 class="autore"></h3>
                        <div class="descrizione"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php require("inc/lib.php"); ?>
        <script type="text/javascript">
            book = $("[name=book]").val();
            initBookPage(book);
        </script>
    </body>
</html>
