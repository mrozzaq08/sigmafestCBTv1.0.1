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

class Mapel extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('mapel_model','guru_model','kelas_model'));
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

                if (!is_numeric($cur_page) && $cur_page != 'all') {
                    $cur_page = 0;
                }

                $config['rows_per_page'] = 1;
                $config['page_limit']    = 10;
                $config['base_url']      = base_url() . 'mapel/';
                $config['total_rows']    = $this->mapel_model->daftar_mapel()->num_rows();
                $config['cur_page']      = $cur_page;
                $config['stats_title']   = 'mapel';
                $config['url_type']      = 'q';
                $config['show_trai_sl']  = true;

                $this->pages->initialize($config);
                
                $data['title']          = "Mata Pelajaran - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Mata Pelajaran";
                $data['main_sub_title'] = "Daftar mata pelajaran";
                $data['record']         = $this->mapel_model->paging_daftar_mapel($cur_page,$config['rows_per_page']);
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_mapel/views',$data);
        }

        public function create()
        {
                session_access();
                $data['title']          = "Mata Pelajaran Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Mata Pelajaran";
                $data['main_sub_title'] = "Tambah mata pelajaran baru";
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
                $data['record_guru']    = $this->guru_model->daftar_guru();
                $data['auto_number']    = $this->main_model->auto_number('mapel','id_mapel',3,'MP-');
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_mapel/create',$data);       
        }
        

        public function query_create()
        {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->mapel_model->insert_mapel();
                        redirect('mapel/create');
                }

                if($simpan_exit)
                {
                        $this->mapel_model->insert_mapel();
                        redirect('mapel');
                }
        }


        public function delete()
        {
                session_access();
                $this->mapel_model->hapus_mapel();
                redirect('mapel');
        }

		
        public function update()
        {
                $data['title']          = "Update Mata Pelajaran - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Mata Pelajaran";
                $data['main_sub_title'] = "Update mata pelajaran";
                $data['record']         = $this->mapel_model->get_one_mapel();
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
                $data['record_guru']    = $this->guru_model->daftar_guru();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_mapel/update',$data);
        }

        public function query_update()
        {
                $id_mapel    = $this->input->post('id_mapel');
                $simpan_stay = $this->input->post('update_stay');
                $simpan_exit = $this->input->post('update_exit');
                if($simpan_stay)
                {
                        $this->mapel_model->update_mapel();
                        redirect('mapel/update/kode/'.$id_mapel);
                }

                if($simpan_exit)
                {
                        $this->mapel_model->update_mapel();
                        redirect('mapel');
                }
        }
       
}
