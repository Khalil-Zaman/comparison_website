<?php
$x=0;
$added_category = array();
$added_id = array();
$select = "`category`,`Name`,`time_added`,`id`";
$query = "
SELECT ".$select." FROM `games` WHERE `user_added`='".$username."' AND `user_added_id`='".$_SESSION["user_id"]."' UNION ALL 
SELECT ".$select." FROM `laptops` WHERE `user_added`='".$username."' AND `user_added_id`='".$_SESSION["user_id"]."' UNION ALL 
SELECT ".$select." FROM `phones` WHERE `user_added`='".$username."' AND `user_added_id`='".$_SESSION["user_id"]."' ORDER BY `time_added` DESC";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
if ($query_num_rows>=21){
	$limit = 21;
} else {
	$limit = $query_num_rows;
}
while(($query_row = mysql_fetch_assoc($query_run)) && ($x<=$limit)){
	$added_category[$x] = $query_row['category'];
	$added_name[$x] = $query_row['Name'];
	$added_id[$x] = $query_row["id"];
	$x++;
}
?>
<table style="position:relative; border-collapse:collapse; border-spacing: 0; top:-1px;"> <!-- LIKES -->
<?php
$x = 1;
while($x<=$limit){
	if(((($x-1)%3)==0)){
		echo "<tr>";
	}
	?>
		<td style="border:1px solid #CCCCCC;max-height:110px; padding-top:5px; padding-left:5px; padding-right:5px;" class="comparison_select" >
		<a href="<?php echo "details_info.php?=".$added_category[$x-1]."-".$added_id[$x-1]."-c";?>" >
			<table style="margin-left:auto; margin-right:auto;" >
				<tr>
				<td colspan="2">
					<img src="Pictures/<?php echo $added_category[$x-1]."/".queryULT("pic_name",$added_category[$x-1],"id",$added_id[$x-1]);?>"width="229">
				</td>
				</tr>
				<tr class="game_details" style="position:absolute; background-color:#CCCCCC; width:247px; margin-left:-8px;">  <!--class="game_details"-->
					<td colspan="3"style="position:relative; background-color:#CCCCCC;width:117.5px; color:black; padding:3px; padding-top:0px; text-align:center;">
						<?php echo $added_name[$x-1];?>
					</td>
				</tr>
			</table>
		</a>	
		</td>
	<?php
	$x++;
	if(((($x-1)%3)==0)){
		echo "</tr>";
	}
?>
	
<?php } ?>
</table>