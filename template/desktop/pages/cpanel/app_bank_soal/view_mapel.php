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
echo form_open('bsoal/delete', array('id'=>'form')); ?>
    <div class="clearfix">
        <?php echo anchor('bsoal/create/new/general/bsoal-type-1','<i class="fa fa-plus-circle"></i>&nbsp; Bank soal baru&nbsp;&nbsp;',array('class'=>'add btn btn-info btn-sm')); ?>&nbsp;&nbsp;
        <a class="add btn btn-success btn-sm btn-grad" href="#import-wizard" data-toggle="modal" title="Tambahkan siswa baru dengan import data"><i class="fa fa-upload"></i> Import bank soal</a>&nbsp;&nbsp;
        <div class="pull-right tableTools-container" style="width: 40%;">
            <a class="pull-right btn btn-sm" data-toggle="modal" href="#advanced" style="height: 34px;margin-left: 5px"><i class="fa fa-cog"></i> Penelusuran</a>
            <?php echo form_open('mapel',array('class' => 'form-search form-inline', 'method' => 'post')); ?>
                <div class="input-append">
                    <button type="submit" class="pull-right btn btn-info2 btn-sm" style="height: 34px"><i class="fa fa-search"></i></button>
                    <input type="text" name="keyword" class="pull-right col-sm-7" placeholder=" Penelusuran mata pelajaran">
                </div>
            </form>
        </div>
    </div>
    <div class='space-6'></div>
    <div>
	<table id="data-table" class="tablenay table table-striped table-bordered table-hover" data-tablenay-mode="stack" data-tablenay-sortable data-tablenay-sortable-switch data-tablenay-minimap data-tablenay-mode-switch>
            <thead>
                <tr>
                    <th style="width:3% !important;" class="center no-sortable">
                        #
                    </th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:20% !important;">Nama Mata Pelajaran</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:20% !important;">Guru Pengajar</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:15% !important;">Jumlah Bank Soal</th>
                    <th scope="col" data-tablenay-priority="3" style="width:7% !important;color:#555">Pilihan</th>
                </tr>
            </thead>
            <tbody>
			<?php
			if($record->num_rows() > 0):
                $nomor = 1;
                foreach ($record->result() as $rows):
                    echo "<tr>";
                    echo "<td align='center'>$nomor.</td>";
                    echo "<td>$rows->nama</td>";
                    echo "<td>";
                    $query_p  = $this->db->select('id_pengajar,nama_lengkap');
                    $query_p  = $this->db->where('id_pengajar',$rows->id_pengajar);
                    $query_p  = $this->db->get('pengajar');
                    $data_p   = $query_p->row();
                    echo "<a>$data_p->nama_lengkap</a>&nbsp;&nbsp;";
                    echo "</td>";
                    $query_s  = $this->db->select('id_soal');
                    $query_s  = $this->db->where('id_mapel',$rows->id_mapel);
                    $query_s  = $this->db->get('bank_soal');
                    $jumlah_s = $query_s->num_rows();
                    if($jumlah_s > 0) {
                        echo "<td class='success'><span class='text-info'>Total ada $jumlah_s bank soal</span></td>";
                    } else {
                        echo "<td class='danger'><span class='text-danger'>Belum ada data bank soal</span></td>";
                    }
                    echo "<td>".anchor('bsoal/daftar/kode/'.$rows->id_mapel,'<i class="fa fa-eye"></i> &nbsp;Soal',array('class'=>''))."</td>";
                    echo '</tr>';
                    $nomor++;
                endforeach;
				else:
				echo "<tr class='danger'><td colspan='5' align='center'>
					  <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
					  <p>Silahkan buat mata pelajaran baru dengan menu yang telah disediakan.</p>
					  </td></tr>";
				endif;
                ?>
            </tbody>
        </table>
    </div>
</form>

