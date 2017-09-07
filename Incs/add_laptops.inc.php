<?php
	$Options = array(
		"Brand","Brand",
		"Processor","Processor",
		"Screen Size", "Screen_Size",
		"Storage (HDD)", "Storage",
		"Resolution", "Resolution",
		"RAM", "RAM",
		"Graphics Card","Graphics_Card"
	);

	$required_fields = array (
		"Image (1:1)", "pic_name",
		"Source of Image","pic_source",
		"Source of Information", "Source"
	);
	
	$fieldShow = array(
		"Name","Name",
		"Brand","Brand",
		"Processor","Processor",
		"Screen Size", "Screen_Size",
		"Storage (HDD)", "Storage",
		"Resolution", "Resolution",
		"RAM", "RAM",
		"Graphics Card","Graphics_Card"
	);
	
	$error = '';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if (isset($_POST["p_Name"])){
	
		$p_name = $_POST["p_Name"];
		$p_SourceInfo = $_POST["p_Source"];
	
		$name = $_FILES["file_name"]["name"];
		$extension = pathinfo($name, PATHINFO_EXTENSION);
		$size = $_FILES["file_name"]["size"];
		$type = $_FILES["file_name"]["type"];
		$tmp_name = $_FILES["file_name"]["tmp_name"];
		$errorPic = $_FILES["file_name"]["error"];
		$max_size = 20971752;
		$p_pic_source = $_POST["p_pic_source"];
		
		if	(((isset($name)) &&(isset($p_pic_source)) &&(!empty($name)) &&(!empty($p_pic_source)))&&
			((isset($p_name))&&(!empty($p_name)))){
			
			if	(($extension=="jpg"||$extension=="jpeg"||$extension=="png")&&($type=="image/jpeg"||$type=="image/jpg"||$type=="image/png")){
			
				if ($size<=$max_size){
					$location = "Pictures/Laptops/";
					$p_name_pic = str_replace(' ','_',$p_name).time();
					if (move_uploaded_file($tmp_name, $location.$p_name_pic.".".$extension)){
							
						$upd_table = '';
						for ($x=1; $x<count($Options); $x=$x+2){
							if (isset($_POST['p_'.$Options[$x]])){
								$field = mysql_real_escape_string(htmlentities(($_POST['p_'.$Options[$x]])));
								if(!empty($field)){
									$upd_table = $upd_table.",'".$field."'";
								} else {
									$upd_table = $upd_table.",''";
								}
							}
						} 
							
						$query = "INSERT INTO `laptops` 
						(`Name`, `pic_name`,`Picture Source`,`time_added`,`Source`,`category`,`user_added_id`, `user_added`,
						`Brand`, `Processor`, `Screen Size`, `HDD`, `Resolution`, `Ram`, `Graphics Card`) VALUES (
						'".mysql_real_escape_string($p_name)."',
						'".mysql_real_escape_string($p_name_pic.".".$extension)."',
						'".mysql_real_escape_string($p_pic_source)."',
						'".time()."',
						'".mysql_real_escape_string($p_SourceInfo)."',
						'laptops',
						'".$_SESSION['user_id']."',
						'".mysql_real_escape_string($_SESSION['user_username'])."'
						".$upd_table.")";
						
						if(!(mysql_query($query))){
							$error .= "Failed to save. ";
						} else {
							$item_id = queryULT('id','laptops','Name',mysql_real_escape_string($p_name));
							$query2 = "INSERT INTO `pics_of_items` (`category`, `item_name`, `item_id`, `pic_name`, `pic_source`, `time_added`, `user_added`, `user_added_id`) VALUES (
							'laptops',
							'".mysql_real_escape_string($p_name)."',
							'".$item_id."',
							'".mysql_real_escape_string($p_name_pic.".".$extension)."',
							'".mysql_real_escape_string($p_pic_source)."',
							'".time()."',
							'".mysql_real_escape_string($_SESSION['user_username'])."',
							'".$_SESSION['user_id']."')";
							if(mysql_query($query2)){
								$error = $successMessage;
							} else {
								$error.= "Failed to upload items. ";
							}
						}
					} else {
						$error = "Failed to save. Please try again later.";
					}
					
				} else {
					$error =  "The file size is too big. Please pick a different file size.";
				}
			
			} else {
				$error = "Incorrect File type";
			}
		
		} else {
			if((isset($name))&&(!empty($name))){}else{$error.="Image, ";}
			if((isset($p_pic_source))&&(!empty($p_pic_source))){}else{$error.="Source of Image, ";}
			if((isset($p_name))&&(!empty($p_name))){}else{$error.="Name of the item, ";}
			$error .= " had not been set. Please also re-upload the image.";
		}
		
	}
}
	
function the_type ($field){
	if((strpos($field,"pic_name")!==false)||(strpos($field,"icon_img")!==false)){ 
		echo "type='file'"; 
		if(strpos($field,"pic_name")!==false){
			echo "name='file_name'";
		}
		if(strpos($field,"icon_img")!==false){
			echo "name='icon_file_name'";
		}
	} else {
		echo "type='text'";
		echo 'name="p_'.$field.'"';
	}
}

function the_val($field){
	if(@(isset($_POST['p_'.$field]))&&(!empty($_POST['p_'.$field]))){
		echo $_POST['p_'.$field];
	} else { 
		echo "";
	}
}	

