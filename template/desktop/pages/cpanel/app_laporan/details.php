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
$id_ujian          	= $_GET['idq'];
$getid_kelas    	= $_GET['idk'];
$qgetkelas      	= $DBH->query("SELECT * FROM kelas WHERE id_kelas='$getid_kelas'");
$dgetkelas      	= $qgetkelas->fetch(PDO::FETCH_OBJ);
$qujian         	= $DBH->query("SELECT * FROM topik_ujian WHERE id_ujian='$id_ujian'");
$dujian         	= $qujian->fetch(PDO::FETCH_OBJ);
$qmapel         	= $DBH->query("SELECT * FROM mapel WHERE id_mapel='$dujian->id_mapel'");
$dmapel         	= $qmapel->fetch(PDO::FETCH_OBJ);
$id_kelas       	= explode(",",$dujian->id_kelas);
$cek_pilganda   	= $DBH->query("SELECT * FROM soal_pg WHERE id_ujian='$id_ujian'");
$jumlah_pilganda    = $cek_pilganda->rowCount();
$cek_soal_esay      = $DBH->query("SELECT * FROM soal_esay WHERE id_ujian='$id_ujian'");
$jumlah_soal_esay   = $cek_soal_esay->rowCount();
if($jumlah_pilganda > 0 && $jumlah_soal_esay > 0 ) {
?>
<div id="app_header">
	<div class="warp_app_header">
		<a target='_parent' class="btn btn-md btn-metis-2" href="system/download.php?act=excel&jenis=semua&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To Excel</a>&nbsp;
		<a target='_parent' class="btn btn-md btn-info" href="system/download.php?act=word&jenis=semua&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To Word</a>&nbsp;
		<a target='_parent' class="btn btn-md btn-danger" href="system/download.php?act=pdf&jenis=semua&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To PDF</a>&nbsp;
		<a class="btn btn-md btn-default" href="index.php?app=koreksi&act=koreksi&id_topik=<?php echo $_GET['idq'];?>"><i class="icon-reply"></i>  Kembali</a>&nbsp;

		<div class="app_title">Data Peserta Ujian - Kelas <?php echo $dgetkelas->nama;?></div>
	</div>
</div>
<div class="alert-info" style="padding: 15px;border: 1px solid #d0d0d0">
<h3 style="margin-top: 0px"><i class="icon-info"></i> Informasi penting</h3>
<p>Reset peserta ujian berfungsi untuk menghapus data nilai berdasarkan data siswa yang dipilih <br>kemudian siswa bisa mengikuti kembali ujian pada modul ini.</p>
</div>
<form action="" method="post">
    <table class= "data table-condensed">
        <thead>
            <tr>								  
                <th style="width:5% !important;">No.
                </th>		
                <th style="width:10% !important;">Nama Siswa</th>
                <th style="width:10% !important;">Status</th>
                <th style="width:10% !important; text-align: center">Nilai PG</th>
                <th style="width:10% !important; text-align: center">Nilai Essay</th>
                <th style="width:10% !important; text-align: center">Nilai Total</th>
                <th style="width:20% !important;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $idk = $_GET['idk'];
            $idq = $_GET['idq'];
            $qkelas = $DBH->query("SELECT * FROM siswa WHERE id_kelas='$idk' ORDER BY nama_lengkap ASC");
            $no = 1;
            while($dkelas = $qkelas->fetch(PDO::FETCH_ASSOC)) {
                $cek_pekerjaan = $DBH->query("SELECT * FROM peserta_ujian WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $cek_jumlah = $cek_pekerjaan->rowCount();
                $data_pekerjaan = $cek_pekerjaan->fetch(PDO::FETCH_ASSOC);
                $cek_nilai_pg = $DBH->query("SELECT * FROM nilai_pg WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $data_nilai_pg = $cek_nilai_pg->fetch(PDO::FETCH_ASSOC);
                $cek_nilai_esay = $DBH->query("SELECT * FROM nilai_esay WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $data_nilai_esay = $cek_nilai_esay->fetch(PDO::FETCH_ASSOC);
                $nilai_total    = ($data_nilai_pg['persentase'] + $data_nilai_esay['nilai']) / 2;
                if($cek_jumlah > 0 ) { 
                    $status = "<b class='text-success'>Sudah mengerjakan</b>";
                    $nilai_pg = $data_nilai_pg['persentase'];
					$reset    = "<a class='btn btn-default' onclick=\"return confirm('Yakin ingin mereset peserta ujian ini ?');\" href='?app=koreksi&act=reset&id_siswa=$dkelas[id_siswa]&id_ujian=$idq'>Reset peserta ujian</a>";
                    if($nilai_pg>=$dmapel->kkm) {
                        $nilai_pg = "<b class='text-success'>$nilai_pg</b>";
                    }
                    else {
                        $nilai_pg = "<b class='text-danger'>$nilai_pg</b>";
                    }

                    if($data_pekerjaan['koreksi']=='B') {
                        $aksi = "<a href=?app=koreksi&act=mulai_koreksi&id_siswa=$dkelas[id_siswa]&id_ujian=$idq&token=".md5('koreksi')."' class='btn'><i class='icon-ok'></i> Koreksi Essay</a>";
                        $nilai_esay = "<b class='text-danger'>Belum dikoreksi</b>";
                    } else {
                        //$aksi = "<a href=?app=koreksi&act=edit_koreksi&id_siswa=$dkelas[id_siswa]&id_ujian=$idq&token=".md5('koreksi')."' class='btn'><i class='icon-pencil'></i> Edit koreksi</a>";
                        $aksi = "";
                        $nilai_esay = $data_nilai_esay['nilai'];
                    }

                } else {
                    $aksi = '';
                    $status = "<b class='text-danger'>Belum mengerjakan</b>";
                    $nilai_pg = "-";
                    $nilai_esay = "-";
					$reset = '-';
                }
                echo"<tr><td>$no.</td><td>$dkelas[nama_lengkap]</td><td>$status</td>
                <td><center>$nilai_pg</center></td><td><center>$nilai_esay</center></td>
                <td><center>$nilai_total</center></td><td>$aksi&nbsp;&nbsp;
                ".$reset."</td>
                </tr>";
            $no++;
            } ?>
        </tbody>			
    </table>
</form>
<?php }
else if($jumlah_pilganda > 0 && $jumlah_soal_esay < 1) {
?>
<div id="app_header">
	<div class="warp_app_header">
		<a target='_parent' class="btn btn-md btn-success" href="system/download.php?act=excel&jenis=pil_ganda&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To  Excel</a>&nbsp;
		<a target='_parent' class="btn btn-md btn-primary" href="system/download.php?act=word&jenis=pil_ganda&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To  Word</a>&nbsp;
		<a target='_parent' class="btn btn-md btn-danger" href="system/download.php?act=pdf&jenis=pil_ganda&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i> Download To PDF</a>&nbsp;
		<a class="btn btn-md btn-default" href="index.php?app=koreksi&act=koreksi&id_topik=<?php echo $_GET['idq'];?>"><i class="icon-reply"></i>  Kembali</a>&nbsp;
		<div class="app_title">Data Peserta Ujian - Kelas <?php echo $dgetkelas->nama;?></div>
	</div>
</div>
<div class="alert-info" style="padding: 15px;border: 1px solid #d0d0d0">
<h3 style="margin-top: 0px"><i class="icon-info"></i> Informasi penting</h3>
<p>Reset peserta ujian berfungsi untuk menghapus data nilai berdasarkan data siswa yang dipilih <br>kemudian siswa bisa mengikuti kembali ujian pada modul ini.</p>
</div>
<form action="" method="post">
    <table class= "data table-condensed">
        <thead>
            <tr>
                <th style="width:5% !important;">No.
                </th>
                <th style="width:6% !important;">NIS</th>
                <th style="width:10% !important;">Nama Siswa</th>
                <th style="width:10% !important;">Status</th>
                <th style="width:5% !important; ">Nilai</th>
                <th style="width:10% !important; ">Keterangan</th>
                <th style="width:10% !important;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $idk = $_GET['idk'];
            $idq = $_GET['idq'];
            $qkelas = $DBH->query("SELECT * FROM siswa WHERE id_kelas='$idk' ORDER BY nama_lengkap ASC");
            $no = 1;
            while($dkelas = $qkelas->fetch(PDO::FETCH_ASSOC)) {
                $cek_pekerjaan = $DBH->query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $cek_jumlah = $cek_pekerjaan->rowCount();
                $data_pekerjaan = $cek_pekerjaan->fetch(PDO::FETCH_ASSOC);
                $cek_nilai_pg = $DBH->query("SELECT * FROM nilai_pg WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $data_nilai_pg = $cek_nilai_pg->fetch(PDO::FETCH_ASSOC);
                $cek_nilai_esay = $DBH->query("SELECT * FROM nilai_esay WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $data_nilai_esay = $cek_nilai_esay->fetch(PDO::FETCH_ASSOC);

                if($cek_jumlah > 0 ) {
                    $status = "<b class='text-success'>Sudah mengerjakan</b>";
                    $nilai_pg = $data_nilai_pg['persentase'];
                    $reset = "<a onclick=\"return confirm('Yakin ingin mereset peserta ujian ini ?');\" class='btn btn-default' href='?app=koreksi&act=reset&id_siswa=$dkelas[id_siswa]&id_ujian=$idq'>Reset peserta ujian</a>";

                    if($nilai_pg>=$dmapel->kkm) {
                        $nilai_pg = $nilai_pg;
                        $keterangan = "<b class='text-success'>Lulus</b>";
                    }
                    else {
                        $nilai_pg = $nilai_pg;
                        $keterangan = "<b class='text-danger'>Tidak lulus</b>";
                    }
                    

                } else {
                    $status = "<b class='text-danger'>Belum mengerjakan</b>";
                    $nilai_pg = "-";
                    $reset = "-";
                    $keterangan = "-";
                }
                echo"<tr><td>$no.</td><td>$dkelas[nis]</td>
				<td>$dkelas[nama_lengkap]</td><td>$status</td>
				<td>$nilai_pg</td><td>".$keterangan."</td>
				<td>&nbsp;&nbsp;".$reset."</td></tr>";
            $no++;
            } ?>
        </tbody>
    </table>
</form>
<?php }
else if($jumlah_pilganda < 1 && $jumlah_soal_esay > 0) { ?>
<div id="app_header">
            <div class="warp_app_header">
                <a target='_parent' class="btn btn-md btn-success" href="system/download.php?act=excel&jenis=essay&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To  Excel</a>&nbsp;
                <a target='_parent' class="btn btn-md btn-primary" href="system/download.php?act=word&jenis=essay&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To  Word</a>&nbsp;
                <a target='_parent' class="btn btn-md btn-danger" href="system/download.php?act=pdf&jenis=essay&id_kelas=<?php echo $_GET['idk'].'&id_ujian='.$_GET['idq'];?>"><i class="icon-download"></i>  Download To </a>&nbsp;
                <a class="btn btn-md btn-default" href="index.php?app=koreksi&act=koreksi&id_topik=<?php echo $_GET['idq'];?>"><i class="icon-reply"></i>  Kembali</a>&nbsp;
                <div class="app_title">Data Peserta Ujian - Kelas <?php echo $dgetkelas->nama;?></div>
            </div>
</div>
<div class="alert-info" style="padding: 15px;border: 1px solid #d0d0d0">
<h3 style="margin-top: 0px"><i class="icon-info"></i> Informasi penting</h3>
<p>Reset peserta ujian berfungsi untuk menghapus data nilai berdasarkan data siswa yang dipilih <br>kemudian siswa bisa mengikuti kembali ujian pada modul ini.</p>
</div>
<form action="" method="post">
    <table class= "data table-condensed">
        <thead>
            <tr>
                <th style="width:5% !important;">No.
                </th>
                <th style="width:10% !important;">Nama Siswa</th>
                <th style="width:10% !important;" class='hidden-xs'>Status</th>
                <th style="width:10% !important; text-align: center">Nilai Essay</th>
                <th style="width:20% !important;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $idk = $_GET['idk'];
            $idq = $_GET['idq'];
            $qkelas = $DBH->query("SELECT * FROM siswa WHERE id_kelas='$idk' ORDER BY nama_lengkap ASC");
            $no = 1;
            while($dkelas = $qkelas->fetch(PDO::FETCH_ASSOC)) {
                $cek_pekerjaan = $DBH->query("SELECT * FROM siswa_sudah_mengerjakan WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $cek_jumlah = $cek_pekerjaan->rowCount();
                $data_pekerjaan = $cek_pekerjaan->fetch(PDO::FETCH_ASSOC);
                $cek_nilai_pg = $DBH->query("SELECT * FROM nilai_pg WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $data_nilai_pg = $cek_nilai_pg->fetch(PDO::FETCH_ASSOC);
                $cek_nilai_esay = $DBH->query("SELECT * FROM nilai_esay WHERE id_siswa='$dkelas[id_siswa]' && id_ujian='$idq'");
                $data_nilai_esay = $cek_nilai_esay->fetch(PDO::FETCH_ASSOC);

                if($cek_jumlah > 0 ) {
                    $status = "<b class='text-success'>Sudah mengerjakan</b>";
                    $reset = "<a onclick=\"return confirm('Yakin ingin mereset peserta ujian ini ?');\"  class='btn btn-default' onclick=\"return confirm('Yakin ingin mereset peserta ujian ini ?');\" href='?app=koreksi&act=reset&id_siswa=$dkelas[id_siswa]&id_ujian=$idq'>Reset peserta ujian</a>";
                    $nilai_pg = $data_nilai_pg['persentase'];
                    if($nilai_pg>=$dmapel->kkm) {
                        $nilai_pg = $nilai_pg." - <b class='text-success'>Lulus</b>";
                    }
                    else {
                        $nilai_pg = $nilai_pg." - <b class='text-danger'>Tidak Lulus</b>";
                    }
                    if($data_pekerjaan['koreksi']=='B') {
                        $aksi = "<a onclick=\"return confirm('Yakin ingin mereset peserta ujian ini ?');\" href=?app=koreksi&act=mulai_koreksi&id_siswa=$dkelas[id_siswa]&id_ujian=$idq&token=".md5('koreksi')."' class='btn'><i class='icon-ok'></i> Koreksi jawaban</a>";
                        $nilai_esay = "<b class='text-danger'>Belum dikoreksi</b>";
                    } else {
                        //$aksi = "<a href=?app=koreksi&act=edit_koreksi&id_siswa=$dkelas[id_siswa]&id_ujian=$idq&token=".md5('koreksi')."'><i class='icon-pencil'></i> Edit koreksi</a>";
                        $aksi = "";
                        $nilai_esay = $data_nilai_esay['nilai'];
                    }

                } else {
					$aksi ='';
                    $status = "<b class='text-danger'>Belum mengerjakan</b>";
                    $nilai_esay = "-";
                    $reset = "....";
                }
                echo"<tr><td>$no.</td><td>$dkelas[nama_lengkap]</td><td>$status</td><td>$nilai_esay</center></td><td>$aksi&nbsp;&nbsp;".$reset."</td></tr>";
            $no++;
            } ?>
        </tbody>
    </table>
</form>
<?php } ?>
