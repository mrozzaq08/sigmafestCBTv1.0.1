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

class Layout {
    
    var $Layout_data = array();
		
    function set($name, $value)
    {
            $this->Layout_data[$name] = $value;
    }

    function load($Layout = '', $view = '', $view_data = array(), $return = FALSE)
    {               
            $this->CI =& get_instance();
            $this->set('load_contents', $this->CI->load->view($view, $view_data, TRUE));
            return $this->CI->load->view($Layout, $this->Layout_data, $return);
    }
}