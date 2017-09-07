<div class="results_heading_2"style="width:968px; top:10px; left:10px; position:relative;">Create Laptop Comparison</div>
<?php // LATEST
if(strpos($pageURL, "page=")){
	$page_number = substr($pageURL, (strpos($pageURL, "page="))+5);
} else {
	$page_number = 1;
}
if (strpos($pageURL, "choice1=") == true){
	$choice1 = substr($pageURL, (strpos($pageURL, "choice1="))+8, (((strpos($pageURL, "-c1")))-((strpos($pageURL, "choice1="))+8)));
} else {
	$choice1 = null;
}
$Search = false;
$comparison_category = "laptops";
$field = array (
	"Brand",
	"Screen Size",
	"HDD",
	"Resolution",
	"Ram",
	"Processor",
	"Graphics Card");
if($Search == false){
	$x = 0;
	$choice_name = array();
	$choice_pic_name = array();
	$query = "SELECT `id` FROM  `".$comparison_category."` WHERE `verified`='1'";
	$query_run = mysql_query($query);
	$query_num_rows = mysql_num_rows($query_run);
	$noPages = ceil($query_num_rows/$num_comparisons_pp);
	$query = "SELECT * FROM  `".$comparison_category."` WHERE `verified`='1' ORDER BY `time_added` DESC LIMIT ".(($page_number-1)*$num_comparisons_pp).", ".$num_comparisons_pp;
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	while($query_row = mysql_fetch_assoc($query_run)){
		$choice_id[$x] =  $query_row["id"];
		$choice_name[$x] =  $query_row["Name"];
		$choice_pic_name[$x] =  $query_row["pic_name"];
		$x++;
	}
}
require('Incs/Incs/laptops_search.inc.php');
if($search_rows>0){
?>
<div style="float:right; position:relative; top:20px; right:10px;">
<table style="border-collapse:collapse;"><!-- ICONS -->
<?php
for ($x=0;$x<count($choice_id);$x++){
	?>
	<?php if (($x%3)==0){echo "<tr style='z-index:1;'>";}?>
		<td class="tdCreate showDetails" style=" background-color:white;">
			<a href="
			<?php 
			if (strpos($pageURL, "choice1=") !== false){
				echo "new_comparison.php?cat=".$comparison_category."-c&choice1=".$choice1."-c1&choice2=".$choice_id[$x]."-c2";
			} else {
				echo "create.php?cat=".$comparison_category."-c&choice1=".$choice_id[$x]."-c1";
			}
			?>">
			<div class="compBox" style="height:276px;">
				<table  <?php if($choice_id[$x]==$choice1){ echo "id='this_one'"; }?> class="comparison_select tdTableCreate">
					<tr style="text-align:center; z-index:1;">
						<td style="max-width:217px; height:40px;"><?php echo "<span style='color:#4D4D4D; font-size:15px;'>".$choice_name[$x]."</span>"; ?></td>
					</tr>
					<tr style="z-index:1;">
						<td id="pic" style="z-index:1;">
							<?php if($choice_id[$x]!=$choice1){ ?>
							
							<?php } ?>
							<img alt="<?php echo $choice_name[$x]; ?>" src="Pictures/<?php echo ucfirst($comparison_category)."/".$choice_pic_name[$x]; ?>" style="width:217px; background-color:white; z-index:1" />
						</td>
					</tr>
					<tr class="name_details nameDetailsAdj" style="height:200px; margin-top:4px; margin-left:-14px; z-index:3;">
						<td colspan="6" style="border-collapse:collapse;">
							<table style="border-collapse:collapse; border:1px solid RoyalBlue; background-color:white; left:0px;" class="compDetailsTable">
								<?php for ($x2=1;$x2<=(count($field));$x2++){ ?>
								<tr >
									<td class="name_details_td" style="width:100px; max-width:100px; font-size:14px;"> <?php echo $field[$x2-1];?>  </td>
									<td style="width:150px; max-width:150px; background-color:#F6F6F6; font-size:13px; color:#4D4D4D;"><?php echo queryULT($field[$x2-1],$creating_for,"id",$choice_id[$x]);?></td>
								</tr>
							<?php } ?>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<?php if($choice1!=$x){ ?></a><?php } ?>
		</td>
	<?php if ((($x-2)%3)==0){echo "</tr>";}?>
<?php } ?>
</table>
</div>

<?php } else { ?>
<div style="position:relative; top:20px; left:10px; font-size:17px; color:#4D4D4D;">
	Sorry, there are currently no items that match your search. Would you like to 
	<a href="Add_item.php?=<?php echo $comparison_category;?>-c" style="text-decoration:underline; color:#4D4D4D;">Add</a>
	one?
</div>
<?php } ?>

