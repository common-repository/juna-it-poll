<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<style type="text/css">
	.JIT_Poll_Short_Div
	{
		border:1px solid #0073aa;
		margin-top: 10px;
		width: 99.5%;
		background-color: #ffffff;
		padding:1px;
		border-radius: 5px;
	}
	.JIT_Poll_Short_Table
	{
		width: 100%;
		text-align: center;
		color:#ffffff;
		font-style: bold;
		font-weight: 900;
	}
	.JIT_Poll_Short_Table td:nth-child(1)
	{
		width: 20%;
		padding: 5px;
		background-color: #0073aa;
	}
	.JIT_Poll_Short_Table td:nth-child(2)
	{
		width: 40%;
		padding: 5px;
		background-color: #0073aa;
	}
	.JIT_Poll_Short_Table td:nth-child(3)
	{
		width: 40%;
		padding: 5px;
		background-color: #0073aa;
	}
	.JIT_Poll_Main_Table
	{
		width:99.5%;
		margin-top:15px; 
		height:40px;
		border:1px solid #0073aa;
		border-radius: 5px;
		padding: 2px;
	}
	.JIT_Poll_Main_Table_FR
	{
		background:#0073aa !important;
		color:white;
		text-align: center;
		font-family: Gabriola;
		font-size: 20px;
	}
	.JIT_Poll_ADDTable,.JIT_Poll_ADDTable1
	{
		width:99.5% ;
		padding: 2px;
		border:1px solid #0073aa;
		border-radius: 5px;
		margin-top: 1px;
		background-color: #c0c0c0;
	}	
	.JIT_Poll_ADDTable1
	{
		display: none;
	}
	.JIT_Poll_ADDTable tr:nth-child(odd),.JIT_Poll_ADDTable1 tr:nth-child(odd)
	{
		background:#f0f0f0 !important;
		color:#717171;
		text-align: center;
		font-size: 14px;
		/*height: 30px;	*/
	}
	.JIT_Poll_ADDTable tr:nth-child(even),.JIT_Poll_ADDTable1 tr:nth-child(even)
	{
		background:#e4e3e3 !important;
		color:#717171;
		text-align: center;
		font-size: 14px;
		/*height: 30px;		*/
	}
	.JIT_Poll_MID,.JIT_Poll_ID
	{
		width:3%;
	}
	.JIT_Poll_MTitle,.JIT_Poll_Title
	{
		width: 30%;
	}
	.JIT_Poll_MType,.JIT_Poll_Type
	{
		width: 27%;
	}
	.JIT_Poll_MShort,.JIT_Poll_Short
	{
		width: 20%;
	}
	.JIT_Poll_MActions
	{
		width: 20%;
	}
	.JIT_Poll_Delete1
	{
		width:10%;
	}
	.JIT_Poll_Edit,.JIT_Poll_Delete
	{
		width:10%;
		text-decoration: underline;
		color: #b12201;
	}
	.JIT_Poll_Edit:hover,.JIT_Poll_Delete:hover
	{
		cursor: pointer;
		color: #f68935;
	}
	.JIT_Poll_Add_Cancel,.JIT_Poll_Add_Save,.JIT_Poll_Add_Update
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
	.JIT_Poll_Add_Update
	{
		display: none;
	}
	.JIT_Poll_Type_Div
	{
		border:1px solid #0073aa; 
		margin-top:15px;
		background-color:#ffffff;
		border-radius:10px; 
		padding:5px;
		width: 60%;
		display: none;
	}
	.JIT_Poll_Type_Div_Table
	{
		width: 100%;
	}
	.JIT_Poll_Type_Div_Table tr:nth-child(odd)
	{
		background-color: #edecec;
		text-align: center;
		font-size: 14px;
		font-family: Consolas;
	}
	.JIT_Poll_Type_Div_Table tr:nth-child(even)
	{
		background-color: #f5f5f5;
		text-align: center;
	}
	.JIT_Poll_Type_Div_Table td:nth-child(1)
	{
		width: 50%;
	}
	.JIT_Poll_Type_Div_Table td:nth-child(2)
	{
		width: 25%;
	}	
	.JIT_Poll_Type_Div_Table td:nth-child(3)
	{
		width: 25%;
	}
	.JIT_Poll_Fieldset
	{
		border:1px solid #0073aa;
		border-radius: 10px;
		background:white;
		margin-top: 15px;
		float: left;
		padding: 5px;
		display: none;
		width: 60%;
	}
	.JIT_Poll_FieldLeg
	{
		margin-left: 10px;
		color: #0073aa;
		font-size: 14px;
	}
	.JIT_Poll_AddInput
	{
		width: 90%;
	}
	.JIT_Poll_AddTable tr:nth-child(odd)
	{
		background:#f0f0f0 !important;
		color:#717171;
		text-align: center;
		font-size: 14px;
		height: 30px;	
	}
	.JIT_Poll_AddTable
	{
		width:70% ;
		background-color: #ffffff;
		float: left;
		border-radius: 3px;
	}
	.JIT_Poll_AddTable td:nth-child(1)
	{
		width: 10%;
	}
	.JIT_Poll_AddTable td:nth-child(2)
	{
		width: 90%;
	}
	.JIT_Poll_AddTable1,.JIT_Poll_AddTable2
	{
		width:30%;
		background-color: #ffffff;
		float: left;
		display: none;
		border-radius: 3px;
	}
	.JIT_Poll_AddTable1 tr:nth-child(odd)
	{
		background:#e4e3e3 !important;
		color:#717171;
		font-size: 14px;
		height: 30px;	
	}
	.JIT_Poll_AddTable2 tr:nth-child(odd)
	{
		background:#e4e3e3 !important;
		color:#717171;
		font-size: 14px;
		height: 30px;	
	}
	.JIT_Poll_AddTable td, .JIT_Poll_AddTable1 td, .JIT_Poll_AddTable2 td
	{
		padding: 0;
	}
	.JIT_Poll_AddTable2 td
	{
		padding-left: 5px;
	}
	.JIT_Poll_AddAns
	{
		margin-top: 10px;
		width: 120px;
		color: #ffffff;
		background-color: #0073aa;
		height:30px;
		border-radius: 5px;
		border: 1px solid #0073aa; 
		cursor: pointer;
	}
	.JIT_Poll_AddAns:hover
	{
		color: #0073aa;
		background-color: #ffffff;
	}
	.JIT_Poll_AddAns:active
	{
		color: #ffffff;
		background-color: #0073aa;
	}
	#JIT_Poll_Answer_Ul li
	{
		margin: 1px;
		background-color: #c0c0c0;
		height: 34px;
		border-radius: 5px;
		padding: 2px;
		cursor: pointer;
	}
	#JIT_Poll_Answer_Ul
	{
		padding: 2px;
		background-color: #f0f0f0;
		border-radius: 5px;
	}
	.JIT_Poll_UpMediaI
	{
		display: none;
		float:right;
		margin-right:5px;
		font-size:20px; 
		color:#2d932f;
	}
</style>