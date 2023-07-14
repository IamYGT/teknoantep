<?php
@$menu = 'slide-islemleri'; @$page = 'slide-liste';
require_once("header.php");
require_once("menu-left.php");

if(isset($_GET["sil"]) && admin_login_check($db) == true){ 
	$silid= intval($_GET["sil"]);
	
		$sql1 = $db->table('dbo_slide')->where('SlideID', '=', $silid)->getAll();
			foreach($sql1 as $sql1resim){
				unlink("../uploads/slider/".$sql1resim->slide_resim);
			}
		
		$isle = $db->table('dbo_slide')->where('SlideID', '=', $silid)->delete();
		
			if($isle){
				$bilgi = alert('success','Slide Silindi','slide-liste.html',3);
				}else{
				$bilgi = alert('success','Slide Silinemedi!','slide-liste.html',3);
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
							<h3><small class="text-muted">Slide Listesi</small></h3>
						</div>
						<div class="tbl-cell tbl-cell-action">
							<a href="slide-ekle.html" class="btn btn-rounded">Slide Ekle</a>
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
								<th>Slide Sıra</th>
                                <th>Slide Resim</th>
                                <th>İşlem</th>
							</tr>
						</thead>                        
                        <tbody>
							<?php
                            $slide = $db->table('dbo_slide')->select('*')->orderBy('slide_sira', 'ASC')->getAll();
                            foreach($slide as $slideget){
							?>
                            <tr>
                                <td><?=$slideget->slide_sira?></td>
                                <td><img src='../thumb.php?src=./uploads/slider/<?=$slideget->slide_resim?>&size=100&crop=0' /></td>
                                <td style="padding:0px;">
                                <center>
                                <a href="slide-duzenle.html?id=<?=$slideget->SlideID?>" class="btn btn-primary" title="Düzenle"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Silmek istediğinizden emin misiniz?')" href="slide-liste.html?sil=<?=$slideget->SlideID?>" class="btn btn-danger" title="Sil!"><i class="fa fa-trash-o"></i></a>
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