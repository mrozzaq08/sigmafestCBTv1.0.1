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
                $('html, body').delay(500).animate({scrollTop:135}, 1000);
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
                                    //$("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                                    $('#konten-ajax').append('<div id="loading" class="blackMask" onContextMenu="return false"><div class="popupVCenter"><div class="popup"><div class="spinner"></div><strong style="color: #777; font-size: 14px;">LOADING</strong>&nbsp;&nbsp;&nbsp;<img style="margin-bottom: 3px;" width="15" src="<?php echo $base_url;?>assets/images/2d_4.gif"></div></div></div>');
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
                        //$("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                        $('#konten-ajax').append('<div id="loading" class="blackMask" onContextMenu="return false"><div class="popupVCenter"><div class="popup"><div class="spinner"></div><strong style="color: #777; font-size: 14px;">LOADING</strong>&nbsp;&nbsp;&nbsp;<img style="margin-bottom: 3px;" width="15" src="<?php echo $base_url;?>assets/images/2d_4.gif"></div></div></div>');
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
    
    $('#idmapel').change(function (){
	var id_mapel = $('#idmapel').val();
	var id_level = $('#idlevel').val();
	$.ajax({
            url: base_url + "bsoal/get_level_soal/" + id_mapel + "/" + id_level,
            success: function(data){	
                var output = "<select name = 'no_soal[]' id='nosoal' >";
                if(data == "0"){
                    output += "<option value = '0'>Tidak ada soal</option>";
                } else {
                    for(var i = 0; i <= data; i++){
                        output += "<option value = '"+  i +"'>";
                        output += i;
                        output += "</option>";
                    }
                }
                output += "</select>"; 
                output += '<span style="margin-top: 5px;"><small style="margin-left: 20px;">akan dimasukan ke topik ujian</small></span>';

                $("#no_bank_soal").html(output);
            },
            error: function(xhr,status,strErr){
                //alert(status);
            }	
        });
    });
});


var tipe_posisi     = "Atas";
var global_id_ujian = "0";
var global_id_soal  = "0";
var global_opos     = "0";

function movesoal(t_pos,id_ujian,id_soal,opos) {
    tipe_posisi     = t_pos;
    global_id_ujian = id_ujian;
    global_id_soal  = id_soal;
    global_opos     = opos;

    if((document.getElementById('peringatan').style.display)=="block"){
        document.getElementById('peringatan').style.display="none";
        $('body').css({"background":"none"});
    } else {
        document.getElementById('peringatan').style.display="block";
        $('body').css({"background":"#000"});
        if(tipe_posisi=="Atas"){
            var upos=parseInt(global_opos)-parseInt(1);
        } else {
            var upos=parseInt(global_opos)+parseInt(1);
        }
        document.getElementById('pos_soal').value=upos;

    }

}

function pindah_posisi(){
    var pos=document.getElementById('pos_soal').value;
    if(tipe_posisi == "Atas"){
        var npos=parseInt(global_opos)-parseInt(pos);
        window.location=base_url +"ujian/move_atas_soal/"+global_id_ujian+"/"+global_id_soal+"/"+npos;
    } else {
        var npos=parseInt(pos)-parseInt(global_opos);
        window.location= base_url +"ujian/move_bawah_soal/"+global_id_ujian+"/"+global_id_soal+"/"+npos;
    }
}

function pemilihan_soal(id_ujian,nama_ujian,batas,id_mapel){
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var showload="<br><br><br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal").html(showload);
    $.ajax({
        url: base_url + "bsoal/pilih_soal_ujian/"+id_ujian+"/"+nama_ujian+"/"+batas+"/"+id_mapel,
        success: function(data){
            $("#bank_soal").html(data);
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function search_pemilihan_soal(id_ujian,nama_ujian,batas){
    var search_type=document.getElementById('search_type').value;
    var searchval=document.getElementById('search').value;
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var showload="<br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal").html(showload);
    var formData = {search_type:search_type,search:searchval};
    $.ajax({
        type: "POST",
        data : formData,
        url: base_url + "bsoal/pilih_soal_ujian/"+id_ujian+"/"+nama_ujian+"/"+batas,
        success: function(data){
            $("#bank_soal").html(data);		
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function tutup_pemilihan(id_ujian){
    document.getElementById('bank_soal').style.display="none";
    document.getElementById('bank_soal').style.visibility="hidden";
    window.location=base_url+"ujian/bsoal/kode/"+id_ujian;
}

function tambah_soal(id_ujian,id_soal) {
    $.ajax({
        url: base_url + "ujian/tambah_soal_ujian/"+id_ujian+"/"+id_soal,
        success: function(data){
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function hapus_soal(id_ujian,id_soal){
    $.ajax({
        url: base_url + "ujian/delete_soal/"+id_ujian+"/"+id_soal,
        success: function(data){
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function soal_added(id){
    document.getElementById(id).innerHTML="<i class='fa fa-plus-circle'></i> Ditambahkan";
}

function soal_deleted(id){
    document.getElementById(id).innerHTML="<i class='fa fa-trash'></i> Dihapus";
}
