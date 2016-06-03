<?php
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
 
$assign_id_soals = array();
foreach($record_soal as $key => $data_id_soal){
    $assign_id_soals[] = $data_id_soal->id_soal;
}
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <select name="search_type" id="search_type" class="form-control" style="width:150px;float: left">
                <option value="bank_soal.id_soal">ID Soal</option>
                <option value="bank_soal.pertanyaan">Pertanyaan</option>
                <option value="mapel.nama">Mata Pelajaran</option>
                <option value="level_soal.nama_level">Level Soal</option>
            </select>
            <input type="text" name="search" id="search" value="" style="width:150px;float: left;margin-left:10px;"> 
            <button type="button" class="btn btn-sm btn-default" style="float:left;margin-left:10px;" onClick="search_pemilihan_soal('<?php echo $id_ujian;?>','<?php echo $judul_ujian;?>','0');"><i class="fa fa-search"></i>&nbsp; Pencarian</button>
        </div>
        <div class="col-xs-6">
            <a style="width: 18%; margin-left: 2%" href="javascript:tutup_pemilihan('<?php echo $id_ujian;?>');" class="pull-right btn btn-sm btn-danger">
                <i class="fa fa-eye-slash"></i>&nbsp; Tutup
            </a>
            <select class="form-control" style="float:right;width: 80%" onChange="pemilihan_soal('<?php echo $id_ujian;?>','<?php echo $judul_ujian;?>','0',this.value);">
                <option value="0">Pengurutan: Semua mata pelajaran</option>
                <?php foreach($record_mapel->result() as $value){ ?>
                <option value="<?php echo $value->id_mapel; ?>" <?php if($fid_mapel == $value->id_mapel){ echo 'selected';}?> ><?php echo $value->nama; ?></option>
                <?php } ?>
            </select>
            
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Tambahkan soal ke <?php echo urldecode($judul_ujian); ?></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>				
                                <tr>
                                    <th>ID</th>
                                    <th>Pertanyaan</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Level</th>
                                    <th>Jenis Soal</th>
                                    <th>Pilihan</th>
                                </tr>
                                <?php if($hasil==false){ ?>
                                    <tr class="danger">
                                    <td colspan="6">
                                    Belum ada data bank soal, silahkan menuju pengelolaan bank soal
                                    </td>
                                    </tr>
                                <?php } else { 
                                foreach($hasil as $key=> $rows) {
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
                                    ?>
                                    <tr>
                                    <td>
                                        <?php echo $rows->id_soal;?>
                                    </td>
                                    <td>
                                        <?php echo substr(strip_tags($rows->pertanyaan),"0","50");?>
                                    </td>
                                    <td>
                                        <?php echo $rows->nama;?>
                                    </td>
                                    <td>
                                        <?php echo $rows->nama_level;?>
                                    </td>
                                    <td>
                                        <?php echo $jenis_soal;?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('bsoal/update/'.$rows->id_soal.'/'.$bsoal_type );?>" target="edit_question" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Ubah</a>
                                        <?php if(in_array($rows->id_soal,$assign_id_soals)) { ?>
                                        <a href="javascript:hapus_soal('<?php echo $id_ujian;?>','<?php echo $rows->id_soal;?>');soal_deleted('delete<?php echo $key;?>');" id="delete<?php echo $key;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> 
                                        Hapus
                                        </a>
                                        <?php } else { ?>
                                        <a href="javascript:tambah_soal('<?php echo $id_ujian;?>','<?php echo $rows->id_soal;?>');soal_added('add<?php echo $key;?>');"  id="add<?php echo $key;?>" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> 
                                        Tambah
                                        </a>
                                        <?php } ?>
                                        </a>
                                    </td>
                                    </tr>
                                    <?php
                                    }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        &nbsp;&nbsp;
        <?php if(($batas-($this->config->item('number_of_rows')))>=0){ $back=$batas-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

        <a href="javascript:pemilihan_soal('<?php echo $id_ujian;?>','<?php echo $judul_ujian;?>','<?php echo $back;?>','<?php echo $fid_mapel;?>');" class="btn btn-sm btn-default pull-left">
            <i class="fa fa-angle-double-left"></i>&nbsp; Sebelumnya
        </a>
        &nbsp;
        <?php $next=$batas+($this->config->item('number_of_rows'));  ?>
        <a href="javascript:pemilihan_soal('<?php echo $id_ujian;?>','<?php echo $judul_ujian;?>','<?php echo $next;?>','<?php echo $fid_mapel;?>');" class="btn btn-info btn-sm">
            Selanjutnya &nbsp;<i class="fa fa-angle-double-right"></i>
        </a>&nbsp;&nbsp;
        <a href="javascript:tutup_pemilihan('<?php echo $id_ujian;?>');" class="pull-right btn btn-sm btn-danger">
            <i class="fa fa-close"></i>&nbsp; Tutup dan keluar
        </a>
</div>
<br>
<br>