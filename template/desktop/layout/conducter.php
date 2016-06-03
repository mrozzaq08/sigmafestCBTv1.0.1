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
$sess_level = $this->session->userdata('e113snay_level');
$idsiswa    = $this->session->userdata('e113snay_id_siswa');
$sess_sid   = $this->session->userdata('e113snay_session_id');
$userdata   = $this->db->where(array('id_siswa' => $idsiswa));
$userdata   = $this->db->get('siswa')->row_array();
if(!empty($sess_level) && !empty($sess_sid)) {
$setapp   = $this->main_model->get_pengaturan();	
$detector = new Mobile_Detect;
ob_start('minify');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta charset="utf-8" />
            <title><?php if($title) { echo $title; } ?> - <?php echo $userdata['nama_lengkap'];?></title>

            <meta name="description" content="" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
            <link href="<?php echo base_url();?>foto/favicon/<?php echo $setapp->favicon;?>" rel="shortcut icon"/>
            <?php $this->assets->display('conducter_desktop','css'); ?>
	</head>
        <script>
        var waktunya;
        waktunya = <?php echo $detik; ?>;
        var waktu;
        var jalan = 0;
        var habis = 0;
        function init(){
            checkCookie();
            mulai();
        }
        function keluar(){
            if(habis==0){
                setCookie('waktux',waktu,365);
            } else {
                setCookie('waktux',0,-1);
            }
        }
        function mulai(){
            jam = Math.floor(waktu/3600);
            sisa = waktu%3600;
            menit = Math.floor(sisa/60);
            sisa2 = sisa%60;
            detik = sisa2%60;
            if(detik<10){
                detikx = "0"+detik;
            }else{
                detikx = detik;
            }
            if(menit<10){
                menitx = "0"+menit;
            }else{
                menitx = menit;
            }
            if(jam<10){
                jamx = "0"+jam;
            }else{
                jamx = jam;
            }
            document.getElementById("left-time").innerHTML = jamx+" : "+menitx+" : "+detikx;
            waktu --;
            if(waktu>0){
                t = setTimeout("mulai()",1000);
                jalan = 1;
            }else{
                if(jalan==1){
                    clearTimeout(t);
                }
                habis = 1;
                document.getElementById("e-form").submit();
            }
        }
        function selesai(){    
            if(jalan==1){
                    clearTimeout(t);
                }
            habis = 1;
            document.getElementById("e-form").submit();
        }
        function getCookie(c_name){
            if (document.cookie.length>0){
                c_start=document.cookie.indexOf(c_name + "=");
                if (c_start!=-1){
                    c_start=c_start + c_name.length+1;
                    c_end=document.cookie.indexOf(";",c_start);
                    if (c_end==-1) { c_end=document.cookie.length; }
                    return unescape(document.cookie.substring(c_start,c_end));
                }
            }
            return "";
        }

        function setCookie(c_name,value,expiredays){
            var exdate=new Date();
            exdate.setDate(exdate.getDate()+expiredays);
            document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
        }

        function checkCookie(){
            waktuy=getCookie('waktux');
            if (waktuy!=null && waktuy!=""){
                waktu = waktuy;
            }else{
                waktu = waktunya;
                setCookie('waktux',waktunya,7);
            }
        }

        </script>

        <body class="no-skin" oncontextmenu="return false" onload="init();">
		<div id="navbar" class="navbar navbar-default navbar-collapse">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small style="text-transform: uppercase">
							<?php //echo $setapp->nama_sekolah;?>
						</small>
					</a>


					<button style="background: none" class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>
                            <div class="navbar-header pull-right collapse navbar-collapse" role="navigation">
                                <p style="margin-top: 10px; color: #f0f0f0;"><i class="fa fa-user"></i> &nbsp;Selamat mengerjakan <?php echo $userdata['nama_lengkap'];?></p>
				</div>
                            <div class="navbar-header pull-right collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
					</ul>
				</div>

                            </div>
							
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar navbar-collapse collapse">
                            <script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

                                <div class="sidebar-shortcuts" id="sidebar-shortcuts" style="background: #f0f0f0; border-bottom: 1px solid #d5d5d5">
                                    <h4><span id="left-time"></span></h4>
				</div><!-- /.sidebar-shortcuts -->
                                <div class="area-no-soal">
                                <?php foreach($assigned_soal[0] as $key1135 => $soal){
                                    if($key1135 == '1') {
                                        $activesoal = 'soal-aktif';
                                    } else {
                                        $activesoal = '';
                                    }
                                    ?>
                                <a class="nomor-soal <?php echo $activesoal;?>" id="nsoal<?php echo $key1135;?>" title="Klik untuk melihat soal nomor <?php echo $key1135+1;?>"
                                      onclick="javascript:tampilkan_soal('<?php echo $key1135;?>');"><?php echo $key1135+1;?></a>
                                <?php } ?>
                                </div>
                                <ul class="nav nav-list main-menu">

                                   
                                        
                                        <li class="open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-info-circle"></i>

							<span class="menu-text">
                                                            Keterangan
                                                        </span>
                                                </a>

						
						<ul class="submenu">
							<li class="">
								<a>
									<i class="menu-icon fa fa-caret-right"></i>
									Soal belum terjawab
                                                                        <span class="pull-right label label-important" style="margin-right: 10px;">&nbsp;&nbsp;</span>
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
								<a>
									<i class="menu-icon fa fa-caret-right"></i>
									Soal sudah terjawab
                                                                        <span class="pull-right label label-success" style="margin-right: 10px;">&nbsp;&nbsp;</span>
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
								<a>
									<i class="menu-icon fa fa-caret-right"></i>
									Soal yang meragukan
                                                                        <span class="pull-right label label-yellow" style="margin-right: 10px;">&nbsp;&nbsp;</span>
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
								<a>
									<i class="menu-icon fa fa-caret-right"></i>
									Soal belum terbaca
                                                                        <span class="pull-right label label-light" style="margin-right: 10px;">&nbsp;&nbsp;</span>
								</a>

								<b class="arrow"></b>
							</li>
                                                        
						</ul>
					</li>
                                        
                                        <li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-eye blue"></i>

							<span class="menu-text">
								Peserta
							</span>
                                                </a>

						
						<ul class="submenu">
							<li class="">
								<a>
									<i class="menu-icon fa fa-caret-right"></i>
									
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					
				

					
					
				</ul><!-- /.nav-list -->



				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
                                
<!--                                <div class="e-copy">
                                    &copy; 2016. Powered by <span class="blue">Ibeesnay</span>
                                </div>-->

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
			</div>
			<div class="main-content" style="margin-left: 280px;">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
                                            <div title="Warna indikator hijau menandakan penyimpanan berhasil dan merah gagal." class="indikator-simpan" id="indikator-simpan-2"></div>
                                            <div title="Warna indikator hijau menandakan penyimpanan berhasil dan merah gagal." class="indikator-simpan" id="indikator-simpan-1"></div>

                                            <script type="text/javascript">
                                                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                            </script>	
					</div>

                                    
					<div class="page-content">
<!--						<div class="page-header">
                                                    <h1>&nbsp;</h1>
						</div> /.page-header -->

						<div class="row">
							<div class="col-xs-12" id="load-konten">
								<!-- PAGE CONTENT BEGINS -->
                                                                <?php echo $load_contents; ?>
								<!-- PAGE CONTENT ENDS -->
                                                                <div id="bottom-menu" class="modal aside" data-fixed="true" data-placement="bottom" data-background="true" tabindex="-1">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-body container">
                                <div class="row">
                                        <div class="col-sm-7 white">
                                                <h3 class="lighter">Apakah anda yakin ?</h3>
                                                Pastikan semua soal atau pertanyaan sudah di jawab dengan benar, klik tombol simpan untuk mengakhiri dan tombol batal untuk tetap lanjut mengerjakan.
                                        </div>
                                    <div class="col-sm-5 text-center">

                                                &nbsp;&nbsp;
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-app btn-light no-radius pull-right" href="#">
                                                        <i class="ace-icon fa fa-undo bigger-230"></i>
                                                        Batal
                                                </button>

                                                <button onclick="javascript:submit_form_e();" type="submit" name="final_submit" style="margin-right: 10px;" class="btn btn-info btn-app no-radius pull-right">
                                                        <i class="ace-icon fa fa-save bigger-230"></i>
                                                        Simpan
                                                </button>
                                                &nbsp; &nbsp;&nbsp; &nbsp;


                                        </div>

                                </div>
                        </div>
                </div><!-- /.modal-content -->

                <button title="Klik untuk konfirmasi simpan jawaban" class="btn btn-info btn-app btn-xs ace-settings-btn aside-trigger" data-target="#bottom-menu" data-toggle="modal" type="button">
                        <i data-icon2="fa-chevron-down" data-icon1="fa-chevron-up" class="fa fa-save bigger-130 icon-only"></i>
                </button>
        </div><!-- /.modal-dialog -->
</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->


			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
     <!-- basic scripts -->
<!--[if !IE]> -->
<script src="<?php echo base_url();?>assets/js/jquery/jquery.2.1.1.min.js"></script>
<script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery/jquery.min.js'>"+"<"+"/script>");
</script>
<!-- <![endif]-->
<!--[if IE]>
<script src="<?php echo base_url();?>assets/js/jquery/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/plugins/mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<?php $this->assets->display('conducter_desktop','js'); ?>
		<!-- inline scripts related to this page -->
                <script type="text/javascript">
			jQuery(function($) {
				$('.modal.aside').ace_aside();
				$('#aside-inside-modal').addClass('aside').ace_aside({container: '#my-modal > .modal-dialog'});
				$(document).one('ajaxloadstart.page', function(e) {
					$('.modal.aside').remove();
					$(window).off('.aside')
				});
                                
                                $('.nomor-soal').on('click', function() {
                                    $(this).css({"color":"skyblue","font-weight":"bold","border":"1px solid skyblue"});
                                });
			});
		</script>
        <script src="<?php echo base_url();?>assets/js/php/fn.conducter.php"></script>
	</body>
</html>
<?php
ob_end_flush();
} else {
    redirect('login');
}
