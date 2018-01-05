<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("inc/head.php"); ?>
        <link href="css/default.css" rel="stylesheet" media="screen" />
        <style media="screen">
            .copertine-list>a{display:inline-block;}
            .copertine-list>a>img{width:auto;height:180px;}
            .tag-list>a{padding: 1px 3px; margin: 3px 3px; border-radius: 4px; border: 1px solid #636300; background: #fff; display: inline-block;}
            .tag-list>a:hover{background: #636300;color:#fff;}
            .tag-list>a>span{margin-right:10px;}
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
                    <div class="col-md-6">
                        <div id="lastBook" class="panel panel-default">
                            <div class="panel-heading"><h3>Ultimi libri aggiunti</h3></div>
                            <div class="list-group"></div>
                            <div class="panel-footer"><a href="list.php?filter=title">Sfoglia catalogo per titolo</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="lastAuthor" class="panel panel-default">
                            <div class="panel-heading"><h3>Autori suggeriti</h3></div>
                            <div class="list-group"></div>
                            <div class="panel-footer"><a href="list.php?filter=author">Sfoglia catalogo per autore</a></div>
                        </div>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <div id="copertine" class="panel panel-default">
                            <div class="panel-heading"><h3>Copertine random</h3></div>
                            <div class="copertine-list"></div>
                            <div class="panel-footer"><a href="list.php?filter=cover">Sfoglia catalogo per immagini</a></div>
                        </div>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <div id="tags" class="panel panel-default">
                            <div class="panel-heading"><h3>Tag cloud</h3></div>
                            <div class="tag-list"></div>
                        </div>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <img src="img/loghi/socialCloud.png" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-12">
                        <h3 class="sectionTitle">Just another blog from the net?</h3>
                    </div>
                    <div class="col-xs-12">
                        <p>Parafrasando il titolo di un <a href="https://open.spotify.com/album/4Rh8oiYfe5hcQfXVl5CTHv" title="ascolta con Spotify" target="_blank">album di Frank Zappa</a> ci siamo chiesti se la rete aveva davvero bisogno di un altro blog di letteratura; ma se sei qui forse è perché ti ha incuriosito il titolo, forse perché soffri di sindrome ossessiva-compulsiva verso tutto ciò che riguarda i libri e dovevi sapere di cosa si occupa questo blog. Forse sei capitato su uno dei nostri social e ti è piaciuta l'idea.</p>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12 imgInline">
                        <img src="img/usr/beppe.png" class="img-responsive img-circle" alt="" width="100px">
                        <img src="img/usr/christian.png" class="img-responsive img-circle" alt="" width="100px">
                        <img src="img/usr/ilaria.png" class="img-responsive img-circle" alt="" width="100px">
                    </div>
                    <div class="col-xs-12">
                        <h3 class="sectionTitle">Ok, ora però spiegami cosa siete</h3>
                    </div>
                    <div class="col-xs-12">
                        <p>Lo scopo di questo blog, e dei profili social collegati, è quello di far conoscere, divulgare, discutere, informare o semplicemente parlare di libri...e nello specifico di saggi.</p>
                        <p>Questo tipo di lettura è spesso vista come una cosa noiosa, difficile, per "esperti" dell'argomento, ma non è così...almeno non sempre!</p>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <img src="img/loghi/booksComment.png" class="img-responsive" alt="">
                        <small><a href="https://upload.wikimedia.org/wikipedia/commons/a/af/Joseph_Reagle_speaks_about_his_book_Reading_the_Comments.jpg" target="_blank">Immagine originale</a></small>
                    </div>
                    <div class="col-xs-12">
                        <h3 class="sectionTitle">Come funziona questo blog?</h3>
                    </div>
                    <div class="col-xs-12">
                        <p>Semplice: cerca, leggi le recensioni degli utenti, commenta qui o sui nostri canali social.</p>
                        <p>Se la cosa ti incuriosisce crea un account e scrivi la recensione di un saggio che ti è piaciuto e che senti di consigliare agli altri.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php require("inc/lib.php"); ?>
        <script type="text/javascript">
            ['load', 'orientationchange'].map(function(e) { window.addEventListener(e, colophon); });
            $(document).ready(function(){
                $.ajax({
                    url: 'connector/connect.index.php',
                    type: 'POST',
                    dataType: 'json',
                    success: function(data){
                        book = data[0];
                        author = data[1];
                        cover = data[2];
                        tag = data[3];
                        $.each(book, function(k,v){
                            $("<a/>",{href:'libro.php?book='+v.id,class:'list-group-item',text:v.titolo}).appendTo("#lastBook>.list-group");
                        });
                        $.each(author, function(k,v){
                            $("<a/>",{href:'author.php?auth='+v.id,class:'list-group-item',text:v.autore}).appendTo("#lastAuthor>.list-group");
                        });
                        $.each(cover, function(k,v){
                            link = $("<a/>",{href:'libro.php?book='+v.id}).appendTo("#copertine>.copertine-list");
                            $('<img/>', {src:'img/copertine/'+v.copertina,class:'img-responsive img-thumbnail'}).appendTo(link);
                        });
                        $.each(tag, function(k,v){
                            link = $("<a/>",{href:'list.php?filter=tag&value='+v.tag}).appendTo("#tags>.tag-list");
                            $("<span/>",{text:v.tag}).appendTo(link);
                            $("<i/>",{class:'fas fa-tag'}).appendTo(link);
                        });
                    }
                });
            });
        </script>
    </body>
</html>
