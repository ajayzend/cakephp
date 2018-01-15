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
			$('#slider2').tinycarousel({ display: 2, interval: true });			
		});		
	</script>
	
<script type="text/javascript">
		$(document).ready(function(){
			$('#slider3').tinycarousel({interval: true, axis: 'y'});
		});		
	</script>
	
	
<script>
$(document).ready(function(){
  $("#slider3 .overview li a").click(function(){
    $(".newarrival_form").fadeIn();
    });
$("#close").click(function(){
    $(".newarrival_form").fadeOut();
    });
	
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
<!--  Body Container Starts from here   -->
<div class="container">

<div class="row">


<div class="slideshow">
 <!-- Carousel
    ================================================== -->
     <!--======Slider======-->

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
      
         
      <div class="carousel-inner">
	  <?php 
				$i = 0;
			
	 foreach($homePages_slides as $item): ?>
        <div class="item <?php if($i==0) echo "active"; ?>">          
          <div class="container">
		  <div class="row">
		  <div class="col-md-6">
			    		<img class="bigImage" src="<?php echo $this->webroot."img/HomePageManagements/".$item['HomePageSlide']['image_source']?>" alt="" title="">
				       
		  
		  </div>		  
		  <div class="col-md-6">
            <div class="carousel-caption">
              <h1><?php echo $item['HomePageSlide']['slide_label'];?></h1>
			  <p> <?php
								if($item['Car']['car_name']==''){
									$name = explode("=>",$item['HomePageSlide']['slide_name']);
									echo $name[0]."<span>".$name[1]."</span>";
								}else{
									echo $item['Car']['car_name'];
								}
								
								?></p>
			  
              <p><?php echo $item['HomePageSlide']['description'];?></p> 
 			    
            </div>
			</div>
			</div>
          </div>
        </div>
		<?php $i++; endforeach; ?>
		
		
		
     
		
      </div>	  
	  
	 
    </div><!-- /.carousel -->
      
     
	  </div>
	  </div>
	  
	  <!--======Slider-end======-->  

<div class="row searchcountry">
			<h2>Search By Country</h2>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#home" data-toggle="tab" class="hint--top" data-hint="Japan (2030)"><img src="images/thumb_japan.jpg"/></a></li>
			  <li><a href="#profile" data-toggle="tab"  class="hint--top" data-hint="USA (4380)"><img src="images/thumb_usa.jpg"/></a></li>
			  <li><a href="#messages" data-toggle="tab" class="hint--top" data-hint="Germany (10380)"><img src="images/thumb_germany.jpg"/></a></li>
			  <li><a href="#settings" data-toggle="tab" class="hint--top" data-hint="UK (2040)"><img src="images/thumb_uk.jpg"/></a></li>
			</ul>
			<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="home">
					<!-- Tab1 -->  
					
					<div class="col-md-6">
					<img src="images/japanflag.jpg"/>					
					</div>
					
					<?php 
					foreach($Brand as $val){
						$MyBrand = $val['Brand']['brand_name'];
					
						}
					?>
					<div class="col-md-6">
					<h1>Japan (1256)</h1>
					
					<?php echo $this->Form->create('',array('url'=>array('controller'=>'home','action'=>'carsonbrand'))); ?>
					<div class="select-box">
					<table cellpadding="10" cellspacing="10">
					
					<tr>
					<td>
					<div class="checkbox">
					
						<?php echo $this->Form->input('Toyota',array('type'=>'checkbox','value'=>'Toyota','label'=>'Toyota(10)','name'=>'car[]')); ?>

				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					
					<?php echo $this->Form->input('Suzuki',array('type'=>'checkbox','value'=>'Suzuki','label'=>'Suzuki(105)','name'=>'car[]')); ?>
					 
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					
					<?php echo $this->Form->input('Mazda',array('type'=>'checkbox','value'=>'Mazda','label'=>'Mazda(95)','name'=>'car[]',)); ?>
					  
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					
					 <?php echo $this->Form->input('Daihatsu',array('type'=>'checkbox','value'=>'Daihatsu','label'=>'Daihatsu(125)','name'=>'car[]')); ?>
					
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					
					 
					    <?php echo $this->Form->input('Honda',array('type'=>'checkbox','value'=>'Honda','label'=>'Honda(15)','name'=>'car[]')); ?>
					
				    </div>
					</td>
					</tr>
					
					
					<tr>
					<td>
					<div class="checkbox">
					
					 
					    <?php echo $this->Form->input('Mitsubishi',array('type'=>'checkbox','value'=>'Mitsubishi','label'=>'Mitsubishi(21)','name'=>'car[]')); ?>
					
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					
					 
					  <?php echo $this->Form->input('Nissan',array('type'=>'checkbox','value'=>'Nissan','label'=>'Nissan(245)','name'=>'car[]')); ?>
					
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					
					 
					  <?php echo $this->Form->input('BENZ',array('type'=>'checkbox','value'=>'BENZ','label'=>'BENZ(445)','name'=>'car[]')); ?>
					
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					
						<?php echo $this->Form->input('BMW',array('type'=>'checkbox','value'=>'BMW','label'=>'BMW(140)','name'=>'car[]')); ?>
					 
				    </div>
					</td>
					
					</tr>					
									
					</table>
					</div>
										
						<!-- <ul>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" />BMW(10)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" />Toyota(105)</label></li>
							<li> <label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" />Nissan(95)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" />Honda(125)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" />Subaru(15)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_5" />Mazda(21)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_6" />Mitsubishi(245)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_7" />Daihatsu(445)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_8" />Lexus(140)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_9" />Isuzu(450)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Mercedes(475)</label></li>
						</ul> -->
						
						<div class="clearfix"></div>
						<div class="tab-selectall">
							<label class="pull-left">Select All</label>
							<?php echo $this->Form->input('Select All',array('type'=>'checkbox','name'=>'CheckboxGroup1','id'=>'CheckboxGroup1_10','label'=>false,'class'=>"pull-right")); ?>
							<!--<input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Select All</label>-->
							<?php echo $this->Form->submit('Search',array('type'=>'submit','class'=>"btn btn-danger",'lable'=>false,'id'=>'submitdata'));?>
							<?php echo $this->Form->end(); ?>
							<!--<button class="btn btn-danger" type="submit" >Search <i class="fa fa-search"></i></button>-->
						</div>
						</div>
						<div class="clearfix"></div>
						<!-- Tab 1 Ends-->
					</div>
					
					
					<div class="tab-pane" id="profile">
					<!-- Tab2 -->
					
					<div class="col-md-6">
					<img src="images/usaflag.jpg"/>					
					</div>
					
					
					<div class="col-md-6">
					<h1>USA (1256)</h1>
					
					<div class="select-box">
					<table cellpadding="10" cellspacing="10">
					<tr>
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> BMW(10)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Toyota(105)
					</label>
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Nissan(95)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Honda(125)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Subaru(15)
					</label>
				    </div>
					</td>
					</tr>
					
					
					<tr>
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Mazda(21)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Mitsubishi(245)
					</label>
				    </div>
					</td>
					
					
					<td>
					
					</td>
					
					<td>
					
				   
					</td>
					
					<td>
					
					</td>
					</tr>					
									
					</table>
					</div>
						<!-- <ul>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" />BMW(245)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" />Toyota(1145)</label></li>
							<li> <label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" />Nissan(147)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" />Honda(420)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" />Subaru(110)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_5" />Mazda(145)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_6" />Mitsubishi(200)</label></li>
						</ul> -->
						<div class="clearfix"></div>
						<div class="tab-selectall">
							<label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Select All</label>
							<button class="btn btn-danger" type="submit" >Search <i class="fa fa-search"></i></button>
						</div>
						</div>
						<div class="clearfix"></div>
						<!-- Tab 2 Ends-->
					</div>
					
					
					
					<div class="tab-pane" id="messages">
					
					<div class="col-md-6">
					<img src="images/germanflag.jpg"/>					
					</div>
					
					
					<!-- Tab3 -->
					<div class="col-md-6">
					<h1>German(1256)</h1>
					
					<div class="select-box">
					<table cellpadding="10" cellspacing="10">
					<tr>
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> BMW(10)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Toyota(105)
					</label>
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Nissan(95)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Honda(125)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Subaru(15)
					</label>
				    </div>
					</td>
					</tr>
					
					
					<tr>
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Mazda(21)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Mitsubishi(245)
					</label>
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox">Daihatsu(445)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Lexus(140)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Isuzu(450)
					</label>
				    </div>
					</td>
					</tr>					
									
					</table>
					</div>
					
						<!-- <ul>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" />Toyota(115)</label></li>
							<li> <label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" />Nissan(200)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" />Honda(201)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Mercedes(140)</label></li>
						</ul> -->
						<div class="clearfix"></div>
						<div class="tab-selectall">
							<label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Select All</label>
							<button class="btn btn-danger" type="submit">Search <i class="fa fa-search"></i></button>
						</div>
						</div>
						<div class="clearfix"></div>
							<!-- Tab 3 Ends-->
					</div>
					
					
					
					
					<div class="tab-pane" id="settings">
					
					<div class="col-md-6">
					<img src="images/ukflag.jpg"/>					
					</div>
					
					<!-- Tab4 -->
					
					<div class="col-md-6">
						<h1>UK (156)</h1>
						
						<div class="select-box">
					<table cellpadding="10" cellspacing="10">
					<tr>
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> BMW(10)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Toyota(105)
					</label>
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Nissan(95)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Honda(125)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Subaru(15)
					</label>
				    </div>
					</td>
					</tr>
					
					
					<tr>
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Mazda(21)
					</label>
				    </div>
					</td>
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox"> Mitsubishi(245)
					</label>
				    </div>
					</td>
					
					
					<td>
					<div class="checkbox">
					<label>
					  <input type="checkbox">Daihatsu(445)
					</label>
				    </div>
					</td>
					
					<td>
					
				    </div>
					</td>
					
					<td>
					
					</td>
					</tr>					
									
					</table>
					</div>
						<!-- <ul>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" />Toyota(120)</label></li>
							<li> <label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" />Nissan(130)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" />Honda(110)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" />Subaru(150)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_5" />Mazda(203)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_6" />Mitsubishi(250)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_7" />Daihatsu(300)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_8" />Lexus(450)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_9" />Isuzu(120)</label></li>
							<li><label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Mercedes(130)</label></li>
						</ul> -->
						<div class="clearfix"></div>
						<div class="tab-selectall">
							<label><input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_10" />Select All</label>
							<button class="btn btn-danger" type="submit">Search <i class="fa fa-search"></i></button>
						</div>
						</div>
						<div class="clearfix"></div>
<!-- Tab 4 Ends--></div>
			</div>
		</div>

<!-- quicksearch Section starts from here -->
<div class="row quicksearch">
	<h2>Quick Search</h2>
	<div class="quicksearchdiv">
		<form class="" role="form">
			<div class="col-lg-2 col-md-3">
				<span>Location</span>
				<select class="form-control">
					<option>Any</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select>
			</div>
			<div class="col-lg-2 col-md-3">
				<span>Company</span>
				<select class="form-control">
				  <option>Any</option>
				  <option>1</option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				</select>
			</div>
			<div class="col-lg-2 col-md-3">
				<span>Model</span>
				<select class="form-control">
					<option>Any</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="col-lg-5 col-md-2 nopadding">
				<div class="quicksmall">
					<span>Year</span>
					<select class="form-control">
						<option>Year</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="quickvsmall">To</div>
				<div  class="quicksmall">
					<span>&nbsp;</span>
					<select class="form-control">
						<option>Year</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="quicksmall">
					<span>Price</span>
					<select class="form-control">
						<option>Any</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div> 
				<div class="quickvsmall">To</div>
				<div class="quicksmall">
					<span>&nbsp;</span>
					<select class="form-control">
						<option>Any</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div> 
			<div class="col-lg-1 col-md-2 nopadding">
				<span>Find your car:</span>
				<button class="btn btn-danger btn-default" type="submit">Search <i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>
</div>
<!-- quicksearch Section Ends here -->
<div class="row typesearch">
			<h2>Search By Type</h2>
			
			
			<div id="slider2">
		<a class="buttons prev" href="#">left</a>
		<div class="viewport">
			<ul class="overview">
				<li>
				<a href="#">
				<img src="images/car_thum1.jpg" />
				<p>Wagon</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum2.jpg" />
				<p>Sedan</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum1.jpg" />
				<p>Van</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum4.jpg" />
				<p>Pickup/Truck</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum5.jpg" />
				<p>Convertible</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum6.jpg" />
				<p>Coupe/Hatchback</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum7.jpg" />
				<p>Bus</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum1.jpg" />
				<p>Wagon</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum2.jpg" />
				<p>Sedan</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum1.jpg" />
				<p>Van</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum4.jpg" />
				<p>Pickup/Truck</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum5.jpg" />
				<p>Convertible</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum6.jpg" />
				<p>Coupe/Hatchback</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum7.jpg" />
				<p>Bus</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum1.jpg" />
				<p>Wagon</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum2.jpg" />
				<p>Sedan</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum1.jpg" />
				<p>Van</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum4.jpg" />
				<p>Pickup/Truck</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum5.jpg" />
				<p>Convertible</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum6.jpg" />
				<p>Coupe/Hatchback</p>
				</a>
				</li>
				<li>
				<a href="#">
				<img src="images/car_thum7.jpg" />
				<p>Bus</p>
				</a>
				</li>
			</ul>
		</div>
		<a class="buttons next" href="#">right</a>
	</div>
			<!-- Sliderstarts from here -->
				
		<div class="clearfix"></div>
		<button class="btn btn-danger btn-default" type="submit">Search <i class="fa fa-search"></i></button>
		<div class="clearfix"></div>
		<!-- Sliderstarts Ends here -->
	</div>

<!-- quicksearch Section starts from here -->
<div class="row searchcountry">
	<div class="col-lg-9 col-md-9">
	<div class="row advancedsearch">
		<h2>Advanced Search</h2>
		<div class="row">
		<!-- Leftsection starts from here -->
			<div class="col-lg-6 col-md-6">
				<label class="">Made:</label>
				<input type="text" class="form-control" placeholder="Email address" required="">
				<label class="">Distance from Zipcode:</label>
				<input type="text" class="form-control" placeholder="Email address" required="">
				<label class="">Price Range:</label>
				<div class="pricerange"> <!--img src="images/pricerange.jpg" /--> 
					<input id="price_range" type="slider" name="price" value="30000.5;60000" />
				</div>
				<label class="">Date Range Selection:</label>
				<div class="datepicker ">
					<img src="images/datepicker.jpg" />
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 sorting">
						<label class="">Sort by:</label>
						<ul>
							<li><label class="radio"><input type="radio" value="remember-me">Best match</label></li>
							<li><label class="radio"><input type="radio" value="remember-me">popularity</label></li>
							<li><label class="radio"><input type="radio" value="remember-me">update date</label></li>
							<li><label class="radio"><input type="radio" value="remember-me">newest to Oldest</label></li>
							<li><label class="radio"><input type="radio" value="remember-me">Oldest to Newest</label></li>
						</ul>
					</div>
					<div class="col-lg-6 col-md-6 sorting">
						<label class="">Transmissions:</label>
							<ul>
								<li><label class="radio"><input type="radio" value="remember-me">Best match</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">popularity</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">update date</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">newest to Oldest</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">Oldest to Newest</label></li>
							</ul>
						</div>
					</div>
					<label class="">Refine by Keyword:</label>
					<input type="text" class="form-control" placeholder="Email address" required="">
					<button class="btn btn-danger btn-default" type="submit">Search <i class="fa fa-search"></i></button>
					<button class="btn btn-default" type="submit">Clean</button>
					<div class="clearfix"></div>
				</div>
				<!-- Leftsection Ends here -->
				<!-- rightsection starts from here -->
				<div class="col-lg-6 col-md-6">
					<label class="">Body Style:</label>
					<input type="text" class="form-control" placeholder="Email address" required="">
					<label class="">Year:</label>
					<input type="text" class="form-control" placeholder="Email address" required="">
					<label class="">Mileage:</label>
					<div class="pricerange"> 
						<input id="mileage" type="slider" name="price" value="500;1000000" />
					</div>
					<label class="">Conditions:</label>
					<div class="datepicker ">
						<img src="images/datepicker.jpg" />
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 sorting">
							<label class="">Sort by Color:</label>
							<ul>
								<li><label class="radio"><input type="radio" value="remember-me">Best match</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">popularity</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">update date</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">newest to Oldest</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">Oldest to Newest</label></li>
							</ul>
						</div>
						<div class="col-lg-6 col-md-6 sorting">
							<label class="">Sort by City:</label>
							<ul>
								<li><label class="radio"><input type="radio" value="remember-me">Best match</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">popularity</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">update date</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">newest to Oldest</label></li>
								<li><label class="radio"><input type="radio" value="remember-me">Oldest to Newest</label></li>
							</ul>
						</div>
					</div>
					<label class="">Credential:</label>
					<input type="text" class="form-control" placeholder="Email address" required="">
					<div class="clearfix"></div>
				</div>
				<!-- rightsection Ends here -->
			</div>
		</div>
	</div>
	<div class="col-sm-3">		<!-- newarrival Section starts from here -->
		<div class="newarrival">
		<h2>New Arrivals</h2>

<!--New Arrival Form-->		
<div class="newarrival_form" style="display:none">
<div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center">Request Form For This Car</h4> 
      </div>
      <div class="modal-body">
	  <p>Request any Used Car and we will buy it from the auction for you. </p>
	  <?php echo $this->Form->create('Home');?>
       
  <div class="form-group">
    <label for="exampleInputPassword1">Name: *</label>
    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','id'=>"exampleInputPassword1",'placeholder'=>"Enter Your Name",'label'=>false,'div'=>false,'required'=>true,'autocomplete'=>'off'));?>
    
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Email: *</label>
    <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control','id'=>"email",'placeholder'=>"Enter Your Email",'label'=>false,'div'=>false,'required'=>true,'autocomplete'=>'off'));?>
   
  </div> 
  
  <div class="form-group">
    <label for="exampleInputPassword1">Contact No: *</label>
     <?php echo $this->Form->input('cnumber',array('type'=>'text','class'=>'form-control','id'=>"contact",'placeholder'=>"Enter Your  Contact Number",'label'=>false,'div'=>false,'required'=>true,'autocomplete'=>'off'));?>
  </div> 
  <div class="form-group">
    <label for="exampleInputPassword1">Message: *</label>
     <?php echo $this->Form->input('message',array('type'=>'textarea','class'=>'form-control','id'=>"contact",'placeholder'=>"Enter Your Message",'label'=>false,'div'=>false,'required'=>true,'autocomplete'=>'off'));?>
  </div>
   

      </div>
      <div class="modal-footer">   
      <?php echo $this->Form->submit('Send',array('type'=>'submit','class'=>"btn btn-danger")); ?>    
       <?php echo $this->Form->end(); ?>
      </div>
    </div><!-- /.modal-content -->
</div>
<!--New Arrival Form-->		
<?//php pr($ImgDetail);?>
<!--images/new_arrival01.jpg-->
		<div id="slider3">		
		<div class="viewport">
			<ul class="overview">
				<?php foreach($ImgDetail as $val){?>
				
				<li>
				<a href="javascript:void(0);">
				<img src="<?php echo $this->webroot.'img/carimages/'.$val['CarImage']['image_name'];?>" />				
				</a>
				</li>
				<?php 
				
				}?>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival02.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival03.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival04.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival05.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival06.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival07.jpg"  />				
				</a>
				</li>	
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival01.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival02.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival03.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival04.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival05.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival06.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival07.jpg"  />				
				</a>
				</li>	
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival01.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival02.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival03.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival04.jpg"  />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival05.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival06.jpg" />				
				</a>
				</li>
				<li>
				<a href="javascript:void(0);">
				<img src="images/new_arrival07.jpg"  />				
				</a>
				</li>	

				
			</ul>
		</div>		
	</div>
		
	</div>
<!-- newarrival Section Ends here -->
</div>





	<!--<div class="col-lg-3 col-md-3 brandsection">
		<h3>All The brands</h3>
		<ul>
			<li><a href="#"><span>&#8250;</span> BMW</a></li>
			<li><a href="#"><span>&#8250;</span> Toyota</a></li>
			<li><a href="#"><span>&#8250;</span> Nissan</a></li>
			<li><a href="#"><span>&#8250;</span> Honda</a></li>
			<li><a href="#"><span>&#8250;</span> Subaru</a></li>
			<li><a href="#"><span>&#8250;</span> Mazda</a></li>
			<li><a href="#"><span>&#8250;</span> Mitsubishi</a></li>
			<li><a href="#"><span>&#8250;</span> Suzuki</a></li>
			<li><a href="#"><span>&#8250;</span> Daihatsu</a></li>
			<li><a href="#"><span>&#8250;</span> Lexus</a></li>
			<li><a href="#"><span>&#8250;</span> Isuzu</a></li>
			<li><a href="#"><span>&#8250;</span> Mercedes</a></li>
		</ul>
		<h3>Find a good price</h3>
		<ul>
			<li><a href="#"><span>&#8250;</span> More than $25,000 (622,481)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
			<li><a href="#"><span>&#8250;</span> $20,000-$25,000 (284,169)</a></li>
		</ul>
		<div class="fbfeeds"><img src="images/fbfeeds.jpg" /></div>
	</div>-->
</div>
<!-- quicksearch Section Ends here -->
<!--  Body Container Ends here 
<div class="featurelist">

</div>
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
		
		
		
		
