<?php
/**
    * Deskripsi Dokumen PHP
    * @version    : 1.1.3.5
    * @package    : IBeESNay
    * @filename   : footer.php
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
?>
<div class="footer-inner">
    <div class="footer-content">
	<small>
            <span class="bigger-">
               <span class="blue">SIGMAFEST CBT</span> 
                &copy; <?php echo date("Y");?>. <?php echo $setapp->nama_sekolah;?>             
            </span>
        </small>
        &nbsp; &nbsp;
        
        <small class="pull-right">
            <?php echo anchor('','Version: '.$this->config->item('apps_version'));?>
        </small>
    </div>
</div>
<div class="modal fade" id="error-page" style="display:none">
  <div class="modal-dialog modal-sm modal-error">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title">Oops!!!</h4>
      </div>
      <div class="modal-body">
       <div class="modal-info" style="position: relative;"><p>Maaf, gagal saat membuka halaman atau link. SIlahkan cek link atau koneksi internet anda!</p></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="no-session" style="display:none">
  <div class="modal-dialog modal-sm modal-error">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title">Oops!!!</h4>
      </div>
      <div class="modal-body">
       <div class="modal-info" style="position: relative;"><p>Maaf, gagal saat membuka halaman atau link. Session login anda sudah tidak ada</p><br>
       Silahkan <?php echo anchor('login','Login',array('target'=>'_self'));?> kembali</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" style="display:none">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-question">
      <div class="modal-header"><h4 class="modal-title">Konfirmasi Hapus</h4>
        </div>
      <div class="modal-body">
        <p class="question">Yakin ingin menghapus item yang dipilih?</p>
		<small class='text-info'>
		Catatan: data akan dihapus secara permanen
		</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class='fa fa-undo'></i>&nbsp;Batal</button>
        <button type="button" class="btn btn-danger btn-sm btn-grad" id="confirm" name="delete"><i class='icon-trash'></i>&nbsp; Hapus</button>	
      </div>
    </div>
  </div>
</div>