<?php
if (isset($_FILES["user_pic_name"]["name"])){
$name = $_FILES["user_pic_name"]["name"];
$extension = strtolower(substr($name, strpos($name, ".") +1));
$size = $_FILES["user_pic_name"]["size"];
$type = $_FILES["user_pic_name"]["type"];
$tmp_name = $_FILES["user_pic_name"]["tmp_name"];
$error = $_FILES["user_pic_name"]["error"];
$max_size = 20971752;
	if (($extension=="jpg"||$extension=="jpeg"||$extension=="png")){
		if (($type=="image/jpeg"||$type=="image/jpg"||$type=="image/png"||$type=="image/pjpeg"||$type=="image/x-png"||$type=="image/gif")){
			if ($size<=$max_size){
				$location = "Pictures/Users/dp_pics/";
				$pic_user = $_SESSION['user_username'];
				$no_times = queryULT('no_dp_changed','users','username',$_SESSION['user_username']);
				
				$filename = $tmp_name;
				$dest_image = $location.$pic_user."_profilepic_".$no_times.'_'.$name;
				 
				// Get dimensions of the original image
				list($current_width, $current_height) = getimagesize($filename);
				
				// The x and y coordinates on the original image where we
				// will begin cropping the image
				
				$left = queryULT('dp_x1','users','username',$pic_user);
				$top = queryULT('dp_y1','users','username',$pic_user);
				 
				// This will be the final size of the image (e.g. how many pixels
				// left and down we will be going)
				
				$crop_width = (queryULT('dp_x2','users','username',$pic_user))-$left;
				$crop_height = $crop_width;
				
				// Resample the image
				$canvas = imagecreatetruecolor($crop_width, $crop_height);
				if($extension == 'png'){
					$current_image = imagecreatefrompng($filename);
					imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
					imagepng($canvas, $dest_image,0);
				} else if ($extension=="jpg"||$extension=="jpeg"){
					$current_image = imagecreatefromjpeg($filename);
					imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
					imagejpeg($canvas, $dest_image, 100);
				}
				
				
				$query = "UPDATE `users` SET `pic_file`='".$name."' WHERE `username`='".$_SESSION['user_username']."'"; 
				if (mysql_query($query)){
					//echo "Your new profile pic has been set ".$type;
				} else {
					echo "Unable to save your profile picture at the current time. Please try again later.";
				}
				
			} else {
				echo "The file size is too big.";
			}
		} else {
			echo "Sorry, filetype isnt recognized. ".$type." ".$error;
		}
	}
} 
?>

<table style="border-collapse:collapse; border-right:1px solid #CCCCCC;">
	<tr>
		<td rowspan=1 colspan="2" style="padding:10px 10px 10px 9px; border:1px solid #CCCCCC; background-color:#DBDBDB;">
				
			
				<img id="dp_before"src="Pictures/Users/<?php users_pic($username);?>" height="230"/>
			
				
				<div id="dp_display_conatiner" style="position:absolute; width:230px; height:230px; background-color:#CCCCCC;margin-top:-235px;">
					<img id="profile_display" style="position:absolute; width:100%; height:100%;" >
				</div>
		
		</td>
	</tr>
	<tr>
		<td colspan="2" style="border-bottom:1px solid #CCCCCC; padding-left:10px; padding-right:10px; padding-top:5px; badding-bottom:5px; text-align:center;">
			<?php echo $username;?>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					Total Points
				</div>
			</div>
		</td>
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					<?php echo $points;?>
				</div>
			</div>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					Items added
				</div>
			</div>
		</td>
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					<?php echo $no_items;?>
				</div>
			</div>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					Comparisons Made
				</div>
			</div>
		</td>
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					<?php echo $no_comparisons;?>
				</div>
			</div>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">		
		<td>
			<div class="Div_manageAccountProfile" >
				<div class="Div_manageAccountProfileContainer" >
					Date Joined
				</div>
			</div>
		</td>
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >	
					<?php echo date('d-m-Y',strtotime($time_joined));?>
				</div>
			</div>
		</td>
	</tr>
	<tr style="border-bottom:1px solid #CCCCCC;">
		<td>
			<div class="Div_manageAccountProfile">
				<div class="Div_manageAccountProfileContainer" >
					Likes
				</div>
			</div>
		</td>
		<td>
			<div class="Div_manageAccountProfile" >
				<div class="Div_manageAccountProfileContainer" >
					<?php echo $likes;?>
				</div>
			</div>
		</td>
	</tr>	
</table>
<div style="position:absolute; top:0px; left:250px; width:750px; background-color:#CCCCCC; height:473px;">
	<div id="container_dp" style="position:relative; margin-left:auto; margin-right:auto;">
		<img id="img_chosen" style="position:absolute; max-height:446px; max-width:750px;" />
		<img id="img_chosen_back" style="opacity:0.4; position:absolute; max-height:446px; max-width:750px;"/>
		<div id="selector"></div>
	</div>
	<div style="background-color:#A8A8A8; position:absolute; top:445px; height:27px; width:750px; left:0px;">
		<form action="<?php echo curPageURL();?>" id="dp_pic_form"method="POST" enctype="multipart/form-data" >
			<input type="file" id="change_pic_profile" name="user_pic_name" style="position:absolute; left:10px;"/>
			<input type="button" value="Save" onclick="pic_change()" style="position:absolute; right:10px;"/>
		</form>
	</div>
</div>

<img id="unchanged_pic" style="opacity:0;"/>