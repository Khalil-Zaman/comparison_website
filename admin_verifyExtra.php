<?php #require("Incs/sessionStart.inc.php"); ?>
<!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
<title>
WoTechno	
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
<div id="content" style="padding-bottom:400px;">

<?php
$anyErrors = "";
if($_SESSION['user_username']=='ADMIN'){
@$pageURL = curPageUrl();
@$comparison_category = substr($pageURL, (strpos($pageURL, "Extra.php?"))+10, (((strpos($pageURL, "-")))-((strpos($pageURL, "Extra.php?"))+10)));
@$id = substr($pageURL, (strpos($pageURL, "-"))+1, (((strpos($pageURL, "-c")))-((strpos($pageURL, "-"))+1)));
$basicArray = array("Games", "Laptops","Phones" );
$pic_name = "default_pic_name";
$possibleNames = "";

switch($comparison_category){
	case "laptops":
		$field=array(
			"Name",
			"Brand",
			"Screen Size",
			"HDD",
			"Resolution",
			"Ram",
			"Processor",
			"Graphics Card",
			"Source",
			"Picture Source",
			"Buy Link"
		);
		break;
	case "phones":
		$field=array(
			"Name",
			"Brand",
			"Display",
			"Internal Storage",
			"Front Camera",
			"Rear Camera",
			"Source",
			"Picture Source",
			"Buy Link"
		);
		break;
	case "games":
		$field=array(
			"Name",
			"Platforms",
			"Genre",
			"Released",
			"Mode",
			"Source",
			"Picture Source",
			"icon_src",
			"Buy Link"
		);
		break;
}	
$where = "";
for($x=0; $x<count($field); $x++){
	if(($x+1)==count($field)){
		$where .= "`".$field[$x]."`";
	} else {
		$where .= "`".$field[$x]."`,";
	}
}
if($comparison_category=="games"){
	$where .= ",`icon_img` AS `pic_name`";
} else {
	$where .= ", `pic_name`";
}

$query = "SELECT `id`,`time_added`,`verified`,".$where." FROM `".$comparison_category."` WHERE `id`='".$id."'";
$query_run = mysql_query($query);
$query_row = mysql_fetch_assoc($query_run);
for($x=0; $x<count($field); $x++){
	$options[$x] = htmlentities($query_row[$field[$x]]);
}
 
$x = 0;
$query = "SELECT * FROM `".$comparison_category."` WHERE `verified`='0' AND `delete`='0' AND `id`='".$id."'";
$query_run = mysql_query($query);
$query_row = mysql_fetch_assoc($query_run);
$cat = $comparison_category;
$nameOfItemToCheckAlreadyMade = $query_row["Name"];
$time = time()- $query_row['time_added'];;
$time_added = date("n\M j\d G\h i\m s\s",$time);
$pic_name = $query_row['pic_name'];
$newPicNameBase = str_replace(' ','_',$query_row["Name"]).time();
switch($comparison_category){
	case "games":
		$extension="/Icons/";
		$icon_pic = $query_row["icon_img"];
		$newIconPicBase = str_replace(' ','_',$query_row["Name"])."_icon".time();
		break;
	case "laptops":
		$extension="/";
		break;
	case "phones":
		$extension="/";
		break;
	default:
		echo "Unrecognized category";
		break;
}

$query = "SELECT `id`,`Name`,`time_added`,`verified` FROM `".$comparison_category."` WHERE `Name` LIKE '%".$nameOfItemToCheckAlreadyMade."%' AND `id`!='".$id."'ORDER BY `time_added` DESC";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);

if($query_num_rows>=1){
	while ($query_row = mysql_fetch_assoc($query_run)){
		$possItemId = $query_row["id"];
		$possItemName = $query_row["Name"];
		if($query_row["verified"]==1){
			$possibleNames .= 
				'<tr>
					<td colspan="2">
						<a href="details_info.php?='.$comparison_category.'-'.$possItemId.'-c" class="addNameCheckPossibilites" target="_blank">
							'.$possItemName.'
					</td>
				</tr>'
			;
		} else if($query_row["verified"]==0){
			$possibleNames .= 
				'<tr>
					<td colspan="2">
						<a class="addNameCheckPossibilitesUnverfiedVerifyExtra">
							'.$possItemName.'.
					</td>
				</tr>'
			;
		}
	}
}

for($x=0; $x<count($field); $x++){
	$info[$x] = $query_row[$field[$x]];
}

