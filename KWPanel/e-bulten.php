<?php
@$page = 'bulten-mail';
require_once("header.php");
require_once("menu-left.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

	require_once("../system/class.sendmail.php");
	
	if(TopluMailGonder($_POST['konu'],$_POST['mesaj'],$_POST['mailler'])){ 
		$bilgi = alert('success','Mail Gönderildi.','toplu-mail.html',3);
	}else{
		$bilgi = alert('danger','Mail Gönderilemedi!','toplu-mail.html',3);
	}
}
?>
<link rel="stylesheet" href="css/lib/ladda-button/ladda-themeless.min.css">

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">E-Bülten Mail Gönderimi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action" style="display:none;">
							<a href="#" class="btn btn-rounded">Add member</a>
						</div>
					</div>
				</div>
			</div>
		</header><!--.page-content-header-->

		<div class="container-fluid">
        <?=@$bilgi?>
        <form id="form_validation" method="post" action="toplu-mail.html">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        E-Mail Listesi
                    </header>
                    <div class="card-block">
                       <fieldset class="form-group">
                            <?php 
							$ids = array();
							$mail = $db->customQuery("SELECT * FROM dbo_ebulten WHERE BultID")->getAll();
							foreach($mail as $mailget){
								
							$ids[] = $mailget->ebulten_mail;
							}
							?>
							<textarea class="form-control" name="mailler" rows="12"><?php echo implode(",", $ids); ?></textarea>
                       </fieldset>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Mesaj Gönder
                    </header>
                    <div class="card-block">
                    	<fieldset class="form-group">
                            <label class="form-label">Konu</label>
                            <input type="text" class="form-control" name="konu" placeholder="Konu Yazınız" required>
                        </fieldset>
                       <fieldset class="form-group">
                            <textarea class="form-control" rows="8" name="mesaj" placeholder="Mesajınızı Yazın" required></textarea>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-block">
                        <fieldset class="form-group" style="margin-bottom:0px;">
                            <button type="submit" name="kaydet" class="btn btn-inline btn-primary ladda-button" data-style="expand-left" style="float:right;"><span class="ladda-label">Mesaj Gönder</span></button>
                        </fieldset>
                    </div>
                </section>
            </div>
            </form>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
<?php require_once("footer.php"); ?>
<script src="js/lib/ladda-button/spin.min.js"></script>
<script src="js/lib/ladda-button/ladda.min.js"></script>
<script src="js/lib/ladda-button/ladda-button-init.js"></script>