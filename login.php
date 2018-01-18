<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("inc/head.php"); ?>
        <link href="css/default.css" rel="stylesheet" media="screen" />
    </head>
    <body>
        <?php require("inc/menuTrigger.php") ?>
        <?php require("inc/menu.php") ?>
        <div id="colophon"></div>
        <div id="content" class="animate">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="panelTitle" id="login">Effettua login</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form class="form">
                            <div class="form-group">
                                <p>Usa il tuo account per accedere all'area riservata ai compilatori</p>
                                <input type="email" class="form-control" name="email" placeholder="Inserisci la tua email" required >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Inserisci la tua password" required >
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit">entra</button>
                                <button class="btn btn-danger" type="button" name"lostPwd" >password dimenticata</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <p>Connettiti utilizzando uno dei seguenti account social</p>
                        </div>
                        <div class="">
                            <div id="fb-root"></div>
                            <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-scope="email"></div>
                        </div>
                        <div class="">

                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 policyTrigger">
                        <label><span class="glyphicon glyphicon-info-sign"></span> Note sulle connessioni tramite profilo social</label>
                        <div class="policySlide">
                            <ol>
                                <li>Scegli il social con cui connetterti, la prima volta ti verrà richiesto il permesso di poter accedere alla tua email utilizzata per il profilo scelto</li>
                                <li>alla prima connessione tramite profilo social, e dopo aver dato il permesso di poter utilizzare la tua mail per l'accesso, ti verrà inviata una password alla mail di riferimento. Email e password verranno salvate in un database e potranno essere utilizzate come alternativa di connessione al profilo social</li>
                                <li>Se preferisci, puoi creare un account per il sito "AsSaggi di letteratura" compilando il form sottostante. Il sistema ti invierà una mail con una password temporanea.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form name="crea">
                        <div class="col-xs-12"><h2 class="panelTitle" id="crea">Crea account</h2></div>
                        <div class="col-md-6">
                            <div class="" id="serviceTerm">
                                <p>La mail inserita verrà utilizzata esclusivamente per l'accesso alle aree riservate del sito, non verrà in nessun modo divulgata o ceduta a terzi per nessuno scopo.</p>
                                <p>Il nostro staff assicura, inoltre, che la mail non verrà utilizzata per inviare pubblicità.</p>
                                <p>Al momento della creazione del nuovo account, il sistema genererà una password che verrà inviata all'indirizzo utilizzato per la registrazione</p>
                                <p>I dati inseriti verranno salvati all'interno di un database e verranno cancellati nel momento in cui deciderai di eliminare il tuo account.</p>
                            </div>
                            <div class="form-group" style="margin-top:10px;">
                                <input type="checkbox" id="accetta" value="1" required >
                                <label for="accetta">Ok, ho capito</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inserisci una mail valida</label>
                                <input class="form-control" type="email" name="newUsr" placeholder="email" required >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="newUsrBtn">Invia email e crea account</button>
                            </div>
                            <label class="newUsrOut"></label>
                        </div>
                    </form>
                </div>
                <input type='button' value='Logout' onclick='Logout();'/>
            </div>
        </div>
        <?php require("inc/lib.php"); ?>
        <script type="text/javascript">
            ['load', 'orientationchange'].map(function(e) { window.addEventListener(e, colophon); });
            $(document).ready(function(){
                initLogin();
                $(".policyTrigger").on('click', function(){
                    $(".policySlide").slideToggle('fast');
                });
            });
        </script>
    </body>
</html>
