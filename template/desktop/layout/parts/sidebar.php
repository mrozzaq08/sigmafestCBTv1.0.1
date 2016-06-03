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
        <?php echo anchor('cpanel',
        '<i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Beranda </span>');
        ?>
	<b class="arrow"></b>
    </li>
    <li class="hover <?php echo $ujian;?>">
        <?php
        echo anchor('ujian',
        '<i class="menu-icon fa fa-laptop"></i>
        <span class="menu-text"> Data Tes</span>');
        ?>
	<b class="arrow"></b>
    </li>
    <li class="hover <?php echo $mapel;?>">
        <?php
        echo anchor('mapel',
        '<i class="menu-icon fa fa-book"></i>
        <span class="menu-text"> Mata Pelajaran </span>');
        ?>
	<b class="arrow"></b>
    </li>
    <li class="hover <?php echo $bank_soal;?>">
        <?php
        echo anchor('bsoal',
        '<i class="menu-icon fa fa-question-circle"></i>
        <span class="menu-text"> Bank Soal </span>');
        ?>
        <b class="arrow"></b>
    </li>
    <?php if(E_LEVEL == 'admin'): ?>
    <li class="hover <?php echo $data_master;?>">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-unlock-alt"></i>
            <span class="menu-text"> Data Master </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="">
                <?php
                echo anchor('kelas',
                '<i class="fa fa-bar-chart-o" style=""></i> Data Kelas
                <span class="pull-right">
                </span>');
                ?>
            </li>
            <li class="">
                <?php
                echo anchor('jenis',
                '<i class="fa fa-tasks" style=""></i> &nbsp;Kategori Ujian
                <span class="pull-right">
                </span>');
                ?>
            </li>

            <li class="">
                <?php
                echo anchor('level',
                '<i class="fa fa-ban" style=""></i> &nbsp;Level Soal
                <span class="pull-right">
                </span>');
                ?>
            </li>
        </ul>
    </li>
    <?php endif; ?>
    <li class="hover <?php echo $media;?>">
        <?php
        echo anchor('media',
        '<i class="menu-icon fa fa-file"></i>
        <span class="menu-text"> Pengelola Berkas </span>');
        ?>
        <b class="arrow"></b>
    </li>
    <?php if(E_LEVEL == 'admin'): ?>
    <li class="hover <?php echo $pengguna;?>">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-users"></i>
            <span class="menu-text"> Pengguna </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="">
                <?php
                echo anchor('guru',
                '<i class="fa fa-user" style=""></i> &nbsp;Data Guru
                <span class="pull-right">
                </span>');
                ?>
            </li>
            <li class="">
                <?php
                echo anchor('siswa',
                '<i class="fa fa-user" style=""></i> &nbsp;Data Siswa
                <span class="pull-right">
                </span>');
                ?>
            </li>
        </ul>
    </li>
    <?php endif; ?>
    <li class="hover">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-briefcase"></i>
            <span class="menu-text"> Data Laporan </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="">
                <?php
                echo anchor('laporan',
                '<i class="fa fa-user" style=""></i> &nbsp;Ujian Peserta
                <span class="pull-right">
                </span>');
                ?>
            </li>
            <li class="">
                <?php
                echo anchor('laporan',
                '<i class="fa fa-info-circle" style=""></i> &nbsp;Info Umum
                <span class="pull-right">
                </span>');
                ?>
            </li>
        </ul>
    </li>
    <?php if(E_LEVEL == 'admin'): ?>
    <li class="hover">
        <?php
        echo anchor('main/pengaturan',
        '<i class="menu-icon fa fa-wrench" style=""></i>
        <span class="menu-text"> Pengaturan Umum </span>');
        ?>
	<b class="arrow"></b>
    </li>
    <li class="hover">
            <?php
            echo anchor('main/restore',
            '<i class="menu-icon fa fa-refresh" style=""></i> 
            &nbsp;Pemulihan');
            ?>
        <b class="arrow"></b>
    </li>
    <?php endif; ?>
</ul>

<script type="text/javascript">
    try{ace.settings.check('sidebar','collapsed')}catch(e){}
</script>