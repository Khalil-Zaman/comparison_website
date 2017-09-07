<?php
require('Incs/user_message_form.inc.php');

$username_user = $_SESSION['user_username'];
$query = "SELECT `id` FROM `likes` WHERE `username`='".$username_user."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$likes_user = $query_num_rows;
$points_user = queryULT('points','users','username',$username_user);
$no_comparisons_user = queryULT('no_comparisons','users','username',$username_user);
$no_items_user = queryULT('no_items','users','username',$username_user);
$time_joined_user = queryULT('time_joined','users','username',$username_user);
$followers_user = queryULT('followers','users','username',$username_user);
$following_user = queryULT('following','users','username',$username_user);
?>
<form action="<?php echo $pageURL;?>" method="POST" id="user_message_form">
<table style="border-collapse:collapse; border:1px solid #CCCCCC; position:relative; top:0px; font-size:15px; width:738px;">
	<tr>
		<td rowspan=1  style="padding:10px; padding-bottom:5px; border:1px solid #CCCCCC; background-color:#F2F2F2; vertical-align:text-top;">
			<img src="pictures/users/<?php users_pic($username_user);?>" height="50" style="padding-bottom:5px;"/>		
			<img src="pictures/users/<?php users_pic($username);?>" height="50"/>		
		</td>
		<td rowspan=1  style="background-color:#F2F2F2; padding:10px; padding-bottom:5px;border:1px solid #CCCCCC;" >
			<table>
				<textarea style="resize:none; height:104px; width:639px;"
				name="message_section" id="user_messaging"></textarea>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="background-color:#F2F2F2; text-align:right;">
			<div onclick="message_user()"style="border:1px solid #CCCCCC; float:right; color:#252525;
			width:29px; cursor:pointer; border-radius:3px;background-color:#5779FF; padding:5px 15px 5px 15px;">
				Send
			</div>
		</td>
	</tr>
	<!--
		<td style="width:66px; padding:10px; background-color:#DBDBDB; border:1px solid #CCCCCC;" box-shadow: 2px 2px 1px #888888;>
			<table>
				<tr>
					<td>
						<div onclick="message_user()"style="border:1px solid black; cursor:pointer;border-radius:3px;background-color:#4DEB4D; padding:5px 15px 5px 15px; box-shadow: 2px 2px 1px #888888;">
							Send
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>-->
	<!--
	<tr>
		<td colspan="2" style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px; text-align:center;">
			<?php echo $username_user;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Total Points
		</td>
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $points_user;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Items added
		</td>
		<td  style=" padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $no_items_user;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Comparisons Made
		</td>
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $no_comparisons_user;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">		
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Date Joined
		</td>
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo date('d-m-Y',strtotime($time_joined_user));?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Followers
		</td>
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $followers_user;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Following
		</td>
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $following_user;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			Likes
		</td>
		<td  style="padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px;">
			<?php echo $likes_user;?>
		</td>
	</tr>	
	-->
</table>
<form action="<?php echo $pageURL;?>" method="POST">