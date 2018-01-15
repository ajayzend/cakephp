<?php
?>
<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
			<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Purchase Operations')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div>
			  

				
				<div class=" tab-pane active" id="about_content">
				<!--form-1 here-->
					<?php echo $this->Session->flash(); ?>
					<div class="myloader" id="loading2" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
					<?php echo $this->Form->create('Purchase', array('action'=>'admin_update','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label" for="inputbodystyle">Auction day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('purchase_auction_day',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_auction_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label" for="inputbodystyle">Auction Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('purchase_auction_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_auction_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label" for="inputbodystyle">Vehicle identification number</label>
                            <div class="controls">
                                <?php echo $this->Form->input('purchase_vechinle_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_vechinle_no']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label" for="inputbodystyle">Car model</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('purchase_modal',array('type'=>'text', 'label'=>false,'class'=>'form-control', 'value' => $RecordData['Purchase']['purchase_modal']));?>
                                </div>
                            </div>
					</div>
                    <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle"> Price</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_price',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Purchase']['purchase_price']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Unit</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_unit',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_unit']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Car price</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_car_price',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['Purchase']['purchase_car_price']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Recycling charge</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_recycling',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_recycling']));?>
								</div>
							</div>
                   </div>
                   <div class="row">
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Car Tax</label>
                    <div class="controls">
                    <?php echo $this->Form->input('purchase_tax',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_tax']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Successful bid charge</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('purchase_bid_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_bid_charge']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Penalty</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('purchase_panelty',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_panelty']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Agency fee</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('purchase_agecy_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_agecy_fee']));?>
                    </div>
                    </div>
                   </div>
                         
                         
                         <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle"> Auction payment date</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_payment_date',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Purchase']['purchase_payment_date']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Paying bank</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_bank',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_bank']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Payment</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_payment',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['Purchase']['purchase_payment']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Cancellation date</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_cancel_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_cancel_date']));?>
								</div>
							</div>
                         </div>
                         <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">The first year date</label>
								<div class="controls">
									<?php echo $this->Form->input('purchase_first_year',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['purchase_first_year']));?>
								</div>
							</div>
							</div>
                         
						<div class="clearfix"></div>
                        
                        <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Purchase']['final_last_remark']));?>
								</div>
							</div>
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
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['Purchase']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>