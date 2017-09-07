 <!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css">
<title>
WhichToPick: Add A New Item
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
<div id="content" style="padding-bottom:150px;">
<?php
$successMessage = "<span style='color:green;'>Success! We will notify you once your item has been verified. Upload another item?</span>";
@$pageURL = curPageUrl();
$creating_for = substr($pageURL, (strpos($pageURL, "Add_item.php?="))+14, (((strpos($pageURL, "-c")))-((strpos($pageURL, "Add_item.php?="))+14)));
@$name = $_FILES["p_file_name"]["name"];
$extension = strtolower(substr($name, strpos($name, ".") +1));
@$size = $_FILES["p_file_name"]["size"];
$max_size = 20971752;
@$type = $_FILES["p_file_name"]["type"];
@$tmp_name = $_FILES["p_file_name"]["tmp_name"];
@$error = $_FILES["p_file_name"]["error"];

if (loggedin()){
	switch($creating_for){
		case "laptops":
			require("Incs/add_laptops.inc.php");
			break;
		case "games":
			require("Incs/add_games.inc.php");
			break;
		case "phones":
			require("Incs/add_phones.inc.php");
			break;
		default:
			require("Incs/add_template.inc.php");
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
<?php if ($creating_for=='games'){ ?>
<script type="text/javascript" src="Incs/jq_add_games.js"></script>
<?php } else { ?>
<script type="text/javascript" src="Incs/jq_add.js"></script>
<?php } ?>
</body>
</html>