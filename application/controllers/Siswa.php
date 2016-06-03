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

class Siswa extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                $this->load->helper('xls/php-excel-reader/excel_reader2');
                $this->load->helper('xls/SpreadsheetReader');
                $this->load->model(array('siswa_model','kelas_model'));
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
                    $cur_page = 1;
                }

                $config['rows_per_page'] = 25;
                $config['page_limit']    = 10;
                $config['base_url']      = base_url() . 'siswa/';
                $config['total_rows']    = $this->siswa_model->total_siswa();
                $config['cur_page']      = $cur_page;
                $config['stats_title']   = 'siswa';
                $config['url_type']      = 'q';
                $config['show_trai_sl']  = true;

                $this->pages->initialize($config);
                
                $data['title']          = "Daftar Siswa - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Data Siswa";
                $data['main_sub_title'] = "Daftar siswa";
                $data['record']         = $this->siswa_model->paging_daftar_siswa($cur_page, $config['rows_per_page']);
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
		$data['num_rows'] 	= $this->siswa_model->total_siswa();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_siswa/views',$data);
        }

        public function create()
        {
                $data['title']          = "Siswa Baru - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Data Siswa";
                $data['main_sub_title'] = "Tambah siswa baru";
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_siswa/create',$data);
        }


        public function query_create()
        {
                $simpan_baru = $this->input->post('simpan_baru');
                $simpan_exit = $this->input->post('simpan_keluar');
                if($simpan_baru)
                {
                        $this->siswa_model->insert_siswa();
                        redirect('siswa/create/new');
                }

                if($simpan_exit)
                {
                        $this->siswa_model->insert_siswa();
                        redirect('siswa');
                }
        }


        public function delete()
        {
                $this->siswa_model->hapus_siswa();
                redirect('siswa');
        }


        public function update()
        {
                $data['title']          = "Update siswa - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Data Siswa";
                $data['main_sub_title'] = "Update siswa";
                $data['record']         = $this->siswa_model->get_one_siswa();
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_siswa/update',$data);
        }

        public function query_update()
        {
                $id_siswa = $this->input->post('id_siswa');
                if(isset($_POST['update_stay']))
                {
                        $this->siswa_model->update_siswa();
                        redirect('siswa/update/kode/'.$id_siswa);
                }

                if(isset($_POST['update_exit']))
                {
                        $this->siswa_model->update_siswa();
                        redirect('siswa');
                }
        }


        public function import_siswa() {

                // Object baru untuk membaca data dari file excel
                $data   = New Spreadsheet_Excel_Reader($_FILES['fxls']['tmp_name']);
                // Menghitung jumlah baris dan kolom
                $jumlah_baris   = $data->rowcount($sheet_index=0);
                $jumlah_kolom   = $data->colcount($sheet_index=0);
                // Memberi status
                $stat_sukses    = 0;
                $stat_gagal     = 0;
                // Looping berdasarkan jumlah baris pada data di excel
                $id_kelas   = $this->input->post('id_kelas');
                for($row=2;$row<=$jumlah_baris;$row++) {
                    // Membaca nilai setiap baris
                    $data_satu  =   $data->val($row,1);
                    $data_dua   =   $data->val($row,2);
                    $data_tiga  =   $data->val($row,3);
                    $data_empat =   $data->val($row,4);
                    $data_lima  =   $data->val($row,5);

                    // Data array
                    $data_insert = array(
                        'nis'            => $data_satu,
                        'nama_lengkap'   => $data_dua,
                        'alamat'         => $data_tiga,
                        'jenis_kelamin'  => $data_empat,
                        'username_login' => $data_satu,
                        'password_login' => md5($data_satu),
                        'id_kelas'       => $id_kelas,
                        'blokir'         => $data_lima
                     );

                     $this->db->insert('siswa', $data_insert);
                }

                redirect('siswa');
        }
}