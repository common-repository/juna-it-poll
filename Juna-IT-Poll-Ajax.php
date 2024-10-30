<?php
	add_action( 'wp_ajax_Delete_JITPoll_Click', 'Delete_JITPoll_Click_Callback' );
	add_action( 'wp_ajax_nopriv_Delete_JITPoll_Click', 'Delete_JITPoll_Click_Callback' );

	function Delete_JITPoll_Click_Callback()
	{
		$Delete_poll_id = sanitize_text_field($_POST['foobar']);
		
		global $wpdb;
		$table_name  = $wpdb->prefix . "juna_it_poll_manager";
		$table_name1 = $wpdb->prefix . "juna_it_answer_manager";

		$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id=%d", $Delete_poll_id));
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name1 WHERE JIT_Poll_id=%s", $Delete_poll_id));

		die();
	}

	add_action( 'wp_ajax_Edit_JIT_Poll', 'Edit_JIT_Poll_Callback' );
	add_action( 'wp_ajax_nopriv_Edit_JIT_Poll', 'Edit_JIT_Poll_Callback' );

	function Edit_JIT_Poll_Callback()
	{
		$Edit_poll_id = sanitize_text_field($_POST['foobar']);
		
		global $wpdb;
		$table_name  = $wpdb->prefix . "juna_it_poll_manager";
		$table_name1 = $wpdb->prefix . "juna_it_answer_manager";

		$JIT_Poll_pars=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id=%d", $Edit_poll_id));

		$JIT_Poll_Ans=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE JIT_Poll_id=%d order by id", $Edit_poll_id));

		$JIT_Poll_Question1 = explode('*^*', $JIT_Poll_pars[0]->JIT_Poll_Question);
		$JIT_Poll_Question2 = implode('"', $JIT_Poll_Question1);
		$JIT_Poll_Question3 = explode("*&*", $JIT_Poll_Question2);
		$JIT_Poll_Question  = implode("'", $JIT_Poll_Question3);

		echo $JIT_Poll_Question . '^%^' . $JIT_Poll_pars[0]->JIT_Poll_Type . '^%^' . $JIT_Poll_pars[0]->JIT_Poll_Setting . '^%^' . $JIT_Poll_pars[0]->JIT_PollAns_Count . '^%^' . $JIT_Poll_Ans_param;

		for($i=0;$i<$JIT_Poll_pars[0]->JIT_PollAns_Count;$i++)
		{
			$JIT_Poll_Answer1 = explode(')*^*(', $JIT_Poll_Ans[$i]->JIT_Poll_Ans);
			$JIT_Poll_Answer2 = implode('"', $JIT_Poll_Answer1);
			$JIT_Poll_Answer3 = explode(")*&*(", $JIT_Poll_Answer2);
			$JIT_Poll_Answer  = implode("'", $JIT_Poll_Answer3);

			$JIT_Poll_Ans_param = $JIT_Poll_Answer . '$#$' . $JIT_Poll_Ans[$i]->JIT_Poll_UpMedia . '$#$' . $JIT_Poll_Ans[$i]->JIT_Poll_Col . ')*(';
			echo $JIT_Poll_Ans_param;
		}
		die();
	}

	add_action( 'wp_ajax_Delete_JITPollSet_Click', 'Delete_JITPollSet_Click_Callback' );
	add_action( 'wp_ajax_nopriv_Delete_JITPollSet_Click', 'Delete_JITPollSet_Click_Callback' );

	function Delete_JITPollSet_Click_Callback()
	{
		$Delete_pollset_id = sanitize_text_field($_POST['foobar']);
		
		global $wpdb;
		$table_name3 = $wpdb->prefix . "juna_it_poll_standart";

		$wpdb->query($wpdb->prepare("DELETE FROM $table_name3 WHERE id=%d", $Delete_pollset_id));

		die();
	}

	add_action( 'wp_ajax_Edit_JIT_Poll_Set', 'Edit_JIT_Poll_Set_Callback' );
	add_action( 'wp_ajax_nopriv_Edit_JIT_Poll_Set', 'Edit_JIT_Poll_Set_Callback' );

	function Edit_JIT_Poll_Set_Callback()
	{
		$Edit_poll_set_id = sanitize_text_field($_POST['foobar']);
		
		global $wpdb;
		$table_name3 = $wpdb->prefix . "juna_it_poll_standart";

		$JIT_Poll_sets=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id=%d", $Edit_poll_set_id));

		echo $JIT_Poll_sets[0]->JIT_Poll_Set_Title . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_Set_Type . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_WidW . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_BgC . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_WidBW . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_WidBS . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_WidBC . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_WidBR . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_AnsSp . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_VT . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_QFS . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_QFF . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_QC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_QBgC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_LAQShow . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_LAQW . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_LAQS . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_LAQC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_AFS . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_AFF . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_AC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ABgC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ABW . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ABS . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ABC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ABR . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButBgC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButFS . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_ButFF . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButBW . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButBS . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButBC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButBR . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButPos . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButText . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButHBgC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_ButHC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_AnsShow . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_AnsPos . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_AOP . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_IP_IW . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_HBgC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_HOP . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_HText . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_HFS . '^%^' . $JIT_Poll_sets[0]->JIT_Poll_HFF . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_HTC . '^%^' . $JIT_Poll_sets[0]->JIT_PollT_IP_IH;
		die();
	}

	add_action( 'wp_ajax_JIT_Poll_Vote', 'JIT_Poll_Vote_Callback' );
	add_action( 'wp_ajax_nopriv_JIT_Poll_Vote', 'JIT_Poll_Vote_Callback' );

	function JIT_Poll_Vote_Callback()
	{
		$Voted_Poll_Pars = sanitize_text_field($_POST['foobar']);
		$Voted_Poll_Pars_Split=explode('^%^', $Voted_Poll_Pars);

		global $wpdb;
		$table_name4 = $wpdb->prefix . "juna_it_poll_results";

		$JIT_Poll_Voted_Ans=$wpdb->get_var($wpdb->prepare("SELECT JIT_Poll_Votes FROM $table_name4 WHERE JIT_Q_ID=%d AND JIT_A_ID=%d", $Voted_Poll_Pars_Split[0], $Voted_Poll_Pars_Split[1]));
		$JIT_Poll_Voted_Ans++;

		$wpdb->query($wpdb->prepare("UPDATE $table_name4 set JIT_Poll_Votes=%d WHERE JIT_Q_ID=%d AND JIT_A_ID=%d",$JIT_Poll_Voted_Ans, $Voted_Poll_Pars_Split[0], $Voted_Poll_Pars_Split[1]));

		$JIT_Poll_Ans_Votes=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE JIT_Q_ID=%d order by id", $Voted_Poll_Pars_Split[0]));

		for($i=0;$i<count($JIT_Poll_Ans_Votes);$i++)
		{
			$JIT_POLL_ANS=$JIT_Poll_Ans_Votes[$i]->JIT_Poll_Votes . '^';
			echo $JIT_POLL_ANS;
		}
		
		die();
	}

	add_action( 'wp_ajax_JIT_Poll_Cook', 'JIT_Poll_Cook_Callback' );
	add_action( 'wp_ajax_nopriv_JIT_Poll_Cook', 'JIT_Poll_Cook_Callback' );

	function JIT_Poll_Cook_Callback()
	{
		$Cooked_Poll_ID = sanitize_text_field($_POST['foobar']);
		global $wpdb;

		$table_name  = $wpdb->prefix . "juna_it_poll_manager";
		$table_name1 = $wpdb->prefix . "juna_it_answer_manager";
		$table_name4 = $wpdb->prefix . "juna_it_poll_results";

		$JIT_Poll_Quests=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id=%d", $Cooked_Poll_ID));
		$JIT_Poll_Answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE JIT_Poll_id=%d order by id", $Cooked_Poll_ID));

		echo  $JIT_Poll_Quests[0]->id . '^' . $JIT_Poll_Quests[0]->JIT_Poll_Type . '^' . count($JIT_Poll_Answers) . '&' . $JIT_Poll_Result;
		
		$JIT_Poll_Results=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE JIT_Q_ID=%d order by id", $Cooked_Poll_ID));

		for($i=0;$i<count($JIT_Poll_Answers);$i++)
		{
			$JIT_Poll_Result=$JIT_Poll_Results[$i]->JIT_Poll_Votes . '^';
			echo $JIT_Poll_Result;
		}
		die();
	}
	add_action( 'wp_ajax_Update_votes', 'Update_votes_callback' );
	add_action( 'wp_ajax_nopriv_Update_votes', 'Update_votes_callback' );

	function Update_votes_callback()
	{
		$votes=sanitize_text_field($_POST['foobar']);
		$data=explode('$#$',$votes);
		$vote=explode('*&^&*', $data[1]);

		global $wpdb;

		$table_name  =  $wpdb->prefix . "juna_it_poll_manager";
		$table_name2 =  $wpdb->prefix . "juna_it_answer_manager";
		$table_name3 =  $wpdb->prefix . "juna_it_poll_results";
		
		$selected_quest=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE JIT_Poll_Question= %s", $data[0] ));

		$answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE JIT_Poll_id= %s order by id", $selected_quest));

		for($i=0;$i<count($answers);$i++)
		{
			$wpdb->query($wpdb->prepare("UPDATE  $table_name3 set JIT_Poll_Votes= %s WHERE JIT_A_ID= %d",$vote[$i], $answers[$i]->id));
		}
		
		die();
	}
?>