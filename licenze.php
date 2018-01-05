<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("inc/head.php"); ?>
        <link href="css/default.css" rel="stylesheet" media="screen" />
        <style media="screen">
            .section h4,.section h5{font-weight: bold;}
            .section h4{text-align: center;}
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
                        <h1 class="title">LICENZE</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="list-group" id="indice"></div>
                        </div>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <h3 class="sectionTitle" id="1">Codice sorgente</h3>
                        <p>Il codice sorgente del presente sito è distribuito con licenza Affero GPL.</p>
                        <p>Il codice è disponibile su GitHub.</p>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <h3 class="sectionTitle" id="2">Database</h3>
                        <p>Il Database "asSaggi" è reso disponibile con licenza Open Data Commons Open Database.</p>
                        <p>Per le licenze sui contenuti del database si veda la sezione sottostante.</p>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <h3 class="sectionTitle" id="3">Metadati dei record estratti dal database</h3>
                        <p>I dati alfanumerici (testi) estratti dal database, che compongono il set di metadati associato ad ogni record, sono distribuiti con licenza Creative Commons Attribuzione - Condividi allo stesso modo 4.0 Internazionale (CC-BY-SA).</p>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-xs-12">
                        <h3 class="sectionTitle" id="4">Testo, immagini e contenuti multimediali</h3>
                        <p>Alcune immagini, foto o elementi multimediali presenti nel sito potrebbero essere soggetti alla legge sul diritto d'autore pertanto ogni utilizzo, riproduzione o modifica è soggetta a tale legge.<br>Per tutti i contenuti protetti da copyright è specificata il tipo di licenza e il soggetto titolare dei diritti</p>
                        <p>Tutti i contenuti (testo, immagini, foto, video, audio) per i quali non è specificato il tipo di licenza si intendono distribuiti con licenza libera, nello specifico Creative Commons CC0, quindi sono da ritenersi apparteneneti al Pubblico Dominio</p>
                    </div>
                </div>
            </div>
        </div>
        <?php require("inc/lib.php"); ?>
        <script type="text/javascript">
            ['load', 'orientationchange'].map(function(e) { window.addEventListener(e, colophon); });
            $(document).ready(function(){
                $(".sectionTitle").each(function(){
                    url = $(this).attr('id');
                    txt = $(this).text();
                    $("<a/>",{class:'list-group-item',href:'#'+url}).text(txt).appendTo("#indice");
                });
            });
        </script>
    </body>
</html>
