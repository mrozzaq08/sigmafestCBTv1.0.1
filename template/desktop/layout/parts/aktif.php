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
$app = $this->uri->segment(1);

if($app=='level' OR $app=='jenis' OR $app=='kelas') {
	$data_master = "active";
}
else {
	$data_master = "";
}

if($app=='media') {
	$media = "active";
}
else {
	$media = "";
}
if($app=='bsoal') {
	$bank_soal = "active";
}
else {
	$bank_soal = "";
}
if($app=='guru' OR $app=='siswa' OR $app=='admin') {
	$pengguna = "active";
}
else {
	$pengguna = "";
}
if($app=='pengaturan') {
	$pengaturan = "active";
}
else {
	$pengaturan = "";
}
if($app=='restore') {
	$restore = "active";
}
else {
	$restore = "";
}
if($app=='mapel') {
	$mapel = "active";
}
else {
	$mapel = "";
}

if($app=='materi') {
	$materi = "active";
}
else {
	$materi = "";
}
if($app=='ujian') {
	$ujian = "active";
}
else {
	$ujian = "";
}
if($app=='tujian') {
	$tujian = "active";
}
else {
	$tujian = "";
}

if($app=='profil') {
	$profil = "active";
}
else {
	$profil = "";
}
if($app=='cpanel') {
	$beranda = "active";
}
else {
	$beranda = "";
}
?>