<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*
* Addets 1.45 configuration file.
* CodeIgniter-library for Asset Management
*/

/*
|--------------------------------------------------------------------------
| Script Directory
|--------------------------------------------------------------------------
|
| Path to the script directory.  Relative to the CI front controller.
|
*/

$config['script_dir'] = 'assets/js/';


/*
|--------------------------------------------------------------------------
| Style Directory
|--------------------------------------------------------------------------
|
| Path to the style directory.  Relative to the CI front controller
|
*/

$config['style_dir'] = 'assets/css/';

/*
|--------------------------------------------------------------------------
| Cache Directory
|--------------------------------------------------------------------------
|
| Path to the cache directory. Must be writable. Relative to the CI 
| front controller.
|
*/

$config['cache_dir'] = 'assets/cache/';




/*
* The following config values are not required.  See Libraries/Carabiner.php
* for more information.
*/



/*
|--------------------------------------------------------------------------
| Base URI
|--------------------------------------------------------------------------
|
|  Base uri of the site, like http://www.example.com/ Defaults to the CI 
|  config value for base_url.
|
*/

//$config['base_uri'] = 'http://www.example.com/';


/*
|--------------------------------------------------------------------------
| Development Flag
|--------------------------------------------------------------------------
|
|  Flags whether your in a development environment or not. Defaults to FALSE.
|
*/

$config['dev'] = FALSE;


/*
|--------------------------------------------------------------------------
| Combine
|--------------------------------------------------------------------------
|
| Flags whether files should be combined. Defaults to TRUE.
|
*/

$config['combine'] = TRUE;


/*
|--------------------------------------------------------------------------
| Minify Javascript
|--------------------------------------------------------------------------
|
| Global flag for whether JS should be minified. Defaults to TRUE.
|
*/

$config['minify_js'] = TRUE;


/*
|--------------------------------------------------------------------------
| Minify CSS
|--------------------------------------------------------------------------
|
| Global flag for whether CSS should be minified. Defaults to TRUE.
|
*/

$config['minify_css'] = TRUE;

/*
|--------------------------------------------------------------------------
| Force cURL
|--------------------------------------------------------------------------
|
| Global flag for whether to force the use of cURL instead of file_get_contents()
| Defaults to FALSE.
|
*/

$config['force_curl'] = FALSE;


/*
|--------------------------------------------------------------------------
| Predifined Asset Groups
|--------------------------------------------------------------------------
|
| Any groups defined here will automatically be included.  Of course, they
| won't be displayed unless you explicity display them ( like this: $this->assets->display('jquery') )
| See docs for more.
| 
| Currently created groups:
|	> jQuery (latest in 1.xx version)
|	> jQuery UI (latest in 1.xx version)
|	> Ext Core (latest in 3.xx version)
|	> Chrome Frame (latest in 1.xx version)
|	> Prototype (latest in 1.x.x.x version)
|	> script.aculo.us (latest in 1.x.x version)
|	> Mootools (1.xx version)
|	> Dojo (latest in 1.xx version)
|	> SWFObject (latest in 2.xx version)
|	> YUI (latest core JS/CSS in 2.x.x version)
|
*/

// jQuery (latest, as of 1.xx)
$config['groups']['jquery'] = array(
	
	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', TRUE, FALSE)
	
	)
);


// jQuery UI (latest, as of 1.xx)
$config['groups']['jqueryui'] = array(
	
	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', TRUE, FALSE),
		array('http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', TRUE, FALSE)
	
	)
);


// Ext Core (latest, as of 3.xx)
$config['groups']['ext-core'] = array(
	
	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/ext-core/3.0.0/ext-core-debug.js', 'http://ajax.googleapis.com/ajax/libs/ext-core/3/ext-core.js', TRUE, FALSE)
	
	)
);

// Chrome Frame (latest, as of 1.xx)
$config['groups']['chrome-frame'] = array(
	
	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/ext-core/3.0.0/ext-core-debug.js', 'http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js', TRUE, FALSE)
	
	)
);

// Prototype (latest, as of 1.x.x.x)
$config['groups']['prototype'] = array(

	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js', 'http://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js', TRUE, FALSE)
	
	)
);


// script.aculo.us (latest, as of 1.x.x)
$config['groups']['scriptaculous'] = array(

	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js', 'http://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js', TRUE , FALSE),
		array('http://ajax.googleapis.com/ajax/libs/scriptaculous/1/scriptaculous.js', 'http://ajax.googleapis.com/ajax/libs/scriptaculous/1/scriptaculous.js', TRUE, FALSE)
		
	)
	
);


// MooTools
$config['groups']['mootools'] = array(
	
	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/mootools/1/mootools.js', 'http://ajax.googleapis.com/ajax/libs/mootools/1/mootools-yui-compressed.js', TRUE, FALSE)
		
	)
);


// Dojo (latest, as of 1.xx)
$config['groups']['dojo'] = array(
	
	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/dojo/1/dojo/dojo.xd.js.uncompressed.js', 'http://ajax.googleapis.com/ajax/libs/dojo/1/dojo/dojo.xd.js', TRUE, FALSE)
	
	)
);


// SWFObject (latest, as of 2.xx)
$config['groups']['swfobject'] = array(

	'js' => array(
	
		array('http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject_src.js', 'http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js', TRUE, FALSE)
	
	)
	
);


// YUI (latest, as of 2.x.x)
$config['groups']['yui'] = array(
	
	'js' => array(
	
		// JS Core
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/yuiloader/yuiloader.js', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/yuiloader/yuiloader.js', TRUE, FALSE),
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/dom/dom.js', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/dom/dom-min.js', TRUE, FALSE),
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/event/event.js', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/event/event-min.js', TRUE, FALSE)
	),
	
	
	'css' => array(
	
		// CSS Core
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/fonts/fonts.css', 'screen', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/fonts/fonts-min.css', TRUE, FALSE),	
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/reset/reset.css', 'screen', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/reset/reset-min.css', TRUE, FALSE),
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/grids/grids.css', 'screen', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/grids/grids-min.css', TRUE, FALSE),
		array('http://ajax.googleapis.com/ajax/libs/yui/2/build/base/base.css', 'screen', 'http://ajax.googleapis.com/ajax/libs/yui/2/build/base/base-min.css', TRUE, FALSE)
	)

);

