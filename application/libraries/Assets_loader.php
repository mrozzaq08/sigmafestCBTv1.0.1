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

class Assets_loader
{
    public function __construct() 
    {
            $CI_load = & get_instance();
            $CI_load->load->library('assets');
            $assets_config = array(
                'script_dir' => 'assets/js/',
                'style_dir'  => 'assets/css/',
                'cache_dir'  => 'assets/cache/',
                'base_uri'   => base_url(),
                'combine'    => TRUE,
                'dev'        => TRUE,
                'minify_js'  => TRUE,
                'minify_css' => TRUE
            );

            $CI_load->assets->config($assets_config);

            $css_assets_global_cpanel = array(
                array('loader.main.min.css'),
                array('fonts/fonts.googleapis.com.css'),
                array('font-awesome/4.2.0/css/font-awesome.min.css'),
                array('Ibeesnay.css'),
                array('pages.css'),
            );

            $CI_load->assets->group('cpanel_desktop',
                    array('css'=>$css_assets_global_cpanel));
            
            $css_assets_global_exams = array(
                array('loader.min.css'),
                array('fonts/fonts.googleapis.com.css'),
                array('font-awesome/4.2.0/css/font-awesome.min.css'),
                array('Ibeesnay.css'),
                array('pages.css'),
            );

            $CI_load->assets->group('exams_desktop',
                    array('css'=>$css_assets_global_exams));
            
            $css_assets_global_coducter = array(
                array('loader.min.css'),
                array('font-awesome/4.2.0/css/font-awesome.min.css'),
                array('Ibeesnay.css'),
            );

            $CI_load->assets->group('conducter_desktop',
                    array('css'=>$css_assets_global_coducter));
            
            
            $css_assets_global_login = array(
                array('loader.min.css'),
                array('font-awesome/4.2.0/css/font-awesome.min.css'),
            );

            $CI_load->assets->group('login_desktop',
                    array('css'=>$css_assets_global_login));
            
            
            
            $js_assets_global_cpanel = array(
                array('main.1.min.js'),
                array('main.2.min.js'),
                array('history/jquery.history.js'),
                array('general.js'),
                
            );

            $CI_load->assets->group('cpanel_desktop',
                    array('js'=>$js_assets_global_cpanel));
            
            $js_assets_global_exams = array(
                array('main.1.min.js'),
                array('history/jquery.history.js'),
            );

            $CI_load->assets->group(
                    'exams_desktop',array(
                        'js'=>$js_assets_global_exams
                    )
            );
            
            $js_assets_global_conducter = array(
                array('main.1.min.js'),
                array('plugins/ays.min.js'),
            );

            $CI_load->assets->group(
                    'conducter_desktop',array(
                        'js'=>$js_assets_global_conducter
                    )
            );
    }
}