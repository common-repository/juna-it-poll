<?php
	class Juna_IT_Poll extends WP_Widget
	{
		function __construct()
 	  	{
 			$params=array('name'=>'Juna-IT-Poll','description'=>'This is the widget of Juna-IT Poll plugin');
			parent::__construct('Juna-IT-Poll','',$params);
 	  	}
 	  	function form($instance)
 		{
 			$JIT_Poll_Q=$instance['JIT_Poll_Question'];
		   	?>
		   	<div>			  
			   	<p>
			   		Choose Question:
			   		<select name="<?php echo $this->get_field_name('JIT_Poll_Question'); ?>" class="widefat" > 
				   		<?php
				   			global $wpdb;
				   			$table_name  = $wpdb->prefix . "juna_it_poll_manager";
				   			$JIT_Poll_Q=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d",0));
				   			foreach ($JIT_Poll_Q as $JIT_Poll_Quest)
				   			{
				   				$JIT_Poll_Question1 = explode('*^*', $JIT_Poll_Quest->JIT_Poll_Question);
								$JIT_Poll_Question2 = implode('"', $JIT_Poll_Question1);
								$JIT_Poll_Question3 = explode("*&*", $JIT_Poll_Question2);
								$JIT_Poll_Question  = implode("'", $JIT_Poll_Question3);
				   				?><option value="<?php echo $JIT_Poll_Quest->id;?>"><?php echo $JIT_Poll_Question;?></option><?php 
				   			}
				   		?>			   		
			   		</select>
			   	</p>		   
		   	</div>
		   	<?php
 		}
 		function widget($args,$instance)
 		{
 			extract($args);
 			$JIT_Poll_Q=empty($instance['JIT_Poll_Question']) ? '' : $instance['JIT_Poll_Question'];
 			global $wpdb;
			$table_name  = $wpdb->prefix . "juna_it_poll_manager";
			$table_name1 = $wpdb->prefix . "juna_it_answer_manager";
			$table_name3 = $wpdb->prefix . "juna_it_poll_standart";

			$JIT_Poll_Pars=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id=%d",$JIT_Poll_Q));
			$JIT_Poll_Ans=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE JIT_Poll_id=%d order by id",$JIT_Poll_Q));
			$JIT_Poll_StandPar=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE JIT_Poll_Set_Type=%s AND JIT_Poll_Set_Title=%s", $JIT_Poll_Pars[0]->JIT_Poll_Type, $JIT_Poll_Pars[0]->JIT_Poll_Setting));
			?>
				<?php if($JIT_Poll_Pars[0]->JIT_Poll_Type=='Standart Poll'){?>
					<style type="text/css">
						.JIT_Poll_Vote_But_<?php echo $JIT_Poll_Q;?>
						{
							margin-top:10px !important;
							margin-bottom:5px !important;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButC;?> !important;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButBgC;?> !important;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_ButFF;?> !important;
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButFS;?>;
							padding:0 20px 0 20px !important;
							border:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButBC;?> !important;
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButBR;?> !important;
							cursor: pointer !important;
							transition-duration:0.5s !important;
													
						}
						.JIT_Poll_Vote_But_<?php echo $JIT_Poll_Q;?>:hover
						{
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButHC;?> !important;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButHBgC;?> !important;
						}
						.JIT_Poll_Div_<?php echo $JIT_Poll_Q;?>
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							margin: 0 auto !important;
							width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>;
							max-width:100%;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QBgC;?> !important;
						}
						.JIT_Poll_Quest_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFF;?> !important;
							color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QC;?> !important;
							text-align: center !important; 
							padding:0px; 
							margin: 0px auto !important; 
							<?php if($JIT_Poll_StandPar[0]->JIT_PollT_LAQShow=='Yes'){?>border-bottom:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQC;}?> !important; 
							width: 95%  !important;
							text-shadow: 0px 1px 2px white !important; 
						}
						.JIT_Poll_Bg_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_BgC;?> !important;
							border-top-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-top-left-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-bottom-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							border-bottom-left-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
						}
						.JIT_Poll_Answers_Div_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AFF;?> !important;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AC;?> !important;
							margin-top: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AnsSp;?> !important;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABgC;?> !important;
							border:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABC;?> !important;
							border-radius:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
						}
						.JIT_Poll_Vote_Div_<?php echo $JIT_Poll_Q;?>
						{
							text-align: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButPos;?> !important;
							margin: auto !important; 
							width: 95% !important;
						}
						.JIT_Poll_Votes_Span_<?php echo $JIT_Poll_Q;?>
						{
							height: 8px;
							width: 85%; 
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABgC;?> !important;
							margin: 0 0 5px 15px;
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							display: none;
						}
						.JIT_Poll_Votes_Type_<?php echo $JIT_Poll_Q;?>
						{
							margin-left: 10px;
							display: none;
						}
						.JIT_Poll_Votes_Main_Span_<?php echo $JIT_Poll_Q;?>
						{
							border-radius:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AC;?> !important;
						}
						.JIT_Poll_Radio_<?php echo $JIT_Poll_Q;?>
						{
							width: 13px !important;
						}
					</style>
					<div style="width:100%; float:left">
						<div class="JIT_Poll_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_Div">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VT_<?php echo $JIT_Poll_Q;?>" value="<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_VT;?>">
							<p class="JIT_Poll_Quest_<?php echo $JIT_Poll_Q;?> JIT_Poll_Quest"><?php echo $JIT_Poll_Pars[0]->JIT_Poll_Question ;?></p>
							<div class="JIT_Poll_Bg_<?php echo $JIT_Poll_Q;?>">
								<?php for($i=0;$i<$JIT_Poll_Pars[0]->JIT_PollAns_Count;$i++){?>
									<div class="JIT_Poll_Answers_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_Answers_Div">
										<div>
											<input type="radio" class="JIT_Poll_Radio_<?php echo $JIT_Poll_Q;?>" name="JIT_Poll_Radio_<?php echo $JIT_Poll_Q;?>" style="margin-left:5px;" value="<?php echo $JIT_Poll_Ans[$i]->id;?>">
											<span style="margin-left:15px;"><?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Ans;?></span>
											<span class="JIT_Poll_Votes_Type_<?php echo $JIT_Poll_Q;?> JIT_Poll_Votes_Type_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?>"></span>
										</div>
										<span class="JIT_Poll_Votes_Span_<?php echo $JIT_Poll_Q;?>">
											<span class="JIT_Poll_Votes_Main_Span_<?php echo $JIT_Poll_Q;?> JIT_Poll_Votes_Span_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?>" style="width: 0%;height:100%;display: block"></span>
										</span>
									</div>
								<?php }?>
								<div class="JIT_Poll_Vote_Div_<?php echo $JIT_Poll_Q;?>"><input type="button" value="<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButText;?>" class="JIT_Poll_Vote_But_<?php echo $JIT_Poll_Q;?> JIT_Poll_Vote_But" onclick="JIT_Poll_Vote_Click(<?php echo $JIT_Poll_Q;?>)"></div>
							</div>
						</div>
					</div>
					<input type='text' style='display:none;' class='JIT_Poll_Div_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Quest_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Answers_Div_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Vote_But_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ButFS;?>'>
				<?php } else if($JIT_Poll_Pars[0]->JIT_Poll_Type=='Pie Chart'){?>
					<script src="<?php echo plugins_url('/Scripts/Juna-IT_Poll_Diagrams.js',__FILE__);?>"></script>
					<style type="text/css">
						.JIT_Poll_PC_Div_<?php echo $JIT_Poll_Q;?>
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							margin: 0 auto !important;
							width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QBgC;?> !important;
						}
						.JIT_Poll_PC_Quest_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFF;?> !important;
							color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QC;?> !important;
							text-align: center !important; 
							padding:0px; 
							margin: 0px auto !important; 
							<?php if($JIT_Poll_StandPar[0]->JIT_PollT_LAQShow=='Yes'){?>border-bottom:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQC;}?> !important; 
							width: 95%  !important;
							text-shadow: 0px 1px 2px white !important; 
						}
						.JIT_Poll_PC_Bg_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_BgC;?> !important;
							border-top-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-top-left-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-bottom-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							border-bottom-left-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
						}
						.JIT_Poll_Answers_PC_Div_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AFF;?> !important;
							margin-top: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AnsSp;?> !important;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AC;?> !important;
							border:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABC;?> !important;
							border-radius:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							cursor: pointer;
						}
						.JIT_Poll_Answers_PC_Div_<?php echo $JIT_Poll_Q;?>:hover
						{
							opacity: 0.6
						}
						.JIT_Poll_chartDiv_<?php echo $JIT_Poll_Q;?> .drawdiagram-container
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
						}
					</style>
					<div style="width:100%; float:left">
						<div class="JIT_Poll_PC_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_PC_Div">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VT_<?php echo $JIT_Poll_Q;?>" value="<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_VT;?>">
							<p class="JIT_Poll_PC_Quest_<?php echo $JIT_Poll_Q;?> JIT_Poll_PC_Quest"><?php echo $JIT_Poll_Pars[0]->JIT_Poll_Question ;?></p>
							<div class="JIT_Poll_PC_Bg_<?php echo $JIT_Poll_Q;?>">
								<?php for($i=0;$i<$JIT_Poll_Pars[0]->JIT_PollAns_Count;$i++){?>
									<div class="JIT_Poll_Answers_PC_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_PC_CSpan_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?> JIT_Poll_Answers_PC_Div" style="background-color: <?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Col;?>;" onclick="JIT_Poll_Pie_Chart_Votes(<?php echo $JIT_Poll_Q;?>,<?php echo $JIT_Poll_Ans[$i]->id;?>)">
										<span class="JIT_Poll_PC_Answer_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?>" style="margin-left:15px;"><?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Ans;?></span>
									</div>
								<?php }?>
							</div>
						</div>
						<div class="JIT_Poll_chartDiv_<?php echo $JIT_Poll_Q;?>" style="width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>; margin: 0 auto;"></div> 
					</div>
					<input type='text' style='display:none' class='JIT_Poll_PC_Div_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>' >
					<input type='text' style='display:none' class='JIT_Poll_PC_Quest_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>' >
					<input type='text' style='display:none' class='JIT_Poll_Answers_PC_Div_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>' >
				<?php } else if($JIT_Poll_Pars[0]->JIT_Poll_Type=='Image Poll'){?>
					<style type="text/css">
						.JIT_Poll_IP_Div_<?php echo $JIT_Poll_Q;?>
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							margin: 0 auto !important;
							width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QBgC;?> !important;
							overflow-y:hidden;
						}
						.JIT_Poll_IP_Quest_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFF;?> !important;
							color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QC;?> !important;
							text-align: center !important; 
							padding:0px; 
							margin: 0px auto !important; 
							<?php if($JIT_Poll_StandPar[0]->JIT_PollT_LAQShow=='Yes'){?>border-bottom:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQC;}?> !important; 
							width: 95%  !important;
							text-shadow: 0px 1px 2px white !important; 
						}
						.JIT_Poll_IP_Bg_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_BgC;?> !important;
							margin-top:5px;
							float: left;
						}
						.JIT_Poll_Answers_IP_Div_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AFF;?> !important;
							margin: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AnsSp;?> !important;
							border:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABC;?> !important;
							border-radius:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							cursor: pointer;
							width: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IW;?>;
							height: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IH;?>;
							float: left;							
							padding: 0;
							position: relative;
							transition-duration: 1s;
						}						
						.JIT_Poll_IP_Img_<?php echo $JIT_Poll_Q;?>
						{
							width: 100%; 
							height: 100% !important;
							position: relative;
							margin: 0 !important;
						}
						.JIT_Poll_IP_Ans_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABgC;?> !important;
							position: absolute; !important;
							<?php echo  $JIT_Poll_StandPar[0]->JIT_PollT_AnsPos;?>:0;
							width:100%;
							opacity: <?php echo  $JIT_Poll_StandPar[0]->JIT_PollT_AOP;?> !important;
							text-align: center;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AC;?> !important;
							padding:0px;
						}
						.JIT_Poll_IP_Ans_Hover_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HBgC;?> !important;
							position: absolute; 
							width: 0px;
							height: 0px;
							top:50%;
							left:50%;
							transform:translateY(-50%) translateX(-50%);
							-webkit-transform:translateY(-50%) translateX(-50%);
							opacity:0;
							text-align: center;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HTC;?> !important;
							transition:all 0.4s;
						}
						.JIT_Poll_Answers_IP_Div_<?php echo $JIT_Poll_Q;?>:hover .JIT_Poll_IP_Ans_Hover_<?php echo $JIT_Poll_Q;?>
						{
							width:100%;
							height:100%;
							opacity: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HOP;?> !important;
						}
						.JIT_Poll_IP_Span_<?php echo $JIT_Poll_Q;?>
						{
							position:relative;
							top: 50%;
							transform:translateY(-50%);
							-webkit-transform:translateY(-50%);
							display: block;
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_HFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_HFF;?> !important;
						}	
					</style>
					<div style="width:100%; float:left">
						<div class="JIT_Poll_IP_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_IP_Div">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VT_<?php echo $JIT_Poll_Q;?>" value="<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_VT;?>">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VON_<?php echo $JIT_Poll_Q;?>" value="">
							<p class="JIT_Poll_IP_Quest_<?php echo $JIT_Poll_Q;?> JIT_Poll_IP_Quest"><?php echo $JIT_Poll_Pars[0]->JIT_Poll_Question ;?></p>
							<div class="JIT_Poll_IP_Bg_<?php echo $JIT_Poll_Q;?>">
								<?php for($i=0;$i<$JIT_Poll_Pars[0]->JIT_PollAns_Count;$i++){?>
									<div class="JIT_Poll_Answers_IP_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_Answers_IP_Div" onclick="JIT_Poll_Image_Poll_Votes(<?php echo $JIT_Poll_Q;?>,<?php echo $JIT_Poll_Ans[$i]->id;?>)" >
										<img class="JIT_Poll_IP_Img_<?php echo $JIT_Poll_Q;?>" src="<?php echo $JIT_Poll_Ans[$i]->JIT_Poll_UpMedia;?>">
										<?php if($JIT_Poll_StandPar[0]->JIT_PollT_AnsShow=='Yes'){?>
											<div class="JIT_Poll_IP_Ans_<?php echo $JIT_Poll_Q;?> JIT_Poll_IP_Ans"><?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Ans;?></div>
										<?php }?>
										<div class="JIT_Poll_IP_Ans_Hover_<?php echo $JIT_Poll_Q;?>"><span class="JIT_Poll_IP_Span_<?php echo $JIT_Poll_Q;?> JIT_Poll_IP_Span_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?> JIT_Poll_IP_Span"><?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HText;?></span></div>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
					<input type='text' style='display:none;' class='JIT_Poll_IP_Div_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Answers_IP_Div_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IW;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Answers_IP_Div_Height' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IH;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_IP_Quest_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Answers_IP_Div_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_IP_Span_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_HFS;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_IP_Ans_Hover_Opacity' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HOP;?>'>
					
				<?php } else if($JIT_Poll_Pars[0]->JIT_Poll_Type=='Video Poll'){?>
					<style type="text/css">
						.JIT_Poll_VP_Div_<?php echo $JIT_Poll_Q;?>
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							margin: 0 auto !important;
							width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QBgC;?> !important;
							overflow:auto;
						}
						.JIT_Poll_VP_Quest_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFF;?> !important;
							color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QC;?> !important;
							text-align: center !important; 
							padding:0px; 
							margin: 0px auto !important; 
							<?php if($JIT_Poll_StandPar[0]->JIT_PollT_LAQShow=='Yes'){?>border-bottom:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQC;}?> !important; 
							width: 95%  !important;
							text-shadow: 0px 1px 2px white !important; 
						}
						.JIT_Poll_VP_Bg_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_BgC;?> !important;
							float: left;
							padding-top: 5px;
						}
						.JIT_Poll_Answers_VP_Div_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AFF;?> !important;
							margin: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AnsSp;?> !important;
							border:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABC;?> !important;
							border-radius:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							cursor: pointer;
							width: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IW;?>;
							height: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IH;?>;
							float: left;							
							padding: 0;
							position: relative;
							transition-duration: 1s;
						}						
						.JIT_Poll_VP_Img_<?php echo $JIT_Poll_Q;?>
						{
							width: 100%; 
							height: 100% !important;
							position: relative;
							margin: 0 !important;
						}
						.JIT_Poll_VP_Ans_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABgC;?> !important;
							position: absolute !important;
							<?php echo  $JIT_Poll_StandPar[0]->JIT_PollT_AnsPos;?>:0;
							width:100%;
							opacity: <?php echo  $JIT_Poll_StandPar[0]->JIT_PollT_AOP;?> !important;
							text-align: center;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AC;?> !important;
						}
						.JIT_Poll_VP_Ans_Hover_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HBgC;?> !important;
							opacity: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HOP;?> !important;
							position: absolute; 
							width: 100%;
							<?php echo  $JIT_Poll_StandPar[0]->JIT_PollT_AnsPos;?>:0;
							display: none;
							text-align: center;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HTC;?> !important;
						}
						.JIT_Poll_Answers_VP_Div_<?php echo $JIT_Poll_Q;?>:hover .JIT_Poll_VP_Ans_Hover_<?php echo $JIT_Poll_Q;?>
						{
							display: inline;
						}
						.JIT_Poll_VP_Span_<?php echo $JIT_Poll_Q;?>
						{
							display: block;
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_HFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_HFF;?> !important;
						}	
						.JIT_Poll_Video_Container_<?php echo $JIT_Poll_Q;?>
						{
							position: fixed;
							height: 100%;
							width: 100%;
							top: 0;
							left: 0;
							background-color: #000;
							opacity: 0.6;
							display: none;
							cursor: pointer;
						}
						.JIT_Poll_Video_Iframe_Div_<?php echo $JIT_Poll_Q;?>
						{
							width:50%;
							height:50%;
							position: fixed;
							top: 20%;
							left:25%;
							z-index: 99999;
							display: none;
						}
						.JIT_Poll_Video_Iframe_<?php echo $JIT_Poll_Q;?>
						{
							width: 100%;
							height: 100%;
						}
					</style>
					<div style="width:100%; float:left">
						<div class="JIT_Poll_VP_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_VP_Div">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VT_<?php echo $JIT_Poll_Q;?>" value="<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_VT;?>">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VON_<?php echo $JIT_Poll_Q;?>" value="">
							<p class="JIT_Poll_VP_Quest_<?php echo $JIT_Poll_Q;?> JIT_Poll_VP_Quest"><?php echo $JIT_Poll_Pars[0]->JIT_Poll_Question ;?></p>
							<div class="JIT_Poll_VP_Bg_<?php echo $JIT_Poll_Q;?> JIT_Poll_VP_Bg">
								<?php for($i=0;$i<$JIT_Poll_Pars[0]->JIT_PollAns_Count;$i++){

									if(strpos($JIT_Poll_Ans[$i]->JIT_Poll_UpMedia,'youtube.com')>0)
						 			{							 				
						 				$JIT_Poll_Image_Src=explode('embed/',$JIT_Poll_Ans[$i]->JIT_Poll_UpMedia);
										$JIT_Poll_Image_Src_Real='http://img.youtube.com/vi/'.$JIT_Poll_Image_Src[1].'/mqdefault.jpg';
						 			}
						 			else if(strpos($JIT_Poll_Ans[$i]->JIT_Poll_UpMedia,'vimeo.com')>0)
						 			{	
						 				$JIT_Poll_Image_Src=explode('video/',$JIT_Poll_Ans[$i]->JIT_Poll_UpMedia);
										$JIT_Poll_Image_Src_Real=unserialize(file_get_contents("http://vimeo.com/api/v2/video/$JIT_Poll_Image_Src[1].php"));
									}	
									?>
									<div class="JIT_Poll_Answers_VP_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_Answers_VP_Div">
										<img class="JIT_Poll_VP_Img_<?php echo $JIT_Poll_Q;?>" src="<?php echo $JIT_Poll_Image_Src_Real;?>" onclick="JIT_Poll_Video_On_Big(<?php echo $JIT_Poll_Q;?>,'<?php echo $JIT_Poll_Ans[$i]->JIT_Poll_UpMedia;?>')">
										<?php if($JIT_Poll_StandPar[0]->JIT_PollT_AnsShow=='Yes'){?>
											<div class="JIT_Poll_VP_Ans_<?php echo $JIT_Poll_Q;?> JIT_Poll_VP_Ans"><?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Ans;?></div>
										<?php }?>
										<div class="JIT_Poll_VP_Ans_Hover_<?php echo $JIT_Poll_Q;?>" onclick="JIT_Poll_Video_Poll_Votes(<?php echo $JIT_Poll_Q;?>,<?php echo $JIT_Poll_Ans[$i]->id;?>)"><span class="JIT_Poll_VP_Span_<?php echo $JIT_Poll_Q;?> JIT_Poll_VP_Span_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?> JIT_Poll_VP_Span"><?php echo $JIT_Poll_StandPar[0]->JIT_PollT_HText;?></span></div>
									</div>
								<?php }?>
							</div>
						</div>
						<div class="JIT_Poll_Video_Container_<?php echo $JIT_Poll_Q;?>" onclick="JIT_Poll_Video_Big_Click(<?php echo $JIT_Poll_Q;?>)"></div>
						<div class="JIT_Poll_Video_Iframe_Div_<?php echo $JIT_Poll_Q;?>">
							<iframe class="JIT_Poll_Video_Iframe_<?php echo $JIT_Poll_Q;?>" src="" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<input type='text' style='display:none;' class='JIT_Poll_VP_Div_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>' >
					<input type='text' style='display:none;' class='JIT_Poll_VP_Img_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IW;?>' >
					<input type='text' style='display:none;' class='JIT_Poll_VP_Img_Height' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_IP_IH;?>' >
					<input type='text' style='display:none;' class='JIT_Poll_VP_Quest_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>' >
					<input type='text' style='display:none;' class='JIT_Poll_Answers_VP_Div_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>' >
					<input type='text' style='display:none;' class='JIT_Poll_VP_Span_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_HFS;?>' >
				<?php } else if($JIT_Poll_Pars[0]->JIT_Poll_Type=='Column Chart'){?>
					<script src="<?php echo plugins_url('/Scripts/Juna-IT_Poll_Diagrams.js',__FILE__);?>"></script>
					<style type="text/css">
						.JIT_Poll_CC_Div_<?php echo $JIT_Poll_Q;?>
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							margin: 0 auto !important;
							width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>;
							background-color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QBgC;?> !important;
						}
						.JIT_Poll_CC_Quest_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFF;?> !important;
							color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_QC;?> !important;
							text-align: center !important; 
							padding:0px; 
							margin: 0px auto !important; 
							<?php if($JIT_Poll_StandPar[0]->JIT_PollT_LAQShow=='Yes'){?>border-bottom:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_LAQC;}?> !important; 
							width: 95%  !important;
							text-shadow: 0px 1px 2px white !important; 
						}
						.JIT_Poll_CC_Bg_<?php echo $JIT_Poll_Q;?>
						{
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_BgC;?> !important;
							border-top-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-top-left-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-bottom-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
							border-bottom-left-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
						}
						.JIT_Poll_Answers_CC_Div_<?php echo $JIT_Poll_Q;?>
						{
							font-size:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>;
							font-family:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AFF;?> !important;
							margin-top: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_AnsSp;?> !important;
							color:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AC;?> !important;
							background-color: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABgC;?> !important;
							border:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABC;?> !important;
							border-radius:<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							cursor: pointer;
						}
						.JIT_Poll_Answers_CC_Div_<?php echo $JIT_Poll_Q;?>:hover
						{
							opacity: 0.6
						}
						.JIT_Poll_chartDiv_<?php echo $JIT_Poll_Q;?> .drawdiagram-container
						{
							border: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBW;?> <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBS;?> <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_WidBC;?> !important; 
							border-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidBR;?> !important;
						}
						.JIT_Poll_CC_CSpan_<?php echo $JIT_Poll_Q;?>
						{
							float: right !important;
							width: 8% ;
							display: block !important;
							border-top-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
							border-bottom-right-radius: <?php echo $JIT_Poll_StandPar[0]->JIT_PollT_ABR;?> !important;
						}
					</style>
					<div style="width:100%; float:left">
						<div class="JIT_Poll_CC_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_CC_Div">
							<input type="text" style="display: none;" class="JIT_Poll_Hid_VT_<?php echo $JIT_Poll_Q;?>" value="<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_VT;?>">
							<p class="JIT_Poll_CC_Quest_<?php echo $JIT_Poll_Q;?> JIT_Poll_CC_Quest"><?php echo $JIT_Poll_Pars[0]->JIT_Poll_Question ;?></p>
							<div class="JIT_Poll_CC_Bg_<?php echo $JIT_Poll_Q;?>">
								<?php for($i=0;$i<$JIT_Poll_Pars[0]->JIT_PollAns_Count;$i++){?>
									<div class="JIT_Poll_Answers_CC_Div_<?php echo $JIT_Poll_Q;?> JIT_Poll_Answers_CC_Div" onclick="JIT_Poll_Column_Chart_Votes(<?php echo $JIT_Poll_Q;?>,<?php echo $JIT_Poll_Ans[$i]->id;?>,<?php echo $i+1;?>)">
										<span class="JIT_Poll_CC_Answer_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?>" style="margin-left:15px;"><?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Ans;?></span>
										<span class="JIT_Poll_CC_CSpan_<?php echo $JIT_Poll_Q;?> JIT_Poll_CC_CSpan_<?php echo $JIT_Poll_Q;?>_<?php echo $i+1;?>" style="background-color: <?php echo $JIT_Poll_Ans[$i]->JIT_Poll_Col;?>;">
											<span style="visibility: hidden;"><?php echo $i+1;?></span>
										</span>
									</div>
								<?php }?>
							</div>
						</div>
						<div class="JIT_Poll_chartDiv_<?php echo $JIT_Poll_Q;?>" style="width:<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>; margin: 0 auto;"></div> 
					</div>
					<input type='text' style='display:none;' class='JIT_Poll_CC_Div_Width' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_WidW;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_CC_Quest_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_Poll_QFS;?>'>
					<input type='text' style='display:none;' class='JIT_Poll_Answers_CC_Div_Font_Size' value='<?php echo $JIT_Poll_StandPar[0]->JIT_PollT_AFS;?>'>

			<?php }
 		}
	}
?>