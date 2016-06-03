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

class Main_model extends CI_Model
{
    
        public  $sekolah;
        public  $kepala;
        public  $npsn;
        public  $akreditas;
        public  $alamat;
        public  $email;
        public  $telp;
        public  $fax;

        public function __construct()
        {
                parent::__construct();
                $levelakses = $this->session->userdata('e113snay_level');
                define('E_LEVEL', $levelakses);
        }

        public function get_pengaturan()
        {
                $query  = "SELECT * FROM pengaturan WHERE id_setelan='1135'";
                $result = $this->db->query($query);
                return $result->row();
        }

        public function auto_number($tabel, $kolom, $lebar=0, $awalan='')
        {
            $query          = "SELECT $kolom FROM $tabel ORDER BY $kolom DESC LIMIT 1";
            $hasil          = $this->db->query($query);
            $jumlahrecord   = $hasil->num_rows();
            $row            = $hasil->row_array();
            if($jumlahrecord == 0) 
            {
                $nomor = 1;
            }
            else
            {
                $nomor  = intval(substr($row[$kolom],strlen($awalan)))+1;
                
            }
            if($lebar > 0)
            {
                $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
            }
            else 
            {
                $angka = $awalan.$nomor;
            }

            return  $angka;
        }

        public function update_pengaturan_favicon($fname)
        {
                $sekolah        = $this->input->post('sekolah');
                $kepala         = $this->input->post('kepala');
                $npsn           = $this->input->post('npsn');
                $akreditas      = $this->input->post('akreditas');
                $alamat         = $this->input->post('alamat');
                $email          = $this->input->post('email');
                $telp           = $this->input->post('telp');
                $fax            = $this->input->post('fax');
                $favicon        = $fname;


                $update_array   = array(
                    'nama_sekolah'      => $sekolah,
                    'kepala_sekolah'    => $kepala,
                    'npsn_sekolah'      => $npsn,
                    'akreditas_sekolah' => $akreditas,
                    'alamat_sekolah'    => $alamat,
                    'email_sekolah'     => $email,
                    'telp_sekolah'      => $telp,
                    'fax_sekolah'       => $fax,
                    'favicon'           => $favicon
                );
                $this->db->where('id_setelan','1135');
                $this->db->update('pengaturan', $update_array);

                redirect('main/pengaturan');
        }

        public function update_pengaturan_profil()
        {
                $sekolah        = $this->input->post('sekolah');
                $kepala         = $this->input->post('kepala');
                $npsn           = $this->input->post('npsn');
                $akreditas      = $this->input->post('akreditas');
                $alamat         = $this->input->post('alamat');
                $email          = $this->input->post('email');
                $telp           = $this->input->post('telp');
                $fax            = $this->input->post('fax');

                $update_array   = array(
                    'nama_sekolah'      => $sekolah,
                    'kepala_sekolah'    => $kepala,
                    'npsn_sekolah'      => $npsn,
                    'akreditas_sekolah' => $akreditas,
                    'alamat_sekolah'    => $alamat,
                    'email_sekolah'     => $email,
                    'telp_sekolah'      => $telp,
                    'fax_sekolah'       => $fax
                );
                $this->db->where('id_setelan','1135');
                $this->db->update('pengaturan', $update_array);
                
                redirect('main/pengaturan');

        }
}
