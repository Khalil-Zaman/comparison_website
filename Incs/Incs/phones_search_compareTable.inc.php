<tr>
	<td style="text-align:center; font-size:18px; color:#4d4d4d; height:29px; width:209px;">
		<div style="position:relative; top:5px;">
		Choice 1
		</div>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Brand</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Brand_Choice_1" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Brand);$x++){?>
		<option value="<?php echo $phones_Brand[$x-1]?>"><?php echo $phones_Brand[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Display</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Display_Choice_1" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Display);$x++){?>
		<option value="<?php echo $phones_Display[$x-1]?>"><?php echo $phones_Display[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Internal Storage</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Internal_Storage_Choice_1" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Internal_Storage);$x++){?>
		<option value="<?php echo $phones_Internal_Storage[$x-1]?>"><?php echo $phones_Internal_Storage[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Front Camera</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Front_Camera_Choice_1" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Front_Camera);$x++){?>
		<option value="<?php echo $phones_Front_Camera[$x-1];?>"><?php echo $phones_Front_Camera[$x-1];?></option>
		<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Rear Camera</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Rear_Camera_Choice_1" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Rear_Camera);$x++){?>
		<option value="<?php echo $phones_Rear_Camera[$x-1];?>"><?php echo $phones_Rear_Camera[$x-1];?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="text-align:center; font-size:14px; color:#4d4d4d; height:30px; width:209px;">
		<div style="position:relative; top:3px;">
		VS
		</div>
	</td>
</tr>

<tr>
	<td style="text-align:center; font-size:18px; color:#4d4d4d; height:29px; width:209px;">
		<div style="position:relative; top:5px;">
		Choice 2
		</div>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Brand</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Brand_Choice_2" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Brand);$x++){?>
		<option value="<?php echo $phones_Brand[$x-1]?>"><?php echo $phones_Brand[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Display</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Display_Choice_2" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Display);$x++){?>
		<option value="<?php echo $phones_Display[$x-1]?>"><?php echo $phones_Display[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Internal Storage</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Internal_Storage_Choice_2" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Internal_Storage);$x++){?>
		<option value="<?php echo $phones_Internal_Storage[$x-1]?>"><?php echo $phones_Internal_Storage[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Front Camera</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Front_Camera_Choice_2" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Front_Camera);$x++){?>
		<option value="<?php echo $phones_Front_Camera[$x-1];?>"><?php echo $phones_Front_Camera[$x-1];?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Rear Camera</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Rear_Camera_Choice_2" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Rear_Camera);$x++){?>
		<option value="<?php echo $phones_Rear_Camera[$x-1];?>"><?php echo $phones_Rear_Camera[$x-1];?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<input type="hidden" readonly="true" value="<?php echo "1";?>" name="page"/>
<tr>
	<td style="text-align:right; position:relative; left:7px;">
		<input type="submit" value="Go"/>
	</td>
</tr>