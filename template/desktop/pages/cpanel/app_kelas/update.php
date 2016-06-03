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
if($record->aktif=='Y') {
	$checked = 'checked ';
} else {
	$checked = '';
}
echo form_open('kelas/query_update',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));?>
    <input type="hidden" name="id_kelas" value="<?php echo $record->id_kelas;?>">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Nama kelas</label>
        <div class="col-sm-5">
            <input value="<?php echo $record->nama;?>" required name="nama" data-rel="tooltip" class="col-xs-6" type="text" title="Ubah nama kelas" data-placement="bottom" />
            <select name="id_sub" class="col-xs-3" style="height: 34px; margin-left: 10px; float: left">
                <?php 
                foreach($sub_kelas as $subkelas):
                    $selected = $subkelas['id_sub'] == $record->id_sub ? 'selected' : '';
                    echo "<option value='$subkelas[id_sub]' $selected>$subkelas[nama_sub]</option>";
                endforeach;
                ?>
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Wali kelas</label>
        <div class="col-sm-9">
            <select required name="wkelas" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-6 chosen-select">
                <option value="">  </option>
                <?php 
                foreach($record_guru as $rows_guru):
                    $sel_guru = $record->id_pengajar == $rows_guru['id_pengajar'] ? 'selected' : '';
                    echo "<option value='$rows_guru[id_pengajar]' $sel_guru>$rows_guru[nama_lengkap]</option>";
                endforeach;
                ?>
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Status</label>

        <div class="col-sm-9">
            <label>
                <input <?php echo $checked;?>name='status' value="status" class='ace ace-switch ace-switch-3' type='checkbox' />
                <span class='lbl'></span>
            </label>
        </div>
    </div> 
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button disabled="disabled" type="submit" class="btn btn-info" title="Simpan" value="Next" name="update_stay"><i class="fa fa-save"></i> &nbsp;Simpan perubahan</button>&nbsp;
            <button disabled="disabled" type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="update_exit"><i class="fa fa-save"></i> &nbsp; Simpan dan keluar</button>&nbsp;
            <?php echo anchor('kelas','<i class="fa fa-undo"></i> Batal</a>',array('class'=>'danger btn btn-default'));?>
        </div>
    </div>
</form>