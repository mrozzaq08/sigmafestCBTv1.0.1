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
echo form_open('guru/delete', array('id'=>'form')); ?>
    <div class="clearfix">
        <?php echo anchor('guru/create/new','<i class="fa fa-plus-circle"></i>&nbsp; Guru baru&nbsp;&nbsp;',array('class'=>'add btn btn-info btn-sm')); ?>&nbsp;
        <a class="add btn btn-success btn-sm btn-grad" href="#import-wizard" data-toggle="modal" title="Tambahkan siswa baru dengan import data"><i class="fa fa-upload"></i> Import data guru</a>&nbsp;
        <button type="submit" class="delete btn btn-danger btn-sm btn-grad" title="Hapus" name="hapus"><i class="fa fa-trash"></i> &nbsp;Hapus data</button>
        <div class="pull-right tableTools-container" style="width: 40%;">
            <a class="pull-right btn btn-sm" data-toggle="modal" href="#advanced" style="height: 34px;margin-left: 5px"><i class="fa fa-cog"></i> Penelusuran</a>
        </div>
    </div>
    <div class='space-6'></div>
    <div>
	<table id="data-table" class="tablenay table table-striped table-bordered table-hover" data-tablenay-mode="stack" data-tablenay-sortable data-tablenay-sortable-switch data-tablenay-minimap data-tablenay-mode-switch>
            <thead>
                <tr class="headers">
                    <th style="width:3% !important;" class="center no-sortable">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" id='checkall' target='cek_data[]' />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:15% !important;">NIP</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:20% !important;">Nama Lengkap</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:20% !important;">Alamat</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:15% !important;">Mobile</th>
                    <th scope="col" data-tablenay-priority="3" style="width:7% !important;color:#555">Pilihan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($num_rows > 0):
                $nomor = 1;
                foreach ($record as $rows):
                    echo "<tr>";
                    echo "<td align='center'><label class='pos-rel'>
                            <input type='checkbox' class='ace' name='cek_data[]' value='$rows[id_pengajar]' />
                            <span class='lbl'></span>
			    </label>
                         </td>";
                    echo "<td>$rows[nip]</td>";
                    echo "<td>";
                    echo "$rows[nama_lengkap]";
                    echo "</td>";
                    echo "<td>$rows[alamat]</td>";
                    echo "<td>$rows[no_telp]</td>";
                    echo "<td>".anchor('guru/update/kode/'.$rows['id_pengajar'],'<i class="fa fa-edit"></i> &nbsp;Ubah',array('class'=>''))."</td>";
                    echo '</tr>';
                    $nomor++;
                endforeach;
            else:
            echo "<tr class='danger'><td colspan='6' align='center'>
                  <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
                  <p>Silahkan buat data guru atau pengajar baru dengan menu yang telah disediakan.</p>
                  </td></tr>";
            endif;
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='6'>
                        <div class="pager">
                            <ul class="pagination">
                                <?php echo $this->pages->create_links();?>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</form>
<div id="import-wizard" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
                    <?php
                    echo form_open_multipart('guru/import_guru',array('class'=>'form-horizontal','id'=>'form-confirm-changes'));
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
						<p style="color: #777;">Fitur <strong>Import data</strong> hanya bisa digunakan melalui berkas <i>Ms. Excel dengan format (97/2003) spreadsheets</i>. Silahkan download berkas atau template Ms. Excel yang telah dimodifikasi,
							dan lakukan pengisian data pada kolom yang telah disediakan. Silahkan lakukan langkah sesuai petunjuk dan klik <strong>selanjutnya</strong>
						</p>
					</div>

					<div class="step-pane" data-step="2">
						<div class="center">
							<h4 class="blue">Langkah 1 - Download Template</h4>
						</div>
						<p style="color: #777;">Jika belum punya template, download berkas Ms. Excel yang telah dimodifikasi untuk
                                 tempat pengisian data pada field atau baris yang telah disediakan.</p>
						<hr>
						<a href="resources/template/template-guru.xls" target="_self" class="btn btn-info btn-small"><i class="icon-download"></i> Download template guru</a>
                                                <hr>
                                                Atau download contoh template yang sudah terdapat isian data. <br><a href="resources/contoh/contoh-guru.xls" target="_self">Downlod contoh template</a>
					</div>


					<div class="step-pane" data-step="3">
						<div class="center">
							<h4 class="blue">Langkah 2 - Upload Template</h4>
						</div>
						<p style="color: #777;">Tahap terakhir Silahkan upload berkas Ms. Excel yang sudah di download sebelumnya. Pastikan berkas sudah di isi dengan data yang benar.</small>
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