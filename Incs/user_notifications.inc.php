<?php
if($username==$_SESSION['user_username']){
	/*$query = "SELECT * FROM `notifications` WHERE `user_recieving`='".$_SESSION['user_username']."' ORDER BY `time` DESC";
	$query_run = mysql_query($query);
	$num_notifications = mysql_num_rows($query_run);
	if ($num_notifications>=1){
		$notifications = array();
		$users = array();
		$users_total = array();
		$x = 0;
		while($query_row = mysql_fetch_assoc($query_run)){
			$users[$x] = $query_row['user_sending'];
			if(!(in_array($query_row['user_sending'], $users_total))){
				$users_total[$x] = $query_row['user_sending'];
			}
			$notifications[$query_row['user_sending']]['pageUrl'][$x] = $query_row["pageUrl"];
			$notifications[$query_row['user_sending']]['time'][$x] = $query_row["time"];
			$notifications[$query_row['user_sending']]['category'][$x] = $query_row["category"];
			if($query_row["category"]=='games'){
				$notifications[$query_row['user_sending']]['extension'][$x] = '/Icons/';
				$notifications[$query_row['user_sending']]['pic_field'][$x] = 'icon_img';
			} else {
				$notifications[$query_row['user_sending']]['extension'][$x] = '/';
				$notifications[$query_row['user_sending']]['pic_field'][$x] = 'pic_name';
			}
			$pageURL = $query_row['pageUrl'];
			$notifications[$query_row['user_sending']]['choice_1'][$x] = $compare_choice1_id = substr($pageURL, 0, (strpos($pageURL, "&&")));
			$notifications[$query_row['user_sending']]['choice_2'][$x] = substr($pageURL, strpos($pageURL,'&&')+2);
			$x++;
		}
	}*/
	$query = "SELECT `user_recieving`, `user_sending`,`time` FROM `notifications` WHERE `user_recieving`='".$usernameLoggedIn."' ORDER BY `time` DESC";
	$query_run = mysql_query($query);
	$num_notifications = mysql_num_rows($query_run);
	if ($num_notifications>=1){
		$notifications = array();
		$users_total = array();
		$x = 0;
		while($query_row = mysql_fetch_assoc($query_run)){
			if(!(in_array($query_row['user_sending'], $users_total))){
				$users_total[$x] = $query_row['user_sending'];
				$query_2 = "SELECT * FROM  `notifications` WHERE `user_recieving`='".$usernameLoggedIn."' AND `user_sending`='".$query_row['user_sending']."' AND `seen`='0'ORDER BY `time` DESC";
				$query_run_2 = mysql_query($query_2);
				$x++;
				$x2 = 0;
				while ($query_row_2 = mysql_fetch_assoc($query_run_2)){
					$notifications[$query_row['user_sending']]['pageUrl'][$x2] = $query_row_2["pageUrl"];
					$notifications[$query_row['user_sending']]['time'][$x2] = $query_row_2["time"];
					$notifications[$query_row['user_sending']]['category'][$x2] = $query_row_2["category"];
					if($query_row_2["category"]=='games'){
						$notifications[$query_row['user_sending']]['extension'][$x2] = '/Icons/';
						$notifications[$query_row['user_sending']]['pic_field'][$x2] = 'icon_img';
					} else {
						$notifications[$query_row['user_sending']]['extension'][$x2] = '/';
						$notifications[$query_row['user_sending']]['pic_field'][$x2] = 'pic_name';
					}
					$pageURL = $query_row_2['pageUrl'];
					$notifications[$query_row['user_sending']]['choice_1'][$x2] = $compare_choice1_id = substr($pageURL, 0, (strpos($pageURL, "&&")));
					$notifications[$query_row['user_sending']]['choice_2'][$x2] = substr($pageURL, strpos($pageURL,'&&')+2);
					$x2++;
				}
			} else {
				$query_row = mysql_fetch_assoc($query_run);
			}
		}
	}
?>
<div style="position:relative; top:0px; right:0px; width:739px; color:#4D4D4D;">
	<?php for ($x=0; $x<(count($users_total));$x++){?>
	<div>
	<table style="border-collapse:collapse; border-spacing: 0; width:739px;" class="user_notifications_dp">
		<tr style="padding-bottom:5px; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; border-spacing:0; border-collapse:collapse;"><!-- <?php if (($x+1)!=(count($notifications))/2){?>border-bottom:1px solid #cccccc;<?php } ?>">-->
			<td style="padding:10px; border-spacing:0; border-collapse:collapse;">
				<img src="pictures/users/<?php users_pic($users_total[$x]);?>" style="border:1px solid #CCCCCC; display:inline-block;"height="100"/>
			</td>
			<td>
				<?php echo $users_total[$x]." has made ".count($notifications[$users_total[$x]]['pageUrl'])." new comparison";
				if((count($notifications[$users_total[$x]]['pageUrl']))> 1){echo "s."; } else {echo ".";}?>
			</td>
		</tr>
	</table>
	<div class="user_notifications_comparisons" >
		<table style="border-collapse:collapse; border-spacing:0; position:relative; margin-top:-1px;">
				<?php
				for($x2=0; $x2<(count($notifications[$users_total[$x]]['pageUrl'])); $x2++){
					if((($x2%3)==0)){
						echo "<tr style='border-collapse:collapse; border-spacing:0;'>";
					}
					?>
			<td style="border:1px solid #CCCCCC;max-height:110px; padding-top:5px; padding-left:5px;padding-right:5px; max-width:250px;" class="comp_select" >
				<a href="<?php echo $notifications[$users_total[$x]]['category'][$x2]."_compare.php?".$notifications[$users_total[$x]]['category'][$x2]."-c".$notifications[$users_total[$x]]['pageUrl'][$x2]."-gc";?>" >
					<table style="margin-left:auto; margin-right:auto; " >
						<tr>
							<td colspan="2">	
								<img src="Pictures/<?php echo $notifications[$users_total[$x]]['category'][$x2].
								$notifications[$users_total[$x]]['extension'][$x2].
								queryULT($notifications[$users_total[$x]]['pic_field'][$x2],$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_1'][$x2]);?>"width="110">
							</td>
							<td colspan="2" >
								<div style="height:100px; background-color:green; width:1px;"></div>
							</td>
							<td>
								<img src="Pictures/<?php echo $notifications[$users_total[$x]]['category'][$x2].
								$notifications[$users_total[$x]]['extension'][$x2].
								queryULT($notifications[$users_total[$x]]['pic_field'][$x2],$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_2'][$x2]);?>"width="110">
							</td>
						</tr>
						<tr class="name_details">
							<td colspan="3">
								<table>
									<tr>
										<td class="name_details_td"><?php echo queryULT("Name",$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_1'][$x2]);?></td>
										<td class="name_details_td"><?php echo queryULT("Name",$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_2'][$x2]);?></td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
			</a>	
		</td>
		<?php
			if((($x2+1)%3)==0){
				echo "</tr>";
			} } ?>
		</table>
	</div>
	</div>
	<?php } ?>
</div>





<!--
<table style="position:relative; top:50px;border-collapse:collapse; border-spacing: 0; right:0px; width:739px; color:#4D4D4D;">
	<?php
	$x=0; 
	while ($x<(count($users_total))){ ?>
	<tr style="padding-bottom:5px; border-left:1px solid #CCCCCC; border-right:1px solid #CCCCCC; border-spacing:0; border-collapse:collapse;">
		<td style="padding:10px; border-spacing:0; border-collapse:collapse;">
			<img src="pictures/users/<?php users_pic($users_total[$x]);?>" style="border:1px solid #CCCCCC; display:inline-block;"height="100"/>
		</td>
		<td>
			<?php echo $users_total[$x]." has made ".count($notifications[$users_total[$x]]['pageUrl'])." new comparison";
			if((count($notifications[$users_total[$x]]['pageUrl']))> 1){echo "s."; } else {echo ".";}?>
		</td>
	</tr>
	<tr style="border-collapse:collapse; border-spacing:0;">
		<td colspan="2" style="border-collapse:collapse; border-spacing:0; position:relative; margin-left:-1px; top:-1px;">
			<table style="border-collapse:collapse; border-spacing:0;">
			<?php $x2=0;
			while ($x2<(count($notifications[$users_total[$x]]['pageUrl']))){
				if((($x2%3)==0)){
					echo "<tr style='border-collapse:collapse; border-spacing:0;'>";
				}
				?>
		<td style="border:1px solid #CCCCCC;max-height:110px; padding-top:5px; padding-left:5px;padding-right:5px; max-width:250px;" class="comp_select" >
			<a href="<?php echo $notifications[$users_total[$x]]['category'][$x2]."_compare.php?".$notifications[$users_total[$x]]['category'][$x2]."-c".$notifications[$users_total[$x]]['pageUrl'][$x2]."-gc";?>" >
				<table style="margin-left:auto; margin-right:auto; " >
					<tr>
						<td colspan="2">	
							<img src="Pictures/<?php echo $notifications[$users_total[$x]]['category'][$x2].
							$notifications[$users_total[$x]]['extension'][$x2].
							queryULT($notifications[$users_total[$x]]['pic_field'][$x2],$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_1'][$x2]);?>"width="110">
						</td>
						<td colspan="2" >
							<div style="height:100px; background-color:green; width:1px;"></div>
						</td>
						<td>
							<img src="Pictures/<?php echo $notifications[$users_total[$x]]['category'][$x2].
							$notifications[$users_total[$x]]['extension'][$x2].
							queryULT($notifications[$users_total[$x]]['pic_field'][$x2],$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_2'][$x2]);?>"width="110">
						</td>
					</tr>
					<tr class="name_details">
						<td colspan="3">
							<table>
								<tr>
									<td class="name_details_td"><?php echo queryULT("Name",$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_1'][$x2]);?></td>
									<td class="name_details_td"><?php echo queryULT("Name",$notifications[$users_total[$x]]['category'][$x2],"id",$notifications[$users_total[$x]]['choice_2'][$x2]);?></td>
								</tr>
							</table>
						</td>
					</tr>
			</table>
		</a>	
	</td>
	<?php
		$x2++;
		if((($x2%3)==0)){
			echo "</tr>";
		} } ?>
	</table>
		</td>
	</tr>
	
	<!--
	<?php
	$x2 = 1;
	$limit = 23;
	while($x2<=$limit){
		if(((($x2-1)%3)==0)){
			echo "<tr>";
		}
		?>
	<td style="border:1px solid #CCCCCC;max-height:110px; padding-top:5px; padding-left:5px; padding-right:5px;" class="comparison_select" >
	<a href="<?php echo $category[$x2-1]."_compare.php?".$category[$x2-1]."-c".$pageURLArray[$x2-1]."-gc";?>" >
		<table style="margin-left:auto; margin-right:auto;" >
			<tr>
			<td colspan="2">
				<img src="Pictures/<?php echo $notifications[$query_row['user_sending']]['category'][$x2-1].$extension[$x2-1].queryULT($pic_field[$x2-1],$category[$x2-1],"id",$choice1[$x2-1]);?>"width="110">
			</td>
			<td colspan="2" >
				<div style="height:100px; background-color:green; width:1px;"></div>
			</td>
			<td  colspan="2">
				<img src="Pictures/<?php echo $category[$x2-1].$extension[$x2-1].queryULT($pic_field[$x2-1],$category[$x2-1],"id",$choice2[$x2-1]);?>" width="110">
			</td>
			</tr>
			<tr class="game_details" style="position:absolute; background-color:#CCCCCC; width:247px; margin-left:-8px;">
				<td colspan="3"style="position:relative; background-color:#CCCCCC;width:117.5px; color:black; padding:3px; padding-top:0px;text-align:center;"><?php echo $choice1_name[$x2-1];?></td>
				<td colspan="3"style="position:relative; background-color:#CCCCCC;width:117.5px; color:black; padding:3px; padding-top:0px;text-align:center;"><?php echo $choice2_name[$x2-1];?></td> 
			</tr>
		</table>
	</a>	
	</td>
		<?php
		$x2++;
		if(((($x2-1)%3)==0)){
			echo "</tr>";
		} }
	?>
	
	
	<?php $x++;} ?>
</table>

<?php } ?>

-->
