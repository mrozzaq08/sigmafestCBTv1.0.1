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

class Media extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
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
        $data['title']          = "Pengelola Berkas - COMBAT ID";
        $data['main_title']     = "Halaman Pengelolaan Berkas";
        $data['main_sub_title'] = "Daftar berkas";
        $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_media/media',$data);
    }
}
