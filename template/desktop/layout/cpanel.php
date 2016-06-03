<?php
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.0
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
    <?php require_once('parts/head.php');?>
   
    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar">
            <?php require_once('parts/navbar.php');?>
            <div id="serach-result"></div>
        </div>
        
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
            <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse">
                <?php
                require_once('parts/aktif.php');
                require_once('parts/sidebar.php');
                ?>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content" id="konten-ajax">
                        <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-info ace-settings-btn" id="ace-settings-btn">
                                <i class="ace-icon fa fa-cog bigger-130"></i>
                            </div>
                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">
	<div class="ace-settings-item">
		<div class="pull-left">
			<select id="skin-colorpicker" class="hide">
				<option data-skin="no-skin" value="#438EB9">#438EB9</option>
				<option data-skin="skin-1" value="#222A2D">#222A2D</option>
				<option data-skin="skin-2" value="#C6487E">#C6487E</option>
				<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
			</select>
		</div>
		<span>&nbsp; Choose Skin</span>
	</div>

	<div class="ace-settings-item">
		<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
		<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
	</div>

	<div class="ace-settings-item">
		<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
		<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
	</div>

	<div class="ace-settings-item">
		<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
		<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
	</div>


	<div class="ace-settings-item">
		<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
		<label class="lbl" for="ace-settings-add-container">
			&nbsp;Inside
			<b>.container</b>
		</label>
	</div>
</div><!-- /.pull-left -->

<div class="pull-left width-50">
	<div class="ace-settings-item">
		<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
		<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
	</div>

        
	<div class="ace-settings-item">
		<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
		<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
	</div>
        <div class="ace-settings-item">
        <button type="button" class="sidebar-collapse btn btn-white btn-primary" data-target="#sidebar">
                <i class="ace-icon fa fa-angle-double-up" data-icon1="ace-icon fa fa-angle-double-up" data-icon2="ace-icon fa fa-angle-double-down"></i>
                Toggle Menu
        </button>
        </div>
</div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->
                        <div class="page-header">
                            <h1>
                                <?php echo $main_title; ?>
                                &nbsp;
                                <small>
                                        <i class="ace-icon fa fa-bookmark"></i>&nbsp;&nbsp;
                                        <?php echo $main_sub_title; ?>
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div id="mainApps">
                                    <!-- PAGE CONTENT BEGINS -->
                                    
                                    <?php
                                    //require_once('parts/hidden.php');
                                    echo $load_contents; 
                                    ?>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <div class="footer">
                <?php require_once('parts/footer.php');?>
            </div>
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
    
<script type="text/javascript">
        if('ontouchstart' in document.documentElement) {
             document.write("<script src='<?php echo base_url();?>assets/js/olugins/mobile.custom.min.js'>"+"<"+"/script>");
         }
</script>
<?php $this->assets->display('cpanel_desktop','js'); ?>
<script src="<?php echo base_url();?>assets/js/php/fn.cpanel.php?layout=desktop"></script>
</body>
</html>
<?php
ob_end_flush();
} else {
        redirect('login');
}

