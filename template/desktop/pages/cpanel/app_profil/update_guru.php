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
echo form_open_multipart('profil/query_update',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));
?>
    <div class="row">
		<input type="hidden" value="<?php echo $record->id_pengajar;?>" name="id_guru">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">NIP</label>
				<div class="col-sm-9">
					<input required value="<?php echo $record->nip;?>" name="nip" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Nama lengkap</label>
				<div class="col-sm-9">
					<input required value="<?php echo $record->nama_lengkap;?>" name="nama" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Alamat lengkap</label>
				<div class="col-sm-9">
					<textarea data-rel="tooltip" name="alamat" class="col-xs-10" title="Masukan keterangan mata pelajaran" data-placement="bottom"><?php echo $record->alamat;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">No. Telepon</label>
				<div class="col-sm-9">
					<input required value="<?php echo $record->no_telp;?>" name="no_telp" data-rel="tooltip" class="col-xs-5" type="number" title="Kriteria Ketuntasan Minimum" data-placement="bottom" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Foto profil</label>

				<div class="col-sm-9">
					<div class='fileinput fileinput-new' data-provides='fileinput'>
						<div class='fileinput-new thumbnail' style='max-width: 250px; max-height: 250px;'>
							<?php
							if($record->foto=='') {
								echo "<img src='".base_url()."assets/Images/contoh.png' alt='...'>";
							} else {
							   echo "<img src='".base_url()."foto/pengajar/$record->foto' alt='...'>";
							}
							?>
						</div>
						<div class='fileinput-preview fileinput-exists thumbnail' style='max-width: 250px; max-height: 250px;'></div>
						<div>
							<span class='btn btn-default btn-file'><span class='fileinput-new'>Pilih foto</span> <span class='fileinput-exists'>Pilih foto</span>
								<input type='file' name='fupload' style="cursor: pointer" class="form-control">
							</span>
							<a href='#' class='btn btn-default fileinput-exists' data-dismiss='fileinput'>Hapus</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Username</label>
				<div class="col-sm-9">
					<input required value="<?php echo $record->username_login;?>" name="uname" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Password</label>
				<div class="col-sm-9">
					<input name="fpass" data-rel="tooltip" class="col-xs-10" type="password" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
				<br>
				<p style="margin-top: 20px;text-align: center">
					<small>Jika tidak ingin diubah dikosongkan saja.</small>
				</p>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Email</label>
				<div class="col-sm-9">
					<input value="<?php echo $record->email;?>" name="email" data-rel="tooltip" class="col-xs-10 email" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button disabled type="submit" class="btn btn-info" title="Simpan" value="Next" name="update_stay"><i class="fa fa-save"></i> &nbsp;Simpan perubahan</button>&nbsp;
			<a class="danger btn btn-default" href="./" title="Batal"><i class="fa fa-undo"></i> Batal</a>
		</div>
	</div>
</form>