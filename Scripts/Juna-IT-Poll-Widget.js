jQuery(document).ready(function(){
	var JIT_Cook=document.cookie.split(';');
	var JIT_Cook_ID = [];
	for(var i=0;i<JIT_Cook.length;i++)
	{
		if(JIT_Cook[i].indexOf('username')>=0)
		{
			var JIT_Cook_Split=JIT_Cook[i].split('=');
			JIT_Cook_ID[JIT_Cook_ID.length]=JIT_Cook_Split[1];
		}
	}
	for(var i=0;i<JIT_Cook_ID.length;i++)
	{
		var ajaxurl = object.ajaxurl;
	  	var data = {
	    	action: 'JIT_Poll_Cook', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: JIT_Cook_ID[i], // translates into $_POST['foobar'] in PHP				
		};
		jQuery.post(ajaxurl, data, function(response){
			var JIT_Poll_Ajax_Params=response.split('&');
			var JIT_Poll_Params=JIT_Poll_Ajax_Params[0].split('^');
			var JIT_Poll_Votes=JIT_Poll_Ajax_Params[1].split('^');

			if(JIT_Poll_Params[1]=='Standart Poll')
			{
				var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_Params[0]).val();
				jQuery('.JIT_Poll_Radio_'+JIT_Poll_Params[0]).hide(700);

				jQuery('.JIT_Poll_Vote_Div_'+JIT_Poll_Params[0]).hide();
				jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_Params[0]).show();
				jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_Params[0]).css('display','block');

				var JIT_Poll_Results=[];

			 	for(i=0; i<JIT_Poll_Votes.length; i++)
			 	{
			 		if(JIT_Poll_Votes[i]=="")
			 		{
			 			continue;
			 		}
			 		else
			 		{
			 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
			 		}
			 	}

			 	/* data that will be shown in the widget */
			 	var JIT_Poll_Sum=0;
			 	var JIT_Poll_Widths = [];
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
			 	}

			 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
				
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{			
			 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
			 	}
			 	if(JIT_Poll_Hid_VT=='percent')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
				 	{
				 		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).animate({width:parseFloat(JIT_Poll_Widths[i]).toFixed(1)+'%'},1000);
						jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(parseFloat(JIT_Poll_Widths[i]).toFixed(1)+' %');
				 	}
			 	}
			 	else if(JIT_Poll_Hid_VT=='vote')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
				 	{
				 		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).animate({width:parseFloat(JIT_Poll_Widths[i]).toFixed(1)+'%'},1000);
						jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes');
				 	}
			 	}
			 	else if(JIT_Poll_Hid_VT=='both')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
				 	{
				 		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).animate({width:parseFloat(JIT_Poll_Widths[i]).toFixed(1)+'%'},1000);
						jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes'+ ' ( ' +parseFloat(JIT_Poll_Widths[i]).toFixed(1)+' % )');
				 	}
			 	}
			}
			else if(JIT_Poll_Params[1]=='Pie Chart')
			{
				var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_Params[0]).val();

				var JIT_Poll_Results=[];
			 	for(i=0; i<JIT_Poll_Votes.length; i++)
			 	{
			 		if(JIT_Poll_Votes[i]=="")
			 		{
			 			continue;
			 		}
			 		else
			 		{
			 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
			 		}
			 	}

			 	/* data that will be shown in the widget */
			 	var JIT_Poll_Sum=0;
			 	var JIT_Poll_Widths = [];
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
			 	}

			 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
				
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{			
			 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
			 	}

			 	var JIT_Poll_PC_Answers = [];

			 	for(i=1; i<=JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_PC_Answers[JIT_Poll_PC_Answers.length]=jQuery('.JIT_Poll_PC_Answer_'+JIT_Poll_Params[0]+'_'+i).html();
			 	}	

				var JIT_Poll_PC_Answers_Col =[];					

				for(i=1; i<=JIT_Poll_Results.length; i++)
				{
					JIT_Poll_PC_Answers_Col[JIT_Poll_PC_Answers_Col.length]=jQuery('.JIT_Poll_PC_CSpan_'+JIT_Poll_Params[0]+'_'+i).css('background-color');
				}
				var JIT_Poll_PC_dataSource= [];					

				for(i=0; i<JIT_Poll_Results.length; i++)
				{	
					JIT_Poll_PC_dataSource[JIT_Poll_PC_dataSource.length]= {name: JIT_Poll_PC_Answers[i],  y: JIT_Poll_Widths[i], sliced: true, selected: true, color: JIT_Poll_PC_Answers_Col[i], results: JIT_Poll_Results[i]};
				}

				var JIT_Poll_PC_Quest=jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_Params[0]).html();
				var JIT_Poll_PC_Quest_FS=parseInt(jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_Params[0]).css('font-size'));
				var JIT_Poll_PC_Quest_FF=jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_Params[0]).css('font-family');
				var JIT_Poll_PC_Quest_C=jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_Params[0]).css('color');
				var JIT_Poll_Answers_PC_Div=jQuery('.JIT_Poll_Answers_PC_Div_'+JIT_Poll_Params[0]).css('color');
				var JIT_Poll_PC_Bg=jQuery('.JIT_Poll_PC_Bg_'+JIT_Poll_Params[0]).css('background-color');
				var JIT_Poll_PC_Div=parseInt(jQuery('.JIT_Poll_PC_Div_'+JIT_Poll_Params[0]).css('width'));
				var JIT_Poll_PC_DivW=parseInt(jQuery('.JIT_Poll_PC_Div_'+JIT_Poll_Params[0]).css('height'));

				setTimeout(function(){
					jQuery('.JIT_Poll_PC_Div_'+JIT_Poll_Params[0]).hide(500);	
					if(JIT_Poll_Hid_VT=='percent')
					{
						JIT_Poll_VT='{point.y:.2f} %';
					}
					else if(JIT_Poll_Hid_VT=='vote')
					{
						JIT_Poll_VT='{point.results:.0f} votes';
					}
					else if(JIT_Poll_Hid_VT=='both')
					{
						JIT_Poll_VT='{point.results:.0f} votes ( {point.y:.2f} % )';
					}
					/* Drawing a chart */
					jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_Params[0]).show(1000);
					jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_Params[0]).drawdiagram({
				        chart: 
				        {
				            type: 'pie',
		                	align: 'center',		            
				            width: JIT_Poll_PC_Div,
				            backgroundColor: JIT_Poll_PC_Bg,		            
				            options3d: {
				                enabled: true,
				                alpha: 45,
				                beta: 0
				            }
				        },
				        legend:
		                {
		                	align: 'left',
							layout: 'horizontal',
							verticalAlign: 'bottom',
							x: 20,
							y: 20,
							itemMarginTop: 10,
		        			itemMarginBottom: 10,
		                },   
				        title: 
				        {
				            text: JIT_Poll_PC_Quest,
				            style:
				            {
				           	 	fontSize: JIT_Poll_PC_Quest_FS,
				           	 	fontFamily: JIT_Poll_PC_Quest_FF,
				           	 	color: JIT_Poll_PC_Quest_C,
				           	 	textShadow: '0px 1px 2px white' 
				            }
				        },
				        tooltip: 
				        {
				           	pointFormat: '{series.name}: <b>'+JIT_Poll_VT+'</b>'
				        },
				        plotOptions: 
				        {
				            pie: 
				            {
					            allowPointSelect: true,
					            cursor: 'pointer',
					            depth: 35,
					            dataLabels: 
					            {
				                    enabled: true,
				                    format: JIT_Poll_VT,
				                    style: 
				                    {
				                        fontWeight: 'bold',
				                        color: JIT_Poll_Answers_PC_Div,
				                    },
			                	},
			               		showInLegend: true,	               		
				            }
				        },
				        series: [{
				            type: 'pie',
				            name: 'Browser share',
				            data: JIT_Poll_PC_dataSource
				        }]
				    });
				},200);
			}
			else if(JIT_Poll_Params[1]=='Image Poll')
			{
				var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_Params[0]).val();
				var JIT_Poll_Results=[];

			 	for(i=0; i<JIT_Poll_Votes.length; i++)
			 	{
			 		if(JIT_Poll_Votes[i]=="")
			 		{
			 			continue;
			 		}
			 		else
			 		{
			 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
			 		}
			 	}

			 	/* data that will be shown in the widget */
			 	var JIT_Poll_Sum=0;
			 	var JIT_Poll_Widths = [];
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
			 	}

			 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
				
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{			
			 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
			 	}

			 	// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).hide(500);
			 	var JIT_Poll_IP_Ans_Hover_Opacity = jQuery('.JIT_Poll_IP_Ans_Hover_Opacity').val();
			 
			 	if(JIT_Poll_Hid_VT=='percent')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
			 		{
			 			setTimeout(function(){
			 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).show(500);
			 				jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).css({'width':'100%','height':'100%','opacity':JIT_Poll_IP_Ans_Hover_Opacity});
			 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).css('display','block');
			 			},700)
			 			jQuery('.JIT_Poll_IP_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Widths[i].toFixed(1)+'%');
			 		}
			 	}
			 	else if(JIT_Poll_Hid_VT=='vote')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
			 		{
			 			setTimeout(function(){
			 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).show(500);
			 				jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).css({'width':'100%','height':'100%','opacity':JIT_Poll_IP_Ans_Hover_Opacity});
			 			},700)
			 			jQuery('.JIT_Poll_IP_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes');
			 		}
			 	}
			 	else if(JIT_Poll_Hid_VT=='both')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
			 		{
			 			jQuery('.JIT_Poll_IP_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes'+' ('+JIT_Poll_Widths[i].toFixed(1)+'%)');
			 			setTimeout(function(){
			 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).show(500);
			 				jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_Params[0]).css({'width':'100%','height':'100%','opacity':JIT_Poll_IP_Ans_Hover_Opacity});
			 			},700)
			 		}
			 	}
			 	jQuery('.JIT_Poll_Hid_VON_'+JIT_Poll_Params[0]).val(JIT_Poll_Params[0]);
			}
			else if(JIT_Poll_Params[1]=='Video Poll')
			{
				var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_Params[0]).val();
				var JIT_Poll_Results=[];

			 	for(i=0; i<JIT_Poll_Votes.length; i++)
			 	{
			 		if(JIT_Poll_Votes[i]=="")
			 		{
			 			continue;
			 		}
			 		else
			 		{
			 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
			 		}
			 	}

			 	/* data that will be shown in the widget */
			 	var JIT_Poll_Sum=0;
			 	var JIT_Poll_Widths = [];
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
			 	}

			 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
				
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{			
			 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
			 	}

			 	jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_Params[0]).hide(500);
			 	if(JIT_Poll_Hid_VT=='percent')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
			 		{
			 			setTimeout(function(){
			 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_Params[0]).show(500);
			 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_Params[0]).css('display','block');
			 			},700)
			 			jQuery('.JIT_Poll_VP_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Widths[i].toFixed(1)+'%');
			 		}
			 	}
			 	else if(JIT_Poll_Hid_VT=='vote')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
			 		{
			 			setTimeout(function(){
			 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_Params[0]).show(500);
			 			},700)
			 			jQuery('.JIT_Poll_VP_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes');
			 		}
			 	}
			 	else if(JIT_Poll_Hid_VT=='both')
			 	{
			 		for(i=0; i<JIT_Poll_Results.length; i++)
			 		{
			 			jQuery('.JIT_Poll_VP_Span_'+JIT_Poll_Params[0]+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes'+' ('+JIT_Poll_Widths[i].toFixed(1)+'%)');
			 			setTimeout(function(){
			 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_Params[0]).show(500);
			 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_Params[0]).css('display','block');
			 			},700)
			 		}
			 	}
			 	jQuery('.JIT_Poll_Hid_VON_'+JIT_Poll_Params[0]).val(JIT_Poll_Params[0]);
			}
			else if(JIT_Poll_Params[1]=='Column Chart')
			{
				var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_Params[0]).val();

				var JIT_Poll_Results=[];
			 	for(i=0; i<JIT_Poll_Votes.length; i++)
			 	{
			 		if(JIT_Poll_Votes[i]=="")
			 		{
			 			continue;
			 		}
			 		else
			 		{
			 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
			 		}
			 	}

			 	/* data that will be shown in the widget */
			 	var JIT_Poll_Sum=0;
			 	var JIT_Poll_Widths = [];
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
			 	}

			 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
				
			 	for(i=0; i<JIT_Poll_Results.length; i++)
			 	{			
			 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
			 	}

			 	var JIT_Poll_PC_Answers = [];

			 	for(i=1; i<=JIT_Poll_Results.length; i++)
			 	{
			 		JIT_Poll_PC_Answers[JIT_Poll_PC_Answers.length]=jQuery('.JIT_Poll_CC_Answer_'+JIT_Poll_Params[0]+'_'+i).html();
				}

				var JIT_Poll_PC_Answers_Col =[];					

				for(i=1; i<=JIT_Poll_Results.length; i++)
				{
					JIT_Poll_PC_Answers_Col[JIT_Poll_PC_Answers_Col.length]=jQuery('.JIT_Poll_CC_CSpan_'+JIT_Poll_Params[0]+'_'+i).css('background-color');
				}
				var JIT_Poll_PC_dataSource= [];					

				for(i=0; i<JIT_Poll_Results.length; i++)
				{	
					JIT_Poll_PC_dataSource[JIT_Poll_PC_dataSource.length]= {name: JIT_Poll_PC_Answers[i],  y: JIT_Poll_Widths[i], color: JIT_Poll_PC_Answers_Col[i], results: JIT_Poll_Results[i]};
				}
				var JIT_Poll_PC_Quest=jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_Params[0]).html();
				var JIT_Poll_PC_Quest_FS=parseInt(jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_Params[0]).css('font-size'));
				var JIT_Poll_PC_Quest_FF=jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_Params[0]).css('font-family');
				var JIT_Poll_PC_Quest_C=jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_Params[0]).css('color');
				var JIT_Poll_Answers_PC_Div=jQuery('.JIT_Poll_Answers_CC_Div_'+JIT_Poll_Params[0]).css('color');
				var JIT_Poll_PC_Bg=jQuery('.JIT_Poll_CC_Bg_'+JIT_Poll_Params[0]).css('background-color');
				var JIT_Poll_PC_Div=parseInt(jQuery('.JIT_Poll_CC_Div_'+JIT_Poll_Params[0]).css('width'));
				var JIT_Poll_PC_DivW=parseInt(jQuery('.JIT_Poll_CC_Div_'+JIT_Poll_Params[0]).css('height'));

				setTimeout(function() {
					jQuery('.JIT_Poll_CC_Div_'+JIT_Poll_Params[0]).hide(500);	

					if(JIT_Poll_Hid_VT=='percent')
					{
						JIT_Poll_VT='{point.y:.2f} %';
					}
					else if(JIT_Poll_Hid_VT=='vote')
					{
						JIT_Poll_VT='{point.results:.0f} votes';
					}
					else if(JIT_Poll_Hid_VT=='both')
					{
						JIT_Poll_VT='{point.results:.0f} votes ({point.y:.2f})';
					}
					/* Drawing a chart */
					jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_Params[0]).show(1000);
					jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_Params[0]).drawdiagram({
				        chart: 
				        {
				            type: 'column',
				            width: JIT_Poll_PC_Div,
				            backgroundColor: JIT_Poll_PC_Bg,		            
				            options3d: {
				                enabled: true,
				                alpha: 45,
				                beta: 0
				            }
				        },
				        title: 
				        {
				            text: JIT_Poll_PC_Quest,
				            style:
				            {
				           	 	fontSize: JIT_Poll_PC_Quest_FS,
				           	 	fontFamily: JIT_Poll_PC_Quest_FF,
				           	 	color: JIT_Poll_PC_Quest_C,
				           	 	textShadow: '0px 1px 2px white' 
				            }
				        },						        
				        xAxis: 
				        {
				            type: 'category',
				            labels: 
				            {
				                rotation: -45,
				                style: 
				                {
				                    fontSize: '12px',
				                    fontFamily: 'Verdana, sans-serif',
				                	color: JIT_Poll_Answers_PC_Div,
				                }
				            }
				        },
				        yAxis: 
				        {
				            min: 0,						           
				            enabled: true,
				          	title: 
				            {
				            	text: 'Votes ( % )',
				            	style:
				            	{
				            		color: JIT_Poll_Answers_PC_Div,
				            	}
				            },
				            labels:
				            {
				            	style:
				            	{
				            		color: JIT_Poll_Answers_PC_Div,
				            	}
				            }
				        },
				        legend: 
				        {
				            enabled: false
				        },
				        tooltip: 
				        {
				            pointFormat: 'Votes: <b>'+JIT_Poll_VT+'</b>'
				        },
						series: [{
				            name: 'Results',
				            colorByPoint: true,
				            data: JIT_Poll_PC_dataSource,
				            dataLabels: 
				            {
				                enabled: true,
				                rotation: -90,
				                color: JIT_Poll_Answers_PC_Div,
				                align: 'right',
				                format: JIT_Poll_VT, // one decimal
				                y: 1, // 10 pixels down from the top
				                style: 
				                {
				                    fontSize: '10px',
				                    fontFamily: 'Verdana, sans-serif',
				                },
				            },
						}]
		    		});
				},500);
			}
		})
	}

	jQuery('.JIT_Poll_Div_Width').each(function(){
		JIT_Poll_Div_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Quest_Font_Size').each(function(){
		JIT_Poll_Quest_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_Div_Font_Size').each(function(){
		JIT_Poll_Answers_Div_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Vote_But_Font_Size').each(function(){
		JIT_Poll_Vote_But_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_PC_Div_Width').each(function(){
		JIT_Poll_PC_Div_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_PC_Quest_Font_Size').each(function(){
		JIT_Poll_PC_Quest_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_PC_Div_Font_Size').each(function(){
		JIT_Poll_Answers_PC_Div_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_IP_Div_Width').each(function(){
		JIT_Poll_IP_Div_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_IP_Div_Width').each(function(){
		JIT_Poll_Answers_IP_Div_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_IP_Div_Height').each(function(){
		JIT_Poll_Answers_IP_Div_Height=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_IP_Quest_Font_Size').each(function(){
		JIT_Poll_IP_Quest_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_IP_Div_Font_Size').each(function(){
		JIT_Poll_Answers_IP_Div_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_IP_Span_Font_Size').each(function(){
		JIT_Poll_IP_Span_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_VP_Div_Width').each(function(){
		JIT_Poll_VP_Div_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_VP_Img_Width').each(function(){
		JIT_Poll_VP_Img_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_VP_Img_Height').each(function(){
		JIT_Poll_VP_Img_Height=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_VP_Quest_Font_Size').each(function(){
		JIT_Poll_VP_Quest_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_VP_Div_Font_Size').each(function(){
		JIT_Poll_Answers_VP_Div_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_VP_Span_Font_Size').each(function(){
		JIT_Poll_VP_Span_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_CC_Div_Width').each(function(){
		JIT_Poll_CC_Div_Width=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_CC_Quest_Font_Size').each(function(){
		JIT_Poll_CC_Quest_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	jQuery('.JIT_Poll_Answers_CC_Div_Font_Size').each(function(){
		JIT_Poll_Answers_CC_Div_Font_Size=parseInt(jQuery(this).val());
		JIT_Poll_Widths();
	})
	
	jQuery(window).resize(function(){
		JIT_Poll_Widths();
	})
	function JIT_Poll_Widths()
	{
		jQuery('.JIT_Poll_Div').css('width',JIT_Poll_Div_Width*jQuery('.JIT_Poll_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_Quest').css('font-size',JIT_Poll_Quest_Font_Size*jQuery('.JIT_Poll_Div').width()/500);
		jQuery('.JIT_Poll_Answers_Div').css('font-size',JIT_Poll_Answers_Div_Font_Size*jQuery('.JIT_Poll_Div').width()/500);
		jQuery('.JIT_Poll_Vote_But').css('font-size',JIT_Poll_Vote_But_Font_Size*jQuery('.JIT_Poll_Div').width()/500);
		jQuery('.JIT_Poll_PC_Div').css('width',JIT_Poll_PC_Div_Width*jQuery('.JIT_Poll_PC_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_PC_Quest').css('font-size',JIT_Poll_PC_Quest_Font_Size*jQuery('.JIT_Poll_PC_Div').width()/500+'px');
		jQuery('.main-container').css('font-size',JIT_Poll_PC_Quest_Font_Size*jQuery('.JIT_Poll_PC_Div').width()/500+'px !important');
		jQuery('.JIT_Poll_Answers_PC_Div').css('font-size',JIT_Poll_Answers_PC_Div_Font_Size*jQuery('.JIT_Poll_PC_Div').width()/500+'px');
		jQuery('.JIT_Poll_IP_Div').css('width',JIT_Poll_IP_Div_Width*jQuery('.JIT_Poll_IP_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_Answers_IP_Div').css('width',JIT_Poll_Answers_IP_Div_Width*jQuery('.JIT_Poll_IP_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_Answers_IP_Div').css('height',JIT_Poll_Answers_IP_Div_Height*jQuery('.JIT_Poll_IP_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_IP_Quest').css('font-size',JIT_Poll_IP_Quest_Font_Size*jQuery('.JIT_Poll_IP_Div').width()/500+'px');
		jQuery('.JIT_Poll_Answers_IP_Div').css('font-size',JIT_Poll_Answers_IP_Div_Font_Size*jQuery('.JIT_Poll_IP_Div').width()/500+'px');
		jQuery('.JIT_Poll_IP_Span').css('font-size',JIT_Poll_IP_Span_Font_Size*jQuery('.JIT_Poll_IP_Div').width()/500+'px');
		jQuery('.JIT_Poll_VP_Div').css('width',JIT_Poll_VP_Div_Width*jQuery('.JIT_Poll_VP_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_Answers_VP_Div').css('width',JIT_Poll_VP_Img_Width*jQuery('.JIT_Poll_VP_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_Answers_VP_Div').css('height',JIT_Poll_VP_Img_Height*jQuery('.JIT_Poll_VP_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_VP_Quest').css('font-size',JIT_Poll_VP_Quest_Font_Size*jQuery('.JIT_Poll_VP_Div').width()/500+'px');
		jQuery('.JIT_Poll_Answers_VP_Div').css('font-size',JIT_Poll_Answers_VP_Div_Font_Size*jQuery('.JIT_Poll_VP_Div').width()/500+'px');
		jQuery('.JIT_Poll_VP_Span').css('font-size',JIT_Poll_VP_Span_Font_Size*jQuery('.JIT_Poll_VP_Div').width()/500+'px');
		jQuery('.JIT_Poll_CC_Div').css('width',JIT_Poll_CC_Div_Width*jQuery('.JIT_Poll_CC_Div').parent().width()/1000+'px');
		jQuery('.JIT_Poll_CC_Quest').css('font-size',JIT_Poll_CC_Quest_Font_Size*jQuery('.JIT_Poll_CC_Quest').width()/500);
		jQuery('.JIT_Poll_Answers_CC_Div').css('font-size',JIT_Poll_Answers_CC_Div_Font_Size*jQuery('.JIT_Poll_CC_Div').width()/500);
		if(jQuery('.JIT_Poll_Div').width()<=300){
			jQuery('.JIT_Poll_Quest').css('font-size',2*JIT_Poll_Quest_Font_Size*jQuery('.JIT_Poll_Div').width()/500);
			jQuery('.JIT_Poll_Answers_Div').css('font-size',2*JIT_Poll_Answers_Div_Font_Size*jQuery('.JIT_Poll_Div').width()/500);
			jQuery('.JIT_Poll_Vote_But').css('font-size',2*JIT_Poll_Vote_But_Font_Size*jQuery('.JIT_Poll_Div').width()/500);
		}
		if(jQuery('.JIT_Poll_PC_Div').width() <= 300){
			jQuery('.JIT_Poll_PC_Quest').css('font-size',2*JIT_Poll_PC_Quest_Font_Size*jQuery('.JIT_Poll_PC_Div').width()/500+'px');
			jQuery('.main-container').css('font-size',2*JIT_Poll_PC_Quest_Font_Size*jQuery('.JIT_Poll_PC_Div').width()/500+'px');
			jQuery('.JIT_Poll_Answers_PC_Div').css('font-size',2*JIT_Poll_Answers_PC_Div_Font_Size*jQuery('.JIT_Poll_PC_Div').width()/500+'px');
		}
		if(jQuery('.JIT_Poll_IP_Div').width() <= 250){
				jQuery('.JIT_Poll_Answers_IP_Div').css('width',JIT_Poll_Answers_IP_Div_Width*jQuery('.JIT_Poll_IP_Div').parent().width()/500+'px');
				jQuery('.JIT_Poll_Answers_IP_Div').css('height',JIT_Poll_Answers_IP_Div_Height*jQuery('.JIT_Poll_IP_Div').parent().width()/500+'px');
				jQuery('.JIT_Poll_IP_Quest').css('font-size',2*JIT_Poll_IP_Quest_Font_Size*jQuery('.JIT_Poll_IP_Div').width()/500+'px');
				jQuery('.JIT_Poll_Answers_IP_Div').css('font-size',2*JIT_Poll_Answers_IP_Div_Font_Size*jQuery('.JIT_Poll_IP_Div').width()/500+'px');
				jQuery('.JIT_Poll_IP_Span').css('font-size',2*JIT_Poll_IP_Span_Font_Size*jQuery('.JIT_Poll_IP_Div').width()/500+'px');
				if(jQuery('.JIT_Poll_IP_Div').width() <= 135){
					jQuery('.JIT_Poll_Answers_IP_Div').css('width',JIT_Poll_Answers_IP_Div_Width*jQuery('.JIT_Poll_IP_Div').parent().width()/600+'px');
					jQuery('.JIT_Poll_Answers_IP_Div').css('height',JIT_Poll_Answers_IP_Div_Height*jQuery('.JIT_Poll_IP_Div').parent().width()/600+'px');
				}
			}
		if(jQuery('.JIT_Poll_VP_Div').width() <= 250){
			jQuery('.JIT_Poll_Answers_VP_Div').css('width',JIT_Poll_VP_Img_Width*jQuery('.JIT_Poll_VP_Div').parent().width()/500+'px');
			jQuery('.JIT_Poll_Answers_VP_Div').css('height',JIT_Poll_VP_Img_Height*jQuery('.JIT_Poll_VP_Div').parent().width()/500+'px');
			jQuery('.JIT_Poll_VP_Quest').css('font-size',2*JIT_Poll_VP_Quest_Font_Size*jQuery('.JIT_Poll_VP_Div').width()/500+'px');
			jQuery('.JIT_Poll_Answers_VP_Div').css('font-size',2*JIT_Poll_Answers_VP_Div_Font_Size*jQuery('.JIT_Poll_VP_Div').width()/500+'px');
			jQuery('.JIT_Poll_VP_Span').css('font-size',2*JIT_Poll_VP_Span_Font_Size*jQuery('.JIT_Poll_VP_Div').width()/500+'px');
			if(jQuery('.JIT_Poll_VP_Div').width() <= 135){
				jQuery('.JIT_Poll_Answers_VP_Div').css('width',JIT_Poll_VP_Img_Width*jQuery('.JIT_Poll_VP_Div').parent().width()/600+'px');
				jQuery('.JIT_Poll_Answers_VP_Div').css('height',JIT_Poll_VP_Img_Height*jQuery('.JIT_Poll_VP_Div').parent().width()/600+'px');
			}
		}
		if(jQuery('.JIT_Poll_CC_Div').width()<=300){
			jQuery('.JIT_Poll_CC_Quest').css('font-size',2*JIT_Poll_CC_Quest_Font_Size*jQuery('.JIT_Poll_CC_Quest').width()/500);
			jQuery('.JIT_Poll_Answers_CC_Div').css('font-size',2*JIT_Poll_Answers_CC_Div_Font_Size*jQuery('.JIT_Poll_CC_Div').width()/500);
		}
		jQuery('.JIT_Poll_Quest').css('padding',parseInt(jQuery('.JIT_Poll_Quest').css('font-size'))/5);
		jQuery('.JIT_Poll_PC_Quest').css('padding',parseInt(jQuery('.JIT_Poll_PC_Quest').css('font-size'))/5);
		jQuery('.JIT_Poll_IP_Quest').css('padding-top',parseInt(jQuery('.JIT_Poll_IP_Quest').css('font-size'))/3);
		jQuery('.JIT_Poll_IP_Quest').css('padding-bottom',parseInt(jQuery('.JIT_Poll_IP_Quest').css('font-size'))/3);
		jQuery('.JIT_Poll_IP_Ans').css('padding-top',parseInt(jQuery('.JIT_Poll_Answers_IP_Div').css('font-size'))/3);
		jQuery('.JIT_Poll_IP_Ans').css('padding-bottom',parseInt(jQuery('.JIT_Poll_Answers_IP_Div').css('font-size'))/3);
		jQuery('.JIT_Poll_VP_Quest').css('padding-top',parseInt(jQuery('.JIT_Poll_VP_Quest').css('font-size'))/3);
		jQuery('.JIT_Poll_VP_Quest').css('padding-bottom',parseInt(jQuery('.JIT_Poll_VP_Quest').css('font-size'))/3);
		jQuery('.JIT_Poll_VP_Ans').css('padding-top',parseInt(jQuery('.JIT_Poll_Answers_VP_Div').css('font-size'))/3);
		jQuery('.JIT_Poll_VP_Ans').css('padding-bottom',parseInt(jQuery('.JIT_Poll_Answers_VP_Div').css('font-size'))/3);
		jQuery('.JIT_Poll_VP_Span').css('padding-top',parseInt(jQuery('.JIT_Poll_VP_Span').css('font-size'))/3);
		jQuery('.JIT_Poll_VP_Span').css('padding-bottom',parseInt(jQuery('.JIT_Poll_VP_Span').css('font-size'))/3);
		jQuery('.JIT_Poll_CC_Quest').css('padding-top',parseInt(jQuery('.JIT_Poll_CC_Quest').css('font-size'))/3);
		jQuery('.JIT_Poll_CC_Quest').css('padding-bottom',parseInt(jQuery('.JIT_Poll_CC_Quest').css('font-size'))/3);
	}
		
})

function JIT_Poll_Vote_Click(JIT_Poll_ID)
{
	var JIT_Poll_Answer;
	var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_ID).val();
	jQuery('.JIT_Poll_Radio_'+JIT_Poll_ID).each(function() {
		if(jQuery(this).is(':checked'))
		{			
			JIT_Poll_Answer=jQuery(this).val();
		}
	});

	if(typeof JIT_Poll_Answer === 'undefined')
	{
	 	alert("Please Select Answer");
		return false;
	}
	var JIT_Poll_Vote_Ajax=JIT_Poll_ID + '^%^' + JIT_Poll_Answer;


	var ajaxurl = object.ajaxurl;
  	var data = {
    	action: 'JIT_Poll_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_Poll_Vote_Ajax, // translates into $_POST['foobar'] in PHP				
	};
	jQuery.post(ajaxurl, data, function(response){
		
		jQuery('.JIT_Poll_Radio_'+JIT_Poll_ID).hide(700);

		
		jQuery('.JIT_Poll_Vote_Div_'+JIT_Poll_ID).hide();
		jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_ID).show();
		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_ID).css('display','block');

		var JIT_Poll_Votes=response.split('^');

		var JIT_Poll_Results=[];

	 	for(i=0; i<JIT_Poll_Votes.length; i++)
	 	{
	 		if(JIT_Poll_Votes[i]=="")
	 		{
	 			continue;
	 		}
	 		else
	 		{
	 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
	 		}
	 	}

	 	/* data that will be shown in the widget */
	 	var JIT_Poll_Sum=0;
	 	var JIT_Poll_Widths = [];
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
	 	}

	 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
		
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{			
	 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
	 	}
	 	if(JIT_Poll_Hid_VT=='percent')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
		 	{
		 		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).animate({width:parseFloat(JIT_Poll_Widths[i]).toFixed(1)+'%'},1000);
				jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(parseFloat(JIT_Poll_Widths[i]).toFixed(1)+' %');
		 	}
	 	}
	 	else if(JIT_Poll_Hid_VT=='vote')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
		 	{
		 		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).animate({width:parseFloat(JIT_Poll_Widths[i]).toFixed(1)+'%'},1000);
				jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes');
		 	}
	 	}
	 	else if(JIT_Poll_Hid_VT=='both')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
		 	{
		 		jQuery('.JIT_Poll_Votes_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).animate({width:parseFloat(JIT_Poll_Widths[i]).toFixed(1)+'%'},1000);
				jQuery('.JIT_Poll_Votes_Type_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes'+ ' ( ' +parseFloat(JIT_Poll_Widths[i]).toFixed(1)+' % )');
		 	}
	 	}
	 	document.cookie="username"+JIT_Poll_ID+"="+JIT_Poll_ID;
	})
}
function JIT_Poll_Pie_Chart_Votes(JIT_Poll_ID, JIT_Poll_Ans_ID)
{
	var JIT_Poll_Vote_Ajax=JIT_Poll_ID+'^%^'+JIT_Poll_Ans_ID;
	var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_ID).val();

	var ajaxurl = object.ajaxurl;
  	var data = {
    	action: 'JIT_Poll_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_Poll_Vote_Ajax, // translates into $_POST['foobar'] in PHP				
	};	
	jQuery.post(ajaxurl, data, function(response){
		var JIT_Poll_Votes=response.split('^');

		var JIT_Poll_Results=[];
	 	for(i=0; i<JIT_Poll_Votes.length; i++)
	 	{
	 		if(JIT_Poll_Votes[i]=="")
	 		{
	 			continue;
	 		}
	 		else
	 		{
	 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
	 		}
	 	}

	 	/* data that will be shown in the widget */
	 	var JIT_Poll_Sum=0;
	 	var JIT_Poll_Widths = [];
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
	 	}

	 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
		
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{			
	 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
	 	}

	 	var JIT_Poll_PC_Answers = [];

	 	for(i=1; i<=JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_PC_Answers[JIT_Poll_PC_Answers.length]=jQuery('.JIT_Poll_PC_Answer_'+JIT_Poll_ID+'_'+i).html();
	 	}	

		var JIT_Poll_PC_Answers_Col =[];					

		for(i=1; i<=JIT_Poll_Results.length; i++)
		{
			JIT_Poll_PC_Answers_Col[JIT_Poll_PC_Answers_Col.length]=jQuery('.JIT_Poll_PC_CSpan_'+JIT_Poll_ID+'_'+i).css('background-color');
		}
		var JIT_Poll_PC_dataSource= [];					

		for(i=0; i<JIT_Poll_Results.length; i++)
		{	
			JIT_Poll_PC_dataSource[JIT_Poll_PC_dataSource.length]= {name: JIT_Poll_PC_Answers[i],  y: JIT_Poll_Widths[i], sliced: true, selected: true, color: JIT_Poll_PC_Answers_Col[i], results: JIT_Poll_Results[i]};
		}

		var JIT_Poll_PC_Quest=jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_ID).html();
		var JIT_Poll_PC_Quest_FS=parseInt(jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_ID).css('font-size'));
		var JIT_Poll_PC_Quest_FF=jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_ID).css('font-family');
		var JIT_Poll_PC_Quest_C=jQuery('.JIT_Poll_PC_Quest_'+JIT_Poll_ID).css('color');
		var JIT_Poll_Answers_PC_Div=jQuery('.JIT_Poll_Answers_PC_Div_'+JIT_Poll_ID).css('color');
		var JIT_Poll_PC_Bg=jQuery('.JIT_Poll_PC_Bg_'+JIT_Poll_ID).css('background-color');
		var JIT_Poll_PC_Div=parseInt(jQuery('.JIT_Poll_PC_Div_'+JIT_Poll_ID).css('width'));
		var JIT_Poll_PC_DivW=parseInt(jQuery('.JIT_Poll_PC_Div_'+JIT_Poll_ID).css('height'));

		setTimeout(function(){
			jQuery('.JIT_Poll_PC_Div_'+JIT_Poll_ID).hide(500);	
			if(JIT_Poll_Hid_VT=='percent')
			{
				JIT_Poll_VT='{point.y:.2f} %';
			}
			else if(JIT_Poll_Hid_VT=='vote')
			{
				JIT_Poll_VT='{point.results:.0f} votes';
			}
			else if(JIT_Poll_Hid_VT=='both')
			{
				JIT_Poll_VT='{point.results:.0f} votes ( {point.y:.2f} % )';
			}
			/* Drawing a chart */
			jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_ID).show(1000);
			jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_ID).drawdiagram({
		        chart: 
		        {
		            type: 'pie',
                	align: 'center',		            
		            width: JIT_Poll_PC_Div,
		            backgroundColor: JIT_Poll_PC_Bg,		            
		            options3d: {
		                enabled: true,
		                alpha: 45,
		                beta: 0
		            }
		        },
		        legend:
                {
                	align: 'left',
					layout: 'horizontal',
					verticalAlign: 'bottom',
					x: 20,
					y: 20,
					itemMarginTop: 10,
        			itemMarginBottom: 10,
                },   
		        title: 
		        {
		            text: JIT_Poll_PC_Quest,
		            style:
		            {
		           	 	fontSize: JIT_Poll_PC_Quest_FS,
		           	 	fontFamily: JIT_Poll_PC_Quest_FF,
		           	 	color: JIT_Poll_PC_Quest_C,
		           	 	textShadow: '0px 1px 2px white' 
		            }
		        },
		        tooltip: 
		        {
		           	pointFormat: '{series.name}: <b>'+JIT_Poll_VT+'</b>'
		        },
		        plotOptions: 
		        {
		            pie: 
		            {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            depth: 35,
			            dataLabels: 
			            {
		                    enabled: true,
		                    format: JIT_Poll_VT,
		                    style: 
		                    {
		                        fontWeight: 'bold',
		                        color: JIT_Poll_Answers_PC_Div,
		                    },
	                	},
	               		showInLegend: true,	               		
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'Browser share',
		            data: JIT_Poll_PC_dataSource
		        }]
		    });
		},200);
		document.cookie="username"+JIT_Poll_ID+"="+JIT_Poll_ID;
	})
}
function JIT_Poll_Column_Chart_Votes(JIT_Poll_ID, JIT_Poll_Ans_ID, JIT_Poll_Ans_Num)
{
	var JIT_Poll_Vote_Ajax=JIT_Poll_ID+'^%^'+JIT_Poll_Ans_ID;
	var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_ID).val();
	var ajaxurl = object.ajaxurl;
  	var data = {
    	action: 'JIT_Poll_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_Poll_Vote_Ajax, // translates into $_POST['foobar'] in PHP				
	};	
	jQuery.post(ajaxurl, data, function(response){
		var JIT_Poll_Votes=response.split('^');

		var JIT_Poll_Results=[];
	 	for(i=0; i<JIT_Poll_Votes.length; i++)
	 	{
	 		if(JIT_Poll_Votes[i]=="")
	 		{
	 			continue;
	 		}
	 		else
	 		{
	 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
	 		}
	 	}

	 	/* data that will be shown in the widget */
	 	var JIT_Poll_Sum=0;
	 	var JIT_Poll_Widths = [];
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
	 	}

	 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
		
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{			
	 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
	 	}

	 	var JIT_Poll_PC_Answers = [];

	 	for(i=1; i<=JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_PC_Answers[JIT_Poll_PC_Answers.length]=jQuery('.JIT_Poll_CC_Answer_'+JIT_Poll_ID+'_'+i).html();
		}
		jQuery('.JIT_Poll_CC_CSpan_'+JIT_Poll_ID+'_'+JIT_Poll_Ans_Num).animate({width:'100%','opacity':'1'}, 1500);

		var JIT_Poll_PC_Answers_Col =[];					

		for(i=1; i<=JIT_Poll_Results.length; i++)
		{
			JIT_Poll_PC_Answers_Col[JIT_Poll_PC_Answers_Col.length]=jQuery('.JIT_Poll_CC_CSpan_'+JIT_Poll_ID+'_'+i).css('background-color');
		}
		var JIT_Poll_PC_dataSource= [];					

		for(i=0; i<JIT_Poll_Results.length; i++)
		{	
			JIT_Poll_PC_dataSource[JIT_Poll_PC_dataSource.length]= {name: JIT_Poll_PC_Answers[i],  y: JIT_Poll_Widths[i], color: JIT_Poll_PC_Answers_Col[i], results: JIT_Poll_Results[i]};
		}
		var JIT_Poll_PC_Quest=jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_ID).html();
		var JIT_Poll_PC_Quest_FS=parseInt(jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_ID).css('font-size'));
		var JIT_Poll_PC_Quest_FF=jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_ID).css('font-family');
		var JIT_Poll_PC_Quest_C=jQuery('.JIT_Poll_CC_Quest_'+JIT_Poll_ID).css('color');
		var JIT_Poll_Answers_PC_Div=jQuery('.JIT_Poll_Answers_CC_Div_'+JIT_Poll_ID).css('color');
		var JIT_Poll_PC_Bg=jQuery('.JIT_Poll_CC_Bg_'+JIT_Poll_ID).css('background-color');
		var JIT_Poll_PC_Div=parseInt(jQuery('.JIT_Poll_CC_Div_'+JIT_Poll_ID).css('width'));
		var JIT_Poll_PC_DivW=parseInt(jQuery('.JIT_Poll_CC_Div_'+JIT_Poll_ID).css('height'));

		setTimeout(function() {
			jQuery('.JIT_Poll_CC_Div_'+JIT_Poll_ID).hide(500);	

			if(JIT_Poll_Hid_VT=='percent')
			{
				JIT_Poll_VT='{point.y:.2f} %';
			}
			else if(JIT_Poll_Hid_VT=='vote')
			{
				JIT_Poll_VT='{point.results:.0f} votes';
			}
			else if(JIT_Poll_Hid_VT=='both')
			{
				JIT_Poll_VT='{point.results:.0f} votes ({point.y:.2f})';
			}
			/* Drawing a chart */
			jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_ID).show(1000);
			jQuery('.JIT_Poll_chartDiv_'+JIT_Poll_ID).drawdiagram({
		        chart: 
		        {
		            type: 'column',
		            width: JIT_Poll_PC_Div,
		            backgroundColor: JIT_Poll_PC_Bg,		            
		            options3d: {
		                enabled: true,
		                alpha: 45,
		                beta: 0
		            }
		        },
		        title: 
		        {
		            text: JIT_Poll_PC_Quest,
		            style:
		            {
		           	 	fontSize: JIT_Poll_PC_Quest_FS,
		           	 	fontFamily: JIT_Poll_PC_Quest_FF,
		           	 	color: JIT_Poll_PC_Quest_C,
		           	 	textShadow: '0px 1px 2px white' 
		            }
		        },						        
		        xAxis: 
		        {
		            type: 'category',
		            labels: 
		            {
		                rotation: -45,
		                style: 
		                {
		                    fontSize: '12px',
		                    fontFamily: 'Verdana, sans-serif',
		                	color: JIT_Poll_Answers_PC_Div,
		                }
		            }
		        },
		        yAxis: 
		        {
		            min: 0,						           
		            enabled: true,
		          	title: 
		            {
		            	text: 'Votes ( % )',
		            	style:
		            	{
		            		color: JIT_Poll_Answers_PC_Div,
		            	}
		            },
		            labels:
		            {
		            	style:
		            	{
		            		color: JIT_Poll_Answers_PC_Div,
		            	}
		            }
		        },
		        legend: 
		        {
		            enabled: false
		        },
		        tooltip: 
		        {
		            pointFormat: 'Votes: <b>'+JIT_Poll_VT+'</b>'
		        },
				series: [{
		            name: 'Results',
		            colorByPoint: true,
		            data: JIT_Poll_PC_dataSource,
		            dataLabels: 
		            {
		                enabled: true,
		                rotation: -90,
		                color: JIT_Poll_Answers_PC_Div,
		                align: 'right',
		                format: JIT_Poll_VT, // one decimal
		                y: 1, // 10 pixels down from the top
		                style: 
		                {
		                    fontSize: '10px',
		                    fontFamily: 'Verdana, sans-serif',
		                },
		            },
				}]
    		});
		},500);
		document.cookie="username"+JIT_Poll_ID+"="+JIT_Poll_ID;
	})
}
function JIT_Poll_Image_Poll_Votes(JIT_Poll_ID, JIT_Poll_Ans_ID)
{
	var JIT_Poll_IP_D=jQuery('.JIT_Poll_Hid_VON_'+JIT_Poll_ID).val();
	if(JIT_Poll_IP_D==JIT_Poll_ID)
	{
		return false;
	}
	jQuery('.JIT_Poll_Hid_VON_'+JIT_Poll_ID).val(JIT_Poll_ID);

	var JIT_Poll_Vote_Ajax=JIT_Poll_ID+'^%^'+JIT_Poll_Ans_ID;
	var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_ID).val();

	var ajaxurl = object.ajaxurl;
  	var data = {
    	action: 'JIT_Poll_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_Poll_Vote_Ajax, // translates into $_POST['foobar'] in PHP				
	};	
	jQuery.post(ajaxurl, data, function(response){
		var JIT_Poll_Votes=response.split('^');

		var JIT_Poll_Results=[];

	 	for(i=0; i<JIT_Poll_Votes.length; i++)
	 	{
	 		if(JIT_Poll_Votes[i]=="")
	 		{
	 			continue;
	 		}
	 		else
	 		{
	 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
	 		}
	 	}

	 	/* data that will be shown in the widget */
	 	var JIT_Poll_Sum=0;
	 	var JIT_Poll_Widths = [];
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
	 	}

	 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
		
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{			
	 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
	 	}

	 	//jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).hide(500);
	 	var JIT_Poll_IP_Ans_Hover_Opacity = jQuery('.JIT_Poll_IP_Ans_Hover_Opacity').val();
	 	if(JIT_Poll_Hid_VT=='percent')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
	 		{
	 			setTimeout(function(){
	 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).show(500);
	 				jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).css({'width':'100%','height':'100%','opacity':JIT_Poll_IP_Ans_Hover_Opacity});
	 			},700)
	 			jQuery('.JIT_Poll_IP_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Widths[i].toFixed(1)+'%');
	 		}
	 	}
	 	else if(JIT_Poll_Hid_VT=='vote')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
	 		{
	 			setTimeout(function(){
	 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).show(500);
	 				jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).css({'width':'100%','height':'100%','opacity':JIT_Poll_IP_Ans_Hover_Opacity});
	 			},700)
	 			jQuery('.JIT_Poll_IP_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes');
	 		}
	 	}
	 	else if(JIT_Poll_Hid_VT=='both')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
	 		{
	 			jQuery('.JIT_Poll_IP_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes'+' ('+JIT_Poll_Widths[i].toFixed(1)+'%)');
	 			setTimeout(function(){
	 				// jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).show(500);
	 				jQuery('.JIT_Poll_IP_Ans_Hover_'+JIT_Poll_ID).css({'width':'100%','height':'100%','opacity':JIT_Poll_IP_Ans_Hover_Opacity});
	 			},700)
	 		}
	 	}
	 	document.cookie="username"+JIT_Poll_ID+"="+JIT_Poll_ID;
	})
}
function JIT_Poll_Video_Poll_Votes(JIT_Poll_ID, JIT_Poll_Ans_ID)
{
	var JIT_Poll_IP_D=jQuery('.JIT_Poll_Hid_VON_'+JIT_Poll_ID).val();
	if(JIT_Poll_IP_D==JIT_Poll_ID)
	{
		return false;
	}
	jQuery('.JIT_Poll_Hid_VON_'+JIT_Poll_ID).val(JIT_Poll_ID);

	var JIT_Poll_Vote_Ajax=JIT_Poll_ID+'^%^'+JIT_Poll_Ans_ID;
	var JIT_Poll_Hid_VT=jQuery('.JIT_Poll_Hid_VT_'+JIT_Poll_ID).val();

	var ajaxurl = object.ajaxurl;
  	var data = {
    	action: 'JIT_Poll_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: JIT_Poll_Vote_Ajax, // translates into $_POST['foobar'] in PHP				
	};	
	jQuery.post(ajaxurl, data, function(response){
		var JIT_Poll_Votes=response.split('^');
		var JIT_Poll_Results=[];

	 	for(i=0; i<JIT_Poll_Votes.length; i++)
	 	{
	 		if(JIT_Poll_Votes[i]=="")
	 		{
	 			continue;
	 		}
	 		else
	 		{
	 			JIT_Poll_Results[JIT_Poll_Results.length]=JIT_Poll_Votes[i];
	 		}
	 	}

	 	/* data that will be shown in the widget */
	 	var JIT_Poll_Sum=0;
	 	var JIT_Poll_Widths = [];
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{
	 		JIT_Poll_Sum=JIT_Poll_Sum+parseInt(JIT_Poll_Results[i]);
	 	}

	 	if(JIT_Poll_Sum==0) JIT_Poll_Sum=1;
		
	 	for(i=0; i<JIT_Poll_Results.length; i++)
	 	{			
	 		JIT_Poll_Widths[JIT_Poll_Widths.length]=(JIT_Poll_Results[i]*100)/JIT_Poll_Sum;	
	 	}

	 	jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_ID).hide(500);
	 	if(JIT_Poll_Hid_VT=='percent')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
	 		{
	 			setTimeout(function(){
	 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_ID).show(500);
	 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_ID).css('display','block');
	 			},700)
	 			jQuery('.JIT_Poll_VP_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Widths[i].toFixed(1)+'%');
	 		}
	 	}
	 	else if(JIT_Poll_Hid_VT=='vote')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
	 		{
	 			setTimeout(function(){
	 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_ID).show(500);
	 			},700)
	 			jQuery('.JIT_Poll_VP_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes');
	 		}
	 	}
	 	else if(JIT_Poll_Hid_VT=='both')
	 	{
	 		for(i=0; i<JIT_Poll_Results.length; i++)
	 		{
	 			jQuery('.JIT_Poll_VP_Span_'+JIT_Poll_ID+'_'+parseInt(parseInt(i)+1)).html(JIT_Poll_Results[i]+' votes'+' ('+JIT_Poll_Widths[i].toFixed(1)+'%)');
	 			setTimeout(function(){
	 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_ID).show(500);
	 				jQuery('.JIT_Poll_VP_Ans_Hover_'+JIT_Poll_ID).css('display','block');
	 			},700)
	 		}
	 	}
	 	document.cookie="username"+JIT_Poll_ID+"="+JIT_Poll_ID;
	})
}
function JIT_Poll_Video_On_Big(JIT_Poll_ID,JIT_Poll_VSRC)
{
	jQuery('.JIT_Poll_Video_Container_'+JIT_Poll_ID).show(500);
	jQuery('.JIT_Poll_Video_Iframe_'+JIT_Poll_ID).attr('src',JIT_Poll_VSRC);
	jQuery('.JIT_Poll_Video_Iframe_Div_'+JIT_Poll_ID).show(500);
}
function JIT_Poll_Video_Big_Click(JIT_Poll_ID)
{
	jQuery('.JIT_Poll_Video_Container_'+JIT_Poll_ID).hide(500);
	jQuery('.JIT_Poll_Video_Iframe_Div_'+JIT_Poll_ID).hide(500);
	jQuery('.JIT_Poll_Video_Iframe_'+JIT_Poll_ID).attr('src','');

}