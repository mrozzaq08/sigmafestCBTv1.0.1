<?php
/**
    * Deskripsi Dokumen PHP
    * @version    : 1.1.3.5
    * @package    : IBeESNay
    * @filename   : navbar.php
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/

?>
<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
</script>

<div class="navbar-container" id="navbar-container">
	<div class="navbar-header pull-left">
            <a href="<?php echo base_url();?>" class="navbar-brand">
			<small style="text-transform: uppercase">
                            <i class="fa fa-leaf"></i>&nbsp; COMBAT ID
			</small>
		</a>

		<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
			<span class="sr-only">Toggle user menu</span>
			<img src="<?php echo base_url();?>assets/avatars/user.jpg" alt="Jason's Photo" />
		</button>

		<button style="background: none" class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>
	</div>

	<div class="navbar-buttons navbar-header pull-right collapse navbar-collapse" role="navigation">
		<ul class="nav ace-nav">
                        <li class="transparent">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<i class="ace-icon fa fa-envelope"></i>
                                        &nbsp;
				</a>
			</li>
			<li class="transparent">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                        &nbsp;
				</a>
			</li>

			<li class="light-blue user-min">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="<?php echo base_url();?>assets/avatars/siswa.png" alt="Jason's Photo" />
                                <span class="user-info">
                                    <small></small>
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <?php echo anchor('exams/profil',
                                    '<i class="ace-icon fa fa-user bigger-110 blue"></i> &nbsp;
                                    Profil'); ?>

                                </li>
                                <li class="divider"></li>
                                <li>
                                    <?php echo anchor('login/user_logout',
                                    '<i class="ace-icon fa fa-power-off"></i>&nbsp;Keluar',
                                    array('target'=>'_self'));
                                    ?>
                                </li>
                            </ul>
                    </li>
		</ul>
	</div>

	<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
		<ul class="nav navbar-nav">
			
		</ul>

		<form class="navbar-form navbar-left form-search" role="search">
			<div class="form-group">
				<input type="text" placeholder=" Mesin Pencarian" />
			</div>
			<button type="button" class="btn btn-mini btn-info2">
				<i class="ace-icon fa fa-search icon-only bigger-110"></i>
			</button>
		</form>
	</nav>
</div><!-- /.navbar-container -->