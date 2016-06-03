<?php

/**
 * Sistem Ujian Berbasis Komputer (CBT)
 * @version    : 1.0.0
 * @package    : IBeESNay
 * @creator    : SUNARDI
 * @email      : sunardi.1135@yahoo.com
 * @facebook   : wwww.facebook.com/ibeesnay
 * @twitter    : @IBeESNay
 */
/**
 *      @desc CMS integration code: CodeIgniter
 *   @package KCFinder-CodeIgniter
 *   @version 0.3
 */
class CodeIgniter {
    static function getSession() {
        session_start();
        define('ENVIRONMENT', 'production');
        define('BASEPATH', realpath(dirname(__FILE__)).'/../../../system/');
        define('APPPATH', realpath(dirname(__FILE__)).'/../../../application/');
        require('../../application/config/database.php');
        require('../../system/core/Common.php');        
        require('../../system/database/DB.php');
        
        $database = DB($db['default']);
        
        if (!isset($_COOKIE['ci_session'])) return;
        
        $database->where('id', $_COOKIE['ci_session']);
        $query = $database->get('ci_sessions');
        $result = $query->row();
 
        if ($result) {
            $ci_session = self::decode_session($result->data);
            
            if (!isset($_SESSION['KCFINDER'])) $_SESSION['KCFINDER'] = array();
            
            if (isset($ci_session['KCFINDER'])) {                
                $_SESSION['KCFINDER'] = array_merge($ci_session['KCFINDER'], $_SESSION['KCFINDER']);
            }
        }
    }
    
    static function decode_session($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            if (!strstr(substr($session_data, $offset), "|")) {
                throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
            }
            $pos = strpos($session_data, "|", $offset);
            $num = $pos - $offset;
            $varname = substr($session_data, $offset, $num);
            $offset += $num + 1;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }
}
CodeIgniter::getSession();
