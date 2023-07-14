<?php
@$menu = 'yorum-islemleri'; @$page = 'yorum-ekle';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_yorum')->where('YorumID','=',$duzenid)->getRow();
if(!$oku){
	yonver('yorum-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){
	
$data = [
    	'yorum_icerik'	=> guvenlik($_POST['aciklama']),
		'yorum_tarih'	=> $tarih,
		'yorum_saat'	=> $saat,
		'yorum_adsoyad'	=> guvenlik($_POST['kimden']),
		'yorum_durum'	=> 'Aktif'
		];
	
$isle = $db->table('dbo_yorum')->where('YorumID','=',$oku->YorumID)->update($data);

	if($isle || $gonder){
		$bilgi = alert('success','Yorum Düzenlendi','yorum-liste.html',3);
		}else{
		$bilgi = alert('danger','Yorum Düzenlenemedi!','yorum-liste.html',3);
	}

}
?>

	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Yorum Düzenleme İşlemi</small></h3>
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
        <form id="form_validation" method="POST" action="yorum-duzenle.html?id=<?=$oku->YorumID?>" enctype="multipart/form-data">
			<div class="col-lg-12">
                <section class="card">
                    <header class="card-header">
                        Yorum Bilgileri
                    </header>
                    <div class="card-block">
                            
                            <div class="row">
                            
                            <div class="col-md-12">
                            <fieldset class="form-group">
                                <label class="form-label">Yorumlayan (Ad & Soyad)</label>
                                <input type="text" name="kimden" value="<?=$oku->yorum_adsoyad?>" class="form-control">
                            </fieldset>
                            </div>
                            
                          
                           <div class="col-md-12">
                           <fieldset class="form-group">
                        	  <label class="form-label">Açıklama</label>
                              <textarea class="form-control" name="aciklama" rows="6" required><?=$oku->yorum_icerik?></textarea>
                           </fieldset>
                           </div>
                           </div>
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