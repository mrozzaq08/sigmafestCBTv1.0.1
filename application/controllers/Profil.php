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

class Profil extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
                $this->load->model('profil_model');
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
                $data['title']  	= "Profil Saya - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Profil";
                $data['main_sub_title'] = "Data profil dan akun";
                $data['record']         = $this->profil_model->get_data_profil();
                $e113snay_level         = $this->session->userdata('e113snay_level');
                if($e113snay_level == 'admin') { $profil = 'update_admin'; } else { $profil = 'update_guru'; }
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_profil/'.$profil,$data);
        }

        public function query_update()
	{
                $e113snay_level    = $this->session->userdata('e113snay_level');
                if($e113snay_level == 'admin')
                {
                        $this->profil_model->update_profil_admin();
                }
                
                if($e113snay_level == 'guru')
                {
                        $this->profil_model->update_profil_guru();
                }

                redirect('profil'); 
        }
}
