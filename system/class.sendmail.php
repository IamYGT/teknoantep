<?php
set_time_limit(600000);

function MailGonder($konu, $mesaj, $kime){
global $db;

$ayar = $db->table('dbo_siteayar')->select('*')->where('SiteID','=',1)->getRow();
$mailayar = $db->table('dbo_mailayar')->select('*')->where('MayarID','=',1)->getRow();

$site = $ayar->site_http.$ayar->site_www.$ayar->site_url;

if($mailayar->mail_tipi == 'Y'){ include_once 'phpmailerY/PHPMailerAutoload.php'; }else{ include_once 'phpmailerE/class.phpmailer.php'; }
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Port = $mailayar->mail_port;
$mail->Host = $mailayar->mail_host;
$mail->SMTPAuth = true;
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet = "utf-8";
if($mailayar->mail_prosedur != 'standart'){ $mail->SMTPSecure = $mailayar->mail_prosedur; }
$mail->Username = $mailayar->mail_kadi;
$mail->Password = $mailayar->mail_sifre;
$mail->From = $mailayar->mail_kadi;
$mail->FromName = $ayar->firma_title;
$mail->AddAddress($kime);
$gonder->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = '=?UTF-8?B?'.base64_encode($konu).'?=';
$mail->Body    = '
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style type="text/css">
        #outlook a {
            padding: 0;
        }
        
        .ReadMsgBody {
            width: 100%;
        }
        
        .ExternalClass {
            width: 100%;
        }
        
        .ExternalClass * {
            line-height: 100%;
        }
        
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <!--[if !mso]><!-->
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300);
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300" rel="stylesheet" type="text/css">
    <!--<![endif]-->
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100,
            * [aria-labelledby="mj-column-per-100"] {
                width: 100%!important;
            }
        }
    </style>
</head>

<body id="YIELD_MJML" style="background: #eceff4;">
    <div class="mj-body" style="background-color:#eceff4;">
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
      </td></tr></table>
  		<![endif]-->
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;background:#d8e2e7;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;background:#d8e2e7;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
                            <!--[if mso]>
      <table border="0" cellpadding="0" cellspacing="0"><tr><td style="width:700px;">
      <![endif]-->
                            <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;" class="mj-column-per-100" aria-labelledby="mj-column-per-100">
                                <table style="background:white;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-size:0;padding:30px 30px 16px;" align="left">
                                                <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;"><img src="'.$site.'/uploads/genelresim/'.$ayar->site_logo.'"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:0 30px 6px;" align="left">
                                                <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">'.$mesaj.'</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;" align="left"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:0 30px 30px 30px;" align="left">
                                                <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">— Saygılarımızla,
                                                    <br><a href="'.$site.'" style="text-decoration:none; text-decoration:none; color:blue;">'.$site.'</a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--[if mso]>
      </td></tr></table>
      <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
      </td></tr></table>
  		<![endif]-->
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0 0;">
                            <!--[if mso]>
      <table border="0" cellpadding="0" cellspacing="0"><tr><td style="width:700px;">
      <![endif]-->
                            <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;" class="mj-column-per-100" aria-labelledby="mj-column-per-100">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-size:0;padding:0px;" align="center">
                                                <div class="mj-content" style="cursor:auto;color:#6b7a85;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--[if mso]>
      </td></tr></table>
      <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
      </td></tr></table>
  		<![endif]-->
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
  		</td></tr></table>
  		<![endif]-->
    </div>
</body>
</html>';
return $mail->send();
}
/*******************************************************************************************************************/
function TopluMailGonder($konu, $mesaj, $kime){
global $db;

$gidecekler = explode(",",$kime);

$ayar = $db->table('dbo_siteayar')->select('*')->where('SiteID','=',1)->getRow();
$mailayar = $db->table('dbo_mailayar')->select('*')->where('MayarID','=',1)->getRow();

if($mailayar->mail_tipi == 'Y'){ include_once 'phpmailerY/PHPMailerAutoload.php'; }else{ include_once 'phpmailerE/class.phpmailer.php'; }
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Port = $mailayar->mail_port;
$mail->Host = $mailayar->mail_host;
$mail->SMTPAuth = true;
if($mailayar->mail_prosedur != 'standart'){ $mail->SMTPSecure = $mailayar->mail_prosedur; }
$mail->Username = $mailayar->mail_kadi;
$mail->Password = $mailayar->mail_sifre;
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet = 'utf-8';
$mail->From = $mailayar->mail_kadi;
$mail->FromName = $ayar->firma_title;
$i = 0;
foreach($gidecekler as $eposta){
$i = $i+1;
$mail->AddAddress($eposta);
}
$mail->IsHTML(true);
$mail->Subject = '=?UTF-8?B?'.base64_encode($konu).'?=';
$mail->Body    = '
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style type="text/css">
        #outlook a {
            padding: 0;
        }
        
        .ReadMsgBody {
            width: 100%;
        }
        
        .ExternalClass {
            width: 100%;
        }
        
        .ExternalClass * {
            line-height: 100%;
        }
        
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <!--[if !mso]><!-->
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300);
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300" rel="stylesheet" type="text/css">
    <!--<![endif]-->
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100,
            * [aria-labelledby="mj-column-per-100"] {
                width: 100%!important;
            }
        }
    </style>
</head>

<body id="YIELD_MJML" style="background: #eceff4;">
    <div class="mj-body" style="background-color:#eceff4;">
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
      </td></tr></table>
  		<![endif]-->
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;background:#d8e2e7;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;background:#d8e2e7;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
                            <!--[if mso]>
      <table border="0" cellpadding="0" cellspacing="0"><tr><td style="width:700px;">
      <![endif]-->
                            <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;" class="mj-column-per-100" aria-labelledby="mj-column-per-100">
                                <table style="background:white;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-size:0;padding:30px 30px 16px;" align="left">
                                                <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;"><img src="'.$ayar->site_url.'/uploads/genelresim/'.$ayar->site_logo.'"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:0 30px 6px;" align="left">
                                                <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">'.$mesaj.'</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;" align="left"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:0 30px 30px 30px;" align="left">
                                                <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">— Saygılarımızla,
                                                    <br><a href="'.$ayar->site_url.'" style="text-decoration:none; text-decoration:none; color:blue;">'.$ayar->site_url.'</a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--[if mso]>
      </td></tr></table>
      <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
      </td></tr></table>
  		<![endif]-->
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0 0;">
                            <!--[if mso]>
      <table border="0" cellpadding="0" cellspacing="0"><tr><td style="width:700px;">
      <![endif]-->
                            <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;" class="mj-column-per-100" aria-labelledby="mj-column-per-100">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-size:0;padding:0px;" align="center">
                                                <div class="mj-content" style="cursor:auto;color:#6b7a85;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--[if mso]>
      </td></tr></table>
      <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
      </td></tr></table>
  		<![endif]-->
        <!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]-->
        <div style="margin:0 auto;max-width:700px;">
            <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
  		</td></tr></table>
  		<![endif]-->
    </div>
</body>
</html>';
return $mail->send();
$mail->ClearAddresses();
}
/*******************************************************************************************************************/
?>