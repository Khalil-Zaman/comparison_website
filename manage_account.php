<?php #require("Incs/sessionStart.inc.php"); ?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css">
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css">
<title>
WhichToPick: Manage Your Account
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
<div id="content" style="padding-bottom:800px;">
<?php
@$pageURL = curPageUrl();
@$url_extension = substr($pageURL, (strpos($pageURL, "manage_account.php"))+18);
$username = $_SESSION['user_username'];
$query = "SELECT `id` FROM `likes` WHERE `username`='".$username."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$likes = $query_num_rows;

$queryUsers = "SELECT `points`,`no_comparisons`,`no_items`,`time_joined` FROM `users` WHERE `username`='ADMIN'";

$points = queryULT('points','users','username',$username);
$no_comparisons = queryULT('no_comparisons','users','username',$username);
$no_items = queryULT('no_items','users','username',$username);
$time_joined = queryULT('time_joined','users','username',$username);
switch($url_extension){
	case "?=profile_pic-c":
		require('Incs/User/ManageAccount/manage_account_profile_pic.inc.php');
		break;
	default:
		require('Incs/User/ManageAccount/manage_account_index.inc.php');
		break;
}
?>
</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>

<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/jquery-ui.js"></script>
<script type="text/javascript" src="Incs/User/ManageAccount/manage_account.inc.js"></script>
<?php if($url_extension=='?=profile_pic-c'){?>
<script type="text/javascript" src="Incs/User/ManageAccount/manage_account_profile.inc.js"></script>
<?php } ?>
</body>
</html>