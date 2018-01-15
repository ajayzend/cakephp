<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
            	<h2><i class="fa fa-plus-circle"></i> <?php echo __('Add Concery Information')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div>
			  

				
				<div class=" tab-pane active" id="about_content">

					<?php echo $this->Form->create('Information', array('action'=>'admin_add','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">CLIENT NAME</label>
                            <div class="controls">
                                <?php echo $this->Form->input('client_name',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['client_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Consignee Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('consignee_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['consignee_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Postal Address</label>
                            <div class="controls">
                                <?php echo $this->Form->input('postal_address',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['postal_address']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">CFS</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('cfs',array('type'=>'text', 'label'=>false,'class'=>'form-control ', 'value' => $RecordData['Information']['cfs']));?>
                                </div>
                            </div>
                            
							<div class="control-group col-md-3">
								<label class="control-label"> Telephone</label>
								<div class="controls">
									<?php echo $this->Form->input('telephone',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Information']['telephone']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Email</label>
								<div class="controls">
									<?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['email']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Contact Parson</label>
								<div class="controls">
									<?php echo $this->Form->input('contact_parson',array('type'=>'text','label'=>false,'class'=>'form-control ', 'value' => $RecordData['Information']['contact_parson']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Notify Party</label>
								<div class="controls">
									<?php echo $this->Form->input('notify_party',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['notify_party']));?>
								</div>
							</div>
                            
                    <div class="control-group col-md-3">
                    <label class="control-label">Notify Party Telephone</label>
                    <div class="controls">
                    <?php echo $this->Form->input('notify_party_telephone',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['notify_party_telephone']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Notify Party Email</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('notify_party_email',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['notify_party_email']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Vehicle Identification Number</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('vehicle_identification_number',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['vehicle_identification_number']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label">Car Model</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('car_model',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['car_model']));?>
                    </div>
                    </div>
                    
							<div class="control-group col-md-3">
								<label class="control-label">Invoice No.</label>
								<div class="controls">
									<?php echo $this->Form->input('invoice_no',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Information']['invoice_no']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Invoice Day</label>
								<div class="controls">
									<?php echo $this->Form->input('invoice_day',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['invoice_day']));?>
								</div>
							</div>
                         
						<div class="clearfix"></div>
					</div>
	</div>
    
    <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Information']['final_last_remark']));?>
								</div>
							</div>
							</div>
                            
						<!-- form-1--> 
						<div class="row">
						<div class="col-md-6">
						<div class="form-group col-md-6">
							<div class="controls">
							  <button type="submit" class="btn btn-primary" id="submit">Save</button>
							</div>
				     
						</div>
						</div>
						</div>
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['Information']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>