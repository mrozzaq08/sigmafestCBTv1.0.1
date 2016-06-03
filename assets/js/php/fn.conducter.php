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
var waktu_soal=0;
var terjawab = new Array();
var raguragu = new Array();
$(function(){
    if(document.getElementById('nosoal')){
        var nomorsoal = document.getElementById('nosoal').value;
        for(x=0; x <= nomorsoal; x++){
            terjawab[x]=0;
            raguragu[x]=0;
        }
    }
    
    var response = $(window).triggerHandler('beforeunload', response);
    if (response && response != "") {
        var msg = response + "\n\n"
                + "Tekan tombol OK untuk meninggalkan halaman ini namun isian data pada form tidak akan disimpan.\n\n\Atau tombol Cancel untuk tetap berada pada halaman ini.";
        if (!confirm(msg)) {
                return false;
        }
    }

});

function update_jawab(id_pilihan)
{
    var current_soal = document.getElementById('current_soal').value;
    var url=base_url+"ujian/ajax_update_jawaban/"+current_soal+"/"+id_pilihan+"";
    $.ajax({
        url: url
    });		
}	

function submit_form_e() 
{
    document.getElementById("e-form").submit();
}

function warna_soal_terjawab(){
    var csoal=document.getElementById('current_soal').value;
    var nsoal="nsoal"+csoal;
    document.getElementById(nsoal).style.background="#97c583";
    document.getElementById(nsoal).style.color="#ffffff";
    terjawab[csoal]=1;
}	

function soal_ragu(tsoal){
    var csoal=document.getElementById('current_soal').value;
    var nsoal="nsoal"+csoal;
    var cek_ragu = document.getElementById('soal_ragu_'+csoal);
    if(cek_ragu.checked == true) 
    {
        document.getElementById(nsoal).style.background="#fee496";
        document.getElementById(nsoal).style.color="#ffffff";
        document.getElementById(nsoal).style.border="1px solid #fee496";
        raguragu[csoal]=1;
    }
    else
    {
        raguragu[csoal]=0;
        tampilkan_soal(csoal,tsoal);
    }
}


function hapus_jawaban(){
    var csoal = document.getElementById('current_soal').value;
    for(var op=0; op <= 10; op++){
        var opn="pilihan-"+csoal+"-"+op;
        document.getElementById(opn).checked = false;
    }
}

