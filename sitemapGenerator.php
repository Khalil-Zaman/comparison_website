<?php
require("Incs/connect.inc.php");
require("Incs/core.inc.php");
$txt = 
'<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://www.whichtopick.com/index.php</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/search.php</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/loginform.php?prev_page=index.php-finish</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/games.php</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/laptops.php</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/phones.php</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/Add_item.php?=games-c</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/Add_item.php?=laptops-c</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/Add_item.php?=phones-c</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/create.php?cat=games-c</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/create.php?cat=laptops-c</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/create.php?cat=phones-c</loc>
	</url>
';
$query = "SELECT `category`,`pageURL` FROM `compare` WHERE 1";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while($query_row = mysql_fetch_assoc($query_run)){
	$txt .=
"	<url>
		<loc>http://www.whichtopick.com/compare.php?".$query_row['category']."-c".htmlentities($query_row["pageURL"])."-gc</loc>
	</url>
";
}


$query = "SELECT * FROM ( 
		SELECT `id`,`category` FROM `games` WHERE `verified`='1' UNION
		SELECT `id`,`category` FROM `laptops` WHERE `verified`='1' UNION
		SELECT `id`,`category` FROM `phones` WHERE `verified`='1') 
		AS search";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
while($query_row = mysql_fetch_assoc($query_run)){
	$txt .=
"	<url>
		<loc>http://www.whichtopick.com/details_info.php?=".$query_row['category']."-".$query_row["id"]."-c</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/details_info.php?=".$query_row['category']."-".$query_row["id"]."-c-buy</loc>
	</url>
	<url>
		<loc>http://www.whichtopick.com/details_info.php?=".$query_row['category']."-".$query_row["id"]."-c-review</loc>
	</url>
";
}

$txt .= 
"
</urlset>";
$myfile = fopen("sitemap.xml", "w");
fwrite($myfile, $txt);
fclose($myfile);
?>