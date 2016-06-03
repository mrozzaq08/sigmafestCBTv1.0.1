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
$app = $this->uri->segment(2);

if($app=='laporan') {
	$laporan = "active";
}
else {
	$laporan = "";
}

if($app=='agenda') {
	$agenda = "active";
}
else {
	$agenda = "";
}
if($app=='mapel') {
	$mapel = "active";
}
else {
	$mapel = "";
}
if($app=='ujian') {
	$ujian = "active";
}
else {
	$ujian = "";
}

if($app=='profil') {
	$profil = "active";
}
else {
	$profil = "";
}

if($app=='beranda') {
	$beranda = "active";
}
else {
	$beranda = "";
}
if($app=='latihan') {
	$latihan = "active";
}
else {
	$latihan = "";
}

if($app=='pengumuman') {
	$pengumuman = "active";
}
else {
	$pengumuman = "";
}
if($app=='forum') {
	$forum = "active";
}
else {
	$forum = "";
}
