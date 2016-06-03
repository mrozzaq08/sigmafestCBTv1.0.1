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

class Jenis_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }

        public function daftar_jenis() 
        {
                $query  = "SELECT * FROM kategori_ujian ORDER BY id_kategori ASC";
                $result = $this->db->query($query);
                return $result->result();
        }
		
        public function total_jenis() 
        {
                $query  = "SELECT id_kategori FROM kategori_ujian";
                $result = $this->db->query($query);
                return $result->num_rows();
        }

        public function get_one_jenis()
        {
                $id_kategori = $this->uri->segment(4);
                $query_jenis = "SELECT * FROM kategori_ujian WHERE id_kategori='$id_kategori' LIMIT 1";
                $result      = $this->db->query($query_jenis);
                return $result->row();
        }


        public function insert_jenis() 
        {
                $nama       = $this->input->post('nama');
                $keterangan = $this->input->post('keterangan');
                $data_array = array(
                    'nama_kategori' => $nama,
                    'keterangan'    => $keterangan
                );
                $this->db->insert('kategori_ujian',$data_array);
        }

        public function update_jenis()
        {
                $id_jenis   = $this->input->post('id_jenis');
                $nama       = $this->input->post('nama');
                $keterangan = $this->input->post('keterangan');
                $data_array = array(
                    'nama_kategori' => $nama,
                    'keterangan'    => $keterangan
                );
                $this->db->where('id_kategori',$id_jenis);
                $this->db->update('kategori_ujian',$data_array);
        }

        public function hapus_jenis()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                       $this->db->delete('kategori_ujian',array('id_kategori'=>$cek_data[$i]));
                }
        }
	
}
