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

class Main extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                session_access();
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
	
        public function pengaturan()
        {
                $data['title']          = "Pengaturan Umum - COMBAT ID";
                $data['main_title']     = "Halaman Pengaturan Umum";
                $data['main_sub_title'] = "Profil sekolah dan pemeliharaan";
                $data['record']         = $this->main_model->get_pengaturan();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_pengaturan/pengaturan',$data);
        }

        public function update_pengaturan()
        {
                $lokasi_file    = $_FILES['fupload']['tmp_name'];
                $tipe_file      = $_FILES['fupload']['type'];
                $nama_file      = $_FILES['fupload']['name'];
                $acak           =  rand(000000,999999);
                $nama_file      = "favicon_".$acak.'_'.str_replace(" ","_",$nama_file);
                $direktori_file = "./foto/favicon/$nama_file";
                if(!empty($lokasi_file))
                {
                        $get_set    = $this->main_model->get_pengaturan();
                        unlink("./foto/favicon/".$get_set->favicon);
                        move_uploaded_file($lokasi_file, $direktori_file);
                        $this->main_model->update_pengaturan_favicon($nama_file);
                }
                else
                {
                        $this->main_model->update_pengaturan_profil();
                }
        }

        public function restore()
        {
                $data['title']          = "Restore Database - COMBAT ID";
                $data['main_title']     = "Halaman Pemulihan";
                $data['main_sub_title'] = "Download dan restore basis data";
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_restore/restore',$data);
        }
        
        public function import_db() 
        {
            $src_file = $this->uri->segment(3);
            $isi_file = file_get_contents('./restore/'.$src_file);
            $string_query = rtrim( $isi_file, "\n;" );
            $array_query = explode(";", $query);
            foreach($array_query as $query)
            {
              $this->db->query($query);
            }
            
            redirect('main/restore');
        }

        public function backup_db()
        {
                $this->load->dbutil();
                $prefs = array(
                    'tables'            => array(),
                    'ignore'            => array(),
                    'format'            => 'zip',
                    'filename'          => 'backup-'.date("Y-m-d-H-i-s").'.sql',
                    'add_drop'          => TRUE,
                    'add_insert'        => TRUE,
                    'foreign_key_checks'=> TRUE,
                    'newline'           => "\n"
                );

                $backup = $this->dbutil->backup($prefs);
                write_file('./restore/backup/backup-'.date("Y-m-d-H-i-s").'.zip', $backup);
                force_download('backup-'.date("Y-m-d-H-i-s").'.zip', $backup);
        }
        
        public function search() {
            $keyword = $this->input->post('keyword');
            echo $keyword;
        }
        
        public function removefile($fname) {
            unlink('./restore/'.$fname);
            redirect('main/restore');
        }
}
