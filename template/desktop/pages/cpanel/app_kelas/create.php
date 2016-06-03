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
echo form_open('kelas/query_create',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));?>
    <div class="form-group">
        <input readonly name="id_kelas" value="<?php echo $auto_number;?>" data-rel="tooltip" class="col-xs-2" type="hidden" title="Kode atau ID sudah otomatis" data-placement="bottom" />
    </div>  
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Nama kelas</label>
        <div class="col-sm-5">
            <input onkeyup="cek_namakelas(this.value);" required name="nama" data-rel="tooltip" class="col-xs-6" placeholder="Contoh: X IPS, XII IPS" type="text" title="Masukan nama kelas" data-placement="bottom" />
            <select name="id_sub" class="col-xs-5" style="height: 34px; margin-left: 10px; float: left">
                <?php 
                foreach($sub_kelas as $subkelas):
                    echo "<option value='$subkelas[id_sub]'>$subkelas[nama_sub]</option>";
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
                   echo "<option value='$rows_guru[id_pengajar]'>$rows_guru[nama_lengkap]</option>";
                endforeach;
                ?>
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Status</label>
        <div class="col-sm-9">
            <label>
                <input checked name='status' value="status" class='ace ace-switch ace-switch-3' type='checkbox' />
                <span class='lbl'></span>
            </label>
        </div>
    </div> 
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button disabled="disabled" type="submit" class="btn btn-info" title="Simpan" value="Next" name="simpan_baru"><i class="fa fa-save"></i> &nbsp;Simpan dan tambah baru</button>&nbsp;
            <button disabled="disabled" type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="simpan_keluar"><i class="fa fa-save"></i> &nbsp; Simpan dan keluar</button>&nbsp;
            <?php echo anchor('kelas','<i class="fa fa-undo"></i> Batal</a>',array('class'=>'danger btn btn-default'));?>
        </div>
    </div>
</form>