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
$a = $b = $c = $d = '';
if(isset($_REQUEST['type']))
{
    $type=$_REQUEST['type'];
    if($_REQUEST['type'] == 'video')
            $c ='active';
    else if($_REQUEST['type'] == 'files')
            $d ='active';
    else if($_REQUEST['type'] == 'flash')
            $b = 'active';
    else
        $a = 'active';
}
else
{
    $type = 'images';
    $a = 'active';	
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="tabbable">
            <small class="pull-right" style="margin-top: 8px;">
                <i class="fa fa-info-circle"></i> &nbsp;Jangan menghapus berkas index.html pada halaman pengelola berkas
            </small>
            <ul class="nav nav-tabs padding-12" id="myTab3">
                <li class="<?php echo $a; ?>">
                    <a href="?type=images">Images</a>
                </li>
                <li class="<?php echo $b; ?>">
                    <a href="?type=flash">Flash</a>
                </li>
                <li class="<?php echo $c; ?>">
                    <a href="?type=video">Video</a>
                </li>
                <li class="<?php echo $d; ?>">
                    <a href="?type=files">Files</a>
                </li>
            </ul>
            <div class="tab-content" style="float: left; width: 100%">
                <div class="tab-pane active" style="margin-top: -15px">
                    <iframe src="<?php echo base_url();?>plugins/plg_kcfinder/browse.php?type=<?php echo $type; ?>&langCode=id" width="99.65%" height="550" style="border:solid 1px #ccc; -moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px; padding: 0" class="fg-toolbar"></iframe>
                </div>
           </div>
        </div>
    </div>
</div>