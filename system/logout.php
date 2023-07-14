<?php
define('INC', true);
require_once("../include/functions.php");

$hata = intval($_GET['Err']);

if($hata == 1){
	sec_session_start();
	// Unset all session values
	$_SESSION = array();
	// get session parameters 
	$params = session_get_cookie_params();
	// Delete the actual cookie.
	setcookie(session_name(), '', time() - 42000, $params["path"], $site, $params["secure"], $params["httponly"]);
	// Destroy session
	session_destroy();
	yonver($site.'/giris/?Err=1');
}
if($hata == 2){
	sec_session_start();
	// Unset all session values
	$_SESSION = array();
	// get session parameters 
	$params = session_get_cookie_params();
	// Delete the actual cookie.
	setcookie(session_name(), '', time() - 42000, $params["path"], $site, $params["secure"], $params["httponly"]);
	// Destroy session
	session_destroy();
	yonver($site.'/giris/?Err=2');
}else{
	sec_session_start();
	// Unset all session values
	$_SESSION = array();
	// get session parameters 
	$params = session_get_cookie_params();
	// Delete the actual cookie.
	setcookie(session_name(), '', time() - 42000, $params["path"], $site, $params["secure"], $params["httponly"]);
	// Destroy session
	session_destroy();
	yonver($site);
}
?>