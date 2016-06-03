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
echo form_open('ujian/query_update', array('class'=>'form-horizontal','id'=>'form-create'));
?>
<div class="widget-box">

	<div class="widget-body">
		<div class="widget-main">
			<div id="fuelux-wizard-container">
				<div>
					<ul class="steps">
						<li data-step="1" class="active">
							<span class="step">1</span>
							<span class="title">Tentang</span>
						</li>

						<li data-step="2">
							<span class="step">2</span>
							<span class="title">Seleksi Kategori</span>
						</li>

						<li data-step="3">
							<span class="step">3</span>
							<span class="title">Pengaturan Umum</span>
						</li>

						<li data-step="4">
							<span class="step">4</span>
							<span class="title">Pengaturan Hasil</span>
						</li>
					</ul>
				</div>

				<hr />

				<div class="step-content pos-rel">
					<div class="step-pane active" data-step="1">
						<h3 class="center lighter block blue">
                                                    Informsi umum
                                                </h3>
                                                <div class="row">
                                                    <div class="col-sm-12">
															<input name="id_ujian" value="<?php echo $this->uri->segment(4);?>" type="hidden">
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Nama Ujian</label>
                                                                    <div class="col-sm-9">
                                                                            <input required value="<?php echo $record->judul;?>" name="nama" data-rel="tooltip" class="col-xs-8" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Keterangan</label>
                                                                    <div class="col-sm-9">
                                                                            <textarea data-rel="tooltip" name="keterangan" class="col-xs-8" title="Masukan keterangan mata pelajaran" data-placement="bottom"><?php echo $record->keterangan;?></textarea>
                                                                    </div>
                                                            </div>
                                                            
                                                                                                                        
                                                    </div>
                                                </div>
					</div>

					<div class="step-pane" data-step="2">
						<h3 class="center lighter block blue">
                                                    Pengaturan kategori
                                                </h3>
                                            <div class="row">
                                                    <div class="col-sm-12">
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Pilih Kategori Ujian</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="id_kategori" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                                <?php
                                                                                foreach($record_jenis as $rows_jenis):
                                                                                    $sel_k = $record->id_kategori == $rows_jenis->id_kategori ? 'selected' : '';
                                                                                    echo "<option value='$rows_jenis->id_kategori' $sel_k>$rows_jenis->nama_kategori</option>";
                                                                                endforeach;
                                                                                ?>

                                                                        </select>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
					</div>

					<div class="step-pane" data-step="3">
						<div class="center">
							<h3 class="center blue lighter">Pengaturan umum ujian</h3>
						</div>

                                            <div class="row">
                                                    <div class="col-sm-12">
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Tanggal mulai</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <input required id="waktu-mulai" name="waktu_mulai" value="<?php echo date("Y-m-d H:m:s", $record->waktu_mulai);?>" type="text" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Tanggal selesai</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <input required id="waktu-selesai" name="waktu_selesai" value="<?php echo date("Y-m-d H:m:s", $record->waktu_selesai);?>" type="text" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Batas Waktu</label>
                                                                    <div class="col-sm-9">
                                                                            <input required value="<?php echo $record->durasi;?>" name="batas_waktu" data-rel="tooltip" class="col-xs-1" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Batas waktu dalam mengerjakan ujian (satuan menit)</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Batas Akses</label>
                                                                    <div class="col-sm-9">
                                                                            <input required value="<?php echo $record->max_akses;?>" name="batas_akses" data-rel="tooltip" class="col-xs-1" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Batas akses peserta mengikuti ujian</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                             <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Jenis</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="type" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                            <?php 
                                                                            if($record->typr == 'U'): ?>
                                                                            <option value="U" selected>Tes Ujian</option>
                                                                            <option value="L">Latihan</option>
                                                                            <?php else: ?>
                                                                            <option value="U">Tes Ujian</option>
                                                                            <option value="L" selected>Latihan</option>
                                                                            
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                             <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Perlihatkan Jawaban</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="view_answer" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                            <?php 
                                                                            if($record->view_answer == 'N'): ?>
                                                                            <option value="N" selected>Tidak</option>
                                                                            <option value="Y">Ya, perbolehkan peserta dapat melihat jawaban</option>
                                                                            <?php
                                                                            else: ?>
                                                                            <option value="N">Tidak</option>
                                                                            <option value="Y" selected>Ya, perbolehkan peserta dapat melihat jawaban</option>  
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            

					</div>

					<div class="step-pane" data-step="4">
						<div class="center">
							<h3 class="center blue lighter">Pengaturan hasil ujian</h3>
						</div>
                                            <div class="row">
                                                    <div class="col-sm-12">
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Skor Benar</label>
                                                                    <div class="col-sm-9">
                                                                            <input required name="skor_benar" data-rel="tooltip" class="col-xs-1" value="<?php echo $record->skor_benar;?>" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Skor atau nilai pada soal yang benar</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Skor Salah</label>
                                                                    <div class="col-sm-9">
                                                                            <input required name="skor_salah" data-rel="tooltip" class="col-xs-1" value="<?php echo $record->skor_salah;?>" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Skor atau nilai pada soal yang benar</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                             <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Persentase Lulus</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="persentase" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                            <?php
                                                                            for($p = 20; $p <= 100; $p++)
                                                                            {
                                                                                $sel_p = $record->persentase == $p ? 'selected' : '';
                                                                                echo "<option value='$p' $sel_p>$p%</option>";
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                        
                                                                    </div>
                                                            </div>
                                                    </div>
                                                </div>
                                        </div>
				</div>
			</div>

			<hr />
			<div class="wizard-actions">
				<a class="btn btn-default pull-left" href="../../">
					<i class="ace-icon fa fa-undo"></i>
					Batal
				</a>
				<a class="btn btn-prev">
					<i class="ace-icon fa fa-arrow-left"></i>
					Sebelumnya
				</a>

				<a class="btn btn-success btn-next" data-last="Finish">
					Selanjutnya
					<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
				</a>
			</div>
		</div><!-- /.widget-main -->
	</div><!-- /.widget-body -->
</div>
</form>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/datetimepicker.min.css" />	
<script src="<?php echo base_url();?>assets/js/plugins/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datetimepicker.min.js"></script>
<script type="text/javascript">
         jQuery(function($) {
                $('#waktu-mulai').datetimepicker({
                    format: 'YYYY-MM-DD hh:mm:ss'
                })
                .next().on(ace.click_event, function(){
                      $(this).prev().focus();
                 });
                 $('#waktu-selesai').datetimepicker({
                    format: 'YYYY-MM-DD hh:mm:ss'
                })
                .next().on(ace.click_event, function(){
                      $(this).prev().focus();
                 });
                                
         });
</script>