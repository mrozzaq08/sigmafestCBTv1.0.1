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
$kode_mapel = $this->uri->segment(4);
if($kode_mapel == 'general') {
    $redirect = 'general';
} else {
    $redirect = $kode_mapel;
}
echo form_open('bsoal/query_create',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));
?>
    <script src="<?php echo base_url();?>plugins/plg_ckeditor/ckeditor.js"></script>
    <input type="hidden" name="redirect" value="<?php echo $redirect;?>"/>
    <input type="hidden" name="id_soal" value="<?php echo $auto_number;?>"/>
    <input type="hidden" name="bs_type" value="bs-6">
        <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Jenis Soal</label>

		<div class="col-sm-9">
                    <select data-rel="tooltip" onchange="get_bsoal_type(this.value);" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                            <option value="bsoal-type-0">Benar / Salah</option>
                            <option value="bsoal-type-1">Multiple Pilihan - Jawaban Tunggal</option>
                            <option value="bsoal-type-2">Multiple Pilihan - Jawaban Ganda</option>
                            <option value="bsoal-type-3">Melengkapi Kalimat Rumpang</option>
                            <option value="bsoal-type-4">Jawaban Singkat</option>
                            <option value="bsoal-type-5">Mencocokan Jawaban</option>
                            <option selected value="bsoal-type-6">Essay</option>

                    </select>
                </div>
	</div>
        <?php
        if($kode_mapel == 'general') { ?>
        <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Mata Pelajaran</label>

		<div class="col-sm-9">
                    <select required name="id_mapel" data-rel="tooltip" data-placeholder="Pilih mata pelajaran" class="col-xs-8 chosen-select">
                                <?php
                                foreach($record_mapel->result() as $rows_mapel):
                                echo "<option value='$rows_mapel->id_mapel'>$rows_mapel->nama</option>";
                                endforeach;
                                ?>

                    </select>
                </div>
	</div>
        <?php } else {
            echo "<input type='hidden' name='id_mapel' value='$kode_mapel'/>";
        } ?>
        <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Level Soal</label>

		<div class="col-sm-9">
                    <select required name="id_level" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                            <?php
                            foreach($record_level as $rows_level):
                            echo "<option value='$rows_level->id_level'>$rows_level->nama_level</option>";
                            endforeach;
                            ?>

                    </select>
                </div>
	</div>
        <div class="hr hr-8 hr-double"></div>
        <div class="form-group">
		<div class="col-sm-8 col-sm-offset-2">
                        <h4><i class="fa fa-question-circle"></i>&nbsp;&nbsp;
                            Tulis Pertanyaan
                            <small class="pull-right">
                                <label>
                                    <input target-editor="editor-pertanyaan" type="checkbox" class="ace" name="cke_pertanyaan" checked>
                                    <span class="lbl">&nbsp; Gunakan editor</span>
                                </label>
                            </small>
                        </h4>
                        <p><small>Tuliskan pertanyaan anda dengan jelas ataupun lengkap.<br>
                            Gunakan fitur pendukung fasilitas editor tulisan untuk pertanyaan anda</small></p>
                        <div class="space-6"></div>
			<textarea id="epertanyaan" name="pertanyaan" data-rel="tooltip" class="col-xs-12 cke-pertanyaan" title="Kode atau ID sudah otomatis" data-placement="bottom"></textarea>
		</div>
	</div>
        <div class="form-group">
		<div class="col-sm-8 col-sm-offset-2">
                        <h4><i class="fa fa-question-circle"></i>&nbsp;&nbsp;
                            Referensi (Opsional)
                            <small class="pull-right">
                                <label>
                                    <input target-editor="editor-referensi" type="checkbox" name="cke_referensi" class="ace" checked>
                                    <span class="lbl">&nbsp; Gunakan editor</span>
                                </label>
                            </small>
                        </h4>
                        <p><small>Tuliskan referensi jawaban sebagai penjelasan. <br>
                                  Peserta ujian dapat melihat referensi ini ketika selesai mengikuti ujian:</small></p>

                        <div class="space-6"></div>
			<textarea id="ereferensi" name="referensi" data-rel="tooltip" class="col-xs-12 cke-referensi" title="Kode atau ID sudah otomatis" data-placement="bottom"></textarea>
		</div>
	</div>

        
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button type="submit" class="btn btn-info" title="Simpan" value="Next" name="sbaru"><i class="fa fa-save"></i>  &nbsp;Simpan dan tambah baru</button>&nbsp;
			<button type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="skeluar"><i class="fa fa-save"></i>  &nbsp; Simpan dan keluar</button>&nbsp;
			<?php
                        if($kode_mapel == 'general') {
                             echo anchor('bsoal','<i class="fa fa-undo"></i>&nbsp; Batal&nbsp;&nbsp;',array('class'=>'add btn '));
                        } else {
                            echo anchor('bsoal/daftar/kode/'.$kode_mapel,'<i class="fa fa-undo"></i>&nbsp; Batal&nbsp;&nbsp;',array('class'=>'add btn '));
                        }
                        ?>
		</div>
	</div>
</form>