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
        height: 50%;
        padding: 1px;
        border: 1px solid green;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }

</style>
<div id="fade" class="black_overlay"></div>
<div id="light" class="white_content">
    <div align="right">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
    </div>
    <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
        <tr height="35">
            <th align="centre">TRANSMISSION</th>
            <th align="centre">EXTERIOR COLOR</th>
            <th align="centre">POWER STEERING</th>
            <th align="centre">AIR CONDITION</th>
            <th align="centre">ALLOY WHEEL</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['package'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['exterior_color'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['power_steering'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['air_condition'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['alloy_wheel'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">INTERIOR COLOR</th>
            <th align="centre">TV</th>
            <th align="centre">KEYLESS ENTRY</th>
            <th align="centre">AERO KIT</th>
            <th align="centre">REAR PARKING CAMERA</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['interior_color'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['tv'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['keyless_entry'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['aero_kit'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['rear_parking_camera'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">POWER DOOR</th>
            <th align="centre">SEAT HEATER</th>
            <th align="centre">SPARE KEY</th>
            <th align="centre">ROOF RAILS</th>
            <th align="centre">PARKING SENSOR</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['power_door'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['seat_heater'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['spare_key'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['roof_rails'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['parking_sensor'];?></td>
        </tr>

        <tr height="35">
            <th align="centre">POWER WINDOW</th>
            <th align="centre">POWER SEATS</th>
            <th align="centre">DRIVE</th>
            <th align="centre">MAINTENANCE RECORD</th>
            <th align="centre">ABS(ANTI BREAK SYSTEM)</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['power_window'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['power_seats'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['package'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['maintenance_record'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['anti_break_system'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">AIRBAGS</th>
            <th align="centre">NAVIGATION</th>
            <th align="centre">CD PLAYER</th>
            <th align="centre">SLIDING DOOR</th>
            <th align="centre">SMART KEY SYSTEM</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['airbags'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['navigation'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['cd_player'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['sliding_door'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['smart_key_system'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">AUTOMATIC DOOR</th>
            <th align="centre">LOW DOWN</th>
            <th align="centre">BODY KIT</th>
            <th align="centre">REAR SPOILER</th>
            <th align="centre">WIND BREAKER</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['automatic_door'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['low_down'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['body_kit'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['rear_spoiler'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['wind_breaker'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">SEATING CAPACITY</th>
            <th align="centre">FUEL</th>
            <th align="centre">NO SMOKING</th>
            <th align="centre">ONE OWNER</th>
            <th align="centre">ATS(ANTI THEFT SYSTEM)</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['seating_capacity'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['package'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['no_smoking'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['one_owner'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['anti_theft_system'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">LEATHER SEATS</th>
            <th align="centre">LIGHT</th>
            <th align="centre">MD/MD CHANGER</th>
            <th align="centre">BENCH SEATS</th>
            <th align="centre">DOUBLE AIR CONDITION</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['leather_seats'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['light'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['md_changer'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['bench_seats'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['double_air_condition'];?></td>
        </tr>
        <tr height="35">
            <th align="centre">SUNROOF</th>
            <th align="centre">ESC(ELECTRONIC STABILITY CONTROL)</th>
            <th align="centre">SPARE TYRE</th>
            <th align="centre">FOG LAMP</th>
            <th align="centre">MUD FLAP</th>
        </tr>
        <tr height="35">
            <td align="centre"><?php echo $showAllArrival[0]['Car']['sunroof'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['electronic_stability_control'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['spare_tyre'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['fog_lamp'];?></td>
            <td align="centre"><?php echo $showAllArrival[0]['Car']['mud_flap'];?></td>
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
        <div align="right">
            <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">More Detail</a>
        </div>

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


