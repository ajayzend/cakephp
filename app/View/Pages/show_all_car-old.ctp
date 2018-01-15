<div class="container back_user">


<div class="row car-details">
<h2>Select Cars</h2>
	<?php 
	$i = 1;
	foreach($showAllCar as $key=>$value){?>
	
		<?php foreach($value['CarImage'] as $key1=>$value1) { ?>
					
			<?php  if(isset($value1['image_source'])){
					$imageSrc = "img/carimages/".$value1['image_source'];
				}else{
					$imageSrc = "images/new_arrival01.png";
				}
			
			?>
		
		<?php } ?>
		<div class="col-md-6">
		<div class="col-md-5"><img class="img-responsive thumbnail" src="<?php echo $this->webroot;?><?php echo $imageSrc;?>"></div>
		<div class="col-md-7">
		<h3><?php echo $i;?>. <?php echo $value['Car']['package'];?></h3>
		
		<table class="table">
			<tr>
				<Td>Year/Month</td>
				<Td><?php echo date("Y/W", strtotime($value['Car']['pdate']));?></td>
			</tr>
			<tr>
				<Td>Kilo-Meter</td>
				<Td><?php echo $value['Car']['mileage'];?> KM</td>
			</tr>
			<tr>
				<Td>CC</td>
				<Td><?php echo $value['Car']['cc'];?> CC</td>
			</tr>
		</table>	
		<a href="<?php  echo $this->Html->url('/home/carDetails/',true);?><?php echo base64_encode($value['Car']['id']);?>" class="btn btn-danger btn-sm">Details</a>		
		<!-- <a href="#" class="btn btn-danger btn-sm">Details</a>	-->	
		</div>
		</div>
	<?php $i++;}?>
	
	

	
	
	
	<div class="clearfix"></div><hr/>
	
	
	
	
</div>
</div>
