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

class Login_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }

        public function cek_akun($level,$username,$password)
        {
                $getlevel       = $level;
                $getusername    = $username;
                $getpassword    = md5($password);

                if($getlevel == 'admin')
                {
                        $data_array = array('username' => $getusername,
                                            'password' => $getpassword);
                        $result     = $this->db->get_where('admin',$data_array);
                        $rows       = $result->row();
                        if( $result->num_rows() > 0 )
                        {
                                $sid_lama       = session_id();
                                session_regenerate_id();
                                $sid_baru       = strtoupper(session_id());
                                $session_array  = array(
                                    'e113snay_session_id'=> $sid_baru,
                                    'e113snay_level'     => 'admin',
                                    'e113snay_id_admin'  => $rows->id_admin,
                                    'e113snay_media_dir' => 'upload',
                                    'e113snay_kcfinder'  => $this->config->item('base_url')
                                );
                                $this->session->set_userdata($session_array);
                                $update_data    = array('id_session' => $sid_baru);
                                $update_where   = array('id_admin' => $rows->id_admin,
                                                        'blokir' => 'N');
                                $this->db->where($update_where);
                                $this->db->update('admin',$update_data);

                                redirect('cpanel');
                        }
                        else
                        {
                                redirect('login');
                        }
                }

                if($getlevel == 'pengajar')
                {		
                        $data_array = array('username_login' => $getusername,
                                            'password_login' => $getpassword);
                        $result     = $this->db->get_where('pengajar',$data_array);
                        $rows       = $result->row();
                        if( $result->num_rows() > 0 )
                        {
                                $sid_lama       = session_id();
                                session_regenerate_id();
                                $sid_baru       = strtoupper(session_id());
                                $session_array  = array(
                                    'e113snay_session_id'=> $sid_baru,
                                    'e113snay_level'     => 'guru',
                                    'e113snay_id_guru'   => $rows->id_pengajar,
                                    'e113snay_media_dir' => 'upload/guru_'.$rows->id_pengajar,
                                    'e113snay_kcfinder'  => $this->config->item('base_url')
                                );
                                $this->session->set_userdata($session_array);
                                $update_data    = array('id_session' => $sid_baru);
                                $update_where   = array('id_pengajar' => $rows->id_pengajar,
                                                        'blokir' => 'N');
                                $this->db->where($update_where);
                                $this->db->update('pengajar',$update_data);

                                redirect('cpanel');
                        }
                        else
                        {
                                redirect('login');
                        }

                }

                if($getlevel == 'siswa')
                {
                        $data_array = array('username_login' => $getusername,
                                            'password_login' => $getpassword);
                        $result     = $this->db->get_where('siswa',$data_array);
                        $rows       = $result->row();
                        if( $result->num_rows() > 0 )
                        {

                                $sid_lama       = session_id();
                                $sid_baru       = strtoupper(session_id());
                                $random         = rand(000000000, 999999999);
                                $sid_soal_baru  = $random.strtoupper(session_id());
                                session_regenerate_id();
                                $sid_baru       = strtoupper(session_id());
                                $session_array  = array(
                                    'e113snay_session_id'    => $sid_baru,
                                    'e113snay_level'         => 'siswa',
                                    'e113snay_id_siswa'      => $rows->id_siswa,
                                    'e113snay_kcfinder'      => $this->config->item('base_url')
                                );
                                $this->session->set_userdata($session_array);
                                $update_data    = array('id_session' => $sid_baru,
                                                        'id_session_soal' => $sid_soal_baru);
                                $update_where   = array('id_siswa' => $rows->id_siswa,
                                                        'blokir' => 'N');
                                $this->db->where($update_where);
                                $this->db->update('siswa',$update_data);

                                redirect('exams/beranda');
                        }
                        else
                        {
                                redirect('login');
                        }
                }
                

        }
	
}
