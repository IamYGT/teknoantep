<?php
//LOGIN
function admin_login($email, $password, $db) {
   global $db;
   
   if($stmt = $db->table('dbo_yonetici')->select('YonID,kullaniciadi,sifresi')->where('kullaniciadi', '=', $email)->where('sifresi', '=', $password)->getAll()) {

      if($db->numRows() == 1) {
		  
		  $kontrol = $db->table('dbo_yonetici')->select('YonID,kullaniciadi,sifresi')
		  									   ->where('kullaniciadi', '=', $email)
											   ->where('sifresi', '=', $password)
											   ->getRow();
		  
		  if($kontrol->sifresi == $password) {

               $ip_address = $_SERVER['REMOTE_ADDR'];
               $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
               $admin_id = preg_replace("/[^0-9]+/", "", $kontrol->YonID); // XSS
               $_SESSION['admin_id'] = $admin_id; 
               $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $kontrol->kullaniciadi); // XSS
               $_SESSION['username'] = $username;
               $_SESSION['login_string'] = hash('sha512', $password.$ip_address.$user_browser);
			   
			   $now = time();
			   $data = ['ipadres' => $_SERVER['REMOTE_ADDR'],'email' => $email,'time' => $now,'type' => 'Admin'];
			   $db->table('dbo_login_attemps')->insert($data);
			   
			   $updt = ['token' => $_SESSION['login_string']];
			   $db->table('dbo_yonetici')->where('YonID', '=', $admin_id)->update($updt);
               // Login ok.
               return true;    
         }else{
            return false;
         }
      }else{
         return false;
      }
   }
}
/**********************************************************************************************/
//LOGIN CHECK
function admin_login_check($db) {
	global $db;
   // session vari
   if(isset($_SESSION['admin_id'], $_SESSION['username'], $_SESSION['login_string'])) {
     $admin_id = $_SESSION['admin_id'];
     $login_string = $_SESSION['login_string'];
     $username = $_SESSION['username'];
     $ip_address = $_SERVER['REMOTE_ADDR']; // IP
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // user-agent
 
     if ($stmt = $db->table('dbo_yonetici')->select('YonID,kullaniciadi,sifresi')->where('YonID', '=', $admin_id)->getAll()) {

        if($db->numRows() == 1) { // If the user exists
		
		   $kontrol = $db->table('dbo_yonetici')->select('YonID,kullaniciadi,sifresi')->where('YonID', '=', $admin_id)->getRow();

		   $password = $kontrol->sifresi;
		   
           $login_check = hash('sha512', $password.$ip_address.$user_browser);
           if($login_check == $login_string) {
              // Logged In!!!!
              return true;
           } else {
              // Not logged in
              return false;
           }
        } else {
            // Not logged in
            return false;
        }
     } else {
        // Not logged in
        return false;
     }
   } else {
     // Not logged in
     return false;
   }
}
/**********************************************************************************************/
function process($command,$page) {
	global $db;
	$explode = explode("**",$command);
	for ($i = 0; $i <= count($explode)-1; $i++) {
	$sql_query[$i] = $db->customQuery($explode[$i]);
	if($sql_query[$i]){
	$sql_response[$i] = 1;
	}else{
	$sql_response[$i] = 0;
}}}
/**********************************************************************************************/
function admin_bilgi($bilgi,$id) {
	global $db;
	$sor = $db->table('dbo_yonetici')->select($bilgi)->where('YonID','=',$id)->limit(1)->getRow();
	return $sor->$bilgi;
}
/*********************************************************************************************/
function MesajSay(){
	global $db;
	$db->table('dbo_iletisim')->select('*')->where('iletisim_okundumu','=',0)->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
function GuvenlikSay(){
	global $db;
	$db->table('dbo_ban_ip')->select('*')->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
function TalepSay($durum){
	global $db;
	$db->table('dbo_servis_talep')->where('srv_goruldu','=',$durum)->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
function SayfaSay(){
	global $db;
	$db->table('dbo_sayfa')->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
function HaberSay(){
	global $db;
	$db->table('dbo_blog')->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
function ResimSay(){
	global $db;
	$db->table('dbo_resim_galeri')->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
function VideoSay(){
	global $db;
	$db->table('dbo_video_galeri')->getAll();
	return $db->numRows();
}
/*********************************************************************************************/
