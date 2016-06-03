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
$kode_mapel = $this->uri->segment(3);
$redirect   = $kode_mapel;
echo form_open('bsoal/query_update',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));?>
    <script src="<?php echo base_url();?>plugins/plg_ckeditor/ckeditor.js"></script>
    <input type="hidden" name="redirect" value="<?php echo $redirect;?>"/>
    <input type="hidden" name="id_soal" value="<?php echo $record->id_soal;?>"/>
    <input type="hidden" name="bs_type" value="bs-4">
        <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Mata Pelajaran</label>

		<div class="col-sm-9">
                    <select required name="id_mapel" data-rel="tooltip" data-placeholder="Pilih mata pelajaran" class="col-xs-8 chosen-select">
                            <?php
                            foreach($record_mapel->result() as $rows_mapel):
                                $sel_mapel = $record->id_mapel == $rows_mapel->id_mapel ? 'selected' : '';
                                echo "<option value='$rows_mapel->id_mapel' $sel_mapel>$rows_mapel->nama</option>";
                            endforeach;
                            ?>

                    </select>
                </div>
	</div>
        <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Level Soal</label>

		<div class="col-sm-9">
                    <select required name="id_level" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                            <?php
                            foreach($record_level as $rows_level):
                                $sel_level = $record->id_level == $rows_level->id_level ? 'selected' : '';
                                echo "<option value='$rows_level->id_level' $sel_level>$rows_level->nama_level</option>";
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
			<textarea id="epertanyaan" name="pertanyaan" data-rel="tooltip" class="col-xs-12 cke-pertanyaan" title="Kode atau ID sudah otomatis" data-placement="bottom"><?php echo $record->pertanyaan;?></textarea>
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
			<textarea id="ereferensi" name="referensi" data-rel="tooltip" class="col-xs-12 cke-referensi" title="Kode atau ID sudah otomatis" data-placement="bottom"><?php echo $record->referensi;?></textarea>
		</div>
	</div>
        <div class="hr hr-8 hr-double"></div>

		<?php 
		$query      = $this->db->select('*');
                $query      = $this->db->where('id_soal',$record->id_soal);
                $query      = $this->db->get('pilihan_jawab');
                $data_pil   = $query->row();
		?>

        <div class="form-group">
		<label class="col-sm-3 control-label no-padding-right">Tulis Jawaban Benar</label>
                <div class="col-sm-9">
						<input type="hidden" value="<?php echo $data_pil->id_pilihan;?>" name="id_pilihan[]">
                        <input required name="option[]" data-rel="tooltip" class="col-xs-8" value="<?php echo $data_pil->pilihan;?>" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" /><br>
                        <br><p>
                    <small>Berikan simbol koma&nbsp;(,)&nbsp;pada kolom jawaban untuk jawaban lain (jika lebih dari satu jawaban).<br>
                        Contoh: jawban 1,jawban 2,jawaban 3<br>
                        Tidak case sensitive</small></p>

                </div>

	</div>

        
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button disabled="disabled" type="submit" class="btn btn-info" title="Simpan" value="Next" name="update_stay"><i class="fa fa-save"></i>  &nbsp;Simpan perubahan</button>&nbsp;
			<button disabled="disabled" type="submit" class="btn btn-success" title="Simpan dan keluar" value="Next" name="update_exit"><i class="fa fa-save"></i>  &nbsp; Simpan dan keluar</button>&nbsp;
			<?php echo anchor('bsoal/daftar/kode/'.$kode_mapel,'<i class="fa fa-undo"></i>&nbsp; Batal&nbsp;&nbsp;',array('class'=>'add btn ')); ?>&nbsp;&nbsp;
		</div>
	</div>
</form>