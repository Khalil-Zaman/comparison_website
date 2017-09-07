<?php 
@$pageURL = curPageUrl();
$other_user = substr($pageURL, (strpos($pageURL, "view-all_messages-"))+18, (((strpos($pageURL, "-user")))-((strpos($pageURL, "view-all_messages-"))+18)));
$query = "SELECT * FROM `messages` WHERE 
(`user_sending`='".$other_user."' AND `user_recieving`='".$_SESSION['user_username']."') OR 
(`user_sending`='".$_SESSION['user_username']."' AND `user_recieving`='".$other_user."') ORDER BY `time` DESC LIMIT 15";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$x = 0;
while($query_row = mysql_fetch_assoc($query_run)){
	$message[$x] = $query_row['message'];
	$user_sending[$x] = $query_row['user_sending'];
	$time[$x] = $query_row['time'];
	$x++;
}

$query = "UPDATE `messages` SET `seen`='1' WHERE `user_recieving`='". $_SESSION['user_username']."' AND `user_sending`='".$other_user."'";
mysql_query($query);

if((isset($_POST['message']))&&(!empty($_POST['message']))){
	$message = htmlentities(mysql_real_escape_string($_POST['message']));
	$user_recieving  = $other_user;
	$username_sending = $_SESSION['user_username'];
	$query = "INSERT INTO `messages` VALUES (
	'',
	'".mysql_real_escape_string($user_recieving)."',
	'".mysql_real_escape_string($username_sending)."',
	'".time()."',
	'".mysql_real_escape_string($message)."',
	'0'
	)";
	
	if(!($query_run = mysql_query($query))){
		echo "failed";
	} else {
		header('Location: '.$pageURL);
	}
}
?>
<div style="position:relative; border-collapse:collapse; border-spacing: 0; top:-1px; border:1px solid #CCCCCC;">
<table style="border-collapse:collapse; width:737px;">
	<form action="<?php echo $pageURL;?>" method="POST" id="user_message_reply_form">
	<tr>
		<td colspan="3" style="padding:10px; padding-bottom:0px;background-color:#F1F1F1;">
			<textarea style="resize:none; height:200px; width:708px;" name="message" id="user_messaging_reply_section"></textarea>
		</td>
	</tr>
	<tr style="background-color:#F1F1F1; border-bottom:1px solid #CCCCCC;">
		<td colspan="1" style="padding-left:10px; width:50px;">
			<a href="user.php?=<?php echo $other_user;?>-view-user">
				<img src="pictures/users/<?php users_pic($other_user);?>" height="50"/>
			</a>
		</td>
		<td colspan="1" style="padding-left:10px; text-align:left; color:#4D4D4D; font-weight:bold;">
			<a href="user.php?=<?php echo $other_user;?>-view-user" style="color:#4D4D4D; text-decoration:none;">
				<?php echo "-".$other_user?>
			</a>
		</td>
		<td colspan="1" style="float:right; padding-top:10px; padding-bottom:10px; padding-right:10px;background-color:#F1F1F1;">
			<div id="user_reply_to_message" style="border:1px solid #CCCCCC; cursor:pointer;border-radius:3px;background-color:#E9E9E9; width:50px; text-align:center;padding:5px 15px 5px 15px;">	
				Send
			</div>
		</td>
	</td>
	</form>
	<tr>
		<td colspan="3">
			<div style="overflow:auto; max-height:300px;" class="vertical_scroll" id="message_all_scroll">
				<table style="border-collapse:collapse; width:100%;">
					<?php for($x=0; $x<count($message); $x++){ ?>
					<tr style="border-bottom:1px solid #CCCCCC;">
						<td style="padding:10px; width:50px; vertical-align:text-top;">
							<span style="font-style:italic; font-size:14px;">
								<?php echo $user_sending[$x];?>
							</span>
						</td>
						<td style="padding:10px; font-size:14px; width:545px; max-width:545px; word-wrap:break-word;">
							<?php echo $message[$x];?>
						</td>
						<td style="width:100px; vertical-align:text-top;">
							<span style="font-size:11px;">
								<?php echo date('d/m/y G:i',$time[$x]);?>
							</span>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</td>
	</tr>
</table>
</div>
<div class="username_user_sending" style="visibility:hidden;"><?php echo $_SESSION['user_username'];?></div>
<div class="user_recieving_message" style="visibility:hidden;"><?php echo $other_user;?></div> 
			