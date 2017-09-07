<?php
#require	("Incs/sessionStart.inc.php");
require ("Incs/connect.inc.php");
require ("Incs/core.inc.php");

@$pageURL = curPageUrl();
if (strpos($pageURL, "prev_page=") == false){
	@$pageURL = curPageUrl()."-finish";
	
	#@$prev_page = substr($pageURL, (strpos($pageURL, "whichtopick.com/"))+16, (((strpos($pageURL, "-finish")))-((strpos($pageURL, "whichtopick.com/"))+16))); WHEN NOT ONLINE
	@$prev_page = substr($pageURL, (strpos($pageURL, "whichtopick.com/"))+16, (((strpos($pageURL, "-finish")))-((strpos($pageURL, "whichtopick.com/"))+16)));
	@$prev_page = $prev_page."-finish";
} else {
	@$prev_page = substr($pageURL, (strpos($pageURL, "prev_page="))+10, (((strpos($pageURL, "-finish")))-((strpos($pageURL, "prev_page="))+10)));
	@$prev_page = $prev_page."-finish";
}

if(isset($_GET['search_choice'])){
	$search_choice_chosen = $_GET['search_choice'];
} else {
	$search_choice_chosen = 'category';
}
?>
<div style="position:absolute;">
<div style="position:absolute; top:0px; height:30px; width:1000px; background-color:#4F4F4F;"></div>
<table style="position:absolute; top:3px; left:500px;max-height:40px; width:500px; background-color:#4F4F4F; border-collapse:collapse;">
		<tr>
			<?php if(loggedin()){?>
				<td class="header_nav"style=" border-right:1px solid #CCCCCC; border-left:1px solid #CCCCCC; text-align:center;">
					<a href="user.php?=<?php echo $_SESSION['user_username'];?>-view-user" style=" text-decoration:none;">
						<div  style="padding-left:10px; padding-right:10px;font-size:15px; text-decoration:none; color:white;">
							<?php echo "Hello ". $_SESSION['user_username'];?>
						</div>
					</a>
				</td>
			<?php } else { ?>
				<td class="header_nav" style="border-right:1px solid #CCCCCC; border-left:1px solid #CCCCCC; text-align:center;">
					<a href="loginform.php?prev_page=<?php echo $prev_page;?>" style=" text-decoration:none;">
						<div style="padding-left:10px; padding-right:10px;font-size:15px; color:white;">
							Login
						</div>
					</a>
				</td>
				<td class="header_nav" style="border-right:1px solid #CCCCCC; border-left:1px solid #CCCCCC; text-align:center;">
					<a href="loginform.php?prev_page=<?php echo $prev_page;?>" style=" text-decoration:none;">
						<div style="padding-left:10px; padding-right:10px;font-size:15px; text-decoration:none; color:white;">
							Sign Up
						</div>
					</a>
				</td>
			<?php } ?>
		</tr>
</table>
<div class="fadingBackground"></div>
<table id="top_nav" style="position:relative; top:50px; over-flow:auto; border-collapse:collapse; margin-left:-1px; margin-right:-1px;">
		<tr >
			<td class="templateTop_NavTd" id="id_WO2"><a class="top_nav2"href="index.php"><div class="templateAExpander">Home</div></a></td> 
			<td class="templateTop_NavTd" id="id_laptops2"><a class="top_nav2" href="laptops.php"><div class="templateAExpander">Laptops</div></a></td> 
			<td class="templateTop_NavTd" id="id_games2"><a class="top_nav2"href="games.php"><div class="templateAExpander">Games</div></a></td> 
			<td class="templateTop_NavTd" id="id_phones2"><a class="top_nav2"href="phones.php"><div class="templateAExpander">Phones</div></a></td> 
			<td class="templateTop_NavTd" id="id_search2">
				<form action="search.php" method="GET" id="search_top_form">
					<div style="width:310px;">
						<div style="width:270px; height:29px; border:1px solid #CCCCCC; background-color:white; border-radius:5px; position:relative; left:20px;">
							<div style="position:relative; top:5px; left:5px; width:17px; display:inline-block;">
								<img src="Pictures/Website/search.png" height="14"/>
								<input type="hidden" readonly="true" value="<?php echo $search_choice_chosen;?>"  name="search_choice"/>
								<input type="hidden" readonly="true" value="1" name="page"/>
							</div>
							<div style="display:inline-block; position:relative; top:5px;">
								<input type="text" name="search" class="search_bar" id="search_bar_top" style="font-size:15px;"placeholder="Search...">
							</div>
						</div>
					</div>
				</form>
			</td>
		</tr>
</table>
</div>
</div>