function tampilkan_soal(id,type_soal){
    var cek_warna   = "0";
    var nosoal      = document.getElementById('nosoal').value;
    var csoal       = document.getElementById('current_soal').value;
    var stype       = "soal_type_"+csoal;
    var type_soal   = document.getElementById(stype).value;
	
    if(type_soal=="bs-0" && raguragu[csoal] == '0')
    {
        var s ="answers_"+csoal;
        var pil_checked = document.getElementsByName(s);
            for(var i = 0; i < pil_checked.length; i++)
            {
                if(pil_checked[i].checked)
                {
                    var nsoal="nsoal"+csoal;
                    document.getElementById(nsoal).style.background="#97c583";
                    document.getElementById(nsoal).style.color="#ffffff";
                    document.getElementById(nsoal).style.border="1px solid #97c583";
                    break;
                }
                else
                {
                    var nsoal="nsoal"+csoal;
                    document.getElementById(nsoal).style.background="#d66e5d";
                    document.getElementById(nsoal).style.color="#ffffff";
                    document.getElementById(nsoal).style.border="1px solid #d66e5d";
                }
            }	
        }
	
	
    if(type_soal=="bs-1" && raguragu[csoal] == '0')
    {
        var s ="answers_"+csoal;
        var pil_checked = document.getElementsByName(s);
            for(var i = 0; i < pil_checked.length; i++)
            {
                if(pil_checked[i].checked)
                {
                    var nsoal="nsoal"+csoal;
                    document.getElementById(nsoal).style.background="#97c583";
                    document.getElementById(nsoal).style.color="#ffffff";
                    document.getElementById(nsoal).style.border="1px solid #97c583";
                    break;
                }
                else
                {
                    var nsoal="nsoal"+csoal;
                    document.getElementById(nsoal).style.background="#d66e5d";
                    document.getElementById(nsoal).style.color="#ffffff";
                    document.getElementById(nsoal).style.border="1px solid #d66e5d";
                }
            }	
        }
	
	if(type_soal=="bs-2" && raguragu[csoal] == '0')
	{
            var s = "answers_"+csoal+"[]";
            var checkboxes = document.getElementsByName(s);
            for (var i=0, n=checkboxes.length;i<n;i++) 
            {		
                if (checkboxes[i].checked) 
                {
                      var nsoal = "nsoal"+csoal;
                      document.getElementById(nsoal).style.background="#97c583";
                      document.getElementById(nsoal).style.color="#ffffff";
                      document.getElementById(nsoal).style.border="1px solid #97c583";
                      cek_warna = '1';
                      break;
                }		  
            }
            if(cek_warna == '0'){
				var nsoal = "nsoal"+csoal;
				document.getElementById(nsoal).style.background="#d66e5d";
				document.getElementById(nsoal).style.color="#ffffff";
				document.getElementById(nsoal).style.border="1px solid #d66e5d";
            }		
	}
	
	if((type_soal=="bs-3" || type_soal=="bs-4" || type_soal=="bs-6") && raguragu[csoal] == '0')
	{				
            var s2 = "answers_"+csoal;
            var pilihan_siswa = document.getElementsByName(s2)[0].value;
            if (pilihan_siswa != '') 
            {
                var nsoal="nsoal"+csoal;
                document.getElementById(nsoal).style.background="#97c583";
                document.getElementById(nsoal).style.color="#ffffff";
                document.getElementById(nsoal).style.border="1px solid #97c583";
            } 
            else 
            {
                var nsoal="nsoal"+csoal;
                document.getElementById(nsoal).style.background="#d66e5d";
                document.getElementById(nsoal).style.color="#ffffff";
                document.getElementById(nsoal).style.border="1px solid #d66e5d";
            }

	}
	
	if(type_soal == 'bs-5' && raguragu[csoal] == '0')
	{
            var s="answers_"+csoal+"[]";
            var checkboxes = document.getElementsByName(s);
            var cek_warna="0";
            for (var i=0, n=checkboxes.length;i<n;i++) 
            {	  
                if (checkboxes[i].value != '') 
                {
                    var nsoal="nsoal"+csoal;
                    document.getElementById(nsoal).style.background="#97c583";
                    document.getElementById(nsoal).style.color="#ffffff";
                    document.getElementById(nsoal).style.border="1px solid #97c583";
                    cek_warna="1";
                    break;
                }		  
            }
            if(cek_warna == '0')
            {
                var nsoal="nsoal"+csoal;
                document.getElementById(nsoal).style.background="#d66e5d";
                document.getElementById(nsoal).style.color="#ffffff";
                document.getElementById(nsoal).style.border="1px solid #d66e5d";
            }
	}
	
	for(var x=0; x<= nosoal; x++)
	{
            var id_soal="soal_"+x;
            document.getElementById(id_soal).style.display="none";
            document.getElementById(id_soal).style.visibility="hidden";
	}
	var id_soal = "soal_"+id;
	document.getElementById(id_soal).style.display="block";
	document.getElementById(id_soal).style.visibility="visible";
	document.getElementById('current_soal').value=id;
	var eurl=base_url+"ujian/ajax_update_waktu/"+id_soal+"/"+waktu_soal+"";
	$.ajax({
		url: eurl,
                success: function(data) {
                    $('#indikator-simpan-2').css('backgroundColor','#4f1aba');
                            setTimeout(function(){
                    $('#indikator-simpan-2').css('backgroundColor','#666666');		
                            },3000);
                },
                error: function(xhr,status,strErr){
                    $('#indikator-simpan-2').css('backgroundColor','#f5ab55');
                            setTimeout(function(){
                    $('#indikator-simpan-2').css('backgroundColor','#666666');		
                            },5500);
                    alert('Error : saat mengubah waktu.\nQuery atau sambungan ke server dalam masalah.')
                }
	});
	waktu_soal=0;
}