<div id="import-wizard" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
                    <?php
                    echo form_open_multipart('bsoal/import_bsoal',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));
                    ?>
			<div id="modal-wizard-container">
				<div class="modal-header">
					<ul class="steps">
						<li data-step="1" class="active">
							<span class="step">1</span>
							<span class="title">Baca Info</span>
						</li>

						<li data-step="2">
							<span class="step">2</span>
							<span class="title">Download Template</span>
						</li>

                                                <li data-step="3">
							<span class="step">2</span>
							<span class="title">Pilih Kategori</span>
						</li>


						<li data-step="4">
							<span class="step">3</span>
							<span class="title">Upload Template</span>
						</li>
					</ul>
				</div>

				<div class="modal-body step-content">
					<div class="step-pane active" data-step="1">
						<div class="center">
							<h4 class="blue">Tentang Import Data</h4>
						</div>
						<p style="color: #777;">Fitur <strong>Import data</strong> hanya bisa digunakan melalui berkas <i>Ms. Excel dengan format (97/2003) spreadsheets</i>. Download berkas atau template Ms. Excel yang telah dimodifikasi,
							dan lakukan pengisian data pada kolom yang telah disediakan. Lakukan langkah sesuai petunjuk dan klik tombol <strong>selanjutnya</strong>
						</p>
					</div>

					<div class="step-pane" data-step="2">
						<div class="center">
							<h4 class="blue">Langkah 1 - Download Template</h4>
						</div>
						<p style="color: #777;">Jika belum punya template, download berkas Ms. Excel yang telah dimodifikasi untuk
                                 tempat pengisian data pada field atau baris yang telah disediakan.</p>
						<hr>
						<a href="resources/template/template-bank-soal.xls" target="_self" class="btn btn-info btn-small"><i class="icon-download"></i> Download template bank soal</a>
                                                <hr>
                                                Atau download contoh template yang sudah terdapat isian data. <br><a target="_self" href="resources/contoh/contoh-bank-soal.xls">Downlod contoh template</a>
					</div>

                                    <div class="step-pane" data-step="3">
						<div class="center">
							<h4 class="blue">Langkah 2 - Pilih kategori</h4>
						</div>
						<p style="color: #777;text-align: center">Pilih kategori untuk bank soal pada pilihan berikut ini.</p>
						<hr>

                                                <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right">Mata Pelajaran</label>

                                                        <div class="col-sm-9">
                                                            <select required name="id_mapel" data-rel="tooltip" data-placeholder="Pilih mata pelajaran" class="col-xs-8">
                                                                    <?php
                                                                    foreach($record_mapel->result() as $rows_mapel):
                                                                    echo "<option value='$rows_mapel->id_mapel'>$rows_mapel->nama</option>";
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
                                                                    echo "<option value='$rows_level->id_level'>$rows_level->nama_level</option>";
                                                                    endforeach;
                                                                    ?>

                                                            </select>
                                                        </div>
                                                </div>
                                    </div>

					<div class="step-pane" data-step="4">
						<div class="center">
							<h4 class="blue">Langkah 3 - Upload Template</h4>
						</div>
						<p style="color: #777;">Selanjutnya upload berkas Ms. Excel yang sudah anda download sebelumnya. Pastikan berkas sudah di isi dengan data yang benar.</small>
                        <hr>
						<div class='fileinput fileinput-new' data-provides='fileinput'>
							<div class='fileinput-preview fileinput-exists thumbnail' style='padding-top: 0px; padding-left: 15px; padding-right: 15px; height: 50px;'></div>
							<div>
								<span class='btn btn-default btn-file'><span class='fileinput-new'>Pilih berkas dari komputer anda</span>
									<span class='fileinput-exists'>Pilih berkas dari komputer anda</span>
									<input type="file" name="fxls" style="cursor: pointer" class="form-control">
								</span>
								<a href='#' class='btn btn-default fileinput-exists' data-dismiss='fileinput'>Hapus</a>
                                                                <br><br>
                                                                <button type="submit" class="btn btn-success fileinput-exists"> Simpan dan mulai import</button>

							</div>
						</div>
                                        </div>
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				<a class="btn btn-sm btn-prev">
					<i class="ace-icon fa fa-arrow-left"></i>
					Sebelumnya
				</a>

				<a class="btn btn-success btn-sm btn-next" data-last="Finish">
					Selanjutnya
					<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
				</a>

				<a class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-undo"></i>
					Batal
				</a>
			</div>
                </form>
		</div>
	</div>
</div>
<div class="modal fade" id="advanced" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" style="display:none">
    <div class="modal-dialog modal-info">
        <div class="modal-content modal-question">
            <div class="modal-header">
                <h4 class="modal-title">Penelusuran Lanjutan</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class='fa fa-undo'></i>&nbsp;Batal</button><button type="button" class="btn btn-info2 btn-sm btn-grad" id="confirm" name="advanced"><i class='fa fa-search'></i>&nbsp; OK</button>	
            </div>
        </div>
    </div>
</div>