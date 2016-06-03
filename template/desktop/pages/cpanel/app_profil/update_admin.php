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

echo form_open_multipart('profil/query_update',array('class'=>'form-horizontal','id'=>'form-confirm-changes')); ?>

    <button disabled type="submit" class="btn btn-sm btn-info" title="Simpan" value="Next" name="update"><i class="fa fa-save"></i>&nbsp; Simpan perubahan</button>&nbsp;
    <div class="row">
    <div class="col-sm-12">
    
    
    <div class="space-6"></div>

    <div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title lighter smaller">
					<i class="ace-icon fa fa-user blue"></i>&nbsp;
					Profil dan data akun
				</h4>

                            <div class="widget-toolbar">
                                    
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>&nbsp;
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                            </div>
                            <div class="widget-toolbar">
                                
                            </div>
			</div>

    <div class="widget-body">
        <div class="widget-main no-padding">
            <div class="row">
                <div class="space-4"></div>
            <div class="col-sm-6">
                <input type="hidden" value="<?php echo $record->id_admin;?>" name="id_admin">

			<table class="table">
				<tr>
                                     <td>Nama Lengkap</td>
                                    <td>
                                        <input type="text" value="<?php echo $record->nama_lengkap;?>" name="nama" style="width: 100%" required></td>
				</tr>
                                <tr>
                                    <td class="row-title"><span class="tips" title="Alamat">Alamat Lengkap</td>
                                    <td>
                                        <textarea name="alamat" style="width: 100%" required ><?php echo $record->alamat;?></textarea></td>
				</tr>
                                    <tr>
                                        <td class="row-title"><span class="tips" title="Nomor Telepon">No. Telepon</td>
                                        <td>
                                            <input value="<?php echo $record->no_telp;?>"  class="numeric" type="text" name="no_telp" style="width: 100%"></td>
                                    </tr>
									             <tr>
                                    <td class="row-title"><span class="tips" title="Unggah foto profil">Foto Profil</td>
                                    <td>
                                        <div class='control-group'>
                <div class='controls'><br>

        <div class='fileinput fileinput-new' data-provides='fileinput'>
                    <div class='fileinput-new thumbnail' style='max-width: 250px; max-height: 250px;'>
            <?php
            if($record->foto=='') {
                echo "<img src='".base_url()."assets/Images/contoh.png' alt='...'>";
            }
            else {
               echo "<img src='".base_url()."foto/admin/$record->foto' alt='...'>";
            }

            ?>

                 </div><div class='fileinput-preview fileinput-exists thumbnail' style='max-width: 250px; max-height: 250px;'></div>
                <div>
                <span class='btn btn-default btn-file'><span class='fileinput-new'>Pilih foto</span> <span class='fileinput-exists'>Pilih foto</span>
                    <input type='file' name='fupload' style="cursor: pointer" class="form-control">
                </span>
                <a href='#' class='btn btn-default fileinput-exists' data-dismiss='fileinput'>Hapus</a>
                </div>
                </div>
                </div>
        </div>
                                    </td>
				</tr>

			</table>
            </div>
            <div class="col-sm-6">
			<table class="table">
                                                   <tr>
                                    <td class="row-title"><span class="tips" required title="Username">Username</td>
                                    <td>
                                        <input type="text" value="<?php echo $record->username; ?>"  class="alphanumeric" name="uname" style="width: 100%" required></td>
				</tr>
                                <tr>
                                    <td class="row-title"><span class="tips" title="Password guru">Password</td>
                                    <td>
                                        <input type="password" name="fpass"  class="alphanumeric" style="width: 100%" id="pass">
										<p style="margin-top: 10px;">
                                        	<small>Jika tidak ingin diubah dikosongkan saja.</small>
                                        </p></td>
				</tr>
                                <tr>
                                    <td class="row-title"><span class="tips" required title="Email">Email</td>
                                    <td>
                                        <input type="text" value="<?php echo $record->email;?>" name="email"  class="email" style="width: 100%" id="uname"></td>
				</tr>
                                <tr>
                                    <td class="row-title"><span class="tips" title="Website, blog atau link media sosial">Website</td>
                                    <td>
                                        <input type="text" value="<?php echo $record->website;?>"  class="web" name="website" style="width: 100%" id="uname"></td>
				</tr>
			</table>
            </div>
            </div>
        </div>
    </div>
        </div>
</div>
    </div>
</form>