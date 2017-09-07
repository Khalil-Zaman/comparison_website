<?php
//require('../sessionStart.inc.php');
require('../connect.inc.php');
require('../core.inc.php');
if (isset($_POST["id"])&&isset($_POST["category"])){
	$id = $_POST["id"];
	$category = $_POST["category"];
	$changes = $_POST["changes"];
	$changeLn = strlen($changes);
	$noFields = substr_count($changes, 'FIELD');
	
	$changesFIELD = array();
	$changesINFO = array();
	$pos = 0;
	$changesQuery = "";
	
	$query = "SELECT * FROM `".$category."` WHERE `id`='".$id."'";
	$query_run = mysql_query($query);
	$query_row = mysql_fetch_assoc($query_run);
	$user_added = $query_row["user_added"];
	$NameItem = $query_row["Name"];
	if(($query_row["verified"]==0)&&($query_row["delete"]==0)&&($_SESSION['user_username']=='ADMIN')){
		if($category=='games'){
			$iconName = $query_row["icon_img"];
			$extensionIcon = strtolower(substr($iconName, strpos($iconName, ".") +1));
		}
		$picName = $query_row["pic_name"];
		$extensionBig = strtolower(substr($picName, strpos($picName, ".") +1));
		for($x=0; $x<$noFields; $x++){
			$changesFIELD[$x] = trim(substr($changes, (strpos($changes, "FIELD"))+5+$pos, (((strpos($changes, "-", $pos)))-((strpos($changes, "FIELD", $pos))+5))));
			$changesINFO[$x] = trim(substr($changes, (strpos($changes, "-",$pos))+1, (((strpos($changes, "END",$pos)))-((strpos($changes, "-", $pos))+1))));
			if($changesFIELD[$x]=="Name"){
				$NameChange = $x;
				$NameItem = $changesINFO[$x];
				$changePIC = str_replace(' ','_',$changesINFO[$x]);
				$changesQuery = $changesQuery.",`pic_name`='".$changePIC.time().".".$extensionBig."'";
				if($category=='games'){
					$changesQuery = $changesQuery.",`icon_img`='".$changePIC."_icon".time().".".$extensionIcon."'";
				}
			}
			$pos = strpos($changes, "END", $pos)+3;
			$changesQuery = $changesQuery.",`".$changesFIELD[$x]."`='".mysql_real_escape_string($changesINFO[$x])."'";
		}
		if(in_array("Name", $changesFIELD)==true){
			rename("../../Pictures/".ucfirst($category)."/".$picName,"../../Pictures/".ucfirst($category)."/".$changePIC.time().".".$extensionBig); //RENAME BIG IMAGE
			if($category=='games'){
				rename("../../Pictures/".ucfirst($category)."/Icons/".$iconName,"../../Pictures/".ucfirst($category)."/Icons/".$changePIC."_icon".time().".".$extensionIcon); //RENAME ICON IMAGE IF GAME
			}
		}
		$query_2 = "UPDATE `".$category."` SET `verified`='1', `time_verified`='".time()."' ".$changesQuery."WHERE `id`='".$id."'";
		$query_run_2= mysql_query($query_2);
		if(!$query_run_2){
			echo "Failed. Please try again later"; // FAIL
		} else {
			$query3 = "INSERT INTO `messages`(`user_recieving`, `user_sending`, `time`, `message`, `seen`) VALUES (
			'".$user_added."',
			'ADMIN',
			'".time()."',
			'Congratulations. You\'re ".$category.", ".$NameItem." has been verified. Click <a href=\'details_info.php?=".$category."-".$id."-c\'>You\'re item.</a>',
			'0')";
			$query_run3 = mysql_query($query3);
			echo "Success";
		}
	}
	
}
?>