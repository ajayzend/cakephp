<?php echo $this->Html->script('jquery-1.7.2.min'); ?>
<?php echo $this->Html->script('jquery.form');?>
<?php 
echo $this->Session->flash();
?>


<div>
	<?php 
      echo $this->Common->breadcrumb(array($this->webroot.'admin'=>'Home',
									 'null'=>'Slider Management'
									));
      
      ?> 

<div class="row-fluid">	

	<div class="box span12">

				<div class="box-header well">
					<h2><i class="icon-cog	"></i>Slider Management</h2>
					<div class="err_msg session_msg"></div>
				</div>


<div class="box-content">	
				
		
	<div id='slide_number' class='row-fluid ' ><!-- row-fluid starts  -->
			<div class='span12 keyframe_area'>

			<?php
				   
					echo $this->Form->create('SliderManagements'); 
					echo $this->Form->input('slide_numb',array('id'=>'slide_num','label'=>'slide number'));
					echo $this->Form->submit('confirm',array('class'=>'btn btn-primary'));
					echo $this->Form->end();
				
				
			?>
			</div>
	</div><!--row-fluid ends --> 
	<?php echo $this->Form->create('SliderManagements',array('action'=>'saveSlide','id'=>'slide_submit', 'enctype'=>'multipart/form-data')); ?>
	<div id='slides'>
			<?php 
			
			if(isset($slide_numb)){
				     ?>
				     <script>
				     $(function()
				     {
				       $("#slide_number").hide();
				      });
				     </script>
				     
				     <?php
				     
					for($i=1;$i<=$slide_numb;$i++){
						?>	
						<label>Slide Tag<?php echo $i;?></label>	
						<?php echo $this->Form->input('slide_title.',array('id'=>'title_id'.$i,'required'=>'required'));?>
						<span class="help-inline" style="display:none;" id="error<?php echo $i;?>">Please enter these fields</span>
						<div class='row-fluid slide_manage' id="<?php echo "div_".$i;?>">
						<label>Slide Name <?php echo $i;?></label>	
						<input type="text" required="required" id="title_slideName<?php echo $i;?>"  class="input-xlarge focused" name="data[SliderManagement][slideName][]">
									<input type="text" required="required" id="ProductSlideName"  class="input-xlarge focused" name="data[SliderManagement][slideName2][]">
						<label>Description<?php echo $i;?></label>	
						
						<?php echo $this->Form->input('slide_desc.',array('id'=>'desc_id'.$i,'class'=>'cleditor','type'=>'textarea'));?>
						<label>Image<?php echo $i;?></label>
						<?php echo $this->Form->input('image.', array('type'=>'file','label'=>false));
						//echo $this->Form->input('sid.',array('type'=>'hidden','value'=>$this->params['pass']['0']));?>
						<?php echo $this->Form->input('pid',array('type'=>'hidden','value'=>$this->params['pass'][0]));?>
						
						
						<?php echo $this->Html->link('Make Static','javascript:changeMode_Static('.$i.')',array('id'=>'static_id'.$i));?>
						<?php	echo $this->Html->link('Make Dynamic','javascript:changeMode_Dynamic('.$i.')',array('id'=>'dynamic_id'.$i,'style'=>array('display:none;')));
						?>
						
			<!---To attach the keyfeatures for particular slider -->		
					
			<!---To attach the keyfeatures for particular slider ends here -->	
						</div>
						<?php echo $this->Form->input('url_info.',array('id'=>'url_info_id'.$i,'required'=>'required','label'=>'url info'));?>
						<?php
					}
					
						?>
		</div>
			<?php	
					echo $this->Form->submit('save',array('onclick'=>'SubmitAddNew('.$i.')','type'=>'button','class'=>'btn btn-primary'));
					echo $this->Form->button('Add',array('type'=>'button','class'=>'btn btn-primary','onclick'=>'addSlide('.$i++.')','id'=>'addId'));
					echo $this->Form->end();
			}
			
			
			
			?>
	
	
	
	
</div>
<?php
 
?>
<script>
////////---------To hide static link-----/////

function changeMode_Static(a){
	
	//alert($("#div_"+a+" .cleditorMain").html());
	$("#div_"+a+" .cleditorMain").hide();
	$("#desc_id"+a).html('static');
	
	//console.log($("#desc"+obj).closest().html());
	$("#desc_id"+a).hide();
	$("#static_id"+a).hide();
	$("#dynamic_id"+a).show();
	
	//alert(abc);	
	
	
	
}
///////////--------To hide dynamic link ------///////
function changeMode_Dynamic(b){
	//alert(data1);
	
	//var abc=$("#"+hide_Dynamic).val()
	$("#div_"+b+" .cleditorMain").show();
	$("#desc_id"+b).show();
	$("#static_id"+b).show();
	$("#dynamic_id"+b).hide();
	//alert(abc);	
	
	
}

//////////-----Form submission through AJAX----////
	function SubmitAddNew(c)
	{
		/*
		//var selected=$("#title_id"+c+).val();
			for(k=1;k<c;k++){
			var selected=$("#title_id"+k).val();
			
			if(selected==""){
			$("#error"+k).show();
			}
			else
			{
			alert('yes');	
			}
			exit;
		}//
		*/
		showLoader();
		$("#slide_submit").ajaxSubmit({
			url: "<?php echo $this->webroot;?>admin/sliderManagements/addSlide", 
			type: 'POST',
    		success: function(response)
				{	
					if(response.trim() == 'success'){
							window.location="<?php echo $this->Html->url('/admin/sliderManagements/index',true);?>";
						}
					else{
						hideLoader();
							alert("Exception=>"+response);
					}
					
				}
    		
    	});
		
		
	}
////////////----------To add a slide in the page------/////

		function addSlide(c){
			//alert(c);
		var str= '<div id="div_'+c+'" class="row-fluid slide_manage"><label>Slide Title'+c+'</label><div class="input text"><label for="title_id'+c+'"></label><input type="text" id="title_id'+c+'" name="data[SliderManagements][slide_title][]"></div><label><span class="help-inline" style="display:none;" id="error'+c+'">Please enter these fields</span>Description'+c+'</label><div class="input textarea"><label for="desc_id'+c+'"></label><textarea name="data[SliderManagements][slide_desc][]" id="desc_id'+c+'" class="cleditor" cols="30" rows="6"></textarea></div><label>Image'+c+'</label><div class="input file"><label for="SliderManagementsImage"></label><input type="file" name="data[SliderManagements][image][]"  enctype="multipart/form-data" id="SliderManagementsImage"/></div><input type="hidden" name="data[SliderManagements][pid]" value="'+<?php echo $this->params['pass'][0];?>+'" id="SliderManagementsPid"/><a href="javascript:changeMode_Static('+c+')" id="static_id'+c+'">Make Static</a><a href="javascript:changeMode_Dynamic('+c+')" id="dynamic_id'+c+'" style="display:none;">Make Dynamic</a></div><div class="input text"><label for="url_info_id'+c+'">url info</label><input type="text" required="required" id="url_info_id'+c+'" name="data[SliderManagements][url_info][]"></div></div>';	
		$("#slides").append(str);
		 $('.cleditor').cleditor();
		 $("input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
		 
		$("#addId").attr("onclick","addSlide("+(++c)+")");
		
		
		}
	
	
</script>
