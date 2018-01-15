<div class="bg-car"> <!--car background-------->
<div class="heading-bg">  <!--Heading background-------->
<div class="container back_user">	
	<div class="col-sm-12 stock-list-head">
	<header class="section-header">
	<div class="animated animation-done bounceInLeft" data-animation="bounceInLeft"> <i class="fa fa-autologo"></i> </div>
	 <h2 class="stock-heading"> 
		 <?php  
			if(isset($carType))
			{ 
				echo 'Truck Stock';
			}else 
			{ 
				echo "Select Cars"; 
			} 
		?></h2>
	</header>
	</div>
   </div>
   
  </div> <!--End Heading background-------->
  
	<?php //pr($countryName['Country']['id']); ?>
	
	<div class="container back_user">
	 <div class="row">
	   <div class="col-sm-12 home-sidebar stock-list-side">
        <div class="slider1 brand-slider-bg">
		 <!--<a class="buttons prev" href="#"><img src='<?php echo $this->webroot;?>images/arw1.png' alt="" /></a>-->
		 <div class="viewport ">
		  <div class="sidebar-inner">
			   <?php if(count($brandDetail)>5)
				{
					$cls = 'bxslider';
				}
				else
				{
					$cls = '';
				}
				?>
			  
			  
			
			<ul class="overview <?php echo $cls; ?>">
				<li><h5> <?php if(isset($carType))
								echo "";
							else{ ?>
								 BRANDS AVAILABLE IN <?php echo $countryName['Country']['country_name'];}?></h5></li>
				<?php
				if(isset($carType))
				{
					
					if($carType == 8)
					{
						$activeClass = (isset($carType) ? "active" :"");
					}
					else if($carType == 9)
					{
						$activeClass = (isset($carType) ? "active" :"");   
					}
					else
					{
						$activeClass = (isset($carType) ? "active" :"");
					}
					 
					?>
					<li ><a class="<?php if($carType==8)
					echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allBrand','type'=>2,'vtype'=>8));?>"><i class="fa fa-angle-right">&nbsp;&nbsp;</i><?php echo "Bus Stock";?></a></li>
					
					<li ><a class="<?php if($carType==9)
					 echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allBrand','type'=>2,'vtype'=>9));?>"><i class="fa fa-angle-right">&nbsp;&nbsp;</i><?php echo "Dump Stock"?></a></li>
					
					<li ><a class="<?php  if($carType==10)
					 echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allBrand','type'=>2,'vtype'=>10));?>"><i class="fa fa-angle-right">&nbsp;&nbsp;</i><?php echo "Mixture Stock";?></a></li> 
				<?php }
				else{	
					
				 foreach($brandDetail as $keyBrandDet => $valBrandDet){
					$activeClass = (($brandName['Brand']['brand_name']==$valBrandDet['Brand']['brand_name']) ? "active" :"");
					$CurrentBrandName = $brandName['Brand']['brand_name'];
				
				?>
				
					<li ><a class="<?php echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allBrand','country'=>$countryName['Country']['id'],'brand'=>$valBrandDet['Brand']['id'],'type'=>$valBrandDet['Car']['car_type_id']));?>"><img src="<?php echo $this->webroot.$valBrandDet['Brand']['brand_image'];?>" alt="Logo" class="barnd-img-sty"><?php echo $valBrandDet['Brand']['brand_name'];?><?php echo " </br> (".$valBrandDet['0']['TotalCar'].")";?></a></li> 
					
				<?php }} ?>
				
			</ul>
		</div>
	  </div>
	 <!-- <a class="buttons next btn-next-sty" href="#"><img src='<?php echo $this->webroot;?>images/arw2.png' alt="" /></a>-->
	 </div>
	</div>
	
   <div style="clear:both;"></div>
	<div class="row car-details">
	 <div class="row">
	  <?php //if($brandCount!=0){?>
		<div class="row car-details" style="text-transform: uppercase; font-size: 18px;" >
			
					<?php //echo  "Total Brands : ".$brandCount;   echo  " "."Total Cars : ".$carCount;  ?>
		
			</div>
		<?php //};?>
			
			<!--<a class="btn btn-success pull-right go-back" href="<?php // echo $this->Html->url(array('controller'=>'home','action'=>'index'));?>">Go Back</a>-->
		
	
	<?php //pr($countryName['Country']['id']); ?>
	
	<!-- insert cut code -->
	
	<div class="col-sm-12 select-car">
		<h3 class="total-brand-bg"><span class="total-brand-txt"><i class="fa fa-taxi">&nbsp;&nbsp;</i>
			<?php echo  "Total Brands : ".$brandCount;   echo  " "."Total Cars : ".$carCount;  ?></span><span class="total-brand-txt"><i class="fa fa-taxi">&nbsp;&nbsp;</i><?php echo  " "."Selected Brand : ".$CurrentBrandName; ?></span></h3>
		<?php 
			$inArray = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
			foreach($carNames as $keyCarNameDet => $valCarNameDet){
			$fChar = strtoupper(substr($valCarNameDet['CarName']['car_name'], 0, 1));
			if(in_array($fChar,$inArray)) {
			if(isset($countryName)){
			$AcombineArr[$fChar][] = array('country'=>@$countryName['Country']['id'],'brand'=>@$brandName['Brand']['id'],'car_name'=>$valCarNameDet['CarName']['id'],'name'=>$valCarNameDet['CarName']['car_name']);
		 
		  }else{
			$AcombineArr[$fChar][] = array('type'=>$valCarNameDet['Car']['car_type_id'],'vtype'=>$valCarNameDet['Car']['vehicle_type_id'],'brand'=>@$brandName['Brand']['id'],'car_name'=>$valCarNameDet['CarName']['id'],'name'=>$valCarNameDet['CarName']['car_name']);  
		
			  
			  }
			} 
			} 
			?>
			<?php
			
			if(!empty($AcombineArr)){
			 foreach($AcombineArr as $keyComb => $valComb) {
				
				?>
			<ul>
			<li><?php echo $keyComb;?></li>
			<?php foreach($valComb as $keyComb1=> $valComb1){ 
				
				?>
			<?//php pr($valComb1); ?>
			<?php if(isset($valComb1['country'])){
				
				 ?>
			<li><a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'showAllCar','country'=>$valComb1['country'],'brand'=>$valComb1['brand'],'car_name'=>$valComb1['car_name']));?>"><?php echo $valComb1['name'];?></a></li>
		<?php }else{ ?>
		<li><a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'showAllCar','type'=>$valComb1['type'],'vtype'=>$valComb1['vtype'],'car_name'=>$valComb1['car_name']));?>"><?php echo $valComb1['name'];?></a></li>	
		<?php } ?>
		<?php } ?>	
</ul>	
<?php }}else{
	echo "No truck stock found";
	
	} ?>	
	</div>
</div>
</div>
</div>

<script type="text/javascript">
		$(document).ready(function()
		{
			//$('.slider1').tinycarousel();
			
			$('.bxslider').bxSlider({
				   minSlides: 1,
				  maxSlides: 5,
				  hideControlOnEnd:true,
				  slideWidth: 140,
				  slideMargin: 0,
				  infiniteLoop: true,
				  pager:false,
				  speed:1000
				  
		});
			
		});		
	</script>

