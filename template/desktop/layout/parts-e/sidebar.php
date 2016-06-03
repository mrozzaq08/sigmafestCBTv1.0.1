<?php
/**
    * Deskripsi Dokumen PHP
    * @version    : 1.1.3.5
    * @package    : IBeESNay
    * @filename   : sidebar.php
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/

?>
<script type="text/javascript">
	try{ace.settings.check('sidebar', 'fixed')}catch(e){}
</script>
<div class="sidebar-shortcuts" id="sidebar-shortcuts">
	<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
		<button class="btn btn-success">
			<i class="ace-icon fa fa-signal"></i>
		</button>

		<button class="btn btn-info">
			<i class="ace-icon fa fa-pencil"></i>
		</button>

		<button class="btn btn-warning">
			<i class="ace-icon fa fa-users"></i>
		</button>

		<button class="btn btn-danger">
			<i class="ace-icon fa fa-cogs"></i>
		</button>
	</div>

	<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
		<span class="btn btn-success"></span>

		<span class="btn btn-info"></span>

		<span class="btn btn-warning"></span>

		<span class="btn btn-danger"></span>
	</div>
</div><!-- /.sidebar-shortcuts -->

<ul class="nav nav-list menu-utama">
	<li class="<?php echo $beranda;?>">
            <?php
            echo anchor('exams/beranda',
                        '<i class="menu-icon fa fa-home"></i>
                         <span class="menu-text"> Beranda </span>');
            ?>
		

		<b class="arrow"></b>
	</li>
<li class="hover">
        <?php
        echo anchor('exams/mapel',
                    '<i class="menu-icon fa fa-book"></i>
                     <span class="menu-text"> Mata Pelajaran </span>');
        ?>
	<b class="arrow"></b>

</li>


<li class="hover <?php echo $ujian;?>">
        <?php
        echo anchor('exams/ujian',
                    '<i class="menu-icon fa fa-laptop"></i>
                     <span class="menu-text"> Akses Tes</span>');
        ?>
	<b class="arrow"></b>

</li>

<li class="hover <?php echo $latihan;?>">
        <?php
        echo anchor('exams/latihan',
                    '<i class="menu-icon fa fa-edit"></i>
                     <span class="menu-text"> Akses Latihan</span>');
        ?>
	<b class="arrow"></b>

</li>

<li class="hover <?php echo $laporan;?>">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-briefcase"></i>
			<span class="menu-text"> Data Laporan </span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

                <ul class="submenu">

                    <li class="">
                    <?php
                    echo anchor('exams/laporan',
                                '<i class="fa fa-tasks" style=""></i> &nbsp;Laporan Ujian
                                <span class="pull-right">
                                </span>');
                    ?>
</li>
</ul>
</li>

</ul><!-- /.nav-list -->

<script type="text/javascript">
	try{ace.settings.check('sidebar','collapsed')}catch(e){}
</script>
