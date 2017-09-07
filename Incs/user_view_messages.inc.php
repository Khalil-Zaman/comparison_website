<?php
$x=0;
$query = "SELECT * FROM `messages` WHERE `user_recieving`='".$_SESSION['user_username']."' OR `user_sending`='".$_SESSION['user_username']."'ORDER BY `time` DESC";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
if($query_num_rows==0){
	echo "Sorry you have no messages";
} else {
	$users = array();
	$other_user = array();
	while($query_row = mysql_fetch_assoc($query_run)){
		if ($query_row['user_sending']==$_SESSION['user_username']){
			$other = $query_row['user_recieving'];	
		} else {
			$other = $query_row['user_sending'];
		}
		while(in_array($other, $other_user)){
			$query_row = mysql_fetch_assoc($query_run);
			if ($query_row['user_sending']==$_SESSION['user_username']){
				$other = $query_row['user_recieving'];		
			} else {
				$other = $query_row['user_sending'];
			}
		}
		
		if ($query_row["user_recieving"]==$_SESSION['user_username']){
			$seen[$x] = $query_row['seen'];
		} else {
			$seen[$x] = "1";
		}
		$other_user[$x] = $other;
		$last_sent[$x] = $query_row['user_sending'];
		$time[$x] = $query_row['time'];
		$message[$x] = $query_row['message'];
		$x++;
	}
}
?>
<table style="position:relative; border-collapse:collapse; border-spacing: 0; top:-1px; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;">
<!--style="border-collapse:collapse; position:absolute; left:251px; top:398px;  border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-top:1px solid #CCCCCC;"-->
	<?php for ($x=0; $x<(count($other_user)-1); $x++){?>
	<tr style="border-bottom:1px solid #CCCCCC; ">
		<td style="width:737px; <?php if($seen[$x]=='0'){echo "background-color:#F2F2F2;";} ?>">
			<a href="user.php?=<?php echo $_SESSION['user_username'];?>-view-all_messages-<?php echo $other_user[$x]?>-user-view_all_messages" style="text-decoration:none; color:black;"/>
				<table style="border-collapse:collapse; width:736px;">
					<tr>
						<td style="font-size:16px; padding:10px; width:75px;">
							<?php echo $other_user[$x];?>
						</td>
						<td style="font-size:14px; padding:10px; max-width:200px;color:#4D4D4D; text-overflow:ellipsis;  white-space: nowrap; overflow: hidden;">
							<?php echo "<span style='font-style:italic;'>".$last_sent[$x].": </span>".$message[$x];?>
						</td>
						<td style="font-size:16px; padding:10px; color:#4D4D4D; text-align:right; width:75px;">
							<?php echo date('d/m/Y',$time[$x]);?>
						</td>
					</tr>
				</table>
			</a>
		</td>
	</tr>
	<?php } ?>
</table>
