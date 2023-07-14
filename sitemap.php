<?php 
define('INC', true);
require_once("include/functions.php");

header('Content-type: text/xml'); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
echo '  <url>
       <loc>'.$site.'</loc>
       <lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>
    <url>
       <loc>'.$site.'/resim-galeri/</loc>
       <lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>
    <url>
       <loc>'.$site.'/video-galeri/</loc>
       <lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>
  <url>
       <loc>'.$site.'/haberler/</loc>
       <lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>
  <url>
       <loc>'.$site.'/sss/</loc>
       <lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>
    <url>
       <loc>'.$site.'/iletisim/</loc>
       <lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>
 
  ';

$sayfa = $db->table('dbo_sayfa')->orderBy('SayfaID','desc')->getAll();
foreach($sayfa as $sayfaget){     
echo "
   <url>
       <loc>".$site."/sayfa/".$sayfaget->SayfaID.'/'.seo($sayfaget->sayfa_adi)."/</loc>
       <lastmod>".date("Y")."-".date("m")."-".date("d")."T".date("H:i:s")."+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>";
    }
	
$blog = $db->table('dbo_blog')->orderBy('BlogID','desc')->getAll();
foreach($blog as $blogget){     
echo "
   <url>
       <loc>".$site."/haber-detay/".$blogget->BlogID.'/'.seo($blogget->blog_baslik)."/</loc>
       <lastmod>".date("Y")."-".date("m")."-".date("d")."T".date("H:i:s")."+00:00</lastmod>
       <changefreq>daily</changefreq>
       <priority>0.5000</priority>
  </url>";
    }
echo "</urlset>";
?>