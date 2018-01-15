<?php echo $this->Html->script('jquery-form');?>
<?php echo $this->Html->css('uploadfile');?>
<?php echo $this->Html->script('uploadfile');?>
<?/*php
 // Process image
 $uploadName = 'uploaded/pic.jpg';
 if (count($_FILES)) move_uploaded_file($_FILES['image']['upload-images'], $uploadName);
*/?>
<div id="content" class="span10 admin_all"> 
			<!-- content starts --> 
			
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="fa fa-user"></i> <?php echo __('Add new car')?></h2>
			<div class="clearfix"></div>	
			</div>
			<div class="box-content">
			<div class="row-fluid">
				<div class="span12">
					<ul class="nav nav-tabs admin_tab" id="myTab" >
						<li class="active" ><a href="#about_content" id="about" class="rounded_tab" data-toggle="tab" >Overview</a></li>
						<li><a href="#products_content" id="products" class="rounded_tab" data-toggle="tab" >Products and Services</a></li>
						<li><a href="#locations_content" id="locations" class="rounded_tab" data-toggle="tab" >Additional Locations</a></li>
						<li><a href="#faq_content" id="faq" class="rounded_tab" data-toggle="tab" >FAQs</a></li>
					</ul>							
				</div>
			 </div>
			<div id="my-tab-content" class="tab-content admin_content">
				<div class=" tab-pane active" id="about_content">
					<p>We first opened our doors in 1977 and was one of the first Chinese restaurants in Chinatown to serve Yum Cha. our success for the past 30 years has been attributed to our continual commitment to quality, consistency and service to our loyal patrons.</p>
				</div> 
				<div class=" tab-pane" id="products_content">
					<p>The name Nine Dragons is reflective of our success and is very fitting because both the number nine and dragons have special significance in Chinese culture, as the dragon is a symbol of power, strength, and good luck. Throughout China's history, the Emperor of China has used the dragon as a symbol of his imperial power and strength.
					</p>
				</div> 
							<div class="clearfix"></div>
			</div>
				<div class="row-fluid">
				<div class="add_cars span12">
					<?php echo $this->Form->create('User', array('action'=>'addnew_car')); ?>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputid">Unique ID</label>
							<div class="controls">
							  <input type="text" id="inputid" name="uniqueid" class="input-xlarge">
							</div>
						</div>
					
						<div class="control-group span6">
							<label class="control-label" for="inputLocation">Location</label>
							<div class="controls">
							  <input type="text" id="inputLocation" name="location" class="input-xlarge">
							</div>
						</div> 
					</div>	
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputChassis">Chassis No</label>
							<div class="controls">
							  <input type="text" id="inputChassis" name="cnumber" class="input-xlarge">
							</div>
						</div>
						
						<div class="control-group span6">
							<label class="control-label" for="inputTransmission">Transmission</label>
							<div class="controls">
							  <input type="text" id="inputTransmission" name="transmission" class="input-xlarge">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputDrive">Drive</label>
							<div class="controls">
							  <input type="text" id="inputDrive" name="drive" class="input-xlarge">
							</div>
						</div>
						
						<div class="control-group span6">
							<label class="control-label" for="inputHandle">Handle</label>
							<div class="controls">
							<select id="inputHandle"name="data[User][handle]">
								<option value="">select handle type</option>
								<option value="RHD">RHD</option>
								<option value="LHD">LHD</option>
								<option value="NTD">NTD</option>
								</select>
							<!--  <input type="text" id="inputHandle" name="handle" class="input-xlarge">-->
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputFuel">Fuel</label>
							<div class="controls">
							<select id="inputFuel"name="data[User][fuel]">
								<option value="">select fuel type</option>
								<option value="deisel">deisel</option>
								<option value="petrol">petrol</option>
								
								</select>
							 <!-- <input type="text" id="inputFuel" name="fuel" class="input-xlarge">-->
							</div>
						</div>
						
						<div class="control-group span6">
							<label class="control-label" for="inputStock">Stock</label>
							<div class="controls">
							  <input type="text" id="inputStock" name="stock" class="input-xlarge">
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
								<select id="inputdoor"name="data[User][door]">
								<option value="">Select Door </option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								</select>
							 <!-- <input type="text" id="inputdoor" name="door" class="input-xlarge">-->
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="inputbodystyle">Body Style</label>
							<div class="controls">
							  <input type="text" id="inputbodystyle" name="bstyle" class="input-xlarge">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="inputmileage">Mileage</label>
							<div class="controls">
							  <input type="text" id="inputbodymileage" name="mileage" class="input-xlarge">
							</div>
						</div>
					</div> 
						<?//php echo $this->Form->end(); ?>
					<div class="row-fluid">
						<div class="control-group span12">
							<label class="control-label" for="inputmileage">Upload Images</label>
							<div class="Upload_imagearea">
					<ul id="uploadDivLUl">
						<li class="add_imgnew"><a place="" id="add_file" class="ajax-file-upload" href="javascript:void(0);">
							<i class="fa fa-plus-square"></i>
							
						</a></li>
					</ul>
					<div class="clearfix"></div> <!-- Clearfix -->
				</div>	
						
						</div>
							
						</div>
					</div>
						
						<div class="control-group">
							<div class="controls">
							  <button type="submit" class="btn btn-primary">Add</button>
							  <button type="submit" class="btn btn-danger">Cancel</button>
							  <?php echo $this->Form->end(); ?>
							</div>
						</div>
				
                </div>
				</div>
			</div>
		</div><!-- content ends -->
			</div><!--/#content.span10-->
</div><!--/fluid-row-->

<script>
$(function(){
	//$('[name = "data[new_topic]"]').attr('type','hidden');
	
		/*reseting image session */
	/*	$.get( "<?php echo $this->Html->url('/ajax/image_reset');?>", function( data ) {
		
		});
	*/
		var settings = {

			url: "<?php echo $this->Html->url('/')?>admin/add_post_links/",
			method: "POST",
			
			allowedTypes:'jpeg,jpg,png,gif,mp4,avi,flv,mkv,mp3,wma,mpeg,mpeg4',
			fileName:"myfile",
			multiple: true,
			onSuccess:function(files,data,xhr)
			{
					
					var imageName = eval("("+data+")")
					
					for(var i in imageName){
						
						if(imageName[i] == 'image'){
						var str =  '<li><img src="<?php echo $this->webroot; ?>files/post_files/'+i+'" alt="" /></li>';
						}else{
						var str =  '<li><img src="<?php echo $this->webroot; ?>images/media_file.png" alt="" /></li>';
						}
						$('#uploadDivLUl li:last').before( str );
						}
					
					//$("#status").html("<font color='green'>Upload is success</font>");
					
			},
			onError: function(files,status,errMsg)
			{		
				$("#status").html("<font color='red'>Upload is Failed</font>");
			}
		}

		//alert(file_type);
		$("#add_file").uploadFile(settings);


});
</script>
