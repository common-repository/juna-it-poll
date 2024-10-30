<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<script type="text/javascript">
	function JIT_Poll_Search_Title_Clicked()
	{

	}
	function JIT_Poll_ResetTitle_Button_Clicked()
	{

	}
	function JIT_Poll_Title_Cancel_Clicked()
	{
		location.reload();
	}
	function JIT_PollT_Change_Type()
	{
		var JIT_Poll_Set_Type=jQuery('#JIT_Poll_Set_Type').val();
		jQuery('.JIT_Poll_Free').hide(500);
		if(JIT_Poll_Set_Type=='Standart Poll')
		{
			jQuery('#JIT_Poll_Free_1').show(1000);
		}
		else if(JIT_Poll_Set_Type=='Pie Chart')
		{
			jQuery('#JIT_Poll_Free_2').show(1000);
		}
		else if(JIT_Poll_Set_Type=='Image Poll')
		{
			jQuery('#JIT_Poll_Free_3').show(1000);
		}
		else if(JIT_Poll_Set_Type=='Video Poll')
		{
			jQuery('#JIT_Poll_Free_4').show(1000);
		}
		else if(JIT_Poll_Set_Type=='Column Chart')
		{
			jQuery('#JIT_Poll_Free_5').show(1000);
		}
		
	}
	function JIT_Poll_Set_Edit(JIT_Poll_Set_ID)
	{
		jQuery('.JIT_Poll_SetD1').fadeOut();
		jQuery('.JIT_PollT_Main_Table').fadeOut();
		jQuery('.JIT_Poll_SetTable').fadeOut();
		jQuery('.JIT_Poll_SetTable1').fadeOut();

		jQuery('.JIT_Poll_Free').hide(500);
		if(JIT_Poll_Set_ID=='1')
		{
			jQuery('#JIT_Poll_Set_Title').val('Standart Poll');
			jQuery('#JIT_Poll_Set_Type').val('Standart Poll');
			jQuery('#JIT_Poll_Free_1').show(1000);
		}
		else if(JIT_Poll_Set_ID=='2')
		{
			jQuery('#JIT_Poll_Set_Title').val('Pie Chart');
			jQuery('#JIT_Poll_Set_Type').val('Pie Chart');
			jQuery('#JIT_Poll_Free_2').show(1000);
		}
		else if(JIT_Poll_Set_ID=='3')
		{
			jQuery('#JIT_Poll_Set_Title').val('Image');
			jQuery('#JIT_Poll_Set_Type').val('Image Poll');
			jQuery('#JIT_Poll_Free_3').show(1000);
		}
		else if(JIT_Poll_Set_ID=='4')
		{
			jQuery('#JIT_Poll_Set_Title').val('Video');
			jQuery('#JIT_Poll_Set_Type').val('Video Poll');
			jQuery('#JIT_Poll_Free_4').show(1000);
		}
		else if(JIT_Poll_Set_ID=='5')
		{
			jQuery('#JIT_Poll_Set_Title').val('Column');
			jQuery('#JIT_Poll_Set_Type').val('Column Chart');
			jQuery('#JIT_Poll_Free_5').show(1000);
		}

		setTimeout(function(){
			jQuery('.JIT_Poll_SetD2').fadeIn();
			jQuery('.JIT_PollT_Type_Div').fadeIn();
		},500)
	}	
</script>