<?php
/**
    * Deskripsi Dokumen PHP
    * @version    : 1.1.3.5
    * @package    : IBeESNay
    * @filename   : head.php
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
?>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link href="<?php echo base_url();?>foto/favicon/<?php echo $setapp->favicon;?>"  rel="shortcut icon"  />

	<?php $this->assets->display('cpanel_desktop','css'); ?>
      
        <!--[if lte IE 9]>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
	<![endif]-->

	<!--[if lte IE 9]>
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
	<![endif]-->

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
	<!-- inline styles related to this page -->
	<!-- ace settings handler -->
	<script src="<?php echo base_url();?>assets/js/extra.min.js"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
	<script src="<?php echo base_url();?>assets/js/plugins/html5shiv.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/plugins/respond.min.js"></script>
	<![endif]-->
                
</head>