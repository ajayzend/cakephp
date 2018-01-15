<?php
?>
<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
			<?php
			 if(!empty($carDetails)){?>
				<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Purchase Operations')?></h2>
				<?php }else{?>
					
					<h2><i class="fa fa-plus-circle"></i> <?php echo __('Add Purchase Operations')?></h2>
				
					<?php }?>
			<div class="clearfix"></div>	
			</div>
			<div>
			  

				
				<div class=" tab-pane active" id="about_content">
				<!--form-1 here-->
					<?php echo $this->Session->flash(); ?>
					<div class="myloader" id="loading2" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
					<?php echo $this->Form->create('Domestic', array('action'=>'admin_add','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label" for="inputbodystyle">Sales Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('sales_day',array('type'=>'text', 'class'=>'form-control','label'=>false, 'value' => $RecordData['Domestic']['sales_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label" for="inputbodystyle">Sales Auction　Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('auction_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['auction_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label" for="inputbodystyle">Vehicle identification number</label>
                            <div class="controls">
                                <?php echo $this->Form->input('indentification',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['indentification']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label" for="inputbodystyle">Car model</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('model',array('type'=>'text', 'label'=>false,'class'=>'form-control ', 'value' => $RecordData['Domestic']['model']));?>
                                </div>
                            </div>
					</div>
                    <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle"> Price</label>
								<div class="controls">
									<?php echo $this->Form->input('price',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Domestic']['price']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Unit</label>
								<div class="controls">
									<?php echo $this->Form->input('unit',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['unit']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Car price</label>
								<div class="controls">
									<?php echo $this->Form->input('car_price',array('type'=>'text','label'=>false,'class'=>'form-control ', 'value' => $RecordData['Domestic']['car_price']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Exhibition Charge</label>
								<div class="controls">
									<?php echo $this->Form->input('exhibition',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['exhibition']));?>
								</div>
							</div>
                   </div>
                   <div class="row">
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Conclusion of a contract fee</label>
                    <div class="controls">
                    <?php echo $this->Form->input('contact_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['contact_fee']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Remarks</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['remark']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Sales payment day</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('payment_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['payment_day']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label" for="inputbodystyle">Sales payment Bank</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('payment_bank',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['payment_bank']));?>
                    </div>
                    </div>
                   </div>
                         
                         
                         <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label" for="inputbodystyle">Payment amount</label>
								<div class="controls">
									<?php echo $this->Form->input('payment_amount',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['Domestic']['payment_amount']));?>
								</div>
							</div>
                         </div>
						<div class="clearfix"></div>
                        
                        
                        <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['Domestic']['final_last_remark']));?>
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
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['Domestic']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>