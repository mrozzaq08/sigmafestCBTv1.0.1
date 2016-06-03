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
if(empty($sess_level) && empty($sess_sid)) {
$setapp     = $this->main_model->get_pengaturan();
ob_start('minify');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?php echo $title;?></title>
        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="<?php echo base_url();?>foto/favicon/<?php echo $setapp->favicon;?>"  rel="shortcut icon"  />
        <?php $this->assets->display('login_desktop','css'); ?>
        <!--[if lte IE 9]>
                        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?php echo base_url();?>assets/js/plugins/html5shiv.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout blur-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <?php echo $load_contents;?>
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->
        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?php echo base_url();?>assets/js/jquery/jquery.2.1.1.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="<?php echo base_url();?>assets/js/jquery/jquery.1.11.1.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
            jQuery(function($) {
                    $('#form-login').submit(function() {
            $('#submit-login').html('<i class="ace-icon fa fa-spinner fa-spin bigger-125"></i>&nbsp;&nbsp;LOADING');
        });
                 $(document).on('click', 'a[data-target]', function(e) {
                        e.preventDefault();
                        var target = $(this).data('target');
                        $('.widget-box.visible').removeClass('visible');
                        $(target).addClass('visible');
                 });
                });
                if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/plugins/mobile.custom.min.js'>"+"<"+"/script>");
        </script>
    </body>
</html>
<?php
ob_end_flush();
} else
    {
        if($sess_level == 'admin' OR $sess_level == 'guru')
        {
            redirect('cpanel');
        }
        else
        {
            redirect('exams/beranda');
        }
}
