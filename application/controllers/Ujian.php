<?php
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : Sigmafest CBT
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('ujian_model','mapel_model','level_model','kelas_model','jenis_model'));
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
                $data['title']          = "Daftar Ujian - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Ujian";
                $data['main_sub_title'] = "Daftar ujian";
                $data['record']         = $this->ujian_model->daftar_ujian();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_ujian/views',$data);
        }

        public function create()
	{
                $data['title']          = "Daftar Ujian - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Ujian";
                $data['main_sub_title'] = "Tambah ujian baru";
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
                $data['record_mapel']   = $this->mapel_model->daftar_mapel();
                $data['record_jenis']   = $this->jenis_model->daftar_jenis();
                $data['record_level']   = $this->level_model->daftar_level();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_ujian/create',$data);
        }

        public function query_create()
        {
                $this->ujian_model->insert_ujian();
                redirect('ujian');
        }
		
        public function query_update()
        {
                $this->ujian_model->update_ujian();
                redirect('ujian');
        }


        public function update()
		{
                $data['title']          = "Daftar Ujian - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Ujian";
                $data['main_sub_title'] = "Update ujian";
                $data['record_kelas']   = $this->kelas_model->daftar_kelas();
                $data['record_mapel']   = $this->mapel_model->daftar_mapel();
                $data['record_jenis']   = $this->jenis_model->daftar_jenis();
                $data['record']         = $this->ujian_model->get_one_ujian();
                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_ujian/update',$data);
        }


        public function ajax_get_kelas_mapel()
        {
                $id_mapel   = $_POST['id_mapel'];
                $query      = $this->db->select('id_kelas');
                $query      = $this->db->where('id_mapel', $id_mapel);
                $query      = $this->db->get('mapel');
                $mapel      = $query->row();
                if($id_mapel != NULL) 
                {
                    echo "<script>$('.chosen-select').chosen();</script>";
                    echo '<label class="col-sm-3 control-label no-paadding-right">Pilih Kelas</label>';
                    echo '<div class="col-sm-9">
                           <select required name="id_kelas[]" multiple data-rel="tooltip" data-placeholder="Pilih kelas yang akan ujian" class="col-xs-8 chosen-select">';
                           $data_kelas = explode(",", $mapel->id_kelas);
                           foreach($data_kelas as $rows_kelas)
                           {
                               $query_kelas = $this->db->select('nama');
                               $query_kelas = $this->db->where('id_kelas',$rows_kelas);
                               $query_kelas = $this->db->get('view_kelas');
                               $nama_kelas  = $query_kelas->row();
                               echo '<option value="'.$rows_kelas.'">'.$nama_kelas->nama.'</option>';
                           }
                    echo '</select>';
                    echo '</div>';
                }
                else
                {
                    echo '<label class="col-sm-3 control-label no-paadding-right">Pilih Kelas</label>';
                    echo '<div class="col-sm-9">';
                    echo '<p class="text-danger">Anda belum memilih mata pelajaran</p>';
                    echo '</div>';
                }
        }
        
        
        public function tambah_soal_ujian($id_ujian,$id_soal)
        {
                $this->ujian_model->ajax_tambah_soal_ujian($id_ujian,$id_soal);
        }
        
        
        public function delete()
        {
                $this->ujian_model->hapus_ujian();
                redirect('ujian');
        }
        
        
        function delete_soal($id_ujian,$id_soal)
        {
                $this->ujian_model->hapus_soal_ujian($id_ujian,$id_soal);
                redirect('ujian/bsoal/kode/'.$id_ujian);
        }
	
        
        public function bsoal()
        {
                $id_ujian 		= $this->uri->segment(4);
                $data['title']          = "Daftar Ujian - COMBAT ID";
                $data['main_title']     = "Halaman Pengelolaan Ujian - Bank Soal";
                $data['main_sub_title'] = "Pengelolaan bank soal";
                $data['record']         = $this->ujian_model->assigned_soal_manual($id_ujian);
                $data['record_ujian']   = $this->ujian_model->get_one_ujian();
                $data['num_rows']   	= $this->ujian_model->total_soal_manual($id_ujian);

                $this->layout->load(MAIN_LAYOUT.'cpanel',MAIN_PAGES.'cpanel/app_ujian/bsoal',$data);
        }
        
        function move_atas_soal($id_ujian,$id_soal,$not='1')
        {		
            for($i=1; $i <= $not; $i++)
            {
                $this->ujian_model->moving_up_soal($id_ujian,$id_soal);
            }
            
            redirect('ujian/bsoal/kode/'.$id_ujian);
	}
	
        
	function move_bawah_soal($id_ujian,$id_soal,$not='1')
        {		
            for($i=1; $i <= $not; $i++)
            {
                $this->ujian_model->moving_down_soal($id_ujian,$id_soal);
            }
            
            redirect('ujian/bsoal/kode/'.$id_ujian);
	}
        
        
        public function ajax_update_jawaban($id,$id_pil) {
            $this->ujian_model->ajax_update_jawaban($id,$id_pil);
        }
        
        public function ajax_update_essay() {
            $this->ujian_model->ajax_update_essay();
        }
        
        
	public function ajax_update_waktu($id_soal,$waktu_soal)
        {
               $id_hasil = $this->input->cookie('id_hasil', TRUE);
               $this->ujian_model->ajax_update_waktu_spent_individu($id_hasil,$id_soal,$waktu_soal);
               
	}
}
