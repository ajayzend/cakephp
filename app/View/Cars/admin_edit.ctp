<div class="add_cars span12">
					<?php echo $this->Form->create('Car',array('id'=>'editdata')); ?>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputid">Unique ID</label>
							<div class="controls">
							<?php echo $this->Form->input('uniqueid',array('type'=>'text','class'=>'input-xlarge','label'=>false,'readonly'=>true)); ?>
							 <!-- <input type="text" id="inputid" name="uniqueid" class="input-xlarge">-->
							</div>
						</div>
					
						<div class="control-group span6">
							<label class="control-label" for="inputLocation">Location</label>
							<div class="controls">
								<?php echo $this->Form->input('location',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>
							 <!-- <input type="text" id="inputLocation" name="location" class="input-xlarge">-->
							</div>
						</div> 
					</div>	
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputChassis">Chassis No</label>
							<div class="controls">
							<?php echo $this->Form->input('cnumber',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>	
							 <!-- <input type="text" id="inputChassis" name="cnumber" class="input-xlarge">-->
							</div>
						</div>
						
						<div class="control-group span6">
							<label class="control-label" for="inputTransmission">Transmission</label>
							<div class="controls">
								<?php echo $this->Form->input('transmission',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>
							<!--  <input type="text" id="inputTransmission" name="transmission" class="input-xlarge">-->
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputDrive">Drive</label>
							<div class="controls">
								<?php echo $this->Form->input('drive',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>
							  <!--<input type="text" id="inputDrive" name="drive" class="input-xlarge">-->
							</div>
						</div>
					
						<div class="control-group span6">
							<label class="control-label" for="inputHandle">Handle</label>
							<div class="controls">
								<?php $handel=array('RHD'=>'RHD','LHD'=>'LHD','NTD'=>'NTD') ?>
								<?php echo $this->Form->input('handle',array('type'=>'select','options'=>$handel,'label'=>false,'data-rel'=>"chosen")); ?>
						<!--	<select id="inputHandle"name="data[User][handle]" data-rel="chosen">
								<option value="">select handle type</option>
								<option value="RHD">RHD</option>
								<option value="LHD">LHD</option>
								<option value="NTD">NTD</option>
								</select>-->
							<!--  <input type="text" id="inputHandle" name="handle" class="input-xlarge">-->
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputFuel">Fuel</label>
							<div class="controls">
								<?php $fuel=array('petrol'=>'petrol','deisel'=>'deisel') ?>
								<?php echo $this->Form->input('fuel',array('type'=>'select','options'=>$fuel,'label'=>false,'data-rel'=>"chosen")); ?>
							<!--<select id="inputFuel"name="data[User][fuel]" data-rel="chosen">
								<option value="">select fuel type</option>
								<option value="deisel">deisel</option>
								<option value="petrol">petrol</option>
							
								</select>-->
							 <!-- <input type="text" id="inputFuel" name="fuel" class="input-xlarge">-->
							</div>
						</div>
						
						<div class="control-group span6">
							<label class="control-label" for="inputStock">Stock</label>
							<div class="controls">
								<?php echo $this->Form->input('stock',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>
							 <!-- <input type="text" id="inputStock" name="stock" class="input-xlarge">-->
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputAllStock">Color</label>
							<div class="controls">
							  <input type="text" id="inputAllStock" name="color" class="input-xlarge">
							</div>
						</div>
						
						<div class="control-group span6">
							<label class="control-label" for="inputdoor">Door</label>
							<div class="controls">
								<?php $door=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6') ?>
								<?php echo $this->Form->input('door',array('type'=>'select','options'=>$door,'label'=>false,'data-rel'=>"chosen")); ?>
							<!--	<select id="inputdoor"name="data[User][door]" data-rel="chosen">
								<option value="">Select Door </option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								</select>-->
							 <!-- <input type="text" id="inputdoor" name="door" class="input-xlarge">-->
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputbodystyle">Body Style</label>
							<div class="controls">
							<?php echo $this->Form->input('bstyle',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>
							<!--  <input type="text" id="inputbodystyle" name="bstyle" class="input-xlarge">-->
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="inputmileage">Mileage</label>
							<div class="controls">
							<?php echo $this->Form->input('mileage',array('type'=>'text','class'=>'input-xlarge','label'=>false)); ?>
							<!--  <input type="text" id="inputbodymileage" name="mileage" class="input-xlarge">-->
							</div>
						</div>
					</div> 
					<?php echo $this->Form->submit('submit',array('type'=>'submit','id'=>'submitedit')); ?>
						<?php echo $this->Form->end(); ?>
					<!--<div class="row-fluid">
						<div class="control-group span12">
							<label class="control-label" for="inputmileage">Upload Images</label>
							<div class="Upload_imagearea">
					<ul id="uploadDivLUl">
						<li class="add_imgnew"><a place="" id="add_file" class="ajax-file-upload" href="javascript:void(0);">
							<i class="fa fa-plus-square"></i>
							
						</a></li>
					</ul>
					<div class="clearfix"></div> <!-- Clearfix 
				</div>	
						
						</div>
							
						</div>-->
					</div>
						
						<!-- form-1-->
					<!--	
						<div class="control-group">
							<div class="controls">
							<?//php echo $this->Form->input('menu',array('type'=>'hidden','value'=>'1')); ?>
							  <button type="submit" class="btn btn-primary">Add</button>
							  <button type="submit" class="btn btn-danger">Cancel</button>
							  <?php echo $this->Form->end(); ?>
							</div>
						</div>-->
					
				</div>  
 <script>/*
 $('#submitedit').click(function(event) {
       form = $("#editdata").serialize();
       console.log(form);
     $.ajax({
       type: "POST",
       url: "<?php  echo $this->Html->url('/',true);?>admin/cars/edit ",
       data: form,

       success: function(data){
       }

     });
     event.preventDefault();
     return false;  //stop the actual form post !important!

  });
*/
</script>
