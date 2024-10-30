function JIT_Poll_Answer_Drag ()
{
	jQuery('#JIT_Poll_Answer_Ul').sortable({
      	update: function() {
        	jQuery("#JIT_Poll_Answer_Ul > li").each(function(){
				jQuery(this).find('.JIT_Poll_AddTable').find('.JIT_Poll_AddInput').attr('placeholder','Answer '+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable').find('.JIT_Poll_AddInput').attr('id','JIT_Poll_Ans_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable').find('.JIT_Poll_AddInput').attr('name','JIT_Poll_Ans_'+parseInt(parseInt(jQuery(this).index())+1));

				jQuery(this).find('.JIT_Poll_AddTable1').find('.JIT_Poll_AddColor').attr('id','JIT_Poll_Col_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable1').find('.JIT_Poll_AddColor').attr('name','JIT_Poll_Col_'+parseInt(parseInt(jQuery(this).index())+1));
				
				jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMed').attr('data-editor','JIT_Poll_UpMedi_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMed').attr('id','JIT_Poll_UpMed_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMed').attr('onclick','JIT_Poll_UpMed('+parseInt(parseInt(jQuery(this).index())+1)+')');
				jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMedi').attr('id','JIT_Poll_UpMedi_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMedia').attr('id','JIT_Poll_UpMedia_'+parseInt(parseInt(jQuery(this).index())+1));
				jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMedia').attr('name','JIT_Poll_UpMedia_'+parseInt(parseInt(jQuery(this).index())+1));
			});         
       	}
    });	
}
function JIT_Poll_RemAns(RemAnsNum)
{
	jQuery('#JIT_Poll_Answer_li_'+RemAnsNum).remove();

	jQuery('#JIT_Poll_Anscount').val(jQuery('#JIT_Poll_Anscount').val()-1);

	jQuery("#JIT_Poll_Answer_Ul > li").each(function(){
		jQuery(this).find('.JIT_Poll_AddTable').find('.JIT_Poll_AddInput').attr('placeholder','Answer '+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable').find('.JIT_Poll_AddInput').attr('id','JIT_Poll_Ans_'+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable').find('.JIT_Poll_AddInput').attr('name','JIT_Poll_Ans_'+parseInt(parseInt(jQuery(this).index())+1));

		jQuery(this).find('.JIT_Poll_AddTable1').find('.JIT_Poll_AddColor').attr('id','JIT_Poll_Col_'+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable1').find('.JIT_Poll_AddColor').attr('name','JIT_Poll_Col_'+parseInt(parseInt(jQuery(this).index())+1));
		
		jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMed').attr('data-editor','JIT_Poll_UpMedi_'+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMed').attr('id','JIT_Poll_UpMed_'+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMed').attr('onclick','JIT_Poll_UpMed('+parseInt(parseInt(jQuery(this).index())+1)+')');
		jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMedi').attr('id','JIT_Poll_UpMedi_'+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMedia').attr('id','JIT_Poll_UpMedia_'+parseInt(parseInt(jQuery(this).index())+1));
		jQuery(this).find('.JIT_Poll_AddTable2').find('.JIT_Poll_UpMedia').attr('name','JIT_Poll_UpMedia_'+parseInt(parseInt(jQuery(this).index())+1));
	});   
}
function JIT_Poll_UpMed(UpNum)
{
	var JIT_Poll_Type=jQuery('#JIT_Poll_Type').val();

	if(JIT_Poll_Type=='Image Poll')
	{
		var nIntervId = setInterval(function(){
			var code = jQuery('#JIT_Poll_UpMedi_'+UpNum).val();			
			if(code.indexOf('img')>0){
				var s=code.split('src="'); 
				var src=s[1].split('"');				
				jQuery('#JIT_Poll_UpMedia_'+UpNum).val(src[0]);
				if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
					jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
					clearInterval(nIntervId);
				}				
			}
		},100)
	}
	else
	{
		var nIntervId = setInterval(function(){
			var code = jQuery('#JIT_Poll_UpMedi_'+UpNum).val();	

			if(code.indexOf('https://www.youtube.com/')>0)
			{
				var s1 = code.split('<a href="https://www.youtube.com/'); 
				if(code.indexOf('list')>0 || code.indexOf('index')>0)
				{
					var s2= s1[1].split("=");
					var src = s2[1].split('&');

					jQuery('#JIT_Poll_UpMedia_'+UpNum).val('https://www.youtube.com/embed/'+src[0]);
					if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
						jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
						clearInterval(nIntervId);
					}				
				}
				else if(code.indexOf('embed')>0)
				{
					var s1=code.split('[embed]');
					var s2=s1[1].split('[/embed]');
					var src=s2[0];
					var Imsrc=src.split('embed/');

					jQuery('#JIT_Poll_UpMedia_'+UpNum).val(src);
					if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
						jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
						clearInterval(nIntervId);
					}				
				}
				else
				{
					var s2= s1[1].split('=');
					var src = s2[1].split('">https://');

					jQuery('#JIT_Poll_UpMedia_'+UpNum).val('https://www.youtube.com/embed/'+src[0]);
					if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
						jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
						clearInterval(nIntervId);
					}				
				}	
			}
			else if(code.indexOf('https://youtu.be/')>0)
			{
				var s1 = code.split('<a href="https://youtu.be/'); 
				var src = s1[1].split('">https://');

				jQuery('#JIT_Poll_UpMedia_'+UpNum).val('https://www.youtube.com/embed/'+src[0]);
				if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
					jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
					clearInterval(nIntervId);
				}				
			}
			else if(code.indexOf('https://vimeo.com/')>0)
			{
				if(code.indexOf('embed')>0)
				{
					var s1=code.split('[embed]https://vimeo.com/');
					var src=s1[1].split('[/embed]');
					if(src[0].length>9)
					{
						var real_src=src[0].split('/');
						src[0]=real_src[2];
					}
					jQuery('#JIT_Poll_UpMedia_'+UpNum).val('https://player.vimeo.com/video/'+src[0]);
					if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
						jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
						clearInterval(nIntervId);
					}				
	   			}
				else
				{
					var s1 = code.split('<a href="https://vimeo.com/'); 
					var src = s1[1].split('">https://');
					if(src[0].length>9)
					{
						var real_src=src[0].split('/');
						src[0]=real_src[2];
					}
					jQuery('#JIT_Poll_UpMedia_'+UpNum).val('https://player.vimeo.com/video/'+src[0]);
					if(jQuery('#JIT_Poll_UpMedia_'+UpNum).val().length>0){
						jQuery('#JIT_Poll_UpMediaI_'+UpNum).fadeIn();
						clearInterval(nIntervId);
					}					
				}		
			}
		},100)
	}
}