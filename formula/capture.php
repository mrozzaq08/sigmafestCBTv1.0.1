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
if (isset($_SERVER['SERVER_ADDR'])) {
    if (strpos($_SERVER['SERVER_ADDR'], ':') !== FALSE) {
        $server_addr = '['.$_SERVER['SERVER_ADDR'].']';
    } else {
        $server_addr = $_SERVER['SERVER_ADDR'];
    }

    $base_url = (!empty($_SERVER['HTTPs'])
                ? 'https' : 'http').'://'.$server_addr.substr($_SERVER['SCRIPT_NAME'],
                0, strpos($_SERVER['SCRIPT_NAME'],
                basename($_SERVER['SCRIPT_FILENAME'])));
} else {
    $base_url = 'http://localhost/';
}

if($_POST["save"]) {
	$type = $_POST["type"];
	if($_POST["name"] and ($type=="JPG" or $type=="PNG")){
            $img = base64_decode($_POST["image"]);

            $myFile = "gambar/".$_POST["name"].".".$type ;
            $fh = fopen($myFile, 'w');
            fwrite($fh, $img);
            fclose($fh);
            echo $base_url."gambar/".$_POST["name"].".".$type;
	}
} else {
	header('Content-Type: image/jpeg');
	echo base64_decode($_POST["image"]);
}
?>
