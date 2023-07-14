<!--Start footer area-->  
<footer class="footer-area style2">
    <div class="container">
        <div class="row">
            <!--Start single footer widget-->
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                <div class="single-footer-widget marbtm50">
                    <div class="title">
                        <h3>İletişim Bilgileri</h3>
                    </div>
                    <div class="state-select-box">
                        <div class="state-content">
							<div class="state" id="value1">
								<ul>
									<li>
									    <div class="icon">
									        <span class="flaticon-global"></span>
									    </div>
									    <div class="text">
									        <p><?=ayar('site_adres')?></p>
									    </div>
									</li>
									<li class="inline">
									    <div class="icon">
									        <span class="flaticon-phone"></span>
									    </div>
									    <div class="text">
									        <p><?=ayar('site_telefon')?></p>
									    </div>
									</li>
									<li class="inline last">
									    <div class="icon">
									        <span class="flaticon-mail"></span>
									    </div>
									    <div class="text">
									        <p><?=ayar('site_mail')?></p>
									    </div>
									</li>
									<li>
									    <div class="icon">
									        <span class="flaticon-clock"></span>
									    </div>
									    <div class="text">
									        <p><?=ayar('calisma_saat')?></p>
									    </div>
									</li>
								</ul>
							</div>
						</div>   
                    </div>
                    <div class="map-find">
                        <a class="btn-two" href="iletisim/">İletişim Sayfası<span class="flaticon-next"></span></a>
                    </div>
                </div>
            </div>
            <!--End single footer widget-->
            <!--Start single footer widget-->
            <div class="col-md-7">
                <div class="single-footer-widget margin-left">
                    <div class="title">
                        <h3>Site Bağlantılar</h3>
                    </div>
                    <ul class="quick-links">
                        <?php
						$footlink = $db->table('dbo_footer_link')
									   ->orderBy('fo_adi','asc')
									   ->getAll();
						foreach($footlink as $liste){
						?>
                        <div class="col-md-4" style="float:left;"><a href="<?=$liste->fo_link?>" style="color: #8ca4c2;"><i class="fa fa-caret-right" aria-hidden="true"></i> <?=$liste->fo_adi?></a></div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!--End single footer widget-->
        </div>
    </div>
</footer>   
<!--End footer area-->

</div>  

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target thm-bg-clr" data-target="html"><span class="fa fa-angle-up"></span></div>

<!-- main jQuery -->
<script src="js/jquery.js"></script>
<!-- Wow Script -->
<script src="js/wow.min.js"></script>
<!-- bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- bx slider -->
<script src="js/jquery.bxslider.min.js"></script>
<!-- count to -->
<script src="js/jquery.countTo.js"></script>
<script src="js/jquery.appear.js"></script>
<!-- owl carousel -->
<script src="js/owl.js"></script>
<!-- validate -->
<script src="js/validation.js"></script>
<!-- mixit up -->
<script src="js/jquery.mixitup.min.js"></script>
<!-- isotope script-->
<script src="js/isotope.js"></script>
<!-- Easing -->
<script src="js/jquery.easing.min.js"></script>
<!-- Gmap helper -->
<script src="js/gmaps.js"></script>
<script src="js/map-helper.js"></script>
<!-- jQuery ui js -->
<script src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>
<!-- Language Switche  -->
<script src="assets/language-switcher/jquery.polyglot.language.switcher.js"></script>
<!-- jQuery timepicker js -->
<script src="assets/timepicker/timePicker.js"></script>
<!-- Bootstrap select picker js -->
<script src="assets/bootstrap-sl-1.12.1/bootstrap-select.js"></script> 
<!-- html5lightbox js -->                              
<script src="assets/html5lightbox/html5lightbox.js"></script>
<!--Color Switcher-->
<script src="js/color-settings.js"></script>

<!--Revolution Slider-->
<script src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="js/main-slider-script.js"></script>

<!-- thm custom script -->
<script src="js/custom.js"></script>
</body>
</html>