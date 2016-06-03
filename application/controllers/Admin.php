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

class Admin extends CI_Controller 
{
	public function __construct()
        {
                parent::__construct();
                session_access();
                $this->load->model(array('admin_model'));
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
                $data['title']          = "Daftar dmin - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Data Admin";
                $data['main_sub_title'] = "Daftar admin";
                $data['record']         = $this->admin_model->daftar_admin();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_admin/views',$data);

        }

        public function create()
        {
                $data['title']          = "admin Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Data Admin";
                $data['main_sub_title'] = "Tambah admin baru";
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_admin/create',$data);
        }


        public function query_create()
        {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->admin_model->insert_admin();
                        redirect('admin/create/new');
                }

                if($simpan_exit)
                {
                        $this->admin_model->insert_admin();
                        redirect('admin');
                }
        }


        public function delete()
        {
                $this->admin_model->hapus_admin();
                redirect('admin');
        }


        public function update()
        {
                $data['title']          = "Update admin - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Data Admin";
                $data['main_sub_title'] = "Update admin";
                $data['record']         = $this->admin_model->get_one_admin();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_admin/update',$data);
        }

        public function query_update()
        {
                $id_admin = $this->input->post('id_admin');
                if(isset($_POST['update_stay']))
                {
                        $this->admin_model->update_admin();
                        redirect('admin/update/kode/'.$id_admin);
                }

                if(isset($_POST['update_exit']))
                {
                        $this->admin_model->update_admin();
                        redirect('admin');
                }
        }
}
