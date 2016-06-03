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
$sess_sid   = $this->session->userdata('e113snay_session_id');
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
        <title><?php if($title) { echo $title; } ?></title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="<?php echo base_url();?>foto/favicon/<?php echo $setapp->favicon;?>"  rel="shortcut icon"  />

        <?php $this->assets->display('conducter_desktop','css'); ?>
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
    </head>
        
        <body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-collapse">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small style="text-transform: capitalize">
							<?php echo $setapp->nama_sekolah;?>
						</small>
					</a>


					
                                   
				</div>
                            <div class="navbar-header pull-right collapse navbar-collapse" role="navigation">
                                <a style="margin-top: 10px;" class="pull-right btn-sm btn-info" href="../">
                                    <i class="fa fa-home"></i> &nbsp;Halaman beranda
                                </a>
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

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
                                    
				</div><!-- /.sidebar-shortcuts -->
                                <div class="area-hasil-nilai">
                                
                                </div>
                                <ul class="nav nav-list main-menu">

                                   
                                        

				</ul><!-- /.nav-list -->



                                
                                <div class="e-copy">
                                    &copy; 2016. Powered by <span class="blue">Ibeesnay</span>
                                </div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
			</div>
			<div class="main-content" style="margin-left: 280px;">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
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
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->


			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
     
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/plugins/mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<?php $this->assets->display('conducter_desktop','js'); ?>
		<!-- inline scripts related to this page -->
	</body>
</html>
<?php
ob_end_flush();
} else {
    redirect('login');
}