if(isset($_FILES["file_name"]["name"])){
	$name = $_FILES["file_name"]["name"];
	$extension_bigImage = strtolower(substr($name, strpos($name, ".") +1));
	$size = $_FILES["file_name"]["size"];
	$max_size = 20971752;
	$type = $_FILES["file_name"]["type"];
	$tmp_name = $_FILES["file_name"]["tmp_name"];
	$error = $_FILES["file_name"]["error"];
	if (($extension_bigImage=="jpg"||$extension_bigImage=="jpeg"||$extension_bigImage=="png")&&($type=="image/jpeg"||$type=="image/jpg"||$type=="image/png")){
		if ($size<=$max_size){
			$location = "Pictures/".ucfirst($comparison_category)."/";
			$filename = "Pictures/".ucfirst($comparison_category)."/".$pic_name;
			if (file_exists($filename)) {
				//unlink($_SERVER['DOCUMENT_ROOT']."/Website/Pictures/".ucfirst($comparison_category)."/".$pic_name);
				if(!(unlink($_SERVER['DOCUMENT_ROOT']."/Pictures/".ucfirst($comparison_category)."/".$pic_name))){
					$anyErrors .= "Unable to delete previous Image. ";
				}				
			}
			if (move_uploaded_file($tmp_name, $location.$newPicNameBase.".".$extension_bigImage)){
				$query = "UPDATE `".$comparison_category."` SET `pic_name`='".$newPicNameBase.".".$extension_bigImage."' WHERE `id`='".$id."'";
				if(mysql_query($query)){
					$pic_name = $newPicNameBase.".".$extension_bigImage;
				} else {
					$anyErrors .= "Unable to update database for the new image. ";
				}
			} else {
				$anyErrors .= "Unable to upload the new game Image. ";
			}
		}
	}
}

if(isset($_FILES["file_icon_name"]["name"])){
	$nameI = $_FILES["file_icon_name"]["name"];
	$extension_IconImage = strtolower(substr($nameI, strpos($nameI, ".") +1));
	$sizeI = $_FILES["file_icon_name"]["size"];
	$max_sizeI = 20971752;
	$typeI = $_FILES["file_icon_name"]["type"];
	$tmp_nameI = $_FILES["file_icon_name"]["tmp_name"];
	$errorI = $_FILES["file_icon_name"]["error"];
	if (($extension_IconImage=="jpg"||$extension_IconImage=="jpeg"||$extension_IconImage=="png")&&($typeI=="image/jpeg"||$typeI=="image/jpg"||$typeI=="image/png")){
		if ($sizeI<=$max_sizeI){
			if($comparison_category=="games"){
				$location = "Pictures/".ucfirst($comparison_category)."/Icons/";
				$filename = "Pictures/".ucfirst($comparison_category)."/Icons/".$icon_pic;
				if (file_exists($filename)) {
					if(!(unlink($_SERVER['DOCUMENT_ROOT']."/Pictures/".ucfirst($comparison_category)."/Icons/".$icon_pic))){
						$anyErrors .= "Unable to delete the game Icon Image. ";
					}
				}
				if (move_uploaded_file($tmp_nameI, $location.$newIconPicBase.".".$extension_IconImage)){
					$query = "UPDATE `".$comparison_category."` SET `icon_img`='".$newIconPicBase.".".$extension_IconImage."' WHERE `id`='".$id."'";
					if(mysql_query($query)){
						$icon_pic = $newIconPicBase.".".$extension_IconImage;
					} else {
						$anyErrors .= "Unable to update database for the new game icon image. ";
					}
				} else {
					$anyErrors .= "Unable to upload game Icon Image. ";
				}
			} else {
				$location = "Pictures/".ucfirst($comparison_category)."/";
				$filename = "Pictures/".ucfirst($comparison_category)."/".$pic_name;
				if (file_exists($filename)) {
					if(!(unlink($_SERVER['DOCUMENT_ROOT']."/Pictures/".ucfirst($comparison_category)."/".$pic_name))){
						$anyErrors .= "Unable to delete previous Image. ";
					}				
				}
				if (move_uploaded_file($tmp_nameI, $location.$newPicNameBase.".".$extension_IconImage)){
					$query = "UPDATE `".$comparison_category."` SET `pic_name`='".$newPicNameBase.".".$extension_IconImage."' WHERE `id`='".$id."'";
					if(mysql_query($query)){
						$pic_name = $newPicNameBase.".".$extension_IconImage;
					} else {
						$anyErrors .= "Unable to update database for the new image. ";
					}
				} else {
					$anyErrors .= "Unable to upload the new Image. ";
				}
			}
		}
	}
}
?>
<div style="font-size:20px; color:red; position:relative; top:15px; left:10px;" id="divVerifyErrors"><?php $anyErrors;?></div>
<?php
switch($comparison_category){
	case "laptops":
		require("Incs/Verify/verifyLaptops.inc.php");
		break;
	case "phones":
		require("Incs/Verify/verifyPhones.inc.php");
		break;
	case "games":
		require("Incs/Verify/verifyGames.inc.php");
		break;
}

}
?>
<input type="hidden" readonly="true" value="<?php echo $comparison_category;?>"  id="verifyCategory"/>
<input type="hidden" readonly="true" value="<?php echo $id;?>"  id="verifyId"/>
<div style="font-size:100px; display:none;" id="changes"></div>


</div>
<?php require('Incs/footer.inc.php');?>
</div>
</div>

</body>
</html>