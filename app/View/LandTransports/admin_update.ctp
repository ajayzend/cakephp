<div id="content1"> 
<!-- content starts --> 	
	<div class="row sortable">		
		<div class="box col-md-12">
			<div class="box-header well">
            	<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Land Transport Operations')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div>
			  

				
				<div class=" tab-pane active" id="about_content">

					<?php echo $this->Form->create('LandTransports', array('action'=>'admin_add','class'=>"car_package")); ?>
					<div class="row">
                        <div class="control-group col-md-3">
                            <label class="control-label">Auction Carry Out</label>
                            <div class="controls">
                                <?php echo $this->Form->input('auction_carry_out',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['auction_carry_out']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Yard => Auction</label>
                            <div class="controls">
                                <?php echo $this->Form->input('yard_auction',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['yard_auction']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3">
                            <label class="control-label">Yard => Yard</label>
                            <div class="controls">
                                <?php echo $this->Form->input('yard_yard',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['yard_yard']));?>
                            </div>
                        </div>
                        <div class="control-group col-md-3"> 
                                <label class="control-label">Requester</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('requester',array('type'=>'text', 'label'=>false,'class'=>'form-control ', 'value' => $RecordData['LandTransports']['requester']));?>
                                </div>
                            </div>
                            
							<div class="control-group col-md-3">
								<label class="control-label"> Auction Day</label>
								<div class="controls">
									<?php echo $this->Form->input('auction_day',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['LandTransports']['auction_day']));?> 
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Land Transportation Company</label>
								<div class="controls">
									<?php echo $this->Form->input('land_transportation_company',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['land_transportation_company']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Presence or Absence of A Reply</label>
								<div class="controls">
									<?php echo $this->Form->input('presence_absence_reply',array('type'=>'text','label'=>false,'class'=>'form-control ', 'value' => $RecordData['LandTransports']['presence_absence_reply']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Point of Departure</label>
								<div class="controls">
									<?php echo $this->Form->input('point_departure',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['point_departure']));?>
								</div>
							</div>
                            
                    <div class="control-group col-md-3">
                    <label class="control-label">Place of Arrival</label>
                    <div class="controls">
                    <?php echo $this->Form->input('place_arrival',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['place_arrival']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Land Transportation Day</label>
                    <div class="controls">
                    
                    <?php echo $this->Form->input('land_transportation_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['land_transportation_day']));?>
                    </div>
                    </div>
                    <div class="control-group col-md-3">
                    <label class="control-label">Land Transportation Price</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('land_transportation_price',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['land_transportation_price']));?>
                    </div>
                    </div>     
                    <div class="control-group col-md-3">
                    <label class="control-label">The Reason for Additional Charge</label>	
                    <div class="controls">
                    <?php echo $this->Form->input('reason_additional_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['reason_additional_charge']));?>
                    </div>
                    </div>
                    
							<div class="control-group col-md-3">
								<label class="control-label"> Additional Fee</label>
								<div class="controls">
									<?php echo $this->Form->input('additional_fee',array('type'=>'text','label'=>false,'class'=>"form-control", 'value' => $RecordData['LandTransports']['additional_fee']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Billing Date</label>
								<div class="controls">
									<?php echo $this->Form->input('billing_date',array('type'=>'text', 'class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['billing_date']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Remarks</label>
								<div class="controls">
									<?php echo $this->Form->input('remarks',array('type'=>'text','label'=>false,'class'=>'form-control', 'value' => $RecordData['LandTransports']['remarks']));?>
								</div>
							</div>
							<div class="control-group col-md-3">
								<label class="control-label">Inspection</label>
								<div class="controls">
									<?php echo $this->Form->input('inspection',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection']));?>
								</div>
							</div>
                            
							<div class="control-group col-md-3">
								<label class="control-label">The Presence or Absence of Inspection</label>
								<div class="controls">
									<?php echo $this->Form->input('presence_absence_inspection',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['presence_absence_inspection']));?>
								</div>
							</div>
							
                            
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Requester</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_requester',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_requester']));?>
                                </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Auction Day</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_auction_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_auction_day']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Land Transportation Company</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_land_transportation_company',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_land_transportation_company']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Presence or Absence of A Reply</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_presence_absence_reply',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_presence_absence_reply']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Point of Departure</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_point_departure',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_point_departure']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Place of Arrival</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_place_arrival',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_place_arrival']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Inspection Land Transportation Date</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_land_transportation_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_land_transportation_date']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Land Transportation Price</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_land_transportation_price',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_land_transportation_price']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">The Reason for Additional Charge</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_reason_additional_charge',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_reason_additional_charge']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Additional Fee</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_additional_fee',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_additional_fee']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Billing Date</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_billing_date',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_billing_date']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Remarks</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('inspection_remarks',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['inspection_remarks']));?>
                                </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Loading and Unloading</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('loading_unloading',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['loading_unloading']));?>
                                </div>
                            </div>
                            
                            <div class="control-group col-md-3">
                                <label class="control-label">Auction => yard</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('load_auction_yard',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['load_auction_yard']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Yard => Auction</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('load_yard_auction',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['load_yard_auction']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Yard => Yard</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('load_yard_yard',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['load_yard_yard']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Loading and Unloading Day</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('loading_unloading_day',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['loading_unloading_day']));?>
                                </div>
                            </div>
                            <div class="control-group col-md-3">
                                <label class="control-label">Remarks</label>
                                <div class="controls">
                                    <?php echo $this->Form->input('load_remarks',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['load_remarks']));?>
                                </div>
                            </div>
                            
                            

                         
						<div class="clearfix"></div>
					</div>
	</div>
    
    <div class="row">
							<div class="control-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark</label>
								<div class="controls">
									<?php echo $this->Form->input('final_last_remark',array('type'=>'text','class'=>'form-control ','label'=>false, 'value' => $RecordData['LandTransports']['final_last_remark']));?>
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
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$RecordData['LandTransports']['id']));?>
					<?php echo $this->Form->end(); ?>
				</div>  
			<div class="clearfix"></div>
		</div>
				</div>
			</div>
			</div>