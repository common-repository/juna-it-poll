<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	global $wpdb;	
	wp_enqueue_media();
	wp_enqueue_script( 'custom-header' );
	add_filter( 'upload_size_limit', 'PBP_increase_upload' );
	function PBP_increase_upload(  )
	{
	 	return 2048000000; //2GB
	}
	$table_name  = $wpdb->prefix . "juna_it_poll_manager";
	$table_name1 = $wpdb->prefix . "juna_it_answer_manager";
	$table_name3 = $wpdb->prefix . "juna_it_poll_standart";
	$table_name4 = $wpdb->prefix . "juna_it_poll_results";

	if(isset($_POST['JIT_Poll_Add_Save']))
	{
		$JIT_Poll_Question1 = explode('\"', sanitize_text_field($_POST['JIT_Poll_Question']));
		$JIT_Poll_Question2 = implode('*^*', $JIT_Poll_Question1);
		$JIT_Poll_Question3 = explode("\'", $JIT_Poll_Question2);
		$JIT_Poll_Question  = implode("*&*", $JIT_Poll_Question3);

		$JIT_Poll_QCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d",0));

		$JITPQcount=0;

		for($i=0;$i<count($JIT_Poll_QCount);$i++)
		{
			$JIT_Poll_Q_split=explode(' (', $JIT_Poll_QCount[$i]->JIT_Poll_Question);
			if($JIT_Poll_Q_split[0]==$JIT_Poll_Question)
			{
				$JITPQcount++;
			}
		}

		if($JITPQcount==0)
		{
			$JIT_Poll_Question=$JIT_Poll_Question;
		}
		else
		{
			$JIT_Poll_Question=$JIT_Poll_Question .' ('. $JITPQcount .')';
		}

		$JIT_Poll_Type=sanitize_text_field($_POST['JIT_Poll_Type']);
		$JIT_Poll_Setting=sanitize_text_field($_POST['JIT_Poll_Setting']);
		$JIT_PollAns_Count=sanitize_text_field($_POST['JIT_PollAns_Count']);

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name (id, JIT_Poll_Question, JIT_Poll_Type, JIT_Poll_Setting, JIT_PollAns_Count) VALUES (%d, %s, %s, %s, %s)", '', $JIT_Poll_Question, $JIT_Poll_Type, $JIT_Poll_Setting, $JIT_PollAns_Count));

		$JIT_Poll_number=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE JIT_Poll_Question=%s ", $JIT_Poll_Question));

		if($JIT_PollAns_Count!=0)
		{
			for($i=1;$i<=$JIT_PollAns_Count;$i++)
			{
				$JIT_Poll_Ans1 = explode('\"', sanitize_text_field($_POST['JIT_Poll_Ans_'.$i]));
				$JIT_Poll_Ans2 = implode(')*^*(', $JIT_Poll_Ans1);
				$JIT_Poll_Ans3 = explode("\'", $JIT_Poll_Ans2);
				$JIT_Poll_Ans  = implode(")*&*(", $JIT_Poll_Ans3);

				$JIT_Poll_UpMedia=sanitize_text_field($_POST['JIT_Poll_UpMedia_'.$i]);
				$JIT_Poll_Col=sanitize_text_field($_POST['JIT_Poll_Col_'.$i]);

				if($JIT_Poll_Col=='')
				{
					$JIT_Poll_Col='#ffffff';
				}

				$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, JIT_Poll_Ans, JIT_Poll_UpMedia, JIT_Poll_Col, JIT_Poll_id) VALUES (%d, %s, %s, %s, %s)", '', $JIT_Poll_Ans, $JIT_Poll_UpMedia, $JIT_Poll_Col, $JIT_Poll_number));
				$JIT_Poll_Ans_ID=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name1 WHERE JIT_Poll_Ans=%s order by id desc limit 1", $JIT_Poll_Ans));

				$wpdb->query($wpdb->prepare("INSERT INTO $table_name4 (id, JIT_Q_ID, JIT_A_ID, JIT_Poll_Votes) VALUES (%d, %d, %d, %d)", '', $JIT_Poll_number, $JIT_Poll_Ans_ID, 0));
			}
		}
	}
	else if(isset($_POST['JIT_Poll_Add_Update']))
	{
		$JIT_Poll_HiddenQ_ID=sanitize_text_field($_POST['JIT_Poll_HiddenQ_ID']);

		$JIT_Poll_Question1 = explode('\"', sanitize_text_field($_POST['JIT_Poll_Question']));
		$JIT_Poll_Question2 = implode('*^*', $JIT_Poll_Question1);
		$JIT_Poll_Question3 = explode("\'", $JIT_Poll_Question2);
		$JIT_Poll_Question  = implode("*&*", $JIT_Poll_Question3);

		$JIT_Poll_Type=sanitize_text_field($_POST['JIT_Poll_Type']);
		$JIT_Poll_Setting=sanitize_text_field($_POST['JIT_Poll_Setting']);
		$JIT_PollAns_Count=sanitize_text_field($_POST['JIT_PollAns_Count']);

		$JIT_Poll_HiddenQ=sanitize_text_field($_POST['JIT_Poll_HiddenQ']);

		$JIT_Poll_HiddenQ1 = explode('\"', sanitize_text_field($_POST['JIT_Poll_HiddenQ']));
		$JIT_Poll_HiddenQ2 = implode('*^*', $JIT_Poll_HiddenQ1);
		$JIT_Poll_HiddenQ3 = explode("\'", $JIT_Poll_HiddenQ2);
		$JIT_Poll_HiddenQ  = implode("*&*", $JIT_Poll_HiddenQ3);

		$JIT_Poll_QCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d",0));

		$JITPQcount=0;

		if($JIT_Poll_Question!=$JIT_Poll_HiddenQ)
		{
			for($i=0;$i<count($JIT_Poll_QCount);$i++)
			{
				$JIT_Poll_Q_split=explode(' (', $JIT_Poll_QCount[$i]->JIT_Poll_Question);
				if($JIT_Poll_Q_split[0]==$JIT_Poll_Question)
				{
					$JITPQcount++;
				}
			}
		}		

		if($JITPQcount==0)
		{
			$JIT_Poll_Question=$JIT_Poll_Question;
		}
		else
		{
			$JIT_Poll_Question=$JIT_Poll_Question .' ('. $JITPQcount .')';
		}

		$wpdb->query($wpdb->prepare("UPDATE $table_name set JIT_Poll_Question=%s, JIT_Poll_Type=%s, JIT_Poll_Setting=%s, JIT_PollAns_Count=%s WHERE id=%d", $JIT_Poll_Question, $JIT_Poll_Type, $JIT_Poll_Setting, $JIT_PollAns_Count, $JIT_Poll_HiddenQ_ID));

		$wpdb->query($wpdb->prepare("DELETE FROM $table_name1 WHERE JIT_Poll_id=%d", $JIT_Poll_HiddenQ_ID));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name4 WHERE JIT_Q_ID=%d", $JIT_Poll_HiddenQ_ID));

		if($JIT_PollAns_Count!=0)
		{
			for($i=1;$i<=$JIT_PollAns_Count;$i++)
			{
				$JIT_Poll_Ans1 = explode('\"', sanitize_text_field($_POST['JIT_Poll_Ans_'.$i]));
				$JIT_Poll_Ans2 = implode(')*^*(', $JIT_Poll_Ans1);
				$JIT_Poll_Ans3 = explode("\'", $JIT_Poll_Ans2);
				$JIT_Poll_Ans  = implode(")*&*(", $JIT_Poll_Ans3);

				$JIT_Poll_UpMedia=sanitize_text_field($_POST['JIT_Poll_UpMedia_'.$i]);
				$JIT_Poll_Col=sanitize_text_field($_POST['JIT_Poll_Col_'.$i]);

				if($JIT_Poll_Col=='')
				{
					$JIT_Poll_Col='#ffffff';
				}

				$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, JIT_Poll_Ans, JIT_Poll_UpMedia, JIT_Poll_Col, JIT_Poll_id) VALUES (%d, %s, %s, %s, %s)", '', $JIT_Poll_Ans, $JIT_Poll_UpMedia, $JIT_Poll_Col, $JIT_Poll_HiddenQ_ID));
				$JIT_Poll_Ans_ID=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name1 WHERE JIT_Poll_Ans=%s order by id desc limit 1", $JIT_Poll_Ans));

				$wpdb->query($wpdb->prepare("INSERT INTO $table_name4 (id, JIT_Q_ID, JIT_A_ID, JIT_Poll_Votes) VALUES (%d, %d, %d, %d)", '', $JIT_Poll_HiddenQ_ID, $JIT_Poll_Ans_ID, 0));
			}
		}
	}
	$JITPollQuests=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d",0));
	$JITPollSets=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id > %d",0));
