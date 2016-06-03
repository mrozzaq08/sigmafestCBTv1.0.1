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
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function session_access() {
    $CI= & get_instance();
    $level_session=$CI->session->userdata('e113snay_level');
    if($level_session != 'admin')
    {
        redirect('access/show_403');
    }
}

if ( ! function_exists('delete_cache'))
{
    function delete_cache($uri_string)
    {
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;
 
        $uri =  $CI->config->item('base_url').
            $CI->config->item('index_page').
            $uri_string;
 
        $cache_path .= md5($uri);
 
        if (file_exists($cache_path))
        {
            return unlink($cache_path);
        }
        else
        {
            return TRUE;
        }
    }
}

function timestamp($time = null) {
    if ($time == null) {
        $time = time();
    }
    return date('Y-m-d H:i:s', $time);
}

function convert_time($str) {
    list($date, $time) = explode(' ', $str);
    list($year,$month,$day) = explode('-', $str);
    list($hour,$minute,$second) = explode(':', $str);
    $timestamp = mktime($hour,$minute,$second,$month,$day,$year);
    return $timestamp;
}

date_default_timezone_set('Asia/jakarta');
function time_ago($timestamp){
    $time = time() - strtotime($timestamp);

    if ($time < 60) {
        return ( $time > 1 ) ? $time . ' detik yang lalu' : ' 1 detik yang lalu';
    }
    elseif ($time < 3600) {
        $tmp = floor($time / 60);
        return ($tmp > 1) ? $tmp . ' menit yang lalu' : ' 1 menit yang lalu';
    }
    elseif ($time < 86400) {
        $tmp = floor($time / 3600);
        return ($tmp > 1) ? $tmp . ' jam yang lalu' : ' 1 jam yang lalu';
    }
    elseif ($time < 2592000) {
        $tmp = floor($time / 86400);
        return ($tmp > 1) ? $tmp . ' hari yang lalu' : ' 1 hari yang lalu';
    }
    elseif ($time < 946080000) {
        $tmp = floor($time / 2592000);
        return ($tmp > 1) ? $tmp . ' bulan yang lalu' : ' 1 bulan yang lalu';
    }
    else {
        $tmp = floor($time / 946080000);
        return ($tmp > 1) ? $tmp . ' tahun yang lalu' : ' 1 tahun yang lalu';
    }
}

function terbilang($nilai) {
    /** Membuat array untuk nama bilangan */
    $nama_bilangan = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($nilai < 12) {
       /** Jika nilai yang dimasukan kurang dari 12
       /** Tampilkan nama bilangan dari array  */
       $huruf = " " . $nama_bilangan[$nilai];
    }
    elseif ($nilai < 20) {
       /** Jika nilai yang dimasukan kurang dari 20
       /** Angka di kurangi 10 untuk mendapatkan angka inisial belasan */
       $huruf = Terbilang($nilai - 10) . "belas";
    }
    elseif ($nilai < 100) {
        /** Jika nilai yang dimasukan kurang dari 100
        /** Nilai dibagi dengan 10 untuk mendapatkan angka didepan
        /** Kemudian hasil sisa bagi dengan 10 untuk mendapatkan angka belakangnya */
        $huruf = Terbilang($nilai / 10) . " puluh" . Terbilang($nilai % 10);
    }
    elseif ($nilai == 100) {
        /** Jika nilai yang dimasukan sama dengan 100
        /** Tampilkan nama bilangan seratus */
        $huruf = " seratus" . Terbilang($nilai - 100);
    }

    /** Return nilai menjadi huruf */
    return $huruf;
}

