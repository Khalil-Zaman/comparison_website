<?php #require("Incs/sessionStart.inc.php"); ?>
<!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
<title>
WhichToPick	
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
$addition;
@$pageURL = curPageUrl();
$username = substr($pageURL, (strpos($pageURL, "user.php?="))+10, (((strpos($pageURL, "-view")))-((strpos($pageURL, "user.php?="))+10)));
$user_display = substr($pageURL, (strpos($pageURL, "-user-"))+6);
$table = array('laptops','compare','games','compare','phones','compare');
$points = $no_items = $no_comparisons = 0;
for ($x=0; $x<count($table);$x++){
	if ($table[$x]=='compare'){
	$addition = "AND `category`='".$table[$x-1]."'";
	} else {
	$addition = "";
	}
	$query = "SELECT `id` FROM `".$table[$x]."` WHERE `user_added` = '".$username."' ".$addition."";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	if(strpos($table[$x],'compare')!==false){
		$points = $points+($query_num_rows * 50);
		$no_comparisons = $no_comparisons + $query_num_rows;
	} else {
		$points = $points+($query_num_rows * 250);
		$no_items = $no_items + $query_num_rows;
	}
}

if(!isset($_SESSION['user_username'])){
	$usernameLoggedIn = null;
} else {
	$usernameLoggedIn = $_SESSION['user_username'];
}

$query = "SELECT * FROM `messages` WHERE `user_recieving`='".$username."' AND `seen`='0'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$no_messages = $query_num_rows;
queryUPD('users','points',$points,'username',$username);
queryUPD('users','no_items',$no_items,'username',$username);
queryUPD('users','no_comparisons',$no_comparisons,'username',$username);
$time_joined = queryULT('time_joined','users','username',$username);
$no_followers = queryULT('followers','users','username',$username);
$no_following = queryULT('following','users','username',$username);
$query = "SELECT `id` FROM `likes` WHERE `username`='".$username."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$likes = $query_num_rows;
?>
<div style="position:relative; float:clear;">
<div style="position:relative; float:left;">
<table style="border-collapse:collapse; border:1px solid #CCCCCC; position:relative; left:10px; top:10px;font-size:13px; background-color:white;"><!-- USER INFO -->
	<tr>
		<td colspan="2" style="padding:10px; border:1px solid #CCCCCC; background-color:#DBDBDB;">
			<img src="Pictures/Users/<?php users_pic($username);?>" height="210"/>
		</td>
	</tr>
	<tr>
		<td colspan="2"id="usernames_name" style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px; border-top:1px solid #CCCCCC;">
			<?php echo $username;?>
		</td>
	</tr>
	<tr>
		<td style="border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Total Points
		</td>
		<td style="border-top:1px solid #CCCCCC;  border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $points;?>
		</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Items added
		</td>
		<td  style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $no_items;?>
		</td>
	</tr>
	<tr>
		<td style="border-left:1px solid #CCCCCC;  border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Comparisons Made
		</td>
		<td  style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $no_comparisons;?>
		</td>
	</tr>
	<tr>		
		<td  style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Date Joined
		</td>
		<td  style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo date('d-m-Y',$time_joined);?>
		</td>
	<tr>
	</tr>
		<td style="border-left:1px solid #CCCCCC;  border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Likes
		</td>
		<td  style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $likes;?>
		</td>
	</tr>	
</table>
<div style="position:relative; left:10px; top:20px;">
<div style="position:relative; padding:15px; border:1px solid #CCCCCC; background-color:#E9E9E9;">
<div style="position:relative;">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- FrontAd -->
	<ins class="adsbygoogle"
		 style="display:inline-block;width:200px;height:200px"
		 data-ad-client="ca-pub-8679411009445717"
		 data-ad-slot="7777214381"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div> <!-- MEDIUM RECTANGLE -->
</div>
</div>
</div>
<div style="position:relative; float:right; right:10px;">
<?php if(loggedin()){ ?>
	<div style="position:relative; top:10px; display:inline-block;">
		<div class="results_heading_2" style="display:inline-block;">
		<?php echo $username;?>
			<?php if(($_SESSION["user_username"]=='ADMIN')&&($username=='ADMIN')){?>
			<div style="display:inline-block; position:relative; left:100px; font-style:italic;">
				<a style="color:#4d4d4d;" href="admin_verify.php">Verify newly made items</a>
			</div>
			<?php } ?>
			<?php if($username!=$_SESSION['user_username']){ ?>
				<div style="float:right; display:inline-block; height:25px; width:25px; text-align:center;background-color:#F2F2F2; border-radius:3px; border:1px solid #CCCCCC;">
					<a href="<?php echo "user.php?=".$username."-view-user-message";?>">
						<img src="Pictures/Website/message.png" style="height:15px; vertical-align:middle;"/>
					<a/>
				</div>
			<?php } else { ?>
				<div style="width:75px; background-color:red; float:right; display:inline-block; height:25px; background-color:#F2F2F2; border-radius:3px; border:1px solid #CCCCCC;">
					<div id="logout_button" style="text-align:center; background-color:#F2F2F2; color:#4D4D4D; position:relative; top:3px;font-size:16px; cursor:pointer;">Log Out</div>
				</div>
				<div style="width:10px; height:25px; position:relative;float:right; display:inline-block; "></div>
				<div style="float:right; display:inline-block; height:25px; width:25px; text-align:center;background-color:#F2F2F2; border-radius:3px; border:1px solid #CCCCCC;">
					<a href="manage_account.php"><img src="Pictures/Website/settings.png" style="height:15px; vertical-align:middle;"/><a/>
				</div>
			<?php } ?>
			
		</div>
	</div>
<?php } ?>
	<div style="position:relative; top:20px;">
	<?php
	switch($user_display){
		case "likes":
			require("Incs/user_template.inc.php");
			require("Incs/user_likes.inc.php");
			break;
		case "items-added":
			require("Incs/user_template.inc.php");
			require("Incs/user_items_added.inc.php");
			break;
		case "comparisons-made":
			require("Incs/user_template.inc.php");
			require("Incs/user_comparisons_made.inc.php");
			break;
		case "message":
			require("Incs/user_message.inc.php");
			break;
		case "view_messages":
			require("Incs/user_template.inc.php");
			require('Incs/user_view_messages.inc.php');
			break;
		case "view_all_messages":
			require("Incs/user_template.inc.php");
			require('Incs/user_view_all_message.inc.php');
			break;
		default:
			require("Incs/user_template.inc.php");
			require("Incs/user_likes.inc.php");
			break;
	}
	?>
	</div>
</div>
</div>

</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>

<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/user_message.inc.js"></script>
</body>
</html>