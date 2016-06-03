<?php

/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */
$c =  dirname(dirname(dirname($_SERVER["PHP_SELF"])));
if($c == '\\') $c = str_ireplace("\\","",$c);
$_SERVER["HTTP_HOST"] = $_SERVER["HTTP_HOST"].$c;
if(strlen($c) > 1) $c = "$c/"; 
$_SESSION['media_root'] = $c;

require "core/bootstrap.php";
$browser = "kcfinder\\browser"; // To execute core/bootstrap.php on older
$browser = new $browser();      // PHP versions (even PHP 4)
$browser->action();

