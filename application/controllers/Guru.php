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

class Guru extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                session_access();
                $this->load->helper('xls/php-excel-reader/excel_reader2');
                $this->load->helper('xls/SpreadsheetReader');
                $this->load->model('guru_model');
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

                $config['rows_per_page'] = 2;
                $config['page_limit']    = 10;
                $config['base_url']      = base_url() . 'guru/';
                $config['total_rows']    = $this->guru_model->total_guru();
                $config['cur_page']      = $cur_page;
                $config['stats_title']   = 'guru';
                $config['url_type']      = 'q';
                $config['show_trai_sl']  = true;

                $this->pages->initialize($config);
                
                $data['title']      	= "Daftar Guru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Guru";
                $data['main_sub_title'] = "Daftar guru";
                $data['record']         = $this->guru_model->paging_daftar_guru($cur_page, $config['rows_per_page']);
                $data['num_rows']       = $this->guru_model->total_guru();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_guru/views',$data);

        }

        public function details()
        {
                $data['title']          = "Profil Guru - COMBAT ID";
                $data['main_title']     = "Halaman Profil Pengajar";
                $data['main_sub_title'] = "Rincian guru";
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_guru/details',$data);
        }
        
        public function create()
        {
                $data['title']          = "Guru Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Pengajar";
                $data['main_sub_title'] = "Tambah guru baru";
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_guru/create',$data);
        }


        public function query_create()
        {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->guru_model->insert_guru();
                        redirect('guru/create/new');
                }

                if($simpan_exit)
                {
                        $this->guru_model->insert_guru();
                        redirect('guru');
                }
        }


        public function delete()
        {
                $this->guru_model->hapus_guru();
                redirect('guru');
        }


        public function update()
        {
                $data['title']          = "Update Guru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Pengajar";
                $data['main_sub_title'] = "Update guru";
                $data['record']         = $this->guru_model->get_one_guru();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_guru/update',$data);
        }

        public function query_update()
        {
                $id_guru     = $this->input->post('id_guru');
                if(isset($_POST['update_stay']))
                {
                        $this->guru_model->update_guru();
                        redirect('guru/update/kode/'.$id_guru);
                }

                if(isset($_POST['update_exit']))
                {
                        $this->guru_model->update_guru();
                        redirect('guru');
                }
        }


        public function import_guru() {
                // Object baru untuk membaca data dari file excel
                $data   = New Spreadsheet_Excel_Reader($_FILES['fxls']['tmp_name']);
                // Menghitung jumlah baris dan kolom
                $jumlah_baris   = $data->rowcount($sheet_index=0);
                $jumlah_kolom   = $data->colcount($sheet_index=0);
                // Memberi status
                $stat_sukses    = 0;
                $stat_gagal     = 0;
                // Looping berdasarkan jumlah baris pada data di excel
                for($row=2;$row<=$jumlah_baris;$row++) {
                    // Membaca nilai setiap baris
                    $data_satu  =   $data->val($row,1);
                    $data_dua   =   $data->val($row,2);
                    $data_tiga  =   $data->val($row,3);
                    $data_empat =   $data->val($row,4);
                    $data_lima  =   $data->val($row,5);
                    $data_enam  =   $data->val($row,6);
                    $data_tujuh =   $data->val($row,7);
                    // Data array
                    $data_insert    = array(
                        'nip'           => $data_satu,
                        'nama_lengkap'  => $data_dua,
                        'alamat'        => $data_tiga,
                        'no_telp'       => $data_empat,
                        'username_login'=> $data_lima,
                        'password_login'=> md5($data_enam),
                        'blokir'        => $data_tujuh

                     );

                     $this->db->insert('pengajar', $data_insert);
                     $guru = $this->db->insert_id();
                     $kode_guru  = 'Folder_ID_'.$guru;

                     $mkdir_files  = mkdir("./upload/".$kode_guru);
                }

                redirect('guru');
        }
}
