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

class Mapel_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }
        
        public function paging_daftar_mapel($posisi = '0', $batas)
        {
                $sess_level  = $this->session->userdata('e113snay_level');
                if($sess_level == 'admin') 
                {
                        if($posisi != 'all')
                        {
                            $query_mapel = "SELECT * FROM mapel ORDER BY nama LIMIT $posisi, $batas";
                            return $this->db->query($query_mapel);
                        }
                        else
                        {
                            $query_mapel = "SELECT * FROM mapel ORDER BY nama";
                            return $this->db->query($query_mapel);
                        }
                }
                else 
                {
                        $id_guru     = $this->session->userdata('e113snay_id_guru');
                        if($posisi != 'all') 
                        {
                            $query_mapel = "SELECT * FROM mapel WHERE id_pengajar='$id_guru' 
                                        ORDER BY nama LIMIT $posisi, $batas";
                            return $this->db->query($query_mapel);
                        }
                        else
                        {
                            $query_mapel = "SELECT * FROM mapel WHERE id_pengajar='$id_guru' 
                                        ORDER BY nama";
                            return $this->db->query($query_mapel);
                        }
                        
                }

        }
		
        public function daftar_mapel()
        {
                $sess_level  = $this->session->userdata('e113snay_level');
                if($sess_level == 'admin') 
                {
                        $query_mapel = "SELECT * FROM mapel ORDER BY nama";
                        return $this->db->query($query_mapel);
                }
                
                else 
                {
                        $id_guru     = $this->session->userdata('e113snay_id_guru');
                        $query_mapel = "SELECT * FROM mapel WHERE id_pengajar='$id_guru' ORDER BY nama";
                        return $this->db->query($query_mapel);
                }

        }

        public function get_one_mapel()
        {
                $id_mapel    = $this->uri->segment(4);
                $query_mapel = "SELECT * FROM mapel WHERE id_mapel='$id_mapel' LIMIT 1";
                $result      = $this->db->query($query_mapel);
                return $result->row();
        }


        public function insert_mapel() 
        {
                $id_mapel   = $this->input->post('idmapel');
                $nama       = $this->input->post('nama');
                $kkm        = $this->input->post('kkm');
                $guru       = $this->input->post('guru');
                $kelas      = $this->input->post('kelas');
                $kelas      = multipleSelect($kelas);
                $keterangan = $this->input->post('keterangan');

                $data_array = array(
                    'id_mapel'      => $id_mapel,
                    'nama'          => $nama,
                    'kkm'           => $kkm,
                    'id_pengajar'   => $guru,
                    'id_kelas'      => $kelas,
                    'deskripsi'    => $keterangan
                );
                
                $this->db->insert('mapel',$data_array);
                
                $mkdir_files  = mkdir("./upload/files/".$nama);
				$mkdir_files  = mkdir("./upload/images/".$nama);
				$mkdir_files  = mkdir("./upload/flash/".$nama);
				$mkdir_files  = mkdir("./upload/video/".$nama);
        }

        public function update_mapel()
        {
                $id_mapel   = $this->input->post('id_mapel');
                $nama       = $this->input->post('nama');
                $kkm        = $this->input->post('kkm');
                $guru       = $this->input->post('guru');
                $kelas      = $this->input->post('kelas');
                $kelas      = multipleSelect($kelas);
                $keterangan = $this->input->post('keterangan');

                $data_array = array(
                    'nama'          => $nama,
                    'kkm'           => $kkm,
                    'id_pengajar'   => $guru,
                    'id_kelas'      => $kelas,
                    'deskripsi'    => $keterangan
                );
                $this->db->where('id_mapel',$id_mapel);
                $this->db->update('mapel',$data_array);
        }

        public function hapus_mapel()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                       $get_mapel  = $this->db->select('nama');
                       $get_mapel  = $this->db->where('id_mapel',$cek_data[$i]);
                       $get_mapel  = $this->db->get('mapel');
                       $rows       = $get_mapel->row();
					   
                       $rmdir_files  = delete_directory("./upload/files/".$rows->nama);
                       $rmdir_flash  = delete_directory("./upload/flash/".$rows->nama);
                       $rmdir_images = delete_directory("./upload/images/".$rows->nama);
                       $rmdir_video  = delete_directory("./upload/video/".$rows->nama);
                       
                       $this->db->delete('mapel',array('id_mapel'=>$cek_data[$i]));
                }
        }
	
}
