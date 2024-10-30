<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<script type="text/javascript">
	function JIT_Poll_Add_Button_Clicked()
	{
		jQuery('.JIT_Poll_AddD1').fadeOut();
		jQuery('.JIT_Poll_Short_Div').fadeOut();
		jQuery('.JIT_Poll_Main_Table').fadeOut();
		jQuery('.JIT_Poll_ADDTable').fadeOut();
		jQuery('.JIT_Poll_ADDTable1').fadeOut();
		jQuery('#JIT_Poll_Add_Save').fadeIn();
		jQuery('#JIT_Poll_Add_Update').fadeOut();

		jQuery('#JIT_Poll_Anscount').val(2);

		jQuery('#JIT_Poll_Answer_Ul').append("<li id='JIT_Poll_Answer_li_1'><table class='JIT_Poll_AddTable'><tr><td onclick='JIT_Poll_RemAns(1)'><i class='junaiticons-style junaiticons-remove' style='font-size: 20px; color:#ff0000;'></i> </td><td> <input type='text' class='JIT_Poll_AddInput' id='JIT_Poll_Ans_1' name='JIT_Poll_Ans_1' placeholder='Answer 1 '></td></tr></table><table class='JIT_Poll_AddTable1'><tr><td> <input type='text' class='JIT_Poll_AddColor' id='JIT_Poll_Col_1' name='JIT_Poll_Col_1'> </td></tr></table><table class='JIT_Poll_AddTable2'><tr><td><i id='JIT_Poll_UpMediaI_1' class='JIT_Poll_UpMediaI junaiticons-style junaiticons-check'></i><div id='wp-content-media-buttons' class='wp-media-buttons'><a href='#' class='button insert-media add_media JIT_Poll_UpMed' style='border:1px solid #0073aa; color:#0073aa; background-color:#f2f2f2' data-editor='JIT_Poll_UpMedi_1' title='Add Media' id='JIT_Poll_UpMed_1' onclick='JIT_Poll_UpMed(1)'><span class='wp-media-buttons-icon'></span>Add Media</a></div><input type='text' style='display: none;' class='JIT_Poll_UpMedi' id='JIT_Poll_UpMedi_1'><input type='text' style='display: none;' class='JIT_Poll_UpMedia' id='JIT_Poll_UpMedia_1' name='JIT_Poll_UpMedia_1'></td></tr></table></li>");
		jQuery('#JIT_Poll_Answer_Ul').append("<li id='JIT_Poll_Answer_li_2'><table class='JIT_Poll_AddTable'><tr><td onclick='JIT_Poll_RemAns(2)'><i class='junaiticons-style junaiticons-remove' style='font-size: 20px; color:#ff0000;'></i> </td><td> <input type='text' class='JIT_Poll_AddInput' id='JIT_Poll_Ans_2' name='JIT_Poll_Ans_2' placeholder='Answer 2 '></td></tr></table><table class='JIT_Poll_AddTable1'><tr><td> <input type='text' class='JIT_Poll_AddColor' id='JIT_Poll_Col_2' name='JIT_Poll_Col_2'> </td></tr></table><table class='JIT_Poll_AddTable2'><tr><td><i id='JIT_Poll_UpMediaI_2' class='JIT_Poll_UpMediaI junaiticons-style junaiticons-check'></i><div id='wp-content-media-buttons' class='wp-media-buttons'><a href='#' class='button insert-media add_media JIT_Poll_UpMed' style='border:1px solid #0073aa; color:#0073aa; background-color:#f2f2f2' data-editor='JIT_Poll_UpMedi_2' title='Add Media' id='JIT_Poll_UpMed_2' onclick='JIT_Poll_UpMed(2)'><span class='wp-media-buttons-icon'></span>Add Media</a></div><input type='text' style='display: none;' class='JIT_Poll_UpMedi' id='JIT_Poll_UpMedi_2'><input type='text' style='display: none;' class='JIT_Poll_UpMedia' id='JIT_Poll_UpMedia_2' name='JIT_Poll_UpMedia_2'></td></tr></table></li>");

		jQuery('.JIT_Poll_AddColor').wpColorPicker();

		setTimeout(function(){
			jQuery('.JIT_Poll_AddD2').fadeIn();
			jQuery('.JIT_Poll_Type_Div').fadeIn();
			jQuery('#JIT_Poll_Add_Field1').fadeIn();
		},500)
	}
	function JIT_Poll_Add_Cancel_Clicked()
	{
		location.reload();
	}
	function JIT_Poll_Reset_Button_Clicked()
	{

	}
	function JIT_Poll_Search_Quest_Clicked()
	{

	}
	function JIT_Poll_Edit(JIT_PollID)
	{
		jQuery('.JIT_Poll_AddD1').fadeOut();
		jQuery('.JIT_Poll_Short_Div').fadeOut();
		jQuery('.JIT_Poll_Main_Table').fadeOut();
		jQuery('.JIT_Poll_ADDTable').fadeOut();
		jQuery('.JIT_Poll_ADDTable1').fadeOut();
		jQuery('#JIT_Poll_Add_Save').fadeOut();
		jQuery('#JIT_Poll_Add_Update').fadeIn();

		var ajaxurl = object.ajaxurl;
		var data = {
		action: 'Edit_JIT_Poll', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_PollID, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) {
			var JITPoll_Params=response.split('^%^');

			jQuery('#JIT_Poll_Question').val(JITPoll_Params[0]);
			jQuery('#JIT_Poll_HiddenQ').val(JITPoll_Params[0]);
			jQuery('#JIT_Poll_Type').val(JITPoll_Params[1]);
			jQuery('#JIT_Poll_Setting').val(JITPoll_Params[2]);
			jQuery('#JIT_Poll_Anscount').val(JITPoll_Params[3]);
			jQuery('#JIT_Poll_HiddenQ_ID').val(JIT_PollID);

			var JITPoll_AParams=JITPoll_Params[4].split(')*(');

			for(var y=0;y<JITPoll_Params[3];y++)
			{

				var JITPoll_Input_params=JITPoll_AParams[y].split('$#$');

				jQuery('#JIT_Poll_Answer_Ul').append("<li id='JIT_Poll_Answer_li_"+parseInt(parseInt(y)+1)+"'><table class='JIT_Poll_AddTable'><tr><td onclick='JIT_Poll_RemAns("+parseInt(parseInt(y)+1)+")'><i class='junaiticons-style junaiticons-remove' style='font-size: 20px; color:#ff0000;'></i> </td><td> <input type='text' class='JIT_Poll_AddInput' id='JIT_Poll_Ans_"+parseInt(parseInt(y)+1)+"' name='JIT_Poll_Ans_"+parseInt(parseInt(y)+1)+"' value='"+JITPoll_Input_params[0]+"'></td></tr></table><table class='JIT_Poll_AddTable1'><tr><td> <input type='text' class='JIT_Poll_AddColor' id='JIT_Poll_Col_"+parseInt(parseInt(y)+1)+"' name='JIT_Poll_Col_"+parseInt(parseInt(y)+1)+"' value="+JITPoll_Input_params[2]+"> </td></tr></table><table class='JIT_Poll_AddTable2'><tr><td><i id='JIT_Poll_UpMediaI_"+parseInt(parseInt(y)+1)+"' class='JIT_Poll_UpMediaI junaiticons-style junaiticons-check'></i><div id='wp-content-media-buttons' class='wp-media-buttons'><a href='#' class='button insert-media add_media JIT_Poll_UpMed' style='border:1px solid #0073aa; color:#0073aa; background-color:#f2f2f2' data-editor='JIT_Poll_UpMedi_"+parseInt(parseInt(y)+1)+"' title='Add Media' id='JIT_Poll_UpMed_"+parseInt(parseInt(y)+1)+"' onclick='JIT_Poll_UpMed("+parseInt(parseInt(y)+1)+")'><span class='wp-media-buttons-icon'></span>Add Media</a></div><input type='text' style='display: none;' class='JIT_Poll_UpMedi' id='JIT_Poll_UpMedi_"+parseInt(parseInt(y)+1)+"'><input type='text' style='display: none;' class='JIT_Poll_UpMedia' id='JIT_Poll_UpMedia_"+parseInt(parseInt(y)+1)+"' name='JIT_Poll_UpMedia_"+parseInt(parseInt(y)+1)+"' value="+JITPoll_Input_params[1]+"></td></tr></table></li>");

				if(JITPoll_Input_params[1]!='')
				{
					jQuery('#JIT_Poll_UpMediaI_'+parseInt(parseInt(y)+1)).fadeIn();
				}
			}
			JIT_Poll_Change_Type();
			setTimeout(function(){
				jQuery('.JIT_Poll_AddColor').wpColorPicker();
				jQuery('.JIT_Poll_AddD2').fadeIn();
				jQuery('.JIT_Poll_Type_Div').fadeIn();
				jQuery('#JIT_Poll_Add_Field1').fadeIn();
			},500)
		})
	}
	function JIT_Poll_Delete(JIT_PollID)
	{
		var ajaxurl = object.ajaxurl;
		var data = {
		action: 'Delete_JITPoll_Click', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_PollID, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) {
			location.reload();
		});
	}
	function JIT_Poll_Change_Type()
	{
		var JIT_Poll_Type=jQuery('#JIT_Poll_Type').val();
		jQuery('.JIT_Poll_AddTable1').fadeOut();
		jQuery('.JIT_Poll_AddTable2').fadeOut();
		setTimeout(function(){
			if(JIT_Poll_Type=='Pie Chart')
			{
				jQuery('.JIT_Poll_AddTable1').fadeIn();
			}
			else if(JIT_Poll_Type=='Image Poll')
			{
				jQuery('.JIT_Poll_AddTable2').fadeIn();
			}
			else if(JIT_Poll_Type=='Video Poll')
			{
				jQuery('.JIT_Poll_AddTable2').fadeIn();
			}
			else if(JIT_Poll_Type=='Column Chart')
			{
				jQuery('.JIT_Poll_AddTable1').fadeIn();
			}
		},500)
	}
	function JIT_Poll_Add_Ans()
	{
		JIT_Poll_Change_Type();
		var JIT_Poll_Anscount=parseInt(jQuery('#JIT_Poll_Anscount').val())+1;
		jQuery('#JIT_Poll_Anscount').val(JIT_Poll_Anscount);
		jQuery('#JIT_Poll_Answer_Ul').append("<li id='JIT_Poll_Answer_li_"+JIT_Poll_Anscount+"'><table class='JIT_Poll_AddTable'><tr><td onclick='JIT_Poll_RemAns("+JIT_Poll_Anscount+")'><i class='junaiticons-style junaiticons-remove' style='font-size: 20px; color:#ff0000;'></i> </td><td> <input type='text' class='JIT_Poll_AddInput' id='JIT_Poll_Ans_"+JIT_Poll_Anscount+"' name='JIT_Poll_Ans_"+JIT_Poll_Anscount+"' placeholder='Answer "+JIT_Poll_Anscount+" '></td></tr></table><table class='JIT_Poll_AddTable1'><tr><td> <input type='text' class='JIT_Poll_AddColor' id='JIT_Poll_Col_"+JIT_Poll_Anscount+"' name='JIT_Poll_Col_"+JIT_Poll_Anscount+"'> </td></tr></table><table class='JIT_Poll_AddTable2'><tr><td><i id='JIT_Poll_UpMediaI_"+JIT_Poll_Anscount+"' class='JIT_Poll_UpMediaI junaiticons-style junaiticons-check'></i><div id='wp-content-media-buttons' class='wp-media-buttons'><a href='#' class='button insert-media add_media JIT_Poll_UpMed' style='border:1px solid #0073aa; color:#0073aa; background-color:#f2f2f2' data-editor='JIT_Poll_UpMedi_"+JIT_Poll_Anscount+"' title='Add Media' id='JIT_Poll_UpMed_"+JIT_Poll_Anscount+"' onclick='JIT_Poll_UpMed("+JIT_Poll_Anscount+")'><span class='wp-media-buttons-icon'></span>Add Media</a></div><input type='text' style='display: none;' class='JIT_Poll_UpMedi' id='JIT_Poll_UpMedi_"+JIT_Poll_Anscount+"'><input type='text' style='display: none;' class='JIT_Poll_UpMedia' id='JIT_Poll_UpMedia_"+JIT_Poll_Anscount+"' name='JIT_Poll_UpMedia_"+JIT_Poll_Anscount+"'></td></tr></table></li>");
		jQuery('.JIT_Poll_AddColor').wpColorPicker();
	}	
</script>