$comparison_category = 'laptops';
?>
<div style="position:relative;">
<div class="results_heading_2"style="width:968px; top:10px; left:10px; position:relative;">Add A Laptop</div>
<div style="position:relative; top:20px;">
<div style="float:left; left:10px; position:relative;">
<form action="Add_item.php?=<?php echo $comparison_category;?>-c" method="POST" enctype="multipart/form-data">
	<table style="position:relative;border:1px solid #CCCCCC; border-collapse:collapse; background-color:#F2F2F2; padding:10px;">
		<input type="hidden" readonly="true" value="<?php echo $comparison_category;?>"  id="addCategory"/>
		<tr>
			<td colspan="2" style="padding:3px;padding-left:10px;font-size:17px;">
				Required <div style="display:inline-block; width:575px;" class="reg_log_error"><?php if($error != ''){ echo " - ".$error; } ?></div>
			</td>
		</tr>
		
		<tr style="border:1px solid #CCCCCC; padding:10px;">
			<td style="padding:10px; width:200px;">
				<div class="Add_items_options" style="display:inline-block;" ><?php echo "Name";?> </div>
				<div style="display:inline-block;" id="divAddNameCheckTick">
					<img src="Pictures/Website/tick_2.png" style="height:16px;"/>
				</div>
			</td>
			<td style="padding:10px; width:422px;">
				<input class="input_add" id="add_Name" type="text" name="p_Name">
			</td>
		</tr>
		<tr style="border:1px solid #CCCCCC; padding:10px;" id="trAddNameCheck">
			<td colspan="2" style="padding:10px; width:200px;">
				<table>
					<tr>
						<td class="Add_items_options" style="vertical-align:text-top; width:195px;">
							Does this item already exist?
						</td>
						<td>
							<table>
								<div id="divAddNameCheckTablePossibilities" style="width:422px; position:relative; left:20px; text-overflow: ellipsis">
								</div>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
			
		<?php for ($x=1;$x<=((count($required_fields)));$x+=2){?>
		<tr style="border:1px solid #CCCCCC; padding:10px;">
			<td style="padding:10px; width:200px;">
				<div class="Add_items_options" ><?php echo $required_fields[$x-1]?> </div>
			</td>
			<td style="padding:10px; width:422px;">
				<input class="input_add" 
				id="add_<?php echo $required_fields[$x];?>"
				<?php the_type($required_fields[$x]);?>
				<?php if ($error != $successMessage) {?>
					value="<?php the_val($required_fields[$x]);?>"
				<?php } ?>
				<?php if(strpos($required_fields[$x],"pic_name")!==false){echo "id='image';";}?>>
			</td>
		</tr>
			<?php }?>
		</table>
		
		<table  style="position:relative; top:12px; border:1px solid #CCCCCC; border-collapse:collapse; background-color:#F2F2F2; padding:10px;">
			<tr>
				<td colspan="2" style="padding:3px;padding-left:10px;font-size:17px;">
					Optioinal
				</td>
			</tr>
			
			<?php for ($x=1;$x<=((count($Options)));$x+=2){?>
			<tr style="border:1px solid #CCCCCC; padding:10px;">
				<td style="padding:10px; width:200px;">
					<div class="Add_items_options" ><?php echo $Options[$x-1]?> </div>
				</td>
				<td style="padding:10px; width:422px;;">
					<input class="input_add" id="add_<?php echo $Options[$x];?>" 
					<?php the_type($Options[$x]);?>
					<?php if ($error != $successMessage) {?>
						value="<?php the_val($Options[$x]);?>"
					<?php } ?>>
				</td>
			</tr>
			<?php }?>
			
			<tr>
				<td colspan="2" style="padding:10px; text-align:right;">
					<input  type="submit" name="submit" value="SEND!">
				</td>
			</tr>
	</table>
</form>
</div>

<div style="float:right; right:10px; position:relative">
	<table style="margin-left:auto; margin-right:auto;border-collapse:collapse; border:1px solid #CCCCCC;">
		<tr>
			<td style="text-align:center; color:#4D4D4D; font-size:18px; padding-top:10px;">
				Laptop Image (1:1)
			</td>
		</tr>
		<tr>
			<td style="padding:12px;">
				<div style="height:280px; width:280px; border:1px solid #CCCCCC;">
					<div style=" position:relative; height:280px; width:280px; display:table-cell; vertical-align: middle; horizontal-align:middle; text-align:center;">
						<img id="img_chosen" style="max-height:280px; max-width:280px;">
					</div>
				</div>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;">
				<table style="border-collapse:collapse; border-spacing:0;">
					<?php for ($x2=0;$x2<(count($fieldShow));$x2+=2){ ?>
						<tr style="border-collapse:collapse; color:#4D4D4D; border-top:1px solid #CCCCCC;">
							<td style="width:80px; max-width:80px;border-collapse:collapse; padding:10px;"> <?php echo $fieldShow[$x2];?>  </td>
							<td style="width:180px; max-width:180px;border-collapse:collapse;padding:10px;" id="display_add_<?php echo $fieldShow[$x2+1];?>"></td>
						</tr>
					<?php } ?>
				</table>
			</td>
		</tr>
	</table>
</div>
</div>
</div>