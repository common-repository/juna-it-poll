<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;

	$table_name  = $wpdb->prefix . "juna_it_poll_manager";
	$table_name1 = $wpdb->prefix . "juna_it_answer_manager";
	$table_name2 = $wpdb->prefix . "juna_it_poll_font_family";
	$table_name3 = $wpdb->prefix . "juna_it_poll_standart";
	$table_name4 = $wpdb->prefix . "juna_it_poll_results";

	$sql='CREATE TABLE IF NOT EXISTS ' .$table_name.' (
		id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		JIT_Poll_Question VARCHAR(255) NOT NULL,
		JIT_Poll_Type VARCHAR(255) NOT NULL,
		JIT_Poll_Setting VARCHAR(255) NOT NULL,
		JIT_PollAns_Count VARCHAR(255) NOT NULL,
		PRIMARY KEY (id))';
	$sql1='CREATE TABLE IF NOT EXISTS ' .$table_name1.' (
		id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		JIT_Poll_Ans VARCHAR(255) NOT NULL, 
		JIT_Poll_UpMedia VARCHAR(255) NOT NULL,
		JIT_Poll_Col VARCHAR(255) NOT NULL,
		JIT_Poll_id INTEGER(10) NOT NULL,
		PRIMARY KEY (id))';
	$sql2 = 'CREATE TABLE IF NOT EXISTS ' .$table_name2 . '(
		id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		Font_family VARCHAR(255) NOT NULL,
		PRIMARY KEY  (id) )';
	$sql3 = 'CREATE TABLE IF NOT EXISTS ' .$table_name3 . '(
		id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		JIT_Poll_Set_Title VARCHAR(255) NOT NULL,
		JIT_Poll_Set_Type VARCHAR(255) NOT NULL,
		JIT_Poll_WidW VARCHAR(255) NOT NULL,
		JIT_PollT_BgC VARCHAR(255) NOT NULL,
		JIT_Poll_WidBW VARCHAR(255) NOT NULL,
		JIT_Poll_WidBS VARCHAR(255) NOT NULL,
		JIT_PollT_WidBC VARCHAR(255) NOT NULL,
		JIT_Poll_WidBR VARCHAR(255) NOT NULL,
		JIT_Poll_AnsSp VARCHAR(255) NOT NULL,
		JIT_Poll_VT VARCHAR(255) NOT NULL,
		JIT_Poll_QFS VARCHAR(255) NOT NULL,
		JIT_Poll_QFF VARCHAR(255) NOT NULL,
		JIT_PollT_QC VARCHAR(255) NOT NULL,
		JIT_PollT_QBgC VARCHAR(255) NOT NULL,
		JIT_PollT_LAQShow VARCHAR(255) NOT NULL,
		JIT_PollT_LAQW VARCHAR(255) NOT NULL,
		JIT_PollT_LAQS VARCHAR(255) NOT NULL,
		JIT_PollT_LAQC VARCHAR(255) NOT NULL,
		JIT_PollT_AFS VARCHAR(255) NOT NULL,
		JIT_Poll_AFF VARCHAR(255) NOT NULL,
		JIT_PollT_AC VARCHAR(255) NOT NULL,
		JIT_PollT_ABgC VARCHAR(255) NOT NULL,
		JIT_PollT_ABW VARCHAR(255) NOT NULL,
		JIT_PollT_ABS VARCHAR(255) NOT NULL,
		JIT_PollT_ABC VARCHAR(255) NOT NULL,
		JIT_PollT_ABR VARCHAR(255) NOT NULL,
		JIT_PollT_ButBgC VARCHAR(255) NOT NULL,
		JIT_PollT_ButC VARCHAR(255) NOT NULL,
		JIT_PollT_ButFS VARCHAR(255) NOT NULL,
		JIT_Poll_ButFF VARCHAR(255) NOT NULL,
		JIT_PollT_ButBW VARCHAR(255) NOT NULL,
		JIT_PollT_ButBS VARCHAR(255) NOT NULL,
		JIT_PollT_ButBC VARCHAR(255) NOT NULL,
		JIT_PollT_ButBR VARCHAR(255) NOT NULL,
		JIT_PollT_ButPos VARCHAR(255) NOT NULL,
		JIT_PollT_ButText VARCHAR(255) NOT NULL,
		JIT_PollT_ButHBgC VARCHAR(255) NOT NULL,
		JIT_PollT_ButHC VARCHAR(255) NOT NULL,
		JIT_PollT_AnsShow VARCHAR(255) NOT NULL,
		JIT_PollT_AnsPos VARCHAR(255) NOT NULL,
		JIT_PollT_AOP VARCHAR(255) NOT NULL,
		JIT_PollT_IP_IW VARCHAR(255) NOT NULL,
		JIT_PollT_HBgC VARCHAR(255) NOT NULL,
		JIT_PollT_HOP VARCHAR(255) NOT NULL,
		JIT_PollT_HText VARCHAR(255) NOT NULL,
		JIT_Poll_HFS VARCHAR(255) NOT NULL,
		JIT_Poll_HFF VARCHAR(255) NOT NULL,
		JIT_PollT_HTC VARCHAR(255) NOT NULL,
		JIT_PollT_IP_IH VARCHAR(255) NOT NULL,
		PRIMARY KEY (id))';
	$sql4 = 'CREATE TABLE IF NOT EXISTS ' .$table_name4 . '(
		id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		JIT_Q_ID INTEGER(10) NOT NULL,
		JIT_A_ID INTEGER(10) NOT NULL,
		JIT_Poll_Votes INTEGER(10) NOT NULL,
		PRIMARY KEY  (id) )';
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	dbDelta($sql4);

	$JIT_Poll_Quests=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d",0));
	if(count($JIT_Poll_Quests)==0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name (id, JIT_Poll_Question, JIT_Poll_Type, JIT_Poll_Setting, JIT_PollAns_Count) VALUES (%d, %s, %s, %s, %s)", '','Do You Like Our Plugin?', 'Standart Poll', 'Standart Poll', '4'));

		$JIT_Poll_Quest_Main=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE JIT_Poll_Question=%s",'Do You Like Our Plugin?'));

		$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, JIT_Poll_Ans, JIT_Poll_UpMedia, JIT_Poll_Col, JIT_Poll_id) VALUES (%d, %s, %s, %s, %s)", '', 'Yes', '', '#ffffff', $JIT_Poll_Quest_Main[0]->id));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, JIT_Poll_Ans, JIT_Poll_UpMedia, JIT_Poll_Col, JIT_Poll_id) VALUES (%d, %s, %s, %s, %s)", '', 'No', '', '#ffffff', $JIT_Poll_Quest_Main[0]->id));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, JIT_Poll_Ans, JIT_Poll_UpMedia, JIT_Poll_Col, JIT_Poll_id) VALUES (%d, %s, %s, %s, %s)", '', 'Not at All', '', '#ffffff', $JIT_Poll_Quest_Main[0]->id));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, JIT_Poll_Ans, JIT_Poll_UpMedia, JIT_Poll_Col, JIT_Poll_id) VALUES (%d, %s, %s, %s, %s)", '', 'Great', '', '#ffffff', $JIT_Poll_Quest_Main[0]->id));

		$JIT_Poll_Ans_Main=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE JIT_Poll_id=%s", $JIT_Poll_Quest_Main[0]->id));
		$JIT_Poll_Main_Votes=array("100","35","40","350");
		for($i=0;$i<count($JIT_Poll_Ans_Main);$i++)
		{
			$wpdb->query($wpdb->prepare("INSERT INTO $table_name4 (id, JIT_Q_ID, JIT_A_ID, JIT_Poll_Votes) VALUES (%d, %s, %s, %s)", '', $JIT_Poll_Quest_Main[0]->id, $JIT_Poll_Ans_Main[$i]->id, $JIT_Poll_Main_Votes[$i]));
		}
	}
	$Pollfamily = array('Abadi MT Condensed Light','Aharoni','Aldhabi','Andalus','Angsana New',' AngsanaUPC','Aparajita','Arabic Typesetting','Arial',
		'Arial Black','Batang','BatangChe','Browallia New','BrowalliaUPC','Calibri','Calibri Light','Calisto MT','Cambria','Candara','Century Gothic',
		'Comic Sans MS','Consolas','Constantia','Copperplate Gothic','Copperplate Gothic Light','Corbel','Cordia New','CordiaUPC','Courier New',
		'DaunPenh','David','DFKai-SB','DilleniaUPC','DokChampa','Dotum','DotumChe','Ebrima','Estrangelo Edessa','EucrosiaUPC','Euphemia','FangSong',
		'Franklin Gothic Medium','FrankRuehl','FreesiaUPC','Gabriola','Gadugi','Gautami','Georgia','Gisha','Gulim','GulimChe','Gungsuh','GungsuhChe',
		'Impact','IrisUPC','Iskoola Pota','JasmineUPC','KaiTi','Kalinga','Kartika','Khmer UI','KodchiangUPC','Kokila','Lao UI','Latha','Leelawadee',
		'Levenim MT','LilyUPC','Lucida Console','Lucida Handwriting Italic','Lucida Sans Unicode','Malgun Gothic','Mangal','Manny ITC','Marlett',
		'Meiryo','Meiryo UI','Microsoft Himalaya','Microsoft JhengHei','Microsoft JhengHei UI','Microsoft New Tai Lue','Microsoft PhagsPa',
		'Microsoft Sans Serif','Microsoft Tai Le','Microsoft Uighur','Microsoft YaHei','Microsoft YaHei UI','Microsoft Yi Baiti','MingLiU_HKSCS',
		'MingLiU_HKSCS-ExtB','Miriam','Mongolian Baiti','MoolBoran','MS UI Gothic','MV Boli','Myanmar Text','Narkisim','Nirmala UI','News Gothic MT',
		'NSimSun','Nyala','Palatino Linotype','Plantagenet Cherokee','Raavi','Rod','Sakkal Majalla','Segoe Print','Segoe Script','Segoe UI Symbol',
		'Shonar Bangla','Shruti','SimHei','SimKai','Simplified Arabic','SimSun','SimSun-ExtB','Sylfaen','Tahoma','Times New Roman','Traditional Arabic',
		'Trebuchet MS','Tunga','Utsaah','Vani','Vijaya');

	$Juna_IT_Poll_Count_Fonts=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id>%d",0));
	if(count($Juna_IT_Poll_Count_Fonts)==0)
	{
		for($i=0;$i<count($Pollfamily);$i++)
		{
			$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Font_family) VALUES (%d, %s)", '', $Pollfamily[$i]));
		}
	}
	$JIT_Poll_Sets=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id>%d",0));
	if(count($JIT_Poll_Sets)<5)
	{	
		$wpdb->query($wpdb->prepare("DELETE FROM $table_name3 WHERE id>%d",0));	
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, JIT_Poll_Set_Title, JIT_Poll_Set_Type, JIT_Poll_WidW, JIT_PollT_BgC, JIT_Poll_WidBW, JIT_Poll_WidBS, JIT_PollT_WidBC, JIT_Poll_WidBR, JIT_Poll_AnsSp, JIT_Poll_VT, JIT_Poll_QFS, JIT_Poll_QFF, JIT_PollT_QC, JIT_PollT_QBgC, JIT_PollT_LAQShow, JIT_PollT_LAQW, JIT_PollT_LAQS, JIT_PollT_LAQC, JIT_PollT_AFS, JIT_Poll_AFF, JIT_PollT_AC, JIT_PollT_ABgC, JIT_PollT_ABW, JIT_PollT_ABS, JIT_PollT_ABC, JIT_PollT_ABR, JIT_PollT_ButBgC, JIT_PollT_ButC, JIT_PollT_ButFS, JIT_Poll_ButFF, JIT_PollT_ButBW, JIT_PollT_ButBS, JIT_PollT_ButBC, JIT_PollT_ButBR, JIT_PollT_ButPos, JIT_PollT_ButText, JIT_PollT_ButHBgC, JIT_PollT_ButHC, JIT_PollT_AnsShow, JIT_PollT_AnsPos, JIT_PollT_AOP, JIT_PollT_IP_IW, JIT_PollT_HBgC, JIT_PollT_HOP, JIT_PollT_HText, JIT_Poll_HFS, JIT_Poll_HFF, JIT_PollT_HTC, JIT_PollT_IP_IH) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', 'Standart Poll', 'Standart Poll', '250px', '#dd8500', '1px', 'solid', '#dd9933', '0px', '4px', 'vote', '18px', 'Arial', '#ffffff', '#dd9933', 'Yes', '1px', 'solid', '#ffffff', '15px', 'Arial', '#ffffff', '#dd8500', '0px', 'solid', '#dd8500', '2px', '#dd9933', '#ffffff', '19px', 'Arial', '1px', 'dotted', '#dd8500', '0px', 'center', 'Vote', '#dd8500', '#ffffff', 'Yes', 'top', '0.6', '150px', '#c0c0c0', '0.6', 'Vote', '24px', 'Arial', '#000000','100px'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, JIT_Poll_Set_Title, JIT_Poll_Set_Type, JIT_Poll_WidW, JIT_PollT_BgC, JIT_Poll_WidBW, JIT_Poll_WidBS, JIT_PollT_WidBC, JIT_Poll_WidBR, JIT_Poll_AnsSp, JIT_Poll_VT, JIT_Poll_QFS, JIT_Poll_QFF, JIT_PollT_QC, JIT_PollT_QBgC, JIT_PollT_LAQShow, JIT_PollT_LAQW, JIT_PollT_LAQS, JIT_PollT_LAQC, JIT_PollT_AFS, JIT_Poll_AFF, JIT_PollT_AC, JIT_PollT_ABgC, JIT_PollT_ABW, JIT_PollT_ABS, JIT_PollT_ABC, JIT_PollT_ABR, JIT_PollT_ButBgC, JIT_PollT_ButC, JIT_PollT_ButFS, JIT_Poll_ButFF, JIT_PollT_ButBW, JIT_PollT_ButBS, JIT_PollT_ButBC, JIT_PollT_ButBR, JIT_PollT_ButPos, JIT_PollT_ButText, JIT_PollT_ButHBgC, JIT_PollT_ButHC, JIT_PollT_AnsShow, JIT_PollT_AnsPos, JIT_PollT_AOP, JIT_PollT_IP_IW, JIT_PollT_HBgC, JIT_PollT_HOP, JIT_PollT_HText, JIT_Poll_HFS, JIT_Poll_HFF, JIT_PollT_HTC, JIT_PollT_IP_IH) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', 'Pie Chart', 'Pie Chart', '250px', '#dd8500', '1px', 'solid', '#dd9933', '0px', '5px', 'vote', '17px', 'Arial', '#ffffff', '#dd8500', 'Yes', '1px', 'solid', '#ffffff', '15px', 'Arial', '#ffffff', '#0073aa', '1px', 'solid', '#dd8500', '2px', '#0073aa', '#ffffff', '23px', 'Arial', '1px', 'dotted', '#000000', '3px', 'center', 'Vote', '#ffffff', '#0073aa', 'Yes', 'top', '0.6', '150px', '#c0c0c0', '0.6', 'Vote', '24px', 'Arial', '#000000', '100px'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, JIT_Poll_Set_Title, JIT_Poll_Set_Type, JIT_Poll_WidW, JIT_PollT_BgC, JIT_Poll_WidBW, JIT_Poll_WidBS, JIT_PollT_WidBC, JIT_Poll_WidBR, JIT_Poll_AnsSp, JIT_Poll_VT, JIT_Poll_QFS, JIT_Poll_QFF, JIT_PollT_QC, JIT_PollT_QBgC, JIT_PollT_LAQShow, JIT_PollT_LAQW, JIT_PollT_LAQS, JIT_PollT_LAQC, JIT_PollT_AFS, JIT_Poll_AFF, JIT_PollT_AC, JIT_PollT_ABgC, JIT_PollT_ABW, JIT_PollT_ABS, JIT_PollT_ABC, JIT_PollT_ABR, JIT_PollT_ButBgC, JIT_PollT_ButC, JIT_PollT_ButFS, JIT_Poll_ButFF, JIT_PollT_ButBW, JIT_PollT_ButBS, JIT_PollT_ButBC, JIT_PollT_ButBR, JIT_PollT_ButPos, JIT_PollT_ButText, JIT_PollT_ButHBgC, JIT_PollT_ButHC, JIT_PollT_AnsShow, JIT_PollT_AnsPos, JIT_PollT_AOP, JIT_PollT_IP_IW, JIT_PollT_HBgC, JIT_PollT_HOP, JIT_PollT_HText, JIT_Poll_HFS, JIT_Poll_HFF, JIT_PollT_HTC, JIT_PollT_IP_IH) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', 'Image', 'Image Poll', '330px', '#c9c9c9', '1px', 'solid', '#c9c9c9', '4px', '5px', 'vote', '19px', 'Arial', '#000000', '#c9c9c9', 'Yes', '1px', 'solid', '#ffffff', '15px', 'Arial', '#ffffff', '#000000', '1px', 'solid', '#c9c9c9', '2px', '#0073aa', '#ffffff', '23px', 'Arial', '1px', 'dotted', '#000000', '3px', 'center', 'Vote', '#ffffff', '#0073aa', 'Yes', 'top', '0.7', '153px', '#ffffff', '0.7', 'Vote', '20px', 'Arial', '#000000', '100px'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, JIT_Poll_Set_Title, JIT_Poll_Set_Type, JIT_Poll_WidW, JIT_PollT_BgC, JIT_Poll_WidBW, JIT_Poll_WidBS, JIT_PollT_WidBC, JIT_Poll_WidBR, JIT_Poll_AnsSp, JIT_Poll_VT, JIT_Poll_QFS, JIT_Poll_QFF, JIT_PollT_QC, JIT_PollT_QBgC, JIT_PollT_LAQShow, JIT_PollT_LAQW, JIT_PollT_LAQS, JIT_PollT_LAQC, JIT_PollT_AFS, JIT_Poll_AFF, JIT_PollT_AC, JIT_PollT_ABgC, JIT_PollT_ABW, JIT_PollT_ABS, JIT_PollT_ABC, JIT_PollT_ABR, JIT_PollT_ButBgC, JIT_PollT_ButC, JIT_PollT_ButFS, JIT_Poll_ButFF, JIT_PollT_ButBW, JIT_PollT_ButBS, JIT_PollT_ButBC, JIT_PollT_ButBR, JIT_PollT_ButPos, JIT_PollT_ButText, JIT_PollT_ButHBgC, JIT_PollT_ButHC, JIT_PollT_AnsShow, JIT_PollT_AnsPos, JIT_PollT_AOP, JIT_PollT_IP_IW, JIT_PollT_HBgC, JIT_PollT_HOP, JIT_PollT_HText, JIT_Poll_HFS, JIT_Poll_HFF, JIT_PollT_HTC, JIT_PollT_IP_IH) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', 'Video', 'Video Poll', '330px', '#c9c9c9', '1px', 'solid', '#c9c9c9', '0px', '5px', 'vote', '19px', 'Arial', '#000000', '#c9c9c9', 'Yes', '2px', 'solid', '#ffffff', '15px', 'Arial', '#ffffff', '#000000', '1px', 'solid', '#c9c9c9', '0px', '#0073aa', '#ffffff', '23px', 'Arial', '1px', 'dotted', '#000000', '3px', 'center', 'Vote', '#ffffff', '#0073aa', 'Yes', 'top', '0.7', '153px', '#ffffff', '0.8', 'Vote', '18px', 'Arial', '#000000', '100px'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, JIT_Poll_Set_Title, JIT_Poll_Set_Type, JIT_Poll_WidW, JIT_PollT_BgC, JIT_Poll_WidBW, JIT_Poll_WidBS, JIT_PollT_WidBC, JIT_Poll_WidBR, JIT_Poll_AnsSp, JIT_Poll_VT, JIT_Poll_QFS, JIT_Poll_QFF, JIT_PollT_QC, JIT_PollT_QBgC, JIT_PollT_LAQShow, JIT_PollT_LAQW, JIT_PollT_LAQS, JIT_PollT_LAQC, JIT_PollT_AFS, JIT_Poll_AFF, JIT_PollT_AC, JIT_PollT_ABgC, JIT_PollT_ABW, JIT_PollT_ABS, JIT_PollT_ABC, JIT_PollT_ABR, JIT_PollT_ButBgC, JIT_PollT_ButC, JIT_PollT_ButFS, JIT_Poll_ButFF, JIT_PollT_ButBW, JIT_PollT_ButBS, JIT_PollT_ButBC, JIT_PollT_ButBR, JIT_PollT_ButPos, JIT_PollT_ButText, JIT_PollT_ButHBgC, JIT_PollT_ButHC, JIT_PollT_AnsShow, JIT_PollT_AnsPos, JIT_PollT_AOP, JIT_PollT_IP_IW, JIT_PollT_HBgC, JIT_PollT_HOP, JIT_PollT_HText, JIT_Poll_HFS, JIT_Poll_HFF, JIT_PollT_HTC, JIT_PollT_IP_IH) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', 'Column Chart', 'Column Chart', '250px', '#000000', '1px', 'solid', '#000000', '4px', '12px', 'vote', '17px', 'Arial', '#ffffff', '#000000', 'Yes', '2px', 'solid', '#ffffff', '15px', 'Arial', '#ffffff', '#000000', '0px', 'solid', '#ffffff', '0px', '#0073aa', '#ffffff', '23px', 'Arial', '1px', 'dotted', '#000000', '3px', 'center', 'Vote', '#ffffff', '#0073aa', 'Yes', 'top', '0.6', '150px', '#c0c0c0', '0.6', 'Vote', '24px', 'Arial', '#000000', '100px'));
	}
?>