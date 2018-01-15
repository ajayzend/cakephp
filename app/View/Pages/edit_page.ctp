<script src="//cdn.ckeditor.com/4.4.6/full/ckeditor.js"></script>
<!--http://cdn.ckeditor.com/4.4.6/standard-all/ckeditor.js -->
<?php //echo $this->Html->script(array('config'));?>

<script>
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.forcePasteAsPlainText = false; // default so content won't be manipulated on load
    CKEDITOR.config.basicEntities = true;
    CKEDITOR.config.entities = true;
    CKEDITOR.config.entities_latin = false;
    CKEDITOR.config.entities_greek = false;
    CKEDITOR.config.entities_processNumerical = false;
    CKEDITOR.config.fillEmptyBlocks = function (element) {
            return true; // DON'T DO ANYTHING!!!!!
    };
    
    CKEDITOR.config.allowedContent = true; // don't filter my data
	</script>
<div id="content1">   
	<div id="mainDiv">
		<div class="row sortable">
			<div class="box col-md-12">
				<div class="box-header well">
					<div class="col-md-12"><h2><i class="fa fa-asterisk sidebar_ico_margin">&nbsp;</i>Page Management</h2></div>
							<div class="clearfix"></div>	
					</div>
					<div class="pull-right" style="margin-bottom:20px">

						
						<?php echo $this->Html->link('Go Back',array('action' => '/page_list'),array('class'=>'btn btn-primary'));?>  
						<div class="clearfix"></div>		
							

						</div>
					<div class="box-content">
						<?php
							$success = $this->Session->flash(); 
							if($success)
							 {
								 ?>
								<div id="hideDiv">
									<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert">×</button>
													<strong><?php echo $success ;?></strong>
									</div>
								</div>
						<?php }?>
					
						
					<?php echo $this->Form->create('Page',array('id'=>'page'));?>

									
							<div class="clearfix"></div>
							<p class="field">
								<textarea class='ckeditor' name='data[Page][content]'><?php echo $result['Page']['content']; ?></textarea>
							</p> 	
							<p class="submit-wrap">
							
								<?php echo $this->Form->button('<i class="fa fa-plus-circle">&nbsp;</i>Save', array('type' => 'submit','class' => 'btn btn-primary'));?>
								<?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Cancel' ,
											array(
												'action' => 'page_list'
											),array(
											'class'=>'btn btn-danger','escape'=>false  )
											
										);?>
							</p>
						
						<?php $this->Form->end();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>		