function update_current_jawab(key,type_bsoal) {
    $('#indikator-simpan-1').css('backgroundColor','#72ed72');
            setTimeout(function(){
    $('#indikator-simpan-1').css('backgroundColor','#666666');		
            },3000);
    var id_soal = document.getElementById('current_soal').value;
	if(type_bsoal=="bs-0")
    {
        var s="answers_"+key;
        var pil_checked = document.getElementsByName(s);
        var id_pilsoal;
        for(var i = 0; i < pil_checked.length; i++)
        {
            if(pil_checked[i].checked)
            {
                id_pilsoal = pil_checked[i].value;
                var cs_ujian=document.getElementById('current_soal').value;
                cs_ujian=cs_ujian-1;
                var aurl=base_url+"ujian/ajax_update_jawaban/"+cs_ujian+"/"+id_pilsoal+"";
                $.ajax({
                    url: aurl
                });		

            }
        }		
    }
    if(type_bsoal == "bs-1")
    {
        var s="answers_"+key;
        var pil_checked = document.getElementsByName(s);
        var id_pilsoal;
        for(var i = 0; i < pil_checked.length; i++)
        {
            if(pil_checked[i].checked)
            {
                id_pilsoal = pil_checked[i].value;
                var cs_ujian=document.getElementById('current_soal').value;
                cs_ujian=cs_ujian-1;
                var aurl=base_url+"ujian/ajax_update_jawaban/"+cs_ujian+"/"+id_pilsoal+"";
                $.ajax({
                    url: aurl
                });		

            }
        }		
    }
    
    if(type_bsoal=="bs-2") {
        var s="answers_"+key+"[]";
        var checkboxes = document.getElementsByName(s);
        var vals = "";
        var first=0;
        for (var i=0, n=checkboxes.length;i<n;i++) 
        {		
            if (checkboxes[i].checked) 
            {
                if(first==0){
                    vals += checkboxes[i].value;
                    first++;
					  
                } else {
                    vals += "-"+checkboxes[i].value;			
                }
            }
        }
        
        var cs_ujian=document.getElementById('current_soal').value;
        cs_ujian=cs_ujian-1;
        //alert(cs_ujian);
        var aurl=base_url+"ujian/ajax_update_jawaban/"+cs_ujian+"/"+vals+"";
        $.ajax({
            url: aurl,
            success: function(data) {
                $('#indikator-simpan-2').css('backgroundColor','#72ed72');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },3000);
            },
            error: function(xhr,status,strErr){
                $('#indikator-simpan-2').css('backgroundColor','#fb6666');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },5500);
            }	
        });	
        //alert(vals);		
    }
	
    if(type_bsoal=="bs-3" || type_bsoal=="bs-4")
    {
        var s="isian_kosong_"+key;
        var s2="answers_"+key;
        var id_pilsoal = document.getElementsByName(s)[0].value;
        var optn_value_user = document.getElementsByName(s2)[0].value;
        var cs_ujian=document.getElementById('current_soal').value;
        cs_ujian = cs_ujian-1;
        var aurl=base_url+"ujian/ajax_update_jawaban/"+cs_ujian+"/"+id_pilsoal+"";
        $.ajax({
            url: aurl					
        });	
        
        var formData = {id_soal:id_soal,pilihan_siswa:optn_value_user,type_soal:type_bsoal};
        $.ajax({
            type: "POST",
            data : formData,
            url: base_url + "ujian/ajax_update_essay",
            success: function(data) {
                $('#indikator-simpan-2').css('backgroundColor','#72ed72');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },3000);
            },
            error: function(xhr,status,strErr){
                $('#indikator-simpan-2').css('backgroundColor','#fb6666');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },5500);
                 alert('Error : saat menyimpan jawaban.\nQuery atau sambungan ke server dalam masalah.')
            

            }
        });
    }
	
    if(type_bsoal=="bs-6")
    {		
        var s2="answers_"+key;
        var optn_value_user = document.getElementsByName(s2)[0].value;
        var formData = {id_soal:id_soal,pilihan_siswa:optn_value_user,type_soal:type_bsoal};
        $.ajax({
            type: "POST",
            data : formData,
            url: base_url + "ujian/ajax_update_essay",
            success: function(data) {
                $('#indikator-simpan-2').css('backgroundColor','#72ed72');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },3000);
            },
            error: function(xhr,status,strErr){
                $('#indikator-simpan-2').css('backgroundColor','#fb6666');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },5500);
                 alert('Error : saat menyimpan jawaban.\nQuery atau sambungan ke server dalam masalah.')
            

            }
        });	
    }

    if(type_bsoal=="bs-5")
    {	
        var s="soal_pilihan_"+key+"[]";
        var checkboxes = document.getElementsByName(s);
        var user_options="answers_"+key+"[]";
	var q_options="soal_pilihan_val_"+key+"[]";
	var correct_ans="soal_benar_"+key+"[]";
	var konten_pil_siswa = document.getElementsByName(user_options);
	var q_options_v = document.getElementsByName(q_options);
	var correct_ans = document.getElementsByName(correct_ans);
	var vals = "";
	
        for (var i=0, n=checkboxes.length;i<n;i++) 
        {		  
            if(i==0) {			  
                id_pilsoal = checkboxes[i].value;					  
            } else {
                id_pilsoal += "-"+checkboxes[i].value;			
            }
			  
        }
	var cs_ujian=document.getElementById('current_soal').value;
        cs_ujian=cs_ujian-1;
        var aurl=base_url+"ujian/ajax_update_jawaban/"+cs_ujian+"/"+id_pilsoal+"";
        $.ajax({
            url: aurl
        });	
        for (var i=0, n=konten_pil_siswa.length;i<n;i++) 
        {
            if(i==0){
                var jawaban_siswa=q_options_v[i].value+"="+konten_pil_siswa[i].value;
            } else {
                jawaban_siswa+=","+q_options_v[i].value+"="+konten_pil_siswa[i].value;
            }
        }

        var formData = {id_soal:id_soal,pilihan_siswa:jawaban_siswa,type_soal:type_bsoal};
        $.ajax({
            type: "POST",
            data : formData,
            url: base_url + "ujian/ajax_update_essay",
            success: function(data) {
                $('#indikator-simpan-2').css('backgroundColor','#72ed72');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },3000);
            },
            error: function(xhr,status,strErr){
                $('#indikator-simpan-2').css('backgroundColor','#fb6666');
                        setTimeout(function(){
                $('#indikator-simpan-2').css('backgroundColor','#666666');		
                        },5500);
                 alert('Error : saat menyimpan jawaban.\nQuery atau sambungan ke server dalam masalah.')
            }
        });
    }
}