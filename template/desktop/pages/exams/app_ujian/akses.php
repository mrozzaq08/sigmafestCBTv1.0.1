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
echo form_open('exams/submit_ujian/'.$id_ujian,array('id'=>'e-form'));
$pilihan_terpilih = explode(",",$info_waktu['id_pilihans']);
$alfabet = array(
'0'=>'A',
'1'=>'B',
'2'=>'C',
'3'=>'D',
'4'=>'E',
'6'=>'F',
'7'=>'G',
'8'=>'H',
'9'=>'I',
'10'=>'J',
'11'=>'K'
);
foreach($assigned_soal[0] as $key => $pertanyaan){

if($key=='0')
{
    echo '<input type="hidden" value="0" id="current_soal">';
}
/*
 * Jenis Pertnyaan bs-0
 * Muiltiple Pilihan - Benar / Salah
 */  
if($pertanyaan['type_soal'] == 'bs-0') {
?>
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php echo html_entity_decode($pertanyaan['pertanyaan']); ?>
                    </div>
                    <div class="hr hr8 hr-double hr-dotted"></div>
                        <table border="0" width="100%">
                            <?php
                            $count_pil  = 0;
                            shuffle($assigned_soal[1]);
                            foreach($assigned_soal[1] as $keys => $pilihan){
                                if($pilihan['id_soal'] == $pertanyaan['id_soal']){
                                    if ($hasil->type == 'L') 
                                    {
                                        $value_pilihan =  $pilihan['id_pilihan'];
                                    }
                                    else
                                    {
                                        $value_pilihan = $pilihan['id_pilihan']."-".$pilihan['skor'];
                                        
                                    }
                                    if($pilihan_terpilih[$key] == $pilihan['id_pilihan'])
                                    { 
                                       $checked = "checked";
                                    }
                                    else 
                                    {
                                        $checked = "";
                                    }
                                    echo "<tr>";
                                    echo "<td><td width='3%'>$alfabet[$count_pil].</td><td><div class='radio'><label>";
                                    echo "<input id='pilihan-$key-$count_pil' class='ace' type='radio' name='answers_$key' value='$value_pilihan'>";
                                    echo '<span class="lbl">&nbsp;&nbsp;';
                                    echo html_entity_decode($pilihan['pilihan']);
                                    echo "</span></label></div></td>";
                                    echo "</tr>";
                                    $count_pil+=1;
                                }
                                
                            }
                            ?>
                        </table>
                    
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;" onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>                                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
/*
 * Jenis Pertnyaan bs-1
 * Muiltiple Pilihan - Jawaban Tunggal
 */    
else if($pertanyaan['type_soal'] == 'bs-1') {
?>
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php echo html_entity_decode($pertanyaan['pertanyaan']); ?>
                    </div>
                    <div class="hr hr8 hr-double hr-dotted"></div>
                        <table border="0" width="100%">
                            <?php
                            $count_pil  = 0;
                            shuffle($assigned_soal[1]);
                            foreach($assigned_soal[1] as $keys => $pilihan){
                                if($pilihan['id_soal'] == $pertanyaan['id_soal']){
                                    if ($hasil->type == 'L') 
                                    {
                                        $value_pilihan1 =  $pilihan['id_pilihan'];
                                    }
                                    else
                                    {
                                        $value_pilihan1 = $pilihan['id_pilihan']."-".$pilihan['skor'];
                                        
                                    }
                                    if($pilihan_terpilih[$key] == $pilihan['id_pilihan'])
                                    { 
                                       $checked = "checked";
                                    }
                                    else 
                                    {
                                        $checked = "";
                                    }
                                    echo "<tr>";
                                    echo "<td><td width='3%'>$alfabet[$count_pil].</td><td><div class='radio'><label>";
                                    echo "<input id='pilihan-$key-$count_pil' class='ace' type='radio' name='answers_$key' value='$value_pilihan1'>";
                                    echo '<span class="lbl">&nbsp;&nbsp;';
                                    echo html_entity_decode($pilihan['pilihan']);
                                    echo "</span></label></div></td>";
                                    echo "</tr>";
                                    $count_pil+=1;
                                }
                                
                            }
                            ?>
                        </table>
                    
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;" onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>                                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
/*
 * Jenis Pertnyaan bs-2
 * Muiltiple Pilihan - Jawaban Ganda 
 */   
else if($pertanyaan['type_soal'] == 'bs-2') {
?>
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php echo html_entity_decode($pertanyaan['pertanyaan']); ?>
                    </div>
                    <div class="hr hr8 hr-double hr-dotted"></div>
                        <table border="0" width="100%">
                            <?php
                            $count_pil  = 0;
                            shuffle($assigned_soal[1]);
                            foreach($assigned_soal[1] as $keys => $pilihan){
                                if($pilihan['id_soal'] == $pertanyaan['id_soal']){
                                    if ($hasil->type == 'L') 
                                    {
                                        $value_pilihan_2 =  $pilihan['id_pilihan'];
                                    }
                                    else
                                    {
                                        $value_pilihan_2 = $pilihan['id_pilihan']."-".$pilihan['skor'];
                                        
                                    }
                                    if($pilihan_terpilih[$key] == $pilihan['id_pilihan'])
                                    { 
                                       $checked = "checked";
                                    }
                                    else 
                                    {
                                        $checked = "";
                                    }
                                    echo "<tr>";
                                    echo "<td><td width='2%'>$alfabet[$count_pil].</td><td><div class='radio'><label><input class='ace' id='pilihan-$key-$count_pil' type='checkbox' name='answers_".$key."[]' value='$value_pilihan_2'>";
                                    echo '<span class="lbl">&nbsp;&nbsp;';
                                    echo html_entity_decode($pilihan['pilihan']);
                                    echo "</span></label></div></td>";
                                    echo "</tr>";
                                    $count_pil+=1;
                                }
                                
                            }
                            ?>
                        </table>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;"  onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>        
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
/*
 * Jenis Pertnyaan bs-3
 * Melengkapi sebuah pernyataan pada soal atau kalimat
 */   
else if($pertanyaan['type_soal'] == 'bs-3') {
foreach($assigned_soal[1] as $keys => $pilihan){
if($pilihan['id_soal'] == $pertanyaan['id_soal']){
if ($hasil->type == 'L') { $value_lengkapi =  $pilihan['id_pilihan']; }
else { $value_lengkapi = $pilihan['id_pilihan']."-".$pilihan['pilihan']; }
?>
<input type="hidden" name="isian_kosong_<?php echo $key;?>" value="<?php echo $value_lengkapi;?>" >
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php 
                        $bla_replace = "<input type='text' autocomplete='off' name='answers_".$key."' value=''>";
                        echo str_ireplace("_____",$bla_replace,html_entity_decode($pertanyaan['pertanyaan'])); ?>
                    </div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;"  onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>                                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
}
}
/*
 * Jenis Pertnyaan bs-4
 * Isian dan jawaban singkat
 */   
else if($pertanyaan['type_soal'] == 'bs-4') {
if ($hasil->type == 'L') { $value_isian =  $pilihan['id_pilihan']; }
else { $value_isian = $pilihan['id_pilihan']."-".$pilihan['pilihan']; }
?>
<input type="hidden" name="isian_kosong_<?php echo $key;?>" value="<?php echo $value_isian;?>" >
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php echo html_entity_decode($pertanyaan['pertanyaan']); ?>
                    </div>
                    <div class="hr hr8 hr-double hr-dotted"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <tr>
                                <td width="30%">Masukan jawaban</td>
                                <td>
                                    <input type="text" autocomplete="off" name="answers_<?php echo $key;?>" class="col-xs-12" value="<?php //echo $soal_siswa[$pertanyaan['id_soal']];?>">
                                </td>
                            </tr>
                        </table>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;"  onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
/*
 * Jenis Pertnyaan bs-5
 * Mencocokan tau menjodohkan pilihan 
 */   
else if($pertanyaan['type_soal'] == 'bs-5') {
?>
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php echo html_entity_decode($pertanyaan['pertanyaan']); ?>
                    </div>
                    <div class="hr hr8 hr-double hr-dotted"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        
                        <?php 
                        $hitung_pil  = 0;
                        $soal_pilihan = array();
                        $soal_jawab  = array();
                        $id_pilihan  = array();

                        foreach($assigned_soal[1] as $keys => $pilihan){
                            if($pilihan['id_soal'] == $pertanyaan['id_soal']){
                                $pilihan_benar = $pilihan['pilihan'];?>
                                <input type="hidden" name="soal_benar_<?php echo $key;?>" value="<?php echo $pilihan_benar;?>">
                                <?php
                                $cocok          = explode('=',$pilihan['pilihan']);
                                $id_pilihan[]   = $pilihan['id_pilihan'];
                                $soal_pilihan[] = $cocok[0];
                                $soal_jawab[]   = $cocok[1];
                                $hitung_pil+=1;
                            }
                        }


                        ?>
                                
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                        <?php
                        foreach($soal_pilihan as $keym => $val){
                        ?>
                        <input type="hidden" name="soal_pilihan_<?php echo $key;?>[]" value="<?php echo $id_pilihan[$keym];?>">
                        <input type="hidden" name="soal_pilihan_val_<?php echo $key;?>[]" value="<?php echo $val;?>">
                        
                        <tr>
                        <td width="45%"> <?php echo $val; ?> 
                        </td>
                        <td width="5%"><i class="fa fa-exchange"></i></td>
                        <td>
                            <select class="form-control" name="answers_<?php echo $key;?>[]">
                            <option value="">Silahkan pilih pilihan anda</option>
                            <?php 
                            shuffle($soal_jawab);
                            foreach($soal_jawab as $key8 => $val2) { ?>
                                   <option value="<?php echo $val2;?>"><?php echo $val2;?></option>
                            <?php } ?>
                            </select>
                        </td>
                        </tr>
                        <tr rowspan="2">
                            <td colspan="2"><br></td>
                        </tr>
                        <?php
                        }
                        ?>
                        </table>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;"  onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>                                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
/*
 * Jenis Pertnyaan bs-6
 * Pertanyaan essay
 */   
else if($pertanyaan['type_soal'] == 'bs-6') {
?>
<input type="hidden" name="type_soal_<?php echo $key;?>" value="<?php echo $pertanyaan['type_soal'];?>" id="soal_type_<?php echo $key;?>">
<div class="row <?php if($key == '0'){ echo 'tampil-soal'; } else { echo 'hide-soal'; } ?>" id="soal_<?php echo $key;?>">
    <div class="col-sm-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-large">
                <h3 class="widget-title grey lighter">
                    <i class="ace-icon fa fa-question-circle"></i>&nbsp;Soal nomor : <?php echo $key+1; ?>
                </h3>  
                <div class="widget-toolbar">
                    <label class="middle">
                        <input class="ace" id="soal_ragu_<?php echo $key;?>" onclick="soal_ragu('<?php echo $pertanyaan['type_soal'];?>');" type="checkbox"/>
                        <span class="lbl"> saya merasa ragu</span>
                    </label>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main" style="padding: 0">
                    <div class="space-6"></div>
                    <div class="well" style="background: #fff">
                        <?php echo html_entity_decode($pertanyaan['pertanyaan']); ?>
                    </div>
                    <div class="hr hr8 hr-double hr-dotted"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <tr>
                                <td width="30%">Masukan jawaban</td>
                                <td>
                                    <textarea name="answers_<?php echo $key;?>" class="col-xs-12"><?php //echo $soal_siswa[$pertanyaan['id_soal']];?></textarea>
                                </td>
                            </tr>
                        </table>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <div class="space-6"></div>
                        <table border="0" width="100%">
                            <?php if ($hasil->type == 'L') { ?>
                            <tr>
                                <td>
                                <div class="penjelasan_benar" id="penjelasan_benar_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/tick.png"></span>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            <td>
                                <div class="penjelasan_salah" id="penjelasan_salah_id_<?php echo $key; ?>">
                                <span><img style="height:20px;" src="<?php echo base_url(); ?>/images/RidqqzKi9.png"> Jawaban salah</span><br><br>
                                <?php echo $pertanyaan['referensi']?>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td align="left"> 
                                    <?php if($key >= '1'){ ?>
                                    <a class="btn btn-sm btn-default"  onclick="javascript:tampilkan_soal('<?php echo $key-1;?>','<?php echo $pertanyaan['type_soal'];?>');" ><i class="fa fa-chevron-circle-left"></i> &nbsp;Sebelumnya</a>&nbsp;&nbsp;
                                    <?php } if($key!=(count($assigned_soal['0'])-1)){ ?>
                                    <a class="btn btn-sm btn-success" style="cursor:pointer;" 
                                       onclick="tampilkan_soal('<?php echo $key+1;?>','<?php echo $pertanyaan['type_soal'];?>');update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selanjutnya &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                    <?php } else { ?>
                                    <a data-toggle="modal" data-target="#bottom-menu" class="aside-trigger btn btn-sm btn-primary" style="cursor:pointer;" 
                                       onclick="update_current_jawab('<?php echo $key;?>','<?php echo $pertanyaan['type_soal'];?>');" >
                                       <i class="fa fa-save"></i> &nbsp;Simpan dan selesai &nbsp;
                                    </a>
                                    <?php } ?>
                                </td>
                                <td align="right">
                                    &nbsp; 
                                    <a class="btn btn-sm btn-danger" onclick="javascript:hapus_jawaban('<?php echo $key;?>');" ><i class="fa fa-trash-o"></i> &nbsp;Hapus jawaban </a>
                                    &nbsp;
                                    <?php if ($hasil->type != 'U') { ?> 
                                    <a class="btn btn-primary btn-sm" style="cursor:pointer;"  onclick="javascript:periksa_soal('<?php echo $key;?>');" ><i class="fa fa-check-circle"></i> &nbsp;Periksa jawaban</a>
                                    <?php } ?>
                                </td>
                            </tr>
                      </table>                                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
} 
?>
<input type="hidden" name="nosoal" id="nosoal" value="<?php echo $key;?>">
</form>