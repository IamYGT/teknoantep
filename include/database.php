<?php
if(!defined('INC')) exit('Bu dosyaya direkt erisim engellenmiştir!');

error_reporting(0);
require_once('DB.php');

$db = DB::init([
	'db_driver'		=> 'mysql',
	'db_host'		=> 'localhost',
	'db_user'		=> 'teknoantep_db',
	'db_pass'		=> 'B2ye0p8#',
	'db_name'		=> 'teknoantep_db',
	'db_charset'	=> 'utf8',
	'db_collation'	=> 'utf8_turkish_ci',
	'db_prefix'	 	=> ''
]);

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);
?>