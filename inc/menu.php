<?php
$cc = (date('Y')==2018)?"2018":"2018 -".date('Y');
?>
<div id="menu" class="animate">
    <div class="btnMenu col-xs-12">
        <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
        <span>AsSaggi</span>
    </div>
    <div class="clearfix">

    </div>
    <!-- <header class="col-xs-12"><h3>Nutrimento per la mente</h3></header> -->
    <nav>
        <ul>
            <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> home</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-pencil"></i> autore</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-text-size"></i> titolo</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-tags"></i> genere</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-picture"></i> immagini</a></li>
            <?php if (!isset($_SESSION['id'])) { ?>
            <li><a href="login.php"><i class="glyphicon glyphicon-log-in"></i> entra</a></li>
            <?php }else{ ?>
            <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> esci</a></li>
            <?php } ?>
        </ul>
    </nav>
    <div id="footer">
        <div id="footer-ico">
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="top" title="Visita la nostra pagina Facebook"><i class="fab fa-facebook-square fa-2x"></i></a>
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="top" title="Visita il nostro profilo Twitter"><i class="fab fa-twitter-square fa-2x"></i></a>
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="top" title="Visita il nostro profilo Instagram"><i class="fab fa-instagram fa-2x"></i></a>
            <a href="#" target="_blank" data-toggle="tooltip" data-placement="top" title="Scarica il codice sorgente da GitHub"><i class="fab fa-github-square fa-2x"></i></a>
        </div>
        <div id="licenze"><small><span class="hidden-xs hidden-sm">Tranne dove diversamente specificato, i contentuti di questo sito sono distribuiti con licenza</span><a rel="license" href="https://creativecommons.org/publicdomain/zero/1.0/deed.it" target="_blank" style="display:block;" data-toggle="tooltip" data-placement="top" title="Leggi la licenza completa [link esterno]"> Creative Commons CC0</a></small></div>
        <div class="" style="text-align:center;"><small><a href="privacy.php" data-toggle="tooltip" data-placement="top" title="Leggi i termini di utilizzo e le direttive sulla privacy">Privacy</a> | <a href="licenze.php" data-toggle="tooltip" data-placement="top" title="Leggi le licenze applicate ai contenuti del sito">Licenze</a></small></div>
        <div class=""><small><i class="far fa-copyright"></i> <?php echo $cc; ?> asSaggi</small></div>
        <!-- <p xmlns:dct="http://purl.org/dc/terms/" xmlns:vcard="http://www.w3.org/2001/vcard-rdf/3.0#">
            <a rel="license" href="https://creativecommons.org/publicdomain/zero/1.0/deed.it">
                <img src="http://i.creativecommons.org/p/zero/1.0/88x31.png" style="border-style: none;" alt="CC0" />
            </a>
            <br />
            To the extent possible under law, <a rel="dct:publisher" href="http://www.assaggidiletteratura.it"><span property="dct:title">asSaggi</span></a> has waived all copyright and related or neighboring rights to <span property="dct:title">asSaggi</span>. This work is published from: <span property="vcard:Country" datatype="dct:ISO3166" content="IT" about="http://www.assaggidiletteratura.it"> Italia</span>.
        </p> -->
    </div>
</div>
