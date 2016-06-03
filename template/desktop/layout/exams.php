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
    <?php require_once('parts-e/head.php');?>
   
    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar">
            <?php require_once('parts-e/navbar.php');?>
        </div>
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
            <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse">
                <?php
                require_once('parts-e/aktif.php');
                require_once('parts-e/sidebar.php');
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
                                <?php require_once('parts-e/setting.php');?>
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
                                    <?php
                                    //require_once('parts-e/hidden.php');
                                    echo $load_contents; 
                                    ?>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <div class="footer">
                <?php require_once('parts-e/footer.php');?>
            </div>
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
<script type="text/javascript">
        if('ontouchstart' in document.documentElement) {
             document.write("<script src='<?php echo base_url();?>assets/js/plugins/mobile.custom.min.js'>"+"<"+"/script>");
         }
</script>
<?php $this->assets->display('exams_desktop','js'); ?>
 <script src="<?php echo base_url();?>assets/js/php/fn.exams.php"></script>
</body>
</html>
<?php
ob_end_flush();
} else {
        redirect('login');
}

