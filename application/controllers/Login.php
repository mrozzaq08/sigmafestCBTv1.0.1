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

class Login extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Login_model');
                $mobile_detect = new Mobile_Detect;
                if($mobile_detect->isMobile())
                {
                        $main_layout = "mobile/layout/";
                        $main_pages  = "mobile/pages/";
                        $main_array  = array(
                            'main_layout' => $main_layout,
                            'main_pages' => $main_pages
                        );
                        $this->session->set_userdata($main_array);
                        define('MAIN_LAYOUT', $this->session->userdata('main_layout'));
                        define('MAIN_PAGES', $this->session->userdata('main_pages'));
                }
                else
                {
                        $main_layout = "desktop/layout/";
                        $main_pages  = "desktop/pages/";
                        $main_array  = array(
                            'main_layout' => $main_layout,
                            'main_pages' => $main_pages
                        );
                        $this->session->set_userdata($main_array);
                        define('MAIN_LAYOUT', $this->session->userdata('main_layout'));
                        define('MAIN_PAGES', $this->session->userdata('main_pages'));
                }
        }
	
        public function index()
        {
                $data['title']  = "COMBAT ID - Login Panel";
                $this->layout->load(MAIN_LAYOUT.'login',MAIN_PAGES.'login',$data);
        }

        public function user_login()
        {
                $level      = $this->input->post('level');
                $username   = $this->input->post('username');
                $password   = $this->input->post('password');
                $this->Login_model->cek_akun($level,$username,$password);
        }

        public function user_logout() {
                $e113snay_level  = $this->session->userdata('e113snay_level');
                if($e113snay_level == 'admin')
                {
                    $this->db->where('id_admin',$this->session->userdata('e113snay_id_admin'));
                    $this->db->update('admin',array('id_session'=>''));
                    $this->session->sess_destroy();
                }
                if($e113snay_level == 'guru')
                {
                    $this->db->where('id_pengajar',$this->session->userdata('e113snay_id_guru'));
                    $this->db->update('pengajar',array('id_session'=>''));
                    $this->session->sess_destroy();
                }
                if($e113snay_level == 'siswa')
                {
                    $this->db->where('id_siswa',$this->session->userdata('e113snay_id_siswa'));
                    $this->db->update('siswa',array('id_session'=>'',
                                                    'id_session_soal'=>''));
                    $this->session->sess_destroy();
                }

                $base_url = base_url();
                redirect($base_url);
        }
}
