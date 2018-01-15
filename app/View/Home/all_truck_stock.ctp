<script type="text/javascript">
		
		$(document).ready(function()
		{
			/*$('.slider1').tinycarousel({ infinite: true});
			var n = $( ".count" ).size();
			if(n/2 != 8)
			{
				$(".mirrored").remove(); 
				//$("ul.overview ").attr("disabled","disabled");
				//$("#next").attr("disabled","disabled"); 
			}*/
			
			
			$('.bxslider').bxSlider({
		  minSlides: 1,
		  maxSlides: 2,
		  hideControlOnEnd:true,
		  slideWidth: 140,
		  slideMargin: 0,
		  infiniteLoop: false,
		  pager:false
		  
});	
		});
		
		/*$("#prev").click(function (e) {
         if ($("#prev").attr("disabled") == "disabled") {
             e.preventDefault();
			 }
		 });
     
     $("#next").click(function (e) {
         if ($("#next").attr("disabled") == "disabled") {
             e.preventDefault();
			 }
		 });

*/

</script>
<div class="bg-car"> <!--car background-------->
<div class="heading-bg">  <!--Heading background-------->
<div class="container back_user">
    <div class="col-sm-12 stock-list-head">
		<header class="section-header">
		<div class="animated animation-done bounceInLeft" data-animation="bounceInLeft"> <i class="fa fa-autologo"></i> </div>
		 <h2 class="stock-heading"> 
			 <?php 
		
			echo "Truck Stock"; ?>
			
			</h2>
		</header>
	</div>
   </div>
  </div> <!--End Heading background-------->
      <div class="container back_user">
	   <div class="row">
		<div class="col-sm-12">
		 <div class="row">
			<?php
					if(@$carType == 8)
					{
						$activeClass = (isset($carType) ? "active" :"");
					}
					else if(@$carType == 9)
					{
						$activeClass = (isset($carType) ? "active" :"");   
					}
					else if(@$carType == 10)
					{
						$activeClass = (isset($carType) ? "active" :"");
					}	 
					?>
					<div class="home-sidebar top-tabs col-sm-12" style="border-right:0px;">
					<ul><li><a class="<?php if(@$carType==8)
					echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allTruckStock','type'=>2,'vtype'=>8));?>"><?php echo "Bus Stock";?></a></li>
					
					
					<li><a class="<?php if(@$carType==9)
					 echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allTruckStock','type'=>2,'vtype'=>9));?>"><?php echo "Dump Stock"?></a></li>
					
					
					<li><a class="<?php  if(@$carType==10)
					 echo $activeClass;?>" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allTruckStock','type'=>2,'vtype'=>10));?>"><?php echo "Mixture Stock";?></a></li></ul>
						</div>
		
	</div>
	</div>
	<div style="clear:both;"></div>
	<div style="width:100%; height:40px;"></div>
	<div style="clear:both;"></div>

	
	 <div class="col-sm-12 home-sidebar stock-list-side">
	   <div class="slider1 brand-slider-bg">
	   <!-- <a class="buttons prev"  id="prev" href="#"><img src='<?php echo $this->webroot;?>images/arw1.png' alt="" /></a>-->
	     <div class="viewport">
		  <div class="sidebar-inner" style="text-align:center;">
			  <?php if(count($brandDetail)>5)
				{
					$cls = 'bxslider';
				}
				else
				{
					$cls = '';
				}
				?>
			  
			  
			  
			  
			<?php if($brandDetail)
				{	?>
				<ul class="overview <?php echo $cls; ?>">
					
					<?php
					
					 foreach($brandDetail as $keyBrandDet => $valBrandDet)
					 {
						@$activeClass = (($brandName['Brand']['brand_name']==$valBrandDet['Brand']['brand_name']) ? "active" :"");
						@$CurrentBrandName = $brandName['Brand']['brand_name'];
					
					?>
					 
						<li ><a class="<?php echo $activeClass;?> count" href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'allTruckStock','brand'=>$valBrandDet['Brand']['id'],'type'=>$valBrandDet['Car']['car_type_id'],'vtype'=>$valBrandDet['Car']['vehicle_type_id']));?>"><img src="<?php echo $this->webroot.$valBrandDet['Brand']['brand_image'];?>" alt="Logo" class="barnd-img-sty"><br/><?php echo $valBrandDet['Brand']['brand_name'];?><?php echo "</br> (".$valBrandDet['0']['TotalCar'].")";?></a></li> 
						
					<?php }?>
				</ul>
			<?php }else{?>
				<span class="total-brand-txt"><h2><i class="fa fa-truck">&nbsp;&nbsp;</i>
					No Brands Found</span></h2>
				<?php	} ?>
				
		</div>
	</div>
	<!--<a class="buttons next btn-next-sty" id='next' href="#"><img src='<?php echo $this->webroot;?>images/arw2.png' alt="" /></a>-->
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
		<?php echo  "Total Brands : ".$brandCount;   echo  " "."Total Cars : ".$carCount;  ?></span><span class="total-brand-txt"><i class="fa fa-taxi">&nbsp;&nbsp;</i><?php echo  " "."Selected Brand : ".@$CurrentBrandName; ?></span></h3>
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
		<li><a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'showAllCar','type'=>$valComb1['type'],'vtype'=>$valComb1['vtype'],'brand'=>$valComb1['brand'],'car_name'=>$valComb1['car_name']));?>"><?php echo $valComb1['name'];?></a></li>	
		<?php } ?>
		<?php } ?>	
</ul>	
<?php }}else{?>
	<span class="total-brand-txt"><i class="fa fa-taxi">&nbsp;&nbsp;</i>
					No Truck stock Found</span>
	
	<?php } ?>	
	</div>
</div>
</div>
</div>

