<script>
$(document).ready(function() {
	
	});
</script>


<div class="container  back_user">
<div class="row">
	<div class="col-md-12 col-lg-12 manage_height">
	<h2>HEAD OFFICE</h2>
	<div class="row">
	</div>
	<hr>
	<div class="row">
	<div class="col-md-8 col-lg-8 contact_textbox">
		<div style="display:none;" id="messageDivIdSucc" class="alert alert-success ">
	</div>
	<div style="display:none;" id="errmessageDiv" class="alert alert-danger">
	</div>
	<?php echo $this->Form->create('address',array('id'=>'addressfrm'));?>
		
		<br/>
		<br/>
		<div class="clearfix"></div>
		<p class="field">
			<!-- <textarea name="your-message" cols="40" rows="10" class="form-control" placeholder="Message:"></textarea> -->
			<?php echo $this->Form->input('head_office_address',array('type'=>'textarea','class'=>'form-control','rows'=>'10','cols'=>'40','aria-required'=>true,'label'=>false,'placeholder'=>'Address:'));?>
		</p>
		<p class="submit-wrap">
			<!-- <input type="reset" value="Clear" class="btn btn-danger btn-sm">
			<input type="button" value="Send" class="btn btn-danger btn-sm" 'onClick'="javascript:submitForm();">
			-->
			
			<?php echo $this->Form->button('Send', array('type' => 'button','onclick'=>'submitForm();', 'class' => 'btn btn-primary'));?>
			<?php echo $this->Form->button('Clear', array('type' => 'reset', 'class' => 'btn btn-danger'));?>
			
			
		</p>
	<!-- </form> -->
	<?php $this->Form->end();?>
</div>
	
</div>
	
	
	
	
</div>

</div>
</div>

