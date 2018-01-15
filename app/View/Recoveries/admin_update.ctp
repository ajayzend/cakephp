<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
            	<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Recovery Operations')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div>
				<div class=" tab-pane active" id="about_content">
				<!--form-1 here-->
					<?php echo $this->Session->flash(); ?>
					<div class="myloader" id="loading2" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
					<?php echo $this->Form->create('Recovery', array('action'=>'admin_add','class'=>"car_package")); ?>
					
                    <div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Remittance Names</label>
                            <div class="controls">
                                <?php echo $this->Form->input('remittance_names',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['remittance_names']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Amount of Remittance ($)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('amount_remittance_dlr',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['amount_remittance_dlr']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Amount of Remittance (&yen;)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('amount_remittance_yen',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['amount_remittance_yen']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Remittance Bank</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('remittance_bank',array('type'=>'text', 'label'=>false,'class'=>'form-control', 'value' => $RecordData['Recovery']['remittance_bank']));?>
                                </div>
                            </div>
							<div class="control-group col-md-3">
								<label class="control-label">Country</label>
								<div class="controls">
									<?php echo $this->Form->input('country',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Recovery']['country']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Customer Name</label>
								<div class="controls">
									<?php echo $this->Form->input('customer_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['customer_name']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remittance Date</label>
								<div class="controls">
									<?php echo $this->Form->input('remittance_date',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['Recovery']['remittance_date']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remittance No.</label>
								<div class="controls">
									<?php echo $this->Form->input('remittance_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['remittance_no']));?>
								</div>
							</div>
                            
                    <div class="control-group col-md-3">
                    <label class="control-label">Rate</label>
                    <div class="controls">
                    <?php echo $this->Form->input('rate',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['rate']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Rate (Advances Received)</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('rate_advances',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['rate_advances']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Terms of Amount</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('terms_amount',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['terms_amount']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label">Exchange Loss (&yen;)</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('exchange_loss_yen',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['exchange_loss_yen']));?>
                    </div>
                    </div>
                    
							<div class="control-group col-md-3">
								<label class="control-label"> Exchange Loss ($)</label>
								<div class="controls">
									<?php echo $this->Form->input('exchange_loss_dlr',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Recovery']['exchange_loss_dlr']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Rounding Loss</label>
								<div class="controls">
									<?php echo $this->Form->input('eounding_loss',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['eounding_loss']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Exchange Gain (&yen;)</label>
								<div class="controls">
									<?php echo $this->Form->input('exchange_gain_yen',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['Recovery']['exchange_gain_yen']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Exchange Gain ($)</label>
								<div class="controls">
									<?php echo $this->Form->input('exchange_gain_dlr',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['exchange_gain_dlr']));?>
								</div>
							</div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">Rounding Gains</label>
								<div class="controls">
									<?php echo $this->Form->input('rounding_gains',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['rounding_gains']));?>
								</div>
							</div>
                            
                            
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Advance</label>
								<div class="controls">
									<?php echo $this->Form->input('advance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['advance']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Cash (Advances Received)</label>
								<div class="controls">
									<?php echo $this->Form->input('cash_advances',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cash_advances']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Customer Unknown</label>
								<div class="controls">
									<?php echo $this->Form->input('customer_unknown',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['customer_unknown']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Distribution of Remittance</label>
								<div class="controls">
									<?php echo $this->Form->input('distribution_remittance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['distribution_remittance']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('remarks',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['remarks']));?>
								</div>
							</div>
						</div>
                        
                    <hr>
                    <h3>Reimburse Remittance, Cancel Vehicle</h3>
                    <hr>
                    
                    <div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Remittance Names</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_remittance_names',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_remittance_names']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Amount of Remittance ($)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_amount_remittance_dlr',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_amount_remittance_dlr']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Amount of Remittance (&yen;)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_amount_remittance_yen',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_amount_remittance_yen']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Remittance Bank</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('cancel_remittance_bank',array('type'=>'text', 'label'=>false,'class'=>'form-control ', 'value' => $RecordData['Recovery']['cancel_remittance_bank']));?>
                                </div>
                            </div>
							<div class="control-group col-md-3">
								<label class="control-label">Country</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_country',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Recovery']['cancel_country']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Customer Name</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_customer_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_customer_name']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remittance Date</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_remittance_date',array('type'=>'text','label'=>false,'class'=>'form-control ', 'value' => $RecordData['Recovery']['cancel_remittance_date']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remittance No.</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_remittance_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_remittance_no']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Hit Back Day</label>
								<div class="controls">
									<?php echo $this->Form->input('hit_back_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['hit_back_day']));?>
								</div>
							</div>
                            
                    <div class="control-group col-md-3">
                    <label class="control-label">Rate</label>
                    <div class="controls">
                    <?php echo $this->Form->input('cancel_rate',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_rate']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Rate (Advances Received)</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('cancel_rate_advances',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_rate_advances']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Terms of Amount</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('cancel_terms_amount',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_terms_amount']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label">Exchange Loss (&yen;)</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('cancel_exchange_loss_yen',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_exchange_loss_yen']));?>
                    </div>
                    </div>
                    
							<div class="control-group col-md-3">
								<label class="control-label"> Exchange Loss ($)</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_exchange_loss_dlr',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Recovery']['cancel_exchange_loss_dlr']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Rounding Loss</label>
								<div class="controls">
									<?php echo $this->Form->input('rounding_loss',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['rounding_loss']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Exchange Gain (&yen;)</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_exchange_gain_yen',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['Recovery']['cancel_exchange_gain_yen']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Exchange Gain ($)</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_exchange_gain_dlr',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_exchange_gain_dlr']));?>
								</div>
							</div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">Rounding Gains</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_rounding_gains',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_rounding_gains']));?>
								</div>
							</div>
                            
                            
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Advance</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_advance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_advance']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Cash (Advances Received)</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_cash_advances',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_cash_advances']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Customer Unknown</label>
								<div class="controls">
									<?php echo $this->Form->input('cnacel_customer_unknown',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cnacel_customer_unknown']));?>
								</div>
							</div>
                            
                            <div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_remarks',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['cancel_remarks']));?>
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
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Recovery']['final_last_remark']));?>
								</div>
							</div>
							</div>
                            
						<!-- form-1--> 
						<div class="row">
						<div class="col-md-6">
						<div class="form-group col-md-6">
							<div class="controls">
							
                            <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['Recovery']['id']));?>
                            
							  <button type="submit" class="btn btn-primary" id="submit">Save</button>
							</div>
				     
						</div>
						</div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>