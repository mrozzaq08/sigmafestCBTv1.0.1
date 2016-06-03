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

$kode_ujian = $this->uri->segment('4'); ?>
    <div class="clearfix">
        <a target="_self" href="javascript:pemilihan_soal('<?php echo $record_ujian->id_ujian;?>','<?php echo $record_ujian->judul;?>','0','0');" class="add btn btn-info btn-sm"><i class="fa fa-question-circle"></i>&nbsp; Kelola soal</a>&nbsp;&nbsp;
        <?php echo anchor('ujian','<i class="fa fa-undo"></i>&nbsp; Kembali&nbsp;&nbsp;',array('class'=>'add btn btn-sm')); ?>&nbsp;&nbsp;
        <div class="pull-right tableTools-container" style="width: 40%;">
            <a class="pull-right btn btn-sm" data-toggle="modal" href="#advanced" style="height: 34px;margin-left: 5px"><i class="fa fa-cog"></i> Penelusuran</a>
        </div>
    </div>
    <div class='space-6'></div>
    <div>
	<table id="data-table" class="tablenay table table-hover" data-tablenay-mode="stack" data-tablenay-sortable data-tablenay-sortable-switch data-tablenay-minimap data-tablenay-mode-switch>
            <thead>
                <tr>
                    <th style="width:3% !important;" class="center no-sortable">
                        #
                    </th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="persist" style="width:20% !important;">Pertanyaan</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-sortable-default-col data-tablenay-priority="3" style="width:6% !important;">Level Soal</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:10% !important;">Mata Pelajaran</th>
                    <th scope="col" data-tablenay-sortable-col data-tablenay-priority="3" style="width:10% !important;">Jenis Soal</th>
                    <th scope="col" data-tablenay-priority="3" style="width:11% !important;color:#555">Pilihan</th>
                    <th scope="col" data-tablenay-priority="3" style="width:4% !important;color:#555">Pindah</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
            if($num_rows > 0):
                $nomor = 1;
                foreach ($record as $key=> $rows):
                    if($rows->type_soal == "bs-0") {
                        $jenis_soal = "TF - Benar / Salah";
                        $bsoal_type = "bsoal-type-0";
                    } else if($rows->type_soal == "bs-1") {
                        $jenis_soal = "MC - Jawaban Tunggal";
                        $bsoal_type = "bsoal-type-1";
                    } else if($rows->type_soal == "bs-2") {
                        $jenis_soal = "MC - Jawaban Ganda";
                        $bsoal_type = "bsoal-type-2";
                    } else if($rows->type_soal == 'bs-3') {
                        $jenis_soal = "Melengkapi Pernyataan";
                        $bsoal_type = "bsoal-type-3";
                    } else if($rows->type_soal == 'bs-4') {
                        $jenis_soal = "Jawaban Singkat";
                        $bsoal_type = "bsoal-type-4";
                    } else if($rows->type_soal == 'bs-5') {
                        $jenis_soal = "Menjodohkan";
                        $bsoal_type = "bsoal-type-5";
                    } else if($rows->type_soal == 'bs-6') {
                        $jenis_soal = "Essay";
                        $bsoal_type = "bsoal-type-6";
                    } else {
                        $jenis_soal = "Tidak terdefinisikan";
                        $bsoal_type = "bsoal-type-undefined";
                    }

                    echo "<tr>";
                    echo "<td align='center'><label class='pos-rel'>
                            $nomor.
                         </td>";
                    echo "<td>".html_entity_decode($rows->pertanyaan)."</td>";
                    echo "<td>";
                    echo "$rows->nama_level";
                    echo "</td>";
                    echo "<td>";
                    echo "$rows->nama";
                    echo "</td>";
                    echo "<td>$jenis_soal</td>";
                    echo "<td>";
                    echo anchor('bsoal/update/'.$rows->id_mapel.'/'.$rows->id_soal.'/'.$bsoal_type,'<i class="fa fa-edit"></i>&nbsp;ubah',array('target'=>'_blank'))."";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo anchor('ujian/delete_soal/'.$kode_ujian.'/'.$rows->id_soal,'<i class="fa fa-trash"></i>&nbsp;hapus',array('class'=>'','target'=>'_parent','onclick'=>"javascript:if(confirm('Yakin ingin menghapus soal ini dari daftar ujian ?') == true) {return true;} else {return false;}"))."";
                    echo "</td><td>";
                    if($key != '0') { 
                        echo "<a target='_self' href=\"javascript:movesoal('Atas','$kode_ujian','$rows->id_soal','".($key+1)."');\"><img style='margin-right: 8px' src=\"".base_url()."assets/images/up.png\" title='Atas'></a>";
                    } else {
                        echo "<img style='margin-right: 8px' src='".base_url()."assets/images/empty.png'>";
                    } 
                    if($key==(count($record)-1)) {
                        echo "<img src=\"".base_url()."assets/images/empty.png\">";
                    } else {
                        echo "<a target='_self' href=\"javascript:movesoal('Bawah','$kode_ujian','$rows->id_soal','".($key+1)."');\"><img src=\"".base_url()."assets/images/down.png\" title='Bawah'></a>";
                    }

                    echo "</td>";
                    echo '</tr>';
                    $nomor++;
                endforeach;
                else:
                echo "<tr class='danger'><td colspan='7' align='center'>
                          <h3><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Data belum ada</h3>
                          <p>Silahkan buat bank soal baru dengan menu yang telah disediakan.</p>
                          </td></tr>";
                endif;
                ?>
            </tbody>
        </table>
    </div>
<div id="peringatan">
    <center>
        <p>Apakah anda yakin akan memindahkan posisi soal ini? </p>
        <p><small>Atur nomor pada kolom untuk lebih spesifik</small></p>
        <input type="number" class="col-xs-2 col-xs-offset-5" id="pos_soal" value=""><br><hr>
        <a target='_self' href="javascript:movesoal();" class="btn btn-danger" style="cursor:pointer;">Batal</a> &nbsp;
        <a target='_self' href="javascript:pindah_posisi();" class="btn btn-info" style="cursor:pointer;">Pindah</a>
    </center>
</div>
<div id="bank_soal"></div>
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