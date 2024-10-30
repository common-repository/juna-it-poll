<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	global $wpdb;

	$table_name3 = $wpdb->prefix . "juna_it_poll_standart";
	$JIT_Poll_Standart=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id>%d",0));
?>
<form method="POST">
	<div class="JIT_Poll_MainDiv">
		<a href="http://juna-it.com" target="_blank"<abbr title="Click to Visit"><img src="<?php echo plugins_url('/Images/logo-white.png',__FILE__);?>" class="JIT_Poll_Logo"></a>
		<div class="JIT_Poll_SetD1">
			<span class="JIT_Poll_Title_Span">Title:</span> 
			<input type="text"   class="JIT_Poll_Search_Field" id="JIT_Poll_Search_Title" onclick="JIT_Poll_Search_Title_Clicked()" placeholder="Search">
			<input type="button" class="JIT_Poll_Reset_Button" value="Reset" onclick="JIT_Poll_ResetTitle_Button_Clicked()">
			<span class="JIT_Poll_Search_DNE" id="JIT_Poll_Search_TDNE"></span>
		</div>
		<div class="JIT_Poll_SetD2">
			<input type="button" class="JIT_Poll_Title_Cancel" value="Back" onclick="JIT_Poll_Title_Cancel_Clicked()">

			<input type="text" style="display: none;" id="JIT_Poll_HiddenT"    name="JIT_Poll_HiddenT">
			<input type="text" style="display: none;" id="JIT_Poll_HiddenT_ID" name="JIT_Poll_HiddenT_ID"> 
		</div>
	</div>
	<div class="JIT_Poll_Button_Div">
		<a href="http://juna-it.com/index.php/features/elements/juna-it-plugin/" target="_blank"<abbr title="Click to Buy"><div class="JIT_Poll_Full_Version_Image"></div></a>
		<span style="display:block;color:#ffffff;font-size:16px;">This is the free version of the plugin. Click "GET THE FULL VERSION" for more advanced options.</span><br>
		<span style="display:block;color:#ffffff;font-size:16px;margin-top:-15px;"> We appreciate every customer.</span>
	</div>
	<table class="JIT_PollT_Main_Table">
		<tr class="JIT_PollT_Main_Table_FR">
			<td class='JIT_PollT_MID'><B><I>No</I></B></td>
			<td class='JIT_PollT_MTitle'><B><I>Title</I></B></td>
			<td class='JIT_PollT_MType'><B><I>Poll Type</I></B></td>
			<td class='JIT_PollT_MActions'><B><I>Actions</I></B></td>
		</tr>
	</table>
	<table class="JIT_Poll_SetTable">
		<?php for($i=0;$i<count($JIT_Poll_Standart);$i++){
			if($i<5){?>
				<tr>
					<td class='JIT_PollT_ID'><B><I><?php echo $i+1;?></I></B></td>
					<td class='JIT_PollT_Title'><B><I><?php echo $JIT_Poll_Standart[$i]->JIT_Poll_Set_Title;?></I></B></td>
					<td class='JIT_PollT_Type'><B><I><?php echo $JIT_Poll_Standart[$i]->JIT_Poll_Set_Type?></I></B></td>
					<td class='JIT_PollT_Edit' onclick='JIT_Poll_Set_Edit(<?php echo $i+1;?>)'><B><I>Edit</I></B></td>
					<td class='JIT_PollT_Delete1'><B><I>Delete</I></B></td>
				</tr>
		<?php }}?>
	</table>
	<table class='JIT_Poll_SetTable1'></table>
	<div class="JIT_PollT_Type_Div">
		<table class="JIT_PollT_Type_Div_Table">
			<tr>
				<td>Title:</td>
				<td>Select Type:</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="JIT_Poll_Set_Title" id="JIT_Poll_Set_Title" class="JIT_Poll_SetInput" placeholder="Setting Title" required>
				</td>
				<td>
					<select name="JIT_Poll_Set_Type" id="JIT_Poll_Set_Type" onchange="JIT_PollT_Change_Type()">
						<option value="Standart Poll">Standart Poll</option>
						<option value="Pie Chart">Pie Chart</option>
						<option value="Image Poll">Image Poll</option>
						<option value="Video Poll">Video Poll</option>
						<option value="Column Chart">Column Chart</option>
					</select>
				</td>
			</tr>
		</table>			
	</div>
	<img src="<?php echo plugins_url('/Images/standart.png',__FILE__);?>" class="JIT_Poll_Free" id="JIT_Poll_Free_1">
	<img src="<?php echo plugins_url('/Images/pie.png',__FILE__);?>"      class="JIT_Poll_Free" id="JIT_Poll_Free_2">
	<img src="<?php echo plugins_url('/Images/image.png',__FILE__);?>"    class="JIT_Poll_Free" id="JIT_Poll_Free_3">
	<img src="<?php echo plugins_url('/Images/video.png',__FILE__);?>"    class="JIT_Poll_Free" id="JIT_Poll_Free_4">
	<img src="<?php echo plugins_url('/Images/column.png',__FILE__);?>"   class="JIT_Poll_Free" id="JIT_Poll_Free_5">
</form>