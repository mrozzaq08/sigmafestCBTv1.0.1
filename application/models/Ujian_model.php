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

class Ujian_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }
        
        public function daftar_ujian()
        {
                $sess_level  = $this->session->userdata('e113snay_level');
                if($sess_level == 'admin') 
                {
                        $query_ujian = "SELECT tu.*, mp.nama, ku.nama_kategori FROM topik_ujian AS tu,
                                        kategori_ujian as ku, mapel as mp WHERE tu.id_kategori = ku.id_kategori
                                        AND tu.id_mapel = mp.id_mapel";
                        return $this->db->query($query_ujian);
                        
                }
                
                else 
                {
                        $query_ujian = "SELECT tu.*, mp.nama, ku.nama_kategori FROM topik_ujian AS tu,
                                        kategori_ujian as ku, mapel as mp WHERE tu.id_kategori = ku.id_kategori
                                        AND tu.id_mapel = mp.id_mapel AND 
                                        mp.id_pengajar='".$this->session->userdata('e113snay_id_guru')."'";
                        return $this->db->query($query_ujian);
                }
        }
        
        public function ajax_show_kelas_mapel($id_mapel) 
        {    
                $query      = $this->db->query("SELECT id_kelas FROM mapel WHERE id_mapel='$id_mapel'");
                $mapel      = $query->row();
                $data_kelas = explode(",",$mapel->id_kelas);
                foreach($data_kelas as $rows_kelas)
                {
                    $query_kelas = $this->db->query("SELECT nama FROM kelas WHERE id_kelas='$rows_kelas'");
                    $nama_kelas  = $query_kelas->result();
                    echo '<option value="'.$rows_kelas.'">'.$rows_kelas.' - </option>';
                }
                echo '<option>'.$id_mapel.'</option>';
        }


        public function get_one_ujian()
        {
                $id_ujian    = $this->uri->segment(4);
                $query_mapel = "SELECT * FROM topik_ujian WHERE id_ujian='$id_ujian' LIMIT 1";
                $result      = $this->db->query($query_mapel);
                return $result->row();
        }
        
        public function hapus_ujian()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                        $this->db->delete('topik_ujian',array('id_ujian'=>$cek_data[$i]));
                }
        }
        
        
        public function insert_ujian()
        {
                $nama           = $this->input->post('nama');
                $keterangan     = $this->input->post('keterangan');
                $id_mapel       = $this->input->post('id_mapel');
                $id_kelas       = $this->input->post('id_kelas');
                $id_kategori    = $this->input->post('id_kategori');
                $batas_waktu    = $this->input->post('batas_waktu');
                $batas_akses    = $this->input->post('batas_akses');
                $waktu_mulai    = strtotime($this->input->post('waktu_mulai'));
                $waktu_selesai  = strtotime($this->input->post('waktu_selesai'));
                $type           = $this->input->post('type');
                $view_answer    = $this->input->post('view_answer');
                $skor_benar     = $this->input->post('skor_benar');
                $skor_salah     = $this->input->post('skor_salah');
                $persentase     = $this->input->post('persentase');
                $pilih_soal     = $this->input->post('pilih_soal');

                $data_array     = array(
                    'judul'         => $nama,
                    'keterangan'    => $keterangan,
                    'id_mapel'      => $id_mapel,
                    'id_kelas'      => multipleSelect($id_kelas),
                    'id_kategori'   => $id_kategori,
                    'waktu_mulai'   => $waktu_mulai,
                    'waktu_selesai' => $waktu_selesai,
                    'durasi'        => $batas_waktu,
                    'max_akses'     => $batas_akses,
                    'type'          => $type,
                    'view_answer'   => $view_answer,
                    'skor_benar'    => $skor_benar,
                    'skor_salah'    => $skor_salah,
                    'persentase'    => $persentase
                );

                $this->db->insert('topik_ujian', $data_array);
        }
		
		
        public function update_ujian()
        {
                $id_ujian 	= $this->input->post('id_ujian');
                $nama           = $this->input->post('nama');
                $keterangan     = $this->input->post('keterangan');
                $id_kategori    = $this->input->post('id_kategori');
                $batas_waktu    = $this->input->post('batas_waktu');
                $batas_akses    = $this->input->post('batas_akses');
                $waktu_mulai    = strtotime($this->input->post('waktu_mulai'));
                $waktu_selesai  = strtotime($this->input->post('waktu_selesai'));
                $type           = $this->input->post('type');
                $view_answer    = $this->input->post('view_answer');
                $skor_benar     = $this->input->post('skor_benar');
                $skor_salah     = $this->input->post('skor_salah');
                $persentase     = $this->input->post('persentase');
                $pilih_soal     = $this->input->post('pilih_soal');

                $data_array     = array(
                    'judul'         => $nama,
                    'keterangan'    => $keterangan,
                    'id_kategori'   => $id_kategori,
                    'durasi'        => $batas_waktu,
                    'max_akses'     => $batas_akses,
                    'waktu_mulai'   => $waktu_mulai,
                    'waktu_selesai' => $waktu_selesai,
                    'type'          => $type,
                    'view_answer'   => $view_answer,
                    'skor_benar'    => $skor_benar,
                    'skor_salah'    => $skor_salah,
                    'persentase'    => $persentase
                );
				
		$this->db->where('id_ujian', $id_ujian);
                $this->db->update('topik_ujian', $data_array);
        }
        
        
        public function ajax_update_waktu_spent_individu($id_hasil,$id_soal,$waktu_soal) 
        {
                   $query           = $this -> db -> query("SELECT hasil_ujian.* FROM hasil_ujian WHERE id_hasil='$id_hasil'");
                   $row             = $query->row_array();
                   $waktu_spent_ind = explode(",",$row['waktu_spent_ind']);
                   foreach($waktu_spent_ind as $key => $val){
                        if($key == $id_soal)
                        {
                            $waktu_spent_ind[$key] += $waktu_soal;
                        }
                   }

                   $waktu_spent_ind = implode(",",$waktu_spent_ind);
                   $ubah_waktu      = array(
                       'waktu_spent_ind' => $waktu_spent_ind
                   );
                   $this->db->where(array('id_hasil' => $id_hasil));
                   $this->db->update('hasil_ujian', $ubah_waktu);
        }
        
        
        public function ajax_tambah_soal_ujian($id_ujian,$id_soal)
        {
                   $this->db->where('id_ujian',$id_ujian);
                   $query   = $this->db->get('topik_ujian');
                   $result  = $query->row_array();
                   $id_soals= $result['id_soals_statis'];
                   if($id_soals=="") {
                        $id_soals=array();
                   } else {
                        $id_soals=explode(",",$id_soals);
                   }
                   $id_soals[]=$id_soal;
                   $id_soals    = array_filter(array_unique($id_soals));
                   $id_soals    = implode(",",$id_soals);
                   $userdata    = array(
                        'id_soals_statis'=>$id_soals
                   );
                   $this->db->where('id_ujian',$id_ujian);
                   $this->db->update('topik_ujian',$userdata);
        }
		
		
        public function assigned_soal_manual($id_ujian){
                $this->db->where('id_ujian',$id_ujian);
                $query		= $this->db->get('topik_ujian');
                $result		= $query->row_array();
                $id_soals	= $result['id_soals_statis'];
                if($id_soals != '')
                {
                        $query_join = "SELECT bank_soal.*,mapel.*,level_soal.nama_level FROM bank_soal 
                                       JOIN mapel ON bank_soal.id_mapel = mapel.id_mapel JOIN level_soal ON 
                                       bank_soal.id_level = level_soal.id_level WHERE  id_soal in ($id_soals) ORDER BY FIELD(bank_soal.id_soal, $id_soals ) ";
                        $query 	= $this -> db -> query($query_join);
                        return $query->result();
                }
                else 
                {
                        return false;
                }
        }

        public function total_soal_manual($id_ujian){
                $this->db->where('id_ujian',$id_ujian);
                $query		= $this->db->get('topik_ujian');
                $result		= $query->row_array();
                $id_soals	= $result['id_soals_statis'];
                if($id_soals != '')
                {
                        $query_join	= "SELECT bank_soal.*,mapel.*,level_soal.nama_level FROM bank_soal 
                                        JOIN mapel ON bank_soal.id_mapel = mapel.id_mapel JOIN level_soal ON 
                                        bank_soal.id_level = level_soal.id_level WHERE  id_soal in ($id_soals) ORDER BY FIELD(bank_soal.id_soal, $id_soals ) ";
                        $query 	= $this -> db -> query($query_join);
                        return $query->num_rows();
                }
                else 
                {
                        return "0";
                }
        }
        
        
        function hapus_soal_ujian($id_ujian,$id_soal)
        {
                $this->db->where('id_ujian',$id_ujian);
                $query=$this->db->get('topik_ujian');
                $result=$query->row_array();
                $id_soals=$result['id_soals_statis'];
                if($id_soals == '') {
                    $id_soals = array();
                } else {
                    $id_soals=explode(",",$id_soals);
                }
                $id_soals_new=array();
                foreach($id_soals as $k => $qval){
                    if($qval != $id_soal){
                        $id_soals_new[]=$qval;
                    }
                }
                $id_soals   = array_filter(array_unique($id_soals_new));
                $id_soals   = implode(",",$id_soals);
                $userdata   = array(
                'id_soals_statis'=>$id_soals
                );
                $this->db->where('id_ujian',$id_ujian);
                $this->db->update('topik_ujian',$userdata);
        }

        function moving_up_soal($id_ujian,$id_soal)
        {
                $this->db->where('id_ujian',$id_ujian);
                $query   = $this->db->get('topik_ujian');
                $result  = $query->row_array();
                $id_soals= $result['id_soals_statis'];
                if($id_soals == "") {
                     $id_soals=array();
                } else {
                     $id_soals=explode(",",$id_soals);
                }
                $id_soals_new=array();
                foreach($id_soals as $k => $qval){
                     if($qval == $id_soal)
                     {
                         $id_soals_new[$k-1]=$qval;
                         $id_soals_new[$k]=$id_soals[$k-1];
                     }
                     else
                     {
                         $id_soals_new[$k]=$qval;
                     }
                }
                $id_soals = array_filter(array_unique($id_soals_new));
                $id_soals = implode(",",$id_soals);
                $userdata = array(
                'id_soals_statis'=>$id_soals
                );
                $this->db->where('id_ujian',$id_ujian);
                $this->db->update('topik_ujian',$userdata);
        }



        public function moving_down_soal($id_ujian,$id_soal)
        {
                $this->db->where('id_ujian',$id_ujian);
                $query   = $this->db->get('topik_ujian');
                $result  = $query->row_array();
                $id_soals= $result['id_soals_statis'];
                if($id_soals == "") {
                     $id_soals=array();
                } else {
                     $id_soals=explode(",",$id_soals);
                }

                $id_soals_new=array();
                foreach($id_soals as $k => $qval){
                     if($qval == $id_soal)
                     {
                             $id_soals_new[$k]=$id_soals[$k+1];
                             $kk=$k+1;
                             $kv=$qval;
                     }
                     else 
                     {
                         $id_soals_new[$k]=$qval;
                     }
                }

                $id_soals_new[$kk]=$kv;

                $id_soals    = array_filter(array_unique($id_soals_new));
                $id_soals    = implode(",",$id_soals);
                $userdata    = array(
                'id_soals_statis'=>$id_soals
                );

                $this->db->where('id_ujian',$id_ujian);
                $this->db->update('topik_ujian',$userdata);
        }
           
           
        function ajax_update_jawaban($id,$id_pil)
        {
                $id_hasil = $this->input->cookie('id_hasil', TRUE);
                $query    = $this->db->query("SELECT hasil_ujian.* FROM hasil_ujian WHERE id_hasil='$id_hasil'");
                $row      = $query->row_array();
                $id_pils  = explode(",",$row['id_pilihans']);
                foreach($id_pils as $key => $val){
                     if($key == $id){
                         $id_pils[$key]=$id_pil;
                     }
                }
                $id_pils = implode(",",$id_pils);
                $this->db->query("UPDATE hasil_ujian SET id_pilihans='$id_pils' WHERE id_hasil='$id_hasil'");
        }

        function ajax_update_essay() {
            $id_hasil    = $this->input->cookie('id_hasil', TRUE);
            $stype       = $this->input->post("type_soal");
            $id_soal     = $this->input->post("id_soal");
            $pil_siswa   = $this->input->post("pilihan_siswa");
            $insert_data = array(
                'id_soal'	 => $id_soal,
                'id_hasil'	 => $id_hasil,
                'konten'	 => $pil_siswa,
                'type_soal'	 => $stype,
                'skor_jawab' => '0'
            );

            $this->db->where('id_soal',$id_soal);
            $this->db->where('id_hasil',$id_hasil);
            $query = $this->db->get('jawab_soal');
            if($query->num_rows() == 0)
            {      
                $this->db->insert('jawab_soal', $insert_data);
            } 
            else
            {
                $data_isian = array(
                    'konten' => $pil_siswa
                );

                $this->db->where('id_soal',$id_soal);
                $this->db->where('id_hasil',$id_hasil);
                $this->db->update('jawab_soal', $data_isian);
            }
        }


        function submit_ujian($id)
        {
            $this->load->helper('cookie');
            $id_hasil       = $this->input->cookie('id_hasil', TRUE);
            $query          = $this->db->where('id_hasil',$id_hasil);
            $query          = $this->db->get('hasil_ujian');
            $result         = $query->row_array();
            $id_hasil_soals = $result['id_soals'];
            echo $id_hasil_soals.'<br>';
            $id_pilihansoal = $this->db->query("SELECT id_pilihan FROM pilihan_jawab WHERE id_soal IN ($id_hasil_soals)");
            $id_pilihansoal = $id_pilihansoal->result_array();
            $hasil_idpil    = array();
            foreach ($id_pilihansoal as $kunci => $ValueIDPilihan) {
                $hasil_idpil[] = $ValueIDPilihan['id_pilihan'];
            }
            
            $hasil_idpil = implode(",",$hasil_idpil);;
            
            $isian          = array();	
            $mencocokan     = array();
            $soal_pilihan[] = array();
            $ans_val[]      = array();	
            $nosoal         = $_POST['nosoal'];
            $soal_essay     = "0";
            $id_pilihans    = array();
            for($x=0; $x <= $nosoal; $x++)
            {
                if(($_POST['type_soal_'.$x]) == "bs-0")
                {
                    if($_POST['answers_'.$x]) {
                        $id_pilihans[$x] = $_POST['answers_'.$x];
                    } else {
                        $id_pilihans[$x] = 0;
                    }
                }
                
                if(($_POST['type_soal_'.$x]) == "bs-1")
                {
                    if($_POST['answers_'.$x]) {
                        $id_pilihans[$x] = $_POST['answers_'.$x];
                    } else {
                        $id_pilihans[$x] = 0;
                    }
                }

                if(($_POST['type_soal_'.$x]) == "bs-2")
                {
                    if($_POST['answers_'.$x]) {
                        $id_pilihans[$x] = implode("-",$_POST['answers_'.$x]);
                    } else {
                        $id_pilihans[$x] = 0;
                    }
                }

                if(($_POST['type_soal_'.$x]) == "bs-3" || ($_POST['type_soal_'.$x]) == "bs-4")
                {
                    $id_hasil_soals_ujian = explode(",",$id_hasil_soals);
                    if(isset($_POST['answers_'.$x]))
                    {
                        $data_siswa = array(
                            'id_hasil'  => $id_hasil,
                            'id_soal'   => $id_hasil_soals_ujian[$x],
                            'konten'    => $_POST['answers_'.$x] ,
                            'type_soal' => $_POST['type_soal_'.$x]
                         );
                        $this->db->where('id_soal',$id_hasil_soals_ujian[$x]);
                        $this->db->where('id_hasil',$id_hasil);
                        $query = $this->db->get('jawab_soal');
                        if($query->num_rows() == 0)
                        {
                            $this->db->insert('jawab_soal', $data_siswa);
                        }
                        else
                        {
                            $data_siswa1 = array(
                                'konten' => $_POST['answers_'.$x] 
                            );
                            $this->db->where('id_hasil',$id_hasil);
                            $this->db->where('id_soal',$id_hasil_soals_ujian[$x]);
                            $this->db->update('jawab_soal', $data_siswa1);
                        } 
                        $id_pilihans[$x] = $_POST['isian_kosong_'.$x];
                        $isian[]         = $_POST['answers_'.$x];
                    }
                    else
                    {
                        $id_pilihans[$x] = 0;
                    }
                }


                if(($_POST['type_soal_'.$x]) == "bs-5")
                {
                    if($_POST['answers_'.$x])
                    {
                        $cek = "0";
                        foreach($_POST['answers_'.$x] as $nilai)
                        {
                            if($nilai != NULL)
                            {
                                $cek = "1";
                            }
                        }
                        if($cek == "1")
                        {
                            $id_pilihans[$x] = implode("-",$_POST['soal_pilihan_'.$x]);
                            $bukan_jawaban_cocok = count($_POST['soal_pilihan_val_'.$x]);
                            for($x1=0; $x1 < $bukan_jawaban_cocok; $x1++)
                            {
                                $mencocokan[] = $_POST['soal_pilihan_val_'.$x][$x1]."=".$_POST['answers_'.$x][$x1];
                            }
                            $id_hasil_soals_ujian=explode(",",$id_hasil_soals);
                            $data = array(
                                'id_hasil'  => $id_hasil,
                                'id_soal'   => $id_hasil_soals_ujian[$x],
                                'konten'    => implode(",",$mencocokan),
                                'type_soal' => $_POST['type_soal_'.$x]
                             );

                            $this->db->insert('jawab_soal', $data);
                        }
                        else
                        {
                            $id_pilihans[$x] = 0;
                        }
                    }
                }

                if(($_POST['type_soal_'.$x])=="bs-6")
                {
                    $id_hasil_soals_ujian = explode(",",$id_hasil_soals);
                    if($_POST['answers_'.$x])
                    {
                        $id_pilihans[$x] = "0";
                        $data = array(
                            'id_hasil'  => $id_hasil,
                            'id_soal'   => $id_hasil_soals_ujian[$x],
                            'konten'    => $_POST['answers_'.$x]
                        );

                        $this->db->insert('jawab_soal', $data); 
                        $soal_essay = "1";
                    }
                    else
                    {
                        $id_pilihans[$x] = 0;
                    }
                }
            }

            $id_pilihan      = implode(",",$id_pilihans);
            echo $hasil_idpil.'<br>';
            echo $id_pilihan_res  = str_replace("-", ",", $id_pilihan).'<br>';
            $coba = explode(",", $id_pilihan_res);
            $hasilkami = array();
            foreach (explode(",",$hasil_idpil) as $key1135 => $value1135) {
                foreach ($coba as $valueCoba) {
                    if($value1135 == $valueCoba)
                        $hasilkami[] .= $valueCoba;
                    
                }
            }
            
            $hasilkami = implode(",", $hasilkami);
            echo $hasilkami;
            
            //delete_cookie("id_hasil");
            //exit();
            $query           = $this->db->query("SELECT topik_ujian.* FROM topik_ujian WHERE id_ujian='$id'");
            $topik_ujian     = $query->row_array();
            $skor_benar      = explode(",",$topik_ujian['skor_benar']);
            $skor_salah      = explode(",",$topik_ujian['skor_salah']);
            $id_pilihan_res  = str_replace("-", ",", $id_pilihan);
            $min_persentase  = $topik_ujian['persentase'];
            $query           = $this->db->query("SELECT pilihan_jawab.*, bank_soal.* FROM  pilihan_jawab, bank_soal 
                               WHERE pilihan_jawab.id_pilihan IN ( $hasilkami ) AND 
                               pilihan_jawab.id_soal=bank_soal.id_soal ORDER BY 
                               field(pilihan_jawab.id_soal,$id_hasil_soals)");
            $pilihans        = $query->result_array();
            $flip_id_hasil_soals = array_flip(explode(",",$id_hasil_soals));

            $skor            = 0;
            $soal_isian      = 0;
            $soal_cocok      = 0;
            $skor_individu   = array();
            $fliped_idpilhasil = array();
            foreach(explode(",",$id_hasil_soals) as $xord => $xvord)
            {
                $skor_individu[$xord]       = 0;
                $fliped_idpilhasil[$xvord]  = $xord;
            }

            $nomor = 1;
            foreach($pilihans as $kunci2 => $value)
            {
                if(!isset($pre_idsoal))
                {
                    $skor_individu_siswa = 0;
                } 
                else 
                {
                    if($pre_idsoal != $value['id_soal'])
                    {
                        $skor_individu[$fliped_idpilhasil[$id_pilihan_pre_idsoal]] = $skor_individu_siswa;
                        $skor_individu_siswa = 0;
                    }
                }

                if($value['type_soal'] == "bs-0")
                {
                    echo 'Nomor '.$nomor.'<br>';
                    echo $_POST;
                    echo 'Soal type : bs-0<br>';
                    if($value['skor'] > '0')
                    {
                        if(isset($skor_benar[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            $oke = '1';
                        } 
                        else 
                        {
                            $skor+=$value['skor'] * $skor_benar['0'];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$value['skor'] * $skor_benar['0'];
                            $oke = '0';
                        }
                    } 
                    else 
                    {
                        if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            $oke = '0';
                        } 
                        else 
                        {
                            $skor+=$skor_salah['0'];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$skor_salah['0'];
                            $oke = '0';
                        }
                    }
                    echo '<br>ID : '.$value['id_pilihan'].'<br><br>';
                }
                if($value['type_soal'] == "bs-1")
                {
                    echo 'Nomor '.$nomor.'<br>';
                    echo 'Soal type : bs-1<br>';
                    if($value['skor'] > '0')
                    {
                        if(isset($skor_benar[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            $oke = '1';
                        } 
                        else 
                        {
                            $skor+=$value['skor'] * $skor_benar['0'];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$value['skor'] * $skor_benar['0'];
                            $oke = '0';
                        }
                    } 
                    else 
                    {
                        if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            $oke = '0';
                        } 
                        else 
                        {
                            $skor+=$skor_salah['0'];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$skor_salah['0'];
                            $oke = '0';
                        }
                    }
                    echo '<br>ID : '.$value['id_pilihan'].'<br><br>';
                }
                
                if($value['type_soal'] == "bs-2")
                {
                    echo 'Nomor '.$nomor.'<br>';
                    echo 'Soal type : bs-2<br>';
                    if($value['skor'] > '0')
                    {
                        if(isset($skor_benar[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            $oke = '1';
                        } 
                        else 
                        {
                            $skor+=$value['skor'] * $skor_benar['0'];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$value['skor'] * $skor_benar['0'];
                            
                        }
                    } 
                    else 
                    {
                        if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            $oke = '0';
                        } 
                        else 
                        {
                            $skor+=$skor_salah['0'];
                            echo 'Skor hasil : '.$skor_individu_siswa+=$skor_salah['0'];
                            $oke = '0';
                        }
                    }
                    
                    echo '<br>ID : '.$value['id_pilihan'].'<br><br>';
                }  

                if($value['type_soal'] == "bs-3") 
                {
                    //echo 'Soal type : bs-3<br><br>';
                    echo $value['pilihan']."---".$isian[$soal_isian].'<br>';
                    if(strtoupper(trim($value['pilihan'])) == strtoupper(trim($isian[$soal_isian])))
                    {
                        if(isset($skor_benar[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            $skor_individu_siswa+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                        }
                        else
                        {
                            $skor+=$value['skor'] * $skor_benar['0'];
                            $skor_individu_siswa+=$value['skor'] * $skor_benar['0'];
                        }
                    }
                    else if($isian[$soal_isian] == NULL)
                    {
                        if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            $skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                        }
                        else
                        {
                            $skor+=$skor_salah['0'];
                            $skor_individu_siswa+=$skor_salah['0'];
                        }	
                    }
                    else
                    {
                        if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            $skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                        }
                        else
                        {
                            $skor+=$skor_salah['0'];
                            $skor_individu_siswa+=$skor_salah['0'];
                        }	
                    }
                    $soal_isian+=1;
                }

                if($value['type_soal'] == "bs-4")
                {
                    //echo 'Soal type : bs-4<br><br>';
                    if($isian[$soal_isian] != NULL)
                    {
                        $jawab_singkat  = explode(",", $value['pilihan']);
                        $cek_jawab_singkat = "0";
                        $bukan_jawabsingkat = count($jawab_singkat);
                        for($dkjs = 0; $dkjs < $bukan_jawabsingkat; $dkjs++)
                        {
                            if(strtoupper(trim($jawab_singkat[$dkjs])) == strtoupper(trim($isian[$soal_isian])))
                            {
                                echo "<br>".$isian[$soal_isian]."--B--".$jawab_singkat[$dkjs];
                                //echo $value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                                if(isset($skor_benar[$flip_id_hasil_soals[$value['id_soal']]]))
                                {
                                    $skor+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                                    $skor_individu_siswa+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                                }
                                else
                                {
                                    $skor+=$value['skor'] * $skor_benar['0'];
                                    $skor_individu_siswa+=$value['skor'] * $skor_benar['0'];
                                }

                                $cek_jawab_singkat = "1";
                            }
                        }

                        if($cek_jawab_singkat == "0")
                        {
                            if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                            {
                                $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                                $skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]];
                            }
                            else
                            {
                                $skor+=$skor_salah['0'];
                                $skor_individu_siswa+=$skor_salah['0'];
                            }
                        }
                    }

                    $soal_isian+=1;
                }

                if($value['type_soal']=="bs-5")
                {
                    //echo '<br>Soal type : bs-5<br><br>';
                    echo "<br>".$mencocokan[$soal_cocok]."---".$value['pilihan'];
                    if(in_array($value['pilihan'],$mencocokan))
                    {
                        if(isset($skor_benar[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                            $skor_individu_siswa+=$value['skor'] * $skor_benar[$flip_id_hasil_soals[$value['id_soal']]];
                        }
                        else
                        {
                            $skor+=$value['skor'] * $skor_benar['0'];
                            $skor_individu_siswa+=$value['skor'] * $skor_benar['0'];
                        }
                    }
                    else
                    {
                        if(isset($skor_salah[$flip_id_hasil_soals[$value['id_soal']]]))
                        {
                            $skor+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]]/count($mencocokan);
                            $skor_individu_siswa+=$skor_salah[$flip_id_hasil_soals[$value['id_soal']]]/count($mencocokan);
                        }
                        else
                        {
                            $skor+=$skor_salah['0']/count($mencocokan);
                            $skor_individu_siswa+=$skor_salah['0']/count($mencocokan);
                        }	
                    }
                    $soal_cocok+=1;
                }
                $pre_idsoal             = $value['id_soal'];
                $id_pilihan_pre_idsoal  = $value['id_soal'];
                $nomor++;
            }

            $skor_individu[$fliped_idpilhasil[$value['id_soal']]] = $skor_individu_siswa;
            $query      = $this -> db -> query("SELECT hasil_ujian.* FROM hasil_ujian where id_hasil='$id_hasil'");
            $hasujian   = $query->row_array();
            if(count($skor_benar) >= "2")
            {
                $persentase = ($skor / ( array_sum($skor_benar) ))* 100;
            }
            else
            {
                $persentase = ($skor / (count(explode(",",$hasujian['id_soals'])) * $skor_benar['0'] ))* 100;
            }

            if($persentase >= $min_persentase)
            {
                $hasil_tes  = "1";
            }
            else
            {
                $hasil_tes  = "0";
            }

            $waktu_spent    = time() - $hasujian['waktu_mulai'];
            $skor_individu  = implode(",",$skor_individu);
            if($soal_essay >= "1")
            {
                $hasil_tes  = "2";
            }
            $update_data = array(
                'id_pilihans'   => $id_pilihan,
                'waktu_selesai' => time(),
                'skor'          => $skor,
                'persentase'    => $persentase,
                'hasil_tes'     => $hasil_tes,
                'waktu_spent'   => $waktu_spent,
                'soal_essay'    => $soal_essay,
                'skor_ind'      => $skor_individu,
                'status'        => '1'
            );

            $this->db->where('id_hasil', $id_hasil);
            if($this->db->update('hasil_ujian',$update_data))
            {
                delete_cookie("id_hasil");
                return "Hasil ujian telah berhasil disimpan.";
            } 
            else
            {	
                return "Tidak dapat menyimpan hasil ujian.";
                delete_cookie("id_hasil");
            }
        }
}
