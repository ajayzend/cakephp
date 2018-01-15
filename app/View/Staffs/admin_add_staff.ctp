<?php
?>
<div id="content1">  
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<h2 class="col-md-12"><i class="fa fa-plus-circle"></i> Add Staff <?php echo $this->Html->link('Go Back',array('action' => 'index'),array('class'=>'btn btn-primary pull-right'));?>  </h2> 
						<div class="clearfix"></div>
						
</div>
 
		<?php
			$success = $this->Session->flash(); 
			if($success) {?>
			<div id="hideDiv">
				<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong><?php echo $success ;?></strong>
				</div>
			</div>
			<?php }?>
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
				
					<?php echo $this->Form->create('staffs', array('action' => 'addStaff','class'=> 'form-horizontal')); ?>
					<div class="col-sm-6">

                    <div class="control-group">
                    <label for="typeahead" class="control-label control-label_width"><?php echo __('Name');?><font color='red'>*</font> </label>
                    
                        <div class="controls" ><?php echo $this->Form->input("first_name" ,array('type' => 'text','label' => false,'div' => false,'class'=>"form-control", 'required' => true))?></div>
                        <div style="clear:both"></div>
                    </div>			
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Username');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->input("username" ,array('label' => false,'div' => false,'class'=>"form-control", 'required' => true ))?></div>
						<div style="clear:both"></div>
					</div>
					
					
					</div>
					<div class="col-sm-6">
					
						
					
					 
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Password');?><font color='red'>*</font></label>
						<div class="controls"><?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"form-control", 'required' => true))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="control-group">
						<label class="control-label control-label_width"><?php echo __('Role');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->input("user_group_id" ,array('label' => false,'options'=>array("1" => "Super Admin", "4" => "Manager"),'data-rel'=>'chosen','div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					</div>
                    
                    <div class="clearfix"></div>
                    
                    
                    <label class="control-label control-label_width"><?php echo __('Role');?><font color='red'>*</font></label>
                    
                    
                    <div style="clear:both"></div>
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="1"> Vehicle Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="2"> Country Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="3"> Auction Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="4"> Client Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="5"> Brand Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="6"> Port Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="7"> Transport Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="8"> Shipping Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="9"> Vehicle Name Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="10"> Invoice Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="11"> Report Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="12"> Sale Report</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="13"> Ship Schedules Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="14"> Bank Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="15"> User Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="16"> Miscellaneous</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="17"> Hidden Vehicle</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="18"> Home Page Slider</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="19"> About Us</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="20"> Page Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="21"> CIF Query</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="22">Purchase Operation Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="23">Domeastic On Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="24">Overseas Sales Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="25">Recovery Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="26">Repair Parts Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="27"> Land Trans | Carry In-Out Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="28"> Inspection Ship & Depart Management</div>
					</div>
                    
                    <div class="col-sm-4">
					<div class="control-group"><input type="checkbox" name="staff_permission[]" value="29"> Concery Information</div>
					</div>
					
                    <div style="clear:both"></div>
                    
					<div class="pull-right">
						<?php echo $this->Form->Submit('Save',array('type'=>'submit','class'=>'btn btn-primary ','div'=>false));?>
						<?php echo $this->Html->link('Cancel',array('action' => 'allUsers'),array('class'=>'btn btn-danger'));?>
						
					</div>
					
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