<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
            	<h2><i class="fa fa-plus-circle"></i> <?php echo __('Add Inspection Shipping & Departure Operations')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div>
			  

				
				<div class=" tab-pane active" id="about_content">

					<?php echo $this->Form->create('ShipDepartures', array('action'=>'admin_add','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Office Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('office_name',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['office_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Inspection</label>
                            <div class="controls">
                                <?php echo $this->Form->input('inspection',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['inspection']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Re-examination</label>
                            <div class="controls">
                                <?php echo $this->Form->input('re_examination',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['re_examination']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Inspection Commission</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_commission',array('type'=>'text', 'label'=>false,'class'=>'form-control ', 'value' => $RecordData['ShipDepartures']['inspection_commission']));?>
                                </div>
                            </div>
                            
							<div class="control-group col-md-3">
								<label class="control-label"> Management Fee</label>
								<div class="controls">
									<?php echo $this->Form->input('Management_fee',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['ShipDepartures']['Management_fee']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Inspection Fee Payment Date</label>
								<div class="controls">
									<?php echo $this->Form->input('inspection_fee_payment-date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['inspection_fee_payment-date']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Payment</label>
								<div class="controls">
									<?php echo $this->Form->input('payment',array('type'=>'text','label'=>false,'class'=>'form-control ', 'value' => $RecordData['ShipDepartures']['payment']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('remarks',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['remarks']));?>
								</div>
							</div>
                            
                    <div class="control-group col-md-3">
                    <label class="control-label">Success or Failure</label>
                    <div class="controls">
                    <?php echo $this->Form->input('success_failure',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['success_failure']));?>
                    </div>
                    </div>
                    
                    <div class="control-group col-md-3">
                    <label class="control-label">Documents Return Date from QISJ</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('documents_return_date_QISJ',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['documents_return_date_QISJ']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                        <label class="control-label">BILL No.</label>
                        <div class="controls">
                            <?php echo $this->Form->input('bill_no',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['ShipDepartures']['bill_no']));?>
                        </div>
                    </div>
                    
                    <div class="control-group col-md-3">
                        <label class="control-label">Ship Company Payment Date</label>
                        <div class="controls">
                            <?php echo $this->Form->input('ship_company_payment_date',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['ship_company_payment_date']));?>
                        </div>
                    </div>
                    
							<div class="control-group col-md-3">
								<label class="control-label">Documents Return Date from <br> QISJ to Toyama</label>
								<div class="controls">
									<?php echo $this->Form->input('documents_return_date_QISJ_to_toyama',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['ShipDepartures']['documents_return_date_QISJ_to_toyama']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">ODOMETER Documents Toyama <br> Date of Arrival</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('odometer_documents_toyama_date_arrival',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['odometer_documents_toyama_date_arrival']));?>
                                </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                            <label class="control-label">Documents Date of Shipment <br> to QISJ</label>
                            <div class="controls">
                            
                            <?php echo $this->Form->input('documents_date_shipment_QISJ',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['documents_date_shipment_QISJ']));?>
                            </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                            <label class="control-label">Documents Date of Shipment <br> to SPX</label>	
                            <div class="controls">
                            <?php echo $this->Form->input('documents_date_shipment_SPX',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['documents_date_shipment_SPX']));?>
                            </div>
                            </div>
                            
							
							
							<div class="control-group col-md-3">
								<label class="control-label">Original BILL Toyama Date of Arrival</label>
								<div class="controls">
									<?php echo $this->Form->input('original_bill_toyama_date_arrival',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['original_bill_toyama_date_arrival']));?>
								</div>
							</div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">Original BILL DHL Request Date</label>
								<div class="controls">
									<?php echo $this->Form->input('original_bill_dhl_request_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['original_bill_dhl_request_date']));?>
								</div>
							</div>
							
                            <div class="control-group col-md-3">
                                <label class="control-label">Shipping Request Date</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('shipping_request_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['shipping_request_date']));?>
                                </div>
                            </div>
                            
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Shipping Charge</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('shipping_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['shipping_charge']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">In out Charge</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('in_out_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['in_out_charge']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Other Charge</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('other_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['other_charge']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Banning Charge</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('banning_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['banning_charge']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Radioactivity Inspection Fee</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('radioactivity_inspection_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['radioactivity_inspection_fee']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Storage Fee</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('storage_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['storage_fee']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Land Transportation Fee</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('land_transportation_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['land_transportation_fee']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Cost of Repairs</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('cost_repairs',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['cost_repairs']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Freight</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('freight',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['freight']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Work Fee</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('work_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['work_fee']));?>
                                </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Consignee Change Fee</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('consignee_change_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['consignee_change_fee']));?>
                                </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Ship's Name</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('ship_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['ship_name']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Payment</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('ship_payment',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['ship_payment']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Land for</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('land_for',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['land_for']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Departure Location</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('departure_location',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['departure_location']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Ship Company</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('ship_company',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['ship_company']));?>
                                </div>
                            </div>
                            
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Departure Date</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('departure_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['departure_date']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Date of Arrival</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('date_arrival',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['date_arrival']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Remarks</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('last_remarks',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['last_remarks']));?>
                                </div>
                            </div>
                            
                            

                         
						<div class="clearfix"></div>
					</div>
	</div>
    
    <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['ShipDepartures']['final_last_remark']));?>
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
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['ShipDepartures']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>