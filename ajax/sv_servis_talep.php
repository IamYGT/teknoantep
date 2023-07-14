<?php
define('INC', true);
require_once("../include/functions.php");
require_once("../system/class.iletimerkezi.php");
require_once("../system/class.sendmail.php");
sec_session_start();

require_once("../system/csrf.class.php");

$csrf = new csrf();

// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$kontrol = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$gssecretkey."&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
/***************************** ####### ********************************/
if(isset($_POST)) {
	
	if(!$csrf->check_valid('post')) {
		echo bilgi('danger','Token hatası oluştu, lütfen sayfayı yenileyerek tekrar deneyin.');
	
	}else
		if(empty(guvenlik($_POST['adiniz'])) || empty(guvenlik($_POST['email'])) || empty(guvenlik($_POST['gsmno'])) || empty(guvenlik($_POST['adres'])) || empty(guvenlik($_POST['tarihi'])) || empty(guvenlik($_POST['mesaj'])) ){
		echo bilgi('danger','Geçersiz alan hatası oluştu, lütfen eksik bilgi bırakmadan tekrar deneyin.');
	
	}else
		if(empty($_POST['g-recaptcha-response'])) {
		echo bilgi('danger','Lütfen robot olmadığınızı doğrulayın!');
	
	}else{

	$data = [
			'srv_adsoyad'	=> guvenlik($_POST['adiniz']),
			'srv_gsmno'		=> guvenlik($_POST['email']),
			'srv_eposta'	=> guvenlik($_POST['gsmno']),
			'srv_geltarih'	=> guvenlik($_POST['tarihi']),
			'srv_adres'		=> guvenlik($_POST['mesaj']),
			'srv_mesaj'		=> guvenlik($_POST['mesaj']),
			'sv_ek_tarih'	=> $tarih
			];
			
	$isle = $db->table('dbo_servis_talep')->insert($data);
	
	if(ayar('sms_durumu') == 'Aktif'){
		$sms = new Sms();
		$sms->send(ayar('sms_kadi'),ayar('sms_sifre'),'Yeni bir servis talebi aldınız, lütfen panelinizden kontrol edin.',ayar('sms_bildirim_tel'),ayar('sms_baslik'));
	}
	
	MailGonder('Servis Talebi Aldiniz.','Lütfen web sitemize giriş yaparak yönetim paneli bölümünden talebi inceleyiniz.',ayar('site_mail'));
	
	if($isle){
		echo alert('success','Talebiniz başarılı olarak gönderildi.',$site,3);
	}else{
		echo bilgi('danger','Talebiniz gönderilemedi, lütfen daha sonra tekrar deneyin.');
	}

}}
?>