?>
<form method="POST" enctype="multipart/form-data">
	<div class="JIT_Poll_MainDiv">
		<a href="http://juna-it.com" target="_blank" title="Click to Visit"><img src="<?php echo plugins_url('/Images/logo-white.png',__FILE__);?>" class="JIT_Poll_Logo"></a>
		<div class="JIT_Poll_AddD1">
			<span class="JIT_Poll_Title_Span">Question:</span> 
			<input type="text"   class="JIT_Poll_Search_Field" id="JIT_Poll_Search_Quest" onclick="JIT_Poll_Search_Quest_Clicked()" placeholder="Search">
			<input type="button" class="JIT_Poll_Reset_Button" value="Reset" onclick="JIT_Poll_Reset_Button_Clicked()">
			<span class="JIT_Poll_Search_DNE" id="JIT_Poll_Search_QDNE"></span>
			<input type="button" class="JIT_Poll_Add_Button" value="Create Poll" onclick="JIT_Poll_Add_Button_Clicked()">
		</div>
		<div class="JIT_Poll_AddD2">
			<input type="button" class="JIT_Poll_Add_Cancel" value="Back" onclick="JIT_Poll_Add_Cancel_Clicked()">
			<input type="submit" class="JIT_Poll_Add_Save"   id="JIT_Poll_Add_Save" value="Save"   name="JIT_Poll_Add_Save">
			<input type="submit" class="JIT_Poll_Add_Update" id="JIT_Poll_Add_Update" value="Update" name="JIT_Poll_Add_Update">

			<input type="text" style="display: none;" id="JIT_Poll_HiddenQ"    name="JIT_Poll_HiddenQ">
			<input type="text" style="display: none;" id="JIT_Poll_HiddenQ_ID" name="JIT_Poll_HiddenQ_ID"> 
		</div>
	</div>
	<div class="JIT_Poll_Short_Div">
		<table class="JIT_Poll_Short_Table">
			<tr>
				<td>Shortcode</td>
				<td>Copy & paste the shortcode directly into any WordPress post or page.</td>
				<td><?php echo 'Example:  [Juna_IT_Poll id="1"]';?></td>
			</tr>
			<tr>
				<td>Templete Include</td>
				<td>Copy & paste this code into a template file to include the poll within your theme.</td>
				<td><input type="text" value='<?php echo 'Example:   <?php echo do_shortcode("[Juna_IT_Poll id="1"]");?>';?>' style="width:100%;background-color:#0073aa;color:#ffffff;border:none;text-align: center" readonly></td>
			</tr>
		</table>
	</div>
	<table class='JIT_Poll_Main_Table'>
		<tr class="JIT_Poll_Main_Table_FR">
			<td class='JIT_Poll_MID'><B><I>No</I></B></td>
			<td class='JIT_Poll_MTitle'><B><I>Question</I></B></td>
			<td class='JIT_Poll_MType'><B><I>Poll Type</I></B></td>
			<td class='JIT_Poll_MShort'><B><I>Shortcode</I></B></td>
			<td class='JIT_Poll_MActions'><B><I>Actions</I></B></td>
		</tr>
	</table>
	<table class='JIT_Poll_ADDTable'>
		<?php for($i=0;$i<count($JITPollQuests);$i++){
			$JIT_Poll_Question1 = explode('*^*', $JITPollQuests[$i]->JIT_Poll_Question);
			$JIT_Poll_Question2 = implode('"', $JIT_Poll_Question1);
			$JIT_Poll_Question3 = explode("*&*", $JIT_Poll_Question2);
			$JIT_Poll_Question  = implode("'", $JIT_Poll_Question3);
			if($i==0){?>
				<tr>
					<td class='JIT_Poll_ID'><B><I><?php echo $i+1 ;?></I></B></td>
					<td class='JIT_Poll_Title'><B><I><?php echo $JIT_Poll_Question ; ?></I></B></td>
					<td class='JIT_Poll_Type'><B><I><?php echo $JITPollQuests[$i]->JIT_Poll_Type ;?></I></B></td>
					<td class='JIT_Poll_Short'><B><I><?php echo '[Juna_IT_Poll id="'.$JITPollQuests[$i]->id.'"]';?></I></B></td>
					<td class='JIT_Poll_Edit' onclick="JIT_Poll_Edit(<?php echo $JITPollQuests[$i]->id ;?>)"><B><I>Edit</I></B></td>
					<td class='JIT_Poll_Delete1'><B><I>Delete</I></B></td>
				</tr>
			<?php } else {?>
				<tr>
					<td class='JIT_Poll_ID'><B><I><?php echo $i+1 ;?></I></B></td>
					<td class='JIT_Poll_Title'><B><I><?php echo $JIT_Poll_Question ; ?></I></B></td>
					<td class='JIT_Poll_Type'><B><I><?php echo $JITPollQuests[$i]->JIT_Poll_Type ;?></I></B></td>
					<td class='JIT_Poll_Short'><B><I><?php echo '[Juna_IT_Poll id="'.$JITPollQuests[$i]->id.'"]';?></I></B></td>
					<td class='JIT_Poll_Edit' onclick="JIT_Poll_Edit(<?php echo $JITPollQuests[$i]->id ;?>)"><B><I>Edit</I></B></td>
					<td class='JIT_Poll_Delete' onclick="JIT_Poll_Delete(<?php echo $JITPollQuests[$i]->id ;?>)"><B><I>Delete</I></B></td>
				</tr>
		<?php }}?>
	</table>
	<table class='JIT_Poll_ADDTable1'></table>

	<div class="JIT_Poll_Type_Div">
		<table class="JIT_Poll_Type_Div_Table">
			<tr>
				<td>Question:</td>
				<td>Select Type:</td>
				<td>Select Setting:</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="JIT_Poll_Question" id="JIT_Poll_Question" class="JIT_Poll_AddInput" placeholder="Question" required>
				</td>
				<td>
					<select name="JIT_Poll_Type" id="JIT_Poll_Type" onchange="JIT_Poll_Change_Type()">
						<option value="Standart Poll">Standart Poll</option>
						<option value="Pie Chart">Pie Chart</option>
						<option value="Image Poll">Image Poll</option>
						<option value="Video Poll">Video Poll</option>
						<option value="Column Chart">Column Chart</option>
					</select>
				</td>
				<td>
					<select name="JIT_Poll_Setting" id="JIT_Poll_Setting">
						<?php for($i=0;$i<count($JITPollSets);$i++){?>
							<option value="<?php echo $JITPollSets[$i]->JIT_Poll_Set_Title;?>"><?php echo $JITPollSets[$i]->JIT_Poll_Set_Title;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
		</table>			
	</div>
	<fieldset class="JIT_Poll_Fieldset" id="JIT_Poll_Add_Field1">
		<legend class="JIT_Poll_FieldLeg">Answers</legend>
		<ul id="JIT_Poll_Answer_Ul" onclick="JIT_Poll_Answer_Drag()">
			
		</ul>
		<table style="padding: 0; width: 100%;">
			<tr>
				<td style="text-align: center">
					<input type="text" style="display: none;" name="JIT_PollAns_Count" id="JIT_Poll_Anscount" value="2">
					<input type="button" class="JIT_Poll_AddAns" id="JIT_Poll_AddAns" onclick="JIT_Poll_Add_Ans()" value="Add Answer">
				</td>
			</tr>
		</table>
	</fieldset>
</form>