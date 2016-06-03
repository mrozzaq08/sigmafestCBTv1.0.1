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
$id_mapel = $_GET['id_mapel'];
$id_ujian = $_GET['id_topik'];
?>
<form id="form-confirm-changes" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?app=tujian&act=aksi_properti">
    
	<div id="app_header">
        <div class="warp_app_header">
            <div class="app_title">Membuat Properti Ujian</div>
            <div class="app_link">
                <button disabled type="submit" class="btn btn-success" title="Simpan pengaturan"  name="add_pro_stay"><i class="icon-save"></i>  &nbsp; Simpan pengaturan</button>
                <button disabled type="submit" class="btn btn-metis-2" title="Simpan dan keluar"  name="add_pro_out"><i class="icon-save"></i>  &nbsp; Simpan pengaturan dan keluar</button>

                <a class="btn btn-default" href="index.php?app=tujian&id=<?php echo $id_mapel;?>" title="Batal"><i class="icon-reply"></i> Batal</a>
            </div>
        </div>
    </div>

<div class="row">
<div class="col-md-12">
    <div class="well" style="background: #fff;width: 100%">
     
	   <input type="hidden" name="id_ujian" value="<?php echo $id_ujian;?>"/>
        <input type="hidden" name="id_mapel" value="<?php echo $id_mapel;?>"/>
        <div id="tabsleft" class="tabbable tabs-left">
            <ul>
                <li><a target="_self" href="#tabsleft-tab1" style="cursor: no-drop" data-toggle="tab">Pengaturan Umum</a></li>
                <li><a target="_self" href="#tabsleft-tab2" style="cursor: no-drop"  data-toggle="tab">Pengaturan Teks </a></li>
                <li><a target="_self" href="#tabsleft-tab3" style="cursor: no-drop"  data-toggle="tab">Pengaturan Keamanan</a></li>
            </ul>
            <br>
			
            <div id="bar" style="height: 10px;" class="progress progress-success progress-striped active">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <br>
            <div class="tab-content">

                <div class="tab-pane" id="tabsleft-tab1">
                    <h4 class="text-info"><i class="icon icon-cog"></i> Pengaturan umum</h4><hr>
                        <div class="control-group ">
                            <label class="control-label">
                                <p style="color: #777;">Gunakan pengaturan umum anda.</p>
                            </label>
                        </div>
                    <table class="table table-bordered">
                        <tr>
                            <td width="55%">Tampilkan jawaban yang benar</td>
                            <td width="3%">:</td>
                            <td><label><input type="radio" name="show_correct" required value="Y"> Ya</label> &nbsp;&nbsp;
                                <label><input type="radio" name="show_correct" required value="N"> Tidak</label></td>
                        </tr>
                        <tr>
                            <td>Perbolehkan peserta untuk me-review soal ujian</td>
                            <td>:</td>
                            <td><label><input type="radio" name="allow_review" required value="Y"> Ya</label> &nbsp;&nbsp;
                                <label><input type="radio" name="allow_review" required value="N"> Tidak</label></td>
                        </tr>
                        <tr>
                            <td>Peserta atau siswa hanya dapat mengikuti 1 (satu)&nbsp;kali ujian saja</td>
                            <td>:</td>
                           <td><label><input type="radio" name="take_only_once" required value="Y"> Ya</label> &nbsp;&nbsp;
                               <label><input type="radio" name="take_only_once" required value="N"> Bebas</label></td>
                        </tr>
                    </table>
                </div>

                <div class="tab-pane" id="tabsleft-tab2">
                    <h4 class="text-info"><i class="icon icon-info-sign"></i> Pengaturan teks</h4><hr>
                        <div class="control-group ">
                            <label class="control-label">
                                <p style="color: #777;">Silahkan gunakan teks atau kata-kata untuk hasil ujian.</p>
                            </label>
                        </div>
                    <table class="table table-bordered">
                        <tr>
                            <td width="45%">Teks ketika peserta lulus ujian</td>
                            <td width="3%">:</td>
                            <td ><textarea style="border: 1px solid #e0e0e0" rows="5" class="form-control" name="teks_sukses">Selamat anda telah berhasil dalam mengikuti ujian ini, tingkatkan lagi kemampuan anda. Semangat dan terus belajar !</textarea></td>
                        </tr>
                        <tr>
                            <td>Teks ketika peserta tidak lulus ujian</td>
                            <td>:</td>
                            <td><textarea style="border: 1px solid #e0e0e0" rows="5" class="form-control" name="teks_gagal">Mohon maaf, anda belum berhasil dalam mengikuti ujian ini, harap untuk meningkatkan lagi kemampuan anda. Semangat dan terus belajar !</textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="tab-pane" id="tabsleft-tab3">
                    <h4 class="text-info"><i class="icon icon-lock"></i> Pengaturan keamanan</h4><hr>
                        <div class="control-group ">
                            <label class="control-label">
                                <p style="color: #777;">Silahkan gunakan keamanan untuk menjaga akses dari pengguna lain</p>
                            </label>
                            
                        </div>
                    <table class="table table-bordered">
                        <tr>
                            <td width="55%">Gunakan keamanan kata sandi</td>
                            <td width="3%">:</td>
                            <td><label><input type="checkbox" name="protect" value="protect" id="use-protect"> Ya</label></td>
                        </tr>
                        <tr id="password-ujian" style="display: none">
                            <td>Masukan kata sandi keamanan anda</td>
                            <td>:</td>
                           <td><input type="password" class="alphanumeric form-control" style="width: 100%" id="input-pass-ujian" name="password"></td>
                        </tr>
                    </table>
                </div>
                <hr>
                <ul class="pager wizard">
                    <li class="previous first"><a target="_self" href="javascript:;">Pertama</a></li>
                    <li class="previous"><a target="_self" href="javascript:;">Sebelumnya</a></li>
                    <li class="next last"><a target="_self" href="javascript:;">Terakhir</a></li>
                    <li class="next"><a target="_self" href="javascript:;">Selanjutnya</a></li>
                 </ul>
            </div>
        </div>
    </div>		
	</div> 
</div>
</form>