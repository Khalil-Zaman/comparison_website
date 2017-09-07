<?php
$query = "SELECT * FROM `following` WHERE `user_following`='".$username."' AND `unfollow`='0' ORDER BY `time` DESC";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
if ($query_num_rows>0){
	$followersName = $followersId =  array();
	$x = 0;
	while ($query_row = mysql_fetch_assoc($query_run)){
		$followersName[$x] = $query_row['user_followed'];
		$x++;
	}
}
if($query_num_rows>0){
?>
<div style="position:relative;">
	<table style="border-collapse:collapse: border-spacing:0; position:relative; border:1px solid #CCCCCC; width:739px; border-bottom:0; margin-top:-1px;text-align:left;">
		<tr>
			<td>
				<table>
			<?php for ($x=0; 
			$x<(count($followersName));
			//$x<10;
			$x++){
			if(($x%6)==0){ echo "<tr style='border-spacing:0; border-collapse:collapse;'>"; }?>
			<td>
				<a href="user.php?=<?php echo $followersName[$x];?>-view-user">
					<img src="pictures/users/<?php users_pic($followersName[$x]);?>" class="follow_pic" title="<?php echo $followersName[$x];?>"/>
				</a>
			</td>
			<?php 
			if(
			(($x+1)%6)==0){ echo "</tr>"; }
			} ?>
				</table>
			</td>
		</tr>
	</table>
</div>
<?php } else { ?>
<div style="color:#4D4D4D; font-size:20px; top:10px; position:relative;">
	The user <span style='font-style:italic;'><?php echo $username;?></span> currently is not following anyone.
</div>
<?php } ?>