<?php echo $this->Html->css('uploadfile');?>
<?php echo $this->Html->script('uploadfile');?>
<?php @$SaleData=$this->params->query['data'];?>
<?php $groupId = $this->Session->read('UserAuth.User.user_group_id');?>

<?php echo $this->Html->css('/js/datetimepicker/jquery.datetimepicker');?>
<?php echo $this->Html->script('/js/datetimepicker/jquery.datetimepicker');?>

<!--style>
.ui-datepicker-calendar {
    display: none;
    }
</style>-->
<div id="content1">
	<!-- content starts -->
	<div class="row sortable">
		<div class="box col-md-12">
			<div class="box-header well">
				<?php if($groupId == 2) {?>
					<a href="<?php echo $this->Html->url('/home/dashboard',true);?>"><button class=" btn btn-success pull-right" >Go Back</button></a>
				<?php } else { ?>
					<a href="<?php echo $this->Html->url('/admin/cars',true);?>"><button class=" btn btn-success pull-right" >Go Back</button></a>
				<?php } ?>
				<?php
				if(!empty($carDetails)){?>
					<h2><i class="fa fa-plus-circle"></i> <?php echo __('Edit Vehicle')?></h2>
				<?php }else{?>

					<h2><i class="fa fa-plus-circle"></i> <?php echo __('Add New Vehicle')?></h2>

				<?php }?>
				<div class="clearfix"></div>
			</div>
			<div>
				<div class="row">
					<div class="col-md-12">

						<ul class="nav nav-tabs admin_tab" id="myTab" >
							<li class="active" ><a href="#about_content" id="about" class="rounded_tab" data-toggle="tab" >Overview</a></li>

							<?php if($groupId == 2) {?>
								<?php if(!empty($carDetails)) {?>
									<li><a href="#image_upload" id="Image" class="rounded_tab" data-toggle="tab" >Upload Image</a></li>
									<li><a href="#additional_detail" id="additional" class="rounded_tab" data-toggle="tab" >Additional</a></li>
								<?php }?>
							<?php } else { ?>

								<?php
								if(!empty($carDetails)){?>
									<li><a href="#image_upload" id="Image" class="rounded_tab" data-toggle="tab" >Upload Image</a></li>
									<li><a href="#about_bids" id="Bid" class="rounded_tab" data-toggle="tab" >Bids</a></li>
									<?php if($carDetails['Car']['new_arrival'] == 0){?>

										<li><a href="#about_shipment" id="saleDetailId" class="rounded_tab " data-toggle="tab">Sales</a></li>
										<li><a href="#products_content" id="products" class="rounded_tab" data-toggle="tab" >Logistics</a></li>
										<li><a href="#additional_detail" id="additional" class="rounded_tab" data-toggle="tab" >Additional</a></li>

									<?php }else{
										echo '<li><a href="#about_bids" id="Bid" class="rounded_tab hide" data-toggle="tab" >Bids</a></li>';
										echo '<li><a href="#about_shipment" id="saleDetailId" class="rounded_tab hide" data-toggle="tab">Sales</a></li>';
										echo '<li><a href="#products_content" id="products" class="rounded_tab hide" data-toggle="tab" >Logistics</a></li>';
									} ?>

								<?php }else{?>
									<li><a href="#image_upload" id="Image" class="rounded_tab hide" data-toggle="tab" >Upload Image</a></li>
									<li><a href="#about_bids" id="Bid" class="rounded_tab hide" data-toggle="tab" >Bids</a></li>
									<li><a href="#about_shipment" id="saleDetailId" class="rounded_tab hide" data-toggle="tab">Sales</a></li>
									<li><a href="#products_content" id="products" class="rounded_tab hide" data-toggle="tab" >Logistics</a></li>
								<?php }?>
							<?php }?>
						</ul>
					</div>
				</div>

				<div id="my-tab-content" class="tab-content admin_content">
					<div class="col-md-12">
						<div id="messageDivIdAdd" style="display:none;" class="alert alert-success "></div>
						<!--<div id="messageDivIdAdd" >
                            </div>	-->
						<div id="errmessageDivIdAdd" style="display:none;" class="alert alert-danger"></div>
						<!--  <div id="errmessageDivIdAdd" class="red-text">
                          </div>	-->
						<!--  Started Firts Tab -->

					</div>
					<div class=" tab-pane active" id="about_content">
						<!--form-1 here-->
						<?php echo $this->Session->flash(); ?>
						<div class="myloader" id="loading2" style="display:none;">
							<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/>
						</div>
						<?php echo $this->Form->create('Car', array('action'=>'addnew_car','id'=>'overview','class'=>"car_package",'onsubmit'=>"return validateForm()")); ?>
						<div class="row">
							<h3>Vehicle Details</h3>
							<hr>

							<div class="addcar">
								<div class="form-group col-md-3">
									<label for="inputStock">Vehicle</label>

									<?php echo $this->Form->input('car_type_id',array('type'=>'select','options'=>$carType,'class'=>'input-xlarge','label'=>false,'data-rel'=>'chosen','value' =>@$carDetails['Car']['car_type_id'],'required'=>true,'onChange' => "checkType(this)")); ?>
								</div>

								<div class="form-group col-md-3">
									<label for="inputStock">Vehicle Type</label>
									<?php
									/*$type = array();
                                    if(@$carDetails['Car']['vehicle_type_id']==1)
                                    {
                                        //$type= "Bus Stork";
                                        $type = array('1'=>'Bus Stork','2'=>'Dump Stork','3'=>'Mixture Stock');
                                    }else if(@$carDetails['Car']['vehicle_type_id']==2)
                                    {
                                        //$type= "Dump Stork";
                                        $type = array('1'=>'Bus Stork','2'=>'Dump Stork','3'=>'Mixture Stock');
                                    }else if(@$carDetails['Car']['vehicle_type_id']==3)
                                    {
                                        $type = array('1'=>'Bus Stork','2'=>'Dump Stork','3'=>'Mixture Stock');
                                        //$type= "Mixture Stock";
                                    }*/

									if(@$carDetails['Car']['car_type_id'])
									{
										$this->CarType = ClassRegistry::init('CarType');
										$vehicleType = $this->CarType->find('list',array('fields'=>array('id','type'),'conditions'=>array('CarType.p_id'=>@$carDetails['Car']['car_type_id'])));

										echo $this->Form->input('vehicle_type_id',array('type'=>'select','options'=>$vehicleType,'id'=>'truck_type','class'=>'input-xlarge','label'=>false,'data-rel'=>'chosen','selected' =>@$carDetails['Car']['vehicle_type_id'],'required'=>true,'empty'=>'Select Type'));
									}else{
										?>
										<?php echo $this->Form->input('vehicle_type_id',array('type'=>'select','options'=>$vehicleType,'id'=>'truck_type','class'=>'input-xlarge','label'=>false,'data-rel'=>'chosen','selected' =>@$carDetails['Car']['vehicle_type_id'],'required'=>true,'empty'=>'Select Type')); } ?>
								</div>

								<?php
								if(@$carDetails['Car']['car_type_id'] == 2)
								{
									$style = "display:block";
								}
								else
								{
									$style = "display:none";
								}
								?>
								<div class="form-group col-md-3" id="engineNo" style=" <?php echo $style;?> " >

									<label for="inputChassis">Engine number</label>
									<div class="controls">
										<?php echo $this->Form->input('engine_number',array('type'=>'text','class'=>'form-control ','value'=>"",'label'=>false,'id'=>'engine_number','value'=>@$carDetails['Car']['engine_number'],'required'=>false));?>
									</div>
								</div>


								<?php if($groupId != 2){?>
									<div class="form-group col-md-3">
										<label for="inputLocation">Purchase Country</label>
										<?php
										$CountryDetail1= $CountryDetail;
										foreach($CountryDetail as $key=>$val){
											$arrayCon[]=array('value'=>$val['Country']['id'], 'name'=>$val['Country']['country_name']);
										}
										?>
										<?php echo $this->Form->input('purchase_country_id',array('type'=>'select','options'=>$arrayCon,'class'=>'form-control','label'=>false,'empty'=>'Select Country','data-rel'=>'chosen','id'=>'purchase_country_id','selected' =>@$carDetails['Car']['purchase_country_id'],'required'=>true)); ?>
									</div>
								<?php } ?>

							</div>


							<div class="addcar">
								<?php if($groupId != 2){?>
									<div class="form-group col-md-3">
										<label for="inputLocation"> Sale Country</label>
										<?php
										$CountryDetail1= $CountryDetail;
										foreach($CountryDetail as $key=>$val){
											$arr[]=array('value'=>$val['Country']['id'], 'name'=>$val['Country']['country_name'],
												'data-value'=>$val['Country']['rickshaw']."-". $val['Country']['freight']."-".$val['Country']['shipping']."-".$val['Country']['others']);
										}
										?>
										<?php echo $this->Form->input('country_id',array('type'=>'select','options'=>$arr,'class'=>'form-control','label'=>false,'empty'=>'Select Country','data-rel'=>'chosen','id'=>'Country_id','selected' =>@$carDetails['Car']['country_id'],'required'=>true)); ?>
									</div>
								<?php } ?>

								<div class="form-group col-md-3">
									<label for="inputStock">Brand</label>
									<?php echo $this->Form->input('brand_id',array('type'=>'select','options'=>$BrandDetail,'class'=>'input-xlarge','label'=>false,'empty'=>'Select Brand','data-rel'=>'chosen','selected' =>@$carDetails['Car']['brand_id'],'required'=>true)); ?>
								</div>

								<div class="form-group col-md-3">
									<label for="inputChassis">Vehicle Name</label>
									<?php echo $this->Form->input('car_name_id',array('type'=>'select','options'=>$Car,'class'=>'form-control','label'=>false,'empty'=>'Select Car','data-rel'=>'chosen','id'=>'Car_name_id','value'=>@$carDetails['Car']['car_name_id'])); ?>
								</div>

								<?php if($groupId == 2) {?>
										<!--<label for="inputDrive">UniqueId</label>-->
										<div class="controls">
											<input type="hidden" value="<?php echo (isset($carDetails['Car']['uniqueid'])? $carDetails['Car']['uniqueid']:'');?>" id="inputDrive" data-toggle="tooltip" title="<?php echo (isset($carDetails['Car']['uniqueid'])? $carDetails['Car']['uniqueid']:'');?>"  name="uniqueid" class="form-control" readonly='true' required="true">
										</div>
								<?php } else { ?>
									<div class="form-group col-md-3">
										<label for="inputDrive">UniqueId</label>
										<div class="controls">
											<input type="text" value="<?php echo (isset($carDetails['Car']['uniqueid'])? $carDetails['Car']['uniqueid']:'');?>" id="inputDrive" data-toggle="tooltip" title="<?php echo (isset($carDetails['Car']['uniqueid'])? $carDetails['Car']['uniqueid']:'');?>"  name="uniqueid" class="form-control" readonly='true' required="true">
										</div>
									</div>
								<?php } ?>

							</div>


							<div class="addcar">
								<div class="form-group col-md-3">
									<label for="inputChassis">Chassis No</label>
									<div class="controls">
										<?php echo $this->Form->input('cnumber',array('type'=>'text','class'=>'form-control ','value'=>@$carDetails['Car']['cnumber'],'label'=>false,'id'=>'chesis_id','required'=>true));?>
									</div>
								</div>

								<?php if($groupId == 2){
									$temp_lot_number = @$carDetails['Car']['lot_number'];
									$temp_lot_number_val  = ($temp_lot_number) ? $temp_lot_number : 0;
									?>
									<div class="controls">
										<?php echo $this->Form->input('lot_number',array('type'=>'hidden','class'=>'form-control ','value'=>$temp_lot_number_val,'label'=>false,'id'=>'lot_number_id','required'=>true));?>
									</div>
								<?php } else { ?>
									<div class="form-group col-md-3">
										<label for="inputChassis">Lot No</label>
										<div class="controls">
											<?php echo $this->Form->input('lot_number',array('type'=>'text','class'=>'form-control ','value'=>@$carDetails['Car']['lot_number'],'label'=>false,'id'=>'lot_number_id','required'=>true));?>
										</div>
									</div>

								<?php } ?>


								<div class="form-group col-md-3">
									<label for="inputTransmission">Transmission</label>
									<?php echo $this->Form->input('transmission',array('type'=>'select','options'=>array('Automatic'=>'Automatic','Manual'=>'Manual'),'empty'=>'Select Transmission','selected'=>@$carDetails['Car']['transmission'],'data-rel'=>'chosen','label'=>false,'default'=>'Automatic','required'=>true));?>
								</div>

								<div class="form-group col-md-3">
									<label for="inputDrive">Stock Id</label>
									<div class="controls">
										<input type="text" value="<?php echo (isset($carDetails['Car']['stock'])? $carDetails['Car']['stock']:'');?>" id="inputDrive" name="stock" class="form-control" readonly='true' required="true">
									</div>
								</div>
							</div>


							<div class="addcar">
								<div class="form-group col-md-3">
									<label for="inputHandle">Handle</label>
									<div class="controls">
										<select id="inputHandle " name="data[Car][handle]" value ="" data-rel="chosen" required="true">
											<?php if($carDetails['Car']['handle']){?>
												<option value="<?php echo @$carDetails['Car']['handle']; ?>"><?php echo @$carDetails['Car']['handle']; ?></option>
											<?php }?>
											<option value="RHD">RHD</option>
											<option value="LHD">LHD</option>
											<option value="NTD">NTD</option>
										</select>
									</div>
								</div>

								<div class="form-group col-md-3">
									<label for="inputFuel">Fuel</label>
									<div class="controls">
										<?php echo $this->Form->input('fuel',array('type'=>'select','options'=>array('Gasoline'=>'Gasoline','Diesel'=>'Diesel','Petrol'=>'Petrol','Cng'=>'Cng'),'id'=>'inputFuel','empty'=>'Select Fuel','selected'=>@$carDetails['Car']['fuel'],'data-rel'=>'chosen','label'=>false,'default'=>'Gasoline','required'=>true));?>
									</div>
								</div>

								<?php if($groupId == 2){ ?>
										<div class="controls">
											<?php
											if(isset($carDetails['Car']['pdate']))
											{
												$date = date('d-m-Y',strtotime(@$carDetails['Car']['pdate']));

											}else{
												$date = date('d-m-Y');
											}
											echo $this->Form->input('pdate',array('type'=>'hidden','class'=>'form-control ','value'=>$date,'label'=>false,'id'=>'datepicker','required'=>false ,'placeholder'=>"DD-MM-YYYY"));?>
										</div>
								<?php } else{ ?>
									<div class="form-group col-md-3">
										<label for="inputChassis">Purchase Date</label>
										<div class="controls">
											<?php
											if(isset($carDetails['Car']['pdate']))
											{
												$date = date('d-m-Y',strtotime(@$carDetails['Car']['pdate']));

											}else{
												$date = date('d-m-Y');
											}
											echo $this->Form->input('pdate',array('type'=>'text','class'=>'form-control ','value'=>$date,'label'=>false,'id'=>'datepicker','required'=>true ,'placeholder'=>"DD-MM-YYYY"));?>
										</div>
									</div>
								<?php }  ?>

								<div class="form-group col-md-3">
									<label for="inputAllStock">CC</label>
									<div class="controls">
										<?php echo $this->Form->input('cc',array('type'=>'text','class'=>'form-control ','value'=>@$carDetails['Car']['cc'],'label'=>false,'id'=>'datepicker','required'=>true,'empty' => FALSE));?>
									</div>
								</div>
							</div>


							<div class="addcar">
								<div class="form-group col-md-3">
									<label for="inputmileage">Mileage</label>
									<div class="controls">
										<?php echo $this->Form->input('mileage',array('type'=>'text','class'=>'form-control ','value'=>@$carDetails['Car']['mileage'],'label'=>false,'id'=>'datepicker','required'=>true));?>
									</div>
								</div>

								<div class="form-group col-md-3">
									<label for="inputChassis">Manufacture</label>
									<div class="controls">
										<?php
										echo $this->Form->input('manufacture_year',array('type'=>'text','class'=>'form-control','value'=>@$carDetails['Car']['manufacture_year'],'label'=>false,'id'=>'datepicker1','required'=>true ,'placeholder'=>"MM-YYYY"));?>
									</div>
								</div>

								<?php if($groupId != 2){?>
									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle">Auction</label>
										<div class="controls">

											<?php echo $this->Form->input('auction_id',array('type'=>'select','options'=>$arr1,'label'=>false,'data-rel'=>'chosen','empty'=>'Select Auction','onchange'=>'calculateFinalPrice();','id'=>'select_auction','value' =>@$carDetails['CarPayment']['auction_id']));?>
										</div>
									</div>

									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle">Transport Company</label>
										<?php
										if(!empty($carDetails))
										{

											$value = $carDetails['Logistic']['transport_id'];
										}else
										{

											//$value = $transportID;
											$value = '';

										}

										?>
										<div class="controls">
											<?php echo $this->Form->input('transport_id',array('type'=>'select','options'=>$transports,'class'=>'input-large','class'=>'form-control','id'=>'transports_id','data-rel'=>'chosen','empty'=>'Select Transports Company','value'=>@$value,'label'=>false));?>
										</div>
									</div>

									<div class="control-group col-md-3" id="PortdataId">
										<label class="control-label" for="inputbodystyle"> Port Name </label>
										<div class="controls">
											<?php echo

											$this->Form->input('port_id',array('type'=>'select','options'=>@$AuctionData,'name'=>"data[Car][port_id]",'id'=>'portData_id','data-value'=>@$carDetails['Logistic']['port_id'],'data-rel'=>'chosen','empty'=>'Select Port','selected'=>@$carDetails['Logistic']['port_id'],'div'=>false,'label'=>false));?>
										</div>
									</div>
								<?php } ?>
							</div>

							<div class="clearfix"></div>

							<div class="form-group col-md-12">
								<label for="inputChassis">Package</label>
								<div class="text_field">
									<?php echo $this->Form->input('package',array('type'=>'textarea','value'=>@$carDetails['Car']['package'], 'class'=>'form-control ','rows'=>"4" ,'cols'=>"50",'label'=>false,'required'=>true))?>
								</div>
							</div>

							<div class="clearfix"></div>

							<hr>
							<h3>Price Details</h3>
							<hr>

							<div class="dollar_exchange">
								<?php if($groupId == 2){
									$push_price = "Selling Price";
									$net_push_price = "Net Selling Price";
									$default_recycle = 20000;
								} else {
									$push_price = "Push Price";
									$net_push_price = "Net Push Price";
									$default_recycle = 0;
								 }?>

								<div class="controls">
									<?php echo $this->Form->input('Created_User_GroupID',array('type'=>'hidden','value'=>@$Created_User_GroupID,'label'=>false,'class'=>'form-control ','id'=>'Created_User_GroupID','required'=>false));?>
								</div>

								<div class="row">
									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle"><?php echo $push_price;?></label>
										<div class="controls">
											<?php echo $this->Form->input('push_price',array('type'=>'text','value'=>@$carDetails['CarPayment']['push_price'],'class'=>'form-control ','label'=>false,'id'=>'push_id','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
										</div>
									</div>

									<?php if($groupId == 2){
										$temp_recycle_price = @$carDetails['CarPayment']['recycle_price'];
										$temp_recycle_price_val  = ($temp_recycle_price) ? $temp_recycle_price : 20000;
										?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle">Recycle</label>
											<div class="controls">
												<?php echo $this->Form->input('recycle_price',array('type'=>'text','value'=>@$temp_recycle_price_val,'class'=>'form-control ','label'=>false,'id'=>'recycle_price','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>
									<?php } ?>

									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle">Tax (%)</label>
										<div class="controls">
											<?php echo $this->Form->input('tax',array('type'=>'text','class'=>'form-control ','value'=>@$tax_value,'label'=>false,'id'=>'tax_id','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
										</div>
									</div>
									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle"><?php echo $net_push_price;?></label>
										<div class="controls">
											<?php echo $this->Form->input('net_push',array('type'=>'text','class'=>'form-control ','label'=>false,'id'=>'net_push_id','onkeypress'=>"return allownumber(event)",'value'=>@$carDetails['CarPayment']['net_push'], 'onblur' => "calculateFinalPrice()"));?>
										</div>
									</div>


									<?php if($groupId == 2){
										$temp_auction_fee = @$carDetails['CarPayment']['auction_fee'];
										$temp_auction_fee_val  = ($temp_auction_fee) ? $temp_auction_fee : 0;
										?>
										<div class="controls">
											<?php echo $this->Form->input('auction_fee',array('type'=>'hidden','value'=>$temp_auction_fee_val,'label'=>false,'class'=>'form-control ','id'=>'main_select_fee','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
										</div>
									<?php } else { ?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle">Auction Fees </label>
											<div class="controls">
												<?php echo $this->Form->input('auction_fee',array('type'=>'text','value'=>@$carDetails['CarPayment']['auction_fee'],'label'=>false,'class'=>'form-control ','id'=>'main_select_fee','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>

									<?php } ?>

								</div>


								<div class="row">

									<?php if($groupId == 2){
										$temp_rickshaw = @$carDetails['CarPayment']['rickshaw'];
										$temp_rickshaw_val  = ($temp_rickshaw) ? $temp_rickshaw : 0;
										?>
										<div class="controls">
											<?php echo $this->Form->input('rickshaw',array('type'=>'hidden','value'=>$temp_rickshaw_val,'label'=>false,'class'=>'form-control ','id'=>'main_rickshaw_id','onkeypress'=>"return allownumber(event)",'required'=>false, 'onblur' => "calculateFinalPrice()"));?>
										</div>
									<?php } else { ?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle"> Rickshaw </label>
											<div class="controls">
												<?php echo $this->Form->input('rickshaw',array('type'=>'text','value'=>@$carDetails['CarPayment']['rickshaw'],'label'=>false,'class'=>"form-control",'id'=>'main_rickshaw_id','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>
									<?php } ?>


									<?php if($groupId == 2){
										$temp_shiping_fee = @$carDetails['CarPayment']['shiping_fee'];
										$temp_shiping_fee_val  = ($temp_shiping_fee) ? $temp_shiping_fee : 0;
										?>
										<div class="controls">
											<?php echo $this->Form->input('shiping_fee',array('type'=>'hidden','value'=>$temp_shiping_fee_val,'label'=>false,'class'=>'form-control ','id'=>'main_shipping_id','onkeypress'=>"return allownumber(event)",'required'=>false, 'onblur' => "calculateFinalPrice()"));?>
										</div>
									<?php } else { ?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle">Shipping</label>
											<div class="controls">
												<?php echo $this->Form->input('shiping_fee',array('type'=>'text','value'=>@$carDetails['CarPayment']['shiping_fee'],'class'=>'form-control ','label'=>false,'id'=>'main_shipping_id','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>
									<?php } ?>


									<?php if($groupId == 2){
										$temp_freight = @$carDetails['CarPayment']['freight'];
										$temp_freight_val  = ($temp_freight) ? $temp_freight : 0;
										?>
										<div class="controls">
											<?php echo $this->Form->input('freight',array('type'=>'hidden','value'=>$temp_freight_val,'label'=>false,'class'=>'form-control ','id'=>'main_freight_id','onkeypress'=>"return allownumber(event)",'required'=>false, 'onblur' => "calculateFinalPrice()"));?>
										</div>
									<?php } else { ?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle">Freight </label>
											<div class="controls">
												<?php echo $this->Form->input('freight',array('type'=>'text','value'=>@$carDetails['CarPayment']['freight'],'label'=>false,'class'=>'form-control ','id'=>'main_freight_id','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>
									<?php } ?>


									<?php if($groupId == 2){
										$temp_other = @$carDetails['CarPayment']['other'];
										$temp_other_val  = ($temp_other) ? $temp_other : 0;
										?>
										<div class="controls">
											<?php echo $this->Form->input('other',array('type'=>'hidden','value'=>$temp_other_val,'class'=>'form-control ','label'=>false,'id'=>'mail_Others_id','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
										</div>
									<?php } else { ?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle">Others</label>
											<div class="controls">
												<?php echo $this->Form->input('other',array('type'=>'text','value'=>@$carDetails['CarPayment']['other'],'class'=>'form-control ','label'=>false,'id'=>'mail_Others_id','onkeypress'=>"return allownumber(event)",'required'=>true, 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>
									<?php } ?>


									<div class="row">
										<?php if($groupId != 2){?>
										<div class="control-group col-md-3">
											<label class="control-label" for="inputbodystyle">RECYCLE</label>
											<div class="controls">
												<?php echo $this->Form->input('recycle_price',array('type'=>'text','value'=>@$carDetails['CarPayment']['recycle_price'],'class'=>'form-control ','label'=>false,'id'=>'recycle_price','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
											</div>
										</div>
										<?php } ?>


										<?php if($groupId == 2){
											$temp_minimum_price_doller = @$carDetails['CarPayment']['minimum_price_doller'];
											$temp_minimum_price_doller_val  = ($temp_minimum_price_doller) ? $temp_minimum_price_doller : 0;
											?>
											<div class="controls">
												<?php echo $this->Form->input('minimum_price_doller',array('type'=>'hidden','value'=>$temp_minimum_price_doller_val,'class'=>'form-control ','label'=>false,'id'=>'minimum_price_doller','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
											</div>
										<?php } else { ?>
											<div class="control-group col-md-3 testing_text1">
												<label class="control-label" for="inputbodystyle">Set Minimum Price</label>
												<div class="controls">

													<?php echo $this->Form->input('minimum_price_doller',array('type'=>'text','value'=>@$carDetails['CarPayment']['minimum_price_doller'],'class'=>'form-control ','label'=>false,'id'=>'minimum_price_doller','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
												</div>
											</div>
										<?php } ?>


										<?php if($groupId == 2){
											$temp_minimum_price_yen = @$carDetails['CarPayment']['minimum_price_yen'];
											$temp_minimum_price_yen_val  = ($temp_minimum_price_yen) ? $temp_minimum_price_yen : 0;
											?>
											<div class="controls">
												<?php echo $this->Form->input('minimum_price_yen',array('type'=>'hidden','value'=>$temp_minimum_price_yen_val,'class'=>'form-control ','label'=>false,'id'=>'minimum_price_yen','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
											</div>
										<?php } else { ?>
											<div class="control-group col-md-3 testing_text2">
												<label class="control-label" for="inputbodystyle">&nbsp;</label>
												<div class="controls">
													<?php echo $this->Form->input('minimum_price_yen',array('type'=>'text','value'=>@$carDetails['CarPayment']['minimum_price_yen'],'class'=>'form-control ','label'=>false,'id'=>'minimum_price_yen','onkeypress'=>"return allownumber(event)", 'onblur' => "calculateFinalPrice()"));?>
												</div>
											</div>
										<?php } ?>

									</div>

								</div>
								<div class="clearfix"></div>
								<div class="col-md-12 dollar_exchange_check">
									<h4>Dollar Exchange </h4>
								</div>
								<?//php echo $this->Form->create('car',array('action' =>'addnew_car','id'=>'calculate_id'));?>
								<div class="row">

									<div class="control-group col-md-3">
										<!--abel class="control-label" for="inputbodystyle">Exchange Rate</label--><label onclick="get_jpy_price();" style="cursor:pointer;color:#ff0000;">Live Dollar to Yen price</label>
										<div class="controls">
											<?php echo $this->Form->input('exchange',array('type'=>'text','value'=>'','label'=>false,'class'=>'form-control ','id'=>'main_exchange_id','onkeypress'=>"return allownumber(event)",'required'=>true));?>
										</div>
									</div>

									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle"> Yen Amount</label>
										<div class="controls">
											<?php echo $this->Form->input('yen',array('type'=>'text','label'=>false,'class'=>'form-control ','id'=>'main_yenamount_id','onkeypress'=>"return allownumber(event)",'value' =>@$carDetails['CarPayment']['yen'],'required'=>true));?>
										</div>
									</div>

									<div class="control-group col-md-3">
										<label class="control-label" for="inputbodystyle">Car Price ($)</label>
										<div class="controls">
											<?php echo $this->Form->input('asking_price',array('type'=>'text','value'=>@$carDetails['CarPayment']['asking_price'],'class'=>'form-control ','label'=>false,'id'=>'car_price_id','onkeypress'=>"return allownumber(event)",'required'=>true));?>
										</div>
									</div>

									<div class="control-group col-md-3 margin-top_c">
										<label class="control-label" for="inputbodystyle">&nbsp;</label>
										<?php echo $this->Form->submit('Calculate Price',array('type'=>'button','class'=>'btn btn-primary pull-right calculate-price','label'=>false,'div'=>false,'id'=>'btn_calc','required'=>true));?>
									</div>

								</div>


								<div class="clearfix"></div>


								<div class="row">
									<div class="pull-left col-md-6 arrivals_new">

										<?php  $selected = ((@$carDetails['Car']['new_arrival']=="1") ? "checked" : "");?>
										<!--<input type="checkbox" name="data[Car][new_arrival]" value="" <?//php echo $selected; ?> id="newArrivalid">-->
										<?php echo $this->Form->input('new_arrival',array('type'=>'checkbox','checked'=>@$carDetails['Car']['new_arrival'],'label'=>false,'div'=>false,'id'=>'newArrivalid','class'=>'pull-left'));?><label class="pull-left" style="margin-right:5px;">New Arrival</label>




										<div class="clearfix"></div>

										<?php echo $this->Form->input('recommended',array('type'=>'checkbox','checked'=>@$carDetails['Car']['recommended'],'label'=>false,'div'=>false,'id'=>'newArrivalid','class'=>'pull-left'));?><label class="pull-left" style="margin-right:5px;">Recommended</label>



										<div class="clearfix"></div>

										<?php  $selected = ((@$carDetails['Car']['isrecent']=="1") ? "checked" : "");?>

										<?php echo $this->Form->input('isrecent',array('type'=>'checkbox','checked'=>@$carDetails['Car']['isrecent'],'label'=>false,'div'=>false,'id'=>'isRecentid','class'=>'pull-left'));?><label class="pull-left" style="margin-right:5px;">check to hide from recent</label>


										<div id='for_new_arrival' style="display:none" > <?php echo $this->Form->input('new_arrival_date',array('type'=>'text','class'=>'form-control ','value'=>@$carDetails['Car']['new_arrival_date'],'label'=>false,'id'=>'new_arrival_datepicker')); ?></div>

									</div>

								</div>
								<!--  checked  box here  -->

								<!--end checked box here-->
							</div>
						</div>
						<!-- form-1-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group col-md-6">
									<div class="controls">
										<?//php echo $this->Form->input('menu',array('type'=>'hidden','value'=>'1')); ?>
										<?php echo $this->Form->input('tab_id',array('type'=>'hidden','id'=>'tab1')); ?>
										<input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">

										<?php if($groupId == 2) {?>
											<?php if(@$carDetails['Car']['publish'] == 1 || $car_id == '') {?>
												<button type="submit" class="btn btn-primary" id="submit">Save</button>
											<?php } ?>
											<a  class="btn btn-danger" href="<?php echo $this->Html->url('/home/dashboard',true);?>">Cancel</a>
										<?php } else {?>
											<button type="submit" class="btn btn-primary" id="submit">Save</button>
											<a  class="btn btn-danger" href="<?php echo $this->Html->url('/admin/cars',true);?>">Cancel</a>
										<?php }?>
									</div>

								</div>
							</div>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
					<!--  end Firts Tab -->

					<!--  started image upload -->
					<?php if($groupId == 2) {?>
						<div class="tab-pane" id ="image_upload">
							<div class="row">
								<div class="control-group col-md-12">
									<!--<h4>Upload Images</h4>-->
									<?//php pr($cardetail); die;?>
									<div id="messageDivForImage" style="display:none;" class="alert alert-success "></div>
									<?php echo $this->Form->create('Cars',array('action' =>'addnew_car','id'=>'imgload'));?>
									<label id="img_msg_div" class="control-label" for="inputmileage">Please Click below button for upload the images</label>

									<div class="Upload_imagearea" id="Upload_imagearea">
										<ul id="uploadDivLUl">
											<?php
											//pr($carDetails);
											if(isset($carDetails['CarImage'])){
												foreach($carDetails['CarImage'] as $val):?>
													<?php if(@$carDetails['Car']['publish'] == 0 ) {?>
														<li data-image="<?php echo $val['image_source'];?>" class="add_imgnew">
															<img src="<?php echo $this->webroot.$val['image_source'];?>">
														</li>
													<?php } else {?>
														<li data-image="<?php echo $val['image_source'];?>" class="add_imgnew">
															<a href="javascript:void(0)"
															   onclick="removeTempImage('<?php echo $val['image_source'];?>');" >
																<i  class="fa fa-times pull-right"></i></a>
															<img src="<?php echo $this->webroot.$val['image_source'];?>">
														</li>
													<?php } ?>
												<?php endforeach; }?>
										</ul>
										<br/><br/>
										<div class="clearfix"></div>
										<?php if(@$carDetails['Car']['publish'] == 1 ) {?>
											<div class="submit align_btn" style="margin-top:0px;margin-right:10px;">
												<a id="add_file" class="btn btn-primary" href="javascript:void(0);"><?php echo __('Upload Image');?></a>
											</div>
											<input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">
											<?php echo $this->Form->input('tab_id',array('type'=>'hidden','id'=>'tab2')); ?>
											<?php echo $this->Form->submit('Save',array('type'=>'button','id' =>'saveimg','class'=>'btn btn-primary save_cars')); ?>
										<?php }?>
										<div class="submit align_btn" style="margin-top:0px;"> <!-- Clearfix -->
											<a  class="btn btn-danger" href="<?php echo $this->Html->url('/home/dashboard',true);?>">Cancel</a>
											<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="User_send-email">Send Image</button>

										</div>

									</div>
									<?php echo $this->Form->end(); ?>

									<?php

									if(!empty($carDetails['CarImage']))
									{
										$style = "display:block";
									}else
									{
										$style = "display:none";
									}

									?>
									<?php if(isset($car_id) && @$carDetails['Car']['publish'] == 1){ ?>

										<button class="btn btn-primary dltone" id="deleteCar" style=<?php echo $style; ?> onclick="checkDelete('<?php echo (isset($car_id)? $car_id:'0');?>')">Delete All</button>
									<?php }?>
								</div>
							</div>
						</div>
					<?php } else {?>
						<div class="tab-pane" id ="image_upload">
							<div class="row">
								<div class="control-group col-md-12">
									<!--<h4>Upload Images</h4>-->
									<?//php pr($cardetail); die;?>
									<div id="messageDivForImage" style="display:none;" class="alert alert-success "></div>
									<?php echo $this->Form->create('Cars',array('action' =>'addnew_car','id'=>'imgload'));?>
									<label id="img_msg_div" class="control-label" for="inputmileage">Please Click below button for upload the images</label>

									<div class="Upload_imagearea" id="Upload_imagearea">
										<ul id="uploadDivLUl">
											<?php
											//pr($carDetails);
											if(isset($carDetails['CarImage'])){
												foreach($carDetails['CarImage'] as $val):?>
													<li data-image="<?php echo $val['image_source'];?>" class="add_imgnew"><a href="javascript:void(0)" onclick="removeTempImage('<?php echo $val['image_source'];?>');" ><i  class="fa fa-times pull-right"></i></a><img src="<?php echo $this->webroot.$val['image_source'];?>"></img>
														</i></li>
												<?php endforeach; }?>
										</ul>
										<br/><br/>
										<div class="clearfix"></div>
										<div class="submit align_btn" style="margin-top:0px;margin-right:10px;">
											<a id="add_file" class="btn btn-primary" href="javascript:void(0);"><?php echo __('Upload Image');?></a>
										</div>
										<input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">
										<?php echo $this->Form->input('tab_id',array('type'=>'hidden','id'=>'tab2')); ?>
										<?php echo $this->Form->submit('Save',array('type'=>'button','id' =>'saveimg','class'=>'btn btn-primary save_cars')); ?>
										<div class="submit align_btn" style="margin-top:0px;"> <!-- Clearfix -->
											<a  class="btn btn-danger" href="<?php echo $this->Html->url('/admin/cars',true);?>">Cancel</a>
											<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="User_send-email">Send Image</button>

										</div>

									</div>
									<?php echo $this->Form->end(); ?>

									<?php

									if(!empty($carDetails['CarImage']))
									{
										$style = "display:block";
									}else
									{
										$style = "display:none";
									}

									?>
									<?php if(isset($car_id)){ ?>

										<button class="btn btn-primary dltone" id="deleteCar" style=<?php echo $style; ?> onclick="checkDelete('<?php echo (isset($car_id)? $car_id:'0');?>')">Delete All</button>
									<?php }?>
								</div>
							</div>
						</div>
					<?php } ?>

					<!--  end image upload -->
					<!--bid details form-->
					<div class="tab-pane" id="about_bids">
						<?php if(!empty($BidData)){?>
							<div style="clear:both;"></div>
							<table border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
								<thead>

								<tr class="colr_body">

									<td>Date</td>
									<td>Client</td>
									<td>Bit Value</td>
									<td >Actions</td>

								</tr>
								</thead>

								<tbody id="searchdata">

								<?php
								foreach($BidData as $val){ if($val['User']['id']==NULL){echo '<tr>
										<td colspan="4" style="text-align:center"> Result Not Found</td>
									</tr>';}else {

									?>

									<tr class="colr_bodys">
										<?php echo '
						<td>'.date("d-m-Y", strtotime($val['Bid']['date'])).'</td>
						<td>'.$val['User']['first_name'].' '.$val['User']['last_name'].'</td>
						<td>'.$val['Bid']['amount'];?></td><td style="width:10%;">

											<a class="btn btn-primary hint--bottom abc" value="Sale" data-id='<?php echo $val['Bid']['user_id'].'-'.$val['Bid']['amount'];?>' id="SaleTabOpenId" data-hint="Sale"> <i class="fa fa-globe"></i></a></td></tr>

								<?php }} ;?>


								</tbody>

							</table>
						<?php }else{
							echo '<h3>There is no bid for this car !</h3> ';

						}
						;?>
					</div>
					<!--    end bid form-->
					<!--shipment details form-->
					<div class=" tab-pane " id="about_shipment">
						<?php echo $this->Form->create('Car',array('action' =>'addnew_car','id'=>'sales_tab'));?>
						<div class="row">
							<div class="control-group col-md-4">
								<label class="control-label" for="inputbodystyle">Sale Client</label>
								<div class="controls">
									<?php echo $this->Form->input('user_id',array('type' => 'select','options'=>$user,'value'=>@$carDetails['CarPayment']['user_id'],'label'=>false,'div'=>false,'class'=>'input-xlarge','data-rel'=>'chosen','id'=>'select_client','empty'=>'No  Sale','required'=>true));?>
								</div>
							</div>


							<div class="control-group col-md-2">
								<label class="col-md-2" for="exampleInputPassword1">Currency</label>
								<?php
								$arr=array('$'=>'$','￥'=>'￥');
								echo $this->Form->input('moneyType',array('type'=>'select','options'=>$arr,'class'=>'form-control','selected'=>@$carDetails['CarPayment']['currency'],'label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'monyType'));
								?>
							</div>

							<div class="control-group col-md-6">
								<label class="control-label" for="inputbodystyle">Sale Price</label>
								<div class="controls  ">
									<?php echo $this->Form->input('sale_price',array('type'=>'text','id'=>'psale_price_id','value'=>@$carDetails['CarPayment']['sale_price'],'label'=>false,'div'=>false,'required'=>true,'class'=>'form-control'));?>
									<span id='yenmsg'></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="pull-left col-md-5 arrivals_new">
									<label class="pull-left">Check to Enable sale price edit for User</label>

									<?php
									echo $this->Form->input('price_editable',array('type'=>'checkbox','checked'=>@$carDetails['Car']['price_editable'],'label'=>false,'div'=>false,'id'=>'price_editable'));?>

								</div>
								<input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">
								<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'btn btn-primary','id'=>'send_sales'));?>
								<div class="submit"><a  class="btn btn-danger" href="<?php echo $this->Html->url('/admin/cars',true);?>">Cancel</a></div>


								<?php echo $this->Form->end();?>
								<?php if(!empty($carDetails['CarPayment']['sale_price'])){
									$this->InvoiceDetail = ClassRegistry::init('InvoiceDetail');
									$generatedResult = $this->InvoiceDetail->find('first', array('conditions' => array('InvoiceDetail.car_id' =>$carDetails['Car']['id'])));

									if(!empty($generatedResult))
									{

										?>
										<div class="submit">
											<span class="btn btn-warning">Already Generated</span>
										</div>
									<?php } else{?>
										<div class="submit">
											<?php echo $this->Html->link('Create Invoice', array('controller' => 'Invoices', 'action' => 'add','user_id' => $carDetails['CarPayment']['user_id'],'date' =>$carDetails['Car']['pdate'],'car_id' =>$carDetails['Car']['id']),array('class'=>'btn btn-success','id'=>'createInvoiceId'));?>

										</div>
									<?php }}else{?>
									<div class="submit" id="InvoiceDataId">

									</div>

								<?php }?>
							</div>
						</div>
					</div>
					<!--    end sale form-->
					<!--      start new shipment form  -->
					<div class=" tab-pane" id="products_content">
						<?php  echo $this->Form->create('Car',array('action' =>'addnew_car','id'=>'logistics_details')); ?>
						<div class="col-md-6">
							<div class="form-group col-md-6">
								<?php $option=array('On the way'=>'On the way','Shipped'=>'Shipped','Cancel'=>'Cancel','Stopped'=>'Stopped','Isogi'=>'Isogi','Radiation'=>'Radiation');?>
								<label class="control-label" for="inputbodystyle"> Car In </label>
								<?php echo $this->Form->input('car_in',array('type'=>'text','id'=>'datepickerSecond','formate'=>'dd-mm-yyyy','value'=>@$carDetails['Logistic']['car_in'],'class'=>'form-control','required'=>true,'div'=>false,'label'=>false));?>
							</div>
							<div class="form-group col-md-6">
								<label for="inputChassis">Yard Name</label>
								<div class="controls">
									<?php echo $this->Form->input('yard_name',array('type'=>'select','options'=>array('1'=>'Yard1','2'=>'Yard2','3'=>'Yard3'),'id'=>'yardId','empty'=>'Select Yard','selected'=>@$carDetails['Logistic']['yard_name'],'data-rel'=>'chosen','label'=>false,'required'=>true));?>
								</div>
							</div>

							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle">Shipping Company</label>
								<?php echo $this->Form->input('shipping_id',array('type'=>'select','options'=>$shippedData,'class'=>'input-large','class'=>'form-control','id'=>'shipping_country_id','data-rel'=>'chosen','empty'=>'Select Shipping Company','value'=>@$carDetails['Logistic']['shipping_id'],'label'=>false));?>
							</div>

							<!--<div class="form-group col-md-6">
							<label class="control-label" for="inputbodystyle">Transport Company</label>
							<?php
							/*if(!empty($carDetails))
							{

								$value = $carDetails['Logistic']['transport_id'];
							}else
							{

								$value = $transportID;

							} 	*/

							?>
							<?php //echo $this->Form->input('transport_id',array('type'=>'select','options'=>$transports,'class'=>'input-large','class'=>'form-control','id'=>'transports_id','data-rel'=>'chosen','empty'=>'Select Transports Company','value'=>@$value,'label'=>false));?>
						</div>-->


							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle">Shipping Port</label>
								<?php echo $this->Form->input('ship_port',array('type'=>'select','options'=>$PortData,'class'=>'input-large','class'=>'form-control','id'=>'ship_port','data-rel'=>'chosen','empty'=>'Select Shipping Port Name','value'=>@$carDetails['Logistic']['ship_port'],'label'=>false));?>
							</div>



						</div>
						<div class="col-md-6">
							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle"> Car Out </label>
								<?php echo $this->Form->input('car_out',array('type'=>'text','id'=>'datepickerThird','value'=>@$carDetails['Logistic']['car_out'],'required'=>true,'div'=>false,'label'=>false,'class'=>'form-control'));?>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle"> Car Status </label>
								<?php echo $this->Form->input('status',array('type'=>'select','options'=>$option,'id'=>'datepickerThird','data-rel'=>'chosen','empty'=>'Select Status','value'=>@$carDetails['Logistic']['status'],'div'=>false,'label'=>false));?>
							</div>
							<!--<div class="form-group col-md-6" id="PortdataId">
							<label class="control-label" for="inputbodystyle"> Port Name </label>
							<?php //echo $this->Form->input('port_id',array('type'=>'select','options'=>@$AuctionData,'name'=>"data[Car][port_id]",'id'=>'portData_id','data-rel'=>'chosen','empty'=>'Select Port','selected'=>@$carDetails['Logistic']['port_id'],'div'=>false,'label'=>false));?>
						</div>-->
							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle">DOCUMENT given DATE</label>
								<?php
								$curDate = date('d-m-Y');
								if(isset($carDetails['Logistic']['created']) && empty($carDetails['Logistic']['created']))
								{
									$shipDate=  '';
								}
								elseif(!empty($carDetails['Logistic']['created']))
								{
									$str = $carDetails['Logistic']['created'];
									if (substr_count($str, '-') > 0)
									{
										$shipDate = $carDetails['Logistic']['created'];
									}
									else
									{
										$shipDate=  '';
									}
								}
								else
								{
									$shipDate=  '';
								}
								echo $this->Form->input('created',array('type'=>'text','id'=>'datepickerfourth' ,'value'=>$shipDate,'div'=>false,'label'=>false,'class'=>'form-control'));?>
							</div>

							<div class="form-group col-md-6">



								<label class="control-label" for="inputbodystyle"> Destination Port </label>

								<?php echo $this->Form->input('destination_port',array('type'=>'text','id'=>'destination_port','value'=>@$carDetails['Logistic']['destination_port'],'div'=>false,'label'=>false,'class'=> 'form-control'));?>
							</div>
						</div>

						<!--   New add div for shipping port   -->

						<div class="col-md-6">
							<div class="form-group col-md-6">



								<label class="control-label" for="inputbodystyle"> Departure Date </label>


								<?php echo $this->Form->input('departure_date',array('type'=>'text','id'=>'departure_date','formate'=>'dd-mm-yyyy','value'=>@$carDetails['Logistic']['departure_date'],'class'=>'form-control','required'=>true,'div'=>false,'label'=>false));?>


								<?php //echo $this->Form->input('departure_date',array('type'=>'text','id'=>'departure_date','value'=>@carDetails['logistic']['departure_date'] ,'div'=>false,'label'=>false,'class'=>'.datepicker form-control'));


								//print_r($carDetails);?>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle"> Arrival Date </label>
								<?php echo $this->Form->input('arrival_date',array('type'=>'text','id'=>'arrival_date','formate'=>'dd-mm-yyyy','value'=>@$carDetails['Logistic']['arrival_date'] ,'div'=>false,'label'=>false,'class'=>'.datepicker form-control'));?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group col-md-6">
								<label class="control-label" for="inputbodystyle">Port Remark</label>
								<?php echo $this->Form->input('port_remark',array('type'=>'text','id'=>'port_remark','value'=>@$carDetails['Logistic']['port_remark'] ,'div'=>false,'label'=>false,'class'=> 'form-control'));?>
							</div>
						</div>


						<!--   end new div   -->
						<div class="col-md-12">
							<div class="form-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark </label>
								<?php echo $this->Form->input('remark',array('type'=>'textarea','id'=>'remarkArea_id','value'=>@$carDetails['Logistic']['remark'],'required'=>true,'class'=>'form-control','div'=>false,'label'=>false));?>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group col-md-12">
								<input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">
								<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'btn btn-primary','id'=>'logistic_car'));?>
								<div class="submit">
									<a  class="btn btn-danger" href="<?php echo $this->Html->url('/admin/cars',true);?>">Cancel</a>
								</div>
							</div>
						</div>
						<?php echo $this->Form->end();?>
					</div>

					<!-- Shipping Schedule -->

					<!-- code by lalit start -->
					<div class=" tab-pane" id="additional_detail">
						<?php  echo $this->Form->create('Car',array('action' =>'addnew_car','id'=>'additional_detail_form')); ?>
						<!--<div class="form-group col-md-3">
							<label for="inputChassis">TRANSMISSION</label>
							<div class="controls">
								<?php /*echo $this->Form->input('transmission',array('type'=>'select','options'=>array('1'=>'AT','2'=>'MANUAL'),'id'=>'transmissionId','empty'=>'Select Transmission','selected'=>@$carDetails['Car']['transmission'],'data-rel'=>'chosen','label'=>false,'required'=>false));*/?>
							</div>
						</div>-->



						<div class="form-group col-md-3">
							<label for="inputChassis">POWER STEERING</label>
							<div class="controls">
								<?php echo $this->Form->input('power_steering',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'power_steeringId','empty'=>'Select STEERING','selected'=>@$carDetails['Car']['power_steering'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">AIR CONDITION</label>
							<div class="controls">
								<?php echo $this->Form->input('air_condition',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'air_conditionId','empty'=>'Select AIR CONDITION','selected'=>@$carDetails['Car']['air_condition'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">ALLOY WHEEL</label>
							<div class="controls">
								<?php echo $this->Form->input('alloy_wheel',array('type'=>'select','options'=>array('COMPANY FIT'=>'COMPANY FIT','NOT COMPANY'=>'NOT COMPANY'),'id'=>'alloy_wheelId','empty'=>'Select ALLOY WHEEL','selected'=>@$carDetails['Car']['alloy_wheel'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">INTERIOR COLOR</label>
							<div class="controls">
								<?php echo $this->Form->input('interior_color',array('type'=>'select','options'=>array('DARK'=>'DARK','LIGHT'=>'LIGHT'),'id'=>'interior_colorId','empty'=>'Select INTERIOR COLOR','selected'=>@$carDetails['Car']['interior_color'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">TV</label>
							<div class="controls">
								<?php echo $this->Form->input('tv',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'tvId','empty'=>'Select TV','selected'=>@$carDetails['Car']['tv'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">KEYLESS ENTRY</label>
							<div class="controls">
								<?php echo $this->Form->input('keyless_entry',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'keyless_entryId','empty'=>'Select KEYLESS ENTRY','selected'=>@$carDetails['Car']['keyless_entry'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">AERO KIT</label>
							<div class="controls">
								<?php echo $this->Form->input('aero_kit',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'aero_kitId','empty'=>'Select AERO KIT','selected'=>@$carDetails['Car']['aero_kit'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>


						<div class="form-group col-md-3">
							<label for="inputChassis">REAR PARKING CAMERA</label>
							<div class="controls">
								<?php echo $this->Form->input('rear_parking_camera',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'rear_parking_cameraId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['rear_parking_camera'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">POWER DOOR</label>
							<div class="controls">
								<?php echo $this->Form->input('power_door',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'power_doorId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['power_door'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">SEAT HEATER</label>
							<div class="controls">
								<?php echo $this->Form->input('seat_heater',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'seat_heaterId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['seat_heater'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">SPARE KEY</label>
							<div class="controls">
								<?php echo $this->Form->input('spare_key',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'spare_keyId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['spare_key'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">ROOF RAILS</label>
							<div class="controls">
								<?php echo $this->Form->input('roof_rails',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'roof_railsId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['roof_rails'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">PARKING SENSOR</label>
							<div class="controls">
								<?php echo $this->Form->input('parking_sensor',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'parking_sensorId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['parking_sensor'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">POWER WINDOW</label>
							<div class="controls">
								<?php echo $this->Form->input('power_window',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'power_windowId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['power_window'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">POWER SEATS</label>
							<div class="controls">
								<?php echo $this->Form->input('power_seats',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'power_seatsId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['power_seats'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<!--<div class="form-group col-md-3">
							<label for="inputChassis">DRIVE</label>
							<div class="controls">
								<?php /*echo $this->Form->input('drive',array('type'=>'select','options'=>array('1'=>'4WD','2'=>'2WD'),'id'=>'driveId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['drive'],'data-rel'=>'chosen','label'=>false,'required'=>false));*/?>
							</div>
						</div>-->

						<div class="form-group col-md-3">
							<label for="inputChassis">MAINTENANCE RECORD</label>
							<div class="controls">
								<?php echo $this->Form->input('maintenance_record',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'maintenance_recordId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['maintenance_record'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">ABS(ANTI BREAK SYSTEM)</label>
							<div class="controls">
								<?php echo $this->Form->input('anti_break_system',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'anti_break_systemId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['anti_break_system'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">AIRBAGS</label>
							<div class="controls">
								<?php echo $this->Form->input('airbags',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'airbagsId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['airbags'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">NAVIGATION</label>
							<div class="controls">
								<?php echo $this->Form->input('navigation',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'navigationId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['navigation'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">CD PLAYER</label>
							<div class="controls">
								<?php echo $this->Form->input('cd_player',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'cd_playerId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['cd_player'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">SLIDING DOOR</label>
							<div class="controls">
								<?php echo $this->Form->input('sliding_door',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'sliding_doorId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['sliding_door'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">SMART KEY SYSTEM</label>
							<div class="controls">
								<?php echo $this->Form->input('smart_key_system',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'smart_key_systemId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['smart_key_system'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">AUTOMATIC DOOR</label>
							<div class="controls">
								<?php echo $this->Form->input('automatic_door',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'automatic_doorId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['automatic_door'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">LOW DOWN</label>
							<div class="controls">
								<?php echo $this->Form->input('low_down',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'low_downId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['low_down'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">BODY KIT</label>
							<div class="controls">
								<?php echo $this->Form->input('body_kit',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'body_kitId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['body_kit'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">REAR SPOILER</label>
							<div class="controls">
								<?php echo $this->Form->input('rear_spoiler',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'rear_spoilerId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['rear_spoiler'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">WIND BREAKER</label>
							<div class="controls">
								<?php echo $this->Form->input('wind_breaker',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'wind_breakerId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['wind_breaker'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>




						<!--<div class="form-group col-md-3">
							<label for="inputChassis">FUEL</label>
							<div class="controls">
								<?php /*echo $this->Form->input('fuel',array('type'=>'select','options'=>array('1'=>'H','2'=>'G','3'=>'D','4'=>'E'),'id'=>'fuelId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['fuel'],'data-rel'=>'chosen','label'=>false,'required'=>false));*/?>
							</div>
						</div>-->

						<div class="form-group col-md-3">
							<label for="inputChassis">NO SMOKING</label>
							<div class="controls">
								<?php echo $this->Form->input('no_smoking',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'no_smokingId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['no_smoking'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">ONE OWNER</label>
							<div class="controls">
								<?php echo $this->Form->input('one_owner',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'one_ownerId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['one_owner'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">ATS(ANTI THEFT SYSTEM)</label>
							<div class="controls">
								<?php echo $this->Form->input('anti_theft_system',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'anti_theft_systemId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['anti_theft_system'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">LEATHER SEATS</label>
							<div class="controls">
								<?php echo $this->Form->input('leather_seats',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'leather_seatsId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['leather_seats'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">LIGHT</label>
							<div class="controls">
								<?php echo $this->Form->input('light',array('type'=>'select','options'=>array('HID'=>'HID','XYNON'=>'XYNON'),'id'=>'lightId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['light'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">MD/MD CHANGER</label>
							<div class="controls">
								<?php echo $this->Form->input('md_changer',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'md_changerId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['md_changer'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">BENCH SEATS</label>
							<div class="controls">
								<?php echo $this->Form->input('bench_seats',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'bench_seatsId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['bench_seats'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">DOUBLE AIR CONDITION</label>
							<div class="controls">
								<?php echo $this->Form->input('double_air_condition',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'double_air_conditionId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['double_air_condition'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">SUNROOF</label>
							<div class="controls">
								<?php echo $this->Form->input('sunroof',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'sunroofId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['sunroof'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">ESC(ELECTRONIC STABILITY CONTROL)</label>
							<div class="controls">
								<?php echo $this->Form->input('electronic_stability_control',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'electronic_stability_controlId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['electronic_stability_control'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">SPARE TYRE</label>
							<div class="controls">
								<?php echo $this->Form->input('spare_tyre',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'spare_tyreId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['spare_tyre'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">FOG LAMP</label>
							<div class="controls">
								<?php echo $this->Form->input('fog_lamp',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'fog_lampId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['fog_lamp'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">MUD FLAP</label>
							<div class="controls">
								<?php echo $this->Form->input('mud_flap',array('type'=>'select','options'=>array('1'=>'Yes','2'=>'No'),'id'=>'mud_flapId','empty'=>'Select an Option','selected'=>@$carDetails['Car']['mud_flap'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>


						<!--New four fields-->
						<div class="form-group col-md-3">
							<label for="inputChassis">ENGINE CONDITION</label>
							<div class="controls">
								<?php echo $this->Form->input('engine_condition',array('type'=>'select','options'=>array('Good'=>'Good','Ok'=>'Ok','Poor'=>'Poor'),'id'=>'engine_condition','empty'=>'Select an Option','selected'=>@$carDetails['Car']['engine_condition'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">AUTOMATIC CONDITION</label>
							<div class="controls">
								<?php echo $this->Form->input('automatic_condition',array('type'=>'select','options'=>array('Good'=>'Good','Ok'=>'Ok','Poor'=>'Poor'),'id'=>'automatic_condition','empty'=>'Select an Option','selected'=>@$carDetails['Car']['automatic_condition'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">RUST(BODY)</label>
							<div class="controls">
								<?php echo $this->Form->input('rust_body',array('type'=>'select','options'=>array('No'=>'No', 'Low'=>'Low', 'High'=>'High'),'id'=>'rust_body','empty'=>'Select an Option','selected'=>@$carDetails['Car']['rust_body'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="inputChassis">RUST(ENGINE)</label>
							<div class="controls">
								<?php echo $this->Form->input('rust_engine',array('type'=>'select','options'=>array('No'=>'No', 'Low'=>'Low', 'High'=>'High'),'id'=>'rust_engine','empty'=>'Select an Option','selected'=>@$carDetails['Car']['rust_engine'],'data-rel'=>'chosen','label'=>false,'required'=>false));?>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label class="control-label" for="inputbodystyle">EXTERIOR COLOR</label>
							<?php echo $this->Form->input('exterior_color',array('type'=>'text','id'=>'exterior_color','value'=>@$carDetails['Car']['exterior_color'],'div'=>false,'label'=>false,'class'=> 'form-control'));?>
						</div>

						<div class="form-group col-md-3">
							<label class="control-label" for="inputbodystyle">SEATING CAPACITY</label>
							<?php echo $this->Form->input('seating_capacity',array('type'=>'text','id'=>'seating_capacity','value'=>@$carDetails['Car']['seating_capacity'],'div'=>false,'label'=>false,'class'=> 'form-control'));?>
						</div>

						<div class="col-md-12">
							<div class="form-group col-md-12">
								<label class="control-label" for="inputbodystyle">Remark </label>
								<?php echo $this->Form->input('remarks',array('type'=>'textarea','id'=>'remarksArea_id','value'=>@$carDetails['Car']['remarks'],'required'=>false,'class'=>'form-control','div'=>false,'label'=>false));?>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group col-md-12">
								<input type="hidden" value="<?php echo (isset($car_id)? $car_id:'0');?>" name="data[Car][car_id]" data-id="car_id">
								<?php echo $this->Form->submit('Save',array('type'=>'button','class'=>'btn btn-primary','id'=>'additional_car'));?>
								<div class="submit">
									<a  class="btn btn-danger" href="<?php echo $this->Html->url('/admin/cars',true);?>">Cancel</a>
								</div>
							</div>
						</div>
						<?php echo $this->Form->end();?>
					</div>
					<!-- code by lalit end -->



				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
</div><!-- content ends -->


<script>


	/*$( "#psale_price_id" ).keyup(function( event ) {

	 var sale_price= $('#psale_price_id').val();
	 var Dollertoyen = $("#main_exchange_id").val();
	 if(sale_price.length < 0)
	 {
	 $('#yenmsg').html('');
	 }else
	 {
	 var convert_price =  sale_price * Dollertoyen;
	 if(convert_price == 0)
	 {
	 $('#yenmsg').html('');
	 }else
	 {
	 $('#yenmsg').html('Doller convert in yen amount  <font color="red" size =3><b>'+ convert_price +'</b> </font> with Live Dollar to Yen price <font color="red" size =3 ><b>'+Dollertoyen+'</b></font>');
	 }

	 }


	 });	*/



	$(function()
	{

		var checkStatus= $("#newArrivalid").is(":checked");
		if(checkStatus==true)
		{
			$("#for_new_arrival").show();
		}else
		{
			$("#for_new_arrival").hide();;
		}


		$("#newArrivalid").click(function()
		{
			var checkStatus= $("#newArrivalid").is(":checked");
			if(checkStatus==true)
			{
				$("#for_new_arrival").show();
			}else
			{
				$("#for_new_arrival").hide();;
			}

		});

	});



	/* call yahoo api to get current rate of JSY against Dollar */
	function get_jpy_price(){
		$.ajax({
			'url':'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20%28%22USDJPY%22%29&format=json&env=store://datatables.org/alltableswithkeys',
			'type':'get',
			"dataType":'json',
			'success':function(obj){

				var newRate = Math.floor(obj.query.results.rate.Rate) -1 ;
				$("#main_exchange_id").val(newRate);


			},
			'error':function(error){
				alert(error);


			}


		});


	}

	/*
	 $('#inputDrive').tooltip({ or use any other selector, class, ID
	 placement: "bottom",
	 trigger: "hover"
	 });
	 */


	//sort UL LI to alphabatically
	function sortUnorderedList(ul, sortDescending) {
		if(typeof ul == "string")
			ul = document.getElementById(ul);
		// Idiot-proof, remove if you want
		if(!ul) {
			alert("The UL object is null!");
			return;
		}
		// Get the list items and setup an array for sorting
		var lis = ul.getElementsByTagName("LI");
		var vals = [];
		// Populate the array
		for(var i = 0, l = lis.length; i < l; i++)
			vals.push(lis[i].innerHTML);
		// Sort it
		vals.sort();
		// Sometimes you gotta DESC
		if(sortDescending)
			vals.reverse();
		// Change the list on the page
		for(var i = 0, l = lis.length; i < l; i++)
			lis[i].innerHTML = vals[i];
	}


	function removeTempImage(img_name){
		if(img_name!=undefined){
			$.ajax({
				'url':'<?php echo $this->Html->url('/admin/cars/delete_images');?>',
				'data':{'img_name':img_name},
				'type':'post',
				'success':function(result){
					var obj = jQuery.parseJSON( result );
					if(obj.status == 'success'){
						$('[data-image="'+img_name+'"]').remove();
					}else if(obj.status == 'successWithWarning'){
						$('[data-image="'+img_name+'"]').remove();
					}
				}
			});

		}

	}


	function checkDelete(id)
	{
		var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm!</h3></div><div class="modal-body"><div class="bootbox-body">Are you sure you want to delete All Car Image ?</div></div><div class="modal-footer"><button onclick="deleteAll('+id+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
		$("#myModal").html(str);
		$("#myModal").modal("show");
	}


	function deleteAll(id){
		if(id!=undefined){
			$.ajax({
				'url':'<?php echo $this->Html->url('/admin/cars/deleteAllCarImage');?>',
				'data':{'car_id':id},
				'type':'post',
				'success':function(result){
					var obj = jQuery.parseJSON( result );

					if(obj.status == 'success'){
						$('#myModal').modal('hide');
						$("#messageDivForImage").css("display","block");
						$('#messageDivForImage').html(obj.message);
						$('#messageDivForImage' ).delay(5000).fadeOut( "slow" );
						$('#uploadDivLUl').html('');

					}else if(result.status == 'successWithWarning'){

					}
				}
			});

		}

	}






	$(function(){

		get_jpy_price();
		var settings = {

			url: "<?php echo $this->Html->url('/')?>admin/cars/add_post_links/",
			method: "POST",

			allowedTypes:'jpeg,jpg,png,gif,mp4,avi,flv,mkv,mp3,wma,mpeg,mpeg4',
			fileName:"myfile",
			multiple: true,
			onSuccess:function(files,data,xhr)
			{

				var imageName = eval("("+data+")")
				//console.log(imageName);
				//   $("#uploadDivLUl").append('<li class="add_imgnew" data-image="'+files+'"><i class="fa fa-times pull-right" onclick="removeTempImage(\''+files+'\');"></i><img src="<?php echo $this->webroot;?>files/post_files/'+files+'"></li>');
				var c = 0;
				for(var i in imageName){

					if(imageName[i] == 'image'){
						var str =  '<li data-image="'+i+'" id="remove_image_'+c+'"  class="add_imgnew"><a href="javascript:void(0)" onclick="removeTempImage(\''+i+'\');" ><i  class="fa fa-times pull-right"></i></a> <img src="<?php echo $this->webroot; ?>files/post_files/'+i+'" alt="" /></li>';
						c++;
					}else{
						var str =  '<li><img src="<?php echo $this->webroot; ?>images/media_file.png" alt="" /></li>';
					}
					$('#uploadDivLUl').append( str );
					//sortUnorderedList('uploadDivLUl');
				}

			},
			onError: function(files,status,errMsg)
			{
				$("#status").html("<font color='red'>Upload is Failed</font>");
			}
		}

		$("#add_file").uploadFile(settings);


	});
</script>

<?php if(!empty($SaleData) && $carDetails['Car']['new_arrival'] == 1){ ?>
	<script>
		$(document).ready(function(){
			$("#Bid").removeClass('hide');
			$('#Bids').tab('show');

		});
	</script>

<?php } else if(isset($SaleData) && $carDetails['Car']['new_arrival'] == 0) {?>
	<script>
		$(document).ready(function(){
			$("#saleDetailId").removeClass('hide');
			$('#saleDetailId').tab('show');
		});
	</script>


<?php	}else{ ?>
	<script>
		$(document).ready(function(){

			$('#about').tab('show');
		});
	</script>







<?php }?>

<script>
	$('.abc').click(function(event) {
		var spliData=$(this).data('id');

		$("#saleDetailId").removeClass('hide');

		var data=spliData.split("-");
		console.log(data);

		$('#select_client').val(data[0]);
		$("#select_client").trigger("liszt:updated");
		$('#psale_price_id').val(data[1]);
	});
</script>
<!--submit form  with ajax-->
<script>
	$('#submitbtn').click(function(event) {
		form = $("#shipid").serialize();
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/add_shipment ",
			data: form,
			success: function(data){
			}
		});
		event.preventDefault();
		return false;  //stop the actual form post !important!
	});
	$('#saveimg').click(function(event) {
		form = $("#imgload").serialize();
		//console.log(form);
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/addImage ",
			data: form,
			dataType:"json",
			success: function(data){

				if(data.status !='error'){
					$("#messageDivIdAdd").css("display","inline");
					$("#messageDivIdAdd").css("color","green");
					$('#messageDivIdAdd').html(data.message);
					$('#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					$('#deleteCar').show();

					sortUnorderedList('uploadDivLUl');
					// $('#saleDetailId').tab('show');
					//$('#Bid').tab('show');
					//    $("#Bid").removeClass('hide');
					// $("#saleDetailId").tab('show');

				}else{
					$('#errmessageDivIdAdd').html(data.message);
					$("#messageDivIdAdd").css("color","red");
					$('#messageDivIdAdd').delay(5000).fadeOut( "slow" );
				}
			}
		});
		event.preventDefault();
		return false;  //stop the actual form post !important!
	});
</script>
<script>

	function checkType(type)
	{
		var datas = {'type':type.value};
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/car_type ",
			data:datas,
			dataType:"JSON",
			success: function(data){
				//var obj = jQuery.parseJSON( data );
				var select = '<option value ="">Select Type</option>';
				$.each(data, function( index, value ) {
					select +='<option value ="'+ index+'">';
					select +=value;
					select +='</option>';
				});

				if(type.value==2)
				{
					$("#engineNo").show();
				}
				else
				{
					$("#engineNo").hide();
				}
				//console.log(select);
				$("#truck_type").html(select);
				$("#truck_type").trigger("liszt:updated");

			}
		});
	}




	/*$(document).ready(function(){
	 var datas = {'type':1};
	 $.ajax({
	 type: "POST",
	 url: "<?php  echo $this->Html->url('/',true);?>admin/cars/car_type ",
	 data:datas,
	 dataType:"JSON",
	 success: function(data){
	 //var obj = jQuery.parseJSON( data );
	 var select = '<option value ="">Select Type</option>';
	 $.each(data, function( index, value ) {
	 select +='<option value ="'+ index+'">';
	 select +=value;
	 select +='</option>';
	 });
	 //console.log(select);
	 $("#truck_type").html(select);
	 $("#truck_type").trigger("liszt:updated");

	 }
	 });
	 }); */


	$("#PortdataId").on('change', function(event){
		var auction_id = $("#select_auction").val();
		var port_id = $("#portData_id").val();
		if(auction_id !='')
		{
			$.ajax({
				type: "POST",
				url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getCharge",

				data:{port_id:port_id,auction_id:auction_id},
				dataType:'JSON',
				success:function(data){

					//$('#main_rickshaw_id').val(data.price);
				}

			});
		}
	});


	$("#PortdataId").on('change', function(event){
		var port_id = $("#portData_id").val();
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getShipCharge",
			data:{port_id:port_id},
			dataType:'JSON',
			success:function(data){
				$('#main_shipping_id').val(data.shipCharge);
				//if(data.shipCharge !='')
				//{

				//}
			}

		});
	});


	/*$("#Country_id").on('change', function(event){
	 var country_id = $("#Country_id").val();
	 $.ajax({
	 type: "POST",
	 url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getPort",
	 data:{countryId:country_id},
	 dataType:'html',
	 success:function(data){
	 $('#PortdataId').html(data);
	 $('[data-rel="chosen"],[rel="chosen"]').chosen();

	 }
	 });
	 });*/




	/*$('#selectAuctionId').on('change', function(event) {
	 var html = '';
	 $.ajax({
	 url: "<?php  echo $this->Html->url('/',true);?>admin/cars/add_shipment",
	 method: 'get',
	 data:{id:$(this).val()},
	 dataType: 'json',
	 success: function(response) {
	 for(i=0;i<response.length;i++)
	 {
	 html+="<option value='"+response[i].Venue.id+"'>"+response[i].Venue.venue_name+"</option>";
	 }
	 $("#CarsVenue").html(html);
	 $('[data-rel="chosen"],[rel="chosen"]').trigger("liszt:updated");
	 }
	 });
	 });*/

	$(function(){

		var auction_id = $("#select_auction").val();
		var transportId = $("#transports_id").val();
		var port_id = $("#portData_id").data('value');
		if(auction_id != ''){
			$.ajax({
				type: "POST",
				url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getEditPort",
				beforeSend: function() {$("#ajax-loading"+auction_id).show(); },
				data:{auction_id:auction_id,port_id:port_id},
				dataType:'html',
				success:function(data){
					$("#ajax-loading"+auction_id).hide();
					$('#PortdataId').html(data);
					$('[data-rel="chosen"],[rel="chosen"]').chosen();
					$("#PortdataId").trigger("liszt:updated");
				}
			});

		}

	});



	$('#transports_id').on('change', function(event) {

		var auction_id = $("#select_auction").val();
		var transportId = $("#transports_id").val();
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getPort",
			//beforeSend: function() {$("#ajax-loading"+auction_id).show(); },
			data:{auction_id:auction_id,transportId:transportId},
			dataType:'html',
			success:function(data){
				//   $("#ajax-loading"+auction_id).hide();
				$('#PortdataId').html(data);
				$('[data-rel="chosen"],[rel="chosen"]').chosen();

			}
		});
	});




	/*
	 $('#select_auction').on('change', function(event) {

	 var auction_id = $("#select_auction").val();
	 $.ajax({
	 type: "POST",
	 url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getPort",
	 //beforeSend: function() {$("#ajax-loading"+auction_id).show(); },
	 data:{auction_id:auction_id},
	 dataType:'html',
	 success:function(data){
	 //   $("#ajax-loading"+auction_id).hide();
	 $('#PortdataId').html(data);
	 $('[data-rel="chosen"],[rel="chosen"]').chosen();

	 }
	 });
	 });*/


</script>
<script>
	$('#submit').click(function(event) {
		form = $("#overview").serialize();
		form += "&data[auction_name]=" + $('#select_auction option:selected').text();
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/addnew_car",
			data: form,
			dataType:'JSON',
			beforeSend: function() {
				$("#loading2").show();
			},
			success: function(data){
				$("#loading2").hide();
				// console.log(data.status);

				if(data.status =='success'){
					$('#messageDivIdAdd').html(data.message);
					$("#messageDivIdAdd").css("color","green");
					$("#messageDivIdAdd").show(1000);
					$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );

					//$("#Image").tab('show');
					$("#Image").removeClass('hide');
					$("#Bid").removeClass('hide');
					var url = '/admin/cars/addnew_car/'+data.data.Car.car_id;
					$(location).attr('href',url);

					if(data.data.Car.new_arrival != 1){
						$("#saleDetailId").removeClass('hide');
						$("#products").removeClass('hide');

					}else{

						$("#saleDetailId").addClass('hide');
						$("#products").addClass('hide');

					}
					$("html, body").animate({ scrollTop: 150 }, "fast");
					$('[data-id="car_id"]').val(data.data.Car.car_id);
					//getPort(data.data.Car.auction_id,data.data.Car.country_id);
				}else{

					$('#errmessageDivIdAdd').show();
					for( var i in data.message ){
						msg = data.message[i];
						$('[name = "data[Car]['+String(i)+']"]').focus();
						$("html, body").animate({ scrollTop: 150 }, "fast");
						break;
					}
					$('#errmessageDivIdAdd').html(String(msg));
					$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );
				}
			},
			error:function(error){
				console.log(error);
				$('#errmessageDivIdAdd').show();
				$("html, body").animate({ scrollTop: 150 }, "fast");
				$('#errmessageDivIdAdd').html(error.responseText.substring(0,20));
				$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );


			}

		});
		event.preventDefault();
		return false;  //stop the actual form post !important!

	});

</script>
<script>
	$(function() {
		$("#datepicker1").datepicker({
			changeMonth: true,
			yearRange: '-50:+25',
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'mm yy'
		}).focus(function() {
			var thisCalendar = $(this);
			//$('.ui-datepicker-calendar').detach();
			$('.ui-datepicker-close').click(function(dateText, inst) {
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				thisCalendar.datepicker('setDate', new Date(year, month, 1));
			});
		});

		$("#arrival_date").datepicker({ dateFormat: 'dd-mm-yy',yearRange: '-40:+0' });
		$("#departure_date").datepicker({ dateFormat: 'dd-mm-yy',yearRange: '-40:+0' });
		$("#datepicker").datepicker({ dateFormat: 'dd-mm-yy',yearRange: '-40:+0' });
		$( "#datepickerSecond" ).datepicker({ dateFormat: 'dd-mm-yy',yearRange: '-40:+0' });
		$( "#datepickerThird" ).datepicker({ dateFormat: 'dd-mm-yy' ,yearRange: '-40:+0'});
		$( "#datepickerfourth" ).datepicker({ dateFormat: 'dd-mm-yy',yearRange: '-40:+0' });
		//$( "#new_arrival_datepicker" ).datepicker({ dateFormat: 'dd-mm-yy',yearRange: '-40:+0' });

		$('#new_arrival_datepicker').datetimepicker({format:'d-m-Y H:i:s'});



	});
</script>
<!--      change price of Auction-->
<script>
	$('#select_auction').on('change', function(event) {
		var val=$("#select_auction option:selected").attr('data-value');
		//$('#main_select_fee').val(val);
		var auction_id = $("#select_auction").val();
		var port_id = $("#portData_id").val();
		/*if(port_id !='')
		 {
		 $.ajax({
		 type: "POST",
		 url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getCharge",
		 data:{port_id:port_id,auction_id:auction_id,'param':'charge'},
		 dataType:'JSON',
		 success:function(data){
		 $('#main_rickshaw_id').val(data.price);
		 if(data.shipCharge !='')
		 {
		 $('#main_shipping_id').val(data.shipCharge);
		 }
		 }
		 });
		 }*/
	});


</script>

<script>
	/*             calculate net push price                               */
	function allownumber(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 46 || charCode > 57))
			return false;
		return true;
	}


	function calculateprice() {
		return Number($("#main_rickshaw_id").val()) + Number($("#main_shipping_id").val()) + Number($("#main_freight_id").val()) + Number($("#mail_Others_id").val()) + Number($("#main_select_fee").val()) + Number($("#net_push_id").val()) + Number($("#recycle_price").val());
	}

	function calculateUserprice() {
		return Number($("#main_rickshaw_id").val()) + Number($("#main_shipping_id").val()) + Number($("#main_freight_id").val()) + Number($("#mail_Others_id").val()) + Number($("#main_select_fee").val()) + Number($("#net_push_id").val());
	}

</script>
<script>
	/*	  function for  calculate Car price  here */
	var price = $("#main_yenamount_id").val()
	var rate= $("#main_exchange_id").val()
	function calculateexchange(price, rate) {
		return roundNumber(price / rate, 2);
	}
	function updatepushprice(price, tax) {
		return roundNumber(Number(price) + Number(price * (tax / 100)), 2);
	}

	function updatepushrecycleprice(price, recycle, tax) {
		var price_val = roundNumber(Number(price) + Number(price * (tax / 100)), 2);
		var recycle_val = roundNumber(Number(recycle) + Number(recycle * (tax / 100)), 2);
		return roundNumber(Number(price_val) + Number(recycle_val), 2);
	}

	function roundNumber(num, dec) {
		var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
		return result;
	}

	$("#tax_id").keyup(function () {
		if ($("#push_id").val() != "" && $("#tax_id").val() != "") {
			$("#net_push_id").val(updatepushprice($("#push_id").val(), $("#tax_id").val()));
		}
	});

	$("#push_id").keyup(function () {
		calculateNetPushRecyclePrice();
	});

	$("#recycle_price").keyup(function () {
		calculateNetPushRecyclePrice();
	});

	function calculateNetPushRecyclePrice(){
		if($("#Created_User_GroupID").val() == 2) {
			if ($("#push_id").val() != " " && $("#tax_id").val() != " ") {
				$("#net_push_id").val(updatepushrecycleprice($("#push_id").val(), $("#recycle_price").val(), $("#tax_id").val()));
			}
		}else{
			if ($("#push_id").val() != " " && $("#tax_id").val() != " ") {
				$("#net_push_id").val(updatepushprice($("#push_id").val(), $("#tax_id").val()));
			}
		}
	}


	$("#btn_calc").click(function () {
		calculateFinalPrice();
	});


	function calculateFinalPrice(){
		if($("#Created_User_GroupID").val() == 2) {
			$("#car_price_id").val("");
			$("#main_yenamount_id").val(calculateUserprice);
			$("#car_price_id").val(calculateexchange($("#main_yenamount_id").val(), $("#main_exchange_id").val()));
		}else{
			$("#car_price_id").val("");
			$("#main_yenamount_id").val(calculateprice);
			$("#car_price_id").val(calculateexchange($("#main_yenamount_id").val(), $("#main_exchange_id").val()));
		}
	}

	$('#Country_id').on('change', function(event) {
		var val=$("#Country_id option:selected").attr('data-value');
		var data=val.split("-");
		//$('#main_rickshaw_id').val(0);
		//$('#main_shipping_id').val(0);
		$('#main_freight_id').val(data[1]);
		$('#mail_Others_id').val(data[3]);

	});


	$('#User_send-email').click(function(event) {
		$.ajax({
			url: "<?php  echo $this->Html->url('/admin/cars/send_image',true);?>",
			type: 'POST',
			dataType:"html",
			success: function(result) {

				$("#myModal").html(result);
				$('[data-rel="chosen"],[rel="chosen"]').chosen();


			}
		});
	});


	$('#send_sales').click(function(event) {
		form = $("#sales_tab").serialize();

		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/sale",
			data: form,
			dataType:'JSON',
			success: function(data){

				if(data.status !='error')
				{
					$('#messageDivIdAdd').html(data.message);
					$("#messageDivIdAdd").css("color","green");
					$("#messageDivIdAdd").show(1000);
					$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );
					$("#createInvoiceId").removeClass('hide');
					$("#products").removeClass('hide');
					getInvoice(data.data.CarPayment.user_id);
				}else{
					$('#errmessageDivIdAdd').show();
					for(var i in data.message )
					{
						msg = data.message[i];
						break;
					}
					$('#errmessageDivIdAdd').html(String(msg));
					$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );

				}
			}
		});
	});


	$('#logistic_car').click(function(event) {
		form = $("#logistics_details").serialize();

		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/logistic",
			data: form,
			dataType:'JSON',
			success: function(data){
				// console.log(data.status);
				if(data.status =='success'){

					// console.log(data.message);
					$('#messageDivIdAdd').html(data.message);
					$("#messageDivIdAdd").css("color","green");
					$('#messageDivIdAdd').show(1000);
					$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );

				}else{

					$('#errmessageDivIdAdd').show();
					for(var i in data.message ){
						msg = data.message[i];

						break;
					}
					$('#errmessageDivIdAdd').html(String(msg));
					$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );

				}
			}
		});
	});


	$('#additional_car').click(function(event) {
		form = $("#additional_detail_form").serialize();
		//alert(form);
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/additional",
			data: form,
			dataType:'JSON',
			success: function(data){
				//console.log(data.status);
				//console.log(data);
				if(data.status =='success'){

					// console.log(data.message);
					$('#messageDivIdAdd').html(data.message);
					$("#messageDivIdAdd").css("color","green");
					$('#messageDivIdAdd').show(1000);
					$( '#messageDivIdAdd' ).delay(5000).fadeOut( "slow" );

				}else{

					$('#errmessageDivIdAdd').show();
					for(var i in data.message ){
						msg = data.message[i];

						break;
					}
					$('#errmessageDivIdAdd').html(String(msg));
					$('#errmessageDivIdAdd' ).delay(5000).fadeOut( "slow" );

				}
			}
		});
	});

	$('#newArrivalId').click(function() {
		var checked = $(this).is(':checked');
		$.ajax({
			type: "POST",
			data:{ 'checked' : checked,'id':$('[data-id = "car_id"]').val()},
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/new_arrival",
			success: function(data) {
				//alert(data);

			}
		});
	}) ;
	/*function getPort(auction_id,country_id)
	 {
	 $.ajax({
	 type: "POST",
	 url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getPort",
	 data:{auctionId:auction_id,countryId:country_id},
	 dataType:'html',
	 success:function(data){
	 $('#PortdataId').html(data);
	 $('[data-rel="chosen"],[rel="chosen"]').chosen();

	 }
	 });
	 }*/
	/*function for get invoice details*/
	function getInvoice(user_id)
	{
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->Html->url('/',true);?>admin/cars/getInvoice",
			data:{userId:user_id},
			dataType:'html',
			success:function(data){
				$('#InvoiceDataId').html(data);
				//  $('[data-rel="chosen"],[rel="chosen"]').chosen();
			}
		});
	}


</script>

