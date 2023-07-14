<?php
@$menu = 'sayfa-islemleri'; @$page = 'sayfa-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid= intval($_GET["sil"]);
		
		$isle = $db->table('dbo_sayfa')->where('SayfaID', '=', $silid)->delete();
		
			if($isle){
				$bilgi = alert('success','Sayfa Silindi','sayfa-liste.html',3);
				}else{
				$bilgi = alert('success','Sayfa Silinemedi!','sayfa-liste.html',3);
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
							<h3><small class="text-muted">Sayfa Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="sayfa-ekle.html" class="btn btn-rounded">Sayfa Ekle</a>
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
								<th>Sayfa Başlık</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $sayfa = $db->table('dbo_sayfa')
										   ->orderBy('SayfaID', 'desc')
                                           ->getAll();
                            foreach($sayfa as $sayfaget){
							?>
                            <tr>
                                <td><?=kisalt($sayfaget->sayfa_adi,100)?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="sayfa-duzenle.html?id=<?=$sayfaget->SayfaID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="sayfa-liste.html?sil=<?=$sayfaget->SayfaID?>" class="btn btn-danger" title="Sil!"><i class="fa fa-trash-o"></i></a>
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