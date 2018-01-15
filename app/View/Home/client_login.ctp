<div style="height:auto;min-height:100%;">
	<div class="container back_user">
		<div class="col-sm-4 col-sm-offset-4 client-login">
			
			<?php echo $this->Form->create('home');?>
				<div class="form-group">
					<label>Enter Password:</label>
						<?php echo $this->Form->input('password',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control','autocomplete'=>'off'));?>
						<?php echo $this->Session->flash();?>
				</div>
				<div class="form-group">
					<div class="col-sm-12"><?php echo $this->Form->submit('Submit',array('type'=>'submit','class'=>'btn btn-primary pull-right'));?></div>
				</div>
				<?php
					echo $this->Form->end();?>
		</div>
	</div>
</div>
