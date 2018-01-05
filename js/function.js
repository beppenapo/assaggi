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
        $(".btnMenu").on('click', function(){
            $("#content").toggleClass(contentClass);
        });
    }else {
        menuClass = 'menuOpened';
    }
    $("#menu>nav").css("height",wSize.h-footer.h-60);
    $(".btnMenu").on('click', function(){$("#menu").toggleClass(menuClass);});
    $(".toolbar a").click(function() {
        var targetDiv = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(targetDiv).offset().top
        }, 2000, 'easeOutCubic');
    });
});
