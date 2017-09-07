<!doctype html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="Incs/template.css"/>
<title>
WhichToPick: Login/SignUp
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
<div id="content">
<?php
@$pageURL = curPageUrl();
@$previous_page = substr($pageURL, (strpos($pageURL, "prev_page="))+10, (((strpos($pageURL, "-finish")))-((strpos($pageURL, "prev_page="))+10)));
require ("Incs/register.inc.php");
$problem = 0;
if((strlen($previous_page)==0)||$previous_page=='loginform.php'){
	$previous_page = 'index.php';
}
if (isset($_POST["email"])&&isset($_POST["password"])){
	$email = mysql_real_escape_string($_POST["email"]);
	$password = $_POST["password"];
	$password_hash = md5($password);
	if (!empty($email)&&!empty($password)){
		$query = "SELECT `id`,`username`,`firstname` FROM `users` WHERE `email`= '".$email."' AND `password` = '".$password_hash."'";
		if ($query_run = mysql_query($query)){
			$query_num_rows = mysql_num_rows($query_run);
			if ($query_num_rows==0){
				$problem =  "Invalid e-mail/password";
			} else if ($query_num_rows==1){
				$user_id = mysql_result($query_run, 0, 'id');
				$user_username = mysql_result($query_run, 0, 'username');
				$user_firstname = mysql_result($query_run, 0, 'firstname');
				$_SESSION['user_id'] = $user_id;
				$_SESSION['user_username'] = $user_username;
				$_SESSION['user_firstname'] = $user_firstname;
				header("LOCATION: ".$previous_page);//whichtopick.com/ -> use script
			} else {
				$problem =  "A problem has occured, please try again later";
			}
		}
	} else {
		$problem = "You must supply an e-mail and password";
	}
}
?>

<div style="width:485px; position:relative; left:10px; top:10px; float:left;">
<form action="<?php echo $pageURL;?>" method="POST" enctype="multipart/form-data" id="reg_table">
<table style="position:relative; margin:auto; width:465px;">
<tr>
	<td id="reg_heading" style="border-bottom:1px solid #CCCCCC; padding:10px;">
		<span class="reg_log_headings">Registration</span>
	</td>
</tr>
<tr>
	<td  style="padding-top:10px; padding-bottom:10px;">
		<table>
		
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					Firstname:
				</td>
				<td  style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input class="i reg_i" type="text" name="reg_firstname" value="<?php if (isset ($firstname)){ echo $firstname;} else { echo "";} ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">
				</td>
			</tr>
			
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					Lastname:
				</td>
				<td  style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input class="i reg_i" type="text" name="reg_surname" value="<?php if (isset ($surname)){ echo $surname;} else { echo "";} ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">
				</td>
			</tr>
			
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					E-mail:
				</td>
				<td style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input id="signup_email" class="i reg_i" type="text" name="reg_email" value="<?php if (isset ($reg_email)){ echo $reg_email;} else { echo "";} ?>">
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<div id="email_check"></div>
				</td>
			</tr>
			
			<tr>
				<td  style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					Username:
				</td>
				<td style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input id="signup_username"class="i reg_i" type="text" name="reg_username" value="<?php if (isset ($username)){ echo $username;} else { echo "";}?>">
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="1">
					<div id="username_check"></div>
				</td>
			</tr>
			
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					Password:
				</td>
				<td style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input id="signup_password"class="i reg_i" type="password"name="reg_password">
				</td>
			</tr>
			<tr>
				<td colspan="2">
				</td>
			</tr>
			
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					Confirm Password:
				</td>
				<td style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input id="signup_password_again"class="i reg_i" type="password"name="reg_password_again" style="">
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<div id="password_again_check"></div>
				</td>
			</tr>
			
			<tr>
				<td colspan="2" style="text-align:right; cursor:pointer;">
					<div id="reg_button" class="reg_log_buttons">
						Register
					</div>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</form>
</div>

<div style="height:400px; position:relative; float:left; left:14px; top:10px; background-color:#CCCCCC; width:1px;">
</div>

<div style="width:485px; position:relative; right:10px;top:10px; float:right;">
<form action="<?php echo $pageURL;?>" method="POST" id="log_table">
<table style="position:relative; margin:auto;  width:465px;">
<tr>
	<td id="log_heading"style="padding:10px; font-size:20px; color:#4D4D4D; border-bottom:1px solid #CCCCCC;">
		<span class="reg_log_headings">Login</span><span class="reg_log_error"><?php if($problem != '0'){ echo " - ".$problem; } ?></span>
	</td>
</tr>
<tr>
	<td style="padding-top:10px; padding-bottom:10px;">
		<table>
			
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					E-mail:
				</td>
				<td style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;"> 
					<input class="i log_i" type="text" name="email"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				</td>
			</tr>
			
			<tr>
				<td style="color:#404040; text-align:right; padding:10px; padding-top:5px; padding-bottom:10px;">
					Password:
				</td>
				<td style="color:#404040; text-align:right; padding:0px; padding-top:5px; padding-bottom:10px;">
					<input class="i log_i" type="password" name="password"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<div id="log_button" class="reg_log_buttons">
						Login
					</div>
				</td>
			</tr>
			<?php $problem=0;if($problem != '0'){?>
			<tr>
				<td colspan="2"style="color:red; font-size:14px;">
					<?php echo $problem; ?>
				</td>
			</tr>
			<?php } ?>
		</table>
	</td>
</tr>
</table>
</form>
</div>


</div>

</div>
</div>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/jq_signup.js"></script>
</body>
</html>