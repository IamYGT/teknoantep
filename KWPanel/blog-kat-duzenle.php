<?php
@$menu = 'kategori-islemleri'; @$page = 'kategori-liste';
require_once("header.php");
require_once("menu-left.php");

$duzenid = intval($_GET["id"]);
$oku = $db->table('dbo_blog_kat')->where('BlogKatID','=',$duzenid)->getRow();
if(!$oku){
	yonver('blog-kat-liste.html');
	exit();
}

if(isset($_POST['kaydet']) && admin_login_check($db) == true){

$data = [
		'blog_kat_adi'	=> guvenlik($_POST['sc_kat_adi']),
		'blog_kat_meta'	=> guvenlik($_POST['sc_kat_meta']),
		'blog_kat_desc'	=> guvenlik($_POST['sc_kat_desc'])
		];
	
$isle = $db->table('dbo_blog_kat')->where('BlogKatID','=',$oku->BlogKatID)->update($data);

	if($isle){
		$bilgi = alert('success','Kategori Düzenlendi','blog-kat-liste.html',3);
		}else{
		$bilgi = alert('danger','Kategori Düzenlenemedi!','blog-kat-liste.html',3);
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
							<h3><small class="text-muted">Kategori Düzenleme İşlemi</small></h3>
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
        <form id="form_validation" method="POST" action="blog-kat-duzenle.html?id=<?=$oku->BlogKatID?>">
			<div class="col-lg-6">
                <section class="card">
                    <header class="card-header">
                        Kategori Bilgileri
                    </header>
                    <div class="card-block">
                        <fieldset class="form-group">
                            <label class="form-label">Kategori Adı</label>
                            <input type="text" name="sc_kat_adi" value="<?=$oku->blog_kat_adi?>" class="form-control" required>
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
                            <textarea type="text" name="sc_kat_desc" class="form-control" required><?=$oku->blog_kat_desc?></textarea>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label">Kategori Anahtar Kelime (Virgül İle Ayırın)</label>
                            <textarea id="tags-editor-textarea" type="text" name="sc_kat_meta" class="form-control" rows="5" required><?=$oku->blog_kat_meta?></textarea>
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