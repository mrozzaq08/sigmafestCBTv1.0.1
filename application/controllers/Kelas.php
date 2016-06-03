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

class Kelas extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                session_access();
                $this->load->model(array('kelas_model','guru_model','siswa_model'));
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
                $this->load->library('pages');
                $cur_page = (isset($_GET['halaman']) ? $_GET['halaman'] : null);

                if (!is_numeric($cur_page) && $cur_page != 'all') 
                {
                    $cur_page = 1;
                }

                $config['rows_per_page'] = 20;
                $config['page_limit']    = 5;
                $config['base_url']      = base_url() . 'kelas/';
                $config['total_rows']    = $this->kelas_model->total_kelas();
                $config['cur_page']      = $cur_page;
                $config['stats_title']   = 'kelas';
                $config['url_type']      = 'q';
                $config['show_trai_sl']  = true;

                $this->pages->initialize($config);
                $data['title']          = "Daftar Kelas - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Kelas";
                $data['main_sub_title'] = "Daftar kelas";
                $data['record']         = $this->kelas_model->paging_daftar_kelas($cur_page, $config['rows_per_page']);
                $data['num_rows']	= $this->kelas_model->total_kelas();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_kelas/views',$data);
        }

        public function create()
        {
                $data['title']          = "Kelas Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Kelas";
                $data['main_sub_title'] = "Tambah kelas baru";
                $data['sub_kelas']      = $this->kelas_model->daftar_sub_kelas();
                $data['record_siswa']   = $this->siswa_model->daftar_siswa();
                $data['record_guru']    = $this->guru_model->daftar_guru();
                $data['auto_number']    = $this->main_model->auto_number('kelas','id_kelas',3,'K-');
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_kelas/create',$data);
        }


        public function query_create() {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->kelas_model->insert_kelas();
                        redirect('kelas/create/new');
                }

                if($simpan_exit)
                {
                        $this->kelas_model->insert_kelas();
                        redirect('kelas');
                }
        }


        public function delete()
        {
                $this->kelas_model->hapus_kelas();
                redirect('kelas');
        }


        public function update()
        {
                $data['title']          = "Update Kelas - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Kelas";
                $data['main_sub_title'] = "Update kelas";
                $data['sub_kelas']      = $this->kelas_model->daftar_sub_kelas(); 
                $data['record']         = $this->kelas_model->get_one_kelas();
                $data['record_siswa']   = $this->siswa_model->daftar_siswa();
                $data['record_guru']    = $this->guru_model->daftar_guru();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_kelas/update',$data);
        }

        public function query_update() {
                $id_kelas    = $this->input->post('id_kelas');
                $simpan_stay = $this->input->post('update_stay');
                $simpan_exit = $this->input->post('update_exit');
                if($simpan_stay)
                {
                        $this->kelas_model->update_kelas();
                        redirect('kelas/update/kode/'.$id_kelas);
                }

                if($simpan_exit)
                {
                        $this->kelas_model->update_kelas();
                        redirect('kelas');
                }
        }
}