function minify($string)
{
    $string = minify_js($string);
    // Remove html comments
    $string = preg_replace('/<!--(?!\[if|\<\!\[endif)(.|\s)*?-->/', '', $string);
    // Remove tab
    $string = preg_replace('/\t+/', '', $string);
	// Remove new line
    $string = preg_replace('/\n+/', '', $string);
    $string = preg_replace('/>\r+/', '>', $string);
    $string = preg_replace('/\r+</', '<', $string);

    // Remove space between tags. Skip the following if
    // you want as it will also remove the space
    // between <span>Hello</span> <span>World</span>.
    $string = preg_replace('/>\s+</', '><', $string);

	return $string;
}

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei",
                    "Juni", "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember");
	// Format tanggal yyyy/mm/dd
	function date_now($tanggal){
		$tgl_hari   = substr($tanggal,8,2);
		$tgl_bulan  = getBulan(substr($tanggal,5,2));
		$tgl_thn    = substr($tanggal,0,4);
		$nama_hari  = getHari(date("w"));

		return $nama_hari.', &nbsp;'.$tgl_hari.' '.$tgl_bulan.' '.$tgl_thn;
	}
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;
	}

	function getBulan($bln){
            switch ($bln){
                    case 1:
                            return "Januari";
                            break;
                    case 2:
                            return "Februari";
                            break;
                    case 3:
                            return "Maret";
                            break;
                    case 4:
                            return "April";
                            break;
                    case 5:
                            return "Mei";
                            break;
                    case 6:
                            return "Juni";
                            break;
                    case 7:
                            return "Juli";
                            break;
                    case 8:
                            return "Agustus";
                            break;
                    case 9:
                            return "September";
                            break;
                    case 10:
                            return "Oktober";
                            break;
                    case 11:
                            return "November";
                            break;
                    case 12:
                            return "Desember";
                            break;
            }
    }

    function getHari($gethari){
            switch ($gethari) {
                    case 1:
                            return "Senin";
                            break;
                    case 2:
                            return "Selasa";
                            break;
                    case 3:
                            return "Rabu";
                            break;
                    case 4:
                            return "Kamis";
                            break;
                    case 5:
                            return "Jum'at";
                            break;
                    case 6:
                            return "Sabtu";
                            break;
                    default:
                            return "Minggu";
                            break;

            }
    }


function minify_js($buffer){
	//remove tabs, spaces, newlines, etc.
	$buffer = str_replace(array("\t","\n",'  ','   ','    '), '', $buffer);
	//remove other spaces before/after )
	$buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
	return $buffer;
}

function kode_nohp($no_hp) {
    // Menghilangkan spasi
    $no_hp = str_replace(" ", "", $no_hp);
    // Menghilangkan tanda buka kurung
    $no_hp = str_replace("(", "", $no_hp);
    // Menghilangkan tanda tutup kurung
    $no_hp = str_replace(")", "", $no_hp);
    // Menghilangkan tanda strip
    $no_hp = str_replace("-", "", $no_hp);
    // Menghilangkan tanda titik
    $no_hp = str_replace(".", "", $no_hp);
    // Mengecek no hp yang mengandung karakter + dan angka 0-9
    if(!preg_match('/[^+0-9]/',  trim($no_hp))) {
        // Cek no hp yang mengandung karakter awal 1-3 adalah +62
        if(substr(trim($no_hp), 0,3)=='+62') {
            $nhp = trim($no_hp); 
        }
        // Cek no hp yang mengandung karakter awal 1 adalah 0
        else if(substr(trim($no_hp), 0,1)=='0') {
            $nhp = "+62".substr(trim($no_hp), 1);
        } else {
            $nhp = $no_hp." nomor ini tidak didukung.";
        }
        
        return $nhp;
    }
}

function nonkode_nohp($no_hp) {
    $data = substr_replace($no_hp, "0", 0,3);
    return $data;
}


//memanggil file JavaScript
function addJs($link) {	
    echo "<script type=\"text/javascript\" src=\"$link\"></script>\n";
}	

//memanggil file CSS
function addCss($link,$media = null) {
    if(empty($media)) $media = 'all';
    echo  "<link href=\"$link\" rel=\"stylesheet\" type=\"text/css\" media=\"$media\"/>\n";
}

// Hide extension of file name
function hideExt($filename) {
    $akhiran   = strrchr($filename, ".");
    $file      = str_replace($akhiran, "", $filename);

    return $file;
}

function dateLine($datenow, $dateline) {
    $date_line        = explode("-", $dateline);
    $DateLine         = $date_line[2]."-".$date_line[1]."-".$date_line[0];
    $date_now         = explode("-", $datenow);
    $DateNow          = $date_now[2]."-".$date_now[1]."-".$date_now[0];
    $Hitung_selisih   = strtotime($DateLine) - strtotime($DateNow);
    $Tampil_selisih   = $Hitung_selisih / 86400;

    return $Tampil_selisih;
}

