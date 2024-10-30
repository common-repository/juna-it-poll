<?php
	function Juna_IT_Poll_GET_Shortcode_ID($atts, $content = null)
	{
		$atts=shortcode_atts(
			array(
				"id"=>"1"
			),$atts
		);
		return Juna_IT_Poll_Draw_Shortcode($atts['id']);
	}
	add_shortcode('Juna_IT_Poll', 'Juna_IT_Poll_GET_Shortcode_ID');
	function Juna_IT_Poll_Draw_Shortcode($Pid)
	{
		ob_start();	
			$args = shortcode_atts(array('name' => 'Widget Area','id'=>'','description'=>'','class'=>'','before_widget'=>'','after_widget'=>'','before_title'=>'','AFTER_TITLE'=>'','widget_id'=>'','widget_name'=>'Juna-IT-Poll'), $atts, 'Juna-IT-Poll' );
			$Juna_IT_Poll=new Juna_IT_Poll;

			$instance=array('JIT_Poll_Question'=>$Pid);
			$Juna_IT_Poll->widget($args,$instance);	
			$cont[]= ob_get_contents();
		ob_end_clean();	
		return $cont[0];		
	}
?>