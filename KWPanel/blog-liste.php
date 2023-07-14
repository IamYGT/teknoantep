<?php
@$menu = 'blog-islemleri'; @$page = 'blog-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid= intval($_GET["sil"]);
		
		$sql1 = $db->table('dbo_blog')->where('BlogID', '=', $silid)->getAll();
			foreach($sql1 as $sql1resim){
				unlink("../uploads/blog/".$sql1resim->blog_resim);
				unlink("../uploads/blog/".$sql1resim->blog_thumb);
			}
		
		$isle = $db->table('dbo_blog')->where('BlogID', '=', $silid)->delete();
		
			if($isle){
				$bilgi = alert('success','Blog Silindi','blog-liste.html',3);
				}else{
				$bilgi = alert('success','Blog Silinemedi!','blog-liste.html',3);
			}
}
/********************************************************************************************************/
?>
<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Blog Yazıları</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="blog-ekle.html" class="btn btn-rounded">Blog Ekle</a>
						</div>
					</div>
				</div>
			</div>
		</header><!--.page-content-header-->

		<div class="container-fluid">
			<section class="card">
                <div class="card-block">
                <?=@$bilgi?>
                    <table id="table"
						   data-show-columns="false"
						   data-search="true"
						   data-pagination="true"
						   data-toolbar="#toolbar">
						<thead>
							<tr>
								<th>Blog Başlık</th>
                                <th>Tarihi</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $haber = $db->table('dbo_blog')
										   ->orderBy('BlogID', 'desc')
                                           ->getAll();
                            foreach($haber as $haberget){
							?>
                            <tr>
                                <td><?=$haberget->blog_baslik?></td>
                                <td><?=cevirtarih($haberget->blog_tarih)?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="blog-duzenle.html?id=<?=$haberget->BlogID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="blog-liste.html?sil=<?=$haberget->BlogID?>" class="btn btn-danger" title="Sil!"><i class="fa fa-trash-o"></i></a>
                                </center>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
					</table>
                </div>
            </section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
<?php require_once("footer.php"); ?>
<script src="js/lib/bootstrap-table/bootstrap-table.js"></script>
<script src="js/lib/bootstrap-table/jquery-ui.js"></script>
<script src="js/lib/bootstrap-table/bootstrap-table-reorder-columns.min.js"></script>
<script src="js/lib/bootstrap-table/bootstrap-table-reorder-columns-init.js"></script>