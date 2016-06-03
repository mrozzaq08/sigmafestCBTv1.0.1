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

class Profil_model extends CI_Model
{

        public function __construct()
        {
                parent::__construct();
        }

        public function get_data_profil() 
        {
                $level  = $this->session->userdata('e113snay_level');
                if($level == 'admin')
                {
                    $data_array = array(
                        'id_admin' => $this->session->userdata('e113snay_id_admin'),
                        'blokir'   => 'N'
                    );
                    $result     = $this->db->get_where('admin',$data_array);
                    $rows       = $result->row();
                    return $rows;
                }
                if($level == 'guru')
                {
                    $data_array = array(
                        'id_pengajar' => $this->session->userdata('e113snay_id_guru'),
                        'blokir'   => 'N'
                    );
                    $result     = $this->db->get_where('pengajar',$data_array);
                    $rows       = $result->row();
                    return $rows;
                }
        }


        public function update_profil_guru()
        {
                $id_guru    = $this->input->post('id_guru');
                $nip        = $this->input->post('nip');
                $nama       = $this->input->post('nama');
                $alamat     = $this->input->post('alamat');
                $no_telp    = $this->input->post('no_telp');
                $username   = $this->input->post('uname');
                $fpass      = $this->input->post('fpass');
                $email      = $this->input->post('email');
                
                $get_guru   = $this->db->select('foto');
                $get_guru   = $this->db->where('id_pengajar',$id_guru);
                $get_guru   = $this->db->get('pengajar');
                $rows       = $get_guru->row();

                $lokasi_file    = $_FILES['fupload']['tmp_name'];
                $tipe_file      = $_FILES['fupload']['type'];
                $nama_file      = $_FILES['fupload']['name'];
                $acak           =  rand(000000,999999);
                $nama_file 	= "guru_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/pengajar/$nama_file";

                if(! empty ($lokasi_file))
                {
                        if($rows->foto != NULL) { unlink("./foto/pengajar/$rows->foto"); }
                        if(move_uploaded_file($lokasi_file, $direktori_file))
                        {

                            if(empty($fpass)) {
                                $data_array = array(
                                     'nip'              => $nip,
                                     'nama_lengkap'     => $nama,
                                     'username_login'   => $username,
                                     'alamat'           => $alamat,
                                     'no_telp'          => $no_telp,
                                     'email'            => $email,
                                     'foto'             => $nama_file
                                );
                            } else {
                                $data_array = array(
                                     'nip'              => $nip,
                                     'nama_lengkap'     => $nama,
                                     'username_login'   => $username,
                                     'password_login'   => md5($fpass),
                                     'alamat'           => $alamat,
                                     'no_telp'          => $no_telp,
                                     'email'            => $email,
                                     'foto'             => $nama_file
                                );
                            }

                                $this->db->where('id_pengajar',$id_guru);
                                $this->db->update('pengajar', $data_array);
                        }
                }
                else
                {
                        if(empty($fpass)) {
                            $data_array = array(
                                 'nip'              => $nip,
                                 'nama_lengkap'     => $nama,
                                 'username_login'   => $username,
                                 'alamat'           => $alamat,
                                 'no_telp'          => $no_telp,
                                 'email'            => $email
                            );
                        } else {
                            $data_array = array(
                                 'nip'              => $nip,
                                 'nama_lengkap'     => $nama,
                                 'username_login'   => $username,
                                 'password_login'   => md5($fpass),
                                 'alamat'           => $alamat,
                                 'no_telp'          => $no_telp,
                                 'email'            => $email
                            );
                        }

                        $this->db->where('id_pengajar',$id_guru);
                        $this->db->update('pengajar', $data_array);
                }

        }

        public function update_profil_admin()
        {
                $id_admin   = $this->input->post('id_admin');
                $nama       = $this->input->post('nama');
                $alamat     = $this->input->post('alamat');
                $no_telp    = $this->input->post('no_telp');
                $username   = $this->input->post('uname');
                $fpass      = $this->input->post('fpass');
                $email      = $this->input->post('email');
                $web        = $this->input->post('website');

                $get_admin  = $this->db->select('foto');
                $get_admin  = $this->db->where('id_admin',$id_admin);
                $get_admin  = $this->db->get('admin');
                $rows       = $get_admin->row();

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
                        if(empty($fpass)) {
                            $data_array = array(
                                 'nama_lengkap'     => $nama,
                                 'username'   => $username,
                                 'alamat'           => $alamat,
                                 'no_telp'          => $no_telp,
                                 'email'            => $email,
                                 'foto'             => $nama_file,
                                 'website'          => $web
                            );
                        } else {
                            $data_array = array(
                                 'password'   => md5($fpass),
                                 'nama_lengkap'     => $nama,
                                 'username'         => $username,
                                 'alamat'           => $alamat,
                                 'no_telp'          => $no_telp,
                                 'email'            => $email,
                                 'foto'             => $nama_file,
                                 'website'          => $web
                            );
                        }

                            $this->db->where('id_admin',$id_admin);
                            $this->db->update('admin', $data_array);
                    }
                }
                else
                {
                    if(empty($fpass)) 
                    {
                        $data_array = array(
                             'nama_lengkap'     => $nama,
                             'username'         => $username,
                             'alamat'           => $alamat,
                             'no_telp'          => $no_telp,
                             'email'            => $email,
                             'website'          => $web
                        );
                    } 
                    else 
                    {
                        $data_array = array(
                             'password'   => md5($fpass),
                             'nama_lengkap'     => $nama,
                             'username'         => $username,
                             'alamat'           => $alamat,
                             'no_telp'          => $no_telp,
                             'email'            => $email,
                             'website'          => $web
                        );
                    }

                    $this->db->where('id_admin',$id_admin);
                    $this->db->update('admin', $data_array);
                }
        }
	
}
