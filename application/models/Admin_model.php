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

class Admin_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }

        public function daftar_admin()
        {
                $query  = "SELECT * FROM admin ORDER BY id_admin DESC";
                $result = $this->db->query($query);
                return $result->result_array();
        }

        public function get_one_admin()
        {
                $id_admin    = $this->uri->segment(4);
                $query_admin = "SELECT * FROM admin WHERE id_admin='$id_admin' LIMIT 1";
                $result     = $this->db->query($query_admin);
                return $result->row();
        }


        public function insert_admin()
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
                $nama_file 	= "admin_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/admin/$nama_file";

                if(! empty ($lokasi_file))
                {
                        if(move_uploaded_file($lokasi_file, $direktori_file))
                        {
                                $data_array = array(
                                     'nis'              => $nis,
                                     'nama_lengkap'     => $nama,
                                     'username_login'   => $nis,
                                     'password_login'   => md5($nis),
                                     'alamat'           => $alamat,
                                     'jenis_kelamin'    => $jk,
                                     'id_kelas'         => $id_kelas,
                                     'foto'             => $nama_file,
                                     'blokir'           => $blokir
                                );

                                $this->db->insert('admin', $data_array);

                        }
                }
                else
                {
                        $data_array = array(
                             'nis'              => $nis,
                             'nama_lengkap'     => $nama,
                             'username_login'   => $nis,
                             'password_login'   => md5($nis),
                             'alamat'           => $alamat,
                             'jenis_kelamin'    => $jk,
                             'id_kelas'         => $id_kelas,
                             'blokir'           => $blokir
                        );

                        $this->db->insert('admin', $data_array);
                }
        }


        public function update_admin()
        {
                $id_admin   = $this->input->post('id_admin');
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

                $get_admin   = $this->db->select('foto');
                $get_admin   = $this->db->where('id_admin',$id_admin);
                $get_admin   = $this->db->get('admin');
                $rows        = $get_admin->row();

                $lokasi_file    = $_FILES['fupload']['tmp_name'];
                $tipe_file      = $_FILES['fupload']['type'];
                $nama_file      = $_FILES['fupload']['name'];
                $acak           =  rand(000000,999999);
                $nama_file 	= "admin_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/admin/$nama_file";

                if(! empty ($lokasi_file))
                {
                        if($rows->foto != NULL) { unlink("./foto/admin/$rows->foto"); }
                        if(move_uploaded_file($lokasi_file, $direktori_file))
                        {
                            if(empty($password)) {
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
                            } else {
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

                            $this->db->where('id_admin',$id_admin);
                            $this->db->update('admin', $data_array);

                        }
                }
                else
                {
                        if(empty($password)) {
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
                        } else {
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

                        $this->db->where('id_admin',$id_admin);
                        $this->db->update('admin', $data_array);
                }
        }


        public function hapus_admin()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                        $get_admin   = $this->db->select('foto');
                        $get_admin   = $this->db->where('id_admin',$cek_data[$i]);
                        $get_admin   = $this->db->get('admin');
                        $rows       = $get_admin->row();
                        if($rows->foto != NULL) { unlink("./foto/admin/$rows->foto"); }
                        $this->db->delete('admin',array('id_admin'=>$cek_data[$i]));
                }
        }
	
}
