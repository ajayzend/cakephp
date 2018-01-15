<div id="content1">  
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
<h2 class="col-md-12"><i class="fa fa-plus-circle"></i> Upload Port Excel <?php echo $this->Html->link('Go Back',array('action' => 'add_brand'),array('class'=>'btn btn-primary pull-right'));?>  </h2> 
<div class="clearfix"></div>
</div>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __(''); ?></span>
				<!--<span class="umstyle2" style="float:right"><?//php echo $this->Html->link(__("Home",true),"/") ?></span>-->
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			
			<div class="um_box_mid_content_mid"  id="register">
				<div class="um_box_mid_content_mid_left">
				
					<?php echo $this->Form->create('Port', array('action' => 'admin_upload_excel', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal')); ?>
					
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Excel');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->file("PortExcel" ,array('label' => false,'div' => false, 'required' => true, 'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
                        
					</div>
                    
                    <?php echo $this->Form->Submit('Save',array('type'=>'submit','class'=>'btn btn-primary ','div'=>false));?>
                    
					<?php echo $this->Form->end(); ?>
					
				</div>
				<div class="um_box_mid_content_mid_right" align="right"></div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>

</div>
</div>
</div>