//menghapus direktori dan semua isinya
function delete_directory($dirname) {
   if(is_dir($dirname))
      $dir_handle = opendir($dirname);
   if(!isset($dir_handle))
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname."/".$file))
            unlink($dirname."/".$file);
         else
            delete_directory($dirname.'/'.$file);       
      }
   }
   closedir($dir_handle);
   rmdir($dirname);
   return true;
}

//menghitung ukuran folder
function folder_size($path) {
    $total_size = 0;
    $files = scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = folder_size($currentFile);
                $total_size += $size;
            }
            else {
                $size = filesize($currentFile);
                $total_size += $size;
            }
        }   
    }

    return $total_size;
}

//format ukuran file
function format_size($size) {
	$units = explode(' ', 'B KB MB GB TB PB');
    $mod = 1024;
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }
    $endIndex = strpos($size, ".")+3;
    return substr( $size, 0, $endIndex).' '.$units[$i];
}

//format byte
function format_byte($from) {
    if(strpos($from,"M") AND !strpos($from,"MB"))
    $from = str_replace("M","MB",$from);
    if(strpos($from,"G") AND !strpos($from,"GB"))
    $from = str_replace("G","GB",$from);
    $number=substr($from,0,-2);
    switch(strtoupper(substr($from,-2))){
        case "KB":
            return $number*1024;
        case "MB":
            return $number*pow(1024,2);
        case "GB":
            return $number*pow(1024,3);
        case "TB":
            return $number*pow(1024,4);
        case "PB":
            return $number*pow(1024,5);
        default:
            return $from;
    }
}

//fungsi multiple select yang telah terpilih
function multipleSelected($x, $y) {
    $p = explode(",",$x);
    foreach($p as $page){
        if($y==$page)
        return 'selected';	
    }
}

//fungsi multiple select yang baru akan dipilih
function multipleSelect($x) {
    if($x) {
        $no = 1; $text = null;
        foreach ($x as $t){
            if($no==1)
                    $t = "$t";
            else
                    $t = ",$t";
            $text .= $t;
            $no++;
        }
        return $text;
    }
}

function seo_title($s){
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
    $s = str_replace($d, '', $s);
    $s = strtolower(str_replace($c, '-', $s));
    return $s;
}

function UploadImage($fupload_tmp,$fupload_name, $direktori){
    $vdir_upload = $direktori;
    $vfile_upload = $vdir_upload . $fupload_name;

    move_uploaded_file($fupload_tmp, $vfile_upload);
    if($_FILES['fupload']['type']=='image/jpeg' || $_FILES['fupload']['type']=='image/jpg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else if($_FILES['fupload']['type']=='image/png') {
        $im_src = imagecreatefrompng($vfile_upload);
    } else if($_FILES['fupload']['type']=='image/gif') {
        $im_src = imagecreatefromgif($vfile_upload);
    } else {
        $im_src = imagecreatefromwbmp($vfile_upload);
    }
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    $dst_width = 150;
    $dst_height = ($dst_width/$src_width)*$src_height;
    $im = imagecreatetruecolor($dst_width,$dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
    if($_FILES['fupload']['type']=='image/jpeg' || $_FILES['fupload']['type']=='image/jpg') {
        imagejpeg($im,$vdir_upload . "medium_" . $fupload_name);
    } else if($_FILES['fupload']['type']=='image/png') {
        imagepng($im,$vdir_upload . "medium_" . $fupload_name);
    } else if($_FILES['fupload']['type']=='image/gif') {
        imagegif($im,$vdir_upload . "medium_" . $fupload_name);
    } else {
        imagepng($im,$vdir_upload . "medium_" . $fupload_name);
    }
    

    imagedestroy($im_src);
    imagedestroy($im);
}

function uploadFile($file_tmp, $file_name, $folder) {
    $up_dir = $folder;
    $fname  = $file_name;
    $destination = $up_dir.$fname;
    move_uploaded_file($file_tmp, $destination);
}

