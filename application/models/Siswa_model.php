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

class Siswa_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }
        
        public function paging_daftar_siswa($posisi = '0',$batas)
        {
                if($posisi != 'all') 
                {
                    $query  = "SELECT * FROM siswa ORDER BY nis LIMIT $posisi,$batas";
                    $result = $this->db->query($query);
                    return $result->result_array();
                }
                else
                {
                    $query  = "SELECT * FROM siswa ORDER BY nis";
                    $result = $this->db->query($query);
                    return $result->result_array();
                }
        }

        public function daftar_siswa()
        {
                $query  = "SELECT * FROM siswa ORDER BY nis";
                $result = $this->db->query($query);
                return $result->result_array();
        }
		
        public function total_siswa()
        {
                $query  = "SELECT id_siswa FROM siswa";
                $result = $this->db->query($query);
                return $result->num_rows();
        }

        public function get_one_siswa()
        {
                $id_siswa    = $this->uri->segment(4);
                $query_siswa = "SELECT * FROM siswa WHERE id_siswa='$id_siswa' LIMIT 1";
                $result     = $this->db->query($query_siswa);
                return $result->row();
        }


        public function insert_siswa()
        {
                $nis        = $this->input->post('nis');
                $nama       = $this->input->post('nama');
                $alamat     = $this->input->post('alamat');
                $jk         = $this->input->post('jk');
                $id_kelas   = $this->input->post('id_kelas');
                $status     = $this->input->post('blokir');
                if(empty($status))
                {
                    $blokir = 'Y';
                } 
                else
                {
                    $blokir = 'N';
                }

                $lokasi_file    = $_FILES['fupload']['tmp_name'];
                $tipe_file      = $_FILES['fupload']['type'];
                $nama_file      = $_FILES['fupload']['name'];
                $acak           =  rand(000000,999999);
                $nama_file 	= "siswa_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/siswa/$nama_file";

                if(! empty ($lokasi_file))
                {
                        if(move_uploaded_file($lokasi_file, $direktori_file))
                        {
                                $data_array = array(
                                     'nis'              => $nis,
                                     'nama_lengkap'     => $nama,
                                     'username_login'   => $nis,
                                     'password_login'   => md5($nis),
                                     'jenis_kelamin'    => $jk,
                                     'id_kelas'         => $id_kelas,
                                     'foto'             => $nama_file,
                                     'blokir'           => $blokir
                                );

                                $this->db->insert('siswa', $data_array);
                                
                        }
                }
                else
                {
                        $data_array = array(
                             'nis'              => $nis,
                             'nama_lengkap'     => $nama,
                             'username_login'   => $nis,
                             'password_login'   => md5($nis),
                             'jenis_kelamin'    => $jk,
                             'id_kelas'         => $id_kelas,
                             'blokir'           => $blokir
                        );

                        $this->db->insert('siswa', $data_array);
                }
        }


        public function update_siswa()
        {
                $id_siswa   = $this->input->post('id_siswa');
                $nis        = $this->input->post('nis');
                $nama       = $this->input->post('nama');
                $alamat     = $this->input->post('alamat');
                $jk         = $this->input->post('jk');
                $id_kelas   = $this->input->post('id_kelas');
                $username   = $this->input->post('uname');
                $password   = $this->input->post('fpass');
                $email      = $this->input->post('email');
                $no_telp    = $this->input->post('no_telp');
                $status     = $this->input->post('blokir');
                if(empty($status))
                {
                    $blokir = 'Y';
                }
                else
                {
                    $blokir = 'N';
                }

                $get_siswa   = $this->db->select('foto');
                $get_siswa   = $this->db->where('id_siswa',$id_siswa);
                $get_siswa   = $this->db->get('siswa');
                $rows        = $get_siswa->row();

                $lokasi_file    = $_FILES['fupload']['tmp_name'];
                $tipe_file      = $_FILES['fupload']['type'];
                $nama_file      = $_FILES['fupload']['name'];
                $acak           =  rand(000000,999999);
                $nama_file 	= "siswa_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/siswa/$nama_file";

                if(! empty ($lokasi_file))
                {
                    if($rows->foto != NULL) { unlink("./foto/siswa/$rows->foto"); }
                    if(move_uploaded_file($lokasi_file, $direktori_file))
                    {
                        if(empty($password)) 
                        {
                            $data_array = array(
                                 'nis'              => $nis,
                                 'nama_lengkap'     => $nama,
                                 'username_login'   => $username,
                                 'alamat'           => $alamat,
                                 'jenis_kelamin'    => $jk,
                                 'id_kelas'         => $id_kelas,
                                 'foto'             => $nama_file,
                                 'email'            => $email,
                                 'no_telp'          => $no_telp,
                                 'blokir'           => $blokir
                            );
                        } 
                        else 
                        {
                            $data_array = array(
                                 'nis'              => $nis,
                                 'nama_lengkap'     => $nama,
                                 'username_login'   => $nis,
                                 'password_login'   => md5($password),
                                 'alamat'           => $alamat,
                                 'jenis_kelamin'    => $jk,
                                 'id_kelas'         => $id_kelas,
                                 'foto'             => $nama_file,
                                 'email'            => $email,
                                 'no_telp'          => $no_telp,
                                 'blokir'           => $blokir
                            );
                        }

                        $this->db->where('id_siswa',$id_siswa);
                        $this->db->update('siswa', $data_array);
                    }
                }
                else
                {
                    if(empty($password)) 
                    {
                        $data_array = array(
                             'nis'              => $nis,
                             'nama_lengkap'     => $nama,
                             'username_login'   => $username,
                             'alamat'           => $alamat,
                             'jenis_kelamin'    => $jk,
                             'id_kelas'         => $id_kelas,
                             'email'            => $email,
                             'no_telp'          => $no_telp,
                             'blokir'           => $blokir
                        );
                    } 
                    else 
                    {
                        $data_array = array(
                             'nis'              => $nis,
                             'nama_lengkap'     => $nama,
                             'username_login'   => $nis,
                             'password_login'   => md5($password),
                             'alamat'           => $alamat,
                             'jenis_kelamin'    => $jk,
                             'id_kelas'         => $id_kelas,
                             'email'            => $email,
                             'no_telp'          => $no_telp,
                             'blokir'           => $blokir
                        );
                    }

                    $this->db->where('id_siswa',$id_siswa);
                    $this->db->update('siswa', $data_array);
                }
        }

        
        public function hapus_siswa()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                        $get_siswa   = $this->db->select('foto');
                        $get_siswa   = $this->db->where('id_siswa',$cek_data[$i]);
                        $get_siswa   = $this->db->get('siswa');
                        $rows       = $get_siswa->row();
                        if($rows->foto != NULL) { unlink("./foto/siswa/$rows->foto"); }
                        $this->db->delete('siswa',array('id_siswa'=>$cek_data[$i]));
                }
        }
}
