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

class Bsoal extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('mapel_model','bsoal_model','ujian_model','main_model','level_model'));
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
                $data['title']          = "Bank Soal - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Bank Soal";
                $data['main_sub_title'] = "Daftar bank soal";
                $data['record']         = $this->mapel_model->daftar_mapel();
                $data['record_mapel']   = $this->mapel_model->daftar_mapel();
                $data['record_level']   = $this->level_model->daftar_level();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/view_mapel',$data);
        }

        public function daftar()
        {
                $this->load->library('pages');
                $cur_page = (isset($_GET['halaman']) ? $_GET['halaman'] : null);

                if (!is_numeric($cur_page) && $cur_page != 'all') {
                    $cur_page = 1;
                }

                $config['rows_per_page'] = 20;
                $config['page_limit']    = 10;
                $config['base_url']      = base_url() . 'bsoal/daftar/kode/'.$this->uri->segment(4).'/';
                $config['total_rows']    = $this->bsoal_model->daftar_bsoal()->num_rows();
                $config['cur_page']      = $cur_page;
                $config['stats_title']   = 'bank soal';
                $config['url_type']      = 'q';
                $config['show_trai_sl']  = true;

                $this->pages->initialize($config);
                $data['title']          = "Bank Soal - COMBAT ID";
                $mapel                  = $this->bsoal_model->get_one_mapel();
                $data['main_title']     = "Pengelolaan Bank Soal - ".$mapel->nama;
                $data['main_sub_title'] = "Daftar bank soal";
                $data['record']         = $this->bsoal_model->paging_daftar_soal($cur_page, $config['rows_per_page']);
                $data['record_level']   = $this->level_model->daftar_level();
                $data['num_rows']       = $this->bsoal_model->total_bsoal();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/view_bsoal',$data);
        }

        public function create()
        {
                $get_status             = $this->uri->segment(4);
                $get_type               = $this->uri->segment(5);
                $data['title']          = "Bank Soal - COMBAT ID";
                $data['main_sub_title'] = "Tambah bank soal baru";
                $data['auto_number']    = $this->main_model->auto_number('bank_soal','id_soal',5,'');
                $data['record']         = $this->bsoal_model->daftar_bsoal();
                $data['record_mapel']   = $this->mapel_model->daftar_mapel();
                $data['record_level']   = $this->level_model->daftar_level();
                $bsoal_array            = array(
                    'bsoal-type-1','bsoal-type-2',
                    'bsoal-type-3','bsoal-type-4',
                    'bsoal-type-5','bsoal-type-6',
                    'bsoal-type-0'
                );
                if($get_status == 'general')
                {
                        $data['main_title'] = "Pengelolaan Bank Soal";
                
                        if($get_type == $bsoal_array[0])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs01/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[1])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs02/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[2])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs03/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[3])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs04/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[4])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs05/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[5])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs06/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[6])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs00/new_bsoal',$data);
                        }
                }

                else  if($get_status == 'plugins')
                {
                    $uqs  = 'plugins/plg_kcfinder/browse.php?'.$_SERVER['QUERY_STRING'];
                    $rdr  = base_url().$uqs;
                    redirect($rdr);
                }

                else
                {
                        $mapel              = $this->bsoal_model->get_one_mapel();
                        $data['main_title'] = "Pengelolaan Bank Soal - ".$mapel->nama;

                        if($get_type == $bsoal_array[0])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs01/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[1])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs02/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[2])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs03/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[3])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs04/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[4])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs05/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[5])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs06/new_bsoal',$data);
                        }
                        if($get_type == $bsoal_array[6])
                        {
                            $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs00/new_bsoal',$data);
                        }
                }
        }
        

        public function query_create()
        {
                $this->bsoal_model->insert_bsoal();
        }

        public function update()
        {
                $get_status             = $this->uri->segment(4);
                $get_type               = $this->uri->segment(5);
                $data['title']          = "Bank Soal - COMBAT ID";
                $data['main_sub_title'] = "Update bank soal";
                $data['auto_number']    = $this->main_model->auto_number('bank_soal','id_soal',5,'');
                $data['record']         = $this->bsoal_model->get_one_bsoal();
                $data['record_mapel']   = $this->mapel_model->daftar_mapel();
                $data['record_level']   = $this->level_model->daftar_level();
                $data['record_pilihan'] = $this->bsoal_model->daftar_pilihan();

                $bsoal_array            = array(
                    'bsoal-type-1','bsoal-type-2',
                    'bsoal-type-3','bsoal-type-4',
                    'bsoal-type-5','bsoal-type-6',
                    'bsoal-type-0'
                );
               
                $mapel              = $this->bsoal_model->get_one_update_mapel();
                $data['main_title'] = "Pengelolaan Bank Soal - ".$mapel->nama;

                if($get_type == $bsoal_array[0])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs01/edit_bsoal',$data);
                }
                if($get_type == $bsoal_array[1])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs02/edit_bsoal',$data);
                }
                if($get_type == $bsoal_array[2])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs03/edit_bsoal',$data);
                }
                if($get_type == $bsoal_array[3])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs04/edit_bsoal',$data);
                }
                if($get_type == $bsoal_array[4])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs05/edit_bsoal',$data);
                }
                if($get_type == $bsoal_array[5])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs06/edit_bsoal',$data);
                }
                if($get_type == $bsoal_array[6])
                {
                    $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_bank_soal/fbs00/edit_bsoal',$data);
                }
        }

        public function query_update()
        {
                $id_soal    = $this->input->post('id_soal');
                $id_mapel   = $this->input->post('id_mapel');
                $bs_type    = $this->input->post('bs_type');
                $bstype = str_replace("bs-","bsoal-type-",$bs_type);
                if(isset($_POST['update_stay']))
                {
                    $this->bsoal_model->update_bsoal();
                    redirect('bsoal/update/'.$id_mapel.'/'.$id_soal.'/'.$bstype);
                }
                if(isset($_POST['update_exit']))
                {
                    $this->bsoal_model->update_bsoal();
                    redirect('bsoal/daftar/kode/'.$id_mapel);
                }
        }

        
        public function delete()
        {
                $this->bsoal_model->hapus_bsoal();
                $kode_mapel = $this->input->post('kode_mapel');
                redirect('bsoal/daftar/kode/'.$kode_mapel);
        }

        public function import_bsoal()
        {
            $this->load->helper('xls/php-excel-reader/excel_reader2');
            $this->load->helper('xls/SpreadsheetReader');
            if(isset($_FILES['fxls']))
                {
			$targets = 'resources/import/';
			$targets = $targets . time() . ( $_FILES['fxls']['name']);
			$docadd=($_FILES['fxls']['name']);
			if(move_uploaded_file($_FILES['fxls']['tmp_name'], $targets))
                        {
				$Filepath = $targets;
                                $all_data = array();
                                date_default_timezone_set('Asia/jakarta');
                                $StartMem = memory_get_usage();

                                try
                                {
                                        $Spreadsheet = new SpreadsheetReader($Filepath);
                                        $BaseMem = memory_get_usage();
                                        $Sheets = $Spreadsheet -> Sheets();
                                        foreach ($Sheets as $Index => $Name)
                                        {
                                                $Time = microtime(true);
                                                $Spreadsheet -> ChangeSheet($Index);
                                                foreach ($Spreadsheet as $Key => $Row)
                                                {
                                                        if ($Row)
                                                        {
                                                                $all_data[] = $Row;
                                                        }
                                                        else
                                                        {
                                                                var_dump($Row);
                                                        }
                                                        $CurrentMem = memory_get_usage();
                                                        if ($Key && ($Key % 500 == 0))
                                                        {
//                                                                echo '---------------------------------'.PHP_EOL;
//                                                                echo 'Time: '.(microtime(true) - $Time);
//                                                                echo '---------------------------------'.PHP_EOL;
                                                        }
                                                }
                                        }
                                }
                                catch (Exception $E)
                                {
                                        echo $E -> getMessage();
                                }
                                $this->bsoal_model->import_bsoal_data($all_data);
                        }
                }
                else
                {
                    echo "Error: " . $_FILES["file"]["error"];
                }

                redirect('bsoal');
        }

        function get_level_soal($id_mapel,$id_level)
        {
                $this->db->where("id_mapel",$id_mapel);
                $this->db->where("id_level",$id_level);
                $query = $this->db->get("bank_soal");
                $num = $query->num_rows();
                echo $num;
	}
        
        public function pilih_soal_ujian($id_ujian = '0',$judul='',$batas='0',$id_mapel = '0')
        {
                $this->load->helper('form');
                $data['fid_mapel']    = $id_mapel;
                $data['record_mapel'] = $this->mapel_model->daftar_mapel();
                $data['record_level'] = $this->level_model->daftar_level();
                $data['hasil']        = $this->bsoal_model->paging_daftar_bsoal($batas,$id_mapel);
                $data['batas']        = $batas;
                $data['id_ujian']     = $id_ujian;
                $data['judul_ujian']  = $judul;
                $data['id_mapel']     = $id_mapel;
                $data['record_soal']  = $this->ujian_model->assigned_soal_manual($id_ujian);
                $this->load->view(MAIN_PAGES.'cpanel/app_bank_soal/select_soal',$data);
        }
}
