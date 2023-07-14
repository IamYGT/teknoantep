<?php
define('INC', true);
require_once("../include/functions.php");
$urlim = ayar('site_http').ayar('site_www').ayar('site_url');
// A list of permitted file extensions
if (!empty($_FILES)) {
require('../include/class.upload.php');
$image = new upload($_FILES["file"]);
   if ( $image->uploaded ) {
$image->file_new_name_body = sha1(md5(date("1YmdHis")));
$image->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
$image->mime_check = true;
$image->no_script = true;
$image->Process('../uploads/genelresim/');

if($image->processed){
	$tmp =  $urlim.'/uploads/genelresim/'.$image->file_dst_name;
	echo $urlim.'/uploads/genelresim/'.$image->file_dst_name;
}
	
}} //if image uploaded