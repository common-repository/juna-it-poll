<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<style type="text/css">
	.JIT_PollT_Main_Table
	{
		width:99.5%;
		margin-top:15px; 
		height:30px;
		border:1px solid #0073aa;
		border-radius: 5px;
		padding: 2px;
	}
	.JIT_PollT_Main_Table_FR
	{
		background:#0073aa !important;
		color:white;
		text-align: center;
		font-family: Gabriola;
		font-size: 20px;
	}
	.JIT_Poll_SetTable,.JIT_Poll_SetTable1
	{
		width:99.5% ;
		padding: 2px;
		border:1px solid #0073aa;
		border-radius: 5px;
		margin-top: 1px;
		background-color: #c0c0c0;
	}	
	.JIT_Poll_SetTable1
	{
		display: none;
	}
	.JIT_Poll_SetTable tr:nth-child(odd),.JIT_Poll_SetTable1 tr:nth-child(odd)
	{
		background:#f0f0f0 !important;
		color:#717171;
		text-align: center;
		font-size: 14px;
	}
	.JIT_Poll_SetTable tr:nth-child(even),.JIT_Poll_SetTable1 tr:nth-child(even)
	{
		background:#e4e3e3 !important;
		color:#717171;
		text-align: center;
		font-size: 14px;
	}
	.JIT_PollT_MID,.JIT_PollT_ID
	{
		width: 5%;
	}
	.JIT_PollT_MTitle,.JIT_PollT_Title
	{
		width: 40%;
	}
	.JIT_PollT_MType,.JIT_PollT_Type
	{
		width:35%;
	}
	.JIT_PollT_MActions
	{
		width:20%;
	}
	.JIT_PollT_Delete1
	{
		width: 10%;
	}
	.JIT_PollT_Edit,.JIT_PollT_Delete
	{
		width:10%;
		text-decoration: underline;
		color: #b12201;
	}
	.JIT_PollT_Edit:hover,.JIT_PollT_Delete:hover
	{
		cursor: pointer;
		color: #f68935;
	}
	.JIT_Poll_Title_Cancel
	{
		width: 120px;
		background-color: #0073aa;
		color: #f68935;
		border: 1px solid #f68935;
		border-radius: 3px;
		box-shadow: 0px 0px 30px #f68935;
		margin-right: 25px;
		margin-top: -5px;
		float: right;
		cursor: pointer;
	}	
	
	.JIT_PollT_Type_Div
	{
		border:1px solid #0073aa; 
		margin-top:15px;
		background-color:#ffffff;
		border-radius:10px; 
		padding:5px;
		width: 60%;
		display: none;
	}
	.JIT_PollT_Type_Div_Table
	{
		width: 100%;
	}
	.JIT_PollT_Type_Div_Table tr:nth-child(odd)
	{
		background-color: #edecec;
		text-align: center;
		font-size: 14px;
		font-family: Consolas;
	}
	.JIT_PollT_Type_Div_Table tr:nth-child(even)
	{
		background-color: #f5f5f5;
		text-align: center;
	}
	.JIT_PollT_Type_Div_Table td:nth-child(1)
	{
		width: 50%;
	}
	.JIT_PollT_Type_Div_Table td:nth-child(2)
	{
		width: 50%;
	}	
	.JIT_Poll_SetInput
	{
		width: 80%;
	}
	.JIT_Poll_Button_Div
	{
		margin-top: 15px;
		border-radius: 5px;
		text-align: center;
		padding: 5px;
		width: 99%;
		background-color: #f68935;
	}
	.JIT_Poll_Full_Version_Image
	{
		height: 50px;
		width: 250px;
		background-image: url("<?php echo plugins_url('../Images/full-version.png',__FILE__);?>");
		background-size: 250px 50px;
		background-repeat: no-repeat;
		background-position: center;
		margin: 0 auto;
		transition-duration:1s; 
	}
	.JIT_Poll_Full_Version_Image:hover
	{
		background-image: url("<?php echo plugins_url('../Images/full-version-1.png',__FILE__);?>");
	}
	.JIT_Poll_Free
	{
		display: none;
		width: 60%;
		margin-top: 10px;
	}
</style>