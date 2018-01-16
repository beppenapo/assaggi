//login **********************************************************************//
window.fbAsyncInit = function() {
    FB.init({appId:'1930576337262566', cookie:true, xfbml:true, version:'v2.11'});
    FB.AppEvents.logPageView();
    FB.getLoginStatus(function(response) { statusChangeCallback(response); });
};
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.11&appId=1930576337262566';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response) {
    console.log(response);
    if (response.status === 'connected') {getUsrInfo();}
    else if (response.status === 'not_authorized') {console.log('Please log into this app.');}
    else {console.log('Please log into Facebook.');}
}
function getUsrInfo(){
    FB.api('/me',{locale: 'it_IT', fields: 'email, first_name, last_name,id' }, function(response) {
        console.log(response);
    });
    //window.location.href="index.php";
}
function Logout(){ FB.logout(function(){document.location.reload();});}


//****************************************************************************//

function windowSize(){
    width = window.innerWidth;
    height = window.innerHeight;
    return {"w":width,"h":height}
}
function getSize(el){
    w = document.getElementById(el).offsetWidth;
    h = document.getElementById(el).offsetHeight;
    return {"w":w,"h":h}
}

function colophon(){
    colophonSize = getSize('colophon');
    citazioni = [
        {
            "testo":"I libri servono a capire e a capirsi, e a creare un universo comune anche in persone lontanissime.",
            "autore":"Susanna Tamaro",
            "img":"img/banner/01.banner.jpg"
        },
        {
            "testo":"Poche cose impressionano davvero un lettore quanto il primo libro capace di toccargli davvero il cuore.",
            "autore":"Carlos Ruiz Zafòn",
            "img":"img/banner/02.banner.jpg"
        },
        {
            "testo":"C'è una Bibbia su quello scaffale laggiù. Ma la tengo vicina a Voltaire: veleno ed antidoto.",
            "autore":"Bertrand Russel",
            "img":"img/banner/03.banner.jpg"
        },
        {
            "testo":"Quanto vano è il mettersi seduti a scrivere quando non ci si è posti eretti a vivere.",
            "autore":"Henry David Thoreau",
            "img":"img/banner/04.banner.jpg"
        },
        {
            "testo":"I libri sono un'assicurazione sulla vita, una piccola anticipazione di immortalità. All'indietro anziché in avanti.",
            "autore":"Umberto Eco",
            "img":"img/banner/05.banner.jpg"
        },
        {
            "testo":"Non leggete, come fanno i bambini, per divertirvi, o, come gli ambiziosi, per istruirvi. No, leggete per vivere.",
            "autore":"Gustave Flaubert",
            "img":"img/banner/06.banner.jpg"
        },
        {
            "testo":"Forse non ci sono giorni della nostra adolescenza vissuti con altrettanta pienezza di quelli che abbiamo creduto di trascorrere senza averli vissuti, quelli passati in compagnia del libro prediletto.",
            "autore":"Marcel Proust",
            "img":"img/banner/07.banner.jpg"
        },
        {
            "testo":"Ci sono crimini peggior del bruciare libri. Uno di questi è non leggerli.",
            "autore":"Joseph Brodsky",
            "img":"img/banner/08.banner.jpg"
        },
        {
            "testo":"Io credo soltanto nella parola. La parola ferisce, la parola convince, la parola placa. Questo, per me, è il senso dello scrivere.",
            "autore":"Ennio Flaiano",
            "img":"img/banner/09.banner.jpg"
        },{
            "testo":"Il bene di un libro sta nell'essere letto",
            "autore":"Umberto Eco",
            "img":"img/banner/10.banner.jpg"
        }
    ];
    $.each(citazioni, function( key, val ){
        div = $("<div />").css("background-image","url('"+val.img+"')");
        innerDiv = $("<div />").appendTo(div);
        testo = $("<p />").text('"'+val.testo+'"').appendTo(innerDiv);
        autore = $("<p />",{class:'author'}).text(val.autore).appendTo(innerDiv);
        div.appendTo("#colophon");
    });
    $('#colophon').fadeSlideShow({
        PlayPauseElement: false
        ,NextElement: false
        ,PrevElement: false
        ,ListElement: false
        ,width:colophonSize.w
        ,height:colophonSize.h
        ,interval: 5000
    });
}
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
                            section = $("<div/>",{class:'col-xs-12 cognome'}).attr('data-cognome',v.lista).appendTo(lista);
                            $("<label/>",{class:'titleSection',text:v.lista}).appendTo(section);
                        });
                    }
                });
            }
            function triggerAuthFilter(val){
                div = $("#filtriDel").html('');
                label = $("<button/>",{type:'button', class:'btn btn-default', text:'Filtra autori che iniziano con la lettera "'+val+'"'}).prop('disabled',true);
                delBtn = $("<button/>",{type:'button',name:'resetFilter',class:'btn btn-danger', text:'annulla filtro'}).on('click',function(){resetAuthFilter();});
                div.append(label,delBtn);
                $("div.cognome").hide();
                $("[data-cognome='"+val+"']").show();
            }
            function buildAuth(data){
                setFilterAuth();
                wrapSize = document.getElementsByClassName('wrapAuthor').offsetWidth;
                $.ajax({
                    url: 'connector/connect.list.php',
                    type: 'POST',
                    data: {func:'autori'},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(k,v){
                            auth = (!v.nome || v.nome == null) ? v.cognome : v.nome+' '+v.cognome;
                            pos = v.cognome.toUpperCase().substr(0,1);
                            wrap = $("<div/>",{class:'wrapAuthor'}).appendTo("[data-cognome='"+pos+"']");
                            $("<img/>",{class:'img-responsive img-circle', src:"img/autori/"+v.picture}).width(wrapSize).height(wrapSize).appendTo(wrap);
                            $("<label/>",{text:auth}).appendTo(wrap);
                            
                        });
                    }
                });

            }
            function getAuthInfo(auth){
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
                $("div.cognome").show();
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
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({container:"body",trigger:"hover focus"});
    wSize = windowSize();
    footer = getSize('footer');
    if (wSize.w<1200) {$("#colophon").css("height",wSize.h-150); }
    if (wSize.w>1199) {
        $("#menu").addClass('menuOpened');
        $("#content").addClass('contentOpened');
        menuClass = 'menuOpened menuClosed';
        contentClass = 'contentOpened contentClosed';
        $(".btnMenu").on('click', function(){ $("#content").toggleClass(contentClass); });
    }else {
        menuClass = 'menuOpened';
    }
    $("#menu>nav").css("height",wSize.h-footer.h-60);
    $(".btnMenu").on('click', function(){$("#menu").toggleClass(menuClass);});
    $(".toolbar a").click(function() {
        var targetDiv = $(this).attr('href');
        $('html, body').animate({ scrollTop: $(targetDiv).offset().top}, 2000, 'easeOutCubic');
    });
});
