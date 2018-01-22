//login **********************************************************************//
function initLogin(){
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
}

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
    $.ajax({
        url: 'connector/connect.list.php',
        type: 'POST',
        data: {func:'colophon'},
        dataType: 'json',
        success: function(data){
            $.each(data, function( key, val ){
                div = $("<div />").css("background-image","url('img/banner/"+val.img+"')");
                innerDiv = $("<div />").appendTo(div);
                testo = $("<p />").text('"'+val.testo+'"').appendTo(innerDiv);
                autore = $("<p />",{class:'author'}).text(val.autore).appendTo(innerDiv);
                div.appendTo("#colophon");
            });
            $('#colophon').fadeSlideShow({PlayPauseElement: false,NextElement: false,PrevElement: false,ListElement: false,width:colophonSize.w,height:colophonSize.h,interval: 5000});
        }
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
function fetchAuthBook(el){
    content = $("<div/>",{class:'list-group'}).css({"margin-bottom":"0px"});
    $.ajax({
        url: 'connector/connect.list.php',
        type: 'POST',
        data: {func:'authBook',id:el.data('auth')},
        dataType: 'json',
        success: function(data){
            console.log(data);
            $.each(data, function(k,v){
                $("<a/>",{href:"book.php?book="+v.id, text:v.titolo, class:'list-group-item pop'}).appendTo(content);
            });
        }
    });
    el.popover({container:'#content', html:true, content:content, trigger:'focus',placement:'right'}).popover('show');
    $(".popover-content").css({"max-height":"300px","overflow":"auto","padding":"0px"});
    $("body").on('click', function(e){ if (!el.is(e.target) && el.has(e.target).length === 0){el.popover('hide');}});
    //$("#content").on('scroll', function(){el.popover('hide');});
}
function buildAuth(){
    setFilterAuth();
    $.ajax({
        url: 'connector/connect.list.php',
        type: 'POST',
        data: {func:'autori'},
        dataType: 'json',
        success: function(data){
            $.each(data, function(k,v){
                auth = (!v.nome || v.nome == null) ? v.cognome : v.nome+' '+v.cognome;
                pos = v.cognome.toUpperCase().substr(0,1);
                src = (v.picture.indexOf("http") >= 0) ? v.picture : "img/autori/"+v.picture;
                wrap = $("<div/>",{class:'wrapAuthor animate', title:'libri recensiti'})
                    .attr("data-auth",v.id)
                    .appendTo("[data-cognome='"+pos+"']")
                    .on('click', function(){ fetchAuthBook($(this)); });
                wrapSize = parseInt(wrap.css('width')) - 20;
                $("<div/>",{class:'imgWrap'}).width(wrapSize).height(wrapSize).css({"background-image":"url('"+src+"')"}).appendTo(wrap);
                $("<label/>",{text:auth}).appendTo(wrap);

            });
        }
    });
}
function getAuthInfo(id,auth){
    api = 'https://it.wikipedia.org/w/api.php';
    obj=[];
    $.ajax({
        url: api,
        data:{action:'query',format:'json',formatversion:2,prop:'pageimages|pageterms',piprop:'thumbnail',pithumbsize:600,titles:auth},
        dataType: 'jsonp',
        async: false,
        success: function (result) {
            //img = result.query.pages[0].thumbnail ? result.query.pages[0].thumbnail : 'null';
            if(result.hasOwnProperty('thumbnail')){ img=result.query.pages[0].thumbnail.source; }else {img='null'; }
            obj.push({auth:id,img:result.query.pages[0].thumbnail.source});
            //obj=result.query.pages[0].thumbnail.source;
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
