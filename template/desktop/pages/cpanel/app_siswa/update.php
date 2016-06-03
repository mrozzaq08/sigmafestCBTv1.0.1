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
if($record->blokir=='N') {
	$checked = 'checked ';
} else {
	$checked = '';
}
echo form_open_multipart('siswa/query_update',array('class'=>'form-horizontal','id'=>'form-confirm-changes')); ?>
    <div class="row">
		<input type="hidden" name="id_siswa" value="<?php echo $record->id_siswa;?>">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">NIS</label>
				<div class="col-sm-9">
					<input required value="<?php echo $record->nis;?>" name="nis" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
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
				<label class="col-sm-3 control-label no-padding-right">Jenis kelamin</label>
				<div class="col-sm-9">
					<?php
					if($record->jenis_kelamin=='L') {
						echo "<label>
								<input checked class='ace' type='radio' name='jk' value='L'>
								<span class='lbl'>&nbsp;&nbsp;Pria</span>
							</label>
							&nbsp;&nbsp;&nbsp;
							<label>
								<input class='ace' type='radio' name='jk' value='P'>
								<span class='lbl'>&nbsp;&nbsp;Perempuan</span>
							</label>";
					} else {
						echo "<label>
								<input class='ace' type='radio' name='jk' value='L'>
								<span class='lbl'>&nbsp;&nbsp;Pria</span>
							</label>
							&nbsp;&nbsp;&nbsp;
							<label>
								<input checked class='ace' type='radio' name='jk' value='P'>
								<span class='lbl'>&nbsp;&nbsp;Perempuan</span>
							</label>";
					}
					?>
					
					
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Kelas</label>
				<div class="col-sm-9">
					<select required name="id_kelas" data-rel="tooltip" data-placeholder="Pilih kelas" class="col-xs-10 chosen-select">
						<option value="">  </option>
						<?php
                                                foreach($record_kelas as $rows_kelas):
                                                $sel_kelas = $record->id_kelas == $rows_kelas->id_kelas ? 'selected' : '';
                                                echo "<option value='$rows_kelas->id_kelas' $sel_kelas>$rows_kelas->nama</option>";
                                                endforeach;
                                                ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Jabatan</label>
				<div class="col-sm-9">
					<select required name="jabatan" data-rel="tooltip" data-placeholder="Pilih jabatan dikelas" class="col-xs-10 chosen-select">
						<option value="1">Siswa</option>
						<option value="2">Ketua Kelas</option>
						<option value="3">Bendahara</option>
					</select>
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
							   echo "<img src='".base_url()."foto/siswa/$record->foto' alt='...'>";
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
					<input name="fpass" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
				<br>
				<p style="margin-top: 20px;text-align: center">
					<small>Jika tidak ingin diubah dikosongkan saja.</small>
				</p>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Email</label>
				<div class="col-sm-9">
					<input value="<?php echo $record->email;?>" name="email" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
			</div> 
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">No. Telepon</label>
				<div class="col-sm-9">
					<input value="<?php echo $record->no_telp;?>" name="no_telp" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Status</label>
				<div class="col-sm-9">
					<label>
						<input <?php echo $checked;?>name='blokir' value="status" class='ace ace-switch ace-switch-3' type='checkbox' />
						<span class='lbl'></span>
					</label>
				</div>
			</div>
		</div>
		
	</div>
	<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button disabled type="submit" class="btn btn-info" title="Simpan" value="Next" name="update_stay"><i class="fa fa-save"></i>&nbsp; Simpan perubahan</button>&nbsp;
				<button disabled type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="update_exit"><i class="fa fa-save"></i> &nbsp;Simpan dan keluar</button>	&nbsp;
				<a class="danger btn btn-default" href="../../" title="Batal"><i class="fa fa-undo"></i> Batal</a>
			</div>
		</div>
</form>