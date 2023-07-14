<?php
@$menu = 'yorum-islemleri'; @$page = 'yorum-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid = intval($_GET["sil"]);
		$isle = $db->table('dbo_yorum')->where('YorumID', '=', $silid)->delete();
		
		if($isle || $gonder){
			$bilgi = alert('success','Yorum Silindi','yorum-liste.html',3);
			}else{
			$bilgi = alert('danger','Yorum Silinemedi!','yorum-liste.html',3);
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
							<h3><small class="text-muted">Yorum Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="yorum-ekle.html" class="btn btn-rounded">Yorum Ekle</a>
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
                                <th>Yorumlayan</th>
                                <th>Mesaj</th>
                                <th>Tarih / Saat</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $yorum = $db->table('dbo_yorum as yorum')
										->orderBy('yorum.YorumID', 'desc')
                                        ->getAll();
                            foreach($yorum as $yorumget){
                            ?>
                            <tr>
                                <td><?=$yorumget->yorum_adsoyad?></td>
                                <td><?=kisalt($yorumget->yorum_icerik,50)?></td>
                                <td><?=cevirtarih($yorumget->yorum_tarih)?> <?=$yorumget->yorum_saat?></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="yorum-duzenle.html?id=<?=$yorumget->YorumID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <?php if($yorumget->yorum_durum == 'Pasif'){ ?>
                                <a onclick="return confirm('Onaylamak istediğinizden emin misiniz?')" href="yorum-liste.html?onay=<?=$yorumget->YorumID?>" class="btn btn-success"><i class="font-icon glyphicon glyphicon-ok"></i></a>
                                <?php } ?>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="yorum-liste.html?sil=<?=$yorumget->YorumID?>" class="btn btn-danger"><i class="font-icon glyphicon glyphicon-trash"></i></a>
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