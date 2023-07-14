<?php
@$menu = 'referans-islemleri'; @$page = 'referans-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid = intval($_GET["sil"]);
		$isle = $db->table('dbo_referans')->where('RefID', '=', $silid)->delete();
		
		if($isle || $gonder){
			$bilgi = alert('success','Referans Silindi','referans-liste.html',3);
			}else{
			$bilgi = alert('danger','Referans Silinemedi!','referans-liste.html',3);
		}
}
?>
<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">Referans Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="referans-ekle.html" class="btn btn-rounded">Referans Ekle</a>
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
                                <th>Logo</th>
                                <th>Ref. Adı</th>
                                <th>Tarih</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $ref = $db->table('dbo_referans')
									  ->orderBy('RefID', 'desc')
                                      ->getAll();
                            foreach($ref as $refget){
                            ?>
                            <tr>
                                <td><img src='../thumb.php?src=./uploads/referans/<?=$refget->ref_logo?>&size=100&crop=0' /></td>
                                <td><?=$refget->ref_adi?></td>
                                <td><?=cevirtarih($refget->ref_tarih)?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="referans-duzenle.html?id=<?=$refget->RefID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="referans-liste.html?sil=<?=$refget->RefID?>" class="btn btn-danger"><i class="font-icon glyphicon glyphicon-trash"></i></a>
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