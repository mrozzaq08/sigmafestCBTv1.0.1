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

class Jenis extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
                session_access();
                $this->load->model('jenis_model');
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
                $data['title']          = "Daftar Kategori Ujian - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Kategori Ujian";
                $data['main_sub_title'] = "Daftar kategori ujian";
                $data['record']         = $this->jenis_model->daftar_jenis();
		$data['num_rows']       = $this->jenis_model->total_jenis();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_kategori/views',$data);
        }

        public function create()
        {
                $data['title']          = "Tambah Jenis Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Kategori Ujian";
                $data['main_sub_title'] = "Tambah kategori ujian baru";
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_kategori/create',$data);
        }


        public function query_create()
        {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->jenis_model->insert_jenis();
                        redirect('jenis/create/new');
                }

                if($simpan_exit)
                {
                        $this->jenis_model->insert_jenis();
                        redirect('jenis');
                }
        }


        public function delete()
        {
                $this->jenis_model->hapus_jenis();
                redirect('jenis');
        }


        public function update()
        {
                $data['title']          = "Update jenis - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Kategori Ujian";
                $data['main_sub_title'] = "Update kategori ujian";
                $data['record']         = $this->jenis_model->get_one_jenis();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_kategori/update',$data);
        }

        public function query_update()
        {
                $id_jenis    = $this->input->post('id_jenis');
                $simpan_stay = $this->input->post('update_stay');
                $simpan_exit = $this->input->post('update_exit');
                if($simpan_stay)
                {
                        $this->jenis_model->update_jenis();
                        redirect('jenis/update/kode/'.$id_jenis);
                }

                if($simpan_exit)
                {
                        $this->jenis_model->update_jenis();
                        redirect('jenis');
                }
        }
}
