<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
			<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Overseas Sale Operations')?></h2>
            <div class="clearfix"></div>	
			</div>
			  
				<div class=" tab-pane active" id="about_content">
				<!--form-1 here-->
					<?php echo $this->Session->flash(); ?>
					<div class="myloader" id="loading2" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
					<?php echo $this->Form->create('OverseasSales', array('action'=>'admin_add','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Country</label>
                            <div class="controls">
                                <?php echo $this->Form->input('sales_country',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['sales_country']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Customer Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('customer_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['customer_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('sales_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['sales_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Sales Price ($)</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('sales_price_dlr',array('type'=>'text', 'label'=>false, 'value' => $RecordData['OverseasSales']['sales_price_dlr'],'class'=>'form-control '));?>
                                </div>
                            </div>
					</div>
                    <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label">Sales Price (&yen;)</label>
								<div class="controls">
									<?php echo $this->Form->input('sales_price_yen',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['sales_price_yen'],'class'=>"form-control"));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Unit</label>
								<div class="controls">
									<?php echo $this->Form->input('unit',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['unit']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Invoice No.</label>
								<div class="controls">
									<?php echo $this->Form->input('invoice_no',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['invoice_no'],'class'=>'form-control '));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Invoice Day</label>
								<div class="controls">
									<?php echo $this->Form->input('invoice_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['invoice_day']));?>
								</div>
							</div>
                   </div>
                   <div class="row">
                    <div class="control-group col-md-3">
                    <label class="control-label">BILL No.</label>
                    <div class="controls">
                    <?php echo $this->Form->input('bill_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['bill_no']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">BILL No. (UK)</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('bill_no_uk',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['bill_no_uk']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Rate (Accounts Receivable)</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('rate_acc_receivable',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['rate_acc_receivable']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label">Rate (Advances Received)</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('rate_advance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['rate_advance']));?>
                    </div>
                    </div>
                   </div>
                         
                         
                         <div class="row">
							<div class="control-group col-md-3">
								<label class="control-label">Slip Issuance Date</label>
								<div class="controls">
									<?php echo $this->Form->input('slip_issue_date',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['slip_issue_date'],'class'=>"form-control"));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('remark',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['remark']));?>
								</div>
							</div>
                         </div>
						<div class="clearfix"></div>
					</div>
                    
    				<hr>
                    <h3>Cancel</h3>
                    <hr>

					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Country</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_sale_country',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_sale_country']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Customer Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_cust_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_cust_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_sales_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_sales_date']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Cancel Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                            <label class="control-label">Cancel Price ($)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_price_dlr',array('type'=>'text', 'label'=>false, 'value' => $RecordData['OverseasSales']['cancel_price_dlr'],'class'=>'form-control '));?>
                            </div>
                        </div>
                        
                        <div class="control-group col-md-3">
                            <label class="control-label">Cancel Price (&yen;)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_price_yen',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_price_yen'],'class'=>"form-control"));?> 
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Invoice No.</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_invoice_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_invoice_no']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Invoice Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cancel_invoice_day',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_invoice_day'],'class'=>'form-control '));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">BILL No.</label>
                        <div class="controls">
                        <?php echo $this->Form->input('cancel_bill_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_bill_no']));?>
                        </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">BILL No. (UK)</label>
                        <div class="controls">
                        
                        <?php echo $this->Form->input('cancel_bill_no_uk',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_bill_no_uk']));?>
                        </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">Rate (Accounts Receivable)</label>	
                        <div class="controls">
                        <?php echo $this->Form->input('cancel_rate_receivable',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_rate_receivable']));?>
                        </div>
                        </div>     
                        <div class="control-group col-md-3">
                        <label class="control-label">Rate (Advances Received)</label>	
                        <div class="controls">
                        <?php echo $this->Form->input('cancel_rate_advance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_rate_advance']));?>
                        </div>
                        </div>
                        
							<div class="control-group col-md-3">
								<label class="control-label">Slip Issuance Date</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_slip_date',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_slip_date'],'class'=>"form-control"));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('cancel_remark',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cancel_remark']));?>
								</div>
							</div>
                         </div>
                         
                         
                    <hr>
                    <h3>Amount Change</h3>
                    <hr>

					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Country</label>
                            <div class="controls">
                                <?php echo $this->Form->input('acc_change_sales_country',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['acc_change_sales_country']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Customer Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('acc_change_cust_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['acc_change_cust_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('acc_change_sales_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['acc_change_sales_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Change Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('acc_change_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['acc_change_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Change Contents</label>
                            <div class="controls">
                                <?php echo $this->Form->input('acc_change_content',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['acc_change_content']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                            <label class="control-label">Change Price ($)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('change_price_dlr',array('type'=>'text', 'label'=>false, 'value' => $RecordData['OverseasSales']['change_price_dlr'],'class'=>'form-control '));?>
                            </div>
                        </div>
                        
                        <div class="control-group col-md-3">
                            <label class="control-label">Change Price (&yen;)</label>
                            <div class="controls">
                                <?php echo $this->Form->input('change_price_yen',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['change_price_yen'],'class'=>"form-control"));?> 
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Invoice No.</label>
                            <div class="controls">
                                <?php echo $this->Form->input('change_invoice_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['change_invoice_no']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Invoice Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('change_invoice_day',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['change_invoice_day'],'class'=>'form-control '));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">BILL No.</label>
                        <div class="controls">
                        <?php echo $this->Form->input('change_bill_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['change_bill_no']));?>
                        </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">BILL No. (UK)</label>
                        <div class="controls">
                        
                        <?php echo $this->Form->input('change_bill_uk',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['change_bill_uk']));?>
                        </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">Rate (Accounts Receivable)</label>	
                        <div class="controls">
                        <?php echo $this->Form->input('change_rate_receivable',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['change_rate_receivable']));?>
                        </div>
                        </div>     
                        <div class="control-group col-md-3">
                        <label class="control-label">Rate (Advances Received)</label>	
                        <div class="controls">
                        <?php echo $this->Form->input('change_rate_advance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['change_rate_advance']));?>
                        </div>
                        </div>
                        
							<div class="control-group col-md-3">
								<label class="control-label">Slip Issuance Date</label>
								<div class="controls">
									<?php echo $this->Form->input('change_slip_date',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['change_slip_date'],'class'=>"form-control"));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('change_remark',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['change_remark']));?>
								</div>
							</div>
                         </div>
                         
                    <hr>
                    <h3>Customer Change</h3>
                    <hr>

					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Country</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_saales_cntry',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_saales_cntry']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Customer Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_customer_name',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_customer_name']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Sales Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_sales_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_sales_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Change Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_day']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Change Contents</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_content',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_content']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Invoice No.</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_invoice_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_invoice_no']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Invoice Day</label>
                            <div class="controls">
                                <?php echo $this->Form->input('cust_change_invoice_day',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_invoice_day'],'class'=>'form-control '));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">BILL No.</label>
                        <div class="controls">
                        <?php echo $this->Form->input('cust_change_bill_no',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_bill_no']));?>
                        </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">BILL No. (UK)</label>
                        <div class="controls">
                        
                        <?php echo $this->Form->input('cust_change_bill_uk',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_bill_uk']));?>
                        </div>
                        </div>
                        <div class="control-group col-md-3">
                        <label class="control-label">Rate (Accounts Receivable)</label>	
                        <div class="controls">
                        <?php echo $this->Form->input('cust_change_receivable',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_receivable']));?>
                        </div>
                        </div>     
                        <div class="control-group col-md-3">
                        <label class="control-label">Rate (Advances Received)</label>	
                        <div class="controls">
                        <?php echo $this->Form->input('cust_change_advance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_advance']));?>
                        </div>
                        </div>
                        
							<div class="control-group col-md-3">
								<label class="control-label">Slip Issuance Date</label>
								<div class="controls">
									<?php echo $this->Form->input('cust_change_slip',array('type'=>'text','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_slip'],'class'=>"form-control"));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('cust_change_remark',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['cust_change_remark']));?>
								</div>
							</div>
                         </div>
                         
                         
                    <div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Remittance Names</label>
                            <div class="controls">
                                <?php echo $this->Form->input('remittance_names',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['remittance_names']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Amount of Remittance</label>
                            <div class="controls">
                                <?php echo $this->Form->input('amount_remittance',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['amount_remittance']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Remittance Bank</label>
                            <div class="controls">
                                <?php echo $this->Form->input('remittance_bank',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['remittance_bank']));?>
                            </div>
                        </div>
                         </div>
                         
                         <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['OverseasSales']['final_last_remark']));?>
								</div>
							</div>
							</div>
                    
                    
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
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['OverseasSales']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>