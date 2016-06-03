<?php
/**
    * Deskripsi Dokumen PHP
    * @version    : 1.1.3.5
    * @package    : IBeESNay
    * @filename   : setting.php
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/

?>

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