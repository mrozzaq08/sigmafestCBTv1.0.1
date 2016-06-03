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

// List uploaded files in multifile mode
$db_connection_charset = 'utf8';

$filename           = '';     // Specify the dump filename to suppress the file selection dialog
$ajax               = true;   // AJAX mode: import will be done without refreshing the website
$linespersession    = 3000;   // Lines to be executed per one import session
$delaypersession    = 0;      // You can specify a sleep time in milliseconds after each session
                              // Works only if JavaScript is activated. Use to reduce server overrun

// CSV related settings (only if you use a CSV dump)

$csv_insert_table   = '';     // Destination table for CSV files
$csv_preempty_table = false;  // true: delete all entries from table specified in $csv_insert_table before processing
$csv_delimiter      = ',';    // Field delimiter in CSV file
$csv_add_quotes     = true;   // If your CSV data already have quotes around each field set it to false
$csv_add_slashes    = true;   // If your CSV data already have slashes in front of ' and " set it to false

// Allowed comment markers: lines starting with these strings will be ignored by BigDump

$comment[]='#';                       // Standard comment lines are dropped by default
$comment[]='-- ';
$comment[]='DELIMITER';               // Ignore DELIMITER switch as it's not a valid SQL statement
// $comment[]='---';                  // Uncomment this line if using proprietary dump created by outdated mysqldump
// $comment[]='CREATE DATABASE';      // Uncomment this line if your dump contains create database queries in order to ignore them
$comment[]='/*!';                     // Or add your own string to leave out other proprietary things

// Pre-queries: SQL queries to be executed at the beginning of each import session

// $pre_query[]='SET foreign_key_checks = 0';
// $pre_query[]='Add additional queries if you want here';

// Default query delimiter: this character at the line end tells Bigdump where a SQL statement ends
// Can be changed by DELIMITER statement in the dump file (normally used when defining procedures/functions)

$delimiter = ';';

// String quotes character

$string_quotes = '\'';                  // Change to '"' if your dump file uses double qoutes for strings

// How many lines may be considered to be one query (except text lines)

$max_query_lines = 300;

// Where to put the upload files into (default: bigdump folder)

$upload_dir = "restore/";
$error = false;
$file  = false;
if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ if ($dirhandle = opendir($upload_dir)) 
  { 
    $files=array();
    while (false !== ($files[] = readdir($dirhandle)));
    closedir($dirhandle);
    $dirhead=false;

    if (sizeof($files)>0)
    { 
      sort($files);
      foreach ($files as $dirfile)
      { 
        if ($dirfile != "." && $dirfile != ".." && $dirfile!=basename($_SERVER["SCRIPT_FILENAME"]) && preg_match("/\.(sql|gz|csv)$/i",$dirfile))
        { if (!$dirhead)
          { echo ("<table class='table table-striped table-bordered' width=\"100%\" cellspacing=\"2\" cellpadding=\"2\">\n");
            echo ("<tr><th>Nama berkas</th><th>Ukuran</th><th>Tanggal &amp; waktu</th><th>Jenis</th><th colspan='2'>Pilihan</th>\n");
            $dirhead=true;
          }
          echo ("<tr><td>$dirfile</td><td>".format_size(filesize($upload_dir.'/'.$dirfile))."</td><td>".date ("Y-m-d H:i:s", filemtime($upload_dir.'/'.$dirfile))."<br><small>Di upload ".time_ago(date ("Y-m-d H:i:s", filemtime($upload_dir.'/'.$dirfile)))."</small></td>");

          if (preg_match("/\.sql$/i",$dirfile))
            echo ("<td>SQL</td>");
          elseif (preg_match("/\.gz$/i",$dirfile))
            echo ("<td>GZip</td>");
          elseif (preg_match("/\.csv$/i",$dirfile))
            echo ("<td>CSV</td>");
          else
            echo ("<td>Misc</td>");

          if ((preg_match("/\.gz$/i",$dirfile) && function_exists("gzopen")) || preg_match("/\.sql$/i",$dirfile) || preg_match("/\.csv$/i",$dirfile))
            echo ("<td><a style='width: 100%;' class='btn btn-info btn-xs' href=\"?start=1&amp;fn=".urlencode($dirfile)."&amp;foffset=0&amp;totalqueries=0&amp;delimiter=".urlencode($delimiter)."\">Mulai Import Data</a> <br>
				 <small></small></td>\n <td><a class='btn btn-xs btn-danger' target=\"_parent\" onclick=\"return confirm('Yakin ingin mneghapus berkas basis data ini ?\n\n Dengan catatan: berkas akan dihapus secara permanen');\" href=\"../main/removefile/".urlencode($dirfile)."\">Hapus</a></td></tr>\n");
          else
            echo ("<td>&nbsp;</td>\n <td>&nbsp;</td></tr>\n");
        }
      }
    }

    if ($dirhead) 
      echo ("</table>\n");
    else 
      echo ("<p>Tidak ada berkas SQL, GZ atau CSV yang kami temukan.</p>\n");
  }
  else
  { echo ("<p class=\"error\">Error listing directory $upload_dir</p>\n");
    $error=true;
  }
}

