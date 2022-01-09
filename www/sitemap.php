<?php
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n");
require_once "initd.php";

$data = $objDB -> select("SELECT *, DATE_FORMAT(datePut, '%Y-%m-%d') as formatDate FROM booksList;");
if ($data) {
	foreach ($data as $key => $val) {
		echo("<url>\n");
		echo("<loc>https://t-library.net:8443/showBook.php?id=" . $val['ID'] . "</loc>\n");
		echo("<lastmod>".$val['formatDate']."</lastmod>\n");
		echo("<changefreq>never</changefreq>\n");
		echo("<priority>0.5</priority>\n");
		echo("</url>\n");
	}
}
$data = $objDB->select("SELECT DATE_FORMAT(datePut, '%Y-%m-%d') as nowDate FROM booksList WHERE approved = 'yes' ORDER BY datePut DESC LIMIT 1;");
?>
<url>
    <loc>
        http://t-library.net/
    </loc>
    <lastmod>
        <?php echo($data[0]['nowDate']); ?>
    </lastmod>
    <changefreq>
        daily
    </changefreq>
    <priority>
        0.8
    </priority>
</url>
</urlset>
