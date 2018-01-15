<?php
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<div id="content1">  
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
						<h2 class="col-md-12"><i class="fa fa-plus-circle"></i> Add User <?php echo $this->Html->link('Go Back',array('action' => 'allUsers'),array('class'=>'btn btn-primary pull-right'));?>  </h2> 
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
	<?php //echo $this->element('dashboard'); ?>
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
				
					<?php echo $this->Form->create('User', array('action' => 'addUser','class'=> 'form-horizontal')); ?>
					<div class="col-sm-6">
			<?php   if (count($userGroups) >2) { ?>
						<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Group');?><font color='red'>*</font> </label>
						
							<div class="controls" ><?php echo $this->Form->input("user_group_id" ,array('type' => 'select','label' => false,'div' => false,'class'=>"form-control",'data-rel'=>'chosen','selected'=>'2' ))?></div>
							<div style="clear:both"></div>
						</div>
			<?php   }   ?>
			
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Username');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->input("username" ,array('label' => false,'div' => false,'class'=>"form-control" ))?></div>
						<div style="clear:both"></div>
					</div>
					
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Password');?><font color='red'>*</font></label>
						<div class="controls"><?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Confirm Password');?><font color='red'>*</font></label>
						<div class="controls"><?php echo $this->Form->input("cpassword" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"form-control"))?></div>	
					</div>
					<div class="control-group">
						<label class="control-label control-label_width"><?php echo __('Bank Name');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->input("bank_id" ,array('label' => false,'options'=>$bankDetails ,'data-rel'=>'chosen','empty'=>'Select Bank','div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Select Country');?><font color='red'>*</font> </label>
						
							<div class="controls" ><?php echo $this->Form->input("uniqueid" ,array('type' => 'select','empty'=>'Select Country', 'label' => false,'div' => false,'class'=>"form-control",'data-rel'=>'chosen','options'=>$CounrtyDetails))?></div>
							<div style="clear:both"></div>
					</div>
					
					
					</div>
					<div class="col-sm-6">
					
						
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('First Name');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->input("first_name" ,array('label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Last Name');?><font color='red'>*</font></label>
						<div class="controls" ><?php echo $this->Form->input("last_name" ,array('label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div> 
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Invoice Name');?></label>
						<div class="controls" ><?php echo $this->Form->input("user_invoice_name" ,array('label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Contact No');?></label>
						<div class="controls" ><?php echo $this->Form->input("contact" ,array('label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Email');?></label>
						<div class="controls" ><?php echo $this->Form->input("email" ,array('label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div> 
					<div class="control-group">
						<label for="typeahead" class="control-label control-label_width"><?php echo __('Alternate Email');?></label>
						<div class="controls" ><?php echo $this->Form->input("alternate_email" ,array('label' => false,'div' => false,'class'=>"form-control"))?></div>
						<div style="clear:both"></div>
					</div>
					<div class="pull-right">
						<?php echo $this->Form->Submit('Save',array('type'=>'submit','class'=>'btn btn-primary ','div'=>false));?>
						<?php echo $this->Html->link('Cancel',array('action' => 'allUsers'),array('class'=>'btn btn-danger'));?>
						
					</div>
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
<script>
document.getElementById("UserUserGroupId").focus();
</script>
