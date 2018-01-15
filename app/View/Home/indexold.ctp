<?php echo $this->Html->script('jquery-form'); ?>
<script type="text/Javascript">
$(function(){
 $("#locationId").change(function(){ 
  
		var id = $(this).val();
		
		var datas  =  {'id':id}; 
		$.ajax({
			url:"<?php echo $this->Html->url('/home/getMakeBrand/',true)?>"+$(this).val(),
			type:"POST",
			data:datas,
			success:function(result)
			{
				$('#makeId').html(result);
					
			}					
		});	
     });
 });
 
 $(function(){
 $("#makeId").change(function(){ 
  
		var id = $(this).val();
		var countryId = $("#locationId").val();
		var datas  =  {'id':id,'countryId':countryId}; 
		$.ajax({
			url:"<?php echo $this->Html->url('/home/getModelCar/',true)?>"+$(this).val(),
			type:"POST",
			data:datas,
			success:function(result)
			{
				$('#modelId').html(result);
					
			}					
		});	
     });
 });
</script>
<style type="text/css" media="screen">
	  body { background: #EEF0F7; }
	 .layout { padding: 50px; font-family: Georgia, serif; }
	 .layout-slider { margin-bottom: 60px; width: 50%; }
	 .layout-slider-settings { font-size: 12px; padding-bottom: 10px; }
	 .layout-slider-settings pre { font-family: Courier; }
	</style>
 <?php echo $this->Html->css(array('jslider', 'jslider.blue', 'jslider.plastic','jslider.round','jslider.round.plastic')); ?>
<?php echo $this->Html->script(array('jshashtable-2.1_src','jquery.numberformatter-1.2.3','tmpl', 'jquery.dependClass-0.1','draggable-0.1','jquery.slider','jquery.tinycarousel.min','jquery.als-1.2.min'));?>
<script type="text/javascript">
		$(document).ready(function(){			
			$('#slider2').tinycarousel({ display: 1, interval: true });	
			$.ajax({
				type: "GET",
				url: "<?php  echo $this->Html->url('/',true);?>home/arrivalDetails ",
				data: {},
                dataType:'JSON',
                
				success: function(data){
					console
					var content ="";
					for(var i in data)
					{
						//console.log(data[i].CarImage[0]['image_source']);
						content +='<li><a href="javascript:void(0);"><img  height="70%" width="80%" class="img-thumbnail" src="img/carimages/'+data[i].CarImage[0]['image_source']+'" /></a><h4>'+data[i].CarName.car_name+'</h4><p>'+data[i].Car.package+'</p><p>'+data[i].Car.manufacture_year+'</p></li>'; 
                     }
					//console.log(content);
					$("#arrival").html(content);
				}
			});		
		});		
	</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#slider3').tinycarousel({interval: true, axis: 'y'});
		});		
	</script>
			<script type="text/javascript">
			$(document).ready(function() 
			{
				$("#lista1").als({
					visible_items: 4,
					scrolling_items: 2,
					orientation: "vertical",
					circular: "yes",
					autoscroll: "yes",
					interval: 5000,
					direction: "up",
					start_from: 2
				});
			});
		</script>
	 

<script type="text/javascript" charset="utf-8">
     
     $(function(){
    
      jQuery("#price_range").slider({ from: 1000, to: 100000, step: 500, smooth: true, round: 0, dimension: "&nbsp;$", skin: "plastic" });
      jQuery("#mileage").slider({ from: 1000, to: 100000, step: 500, smooth: true, round: 0, skin: "plastic" });
    });
    </script>
	
	
	<script>
/*
$(document).ready(function(){
  $(".brands li a").click(function(){
	  alert('ashokkkkkkk');
    $(".details").fadeIn();
	$(".brands li img").addClass("active_effects");
	$(this).children().removeClass('active_effects');
	$(this).parent().addClass('active');	
    });
	
  $(".nav-tabs > li > a").click(function(){
    $(".brands li img").removeClass("active_effects");
	$(".nav-tabs > li > a").addClass("active_effects");	
	$(this).removeClass('active_effects');	
    });
	

$(".nav-tabs > li > a").click(function(){
    $(".details").hide();
    });
	
});
*/

