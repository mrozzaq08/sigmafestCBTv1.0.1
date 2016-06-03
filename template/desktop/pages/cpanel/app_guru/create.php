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
echo form_open_multipart('guru/query_create',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));?>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">NIP</label>
                <div class="col-sm-9">
                    <input required name="nip" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nomor induk pegawai (NIP)" data-placement="bottom" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Nama lengkap</label>
                <div class="col-sm-9">
                    <input required name="nama" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan nama lengkap pengajar" data-placement="bottom" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Foto profil</label>
                <div class="col-sm-9">
                    <div class='fileinput fileinput-new' data-provides='fileinput'>
                        <div class='fileinput-new' style='max-width: 250px; max-height: 250px;'>
                            <img src='<?php echo base_url();?>assets/Images/contoh.png' alt='...'>
                        </div>
                        <div class='fileinput-preview fileinput-exists' style='max-width: 250px; max-height: 250px;'></div>
                        <div>
                            <br>
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
                    <input required onchange="cek_uname_admin(this.value);" name="uname" data-rel="tooltip" class="col-xs-10" type="text" title="Masukan username untuk autentikasi (login)" data-placement="bottom" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Password</label>
                <div class="col-sm-9">
                    <input required name="fpass" data-rel="tooltip" class="col-xs-10" type="password" title="Masukan password atau kata sandi untuk autentikasi (login)" data-placement="bottom" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Re - password</label>
                <div class="col-sm-9">
                    <input required name="cpass" data-rel="tooltip" class="col-xs-10" type="password" title="Masukan kembali password untuk konfirmasi" data-placement="bottom" />
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right">Status</label>
                <div class="col-sm-9">
                    <label>
                        <input checked name='blokir' value="status" class='ace ace-switch ace-switch-3' type='checkbox' />
                        <span class='lbl'></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
	 
    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button disabled type="submit" class="btn btn-info" title="Simpan" value="Next" name="simpan_baru"><i class="fa fa-save"></i> &nbsp;Simpan dan tambah baru</button>&nbsp;
            <button disabled type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="simpan_keluar"><i class="fa fa-save"></i> &nbsp;Simpan dan keluar</button>	&nbsp;
            <a class="danger btn btn-default" href="../" title="Batal"><i class="fa fa-undo"></i> Batal</a>
        </div>
    </div>
</form>