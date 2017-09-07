<?php if($_SESSION['user_username']=='ADMIN'){ ?>
<div id="tableContainerChange">
<table class="tableVerifyChange">
	<tr>
		<td>
			<table>
				<tr>
					<td> <!-- SMALL ICON IMAGE CHANGE -->
						<div id="change3">
						<form action="#" method="POST" enctype="multipart/form-data">
						<table>
							<tr>
								<td colspan="2">
									<div id="changeIcon">
										<div id="changeIcon1">
											<img  src="<?php echo "Pictures/".ucfirst($comparison_category)."/".$pic_name;?>" style="max-height:256px; max-width:256px; background-color:white;">
										</div>
										<div id="changeIcon2">
											<img id="img_chosen_iconBig" style="max-height:256px; max-width:256px; background-color:white;">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div style="width:129px; height:129px; background-color:#868686;" class="changeSmallIconHighlight">
										<div id="changeSmallIcon1" class="changeSmallHighlight" >
											<img  id="changeImgIcon1" src="<?php echo "Pictures/".ucfirst($comparison_category)."/".$pic_name;?>" style="position:relative; top:5px; left:5px;width:117px; height:117px; border:1px solid #CCCCCC; background-color:white;">
										</div>
									</div>
								</td>
								<td>
									<div style="width:129px; height:129px; position:relative; left:-2px;" class="changeSmallIconHighlight">
										<div id="changeSmallIcon2" class="changeSmallHighlight" style="height:117px; width:117px; border:1px solid #CCCCCC; position:relative; left:5px; top:5px;">
											<div style=" position:relative; height:117px; width:117px; horizontal-align:middle; text-align:center;background-color:#F5F5F5;">
												<img id="img_chosen_icon" style="max-height:117px; max-width:117px; background-color:white;">
											</div>
										</div>
									<div/>
								</td>
							</tr>
							<tr>
								<td>
									<div style="height:50px; position:relative; top:2px; left:3px;">
										<input class="input_add" id="add_icon_name" type='file'name='file_icon_name' value="" style="width:125px;">
									</div>
								</td>
								<td>
									<div style="position:relative; left:1px; top:-10px;">
										<input  type="submit" name="submit" value="SEND!">
									</div>
								</td>
							</tr>
						</table>
						</form>
						</div>
					</td> <!-- SMALL ICON IMAGE CHANGE END -->
					<td style="vertical-align:text-top;">
						<div style="position:relative; top:13px; left:13px; ">
							<div style="height:390px;">
								<div class="vertical_scroll" style="height:380px;"><!-- CHANGE HEIGHT TAKING INTO ACCOUNT DELETE AND VERIFY BUTTONS -->
								<table style="position:relative; border:1px solid #CCCCCC; background-color:white;">
									<?php for($x=0; $x<count($field); $x++) {?>
									<tr style="border-bottom:1px solid #CCCCCC; background-color:#FFFFFF;">
										<td style="width:130px; background-color:#FFFFFF; height:32px;" <?php if ($field[$x]=="Name"){?> id="tdNameChangeVerifyExtra"<?php } ?>>
											<div style="position:relative; left:10px;">
											<?php
											if($field[$x]!='Name'){
												if($field[$x]=='Source' || $field[$x]=='Picture Source'){
													echo "<a href='".$options[$x]."' tagert='_blank'>".$field[$x]."</a>";
												} else {
													echo $field[$x];
												}
											} else {
											?> <!-- CHECK TO SEE IF ITEM BEING VERIFIED ALREADY EXISTS, OR STILL NEEDS TO BE VERIFIED! -->
											<table>
												<tr>
													<td class="Add_items_options" style="vertical-align:text-top; width:195px;" id="verifyNameChanger">
														Name
													</td>
												</tr>
												<tr>
													<td colspan="2"class="Add_items_options" style="vertical-align:text-top; width:195px;">
														<table>
															<?php echo $possibleNames;?>
														</table>
													</td>
												</tr>
											</table>
											<?php }?>
											</div>
										</td>
										<td class="changeInfo" style="vertical-align:text-top;">
											<?php if ($field[$x]=="Name"){?>
											<table>
											<tr>
												<td>
													<div class='verifyInputWrapper'><div class='verifyTheInput sameLine'><?php echo htmlentities($options[$x]);?></div></div>
												</td>
											</tr>
											<tr id="trAddNameCheck">
												<td colspan="2" style="width:200px;">
													<table style="border:1px solid #CCCCCC; width:550px;" >
														<tr>
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
											</table>
											<?php } else {?>
											<div class='verifyInputWrapper'><div class='verifyTheInput sameLine'><?php echo htmlentities($options[$x]);?></div></div>
											<?php } ?>
										</td>
									</tr>
									<?php } ?>
								</table>
								</div>
							</div>
							<div style="float:right;">
								<div class="alreadyMade" style="display:inline-block;">
									<div style="display:inline-block">
										<input type="text" id="alreadyMadeUrl" style="width:400px;"/>
									</div>
									<div class="alreadyMadeSend">
										Already Made
									</div>
								</div>
								<div class="delete">Delete</div>
								<div class="verify">Verify</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>
<?php } ?>
<script type="text/javascript" src="Incs/jquery.js"></script>
<script type="text/javascript" src="Incs/jqcode.js"></script>
<script type="text/javascript" src="Incs/Verify/jq_changeNoIcon.js"></script>