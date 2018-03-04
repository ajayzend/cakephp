<?php
?>
<script src="<?php echo $this->webroot;?>js/zoom.js"></script>
<style>
   .black_overlay{
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: absolute;
        top: 17%;
        left: 7%;
        width: 87%;
        height: 53%;
        padding: 1px;
        border: 1px solid green;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }


</style>
<?php $height = "style=\"height:20px; overflow:hidden;\""; ?>
<?php $height_td = "style=\"height:20px; overflow:hidden;color:green\""; ?>
<?php $label_color = "style=\"background-color: #d5d5d5\""; ?>
<div id="fade" class="black_overlay"></div>
<div id="light" class="white_content">
    <div align="right">
    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
    </div>
<table class="table <!--table-striped--> table-bordered bootstrap-datatable datatable custom_table">
    <tr>
        <td <?php echo $label_color;?> ><div <?php echo $height;?>>POWER STEERING</div></td>
        <td style="width: 100px;"><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['power_steering'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['power_steering'] == '2'){echo 'No';};?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>AIR CONDITION</div></td>
        <td style="width: 100px;"><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['air_condition'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['air_condition'] == '2'){ echo 'N0'; } ;?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ALLOY WHEEL</div></td>
        <td style="width: 100px;"><div <?php echo $height_td;?>><?php echo $showAllArrival[0]['Car']['alloy_wheel'];?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>INTERIOR COLOR</div></td>
        <td style="width: 100px;"><div <?php echo $height_td;?>><?php echo $showAllArrival[0]['Car']['interior_color'];?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>TV</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['tv'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['tv'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>KEYLESS ENTRY</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['keyless_entry'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['keyless_entry'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>AERO KIT</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['aero_kit'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['aero_kit'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>REAR PARKING CAMERA</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['rear_parking_camera'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['rear_parking_camera'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>POWER DOOR</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['power_door'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['power_door'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SEAT HEATER</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['seat_heater'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['seat_heater'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SPARE KEY</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['spare_key'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['spare_key'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ROOF RAILS</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['roof_rails'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['roof_rails'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>PARKING SENSOR</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['parking_sensor'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['parking_sensor'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>POWER WINDOW</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['power_window'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['power_window'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>POWER SEATS</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['power_seats'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['power_seats'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>MAINTENANCE RECORD</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['maintenance_record'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['maintenance_record'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ABS(ANTI BREAK SYSTEM)</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['anti_break_system'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['anti_break_system'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>AIRBAGS</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['airbags'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['airbags'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>NAVIGATION</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['navigation'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['navigation'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>CD PLAYER</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['cd_player'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['cd_player'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SLIDING DOOR</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['sliding_door'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['sliding_door'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SMART KEY SYSTEM</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['smart_key_system'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['smart_key_system'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>AUTOMATIC DOOR</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['automatic_door'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['automatic_door'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>LOW DOWN</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['low_down'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['low_down'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>BODY KIT</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['body_kit'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['body_kit'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>REAR SPOILER</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['rear_spoiler'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['rear_spoiler'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>WIND BREAKER</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['wind_breaker'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['wind_breaker'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>NO SMOKING</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['no_smoking'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['no_smoking'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ONE OWNER</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['one_owner'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['one_owner'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ATS(ANTI THEFT SYSTEM)</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['anti_theft_system'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['anti_theft_system'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>LEATHER SEATS</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['leather_seats'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['leather_seats'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>LIGHT</div></td>
        <td><div <?php echo $height_td;?>><?php echo $showAllArrival[0]['Car']['light'];?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>MD/MD CHANGER</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['md_changer'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['md_changer'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>BENCH SEATS</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['bench_seats'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['bench_seats'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>DOUBLE AIR CONDITION</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['double_air_condition'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['double_air_condition'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SUNROOF</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['sunroof'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['sunroof'] == '2'){echo 'No';} ?></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ESC</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['electronic_stability_control'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['electronic_stability_control'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SPARE TYRE</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['spare_tyre'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['spare_tyre'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>FOG LAMP</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['fog_lamp'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['fog_lamp'] == '2'){echo 'No';} ?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>MUD FLAP</div></td>
        <td><div <?php echo $height_td;?>><?php if($showAllArrival[0]['Car']['mud_flap'] == '1'){echo 'Yes';}if($showAllArrival[0]['Car']['mud_flap'] == '2'){echo 'No';} ?></div></td>
    </tr>


    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>ENGINE CONDITION</div></td>
        <td><div <?php echo $height_td;?> ><?php echo $showAllArrival[0]['Car']['engine_condition'];?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>AUTOMATIC CONDITION</div></td>
        <td><div <?php echo $height_td;?> ><?php echo $showAllArrival[0]['Car']['automatic_condition'];?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>RUST(BODY)</div></td>
        <td><div <?php echo $height_td;?> ><?php echo $showAllArrival[0]['Car']['rust_body'];?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>RUST(ENGINE)</div></td>
        <td><div <?php echo $height_td;?> ><?php echo $showAllArrival[0]['Car']['rust_engine'];?></div></td>
    </tr>


    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>EXTERIOR COLOR</div></td>
        <td><div <?php echo $height_td;?> ><?php echo $showAllArrival[0]['Car']['exterior_color'];?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>SEATING CAPACITY</div></td>
        <td><div <?php echo $height_td;?>><?php echo $showAllArrival[0]['Car']['seating_capacity'];?></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>></div></td>
        <td><div <?php echo $height;?>></div></td>
        <td <?php echo $label_color;?>><div <?php echo $height;?>></div></td>
        <td><div <?php echo $height;?>></div></td>
    </tr>

    <tr>
        <td <?php echo $label_color;?>><div <?php echo $height;?>>REMARK</div></td>
        <td colspan="7"><div <?php echo $height_td;?>><?php echo $showAllArrival[0]['Car']['remarks'];?></div></td>
    </tr>
</table>
</div>

<div class="col-lg-3 ProductDetailLeftPanel">
    <ul>
    <?php

    if(!empty($showAllArrival[0]['CarImage'])){
        $str = array();
        $srn = 0;

    $counts = count($showAllArrival[0]['CarImage']);

         foreach($showAllArrival[0]['CarImage'] as $key1=>$value1){
            $imageSrc = $value1['image_source']; 
            if($this->UserAuth->isLogged())
            {

            $str[] = $this->webroot.$value1['image_source']?>
           
                <li <?php print $srn ?> data-target="#carouselExampleControls" data-slide-to="<?=$srn?>">
                    <img src="<?php echo $this->webroot.$imageSrc;?>" class="more-images"/>
                </li>

           
        <?php
           }else if($srn<$counts-1){ 
            $str[] = $this->webroot.$value1['image_source']?>


 <li <?php print $srn ?> data-target="#carouselExampleControls" data-slide-to="<?=$srn?>">
                    <img src="<?php echo $this->webroot.$imageSrc;?>" class="more-images"/>
                </li>
<?php
            }
           
        $srn++;
        }
    }
    ?>
    </ul>
</div>


<div class="col-lg-6 ProductDetailLeftPanel">
	<div class=""> 
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
			<?php
            if(!empty($showAllArrival[0]['CarImage'])){
                $str = array();
                $srn = 0;
                $countss = count($showAllArrival[0]['CarImage']);
                foreach($showAllArrival[0]['CarImage'] as $key1=>$value1){
                   
                    $imageSrc = $this->webroot.$value1['image_source'];
                    if($this->UserAuth->isLogged())
                    {
			$str[] = $this->webroot.$value1['image_source'];
?>
                     <li  class="carousel-item text-xs-center <?php if($srn == 1 ) { echo "active"; } ?>" >
                    <img src="<?=$imageSrc?>" data-toggle="magnify" style="max-width:100%; height:500px; margin:0px auto" alt="<?php echo $showAllArrival[0]['CarName']['car_name']?>" />
                    </li>
<?php
                    }
                    else if($srn<$countss-1)
                    {

                ?>
                    <div class="carousel-item text-xs-center <?php if($srn == 1 ) { echo "active"; }?>">
                        <img data-toggle="magnify" style="max-width:100%; height:500px; margin:0px auto" src="<?=$imageSrc?>" alt="<?php echo $showAllArrival[0]['CarName']['car_name']?>">
                    </div>
                <?php
                    }

 $srn++;
                }
            }
            else
            {
                ?>
                <img class="d-block img-fluid" src="<?php echo $this->webroot;?>images/new_arrival01.png"/>
                <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	        <img class="d-block img-fluid text-xs-center" src="<?=$this->base?>/images/left_arrow.png">
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        	<img class="d-block img-fluid text-xs-center" src="<?=$this->base?>/images/right_arrow.png">
        </a>
    </div>
</div>
</div>

<div class="pull-xs-right ProductDetailRightPanel col-lg-3">
	<?php
	if($showAllArrival[0]['Car']['new_arrival'] == 1)
	{
	?>
    <div class="HomePageNewTag" style="margin-bottom:15px;">New</div>
    <?php
	}
	?>
    <div class="col-lg-12">
        <h1 class="ProductDetailProductName"><?php echo $showAllArrival[0]['CarName']['car_name']?></h1>
        <!--<div align="right">
            <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
                <button style="background: #55b640;margin-top:7px;">More Detail</button></a>
        </div>-->

    </div>
    <?php  
    if($this->UserAuth->isLogged()){
    ?>
    <div class="HomePageStockIdDiv" style="margin-right:15px;">FOB Price</div>
    <div class="ProductDetailBidPrice">
	<?php
    if($this->Session->read('LANGUAGE') == 2)
	{
		echo "$ ". $this->Round->round_number(($showAllArrival[0]['CarPayment'][0]['asking_price']+ADDITIONAL_PRICE));
	}
	else
	{
		echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(($showAllArrival[0]['CarPayment'][0]['yen']+ADDITIONAL_YEN_PRICE));
	}
	?>
    </div>

    <div class="col-lg-12 DivPadding5PX HomePageCarTypeDiv">Inclusive of Processing Charges</div>

    <?php } ?>

    <!--<h1 class="PageTitle">Features and <span>Details</span></h1>-->
    
     <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Brand</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Brand']['brand_name'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Package</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['package'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>
    
    
    <?php if($this->UserAuth->isLogged())
        {
        ?>
    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Chassis-No</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['cnumber'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Model-Type</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo substr($showAllArrival[0]['Car']['cnumber'],0 , 6); ?></div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php } ?>

    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">CC</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['cc'];?> CC</div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Year/Month</div>
            <div class="pull-xs-right ProductDetailSpectfValue">
            <?php
             @$b = explode(' ',$showAllArrival[0]['Car']['manufacture_year']);                          
             echo @$b['1']."/".@$b['0'];
            ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php if($showAllArrival[0]['Car']['mileage'])
    {
    ?>
        <div class="col-lg-11">
            <div class="ProductDetailSpecification">
                <div class="pull-xs-left ProductDetailSpectfTitle">Mileage</div>
                <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['mileage'];?></div>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php 
    }
    ?>

    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Handle</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['handle'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Fuel</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['fuel'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Transmission</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['transmission'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>

    
    <?php if($showAllArrival[0]['Car']['engine_number'])
    {
    ?>
        <div class="col-lg-11">
            <div class="ProductDetailSpecification">
                <div class="pull-xs-left ProductDetailSpectfTitle">Engine-No</div>
                <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['engine_number'];?></div>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php 
    }
    ?>
    
    
    <?php
    if($this->UserAuth->isLogged() && $value['Car']['publish'] !=0 )
    {
    ?>
    
    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Price($)</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $this->Round->round_number(ceil($showAllArrival[0]['CarPayment']['asking_price'] + ADDITIONAL_PRICE));?></div>
            <div class="clearfix"></div>
        </div>
    </div>
    
    
    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Price(&yen;)</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $this->Round->round_number_yen(ceil($showAllArrival[0]['CarPayment']['yen'] + ADDITIONAL_YEN_PRICE));?></div>
            <div class="clearfix"></div>
        </div>
    </div>
        
    <?php if($this->Session->read('UserAuth.User.id') == FIXED_USER) {?>
    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Push Price</div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['CarPayment']['push_price'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php }}?>
    
    <div class="clearfix"></div>
    
     <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">Stock Id - </div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['stock'];?></div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php if($this->UserAuth->isLogged() && $this->UserAuth->isAdmin()) { ?>
    <div class="col-lg-11">
        <div class="ProductDetailSpecification">
            <div class="pull-xs-left ProductDetailSpectfTitle">UId - </div>
            <div class="pull-xs-right ProductDetailSpectfValue"><?php echo $showAllArrival[0]['Car']['uniqueid']; ?></div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php } ?>

    <div class="col-lg-11 DivPadding5PX" data-toggle="modal" >
        <div class="hvr-pulse-grow ProductDetailBuyNowButton" style="background: #55b640;margin-top:7px;">
            <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
                More Detail</a>
        </div>
    </div>

    <?php if($this->UserAuth->isLogged() && !$this->UserAuth->isAdmin()){ ?>
	
	<div class="col-lg-4 DivPadding5PX" data-toggle="modal" data-target="#sendimage"><div class="hvr-pulse-grow ProductDetailBuyNowButton" style="background: #55b640;margin-top:7px;">Send Pic</div></div>

                <?php if(!$showAllArrival[0]['Car']['publish']==0){ ?>

    <div class="col-lg-3 DivPadding5PX" data-toggle="modal" data-target="#myModal"><div class="hvr-pulse-grow ProductDetailBuyNowButton" style="background:#798899;margin-top:7px">Buy</div></div>    
    <?php } } ?> 


<?php //print_r($showAllArrival) ?>
    <div class="col-lg-5 DivPadding5PX hide" data-toggle="modal" data-target="#queryModal"><div class="hvr-pulse-grow ProductDetailBuyNowButton" style="background:#798899; margin-top:7px;">Query</div></div>
	        <?php if(!$this->UserAuth->isAdmin() && $showAllArrival[0]['Car']['publish']==1){ ?>

    <div class="col-lg-4 DivPadding5PX" data-toggle="modal" data-target="#CifModal"><div class="hvr-pulse-grow ProductDetailBuyNowButton" style="background:#FFA500; margin-top:7px;">Ask Price</div></div>

    <div class="col-lg-12 DivPadding5PX PrductDetailAcceptTerms">Don't forget to check the Bizupon <a href="<?php echo $this->base;?>/pages/terms_condition/" target="_blank">Terms & Conditions</a> & Bizupon <a href="<?php echo $this->base;?>/pages/policy/" target="_blank">Payment Policy</a></div>
	
		<?php } ?>

</div>


<div class="NewArrivalMainDiv">
	<div class="NewArriavalTitle">Related Products</div>
	<?php
    $TotalCar = 0;
	foreach($RelatedType as $rldprc)
    {
		$TotalCar++;
		if($TotalCar > 12)
		{
			break;
		}
    ?>
        <a href="<?php echo $this->base;?>/home/car_show/<?=$rldprc['Car']['id']?>">
            <div class="col-lg-2 HoveTile" style="margin-bottom:15px; height:250px;">
                <div class="HomePageCarImageDiv"><img src="<?php echo $this->webroot.$rldprc['CarImage'][0]['image_source'];?>" alt="<?php echo $this->webroot.$rldprc['CarName']['car_name']?>" title="<?php echo $this->webroot.$rldprc['CarName']['car_name']?>" style="height:150px; width:100%;"></div>
				<div class="HomePageCarNameDiv" style="min-height:40px;font-size:14px;overflow:hidden"><?php echo $rldprc['CarName']['car_name'] . ":" . $rldprc['Car']['package'];?></div>


                <div class="HomePageCarNameDiv" style="overflow:hidden"><?php

					@$b = explode(' ',$rldprc['Car']['manufacture_year']);
                    echo "<span style=\"color:#55b640;\">YEAR:</span>".@$b['1']."/".@$b['0'];
					?>



										<span class="HomePageCarPriceDiv" style="padding-left:20px;font-size:15px;">
<?php
			if($this->UserAuth->isLogged()){ ?>
           <?php
			if($this->Session->read('LANGUAGE') == 2 )
			{
				echo "$ ". $this->Round->round_number(ceil($rldprc['CarPayment'][0]['asking_price'] + ADDITIONAL_PRICE));
			}
			else
			{
				echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(ceil($rldprc['CarPayment'][0]['yen'] + ADDITIONAL_YEN_PRICE));
			}
			?>
			<?php } ?>
					</span>
				</div>

            </div>
            </a>
    <?php
    }
    ?>

	<?php

    foreach($RelatedCarType as $rldprc)
    {
		$TotalCar++;
		if($TotalCar > 12)
		{
			break;
		}
    ?>
        <a href="<?php echo $this->base;?>/home/car_show/<?=$rldprc['Car']['id']?>">
            <div class="col-lg-2 HoveTile" style="margin-bottom:15px; height:250px;">
                <div class="HomePageCarImageDiv"><img src="<?php echo $this->webroot.$rldprc['CarImage'][0]['image_source'];?>" alt="<?php echo $this->webroot.$rldprc['CarName']['car_name']?>" title="<?php echo $this->webroot.$rldprc['CarName']['car_name']?>" style="height:150px; width:100%;"></div>
				<div class="HomePageCarNameDiv" style="min-height:40px;font-size:14px;overflow:hidden"><?php echo $rldprc['CarName']['car_name'] . ":" . $rldprc['Car']['package'];?></div>


                <div class="HomePageCarNameDiv" style="overflow:hidden"><?php

					@$b = explode(' ',$rldprc['Car']['manufacture_year']);
                    echo "<span style=\"color:#55b640;\">YEAR:</span>".@$b['1']."/".@$b['0'];
					?>



										<span class="HomePageCarPriceDiv" style="padding-left:20px;font-size:15px;">
<?php
			if($this->UserAuth->isLogged()){ ?>
           <?php
			if($this->Session->read('LANGUAGE') == 2 )
			{
				echo "$ ". $this->Round->round_number(ceil($rldprc['CarPayment'][0]['asking_price'] + ADDITIONAL_PRICE));
			}
			else
			{
				echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(ceil($rldprc['CarPayment'][0]['yen'] + ADDITIONAL_YEN_PRICE));
			}
			?>
			<?php } ?>
					</span>
				</div>

            </div>
            </a>
    <?php
    }
    ?>
    <?php
    foreach($RelatedPrice as $rldprc)
    {
		$TotalCar++;
		if($TotalCar > 12)
		{
			break;
		}

    ?>
        <a href="<?php echo $this->base;?>/home/car_show/<?=$rldprc['Car']['id']?>">
            <div class="col-lg-2 HoveTile" style="margin-bottom:15px; height:250px;">
                <div class="HomePageCarImageDiv"><img src="<?php echo $this->webroot.$rldprc['CarImage'][0]['image_source'];?>" alt="<?php echo $this->webroot.$rldprc['CarName']['car_name']?>" title="<?php echo $this->webroot.$rldprc['CarName']['car_name']?>" style="height:150px; width:100%;"></div>
				<div class="HomePageCarNameDiv" style="min-height:40px;font-size:14px;overflow:hidden"><?php echo $rldprc['CarName']['car_name'] . ":" . $rldprc['Car']['package'];?></div>


                <div class="HomePageCarNameDiv" style="overflow:hidden"><?php

					@$b = explode(' ',$rldprc['Car']['manufacture_year']);
                    echo "<span style=\"color:#55b640;\">YEAR:</span>".@$b['1']."/".@$b['0'];
					?>



										<span class="HomePageCarPriceDiv" style="padding-left:20px;font-size:15px;">
<?php
			if($this->UserAuth->isLogged()){ ?>
           <?php
			if($this->Session->read('LANGUAGE') == 2 )
			{
				echo "$ ". $this->Round->round_number(ceil($rldprc['CarPayment'][0]['asking_price'] + ADDITIONAL_PRICE));
			}
			else
			{
				echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(ceil($rldprc['CarPayment'][0]['yen'] + ADDITIONAL_YEN_PRICE));
			}
			?>
			<?php } ?>
					</span>
				</div>

            </div>
            </a>
    <?php
    }
    ?>
    <div class="clearfix"></div>
</div>

<div class="clearfix"></div>















<div class="modal fade in" id="sendimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
 <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<div class="clearfix"></div>
      </div>

	 <div id="messageDivIdAdd" class="alert alert-success" style="display:none;"></div>
	  <form action="/admin/cars/send_image?_url=%2Fadmin%2Fcars%2Fsend_image" id="form" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div> <div class="modal-body">

	       	  <input type="hidden" value="<?php echo $showAllArrival[0]['Car']['id']?>" name="car_id" id="car_id2">        
	   <div class="clearfix"></div>
	   <div class="clearfix"></div>
       <div class="input text"><input name="data[Car][text_email]" id="text_email" placeholder="Please enter email" class="form-control" type="text"></div>       <br>
       <div class="input textarea"><textarea name="data[Car][quotation]" placeholder="Quotation" id="quotation_id" class="form-control" cols="30" rows="6"></textarea></div>        
      </div>
      <div class="modal-footer">
		 <input type="button" class="btn btn-primary" id="send_user_mail2" value="Send">        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        
      </div>
	   </form>    </div>
	</div><!-- /.modal-content -->

<!--send data as email to client -->
				
</div>

































<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
    
        <div class="col-lg-7">
            <div class="col-lg-5 NoPadding">
                <?php
                $imageSrc = $this->webroot.$showAllArrival[0]['CarImage'][0]['image_source'];
                ?>
                <img src="<?=$imageSrc?>" style="width:100%">
            </div>
            <div class="col-lg-7">
                <h1 class="ProductDetailProductName"><?php echo $showAllArrival[0]['CarName']['car_name']?></h1>
                <div class="HomePageStockIdDiv">Stock Id - <?php echo $showAllArrival[0]['Car']['stock'];?></div>
                <div class="HomePageCarTypeDiv"><?php echo $showAllArrival[0]['Car']['fuel'];?> | <?php echo $showAllArrival[0]['Car']['transmission'];?></div>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="HomePageStockIdDiv text-xs-right" style="margin-right:15px;">FOB Price</div>
            <div class="ProductDetailBidPrice text-xs-right" style="font-size:45px;">
            <?php
			if($this->Session->read('LANGUAGE') == 2)
			{
				echo "$ ". $this->Round->round_number(($showAllArrival[0]['CarPayment'][0]['asking_price']+ADDITIONAL_PRICE));
			}
			else
			{
				echo '<i class="fa fa-jpy" aria-hidden="true"></i> ' . $this->Round->round_number_yen(($showAllArrival[0]['CarPayment'][0]['yen']+ADDITIONAL_YEN_PRICE));
			}
			?>
            </div>
            <div class="HomePageCarTypeDiv text-xs-right">Inclusive of Processing Charges</div>
        </div>
        <div class="clearfix">&nbsp;</div> 
       <br>
       
       <div class="col-lg-7">
           <div class="ProductPopupWarning">
           IF THE CAR GETS SAVED, IT WILL BE IN YOUR ACCOUNT THEN.
           <br>
           <span style="color:#cd3737">WARNING</span> - CANCELLATION CHARGES WOULD BE $1000.
           </div>
       </div>
       
       
       <div class="col-lg-5">
            <?php echo $this->Form->create('Bid',array('id'=>'BidForm')); ?>
            <input type ="hidden" value="<?php echo $showAllArrival[0]['CarName']['id']?>" name="car_id" id="car_id">
                <div class="col-lg-1 ProductDetailBidPrice">
                
                <?php
				if($this->Session->read('LANGUAGE') == 2)
				{
					echo "$ ";
				}
				else
				{
					echo '<i class="fa fa-jpy" aria-hidden="true"></i>';
				}
				?>
                </div>
                <div class="col-lg-10 pull-xs-right" style="margin-left:10px; margin-top:15px; padding-right:0px;">
                <?php echo $this->Form->input('amount',array('type'=>'text','class'=>'form-control BidAmountTextBox','label'=>false,'required'=>true,'placeholder'=>'Enter Bid Amount', "id" => "BidAmount"));?>
                </div>
            <?php echo $this->Form->end(); ?>
       </div>
       
       <div class="clearfix"></div>
    
    </div>
    <div class="modal-footer">
    
        <div class="pull-xs-left">
            <div class="PrductDetailAcceptTerms" style="margin:0px; margin-left:15px;"><input type="checkbox" id="AgreeTerms"> I Accept the Bizupon <a href="<?php echo $this->base;?>/pages/terms_condition/" target="_blank">Terms & Conditions</a> & <a href="<?php echo $this->base;?>/pages/policy/" target="_blank">Payment Policy</a></div>
        </div>
        
        <div class="col-lg-4 pull-xs-right">
        	<div class="ProductDetailBuyNowButton hvr-pulse-grow" style="margin-top:0px;" onClick="return submitForm('BidForm')">Save</div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade bd-example-modal-lg" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
    
        <div class="col-lg-7">
            <div class="col-lg-5 NoPadding">
                <?php
                $imageSrc = $this->webroot.$showAllArrival[0]['CarImage'][0]['image_source'];
                ?>
                <img src="<?=$imageSrc?>" style="width:100%">
            </div>
            <div class="col-lg-7">
                <h1 class="ProductDetailProductName"><?php echo $showAllArrival[0]['CarName']['car_name']?></h1>
                <div class="HomePageStockIdDiv">Stock Id - <?php echo $showAllArrival[0]['Car']['stock'];?></div>
                <div class="HomePageCarTypeDiv"><?php echo $showAllArrival[0]['Car']['fuel'];?> | <?php echo $showAllArrival[0]['Car']['transmission'];?></div>
            </div>
        </div>
        
        <div class="col-lg-5">
        	<div>
                    <?php echo $this->Form->create('Query',array('id' => "QueryForm"));?>
                        <div class="form-group"> 
                            <label for="stock" class="LoginFormLabel">Stock No.</label>
                            <?php echo $this->Form->input('stock',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'stock','label'=>false,'div'=>false, 'placeholder' => "Stcok No.", 'value' => $showAllArrival[0]['Car']['stock'], 'readonly' => true));?>
                        
                        </div>
                        
                        <div class="form-group"> 
                            <label for="name" class="LoginFormLabel">Name:</label>
                        <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'nameId','label'=>false,'div'=>false, 'placeholder' => "Name", 'value' => $_SESSION['UserAuth']['User']['first_name']. " " . $_SESSION['UserAuth']['User']['last_name']));?>
                        
                        </div>
                        
                        <div class="form-group"> 
                            <label for="email" class="LoginFormLabel">Email:<span>*</span></label>
                        <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'emailId','label'=>false,'div'=>false, 'placeholder' => "Email", 'value' => $_SESSION['UserAuth']['User']['email']));?>
                        
                        </div>
    
                        <div class="form-group"> 
                            <label for="contact" class="LoginFormLabel">Contact No.:<span>*</span></label>
                        <?php echo $this->Form->input('contact',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'contactId','label'=>false,'div'=>false, 'placeholder' => "Contact No.", 'value' => $_SESSION['UserAuth']['User']['contact']));?>
                        
                        </div>
                        
                        <div class="form-group">
                            <label for="comments" class="LoginFormLabel">Message:</label>
                            <?php echo $this->Form->input('comment',array('type'=>'textarea','rows'=>'3','class'=>'form-control BidAmountTextBox','id'=>'commentsId','label'=>false,'div'=>false, 'placeholder' => "Your Query", 'required' => true));?>
                            
                        </div>
                        <div class="clearfix"></div>
                        <?php echo $this->Form->end();?>
                    
                </div>
        </div>
        <div class="clearfix">&nbsp;</div> 
    </div>
    <div class="modal-footer">
    	<div class="col-lg-4 pull-xs-right">
    		<div class="ProductDetailBuyNowButton hvr-pulse-grow" style="margin-top:10px;" onClick="return submitQuery('QueryForm')">Send</div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div class="modal fade bd-example-modal-lg" id="CifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
    
        <div class="col-lg-7">
            <div class="col-lg-5 NoPadding">
                <?php
                $imageSrc = $this->webroot.$showAllArrival[0]['CarImage'][0]['image_source'];
                ?>
                <img src="<?=$imageSrc?>" style="width:100%">
            </div>
            <div class="col-lg-7">
                <h1 class="ProductDetailProductName"><?php echo $showAllArrival[0]['CarName']['car_name']?></h1>
                <div class="HomePageStockIdDiv">Stock Id - <?php echo $showAllArrival[0]['Car']['stock'];?></div>
                <div class="HomePageCarTypeDiv"><?php echo $showAllArrival[0]['Car']['fuel'];?> | <?php echo $showAllArrival[0]['Car']['transmission'];?></div>
            </div>
        </div>
        
        <div class="col-lg-5">
        	<div>
                    <?php echo $this->Form->create('Cif',array('id' => "CifForm"));?>
                    	 <div class="form-group"> 
                            <label for="name" class="LoginFormLabel">Name:<span>*</span></label>
                        <?php echo $this->Form->input('cif_name',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'CifnameId','label'=>false,'div'=>false, 'placeholder' => "Name", 'value' => @$_SESSION['UserAuth']['User']['first_name']. " " . @$_SESSION['UserAuth']['User']['last_name']));?>
                        
                        </div>
                        
                        <div class="form-group"> 
                            <label for="name" class="LoginFormLabel">Country:</label>
                        <?php echo $this->Form->input('cif_country',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'CifCountryName','label'=>false,'div'=>false, 'placeholder' => "Country"));?>
                        
                        </div>
                        
                         <div class="form-group"> 
                            <label for="email" class="LoginFormLabel">Email:<span>*</span></label>
                        <?php echo $this->Form->input('cif_email',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'CifemailId','label'=>false,'div'=>false, 'placeholder' => "Email", 'value' => @$_SESSION['UserAuth']['User']['email']));?>
                        
                        </div>
                        
                        <div class="form-group"> 
                            <label for="stock" class="LoginFormLabel">Stock No.</label>
                            <?php echo $this->Form->input('cif_stock',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'Cifstock','label'=>false,'div'=>false, 'placeholder' => "Stcok No.", 'value' => $showAllArrival[0]['Car']['stock'], 'readonly' => true));?>
                        
                        </div>
                        
                       
                        <div class="form-group"> 
                            <label for="stock" class="LoginFormLabel">Chassis</label>
                            <?php echo $this->Form->input('cif_chassis',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'Cifchassis','label'=>false,'div'=>false, 'placeholder' => "Chassis", 'value' => $showAllArrival[0]['Car']['cnumber'], 'readonly' => true));?>
                        
                        </div>
                       
                        <div class="form-group"> 
                            <label for="contact" class="LoginFormLabel">Contact No.:<span>*</span></label>
                        <?php echo $this->Form->input('cif_contact',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'CifcontactId','label'=>false,'div'=>false, 'placeholder' => "Contact No.", 'value' => @$_SESSION['UserAuth']['User']['contact']));?>
                        
                        </div>
                        
                        <div class="form-group">
                            <label for="comments" class="LoginFormLabel">Message:</label>
                            <?php echo $this->Form->input('cif_message',array('type'=>'textarea','rows'=>'3','class'=>'form-control BidAmountTextBox','id'=>'CifcommentsId','label'=>false,'div'=>false, 'placeholder' => "Your Query", 'required' => true));?>
                            
                        </div>
						

						<div class="row">
						Choose Price
							<label class="radio-inline">
								<input type="radio" name="data[Cif][cif_price]" checked="" value="cif" >CIF
							</label>
							<label class="radio-inline">
								<input type="radio" name="data[Cif][cif_price]" value="FOB">FOB
							</label>
							<label class="radio-inline">
								<input type="radio" name="data[Cif][cif_price]" value="CNF">CNF
							</label>

</div>
                        <div class="clearfix"></div>
                        <?php echo $this->Form->end();?>
                    
                </div>
        </div>
        <div class="clearfix">&nbsp;</div> 
    </div>
    <div class="modal-footer">
    	<div class="col-lg-4 pull-xs-right">
            <div class="ProductDetailBuyNowButton hvr-pulse-grow" style="margin-top:10px;" onClick="return submitCif('CifForm')">Send</div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">
function submitForm(form_id){
	if($("#BidAmount").val() == "")
	{
		$.notify({message: 'Enter Bid Amount'},{type: 'danger'});
		return false;
	}
	if(document.getElementById('AgreeTerms').checked == false)
	{
		$.notify({message: 'Kindly Agree With Terms & Conditions'},{type: 'danger'});
		return false;
	}
	
	$.notify({message: "Please Wait.."},{type: 'info'});
	$("#"+form_id).ajaxSubmit({
		url:"<?php echo $this->Html->url('/home/addbid',true);?>",
		type:"POST",
		success:function(result){
			var obj = jQuery.parseJSON(result);
			$.notify({message: obj.message},{type: 'info'});
		},
		failure: function(result)
		{
			$.notify({message: 'Some Error Occure'},{type: 'danger'});
		}
	});
}

function submitQuery(form_id){
	if($("#nameId").val() == "")
	{
		$.notify({message: 'Enter Your Name'},{type: 'danger'});
		return false;
	}
	if($("#emailId").val() == "")
	{
		$.notify({message: 'Enter Your Email'},{type: 'danger'});
		return false;
	}
	if($("#contactId").val() == "")
	{
		$.notify({message: 'Enter Your Contact No.'},{type: 'danger'});
		return false;
	}
	if($("#commentsId").val() == "")
	{
		$.notify({message: 'Enter Your Query'},{type: 'danger'});
		return false;
	}
	
	$.notify({message: "Please Wait While we Send Query"},{type: 'info'});
	
	$("#"+form_id).ajaxSubmit({
		url:"<?php echo $this->Html->url('/home/carQuery',true);?>",
		type:"POST",
		success:function(result){
			var obj = jQuery.parseJSON(result);
			$.notify({message: obj.message},{type: 'info'});
		},
		failure: function(result)
		{
			$.notify({message: 'Some Error Occure'},{type: 'danger'});
		}
	});
}
function submitCif(form_id)
{
	if($("#CifnameId").val() == "")
	{
		$.notify({message: 'Enter Your Name'},{type: 'danger'});
		return false;
	}
	if($("#CifemailId").val() == "")
	{
		$.notify({message: 'Enter Your Email'},{type: 'danger'});
		return false;
	}
	if($("#CifcontactId").val() == "")
	{
		$.notify({message: 'Enter Your Contact No.'},{type: 'danger'});
		return false;
	}
	if($("#CifcommentsId").val() == "")
	{
		$.notify({message: 'Enter Your Query'},{type: 'danger'});
		return false;
	}
	
	
	$.notify({message: "Please Wait While we Send Query"},{type: 'info'});
	
	$("#"+form_id).ajaxSubmit({
		url:"<?php echo $this->Html->url('/home/CifQuery',true);?>",
		type:"POST",
		success:function(result){
			var obj = jQuery.parseJSON(result);
			$.notify({message: obj.message},{type: 'info'});
		},
		failure: function(result)
		{
			$.notify({message: 'Some Error Occure'},{type: 'danger'});
		}
	});
}

jQuery(document).ready(function(){

	jQuery('#send_user_mail2').click(function(event) {
			form = jQuery("#form").serialize();
			var sendTextEmail= jQuery('#text_email').val();
			   jQuery('#messageDivIdAdd').html('Mail Sent!!!').show().css("color","green");
          jQuery.ajax({
			url: "<?php echo $this->Html->url('/home/getsendmail',true);?>",
			type: 'POST',
			dataType: 'JSON',
                        data: {'email':'','text_mail':sendTextEmail,'quotation':jQuery('#quotation_id').val(),'car_id':jQuery('#car_id2').val() },
			success: function(result) { 

				//if(result.status =='success'){
 		
	//jQuery("#sendimage").modal("hide");
                               // }
				//else if(result.status =='error'){
				//	   jQuery('#messageDivIdAdd').html(result.message).show().css("color","red");
				//}
                        }
          
          });

       });
});
</script>



