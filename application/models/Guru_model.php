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

class Guru_model extends CI_Model
{
        public $nip;
        public $nama_lengkap;
        public $alamat;
        public $username;
        public $email;

        public function __construct()
        {
                parent::__construct();
        }

        public function daftar_guru()
        {
                $query  = "SELECT * FROM pengajar ORDER BY nama_lengkap";
                $result = $this->db->query($query);
                return $result->result_array();
        }
        
        public function paging_daftar_guru($posisi = '0',$batas)
        {
                if($posisi != 'all') 
                {
                    $query  = "SELECT * FROM pengajar ORDER BY nama_lengkap LIMIT $posisi,$batas";
                    $result = $this->db->query($query);
                    return $result->result_array();
                }
                else 
                {
                    $query  = "SELECT * FROM pengajar ORDER BY nama_lengkap";
                    $result = $this->db->query($query);
                    return $result->result_array();
                }
        }
		
	public function total_guru()
        {
                $query  = "SELECT id_pengajar FROM pengajar";
                $result = $this->db->query($query);
                return $result->num_rows();
        }

        public function get_one_guru()
        {
                $id_guru    = $this->uri->segment(4);
                $query_guru = "SELECT * FROM pengajar WHERE id_pengajar='$id_guru' LIMIT 1";
                $result     = $this->db->query($query_guru);
                return $result->row();
        }


        public function insert_guru()
        {
                $nip        = $this->input->post('nip');
                $nama       = $this->input->post('nama');
                $alamat     = $this->input->post('alamat');
                $username   = $this->input->post('uname');
                $fpass      = $this->input->post('fpass');
                $cpass      = $this->input->post('cpass');
                $status     = $this->input->post('blokir');
                if(empty($status)) {
                    $blokir = 'Y';
                } else {
                    $blokir = 'N';
                }

                $lokasi_file    = $_FILES['fupload']['tmp_name'];
                $tipe_file      = $_FILES['fupload']['type'];
                $nama_file      = $_FILES['fupload']['name'];
                $acak           =  rand(000000,999999);
                $nama_file 	= "guru_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/pengajar/$nama_file";

                if(! empty ($lokasi_file))
                {
                        if(move_uploaded_file($lokasi_file, $direktori_file))
                        {
                                $data_array = array(
                                     'nip'              => $nip,
                                     'nama_lengkap'     => $nama,
                                     'username_login'   => $username,
                                     'password_login'   => md5($fpass),
                                     'foto'             => $nama_file,
                                     'blokir'           => $blokir
                                );

                                if($fpass == $cpass)
                                {
                                    $this->db->insert('pengajar', $data_array);
                                    $guru = $this->db->insert_id();
                                    $kode_guru  = 'Folder_ID_'.$guru;

                                    $mkdir_files  = mkdir("./upload/".$kode_guru);
                                }
                                else
                                {
                                    redirect('guru');
                                }
                        }
                }
                else
                {
                        $data_array = array(
                             'nip'              => $nip,
                             'nama_lengkap'     => $nama,
                             'username_login'   => $username,
                             'password_login'   => md5($fpass),
                             'blokir'           => $blokir
                        );

                        if($fpass == $cpass)
                        {
                            $this->db->insert('pengajar', $data_array);
                            $guru = $this->db->insert_id();
                            $kode_guru  = 'Folder_ID_'.$guru;
                            $mkdir_files  = mkdir("./upload/".$kode_guru);
                        }
                        else
                        {
                            redirect('guru');
                        }
                }
        }

        public function update_guru()
        {
                $id_guru    = $this->input->post('id_guru');
                $nip        = $this->input->post('nip');
                $nama       = $this->input->post('nama');
                $alamat     = $this->input->post('alamat');
                $no_telp    = $this->input->post('no_telp');
                $username   = $this->input->post('uname');
                $fpass      = $this->input->post('fpass');
                $email      = $this->input->post('email');
                $status     = $this->input->post('blokir');
                if(empty($status)) {
                    $blokir = 'Y';
                } else {
                    $blokir = 'N';
                }

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
                                     'foto'             => $nama_file,
                                     'blokir'           => $blokir
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
                                     'foto'             => $nama_file,
                                     'blokir'           => $blokir
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
                                 'email'            => $email,
                                 'blokir'           => $blokir
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
                                 'blokir'           => $blokir
                            );
                        }
                        
                        $this->db->where('id_pengajar',$id_guru);
                        $this->db->update('pengajar', $data_array);
                }
                
        }

        public function hapus_guru()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                        $get_guru   = $this->db->select('id_pengajar,foto');
                        $get_guru   = $this->db->where('id_pengajar',$cek_data[$i]);
                        $get_guru   = $this->db->get('pengajar');
                        $rows       = $get_guru->row();
                        if($rows->foto != NULL) { unlink("./foto/pengajar/$rows->foto"); }
                        $kode_guru  = 'Folder_ID_'.$rows->id_pengajar;

                        $mkdir_files  = delete_directory("./upload/".$kode_guru);
                        $this->db->delete('pengajar',array('id_pengajar'=>$cek_data[$i]));
                }
        }
	
}
