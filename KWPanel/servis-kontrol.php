<?php
@$page = 'servis';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_servis_talep')->where('SrvTlpID','=',$duzenid)->getRow();
if(!$oku){
	yonver('servis-liste.html');
	exit();
}

$okundu = [ 'srv_goruldu' => 1 ];
$okundu = $db->table('dbo_servis_talep')->where('SrvTlpID','=',$oku->SrvTlpID)->update($okundu);


if(isset($_POST['kaydet']) && admin_login_check($db) == true){

	require_once("../system/class.sendmail.php");
	
	if(Mailgonder($_POST['konu'],$_POST['mesaj'],$oku->srv_eposta)){ 
		$bilgi = alert('success','Mail Gönderildi.','servis-liste.html',3);
	}else{
		$bilgi = alert('danger','Mail Gönderilemedi!','servis-liste.html',3);
	}
}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Servis Talebi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action" style="display:none;">
							<a href="#" class="btn btn-rounded">Add member</a>
						</div>
					</div>
				</div>
			</div>
		</header><!--.page-content-header-->

		<div class="container-fluid">
        <?=$bilgi?>
        <form id="form_validation" method="post" action="servis-kontrol.html?id=<?=$oku->SrvTlpID?>">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Talep Bilgileri
                    </header>
                    <div class="card-block">
                        <div class="row">
                        	<div class="col-md-4">
                            	<fieldset class="form-group">
                                    <label class="form-label">Gönderen</label>
                                    <input type="text" class="form-control" value="<?=$oku->srv_adsoyad?>" readonly>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                            	<fieldset class="form-group">
                                    <label class="form-label">Gönderen E-Mail</label>
                                    <input type="text" class="form-control" value="<?=$oku->srv_eposta?>" readonly>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                            	<fieldset class="form-group">
                                    <label class="form-label">Gönderen GSM</label>
                                    <input type="text" class="form-control" value="<?=$oku->srv_gsmno?>" readonly>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                            	<fieldset class="form-group">
                                    <label class="form-label">Servis İstenen Tarih</label>
                                    <input type="text" class="form-control" value="<?=$oku->srv_geltarih?>" readonly>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                            	<fieldset class="form-group">
                                    <label class="form-label">Talep Gönderim Tarih</label>
                                    <input type="text" class="form-control" value="<?=cevirtarih($oku->sv_ek_tarih)?>" readonly>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                            	<fieldset class="form-group">
                                    <label class="form-label">Adres Bilgileri</label>
                                    <textarea class="form-control" rows="3" readonly><?=$oku->srv_adres?></textarea>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                            	<fieldset class="form-group">
                                    <label class="form-label">Mesaj</label>
                                    <textarea class="form-control" rows="4" readonly><?=$oku->srv_mesaj?></textarea>
                                </fieldset>
                            </div>
                        </div>
                        
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-6">
                <section class="card">
                	<header class="card-header">
                        Diğer Bilgiler
                    </header>
                    <div class="card-block">
                        <li style="padding-bottom:10px;">Direkt olarak aşağıdaki form aracığı ile göndericiyi yanıtlayabilirsiniz.</li>
                        <li style="padding-bottom:10px;">Mesajı gönderen kişinin aktif kullanılan bir mail adresi olması gerekmektedir.</li>
                        <hr style="margin:0px; padding-bottom:15px;">
                        <fieldset class="form-group">
                            <label class="form-label">Konu</label>
                            <input type="text" class="form-control" name="konu" placeholder="Konu Yazınız" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Mesaj</label>
                            <textarea class="form-control" rows="10" name="mesaj" placeholder="Mesajınızı Yazın" required></textarea>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-block">
                        <fieldset class="form-group" style="margin-bottom:0px;">
                            <button type="submit" name="kaydet" class="btn" style="float:right;"><i class="fa fa-envelope"></i> Yanıt Gönder</button>
                        </fieldset>
                    </div>
                </section>
            </div>
            </form>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
<?php require_once("footer.php"); ?>
<script src="js/jquery.validate.js"></script>
<script src="js/form-validation.js"></script>