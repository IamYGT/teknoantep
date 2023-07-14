<?php
define('INC', true);
require_once("../../include/functions.php");
require_once("../../system/class-admin.php");

sec_session_start(); // Our custom secure way of starting a PHP session.
 
    $email = addslashes(strip_tags(($_POST['email'])));
    $password = addslashes(strip_tags(sha1(sha1(sha1($_POST['password']))))); // The hashed password.
    
    if (admin_login($email, $password, $db) == true) {
        // Login success
		echo '<div class="alert alert-success">
				<strong>Başarılı</strong> Lütfen bekleyin.
			  </div>
			  <meta http-equiv="refresh" content="3;URL=panelim.html" />';
        exit();
    } else {
        // Login failed 
        echo '<div class="alert alert-danger">
				<strong>Hata!</strong> Girdiğiniz bilgiler geçersiz.
			  </div>';
        exit();
    }
?>