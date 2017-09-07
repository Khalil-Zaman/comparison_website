<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Brand</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Brand_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Brand);$x++){?>
		<option value="<?php echo $phones_Brand[$x-1]?>"><?php echo $phones_Brand[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr >
	<td style="position:relative; left:5px;"><div class="divSearchFields">Display</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Display_Choice" style="width:209px;">
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
	<select name="phones_Internal_Storage_Choice" style="width:209px;">
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
	<select name="phones_Front_Camera_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Front_Camera);$x++){?>
		<option value="<?php echo $phones_Front_Camera[$x-1]?>"><?php echo $phones_Front_Camera[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Rear Camera</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="phones_Rear_Camera_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($phones_Rear_Camera);$x++){?>
		<option value="<?php echo $phones_Rear_Camera[$x-1]?>"><?php echo $phones_Rear_Camera[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>
	
<input type="hidden" readonly="true" value="1" name="page"/>
<tr>
	<td style="text-align:right; left:8px; position:relative;">
		<input type="submit" value="Go"/>
	</td>
</tr>