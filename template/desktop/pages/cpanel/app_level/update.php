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
echo form_open('level/query_update',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));?>
    <input type="hidden" name="id_level" value="<?php echo $record->id_level;?>">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Nama level</label>
        <div class="col-sm-9">
            <input required name="nama" value="<?php echo $record->nama_level;?>" data-rel="tooltip" class="col-xs-8" type="text" title="Ubah nama level ujian" data-placement="bottom" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Keterangan</label>
        <div class="col-sm-9">
            <textarea data-rel="tooltip" name="keterangan" class="col-xs-8" title="Ubah keterangan level ujian" data-placement="bottom"><?php echo $record->keterangan;?></textarea>
        </div>
    </div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button disabled type="submit" class="btn btn-success" title="Simpan" value="Next" name="update_stay"><i class="fa fa-save"></i> &nbsp;Simpan perubahan</button>&nbsp;
            <button disabled type="submit" class="btn btn-metis-2" title="Simpan dan keluar" value="Next" name="update_exit"><i class="fa fa-save"></i> &nbsp;Simpan dan keluar</button>	&nbsp;
            <?php echo anchor('level','<i class="fa fa-undo"></i> Batal</a>',array('class'=>'danger btn btn-default'));?>
        </div>
    </div>
</form>