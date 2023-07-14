<?php
@$menu = 'galeri-islemleri'; @$page = 'video-kat';
require_once("header.php");
require_once("menu-left.php");

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [
    'vid_kat_adi'	=> guvenlik($_POST['sc_kat_adi']),
	'vid_kat_meta'	=> guvenlik($_POST['sc_kat_meta']),
	'vid_kat_desc'	=> guvenlik($_POST['sc_kat_desc'])
	];
	
$isle = $db->table('dbo_video_galeri_kat')->insert($data);

	if($isle){
		$bilgi = alert('success','Kategori Eklendi','video-galeri-kat.html',3);
		}else{
		$bilgi = alert('danger','Kategori Eklenemedi!','video-galeri-kat.html',3);
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
							<h3><small class="text-muted">Video Kategori Ekleme İşlemi</small></h3>
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
        <form id="form_validation" method="POST" action="video-galeri-kat-ekle.html" enctype="multipart/form-data">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Kategori Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Kategori Adı</label>
                            <input type="text" name="sc_kat_adi" class="form-control" required>
                        </fieldset>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="card">
                	<header class="card-header">
                        SEO Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Kategori Kısa Açıklama (Max 255 karakter)</label>
                            <textarea type="text" name="sc_kat_desc" class="form-control" required></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Kategori Anahtar Kelime (Virgül İle Ayırın)</label>
                            <textarea id="tags-editor-textarea" type="text" name="sc_kat_meta" class="form-control" rows="5" required></textarea>
                        </fieldset>
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
<script type='text/javascript' src="js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('#tags-editor-textarea').tagEditor();
	});
</script>