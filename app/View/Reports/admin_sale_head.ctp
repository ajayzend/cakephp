<div class="row">
						<div class="col-md-12">
							<!--<form role="form">-->
								<div class="form-group col-sm-3">
									<label class="control-label" for="brand">Brand Wise:</label>
									<?php echo  $this->Form->input('brand_name',array('type'=>'select','options'=>$Brands,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'brand_id','selected'=>"",'empty'=>'Select Brands')); ?>
								</div>
								<div class="form-group col-sm-3">
									<label class="control-label" for="country">Country Wise:</label>
									<?php echo  $this->Form->input('country_name',array('type'=>'select','options'=>$Country,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'country_id','selected'=>"",'empty'=>'Select Country')); ?>
								</div>
								<div class="form-group col-sm-3">
									<label class="control-label" for="chassis">Chassis wise /UID wise:</label>
									<?php echo  $this->Form->input('cnumber',array('type'=>'select','options'=>$Cars,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'cnumber','selected'=>"",'empty'=>'Select Chassis No.')); ?>
								</div>
								<div class="form-group col-sm-3">
									<label class="control-label" for="client">Client wise:</label>
									<?php echo  $this->Form->input('user',array('type'=>'select','options'=>$Users,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'user_id','selected'=>"",'empty'=>'Select User')); ?>
								</div>
								<div class="col-md-12">
									<button class="btn btn-primary pull-right" onClick ="resetFields();" >Clear</button> 
									<button class="btn btn-primary pull-right" onClick ="showSalesReport();" >Search</button>
									
								</div>
							<!--</form> -->
						</div>
					</div>
					<img id="loading" src="<?php echo $this->webroot; ?>img/loading_backgruond.png" height="30px" width="25px" style="display:none;"/> 
					<div class="row" id="saleReport">
						
					</div>
