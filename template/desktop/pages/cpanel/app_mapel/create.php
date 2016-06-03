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
echo form_open('mapel/query_create',array('class'=>'form-horizontal','id'=>'form-confirm-changes')); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Kode atau ID</label>

		<div class="col-sm-9">
			<input readonly name="idmapel" value="<?php echo $auto_number;?>" data-rel="tooltip" class="col-xs-2" type="text" title="Kode atau ID sudah otomatis" data-placement="bottom" />
		</div>
	</div>  
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Nama mata pelajaran</label>

		<div class="col-sm-9">
			<input required name="nama" data-rel="tooltip" class="col-xs-8" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
		</div>
	</div> 
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Nilai KKM</label>

		<div class="col-sm-9">
			<input required name="kkm" data-rel="tooltip" class="col-xs-1" maxlength='2' type="number" title="Kriteria Ketuntasan Minimum" data-placement="bottom" />
		</div>
	</div> 
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Alokasi pengajar</label>

		<div class="col-sm-9">
			<select required name="guru" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8 chosen-select">
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
		<label class="col-sm-3 control-label no-padding-right">Alokasi kelas</label>

		<div class="col-sm-9">
			<select name="kelas[]" data-rel="tooltip" multiple data-placeholder="Pilih alokasi kelas" class="col-xs-8 chosen-select" title="Pilih kelas yang akan diajarkan" data-placement="bottom">
				<?php
                                foreach($record_kelas as $rows_kelas):
                                    echo "<option value='$rows_kelas->id_kelas'>$rows_kelas->nama</option>";
                                endforeach;
                                ?>
			</select>
		</div>
	</div> 
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Keterangan</label>

		<div class="col-sm-9">
			<textarea data-rel="tooltip" name="keterangan" class="col-xs-8" title="Masukan keterangan mata pelajaran" data-placement="bottom"></textarea>
		</div>
	</div> 
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button disabled type="submit" class="btn btn-info" title="Simpan" value="Next" name="simpan_baru"><i class="fa fa-save"></i> &nbsp;Simpan dan tambah baru</button>&nbsp;
			<button disabled type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="simpan_keluar"><i class="fa fa-save"></i> &nbsp;Simpan dan keluar</button>	&nbsp;
			<?php echo anchor('mapel','<i class="fa fa-undo"></i> Batal</a>',array('class'=>'danger btn btn-default'));?>
		</div>
	</div>
</form>  