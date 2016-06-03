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

class Access extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper(array('file','download'));
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
        redirect('access/show_403');
    }


    public function show_403()
    {
        $data['title']          = "Access Forbidden - COMBAT ID";
        $data['main_title']     = "COMBATIBSNE403 Error Security";
        $data['main_sub_title'] = "Access Denied";
        $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_access/403',$data);
    }

    public function show_404()
    {
        $data['title']          = "Page Not Found - COMBAT ID";
        $data['main_title']     = "COMBATIBSNE404 - Error Document";
        $data['main_sub_title'] = "Page not found";
        $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_access/404',$data);
    }
}
