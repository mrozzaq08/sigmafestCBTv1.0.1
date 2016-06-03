<?php
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
header('Content-Type: text/javascript; charset=UTF-8');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
$server_addr = $_SERVER['HTTP_HOST'];
$base_url = (!empty($_SERVER['HTTPs']) ? 'https' : 'http').'://'.$server_addr
            .substr($_SERVER['SCRIPT_NAME'],
            0, strpos($_SERVER['SCRIPT_NAME'],
            basename($_SERVER['SCRIPT_FILENAME'])));
$base_url = str_replace("assets/js/php/","",$base_url);
?>
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
var base_url = "<?php echo $base_url;?>";
$(function() {
    var History = window.History;
    if(!History.enabled) {
        return false;
    }
    var	State = History.getState();
    History.Adapter.bind(window,'statechange',function(){
        var State = History.getState(); 
        $.ajax({
            url:State.url,
            error:function(msg){
                $("#error-page").modal("show");
            },
            success:function(msg){
                $('#loading').remove();
                $("#loadingbar").remove();
                $('#konten-ajax').html($(msg).find('#konten-ajax').html());
                $('#konten-ajax').fadeIn(500);
                $('html, body').delay(500).animate({scrollTop:0}, 1000);
                loader();
                load_editor();
                selectCheck();
                $('body a[href]').click(function(e){
                    if (!$(this).attr('target') ){
                        var cururl = $(this).attr('href');
                        var cekurl = cururl.search('#');
                        if ($(this).attr('href')!== window.location.hash){
                            e.preventDefault();
                            $("#loading").remove();
                            $("#loadingbar").remove();
                            var href = $(e.target).closest('a').attr('href');
                            if (href !== undefined && !(href.match(/^#/) || href.trim() == '')) {
                                var response = $(window).triggerHandler('beforeunload', response);
                                if (response && response != "") {
                                        var msg = response + "\n\n"
                                                + "Tekan tombol OK untuk meninggalkan halaman ini dan isian data pada form tidak akan disimpan.\nAtau tombol Cancel untuk tetap berada pada halaman ini.";
                                        if (!confirm(msg)) {
                                                return false;
                                        }
                                }
                                if (cekurl == 0 || cekurl === null || cururl == State.url){
                                    $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                                    History.pushState(State.data, "COMBAT ID", this);
                                    return;
                                } else {
                                    $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                                    //$('#konten-ajax').append('<div id="loading" class="blackMask" onContextMenu="return false"><div class="popupVCenter"><div class="popup"><div class="spinner"></div><strong style="color: #777; font-size: 14px;">LOADING</strong>&nbsp;&nbsp;&nbsp;<img style="margin-bottom: 3px;" width="15" src="<?php echo $base_url;?>assets/images/2d_4.gif"></div></div></div>');
                                    History.pushState(State.data, "COMBAT ID", this);
                                }
                                return false;
                            }
                            
                        }
                    }
                });
            }
        });
    });

    $('body a[href]').click(function(e){
        if (!$(this).attr('target') ){
            var cururl = $(this).attr('href');
            var cekurl = cururl.search('#');
            if ($(this).attr('href')!== window.location.hash){
                e.preventDefault();
                $("#loading").remove();
                $("#loadingbar").remove();
                var href = $(e.target).closest('a').attr('href');
                if (href !== undefined && !(href.match(/^#/) || href.trim() == '')) {
                    var response = $(window).triggerHandler('beforeunload', response);
                    if (response && response != "") {
                            var msg = response + "\n\n"
                                    + "Tekan tombol OK untuk meninggalkan halaman ini dan isian data pada form tidak akan disimpan.\nAtau tombol Cancel untuk tetap berada pada halaman ini.";
                            if (!confirm(msg)) {
                                    return false;
                            }
                    }
                    if (cekurl == 0 || cekurl === null || cururl == State.url){
                        $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                        History.pushState(State.data, "COMBAT ID", this);
                        return;
                    } else {
                        $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                        //$('#konten-ajax').append('<div id="loading" class="blackMask" onContextMenu="return false"><div class="popupVCenter"><div class="popup"><div class="spinner"></div><strong style="color: #777; font-size: 14px;">LOADING</strong>&nbsp;&nbsp;&nbsp;<img style="margin-bottom: 3px;" width="15" src="<?php echo $base_url;?>assets/images/2d_4.gif"></div></div></div>');
                        History.pushState(State.data, "COMBAT ID", this);
                    }
                    $('ul.menu-utama').find('li').removeClass('active');
                    $('ul.navbar-nav').find('li').removeClass('active');
                    $(this).parents('li').addClass('active');
                    return false;
                }
            }
        }
        
    });
});
        