function showCarName(){
  $(".brands li a").click(function(){
	 // alert('ashokkkkkkk');
    $(".details").fadeIn();
	$(".brands li img").addClass("active_effects");
	$(this).children().removeClass('active_effects');
	$(this).parent().addClass('active');	
    });
	
  $(".nav-tabs > li > a").click(function(){
    $(".brands li img").removeClass("active_effects");
	$(".nav-tabs > li > a").addClass("active_effects");	
	$(this).removeClass('active_effects');	
    });
	

$(".nav-tabs > li > a").click(function(){
    $(".details").hide();
    });
	
};
</script>	
<!--  Body Container Starts from here   -->
<div class="slideshow">
 <!-- Carousel
    ================================================== -->
     <!--======Slider======-->

  <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner">
	  <?php 
				$i = 0;
		//pr($homePages_slides);
			
	 foreach($homePages_slides as $item): ?>
	 
        <div class="item <?php if($i==0) echo "active"; ?>">          
          <div class="">
		  <div class="row">		  
		<img class="bigImage img-responsive" src="<?php echo $this->webroot."img/HomePageManagements/".$item['HomePageSlide']['image_source']?>" alt="" title="">	       
		</div>
          </div>
        </div>
		<?php $i++; endforeach; ?>
      </div>
	  <!--Controls-->
	 <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->
</div>
  <!--======Slider-end======-->  


<div class="container">
	
<div class="row searchcountry">

		<div class="page-title">
			<h2>Search By Country</h2>
		</div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
			 <!-- <li><a href="#home" data-toggle="tab"><img src="images/russia-tab-bg.jpg"/><strong>Russia</strong></a></li>
			  <li><a href="#profile" data-toggle="tab" ><img src="images/usa-tab-bg.jpg"/><strong>USA</strong></a></li>
			  <li><a href="#messages" data-toggle="tab" ><img src="images/chile-tab-bg.jpg"/><strong>Chile</strong></a></li>
			  <li><a href="#settings" data-toggle="tab" ><img src="images/others_tab.jpg"/><strong>Others</strong></a></li> -->
			  <?php 
				foreach($carDetail as $key=>$value){  
					 ?>
					<li><a href="#home" data-toggle="tab"><img onClick="getBrandName('<?php echo $value['Car']['country_id']?>');" src="<?php echo @$value['Country']['country_image'];?>"/><strong><?php echo @$value['Country']['country_name'];?></strong></a></li>
			  
				<?php }?>
			  <li><a href="#settings" data-toggle="tab" ><img src="images/others_tab.jpg"/><strong>Others</strong></a></li>
			</ul>
			<!-- Tab panes -->
			
			<div style="display:none;" id="fountainG">
				<div id="fountainG_1" class="fountainG">
				</div>
				<div id="fountainG_2" class="fountainG">
				</div>
				<div id="fountainG_3" class="fountainG">
				</div>
				<div id="fountainG_4" class="fountainG">
				</div>
				<div id="fountainG_5" class="fountainG">
				</div>
				<div id="fountainG_6" class="fountainG">
				</div>
				<div id="fountainG_7" class="fountainG">
				</div>
				<div id="fountainG_8" class="fountainG">
				</div>
			</div>
				<div class="tab-content">
					<div class="tab-pane" id="home">
					<!-- Tab1 -->  
			
					<div class="">
						<ul class="brands" id="brandsUlId">
							
							<!--<li><a href="javascript:void(0);"><img src="images/toyota-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/nissan-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/honda-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/subaru-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/mazda-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/mitsubishi-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/suzuki-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/daihatsu-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/lexus-brand.jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/brand1.jpg"/></a></li>-->					
						</ul>
					</div>
					
					
					
						<div class="clearfix"></div>
						<!-- Tab 1 Ends-->
					</div>
					
					
					<div class="tab-pane" id="profile">
					<!-- Tab2 -->
					
					<div class="">
					<ul class="brands">
					<li><a href="javascript:void(0);"><img src="images/nissan-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/toyota-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/subaru-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/honda-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/brand1.jpg"/></a></li>		
					<li><a href="javascript:void(0);"><img src="images/mazda-brand.jpg"/></a></li>					
					<li><a href="javascript:void(0);"><img src="images/suzuki-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/daihatsu-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/lexus-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/mitsubishi-brand.jpg"/></a></li>		
					</ul>				
					</div>
									
						<div class="clearfix"></div>
						<!-- Tab 2 Ends-->
					</div>
					
					
					
					<div class="tab-pane" id="messages">
					
					<div class="">
					<ul class="brands">
					<li><a href="javascript:void(0);"><img src="images/mitsubishi-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/lexus-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/nissan-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/honda-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/brand1.jpg"/></a></li>	
					<li><a href="javascript:void(0);"><img src="images/subaru-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/mazda-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/toyota-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/suzuki-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/daihatsu-brand.jpg"/></a></li>					
									
					</ul>				
					</div>
					
					
					<!-- Tab3 -->
					
						
							<!-- Tab 3 Ends-->
					</div>
					
					
					
					
					<div class="tab-pane" id="settings">
					
					<div class="">
					<ul class="brands">
					<li><a href="javascript:void(0);"><img src="images/mazda-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/toyota-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/nissan-brand.jpg"/></a></li>					
					<li><a href="javascript:void(0);"><img src="images/subaru-brand.jpg"/></a></li>					
					<li><a href="javascript:void(0);"><img src="images/mitsubishi-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/suzuki-brand.jpg"/></a></li>					
					<li><a href="javascript:void(0);"><img src="images/daihatsu-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/lexus-brand.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/brand1.jpg"/></a></li>
					<li><a href="javascript:void(0);"><img src="images/honda-brand.jpg"/></a></li>					
					</ul>					
					</div>
					
					<!-- Tab4 -->
															
						</div>
						
