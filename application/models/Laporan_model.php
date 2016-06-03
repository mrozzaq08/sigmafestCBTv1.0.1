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

class Laporan_model extends CI_Model
{

        public function __construct()
        {
                parent::__construct();
        }
	
        public function top_5_peserta($id_ujian) 
        {
                $this->db->join('topik_ujian','topik_ujian.quid = hasil_ujian.id_ujian');
                $this->db->join('siswa','siswa.id_siswa = hasil_ujian.id_siswa');
                $this->db->where('topik_ujian.id_ujian', $id_ujian);
                $this->db->order_by("id_hasil", "desc"); 
                $this->db->limit('5');
                $query = $this->db->get('hasil_ujian');
                $hasil = $query->result_array();
                return $hasil;
        }
	
}
