
<?php 
echo $this->Session->flash();?>
<div>
	<?php 
      echo $this->Common->breadcrumb(array($this->webroot.'admin'=>'Home',
									  $this->webroot.'admin/SliderManagements'=>'Slider Management',
									 $this->webroot.'admin/SliderManagements/edit/'.$this->params['pass'][1]=>'Slides',
									 'null'=>'edit'
									));
      
      ?> 
</div>
<div class="row-fluid">	

	<div class="box span12">

				<div class="box-header well">
					<h2><i class="icon-cog	"></i>Slider Management</h2>
					<div class="err_msg session_msg"></div>
				</div>

		<div class="box-content">
			

						
	
					<!--To check for slide editing	starts-->
					
						<?php 
						echo $this->Form->create('SliderManagement',array('enctype'=>'multipart/form-data')); ?>
						<label>Slide Tag Name </label>	
						<?php echo $this->Form->input('slide_title',array('label'=>false,'value'=>$slides_details[0]['SliderManagement']['slide_title'],'maxlength'=>300));?>
						<label>Slide Name</label>	
						<?php $a = explode("=>",$slides_details[0]['SliderManagement']['slide_tag']);?>
						
						<input type="text" required="required" value="<?php echo $a[0];?>" id="title_slideName"  class="input-xlarge focused" name="data[SliderManagement][slideName]">
									<input type="text" value="<?php echo $a[1];?>" required="required" id="title_slideName2"  class="input-xlarge focused" name="data[SliderManagement][slideName2]">
						<?php if($slides_details[0]['SliderManagement']['description']!="static"){	?>
						<label>Description</label>	
						<?php echo $this->Form->input('slide_desc',array('label'=>false,'type'=>'textarea','class'=>'cleditor','value'=>$slides_details[0]['SliderManagement']['description']));
						}//enIf
						else{
						echo $this->Form->input('slide_desc',array('label'=>'false','type'=>'hidden','value'=>$slides_details[0]['SliderManagement']['description'])
						);	
							
						}
						
						?>
				
						<label>Old image</label>
						<?php
						echo $this->Html->Image('/img/SliderManagements/'.$slides_details['0']['SliderManagement']['image_source'],array('height'=>'42','width'=>'45'));?>
						<?php echo $this->Form->input('old image',array('type'=>'hidden','value'=>$slides_details['0']['SliderManagement']['image']));?>
						<?php echo $this->Form->input('old_image_source',array('type'=>'hidden','value'=>$slides_details['0']['SliderManagement']['image_source']));?>
						
						<label>New image</label>
						<?php echo $this->Form->input('New_image', array('type'=>'file','label'=>false));
						echo $this->Form->input('sid',array('type'=>'hidden'));?>
						
						<?php echo $this->Form->input('url_info',array('id'=>'url_info_id','required'=>'required','label'=>'url info','value'=>$slides_details['0']['SliderManagement']['url_info']));?>
						<div class="form-actions">
						<button type="submit" class="btn btn-primary" title='click here to save changes'>Save Changes</button>
						<?php echo $this->html->link('Cancel',array('controller'=>'sliderManagements','action' => 'index'), array('escape' => false,
      					'class'=>array('btn'),'label'=>false,'title'=>'click here to cancel')); ?>
      					</div>
					<!--ends-->
								
	
		</div>
			
</div>
