	<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <ul class="side-menu-list">
	        <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($page == 'panelim'){ echo 'opened';}?> blue">
            	<a href="panelim.html">
	            <span>
	                <i class="fa fa-dashboard"></i>
	                <span class="lbl">Panelim</span>
	            </span>
                </a>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($page == 'guvenlik'){ echo 'opened';}?> blue">
            	<a href="guvenlik-liste.html">
	            <span>
	                <i class="fa fa-shield" aria-hidden="true"></i>
	                <span class="lbl">Güvenlik Yönetimi <span class="label label-custom label-pill label-danger" style="float:right; margin-right:15px;"><?=GuvenlikSay()?></span></span>
	            </span>
                </a>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($page == 'servis'){ echo 'opened';}?> blue">
            	<a href="servis-liste.html">
	            <span>
	                <i class="fa fa-wrench" aria-hidden="true"></i>
	                <span class="lbl">Servis Talepleri <span class="label label-custom label-pill label-danger" style="float:right; margin-right:15px;"><?=TalepSay(0)?></span></span>
	            </span>
                </a>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'menu-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-sitemap"></i>
	                <span class="lbl">Menü İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'menu-ekle'){ echo 'class="aktif"';}?>><a href="menu-ekle.html"><span class="lbl">Menü Ekle</span></a></li>
                    <li <?php if($page == 'menu-liste'){ echo 'class="aktif"';}?>><a href="menu-liste.html"><span class="lbl">Menü (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'yorum-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-comments"></i>
	                <span class="lbl">Yorum İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'yorum-ekle'){ echo 'class="aktif"';}?>><a href="yorum-ekle.html"><span class="lbl">Yorum Ekle</span></a></li>
	                <li <?php if($page == 'yorum-liste'){ echo 'class="aktif"';}?>><a href="yorum-liste.html"><span class="lbl">Yorum Liste (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'referans-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-copyright"></i>
	                <span class="lbl">Referans İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'referans-ekle'){ echo 'class="aktif"';}?>><a href="referans-ekle.html"><span class="lbl">Referans Ekle</span></a></li>
	                <li <?php if($page == 'referans-liste'){ echo 'class="aktif"';}?>><a href="referans-liste.html"><span class="lbl">Referans Liste (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'blog-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-newspaper-o"></i>
	                <span class="lbl">Haber İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'blog-ekle'){ echo 'class="aktif"';}?>><a href="blog-ekle.html"><span class="lbl">Haber Ekle</span></a></li>
	                <li <?php if($page == 'blog-liste'){ echo 'class="aktif"';}?>><a href="blog-liste.html"><span class="lbl">Haber Liste (Düzen/Sil)</span></a></li>
                    <li <?php if($page == 'blog-kat-liste'){ echo 'class="aktif"';}?>><a href="blog-kat-liste.html"><span class="lbl">Haber Kat. (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'sayfa-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-file"></i>
	                <span class="lbl">Sayfa İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'sayfa-ekle'){ echo 'class="aktif"';}?>><a href="sayfa-ekle.html"><span class="lbl">Sayfa Ekle</span></a></li>
	                <li <?php if($page == 'sayfa-liste'){ echo 'class="aktif"';}?>><a href="sayfa-liste.html"><span class="lbl">Sayfa Liste (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'galeri-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-picture-o"></i>
	                <span class="lbl">Galeri İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'resim-galeri'){ echo 'class="aktif"';}?>><a href="resim-galeri.html"><span class="lbl">Resim Galeri</span></a></li>
                    <li <?php if($page == 'resim-kat'){ echo 'class="aktif"';}?>><a href="resim-galeri-kat.html"><span class="lbl">Resim Galeri Kategori</span></a></li>
	                <li <?php if($page == 'video-galeri'){ echo 'class="aktif"';}?>><a href="video-galeri.html"><span class="lbl">Video Galeri</span></a></li>
                    <li <?php if($page == 'video-kat'){ echo 'class="aktif"';}?>><a href="video-galeri-kat.html"><span class="lbl">Video Galeri Kategori</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'sss-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-comment"></i>
	                <span class="lbl">S.S.S İşlemleri</span>
	            </span>
	            <ul>
	                <li <?php if($page == 'sss-ekle'){ echo 'class="aktif"';}?>><a href="sss-ekle.html"><span class="lbl">SSS Ekle</span></a></li>
	                <li <?php if($page == 'sss-liste'){ echo 'class="aktif"';}?>><a href="sss-liste.html"><span class="lbl">SSS Liste (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'slide-islemleri'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-picture-o"></i>
	                <span class="lbl">Slide İşlemleri</span>
	            </span>
	            <ul>
                	<li <?php if($page == 'slide-ekle'){ echo 'class="aktif"';}?>><a href="slide-ekle.html"><span class="lbl">Slide Ekle</span></a></li>
	                <li <?php if($page == 'slide-liste'){ echo 'class="aktif"';}?>><a href="slide-liste.html"><span class="lbl">Slide Liste (Düzen/Sil)</span></a></li>
	            </ul>
	        </li>
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($menu == 'ana-sayfa'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-television" aria-hidden="true"></i>
	                <span class="lbl">Ana Sayfa Ayarları</span>
	            </span>
	            <ul>
                	<li <?php if($page == 'html-alan'){ echo 'class="aktif"';}?>><a href="html-alan.html"><span class="lbl">Yazı Alanları</span></a></li>
                    <li <?php if($page == 'hizmet-liste'){ echo 'class="aktif"';}?>><a href="hizmet-liste.html"><span class="lbl">Hizmet Yönetimi</span></a></li>
                    <li <?php if($page == 'footer-liste'){ echo 'class="aktif"';}?>><a href="footer-liste.html"><span class="lbl">Footer Linkleri</span></a></li>
	            </ul>
	        </li>
			<!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <li class="<?php if($page == 'bulten-mail'){ echo 'opened';}?> blue">
            	<a href="e-bulten.html">
	            <span>
	                <i class="fa fa-envelope" aria-hidden="true"></i>
	                <span class="lbl">E-Bülten Listesi</span>
	            </span>
                </a>
	        </li>
			<!-------------------------------------------------------------------------------------------------------------------------------------------------->
			<li class="<?php if($menu == 'genel-ayarlar'){ echo 'opened';}?> blue with-sub">
	            <span>
	                <i class="fa fa-cogs"></i>
	                <span class="lbl">Site Ayarları</span>
	            </span>
	            <ul>
                	<li <?php if($page == 'mail-ayarlar'){ echo 'class="aktif"';}?>><a href="mail-ayarlar.html"><span class="lbl">Mail Ayarları</span></a></li>
                    <li <?php if($page == 'banka-ayarlari'){ echo 'class="aktif"';}?>><a href="banka-ayarlari.html"><span class="lbl">Banka Tanımları</span></a></li>
                    <li <?php if($page == 'sozlesme-ayarlari'){ echo 'class="aktif"';}?>><a href="sozlesme-ayarlari.html"><span class="lbl">Sözleşme Tanımları</span></a></li>
                    <li <?php if($page == 'diger-ayarlar'){ echo 'class="aktif"';}?>><a href="diger-ayarlar.html"><span class="lbl">Yapısal Tanımlar</span></a></li>
                    <li <?php if($page == 'sms-ayarlar'){ echo 'class="aktif"';}?>><a href="sms-ayarlar.html"><span class="lbl">SMS Ayarları</span></a></li>
                    <li <?php if($page == 'sosyal-ayarlar'){ echo 'class="aktif"';}?>><a href="sosyal-ayarlar.html"><span class="lbl">Sosyal Medya Ayarları</span></a></li>
                    <li <?php if($page == 'site-ayarlar'){ echo 'class="aktif"';}?>><a href="site-ayarlar.html"><span class="lbl">Site Genel Ayarları</span></a></li>
	            </ul>
	        </li>
			<!-------------------------------------------------------------------------------------------------------------------------------------------------->
	    </ul>
	
	    <section>
	        <header class="side-menu-title">Diğer İşlemler</header>
	        <ul class="side-menu-list">
	            <li <?php if($page == 'yonetici-ayarlar'){ echo 'class="aktif"';}?>>
	                <a href="yonetici-liste.html">
	                    <i class="tag-color green"></i>
	                    <span class="lbl">Yönetici İşlemleri</span>
	                </a>
	            </li>
	            <li <?php if($page == 'mesaj-liste'){ echo 'class="aktif"';}?>>
	                <a href="mesaj-liste.html">
	                    <i class="tag-color grey-blue"></i>
	                    <span class="lbl">Gelen Mesajlar <span class="label label-custom label-pill label-danger" style="float:right; margin-right:15px;"><?=MesajSay(0);?></span></span>
	                </a>
	            </li>
	            <li <?php if($page == 'site-ayarlar'){ echo 'class="aktif"';}?>>
	                <a href="site-ayarlar.html">
	                    <i class="tag-color red"></i>
	                    <span class="lbl">Genel Ayarlar</span>
	                </a>
	            </li>
	        </ul>
	    </section>
	</nav><!--.side-menu-->