<!-- Tab 4 Ends--></div>
			</div>
		<div class="details row" style="display:none;">		
		<div style="display:none;" id="fountainGg">
				<div id="fountainG_1" class="fountainG">
				</div>
				<div id="fountainG_2" class="fountainG">
				</div>
				<div id="fountainG_3" class="fountainG">
				</div>
				<div id="fountainG_4" class="fountainG">
				</div>
				<div id="fountainG_5" class="fountainG">
				</div>
				<div id="fountainG_6" class="fountainG">
				</div>
				<div id="fountainG_7" class="fountainG">
				</div>
				<div id="fountainG_8" class="fountainG">
				</div>
			</div>
		<div class="clearfix"></div>						
				<ul class="car_name" id="carNameUlId">
					
					<!--<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car"> DUALIS  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > JUKE  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > MARCH  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > NOTE  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > TIIDA  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > DUALIS  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > JUKE  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car" > MARCH  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car;" > NOTE  </a></li>
					<li><a href="<?php echo $this->Html->url('/',true); ?>pages/edit_car"> TIIDA  </a></li>
					-->
				</ul>
					
		</div>
		<div class="row typesearch">
			<div class="col-sm-9">
				<h2>New Arrivals</h2>
				<div id="slider2">
					<a class="buttons prev" href="#">left</a>
					<div class="viewport col-md-12">
						<ul class="overview" id="arrival">
							<li><a href="javascript:void(0);"><img src="images/new_arrival01.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival02.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival03.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival04.jpg" class="img-thumbnail" /></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival05.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival06.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival01.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival02.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival03.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival04.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival05.jpg" class="img-thumbnail"/></a></li>
							<li><a href="javascript:void(0);"><img src="images/new_arrival06.jpg" class="img-thumbnail"/></a></li>  
						</ul>
					</div>
					<a class="buttons next" href="#">right</a>
				</div>
				<!-- Sliderstarts Ends here -->
			</div>
			<div class="col-sm-3">
				<h2>Quick Search</h2>
					<form id="quickSearchForm" class="form-horizontal">
						<div class="form-group">
							<label for="locationId" class="col-sm-12">Country(Location)</label>
							<div class="col-sm-12">
							  <?php 
										$arr=array();
										foreach ($carDetail as $keyCarDet=>$valCarDet)
										{		
											
											$arr[@$valCarDet['Country']['id']] = @$valCarDet['Country']['country_name'];
											
										}

								echo $this->Form->input('country_name',array('type'=>'select','empty'=>'Any','options'=>$arr,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'locationId')); 	
								?>
							</div>
						</div>
				 
						<div class="form-group">
							<label for="makeId" class="col-sm-12">Make</label>
							<div class="col-sm-12">
							  <?php 
									$arrBrand = array();
									foreach($Brand as $keyBrand=>$valBrand){
										$arrBrand[$valBrand['Brand']['id']] = $valBrand['Brand']['brand_name'];
										//pr($valBrand['Brand']['brand_name']);
									}	

								echo $this->Form->input('brand_name',array('type'=>'select','empty'=>'Any','options'=>$arrBrand,'class'=>'form-control','label'=>false,'div'=>false,'data-rel'=>'chosen','id'=>'makeId')); 	
								?>
							</div>
						</div>
				
						<div class="form-group">
							<label for="modelId" class="col-sm-12">Model</label>
							<div class="col-sm-12">
							  <?php 
										
								$arrCarModel = array();
								echo $this->Form->input('model',array('type'=>'select','empty'=>'Any','options'=>$arrCarModel,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'modelId')); 	
								?>
							</div>
						</div>
				
						<div class="form-group">
							<label for="yearFromId" class="col-sm-12">Year From</label>
							<div class="col-sm-5">
							  <?php 
										
									$arrYearFrom = array('2014'=>'2014','2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010','2009'=>'2009','2008'=>'2008','2007'=>'2007','2006'=>'2006');
								echo $this->Form->input('yearFrom',array('type'=>'select','empty'=>'Any','options'=>$arrYearFrom,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearFromId',)); 	
								?>
							</div>
							<label class="col-sm-2 control-label">To</label>
							<div class="col-sm-5">
								<?php 
										
								$arrYearTo = array('2014'=>'2014','2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010','2009'=>'2009','2008'=>'2008','2007'=>'2007','2006'=>'2006');
								echo $this->Form->input('yearTo',array('type'=>'select','empty'=>'Any','options'=>$arrYearTo,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearToId')); 	
								?>	
							</div>
						</div>
				
						<!--<div class="form-group">
							<label for="" class="col-sm-12">Price Range</label>
							<div class="col-sm-5">
							  <?php 
									$arrPriceTo = array('0'=>'US$ 0','1000'=>'US$ 1,000','2000'=>'US$ 2,000','3000'=>'US$ 3,000','5000'=>'US$ 5,000','10000'=>'US$ 10,000','20000'=>'US$ 20,000');	

								echo $this->Form->input('priceFrom',array('type'=>'select','empty'=>'Any','options'=>$arrPriceTo,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'yearFromId')); 	
								?>
							</div>
							<label class="col-sm-2 control-label">To</label>
							<div class="col-sm-5">
								<?php 
										
									$arrPriceFrom = array('1000'=>'US$ 1,000','2000'=>'US$ 2,000','3000'=>'US$ 3,000','5000'=>'US$ 5,000','10000'=>'US$ 10,000','20000'=>'US$ 20,000');
								echo $this->Form->input('priceTo',array('type'=>'select','empty'=>'Any','options'=>$arrPriceFrom,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'priceToId')); 	
								?>	
							</div>
							<div class="clearfix"></div>
						</div>-->
				
						<div class="form-group">
							<label for="quickCCId" class="col-sm-12">CC</label>
							<div class="col-sm-12">
							  <?php 
									$arrCc = array('1000'=>'1000 CC and Less','1500'=>'1000 CC - 1500 CC','1500'=>'1500 CC - 1800 CC','1800'=>'1800 CC - 2000 CC','2000'=>'2000 CC - 2500 CC','2500'=>'2500 CC - 4000 CC','4000'=>'4000 CC and Over');

									echo $this->Form->input('cc',array('type'=>'select','empty'=>'Any','options'=>$arrCc,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','div'=>false,'id'=>'quickCCId')); 	
								?>
							</div>
						</div>
						<button type="button" class="btn btn-danger" onClick="quickSearch();">Quick Searching</button>
					</form>
				
	</div>
	</div>
<!--  Body Container Ends here 
  -->
</div>
		<script>/*
        $('#submitdata').click(function(event) {
       form = $("#CountryId").serialize();

     $.ajax({
       type: "POST",
       url: "<?php  echo $this->Html->url('/',true);?>home/CarsOnBrand ",
       data: form,

       success: function(data){

       }

     });
     event.preventDefault();
     return false;  //stop the actual form post !important!

  });
*/
		</script>
		<script>
/*

   $('input').click(function(){
       var SearchString = "";
       $('input').each(function(){
          if( $(this).is(':checked') )
              SearchString = SearchString + " AND tagField = " + $(this).val();
       });
       $.ajax({url: '<?php  echo $this->Html->url('/',true);?>home/CarsOnBrand',
               data: {SearchVal: SearchString},
               success: function(data){
                            //update your html with returned query results in 'data'
                         };
       });
   });
	
		
		*/
		</script>
		
		
		
	<script>
		function getBrandName(countryId){
			//alert(countryId);
			
			var str='';
			$.ajax({
				type: "POST",
				url: "<?php  echo $this->Html->url('/',true);?>home/gatBrandDetail ",
				data: {'countryId':countryId},
                dataType:'json',
                beforeSend:function(){ 
						  $('#fountainG').show('');
						},
				success: function(data){
					console.log(data);
					for(var i in data.brands)
					{
						
						//str+= '<li><a  href="javascript:void(0);" onClick="getCarName('+data.country_id+','+data.brands[i].Car.brand_id+')"><img onClick="showCarName()" src="'+data.brands[i].Brand.brand_image+'"/></a></li>';
						str+= '<li><a  href="<?php  echo $this->Html->url('/',true);?>home/allBrand/'+data.country_id+'/'+data.brands[i].Car.brand_id+'"><img onClick="showCarName()" src="'+data.brands[i].Brand.brand_image+'"/></a></li>';
						//console.log(data.brands[i].Brand);
						
					}
					  
					
					$("#brandsUlId").html(str);
					$('#fountainG').hide();
				}
			});
		}
		
		function getCarName(countryId,brandId){
			//alert(countryId);
			//alert(brandId);
			//alert('Ashok');
			var str='';
			$.ajax({
				type: "POST",
				url: "<?php  echo $this->Html->url('/',true);?>home/getCarName",
				data: {'countryId':countryId,'brandId':brandId},
				beforeSend:function(){ 
						  $('#fountainGg').show('');
						},
                dataType:'json',
				success: function(data){
					console.log(data);
					
					for(var i in data.carNames)
					{
						str+= '<li><a href= "<?php  echo $this->Html->url('/',true);?>home/showAllCar/'+data.country_id+'/'+data.brand_id+'/'+data.carNames[i].Car.car_name_id+'"> '+data.carNames[i].CarName.car_name+'  </a></li>';
						//str+= '<li><a href= "<?php  echo $this->requestAction('/home/showAllCar');?>"> '+data.carNames[i].CarName.car_name+'  </a></li>';
						//alert(data.carNames[i].CarName.car_name);
					}
					$("#carNameUlId").html(str);
					$('#fountainGg').hide(); 
				}
			});
			
		}

	function quickSearch(){
		$("#quickSearchForm").ajaxSubmit({
			url:"<?php echo $this->Html->url('/home/quickSearch',true);?>",
			type:"POST",
			dataType:'JSON',
			success:function(data){
				alert(data);
				
				
			
			}
			
		});	
	}

	</script>
	
	
