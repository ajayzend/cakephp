<script>
$(function(){
$('#showMessage').delay(4000).fadeOut( "slow" );
});
</script>
<div id="content1"> 
	<div class="box col-md-12">
		<div class="box-header well">
			<div class="col-md-12">
				<h2><i class="fa fa-list-alt"></i> Sale Management Authentication</h2>
			</div>
				
			<div class="clearfix">

			</div>	
			<div id="showMessage">
			<?php
				$success = $this->Session->flash();
				if($success) {?>
				<div  class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert"></button>
					<strong><?php echo $success ;?></strong>
				</div>
			<?php }?>
			</div>

		</div>
				<?php echo $this->Form->create('Reports');?>
				<div class="col-sm-6">
					<label>Enter Report Password:</label>
						<?php echo $this->Form->input('report_password',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>'Enter Report Password'));?>
				</div>
				<div class="form-group">
					<div class="col-sm-12"><?php echo $this->Form->submit('Submit',array('type'=>'submit','class'=>'btn btn-primary pull-right'));?></div>
				</div>
				<?php echo $this->Form->end();?>
	</div>
</div>	
