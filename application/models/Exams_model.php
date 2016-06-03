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

class Exams_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }
        
        public function get_one_ujian($id_ujian)
        {
                $query_mapel = "SELECT * FROM topik_ujian WHERE id_ujian='$id_ujian' LIMIT 1";
                $result      = $this->db->query($query_mapel);
                if($result->num_rows() >= 1)
                {
                    return $result->row();
                }
                else
                {
                    return false;
                }
        }
        
        function get_data_ujian($id_ujian)
        {
                $query_mapel = "SELECT * FROM topik_ujian WHERE id_ujian='$id_ujian' LIMIT 1";
                $result      = $this->db->query($query_mapel);
                return $result->row_array();
        }
        
        function get_soal($id_hasil)
        {
               $query       = $this->db->query("SELECT hasil_ujian.* FROM hasil_ujian WHERE id_hasil='$id_hasil'");
               $row         = $query->row_array();
               $id_soals    = $row['id_soals'];
               $query       = $this->db->query("SELECT * FROM  bank_soal JOIN mapel ON 
                              bank_soal.id_mapel = mapel.id_mapel WHERE bank_soal.id_soal IN 
                              ( $id_soals ) ORDER BY FIELD(id_soal, $id_soals )");
               $soal        = $query->result_array();
               $query       = $this->db->query("SELECT * FROM  pilihan_jawab WHERE id_soal IN ( $id_soals )");
               $pilihan     = $query->result_array();
               $data_array  = array($soal,$pilihan);
               return $data_array;
        }
 
        function get_jawaban_siswa($id_hasil)
        {
                $this->db->where('id_hasil',$id_hasil);
                $query = $this->db->get("jawab_soal");
                return $query->result_array();
        }
        
        
        function get_info_waktu($id_hasil)
        {
                $current_time = time();
                $this->db->query("UPDATE hasil_ujian SET waktu_spent=($current_time-waktu_mulai) 
                                  WHERE id_hasil='$id_hasil'");

                $query = $this->db->query("SELECT hasil_ujian.* FROM hasil_ujian WHERE id_hasil='$id_hasil'");
                return $query->row_array();
	}
        
        public function daftar_ujian()
        {
                $query_ujian = "SELECT tu.*, mp.nama, ku.nama_kategori FROM topik_ujian AS tu,
                                kategori_ujian as ku, mapel as mp WHERE tu.id_kategori = ku.id_kategori
                                AND tu.id_mapel = mp.id_mapel AND tu.type = 'U'";
                return $this->db->query($query_ujian);
        }
        
        public function daftar_latihan()
        { 
                $query_ujian = "SELECT tu.*, mp.nama, ku.nama_kategori FROM topik_ujian AS tu,
                                kategori_ujian as ku, mapel as mp WHERE tu.id_kategori = ku.id_kategori
                                AND tu.id_mapel = mp.id_mapel AND tu.type = 'L'";
                return $this->db->query($query_ujian);
        }
        
        function verifikasi_ujian($id)
        {
            if($this->input->cookie('id_hasil', TRUE))
            {
                $id_hasil       = $this->input->cookie('id_hasil', TRUE);
                $query          = $this->db->query("SELECT hasil_ujian.* FROM hasil_ujian WHERE id_hasil='$id_hasil'");
                $row            = $query->row_array();
                $cek_hasil      = $query->num_rows();
                $waktu_ujian    = $row['waktu_spent'];
                $id_ujian       = $row['id_ujian'];
                $query          = $this->db->query("SELECT topik_ujian.* FROM topik_ujian WHERE id_ujian='$id_ujian'");
                $row            = $query->row_array();
                $waktu_mulai    = $row['waktu_mulai'];
                $waktu_selesai  = $row['waktu_selesai'];
                $durasi         = $row['durasi'];
                
                if($cek_hasil < 1)
                {
                    return "Tidak dapat membuat persiapan soal ujian, cookie tidak cocok.";
                    delete_cookie("id_hasil");
                }
                
                if($waktu_selesai <= time())
                {
                    return "Ujian sudah tidak tersedia, waktu ujian sudah lewat.";
                    delete_cookie("id_hasil");
                }
//                if($waktu_ujian >= ($durasi * 60 ))
//                {
//                    return "Waktu sudah habis.";
//                    delete_cookie("id_hasil");
//                }
                
                return '1';
            }
            else
            {
                $query      = $this->db->query("SELECT topik_ujian.* FROM topik_ujian WHERE id_ujian='$id'");
                $row        = $query->row_array();
                $id_ujian   = $row['id_ujian'];
                $id_siswa   = $this->session->userdata('e113snay_id_siswa');
                $query      = $this->db->query("SELECT siswa.* FROM siswa WHERE id_siswa='$id_siswa'");
                $row2       = $query->row_array();
                
                if($row['waktu_mulai'] >= time())
                {
                    return "Ujian belum tersedia.!";
                }
                if($row['waktu_selesai'] <= time())
                {
                    return "Ujian sudah tidak tersedia, waktu ujian sudah lewat.";
                }
                $query      = $this->db->query("SELECT hasil_ujian.* FROM hasil_ujian WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian'");
                $attempted  = $query->num_rows();
                if($attempted >= $row['max_akses'])
                {
                    return "Anda sudah mencapai batas maksimum akses atau mengikuti ujian ini.";
                }
                
                $assignid_soals     = $row['id_soals_statis'];
		$id_soals           = array();
		$query              = $this->db->query("SELECT bank_soal.*,mapel.* FROM bank_soal JOIN mapel
                                      ON bank_soal.id_mapel = mapel.id_mapel WHERE
                                      bank_soal.id_soal in ($assignid_soals)");
                $id_soal_array      = $query->result_array();
	
                foreach($id_soal_array as $key => $id_soal)
                {
                    $id_soals[]  = $id_soal['id_soal'];
                }
                
                $waktu_spent_ind = array();
                $hidpils         = array();
                for($x=1; $x <= count($id_soals); $x++)
                {
                    $waktu_spent_ind[]   = "0";
                    $hidpils[]           = "0";
                }
                
                $waktu_spent_ind = implode(",",$waktu_spent_ind);
                $id_soals        = implode(",",$id_soals);
                $hidpils         = implode(",",$hidpils);
                
                $insert_data = array(
                    'id_siswa'          => $id_siswa,
                    'id_ujian'          => $id_ujian,
                    'id_pilihans'       => $hidpils,
                    'id_soals'          => $id_soals,
                    'waktu_mulai'       => time(),
                    'respon_akhir'      => time(),
                    'waktu_spent'       => '0',
                    'waktu_spent_ind'   => $waktu_spent_ind
                );
			
                if($this->db->insert('hasil_ujian',$insert_data))
                {
                    $id_hasil   = $this->db->insert_id();
                    $cookie     = array(
                        'name'   => 'id_hasil',
                        'value'  => $id_hasil,
                        'expire' => '86500'
                    );

                    $this->input->set_cookie($cookie);
                    return '1';
                }
            }
        }
}
