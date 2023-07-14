<?php
@$menu = 'ana-sayfa'; @$page = 'html-alan';
require_once("header.php");
require_once("menu-left.php");
require_once("../include/class.upload.php");


if(isset($_POST['kaydet']) && admin_login_check($db) == true){

	file_put_contents("../languages/alan.po",$_POST["degiskenler"]);

}
?>
<link rel="stylesheet" type="text/css" href="css/codemirror/codemirror.css" />
<link rel="stylesheet" type="text/css" href="css/codemirror/neat.css" />
<link rel="stylesheet" type="text/css" href="css/codemirror/ambiance.css" />
<link rel="stylesheet" type="text/css" href="css/codemirror/material.css" />
<link rel="stylesheet" type="text/css" href="css/codemirror/neo.css" />


	<div class="page-content">
		<header class="page-content-header">
			<div class="container-fluid">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3><small class="text-muted">HTML Alan</small></h3>
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
        <form id="form_validation" method="POST" action="html-alan.html" enctype="multipart/form-data">
            <!------------------------------------------------------->
            <div class="col-lg-12">
                <section class="card">
                	<div class="card-block">
                     <fieldset class="form-group">
                        <label class="form-label">Alan İçerik</label>
                        <textarea id="code_editor" class="form-control" rows="20" name="degiskenler"><?=@file_get_contents("../languages/alan.po");?></textarea>
                     </fieldset>
                     <div class="alert alert-info">
                      <strong>Dikkat!</strong> Yukarıda ki alanları silmeden yalnızca { } parantez içerisinde bulunan yazıları düzenleyiniz.
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
<script type="text/javascript" src="css/codemirror/codemirror.js"></script>
<script type="text/javascript" src="css/codemirror/matchbrackets.js"></script>
<script type="text/javascript" src="css/codemirror/htmlmixed.js"></script>
<script type="text/javascript" src="css/codemirror/xml.js"></script>
<script type="text/javascript" src="css/codemirror/javascript.js"></script>
<script type="text/javascript" src="css/codemirror/css.js"></script>
<script type="text/javascript" src="css/codemirror/clike.js"></script>
<script type="text/javascript" src="css/codemirror/php.js"></script>
<style>
.CodeMirror {
  height: 500px;
  font-size:16px;
}
</style>
<script type="text/javascript">
var myTextarea = document.getElementById('code_editor');
  var editor = CodeMirror.fromTextArea(myTextarea, {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text",
        indentUnit: 4,
        indentWithTabs: true,
        theme : "material"
  });
</script>
