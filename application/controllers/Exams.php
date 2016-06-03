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

class Exams extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('main_model','exams_model','ujian_model','laporan_model'));
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
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
        }
        
        public function beranda()
        {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
        }
        
        public function profil($pages = '')
        {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";

                switch ($pages) {
                    case '':
                        $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
                        break;
                    case 'update':
                        $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_profil/update',$data);
                        break;
                    default:
                        $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
                        break;
                }
        }
        
        public function mapel()
        {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
        }
        
        public function ujian($action = null)
        {
            if($action == null)
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $data['record']         = $this->exams_model->daftar_ujian();
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_ujian/views',$data);
            } 
            else if($action == 'details') 
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $data['record']         = $this->exams_model->daftar_ujian();
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_ujian/details',$data);
            }
            else if($action == 'akses') 
            {
                $this->load->helper('cookie');
                $id_ujian               = $this->uri->segment(4);
                $data['id_ujian']       = $id_ujian;
                $data['verify_status']  = $this->exams_model->verifikasi_ujian($id_ujian);
                $data['hasil']          = $this->exams_model->get_one_ujian($id_ujian);
                if($data['verify_status'] == '1') 
                {
                    if(!$this->input->cookie('id_hasil', TRUE)){
                        redirect('exams/ujian/akses/'.$id_ujian, 'refresh');
                    }
                    $id_hasil               = $this->input->cookie('id_hasil', TRUE);
                    $data['info_waktu']     = $this->exams_model->get_info_waktu($id_hasil);
                    $data['detik']          = (($data['hasil']->durasi) *60) - ($data['info_waktu']['waktu_spent']);
                    $data['jawaban_siswa']  = $this->exams_model->get_jawaban_siswa($id_hasil);
                    $soal_siswa             = array();

                    foreach($data['jawaban_siswa'] as $nilai_jawaban)
                    {
                        $soal_siswa[$nilai_jawaban['id_soal']] = $nilai_jawaban['konten'];
                    }
                    $data['soal_siswa']     = $soal_siswa;
                    $data['assigned_soal']  = $this->exams_model->get_soal($id_hasil);
                    $data['data_ujian']     = $this->exams_model->get_data_ujian($id_ujian);
                    $data['title']          = "Selamat mengerjakan";
                    $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                    $data['main_sub_title'] = "Halaman beranda";
                    $this->layout->load(MAIN_LAYOUT.'conducter',MAIN_PAGES.'exams/app_ujian/akses',$data);
                } 
                else
                {
                    $data['title']          = "Selamat mengerjakan";
                    $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                    $data['main_sub_title'] = "Halaman beranda";
                    $data['record']         = $this->exams_model->daftar_ujian();
                    $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_ujian/views',$data);
                }
            }
            else
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "Error Document";
                $data['main_sub_title'] = "Halaman tidak ditemukan";
                $data['record']         = $this->exams_model->daftar_ujian();
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_access/404',$data);
            }
        }
        
        public function laporan($sub_laporan = null)
        {
            if($sub_laporan == null)
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman laporan";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
            }
            else
            {
                
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman laporan";
                $id_ujian               = $this->input->get('kode-laporan');
                $id_ujian               = substr($id_ujian, 0, 1);
                $top_5_peserta = $this->laporan_model->top_5_peserta($id_ujian);
                $value      = array();
                $value[]    = array('Judul Ujian','Persentase (%)');
                foreach($top_5_peserta as $val){
                    $value[] = array($val['username_login'].' ('.$val['nama_lengkap'].')',intval($val['persentase']));
                }
                $data['value'] = json_encode($value);
//                if($logged_in['su']=="1"){
//                    $data['result'] = $this->result_model->result_view($id);
//                    //print_r($data['result']->essay_ques);exit;
//                    if($data['result']->essay_ques=="1"){
//                        $data['result2'] = $this->result_model->result_view_essay($id);
//                    }
//                    
//                    $correct_score=explode(",",$data['result']->correct_score);
//                    $incorrect_score=explode(",",$data['result']->incorrect_score);
//                    //print_r($data['result']['essay_ques']);exit;
//                }
//                else
//                {
//                    $user_id = $logged_in['id'];
//                    $data['result']     = $this->result_model->result_view($id,$user_id);
//                    $correct_score      = explode(",",$data['result']->correct_score);
//                    $incorrect_score    = explode(",",$data['result']->incorrect_score);
//                }
//                
//                $correct_incorrect = explode(",",$data['result']->score_ind);
//                $data['percentile'] = $this->result_model->get_percentile($id_ujian, $data['result']->uid, $data['result']->score);
//                
//                 // getting the individual question time
//                $oidss  = explode(",",$data['result']->oids);
//                $qtime  = array();
//                $ctime  = array();
//                $ctime[]=array('Subject','Time in Seconds');
//                $qtime[]=array('Question Number','Time in Seconds');
//                foreach(explode(",",$data['result']->time_spent_ind) as $key => $val){
//                    if($correct_incorrect[$key]>="0.1"){
//                        $qtime[]=array("Q ".($key+1).") - Correct/Partially Correct",intval($val));
//                    } else if($correct_incorrect[$key]==0 && $oidss[$key]!=0 ){
//                        $qtime[]=array("Q ".($key+1).") - Wrong ",intval($val));
//                    } else {
//                        $qtime[]=array("Q ".($key+1).") - UnAttempted ",intval($val));
//                    }
//                }
//                
//                $data['qtime'] = json_encode($qtime);
    
                $this->layout->load(MAIN_LAYOUT.'laporan',MAIN_PAGES.'exams/app_laporan/hasil',$data);
            
            }
                
               
        }
        
        public function latihan($action = null)
        {
            if($action == null)
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $data['record']         = $this->exams_model->daftar_latihan();
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_latihan/views',$data);
            } 
            else if($action == 'details') 
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $data['record']         = $this->exams_model->daftar_latihan();
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_latihan/details',$data);
            }
            else if($action == 'akses') 
            {
                $this->load->helper('cookie');
                $id_ujian               = $this->uri->segment(4);
                $data['id_ujian']       = $id_ujian;
                $data['verify_status']  = $this->exams_model->verifikasi_ujian($id_ujian);
                $data['hasil']          = $this->exams_model->get_one_ujian($id_ujian);
                if($data['verify_status'] == '1') 
                {
                    if(!$this->input->cookie('id_hasil', TRUE)){
                        redirect('exams/latihan/akses/'.$id_ujian, 'refresh');
                    }
                    $id_hasil               = $this->input->cookie('id_hasil', TRUE);
                    $data['info_waktu']     = $this->exams_model->get_info_waktu($id_hasil);
                    $data['detik']          = (($data['hasil']->durasi) *60) - ($data['info_waktu']['waktu_spent']);
                    $data['jawaban_siswa']  = $this->exams_model->get_jawaban_siswa($id_hasil);
                    $soal_siswa             = array();

                    foreach($data['jawaban_siswa'] as $nilai_jawaban)
                    {
                        $soal_siswa[$nilai_jawaban['id_soal']] = $nilai_jawaban['konten'];
                    }
                    $data['soal_siswa']     = $soal_siswa;
                    $data['assigned_soal']  = $this->exams_model->get_soal($id_hasil);
                    $data['data_ujian']      = $this->exams_model->get_data_ujian($id_ujian);
                    $data['title']          = "Selamat mengerjakan";
                    $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                    $data['main_sub_title'] = "Halaman beranda";
                    $this->layout->load(MAIN_LAYOUT.'conducter',MAIN_PAGES.'exams/app_latihan/akses',$data);
                } 
                else
                {
                    $data['title']          = "Selamat mengerjakan";
                    $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                    $data['main_sub_title'] = "Halaman beranda";
                    $data['record']         = $this->exams_model->daftar_latihan();
                    $this->layout->load(MAIN_LAYOUT.'conducter',MAIN_PAGES.'exams/app_latihan/views',$data);
                }
            }
            else
            {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "Error Document";
                $data['main_sub_title'] = "Halaman tidak ditemukan";
                $data['record']         = $this->exams_model->daftar_latihan();
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_access/404',$data);
            }
        }
        
        public function forum()
        {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/app_forum/chats',$data);
        }
        
        public function agenda()
        {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
        }
        
        public function pengumuman()
        {
                $data['title']          = "COMBAT ID - Control Panel";
                $data['main_title']     = "SIstem Ujian Berbasis Komputer";
                $data['main_sub_title'] = "Halaman beranda";
                $this->layout->load(MAIN_LAYOUT.'exams',MAIN_PAGES.'exams/beranda',$data);
        }
        
        public function session()
        {
                $data['title']          = "Error Access";
                $data['main_title']     = "Error Session";
                $data['main_sub_title'] = "";
                $this->load->view(MAIN_PAGES.'exams/app_access/session',$data);
        }
        
        public function submit_ujian($id_ujian) {
                $this->ujian_model->submit_ujian($id_ujian);
                $ekode = strtoupper(md5($id_ujian));
                redirect('exams/laporan/'.$ekode.'/show__res?kode-laporan='.$id_ujian.time());
        }
        
        public function submit_latihan($id) {
            
        }
}
