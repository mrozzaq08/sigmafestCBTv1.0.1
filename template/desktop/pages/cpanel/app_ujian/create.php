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
echo form_open('ujian/query_create', array('class'=>'form-horizontal','id'=>'form-create')); ?>
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
                                Informasi umum
                            </h3>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Nama Ujian</label>
                                                                    <div class="col-sm-9">
                                                                            <input required name="nama" data-rel="tooltip" class="col-xs-8" type="text" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Keterangan</label>
                                                                    <div class="col-sm-9">
                                                                            <textarea data-rel="tooltip" name="keterangan" class="col-xs-8" title="Masukan keterangan mata pelajaran" data-placement="bottom"></textarea>
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
                                                                    <label class="col-sm-3 control-label no-padding-right">Mata Pelajaran</label>
                                                                    <div class="col-sm-9">
                                                                        <select required onchange="javascript:show_kelas_mapel(this.value);" name="id_mapel" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                            <option value="">PILIH MATA PELAJARAN</option>
                                                                            <?php
                                                                            foreach($record_mapel->result_array() as $rows_mapel):
                                                                                echo "<option value='$rows_mapel[id_mapel]'>$rows_mapel[nama]</option>";
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group" id="area-kelas">
                                                                    
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Pilih Kategori Ujian</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="id_kategori" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                                <?php
                                                                                foreach($record_jenis as $rows_jenis):
                                                                                    echo "<option value='$rows_jenis->id_kategori'>$rows_jenis->nama_kategori</option>";
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
                                                                            <input required id="waktu-mulai" name="waktu_mulai" value="<?php echo date("Y-m-d H:i:00");?>" type="text" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Tanggal selesai</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <input required id="waktu-selesai" name="waktu_selesai" value="<?php echo date("Y-m-d H:i:00");?>" type="text" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Batas Waktu</label>
                                                                    <div class="col-sm-9">
                                                                            <input required value="20" name="batas_waktu" data-rel="tooltip" class="col-xs-1" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Batas waktu dalam mengerjakan ujian (satuan menit)</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Batas Akses</label>
                                                                    <div class="col-sm-9">
                                                                            <input required value="1" name="batas_akses" data-rel="tooltip" class="col-xs-1" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Batas akses peserta mengikuti ujian</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                             <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Jenis</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="type" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                            <option value="U">Tes Ujian</option>
                                                                            <option value="L">Latihan</option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                             <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Perlihatkan Jawaban</label>
                                                                    <div class="col-sm-9">
                                                                        <select required name="view_answer" data-rel="tooltip" data-placeholder="Pilih guru atau pengajar" class="col-xs-8">
                                                                            <option value="N">Tidak</option>
                                                                            <option value="L">Ya, perbolehkan peserta dapat melihat jawaban</option>
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
                                                                            <input required name="skor_benar" data-rel="tooltip" class="col-xs-1" value="1" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
                                                                            <p style="margin-top: 5px;">
                                                                            <small style="margin-left: 10px;">Skor atau nilai pada soal yang benar</small>
                                                                            </p>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right">Skor Salah</label>
                                                                    <div class="col-sm-9">
                                                                            <input required name="skor_salah" data-rel="tooltip" class="col-xs-1" value="0" type="number" title="Masukan nama mata pelajaran" data-placement="bottom" />
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
                                                                                echo "<option value='$p'>$p%</option>";
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
				<a class="btn btn-default pull-left" href="../">
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

<script type="text/javascript">
function show_kelas_mapel(kodemapel)
{
    var form_data = {
        id_mapel : kodemapel
    };
        $.ajax({
           url:"<?php echo base_url().'ujian/ajax_get_kelas_mapel';?>",
           data: form_data,
           type:"post",
           dataType:"html",
           timeout: 10000,
		   beforeSend: function() {
			   $("#area-kelas").html('<center><img src="../../assets/Images/update.gif">&nbsp;&nbsp;Memuat daftar kelas</center>');
		   },
           success: function(response) {
               $("#area-kelas").html(response);
           }
        });
}
</script>
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