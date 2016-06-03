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

class Level extends CI_Controller
{
       public function __construct()
        {
                parent::__construct();
                session_access();
                $this->load->model('level_model');
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
                $data['title']          = "Level Soal - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Level Soal";
                $data['main_sub_title'] = "Daftar level soal";
                $data['record']         = $this->level_model->daftar_level();
		$data['num_rows']       = $this->level_model->total_level();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_level/views',$data);

        }

        public function create()
        {
                $data['title']          = "Tambah Level Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Level Soal";
                $data['main_sub_title'] = "Tambah level soal baru";
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_level/create',$data);
        }


        public function query_create()
        {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->level_model->insert_level();
                        redirect('level/create/new');
                }

                if($simpan_exit)
                {
                        $this->level_model->insert_level();
                        redirect('level');
                }
        }


        public function delete()
        {
                $this->level_model->hapus_level();
                redirect('level');
        }


        public function update()
        {
                $data['title']          = "Update Level Soal - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Level Soal";
                $data['main_sub_title'] = "Update level soal";
                $data['record']         = $this->level_model->get_one_level();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_level/update',$data);
        }

        public function query_update()
        {
                $id_level    = $this->input->post('id_level');
                $simpan_stay = $this->input->post('update_stay');
                $simpan_exit = $this->input->post('update_exit');
                if($simpan_stay)
                {
                        $this->level_model->update_level();
                        redirect('level/update/kode/'.$id_level);
                }

                if($simpan_exit)
                {
                        $this->level_model->update_level();
                        redirect('level');
                }
        }
}
