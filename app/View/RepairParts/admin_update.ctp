<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
            	<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Repair Parts Operations')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div>
			  

				
				<div class=" tab-pane active" id="about_content">

					<?php echo $this->Form->create('RepairParts', array('action'=>'admin_add','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Repair</label>
                            <div class="controls">
                                <?php echo $this->Form->input('repair',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['repair']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Date of Repair</label>
                            <div class="controls">
                                <?php echo $this->Form->input('date_of_repair',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['date_of_repair']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Repair Company</label>
                            <div class="controls">
                                <?php echo $this->Form->input('repair_company',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['repair_company']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Vehicle Identification Number</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('vehicle_identification_number',array('type'=>'text', 'label'=>false,'class'=>'form-control', 'value' => $RecordData['RepairParts']['vehicle_identification_number']));?>
                                </div>
                            </div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">Car Model</label>
								<div class="controls">
									<?php echo $this->Form->input('car_model',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['RepairParts']['car_model']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Price</label>
								<div class="controls">
									<?php echo $this->Form->input('price',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['price']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('remarks',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['RepairParts']['remarks']));?>
								</div>
							</div>
                   </div>
                   
                   <hr>
                   <h3>Parts</h3>
                   <hr>
                   
                   <div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Parts</label>
                            <div class="controls">
                                <?php echo $this->Form->input('parts',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['parts']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Purchase Date</label>
                            <div class="controls">
                                <?php echo $this->Form->input('purchase_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['purchase_date']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Purchasing Company</label>
                            <div class="controls">
                                <?php echo $this->Form->input('purchasing_company',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['purchasing_company']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Vehicle Identification Number</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('part_vehicle_identification_number',array('type'=>'text', 'label'=>false,'class'=>'form-control ', 'value' => $RecordData['RepairParts']['part_vehicle_identification_number']));?>
                                </div>
                            </div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">Car Model</label>
								<div class="controls">
									<?php echo $this->Form->input('part_car_model',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['RepairParts']['part_car_model']));?> 
								</div>
							</div>
                            <div class="control-group col-md-3">
								<label class="control-label">Parts　Name</label>
								<div class="controls">
									<?php echo $this->Form->input('parts_name',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['RepairParts']['parts_name']));?> 
								</div>
							</div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">Price</label>
								<div class="controls">
									<?php echo $this->Form->input('parts_price',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['parts_price']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('parts_remarks',array('type'=>'text','label'=>false,'class'=>'form-control ', 'value' => $RecordData['RepairParts']['parts_remarks']));?>
								</div>
							</div>
                   </div>
                         
                         
                         
                         
                         
						<div class="clearfix"></div>
					</div>
	</div>
    
    <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['RepairParts']['final_last_remark']));?>
								</div>
							</div>
							</div>
                            
						<!-- form-1--> 
						<div class="row">
						<div class="col-md-6">
						<div class="form-group col-md-6">
							<div class="controls">
                            <?php echo $this->Form->input('tab_id',array('type'=>'hidden','id'=>'tab1')); ?>
							  <input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">
							  <button type="submit" class="btn btn-primary" id="submit">Save</button>
							</div>
				     
						</div>
						</div>
						</div>
                         <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['RepairParts']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>