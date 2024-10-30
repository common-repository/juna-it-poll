 <?php

	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}

	global $wpdb;

	$table_name  =  $wpdb->prefix . "juna_it_poll_manager";
	$table_name2 =  $wpdb->prefix . "juna_it_answer_manager";
	$table_name3 =  $wpdb->prefix . "juna_it_poll_results";

	$questions=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d ", 0));	

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$quest=sanitize_text_field($_POST["Juna_IT_Poll_Add_Question_Field"]);

		$results=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE JIT_Q_ID=(SELECT id FROM $table_name WHERE JIT_Poll_Question= %s) order by id", $quest));
		
		$answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE JIT_Poll_id=(SELECT id FROM $table_name WHERE JIT_Poll_Question= %s) order by id", $quest));

		$quest=sanitize_text_field(stripcslashes($_POST["Juna_IT_Poll_Add_Question_Field"]));
	}

	?>
<style>
	table, th, td 
	{
	 	border:1px solid #0073aa;
	 	border-radius:10px;	
	}
	tr:nth-child(odd)
	{
		background-color:white;		
	}
	tr:nth-child(even)
	{
		background-color:#ddf4fb;		
	}
	table
	{
		margin-top:30px;
		width:90%;
	}
	th
	{
		width: 33%;
		text-align:center;		
		vertical-align:center;
		padding:10px;
	}	

	select 
	{
		position:relative;
		border:1px solid white;
		background-color:#0073aa;
		color:white;
		border-radius:7px;
		margin: 5px auto;
	}		
	tr:nth-child(1)
	{
		font-size:20px;
		color:white;
		font-family: Consolas, Arial, Gabriola;
		background-color:#0073aa;
		width:100%;
	}	
	#change_button
	{
		position:relative;
		border:1px solid white;
		background-color:#0073aa;
		color:white;
		border-radius:10px;
		margin: 5px auto;
	}
</style>
<script type="text/javascript">
	var hidden_value=jQuery('#hidden_count').val();
	
	function Change_votes()
	{
		var x=jQuery('#hidden_count').val();
		var title_button=jQuery('#change_button').html();
		if(title_button=='Change Votes')
		{
			for(i=0;i<x;i++)
			{
				var z=parseInt(jQuery('.counts').attr('id'))+i;

				var k=jQuery('#'+z).html();

				jQuery('#'+z).html('');
				jQuery('#'+z).append("<input type='text' id='inputs"+z+"' value="+k+">");
			}
			jQuery('#change_button').html('Save changes');
		}
		else
		{
			var hoplo='';
			for(i=0;i<x;i++)
			{
				var z=parseInt(jQuery('.counts').attr('id'))+i;
				var k=jQuery('#inputs'+z).val();
				hoplo += k+'*&^&*';
				jQuery('#'+z).html('');
				jQuery('#'+z).html(k);			
			}

			var selected_question=jQuery('#question').html()+'$#$'+hoplo;
			
			var ajaxurl = object.ajaxurl;
			var data = {
			action: 'Update_votes', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: selected_question, // translates into $_POST['foobar'] in PHP
			};
			jQuery.post(ajaxurl, data, function(response) {
			});
			jQuery('#change_button').html('Change Votes');
		}
	}
	
</script>
<form method="post">
<br>
	<input type="text" style="display: none" value="<?php echo count($results)?>" id="hidden_count" >
	<img style="float:left;" src="<?php echo plugins_url('/Images/admin.png',__FILE__);?>">
	<Label style="font-size:18px; margin-left:10px;"><i>Select a Question</i> </Label> <a href="http://juna-it.com" target="_blank"><img src="<?php echo plugins_url('/Images/juna-logo.png',__FILE__);?>" style="float:right; width:150px;height:70px; margin-right:10px;" <abbr title="Click to visit"></a><br>
	<select name="Juna_IT_Poll_Add_Question_Field" onchange="this.form.submit()" style="margin-top:20px; " >
	<option> Select Question </option>
		<?php
			foreach($questions as $q)
			{											
				?>
					<option value="<?php echo $q->JIT_Poll_Question ?>"> <?php echo $q->JIT_Poll_Question; ?> </option> 
				<?php
			}
		?>
	</select>
	<?php
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			?>
				 <table>
				 <tr>
				 <th colspan="3" id="question">
				  <?php echo $quest; ?> 
				  </th>
				 </tr>
			 	<tr>
			 		<th style="font-size:18px;"> <b> <i> ID </i> </b> </th>
			 		<th style="font-size:18px;"> <b> <i> Answer </i> </b> </th>
			 		<th style="font-size:18px;"> <b> <i> Votes  </i> </b> </th>	 		
			 	</tr>

			 	<?php
			 		for($i=0; $i<count($results); $i++) {
			 			?>
			 				<tr>
			 					<th> <?php echo $i+1; ?> </th>
			 					<th> <?php echo $answers[$i]->JIT_Poll_Ans; ?> </th>
			 					<th class="counts"id="<?php echo $answers[$i]->id; ?>" > <?php echo $results[$i]->JIT_Poll_Votes; ?> </th> 
			 				</tr> 
			 			<?php
			 		}
			 	?>	
			 		<tr>
					 	<th colspan="3" id="change_button" onclick="Change_votes()" title='Click to change...'>Change Votes</th>
				 	</tr>
			 </table> 
			<?php
		}
	 ?>
</form>