<div style="float:left; position:relative; top:20px; left:10px;">
<table style="background-color:white; width:230px;border-collapse:collapse;" ><!-- SEARCH BAR -->
	<tr>
		<td id="comparison_search">
			<div class="search_nav_heads" id="laptops_search">
				Search
			</div>
		</td>
	</tr>
	<tr>  
		<td>
			<div  id="search_options_laptops" style="border:1px solid #CCCCCC; position:relative;top:-4px; border-top:0;">
				<table>
										
					<form method="GET" action="<?php echo curPageUrl();?>">
						<input type="hidden" readonly="true" name="cat" value="laptops-c" />
						<?php if (strpos($pageURL, "choice1=") !== false){?>
							<input type="hidden" readonly="true" name="choice1" value="<?php echo $choice1."-c1";?>"/>
						<?php } ?>
						<tr>
							<td style="position:relative; left:5px; text-align:center;"><div class="divSearchFields" style="position:relative; left:41px;">Search For A Laptop</div></td>
						</tr>
						<tr>
							<td style="width:209px; height:21px;" id="id_search">
								<div style="position:relative; top:4px; left:4px;">
									<div style="border-radius:5px; border:1px solid #CCCCCC; height:34px; width:210px; background-color:white;">
										<div style="position:relative; top:4px; left:5px;">
											<input type="hidden" readonly="true" name="create" value="1"/>
											<input type="text" name="search" style=" width:199px; height:24px; border:0; outline:none; font-size:15px;" placeholder="Search..."/>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="width:216px; border-bottom:1px solid rgb(72, 187, 95); position:relative; top:7px; left:2px;">
								</div>
							</td>
						</tr>
					</form>
					
					<form method="GET" action="<?php echo curPageUrl();?>">
						<input type="hidden" readonly="true" name="cat" value="laptops-c" />
						<?php if (strpos($pageURL, "choice1=") !== false){?>
							<input type="hidden" readonly="true" name="choice1" value="<?php echo $choice1."-c1";?>"/>
						<?php } ?>
						<?php require("Incs/laptops_searchTable.inc.php");?>
					</form>
				</table>
			</div>
		</td>
	</tr>
</table>
</div>

<?php
if(($noPages!=0)||($pages_search!=0&&$Search==true)){ ?>
<div class="pageNumberPosSearch" style="position:relative; top:20px; z-index:1;"><!-- PAGE NUMBERS -->
	<table class="pageNumberTable">
		<tr>
			<td class="pageText">
				Page
			</td>
			<td>
			<div id="table_scroll_horizontal" > 
				<table class="pageNumbersTable2">
					<tr>
					<?php if($Search == false){ ?>
						<?php for($x=0; $x<$noPages; $x++){?>
							<td class="page_numbers" <?php if(($x+1)==$page_number){ echo "id='selected_page_number'"; }?> >
									
								<div class="pageNumbersPadding">
									<a href="<?php echo pageNumbers($x+1)."&search=".$input;?>"><?php echo ($x+1);?></a>
								</div>
							
							</td>
						<?php } ?>
					<?php } else {?>
						<?php for($x=0; $x<$pages_search; $x++){?>
						<td class="page_numbers" <?php if(($x+1)==$page_number){ echo "id='selected_page_number'"; }?> >
								
							<div class="pageNumbersPadding">	
								<a href="<?php pageNumbers($x+1);?>"><?php echo $x+1;?></a>
							</div>
						
						</td>
						<?php } ?>
					<?php } ?>
					</tr>
				</table>
			</div>
			</td>
		</tr>
	</table>
</div>
<?php } ?>