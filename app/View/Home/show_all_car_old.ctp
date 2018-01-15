<div class="container back_user">
<div class="row car-details">
		<div class="row">
		<ol class="breadcrumb">
		  <li><a href="#">Home</a></li>
		  <li><a href="#">Russia</a></li>
		  <li class="active">Toyota</li>
		</ol>

	</div>
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
		<!--<div class="col-md-6">
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
		<a href="<?php  echo $this->Html->url('/home/carDetails/',true);?><?php echo base64_encode($value['Car']['id']);?>" class="btn btn-danger btn-sm">Details</a>-->	
		<!-- <a href="#" class="btn btn-danger btn-sm">Details</a>-->	
		<!--</div>
		</div>-->
	<?php $i++;}?>
	<!--<div class="clearfix"></div><hr/>-->
	<div class="col-sm-3 home-sidebar">
		<div class="sidebar-inner">
			<ul>
				<li><a href="#">All Brands Russia</a></li>
				<li><a href="#">TOYOTA</a></li>
				<li><a href="#">NISSAN</a></li>
				<li><a href="#">HONDA</a></li>
				<li><a href="#">SUBARU</a></li>
				<li><a href="#">MAZDA</a></li>
				<li><a href="#">MITSUBISHI</a></li>
				<li><a href="#">SUZUKI</a></li>
				<li><a href="#">DAIHATSU</a></li>
				<li><a href="#">LEXUS</a></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-9 select-car">
		<ul>
			<li><a href="#">A</a></li>
			<li><a href="#">ALLION</a></li>
			<li><a href="#">alphard</a></li>
		</ul>
		<ul>
			<li><a href="#">B</a></li>
			<li><a href="#"> belta  </a></li>
		</ul>
		<ul>
			<li><a href="#">C</a></li>
			<li><a href="#">COROLLA FIELDER</a></li>
			<li><a href="#">corolla-axio</a></li>
		</ul>
		<ul>
			<li><a href="#">F</a></li>
			<li><a href="#">f j cruiser</a></li>
		</ul>
		<ul>
			<li><a href="#">I</a></li>
			<li><a href="#">IST</a></li>
		</ul>
		<ul>
			<li><a href="#">P</a></li>
			<li><a href="#">PASSO</a></li>
			<li><a href="#">platz</a></li>
			<li><a href="#">PRADO</a></li>
		</ul>
		<ul>
			<li><a href="#">P</a></li>
			<li><a href="#">PREMIO</a></li>
			<li><a href="#">PROBOX</a></li>
		</ul>
		<ul>
			<li><a href="#">R</a></li>
			<li><a href="#">RUSH</a></li>
		</ul>
		<ul>
			<li><a href="#">S</a></li>
			<li><a href="#">SUCCEED</a></li>
		</ul>
		<ul>
			<li><a href="#">V</a></li>
			<li><a href="#">VANGUARD</a></li>
			<li><a href="#">VITZ</a></li>
			<li><a href="#">voxy</a></li>
		</ul>
		<ul>
			<li><a href="#">W</a></li>
			<li><a href="#">WISH</a></li>
			<li><a href="#">WISH-</a></li>
		</ul>
	</div>
</div>
</div>
