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
        <a href="<?php echo base_url();?>cpanel" class="navbar-brand">
            <small style="text-transform: uppercase">
                <i class="fa fa-leaf"></i>&nbsp; SIGMAFEST CBT
            </small>
        </a>
        <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
            <span class="sr-only">Toggle user menu</span>
            <img src="<?php echo base_url();?>assets/avatars/avatar2.png" alt="" />
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

            <li class="light-blue user-min">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <img class="nav-user-photo" src="<?php echo base_url();?>assets/avatars/avatar2.png" alt="Jason's Photo" />
                    <span class="user-info">
                        <small>Pengelolaan akun </small>
                    </span>
                    <i class="ace-icon fa fa-caret-down"></i>
                </a>
                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                    <li>
                        <?php echo anchor('profil/',
                        '<i class="ace-icon fa fa-user bigger-110 blue"></i> &nbsp;
                        Profil Saya'); ?>
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
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Tambahkan baru &nbsp;
                    <i class="ace-icon fa fa-plus-circle bigger-110"></i>
                </a>
                <ul class="dropdown-menu dropdown-light-blue dropdown-caret">
                    <?php if(E_LEVEL == 'admin'): ?>
                    <li>
                        <?php echo anchor('guru/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Data guru'); ?>
                    </li>         								
                    <li class="disabled">
                        <?php echo anchor('kelas/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Data Kelas'); ?>
                    </li>                
                    <li class="disabled">
                        <?php echo anchor('siswa/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Data Siswa'); ?>
                    </li>
                    <li class="disabled">
                        <?php echo anchor('mapel/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Mata Pelajaran'); ?>
                    </li>
                    <?php endif;?>
                    <li>
                        <?php echo anchor('bsoal/create/new/general/bsoal-type-1',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Bank Soal'); ?>
                    </li>		
                    <li>
                        <?php echo anchor('ujian/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Data Ujian'); ?>
                    </li>
                    <?php if(E_LEVEL == 'admin'): ?>
                    <li class="disabled">
                        <?php echo anchor('agenda/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Data Agenda'); ?>
                    </li>
                    <li class="disabled">
                        <?php echo anchor('jenis/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Kategori Ujian'); ?>
                    </li>
                    <li class="disabled">
                        <?php echo anchor('level/create/new',
                        '<i class="ace-icon fa fa-plus bigger-110 blue"></i> &nbsp;
                        Level Soal'); ?>
                    </li>
                    <?php endif;?>
                </ul>
            </li>
        </ul>

        <form class="navbar-form navbar-left form-search" onsubmit="return false;" role="search">
            <div class="form-group">
                <input type="text" id="search-query" placeholder=" Pencarian umum" />
            </div>
            <button type="button" class="btn btn-mini btn-info2">
                <i class="ace-icon fa fa-search icon-only bigger-110"></i>
            </button>
        </form>
    </nav>
</div>