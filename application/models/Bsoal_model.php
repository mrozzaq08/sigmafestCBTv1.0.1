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

class Bsoal_model extends CI_Model
{
        public function __construct()
        {
                parent::__construct();
        }
        
        public function paging_daftar_soal($posisi = '0', $batas)
        {
            if($posisi == 'all') 
            {
                $id_mapel   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_mapel',$id_mapel);
                return $this->db->get('bank_soal');     
            }
            else
            {
                $id_mapel   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_mapel',$id_mapel);
                return $this->db->get('bank_soal',$batas,$posisi);  
            }
        }
        
        public function total_bsoal()
        {
                $id_mapel   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_mapel',$id_mapel);
                return $this->db->get('bank_soal')->num_rows();                
        }

        public function daftar_bsoal()
        {
                $id_mapel   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_mapel',$id_mapel);
                return $this->db->get('bank_soal');                
        }
        
        
        public function paging_daftar_bsoal($batas,$id_mapel)
        {
                $extrap = "";
                if($id_mapel >= "1"){
                    $extrap = "AND bank_soal.id_mapel='".$id_mapel."'";
                } else {
                    $extrap = "";
                }

                $no_rows = $this->config->item('number_of_rows');
                if($this->input->post('search_type'))
                {
                    $search_type    = $this->input->post('search_type');
                    $search         = $this->input->post('search');

                    $query = $this->db->query("SELECT bank_soal.*, mapel.nama,
                             level_soal.nama_level FROM bank_soal, mapel, level_soal 
                             WHERE bank_soal.id_mapel = mapel.id_mapel AND bank_soal.id_level = level_soal.id_level 
                             AND $search_type LIKE '%$search%' $extrap ORDER BY id_soal DESC 
                             LIMIT $batas, $no_rows");

                } else 
                {
                    $query = $this->db->query("SELECT bank_soal.*, mapel.nama,
                             level_soal.nama_level FROM bank_soal, mapel, level_soal 
                             WHERE bank_soal.id_mapel = mapel.id_mapel AND bank_soal.id_level = level_soal.id_level 
                             $extrap ORDER BY id_soal DESC LIMIT $batas, $no_rows");
                }
                if($query -> num_rows() >= 1)
                {
                    return $query->result();
                }
                else
                {
                    return false;
                }
        }


        public function get_one_bsoal()
        {
                $id_mapel   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_soal',$id_mapel);
                return $this->db->get('bank_soal')->row();
        }

        public function daftar_pilihan()
        {
                $id_soal   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_soal',$id_soal);
                return $this->db->get('pilihan_jawab');
        }

        public function get_one_mapel()
        {
                $id_mapel   = $this->uri->segment(4);
                $this->db->select('*');
                $this->db->where('id_mapel',$id_mapel);
                return $this->db->get('mapel')->row();
        }

        public function get_one_update_mapel()
        {
                $id_mapel   = $this->uri->segment(3);
                $this->db->select('*');
                $this->db->where('id_mapel',$id_mapel);
                return $this->db->get('mapel')->row();
        }

        public function insert_bsoal()
        {
                $save_stay  = $this->input->post('sbaru');
                $save_exit  = $this->input->post('skeluar');
                $redirect   = $this->input->post('redirect');
                $bs_type    = $this->input->post('bs_type');
                $id_mapel   = $this->input->post('id_mapel');
                $id_level   = $this->input->post('id_level');
                $pertanyaan = $this->input->post('pertanyaan');
                $pertanyaan = stripslashes($pertanyaan);
                $pertanyaan = htmlspecialchars($pertanyaan,ENT_QUOTES);
                $referensi  = $this->input->post('referensi');
                $referensi  = stripslashes($referensi);
                $referensi  = htmlspecialchars($referensi,ENT_QUOTES);
                $option     = $this->input->post('option');

                $in_data    = array(
                    'id_mapel'  => $id_mapel,
                    'id_level'  => $id_level,
                    'pertanyaan'=> $pertanyaan,
                    'referensi' => $referensi,
                    'type_soal' => $bs_type
                );
                $in_bsoal   = $this->db->insert('bank_soal',$in_data);
                if($in_bsoal)
                {
                        $id_soal    = $this->db->insert_id();
                        if($bs_type == "bs-2")
                        {
                                $cek_data   = $this->input->post('checkbox');
                                foreach ($option as $key => $value)
                                {
                                        foreach ($cek_data as $key_2 => $value_2)
                                        {
                                            if($value_2 == $key)
                                            {
                                                $skor = (1 / count($cek_data));
                                                break;
                                            }
                                            else
                                                {
                                                $skor = '0';
                                            }
                                        }

                                        $in_array = array(
                                            'id_soal'   => $id_soal,
                                            'pilihan'   => $value,
                                            'skor'     => $skor
                                        );
                                        
                                        $this->db->insert('pilihan_jawab', $in_array);
                                }
                        }

                        else
                        {
                                $skor_val  = $this->input->post('skor');
                                foreach ($option as $key => $value)
                                {
                                        if($bs_type == 'bs-0' || $bs_type == 'bs-1')
                                        {

                                            if($key == $skor_val)
                                            {
                                                $skor = '1';
                                            }
                                            else
                                            {
                                                $skor = '0';
                                            }
                                        }

                                        if($bs_type == 'bs-3' || $bs_type == 'bs-4')
                                        {
                                            $skor = '1';
                                        }

                                        if($bs_type == 'bs-5')
                                        {
                                            $skor = (1 / count($option));
                                        }

                                        $in_array = array(
                                            'id_soal'   => $id_soal,
                                            'pilihan'   => $value,
                                            'skor'      => $skor
                                        );

                                        $this->db->insert('pilihan_jawab', $in_array);
                                }
                        }

                }

                $bstype = str_replace("bs-","bsoal-type-",$bs_type);
                if($save_stay)
                {
                    redirect('bsoal/create/new/'.$redirect.'/'.$bstype);
                }
                if($save_exit)
                {
                    redirect('bsoal/daftar/kode/'.$id_mapel);
                }
        }


        public function update_bsoal()
        {
                $redirect   = $this->input->post('redirect');
                $bs_type    = $this->input->post('bs_type');
                $id_soal    = $this->input->post('id_soal');
                $id_mapel   = $this->input->post('id_mapel');
                $id_level   = $this->input->post('id_level');
                $pertanyaan = $this->input->post('pertanyaan');
                $pertanyaan = stripslashes($pertanyaan);
                $pertanyaan = htmlspecialchars($pertanyaan,ENT_QUOTES);
                $referensi  = $this->input->post('referensi');
                $referensi  = stripslashes($referensi);
                $referensi  = htmlspecialchars($referensi,ENT_QUOTES);
                $id_pilihan = $this->input->post('id_pilihan');
                $option     = $this->input->post('option');

                $up_data    = array(
                    'id_mapel'  => $id_mapel,
                    'id_level'  => $id_level,
                    'pertanyaan'=> $pertanyaan,
                    'referensi' => $referensi,
                    'type_soal' => $bs_type
                );
                $up_bsoal   = $this->db->where('id_soal', $id_soal);
                $up_bsoal   = $this->db->update('bank_soal',$up_data);
                if($up_bsoal)
                {
                        if($bs_type == "bs-2")
                        {
                                $cek_data   = $this->input->post('checkbox');
                                foreach ($option as $key => $value)
                                {
                                        foreach ($cek_data as $key_2 => $value_2)
                                        {
                                            if($value_2 == $key)
                                            {
                                                $skor = (1 / count($cek_data));
                                                break;
                                            }
                                            else
                                                {
                                                $skor = '0';
                                            }
                                        }

                                        $up_array = array(
                                            'id_soal'   => $id_soal,
                                            'pilihan'   => $value,
                                            'skor'      => $skor
                                        );
                                        $this->db->where('id_pilihan',$id_pilihan[$key]);
                                        $this->db->update('pilihan_jawab', $up_array);
                                }
                        }

                        else
                        {
                                $skor_val  = $this->input->post('skor');
                                foreach ($option as $key => $value)
                                {
                                        if($bs_type == 'bs-0' || $bs_type == 'bs-1')
                                        {

                                            if($key == $skor_val)
                                            {
                                                $skor = '1';
                                            }
                                            else
                                            {
                                                $skor = '0';
                                            }
                                        }

                                        if($bs_type == 'bs-3' || $bs_type == 'bs-4')
                                        {
                                            $skor = '1';
                                        }

                                        if($bs_type == 'bs-5')
                                        {
                                            $skor = (1 / count($option));
                                        }

                                        $up_array = array(
                                            'id_soal'   => $id_soal,
                                            'pilihan'   => $value,
                                            'skor'     => $skor
                                        );

                                        $this->db->where('id_pilihan',$id_pilihan[$key]);
                                        $this->db->update('pilihan_jawab', $up_array);
                                }
                        }

                }
        }


        public function hapus_bsoal()
        {
                $cek_data   = $this->input->post('cek_data');
                $num_cek    = count($cek_data);
                for($i = 0; $i < $num_cek; $i++)
                {
                       $delpjawab = $this->db->delete('pilihan_jawab',array('id_soal'=>$cek_data[$i]));
                       if($delpjawab) {
                           $this->db->delete('bank_soal',array('id_soal'=>$cek_data[$i]));
                       }
                }
        }


        public function import_bsoal_data($pertanyaan)
        {
                $id_mapel=$this->input->post('id_mapel');
                $id_level=$this->input->post('id_level');
                foreach($pertanyaan as $key => $soal_tunggal)
                {
                        if($key != 0)
                        {
                                echo "<pre>";print_r($soal_tunggal);
                                $pertanyaan= str_replace('"','&#34;',$soal_tunggal['1']);
                                $pertanyaan= str_replace("`",'&#39;',$pertanyaan);
                                $pertanyaan= str_replace("‘",'&#39;',$pertanyaan);
                                $pertanyaan= str_replace("’",'&#39;',$pertanyaan);
                                $pertanyaan= str_replace("â€œ",'&#34;',$pertanyaan);
                                $pertanyaan= str_replace("â€˜",'&#39;',$pertanyaan);

                                $pertanyaan= str_replace("â€™",'&#39;',$pertanyaan);
                                $pertanyaan= str_replace("â€",'&#34;',$pertanyaan);
                                $pertanyaan= str_replace("'","&#39;",$pertanyaan);
                                $pertanyaan= str_replace("\n","<br>",$pertanyaan);
                                $referensi= str_replace('"','&#34;',$soal_tunggal['2']);
                                $referensi= str_replace("'","&#39;",$referensi);
                                $referensi= str_replace("\n","<br>",$referensi);
                                $bsoal_type= $soal_tunggal['0'];

                                $insert_data = array(
                                    'id_mapel' => $id_mapel,
                                    'id_level' => $id_level,
                                    'pertanyaan' =>$pertanyaan,
                                    'referensi' => $referensi,
                                    'type_soal' => $bsoal_type,
                                );

                                if($this->db->insert('bank_soal',$insert_data))
                                {
                                    $id_soal = $this->db->insert_id();
                                    $hitung_pilihan_tf = 4;
                                    if($bsoal_type=="bs-0"){
                                        for($i=1;$i<=10;$i++){
                                            if($soal_tunggal[$hitung_pilihan_tf] != "")
                                            {
                                                if($soal_tunggal['3'] == $i){ $pilihan_benar ='1'; } else{ $pilihan_benar = '0'; }
                                                $insert_pilihan = array(
                                                    "id_soal" =>$id_soal,
                                                    "pilihan" => $soal_tunggal[$hitung_pilihan_tf],
                                                    "skor" => $pilihan_benar
                                                );
                                                $this->db->insert("pilihan_jawab",$insert_pilihan);
                                                $hitung_pilihan_tf++;
                                            }
                                        }
                                    }
                                    
                                    $hitung_pilihan = 4;
                                    if($bsoal_type=="bs-1" || $bsoal_type==""){
                                        for($i=1;$i<=10;$i++){
                                            if($soal_tunggal[$hitung_pilihan] != ""){
                                            if($soal_tunggal['3'] == $i){ $pilihan_benar ='1'; }
                                            else{ $pilihan_benar = '0'; }
                                            $insert_pilihan = array(
                                                'id_soal' => $id_soal,
                                                'pilihan' => $soal_tunggal[$hitung_pilihan],
                                                'skor'    => $pilihan_benar
                                            );
                                            $this->db->insert("pilihan_jawab",$insert_pilihan);
                                            $hitung_pilihan++;
                                            }
                                        }
                                    }


                                    if($bsoal_type=="bs-2"){
                                        $correct_options=explode(",",$soal_tunggal['3']);
                                        $no_correct=count($correct_options);
                                        $pilihan_benarm=array();
                                        for($i=1;$i<=10;$i++){
                                            if($soal_tunggal[$hitung_pilihan] != ""){
                                                foreach($correct_options as $valueop){
                                                    if($valueop == $i){ 
                                                        $pilihan_benarm[$i-1] =(1/$no_correct);
                                                        break;
                                                    } else { 
                                                        $pilihan_benarm[$i-1] = '0';
                                                    }
                                                }
                                            }
                                        }


                                        for($i=1;$i<=10;$i++){
                                            if($soal_tunggal[$hitung_pilihan] != ""){
                                                $insert_pilihan = array(
                                                    'id_soal' => $id_soal,
                                                    'pilihan' => $soal_tunggal[$hitung_pilihan],
                                                    'skor'    => $pilihan_benarm[$i-1]
                                                );
                                                $this->db->insert("pilihan_jawab",$insert_pilihan);
                                                $hitung_pilihan++;
                                                }
                                        }
                                }

                                if($bsoal_type=="bs-3"){
                                    for($i=1;$i<=1;$i++){
                                        if($soal_tunggal[$hitung_pilihan] != ""){
                                            if($soal_tunggal['3'] == $i){ $pilihan_benar ='1'; }
                                            $insert_pilihan = array(
                                                'id_soal' => $id_soal,
                                                'pilihan' => $soal_tunggal[$hitung_pilihan],
                                                'skor'    => '1'
                                            );
                                            $this->db->insert("pilihan_jawab",$insert_pilihan);
                                            $hitung_pilihan++;
                                        }

                                    }

                                }

                                if($bsoal_type=="bs-4"){
                                    for($i=1;$i<=1;$i++){
                                        if($soal_tunggal[$hitung_pilihan] != ""){
                                            if($soal_tunggal['3'] == $i){ $pilihan_benar ='1'; }
                                            $insert_pilihan = array(
                                                'id_soal' => $id_soal,
                                                'pilihan' => $soal_tunggal[$hitung_pilihan],
                                                'skor'    => '1'
                                            );
                                            $this->db->insert("pilihan_jawab",$insert_pilihan);
                                            $hitung_pilihan++;
                                        }
                                    }
                                }

                                if($bsoal_type=="bs-5"){
                                    $pilihan_match=0;
                                    for($j=1;$j<=10;$j++){
                                        if($soal_tunggal[$hitung_pilihan] != ""){
                                            $pilihan_match+=1;
                                            $hitung_pilihan++;
                                        }
                                    }
                                    $hitung_pilihan=4;
                                    for($i=1;$i<=10;$i++){
                                        if($soal_tunggal[$hitung_pilihan] != ""){
                                            $pilihan_benar = (1 / $pilihan_match);
                                            $insert_pilihan = array(
                                                'id_soal' => $id_soal,
                                                'pilihan' => $soal_tunggal[$hitung_pilihan],
                                                'skor'    => $pilihan_benar
                                            );
                                            $this->db->insert("pilihan_jawab",$insert_pilihan);
                                            $hitung_pilihan++;
                                        }
                                    }
                                }
                            }
                        }
                    }
            }
}
