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

class Kelas_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }
        
        public function paging_daftar_kelas($posisi = '0',$batas)
        {
                if($posisi != 'all')
                {
                    $query  = "SELECT k.*, g.id_pengajar, g.nama_lengkap AS nama_guru
                               FROM kelas AS k LEFT JOIN pengajar AS g 
                               ON k.id_pengajar = g.id_pengajar ORDER BY k.nama ASC LIMIT $posisi,$batas";
                    $result = $this->db->query($query);
                    return $result->result();
                }
                else
                {
                    $query  = "SELECT k.*, g.id_pengajar, g.nama_lengkap AS nama_guru
                               FROM kelas AS k LEFT JOIN pengajar AS g 
                               ON k.id_pengajar = g.id_pengajar ORDER BY k.nama ASC";
                    $result = $this->db->query($query);
                    return $result->result();
                }
        }

        public function daftar_kelas() 
        {
                $query  = "SELECT * FROM view_kelas ORDER BY nama";
                $result = $this->db->query($query);
                return $result->result();
        }
        
        public function daftar_sub_kelas() 
        {
                $query  = "SELECT * FROM sub_kelas";
                $result = $this->db->query($query);
                return $result->result_array();
        }        
		
	public function total_kelas()
        {
                $query  = "SELECT id_kelas FROM kelas";
                $result = $this->db->query($query);
                return $result->num_rows();
        }

        public function get_one_kelas()
        {
                $id_kelas    = $this->uri->segment(4);
                $query_kelas = "SELECT * FROM kelas WHERE id_kelas='$id_kelas' LIMIT 1";
                $result      = $this->db->query($query_kelas);
                return $result->row();
        }


        public function insert_kelas() 
        {
                $id_kelas   = $this->input->post('id_kelas');
                $nama       = $this->input->post('nama');
                $wkelas     = $this->input->post('wkelas');
                $sub_kelas  = $this->input->post('id_sub');
                $status     = $this->input->post('status');
                if(empty($status)) {
                        $aktif = 'N';
                } else {
                        $aktif = 'Y';
                }

                $data_array = array(
                    'id_kelas'      => $id_kelas,
                    'id_sub'        => $sub_kelas,
                    'nama'          => $nama,
                    'id_pengajar'   => $wkelas,
                    'aktif'         => $aktif
                );
                $this->db->insert('kelas',$data_array);
        }

        public function update_kelas()
        {
                $id_kelas   = $this->input->post('id_kelas');
                $nama       = $this->input->post('nama');
                $wkelas     = $this->input->post('wkelas');
                $sub_kelas  = $this->input->post('id_sub');
                $status     = $this->input->post('status');
                if(empty($status)) {
                        $aktif = 'N';
                } else {
                        $aktif = 'Y';
                }

                $data_array = array(
                    'id_sub'        => $sub_kelas,
                    'nama'          => $nama,
                    'id_pengajar'   => $wkelas,
                    'aktif'    => $aktif
                );
                $this->db->where('id_kelas',$id_kelas);
                $this->db->update('kelas',$data_array);
        }

        public function hapus_kelas()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                       $this->db->delete('kelas',array('id_kelas'=>$cek_data[$i]));
                }
        }
}
