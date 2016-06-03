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
echo form_open_multipart('main/update_pengaturan',array('class'=>'form-horizontal','id'=>'form-confirm-changes')); ?>
    <div class="row">
        <div class="col-sm-12">
            <button disabled type="submit" class="btn btn-sm btn-success" title="Simpan" name="update"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan perubahan pengaturan</button>&nbsp;
            <a class="btn btn-default btn-sm" onclick="self.history.back();" title="Batal"><i class="fa fa-reply"></i> Kembali</a>
            <div class="space-6"></div>

            <div class="widget-box">
                <div class="widget-header" style="background: #fff; border-bottom: 0px">
                        <h4 class="widget-title lighter smaller">
                            <i class="ace-icon fa fa-cogs blue"></i>&nbsp;
                            Pengaturan umum
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

			<table class="table">
                <tr>
                    <td class="row-title">Nama sekolah</td>
                    <td>
                    	<input name="sekolah" type="text" class="form-control" style="width: 100%" value="<?php echo $record->nama_sekolah;?>">
                    </td>
                        
				</tr>
				<tr>
                    <td class="row-title">Kepala sekolah</td>
                    <td>
                    	<input type="text" name="kepala" class="form-control" style="width: 100%" value="<?php echo $record->kepala_sekolah;?>">
                    </td>
                        
				</tr>
                                <tr>
                    <td class="row-title">NPSN sekolah</td>
                    <td>
                    	<input type="text" name="npsn" class="numeric form-control" style="width: 100%" value="<?php echo $record->npsn_sekolah;?>">
                    </td>

				</tr>
                                <tr>
                    <td class="row-title">Akreditas</td>
                    <td>
                    	<input type="text" name="akreditas" class="form-control alpha" style="width: 15%" value="<?php echo $record->akreditas_sekolah;?>">
                    </td>

				</tr>
                                <tr>
                    <td class="row-title">Alamat sekolah</td>
                    <td>
                    	<input type="text" name="alamat" class="form-control" style="width: 100%" value="<?php echo $record->alamat_sekolah;?>">
                    </td>

				</tr>
                                <tr>
                    <td class="row-title">Email sekolah</td>
                    <td>
                    	<input type="text" name="email" class="form-control" style="width: 100%" value="<?php echo $record->email_sekolah;?>">
                    </td>

				</tr>
                                  <tr>
                    <td class="row-title">Telp. sekolah</td>
                    <td>
                    	<input type="text" name="telp" class="form-control" style="width: 100%" value="<?php echo $record->telp_sekolah;?>">
                    </td>

				</tr>
                                  <tr>
                    <td class="row-title">Fax. sekolah</td>
                    <td>
                    	<input type="text" name="fax" class="form-control" style="width: 100%" value="<?php echo $record->fax_sekolah;?>">
                    </td>

				</tr>
			</table>				
		</div>  
                <div class="col-sm-6">
			<table class="table">
                                <tr>
                                    <td class="row-title"><span class="tips" required title="Unggah gambar untuk favicon">Logo sekolah</td>
                                    <td>
                                        <div class='control-group'>
                <div class='controls'><br>
        
        <div class='fileinput fileinput-new' data-provides='fileinput'>
                    <div class='fileinput-new thumbnail' style='max-width: 250px; max-height: 250px;'>
                        <?php
                        if($record->favicon=='') {
                                echo "<img src='../assets/Images/contoh.png' alt='...'>";
                        } else {
                                echo "<img src='../foto/favicon/$record->favicon' alt='...' width=60'>";
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
                                <tr>
                                    <td class="row-title"><span class="tips" required title="Backup databases">Backup DB</td>
                                    <td> <a class="btn btn-primary btn-sm" style="width: 100%" target='_parent' href="../main/backup_db" title="Batal"><i class="fa fa-download"></i> Backup database</a>
	</td>
				</tr>
                                <tr>
                                    <td class="row-title"><span class="tips" required title="Restore databases">Restore DB</td>
                                    <td>
                                     Untuk melakukan restore basis data silahkan klik <a href='./restore'>disini</a>
	</td>
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