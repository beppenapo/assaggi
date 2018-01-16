<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("inc/head.php"); ?>
        <link href="css/default.css" rel="stylesheet" media="screen" />
        <style media="screen">
            #filtri{margin-bottom:10px;}
            #filtriDel>button:first-child{margin-right: 20px;}
            .cognome{position:relative; font-size:20px;padding:5px 0px;margin:5px 0px;border-bottom:.5px solid #636300; text-align:center;}
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
            function setFilterAuth(){
                btnGroup = $("<div/>",{class:'btn-group'}).attr('data-toggle','buttons').appendTo("#filtri");
                $.ajax({
                    url: 'connector/connect.list.php',
                    type: 'POST',
                    data: {func:'filtroAutore'},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(k,v){
                            label = $("<label/>",{class:'btn btn-default', text:v.lista}).appendTo(btnGroup);
                            $("<input/>",{type:'radio',name:'filtro'})
                                .val(v.lista)
                                .appendTo(label)
                                .on('change', function(){triggerAuthFilter(v.lista);});
                            $("<div/>",{class:'col-xs-12 cognome',text:v.lista}).attr('data-cognome',v.lista).appendTo(lista);
                        });
                    }
                });
            }
            function triggerAuthFilter(val){
                div = $("#filtriDel").html('');
                label = $("<button/>",{type:'button', class:'btn btn-default', text:'Filtra autori che iniziano con la lettera "'+val+'"'}).prop('disabled',true);
                delBtn = $("<button/>",{type:'button',name:'resetFilter',class:'btn btn-danger', text:'annulla filtro'}).on('click',function(){resetAuthFilter();});
                div.append(label,delBtn);
                btn = $("input[name='filtro']");
            }
            function buildAuth(data){
                setFilterAuth();
                $.ajax({
                    url: 'connector/connect.list.php',
                    type: 'POST',
                    data: {func:'autori'},
                    dataType: 'json',
                    success: function(data){
                        //console.log(data);
                        $.each(data, function(k,v){
                            auth = v.nome+' '+v.cognome;
                            wrap = $("<div/>").appendTo(lista);
                            api = 'https://it.wikipedia.org/w/api.php';
                            $.ajax({
                                url: api,
                                data:{action:'query',format:'json',formatversion:2,prop:'pageimages|pageterms',piprop:'thumbnail',pithumbsize:600,titles:auth},
                                dataType: 'jsonp',
                                success: function (x) {
                                    img = x.query.pages[0].thumbnail.source;
                                    $("<img/>",{class:'img-responsive img-circle', src:img}).appendTo(wrap);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    console.log(thrownError);
                                }
                            });
                            $("<label/>",{text:auth}).appendTo(wrap);
                        });
                    }
                });

            }
            function getAuthInfo(handle, auth){
                var img='';
                api = 'https://it.wikipedia.org/w/api.php';
                $.ajax({
                    url: api,
                    data:{action:'query',format:'json',formatversion:2,prop:'pageimages|pageterms',piprop:'thumbnail',pithumbsize:600,titles:auth},
                    dataType: 'jsonp',
                    async: false,
                    success: function (x) {
                        handle(x.query.pages[0].thumbnail.source);
                    }
                });
            }

            function resetAuthFilter(){
                $("#filtriDel").html('');
                $("input[name='filtro']").prop('checked',false).parent('label').removeClass('active');
            }
            function buildTitle(){
                $.ajax({
                    url: 'connector/connect.list.php',
                    type: 'POST',
                    data: {func:'lista'},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(k,v){
                            imgUrl = "img/copertine/"+v.copertina;
                            //ul = $("#lista");
                            li = $("<li/>",{class:'list-group-item'}).appendTo(lista);
                            imgDiv = $("<div/>",{class:'col-xs-3'}).appendTo(li);
                            datiDiv = $("<div/>",{class:'col-xs-9'}).appendTo(li);
                            $("<div/>",{class:'clearfix'}).appendTo(li);
                            $("<img/>",{class:'img-responsive',height:"100px", src:imgUrl}).appendTo(imgDiv);
                            $("<label/>",{class:'titolo'}).text(v.titolo).appendTo(datiDiv);
                        });
                    }
                });
            }
        </script>
    </body>
</html>
