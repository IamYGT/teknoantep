<?php
define('INC', true);
require_once("../include/functions.php");
require_once("../system/csrf.class.php");
require_once("../system/class-crypt.php");
sec_session_start();

$csrf = new csrf();
$simpleCrypt = new SimpleCrypt;

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

/***************************** ####### ********************************/
if(isset($_POST)) {

$kontrol = $db->table('dbo_ebulten')
			  ->where('ebulten_mail','=',$_POST['ebulten'])
			  ->getAll();

$ksonuc = $db->numRows();

	if(!$csrf->check_valid('post')) {
		echo 'TOKEN';
	
	}else
		if($_POST['ebulten'] == ""){
		echo 'BOS';
		
	}else
		if($ksonuc > 0){
		echo 'EKHT';
	
	}else{
			
	$data = [ 'ebulten_mail'	=> guvenlik($_POST['ebulten']) ];
	
	$isle = $db->table('dbo_ebulten')->insert($data);
	
	if($isle){
		echo 'TAMAM';
	}else{
		echo 'HATA';
	}
	
}}
?>