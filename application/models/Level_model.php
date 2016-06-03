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

class Level_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }

        public function daftar_level() 
        {
                $query  = "SELECT * FROM level_soal ORDER BY id_level ASC";
                $result = $this->db->query($query);
                return $result->result();
        }
		
        public function total_level() 
        {
                $query  = "SELECT id_level FROM level_soal";
                $result = $this->db->query($query);
                return $result->num_rows();
        }

        public function get_one_level()
        {
                $id_level = $this->uri->segment(4);
                $query_level = "SELECT * FROM level_soal WHERE id_level='$id_level' LIMIT 1";
                $result      = $this->db->query($query_level);
                return $result->row();
        }


        public function insert_level() 
        {
                $nama       = $this->input->post('nama');
                $keterangan = $this->input->post('keterangan');
                $data_array = array(
                    'nama_level' => $nama,
                    'keterangan'    => $keterangan
                );
                $this->db->insert('level_soal',$data_array);
        }

        public function update_level() 
        {
                $id_level   = $this->input->post('id_level');
                $nama       = $this->input->post('nama');
                $keterangan = $this->input->post('keterangan');
                $data_array = array(
                    'nama_level' => $nama,
                    'keterangan'    => $keterangan
                );
                $this->db->where('id_level',$id_level);
                $this->db->update('level_soal',$data_array);
        }

        public function hapus_level()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                       $this->db->delete('level_soal',array('id_level'=>$cek_data[$i]));
                }
        }
	
	
}
