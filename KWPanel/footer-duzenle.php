<?php
@$menu = 'ana-sayfa'; @$page = 'footer-liste';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_footer_link')
		  ->where('FoLinkID','=',$duzenid)
		  ->getRow();
if(!$oku){
	yonver('footer-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){
	
$data = [ 
		'fo_adi'	=> guvenlik($_POST['fo_adi']), 
		'fo_link'	=> guvenlik($_POST['fo_link'])
		];
		
$isle = $db->table('dbo_footer_link')->where('FoLinkID','=',$oku->BlogID)->update($data);

	if($isle){
		$bilgi = alert('success','Link Eklendi','footer-liste.html',3);
		}else{
		$bilgi = alert('danger','Link Eklenemedi!','footer-liste.html',3);
	}

}
?>
<link href="css/separate/vendor/tags_editor.min.css" rel='stylesheet' type='text/css'>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Link Düzenle</small></h3>
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
        <form id="form_validation" method="POST" action="footer-duzenle.html?id=<?=$oku->FoLinkID?>" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Link Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Link Adı</label>
                            <input type="text" name="fo_adi" value="<?=$oku->fo_adi?>" class="form-control" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Link URL</label>
                            <input type="text" name="fo_link" value="<?=$oku->fo_link?>" class="form-control" required>
                        </fieldset>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Bilgiler
                    </header>
                    <div class="card-block">
                        <li>Lütfen sitenizi spama sokmamak için çok fazla link çıkışı yapmayınız.</li>
                    </div>
                </section>
            </div>
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-block">
                        <fieldset class="form-group" style="margin-bottom:0px;">
                            <button type="submit" name="kaydet" class="btn">Bilgileri Kaydet</button>
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