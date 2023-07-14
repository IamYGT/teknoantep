<?php
@$menu = 'sss-islemleri'; @$page = 'sss-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid= intval($_GET["sil"]);
		
		$isle = $db->table('dbo_sss')->where('SssID', '=', $silid)->delete();
		
			if($isle){
				$bilgi = alert('success','SSS Silindi','sss-liste.html',3);
				}else{
				$bilgi = alert('success','SSS Silinemedi!','sss-liste.html',3);
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
							<h3><small class="text-muted">Sıkça Sorulan Sorular</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="sss-ekle.html" class="btn btn-rounded">SSS Ekle</a>
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
                            	<th>Sıra</th>
								<th>Soru</th>
                                <th>Cevap</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $sss = $db->table('dbo_sss')
                                      ->select('*')
									  ->orderBy('sira', 'asc')
                                      ->getAll();
                            foreach($sss as $sssget){
							?>
                            <tr>
                                <td><?=$sssget->sira?></td>
                                <td><?=kisalt($sssget->soru,100)?></td>
                                <td><?=strip_tags(kisalt($sssget->cevap,100))?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="sss-duzenle.html?id=<?=$sssget->SssID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="sss-liste.html?sil=<?=$sssget->SssID?>" class="btn btn-danger" title="Sil!"><i class="fa fa-trash-o"></i></a>
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