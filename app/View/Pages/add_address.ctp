<div id="content1">
<div class="row sordiv">
<div class="box col-md-12">
			<div class="box-header well">				
				<h2 class="col-md-12"><i class="fa fa-file-text-o"></i> <?php echo __('Add Invoice Address ')?>				
				<?php echo $this->Html->link('Go Back',array('action' => 'page_list','controller'=>'pages'),array('class'=>'btn btn-primary pull-right'));?>

				  </h2> 
			<div class="clearfix"></div>				
			</div>
			
			
			
							<div id="showmsg"></div>
							<div style="display:none;" id="messageDivIdSucc" class="alert alert-success "></div>
							<div style="display:none;" id="errmessageDiv" class="alert alert-danger"></div>
							<?php
							if(isset($msg))
							{?>
							
								<div class="alert alert-success">
										<strong><?php echo $msg ;?></strong>
								</div>
							
							<?php }?>
							<?php
							$success = $this->Session->flash(); 
							if($success) {?>
							
								<div class="alert alert-success">
										<strong><?php echo $success ;?></strong>
								</div>
							
							<?php }?>
							<?php echo $this->Form->create('Page',array('controller'=>'pages','action'=>'add_address')); ?>
							
								<div class="invo_admin">
									<div class="col-md-6">
										
										<div class="col-md-3">
											<div id="cl"></div>
											<?php echo __('Discription');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('discription',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
										
									</div>
							
									<div class="col-md-6">
										<div class="col-md-3">
											<div id="cn"></div>
											<?php echo __('Line 1');?>
										</div>
										<div class="col-md-9">
											<div class="controls"><?php echo  $this->Form->input('line_1',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>
									
									
									
									<div class="col-md-6">
										<div class="col-md-3"> 
											<div id="da"></div>
											<?php echo __('Line 2');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('line_2',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="col-md-3">
										<div id="bn"></div>
											<?php echo __('Line 3');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('line_3',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="col-md-3">
										<div id="bn"></div>
											<?php echo __('Line 4');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('line_4',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>
										
									<div class="col-md-6">
										<div class="col-md-3">
										<div id="bn"></div>
											<?php echo __('Line 5');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('line_5',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>	
									
									<div class="col-md-6">
										<div class="col-md-3">
										<div id="bn"></div>
											<?php echo __('Line 6');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('line_6',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="col-md-3">
										<div id="bn"></div>
											<?php echo __('Line 7');?>
										</div>
										<div class="col-md-9">
											<div class="controls">
												<?php echo  $this->Form->input('line_7',array('type'=>'text','class'=>'form-control','label'=>false,'id'=>'')); ?>
											</div> 
										</div>
									</div>
									
									<div>
										
									</div>
									<div>

									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
										<div class="submit  pull-right">
											<?php echo $this->Form->submit('Add',array('type'=>'submit','class'=>'btn btn-primary','label'=>false,'div'=>false)); ?>
										</div>
									</div>
											
											</div> 
										</div>
									</div>
								</div>	
								   <?php echo $this->Form->end(); ?>

				<div class="col-md-12">				
<div class="row">
				<div id="showDetail" class="col-md-12"></div>
			
			</div>

		</div><!--/fluid-row-->
		</div><!--/fluid-row-->
</div>
</div>
