<?php
define('INC', true);
require_once("../include/functions.php");
sec_session_start();
require_once("../system/csrf.class.php");

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

/***************************** ####### ********************************/
if(isset($_POST)) {
	
	if(!$csrf->check_valid('post')) {
		echo bilgi('danger','Token hatası oluştu, lütfen sayfayı yenileyerek tekrar deneyin.');
	
	}else
		if(empty(guvenlik($_POST['adiniz'])) || empty(guvenlik($_POST['email'])) || empty(guvenlik($_POST['gsmno'])) || empty(guvenlik($_POST['konu'])) || empty(guvenlik($_POST['mesaj'])) ){
		echo bilgi('danger','Geçersiz alan hatası oluştu, lütfen eksik bilgi bırakmadan tekrar deneyin.');
	
	
	}else{

	$data = [
			'iletisim_adiniz'	=> guvenlik($_POST['adiniz']),
			'iletisim_email'	=> guvenlik($_POST['email']),
			'iletisim_gsmno'	=> guvenlik($_POST['gsmno']),
			'iletisim_konu'		=> guvenlik($_POST['konu']),
			'iletisim_mesaj'	=> guvenlik($_POST['mesaj']),
			'iletisim_tarih'	=> $tarih
			];
			
	$isle = $db->table('dbo_iletisim')->insert($data);
	
	if($isle){
		echo alert('success','Mesajınız başarılı olarak gönderildi.',$site,3);
	}else{
		echo bilgi('danger','Mesajınız gönderilemedi, lütfen daha sonra tekrar deneyin.');
	}

}}
?>