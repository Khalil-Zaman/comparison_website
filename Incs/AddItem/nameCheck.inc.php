<?php
require ("../connect.inc.php");
require ("../core.inc.php");

if((isset($_POST["name"]))&&(isset($_POST["category"]))){
	$name = mysql_real_escape_string($_POST['name']);
	$category = mysql_real_escape_string($_POST['category']);
	$query = "SELECT `id`,`Name`,`time_added`,`verified` FROM `".$category."` WHERE `Name` LIKE '%".$name."%' ORDER BY `time_added` DESC";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	
	if($query_num_rows>=1){
		while ($query_row = mysql_fetch_assoc($query_run)){
			$possItemId = $query_row["id"];
			$possItemName = $query_row["Name"];
			if(isset($_POST["id"])){
				if($_POST['id']!=$possItemId){
					if($query_row["verified"]==1){
						echo 
							'<tr>
								<td>
									<a href="details_info.php?='.$category.'-'.$possItemId.'-c" class="addNameCheckPossibilites" target="_blank">
										'.$possItemName.'
								</td>
							</tr>'
						;
					} else if($query_row["verified"]==0){
						echo 
							'<tr>
								<td>
									<a class="addNameCheckPossibilitesUnverfied">
										'.$possItemName.' - This item still needs to be verified.
								</td>
							</tr>'
						;
					}
				}
			} else {
				if($query_row["verified"]==1){
					echo 
						'<tr>
							<td>
								<a href="details_info.php?='.$category.'-'.$possItemId.'-c" class="addNameCheckPossibilites" target="_blank">
									'.$possItemName.'
							</td>
						</tr>'
					;
				} else if($query_row["verified"]==0){
					echo 
						'<tr>
							<td>
								<a class="addNameCheckPossibilitesUnverfied">
									'.$possItemName.' - This item still needs to be verified.
							</td>
						</tr>'
					;
				}
			}
		}
	} else {
		echo "1";
	}
}
?>