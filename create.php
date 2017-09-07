<!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
<title>
WhichToPick: Create A New Comparison	
</title>
</head>
<body>
<div id="header_stretch"></div>
<div id="header_stretch_2"></div>
<div id="header">
	<div id="header_info">
		<?php
			require ("Incs/template.inc.php");
		?>
	</div>
</div>
<div id="wrapper">
<div id="wrapper_2">
<div id="content">
<?php
$noPages = 0;
$pages_search = 0;
$num_comparisons_pp = 51;
$search = '';
$search_rows = 0;
$Search = false;
@$pageURL = curPageUrl();
$creating_for = substr($pageURL, (strpos($pageURL, "create.php?"))+15, (((strpos($pageURL, "-c")))-((strpos($pageURL, "create.php?"))+15)));
@$choice1 = substr($pageURL, (strpos($pageURL, "choice1="))+8, (((strpos($pageURL, "-c1")))-((strpos($pageURL, "choice1="))+8)));
$comparison_category = $creating_for;
if (loggedin()){
	switch($creating_for){
		case "laptops":
			require("Incs/create_laptops.inc.php");
			break;
		case "games":
			require("Incs/create_games.inc.php");
			break;
		case "phones":
			require("Incs/create_phones.inc.php");
			break;
		default:
			require("Incs/create_template.inc.php");
			break;
	}
} else {
	echo "You need to be logged in to create comparisons";
}
?>
</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>

<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
</body>
</html>