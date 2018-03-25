<?php echo $this->Html->script('jquery-form'); ?>
<?php echo $this->Html->css('select2');?>
<?php echo $this->Html->script('select2.min'); ?>

<div class="ProductDetailLeftPanel">
    <div class="DashboardStatics">
        Customer Code: <b><?php echo $userDetails['User']['uniqueid'] ?></b> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        Name: <b><?php echo $userDetails['User']['first_name']." ".$userDetails['User']['last_name'];?></b> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        Created Date : <b color='red'><?php echo $userDetails['User']['created'];?></b> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        Remain Balance($): <b><?php echo $balanceTotalDoller; ?> </b> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
        Remain Balance(￥): <b><?php  echo $balanceTotalYen;?></b>
    </div>
    <div class="myloader" id="loading" style="display:none;"><img src="<?php echo $this->webroot; ?>images/loading-green.gif"/> </div>

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all" role="tab">All History</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#buy" role="tab">Buy History</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sale" role="tab">Sale History</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Balance" role="tab">Balance Overview</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payment" role="tab">Payment History</a></li>
    </ul>

    <div class="clearfix">&nbsp;</div>

    <div class="tab-content">
        <div class="tab-pane active" id="all" role="tabpanel">
        	<div class="col-md-12">
                <div id="messageDivIdSucc" class="alert alert-success" style="display:none;"></div>
                <div id="errmessageDiv" class="alert alert-success" style="display:none;"></div>
                <div data-original-title="" class="box-header well">
                    <h1 class="PageTitle">All <span>History</span></h1>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div style="margin-bottom:10px;">
            	<div class="col-lg-12">
            	<div class="pull-left" style="margin-top:10px;"><strong>Search Engine </strong></div>
                <div class="col-md-3"><input id="selectbox-a" name="optionvalue" class="form-control" data-placeholder="Enter Chassis Number For Search"></div>
                <div class="col-md-2">
                    <div id="showAllUsrDivBtn" style="display:none;">
                        <button class="ProductDetailBuyNowButton col-lg-12 hvr-pulse-grow" id="clearSearchHistory" style="margin:0px; background:#798899">Clear Search</button>
                    </div>
                </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <form id="dataForm">
                <div class="col-md-12" style="overflow-x: auto;max-height:600px;border-right:1px solid #ddd;">
                    <table class="table table-bordered table-striped dashboard-background" style="width:auto">
                        <thead>
                            <tr style="background:#798899; color:#FFF">
                                <th>Stock No.</th>
                                <th>Car Name</th>
                                <th>Chassis Number</th>
                                <th>Month/Year of Manufacture</th>
                                <th>B/L No</th>
                                <th>Consignee</th>
                                <th>Freight</th>
                                <th>Price</th>
                                <th>Sold Date</th>
                                <th>Receipt of Money</th>
                                <th>Payment Receive Date</th>
                                <th>Discount</th>
                                <th>Balance</th>
                                <th>Advance</th>
                                <th>Documents for Shipping</th>
                                <th>Documents Management By Bizupon</th>
                                <th>Shipping Company</th>
                                <th>Document Given Date</th>
                                <th>Shipping Port</th>
                                <th>Port Remark</th>
                                <th>Destination Port</th>
                                <th>Cancel</th>
								<th>Car IN</th>
                                <th>Car OUT</th>
                                <th>Departure Date</th>
                                <th>Arrival Date</th>
                                <th>Car Remark</th>
                            </tr>
                        </thead>
                        <tbody id='all_history_data'>
                            <?php if($SaleDetais){
                                  foreach($SaleDetais as $val)
                                  {
                                  ?>
                                  <tr>
                                        <td class="center"><?php echo $val['Car']['stock'] ; ?>
                                        </td>
                                        <td class="center">
                                            <?php

                                                $carId = $val['CarPayment']['car_id'];

                                                if($val['Car']['user_doc_status'] ==1)
                                                {
                                                    $style = 'color:black';

                                                }else
                                                {
                                                     $style = '';
                                                }
                                            ?>

                                            <?php  echo $this->Html->link(@$val['CarName']['car_name'],array('controller'=>'home', 'action'=>'car_show',$carId),array('escape' => FALSE,'target'=>'_blank','style'=>$style));
                                            ?>



                                        </td>

                                        <td class="center"><?php echo $val['Car']['cnumber'] ; ?>
                                        </td>
                                        <td><?php $mYear = explode(" ",$val['Car']['manufacture_year']); echo $mYear[0]."/".@$mYear[1]; ?>
                                        </td>
                                      <td class="center"><?php echo $val['Logistic']['bl_no'] ; ?>
                                      <td class="center"><?php echo $val['Car']['consignee'] ; ?>
                                      <td class="center"><?php echo $val['CarPayment']['psale_freight'] ; ?>

                                        <td class="center"><span class="text">
                                        <?php  /*if($val['CarPayment']['currency']=='$')
                                                        {
                                                            echo "$".$val['CarPayment']['sale_price'];
                                                        }else
                                                        {
                                                            echo "￥".$val['CarPayment']['sale_price'];
                                                        }*/
                                        if($val['CarPayment']['currency']=='$')
                                        {
                                            echo "$".$val['CarPayment']['sale_price'];
                                        }else if($val['CarPayment']['currency'] == '')
                                        {
                                            //echo "$".$val['CarPayment']['sale_price'];
                                            echo "-";
                                        }else
                                        {
                                            echo "￥".$val['CarPayment']['sale_price'];
                                        }
                                                     ?>
                                            </span>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($val['CarPayment']['updated_on']) );  ?>
                                        </td>
                                        <td>
                                            <?php if($val['Car']['user_doc_status'] ==1)
                                            {
                                                        if($val['CarPayment']['currency']=='$')
                                                        {
                                                            echo "$".$val['CarPayment']['sale_price'];
                                                        }else if($val['CarPayment']['currency'] == '')
                                                        {
                                                            echo '-';
                                                        }else
                                                        {
                                                            echo "￥".$val['CarPayment']['sale_price'];
                                                        }
                                                        /*if($val['CarPayment']['currency']=='$')
                                                        {
                                                            echo "$".$val['CarPayment']['sale_price'];
                                                        }else
                                                        {
                                                            echo "￥".$val['CarPayment']['sale_price'];
                                                        } 11 feb hide by sudhir*/
                                            }else
                                            {
                                                echo " ";
                                            }

                                            ?>
                                        </td>

                                        <td><?php //echo $val['Car']['user_doc_updated']; ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="center">
                                                <?php

                                              if(strlen(trim($val['Logistic']['created']))>0)
                                              {
                                                     $readOnly = 'disabled="true"';
                                                 }
                                              else {

                                                    $readOnly = 'disabled="true"';
                                                }

                                            ?>
                                            <input type="checkbox" id='mail_<?php echo $val['CarPayment']['car_id']; ?>' class="chkNumber" data-id="client_check"  name="check[]" value='<?php echo $val['CarPayment']['car_id']; ?><?php // echo "/".$val['CarPayment']['sale_price']; ?> <?php // echo "/".$val['Car']['user_doc_status']; ?>'  <?php  echo ($val['Car']['user_doc_status']==1 ? 'checked' : ''); ?> <?php  echo $readOnly; ?> >

                                        </td>

                                             <?php

                                              if($val['Car']['doc_status']==1)
                                                     $selected = "value='0'";
                                              else
                                                    $selected =  "value='1'";


                                            ?>

                                        <td class="center" id="td<?php echo $val['CarPayment']['car_id']; ?>" >

                                            <!--<input type="checkbox"  id='checkbox_<?php // echo $val['CarPayment']['car_id']; ?>' onclick="docStatus('<?php // echo $val['CarPayment']['car_id']; ?>')"  <?php // echo $selected;?> <?php // echo ($val['Car']['doc_status']==1 ? 'checked' : ''); ?> > onclick="docStatus('<?php // echo $val['CarPayment']['car_id']; ?>')"-->


                                            <input type="checkbox"  id='checkbox_<?php echo $val['CarPayment']['car_id']; ?>'  value='<?php echo $val['Car']['doc_status'] ;?>' disabled="disabled"  <?php  echo ($val['Car']['doc_status']==1 ? 'checked' : ''); ?>    >
                                        </td>



                                        <td class="center"><?php echo $val['Shipping']['company_name'] ; ?>
                                        </td>
                                        <td class="center">
                                            <?php if(isset($val['Logistic']['created']) && empty($val['Logistic']['created']))
                                            {
                                                echo $shipDate=  '';
                                            }
                                            elseif(!empty($val['Logistic']['created']))
                                            {
                                                $str = $val['Logistic']['created'];
                                                if (substr_count($str, '-') > 0)
                                                {
                                                    echo $shipDate = $val['Logistic']['created'];
                                                }
                                                else
                                                {
                                                    if(is_numeric($val['Logistic']['created'])){
                                                        //@$shipDate = date('d-m-Y',$val['Logistic']['created']);
                                                        echo  $shipDate=  '';
                                                    }
                                                    else{
                                                    echo  $shipDate=  '';
                                                    }
                                                }
                                            }
                                            else{
                                                echo $shipDate=  '';
                                            } ?>
                                        </td>
                                        <td class="center"><?php echo $val['Logistic']['ship_port'] ; ?>
                                        </td>
                                        <td class="center"><?php echo $val['Logistic']['port_remark'] ; ?>
                                        </td>
                                        <td class="center"><?php echo $val['Logistic']['destination_port'] ; ?>
                                        </td>


                                        <td class="center">
                                        </td>


										<td class="center"><?php echo $val['Logistic']['car_in'] ; ?>
                                        </td>

										<td class="center"><?php echo $val['Logistic']['car_out'] ; ?>
                                        </td>
                                        <td class="center"><?php echo $val['Logistic']['departure_date'] ; ?>
                                        </td>
                                        <td class="center"><?php echo $val['Logistic']['arrival_date'] ; ?>
                                        </td>





                                        <td class="center"><?php echo $val['Logistic']['remark'] ; ?>
                                        </td>
                                    </tr>
                                 <?php }}else {?>
                                    <tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
                            <?php }?>

                        </tbody>
                    </table>
                </div>
                <!--<input type="button" value="Save" onclick ="saveData('dataForm');"  class="btn btn-primary  pull-right" style="margin:10px 10px  0 0;" />-->
            </form>
        </div>
        <div class="tab-pane" id="buy" role="tabpanel">
        	<div class="col-md-12 col-lg-12">
                <div class="box-header well" data-original-title>
                    <h1 class="PageTitle">Buy <span>History</span></h1>
                    <div class="clearfix"></div>
                </div>
                <div class="box-content">
                    <div class="row">

                        <div class="col-lg-2">
                        	<input id="selectbox-o" name="optionvalue" data-placeholder="Enter Car Name for Search" class="form-control"/>
                        </div>
                        <div class="col-lg-2">
                            <input id="selectbox" name="optionvalue" data-placeholder="Enter Chassis Number for Search" class="form-control"/>
                        </div>

                        <div class="col-lg-2">
                            <input type="text" class="datepicker form-control " id="date01" name="todate" placeholder="From Date" value="" />
                        </div>
                        <div class="col-lg-2">
                            <input type="text"class="datepicker form-control " placeholder="To Date" id="date02" name="todate" value="" />
                        </div>
                        <div class="col-lg-2">
                            <div class="col-lg-3 NoPadding"><button type="button"  id="buybutton" class="ProductDetailBuyNowButton hvr-pulse-grow" style="margin-top:0px; width:100%;"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
							<div id="showAllUsrBuyDivBtn" style="display:none;">
                            <div class="col-lg-8 NoPadding pull-right"><button class="ProductDetailBuyNowButton hvr-pulse-grow" id="clearBuySearchHistory" style="margin-top:0px; background: #798899; width:100%;">Clear Search</button>	</div>
                            </div>

                        </div>
                        <div class="col-lg-2">


                            <div class="ProductDetailBuyNowButton col-lg-12 hvr-pulse-grow pull-right" style="margin-top:0px; background: #FFA500;" id='sale_search_div'>
							<?php
                                echo $this->Html->link( 'Download <i class="fa fa-download"></i> &nbsp;&nbsp; ',array('controller'=>'home','action' => 'export_buy_history_xls',$data
                                    ),array(
                                    'data-hint'=>'Download',
                                        'class'=>'',
                                        'escape'=>false,
                                        'style'=>'margin-top:0px;',
                                    )
                                );
                                ?>
                             </div>
                        </div>

                        <div class="clearfix">&nbsp;</div><br>
                    </div>
                    </div>

                        <div style="max-height:450px; overflow-y:auto;">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
                                  <thead>
                                      <tr style="background:#798899; color:#FFF">
                                          <th>S No.</th>
                                          <th>Sold Date</th>
                                          <th>Car Name</th>
                                          <th>Chassis Number</th>
                                          <th>Freight</th>
                                          <th>Sale Price($)</th>
                                          <th>Sale Price(￥)</th>
                                          <!--<th>Shipping Company</th>
                                          <th>Stock</th>
                                          <th>Remarks</th>
                                          <th>Status</th>
                                          <th>Shipping Date</th>-->
                                          <th>Invoice No.</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="cardetail">
                                  <?php if($BuyDetails){
                                      $sno=1;
                                  foreach($BuyDetails as $val)
                                  {

                                  ?>
                                    <tr>
                                        <td> <?php echo $sno; ?></td>
                                        <td> <?php
                                            $originalDate = $val['CarPayment']['updated_on'] ;
                                            $newDate = date("d-m-Y", strtotime($originalDate));
                                            echo $newDate ;
                                      ?></td>
                                        <td class="center"><?php
                                        $carId = $val['CarPayment']['car_id'];
                                        echo $this->Html->link(@$val['CarName']['car_name'],array('controller'=>'home', 'action'=>'car_show',$carId),array('escape' => FALSE,'target'=>'_blank'));

                                        //echo @$val['Car']['CarName']['car_name'] ; ?></td>
                                        <td class="center"><?php echo $val['Car']['cnumber'] ; ?></td>
                                        <td class="center"><?php echo $val['CarPayment']['psale_freight'] ; ?></td>

                                        <td class="center">
                                            <span id="first_<?php echo $val['CarPayment']['id']; ?>" class="text">
                                            <?php
                                            /*if($val['CarPayment']['currency'] =='$')
                                                    {
                                                         echo @$val['CarPayment']['sale_price'] ;
                                                    }else
                                                    {
                                                        echo '-';
                                                    }*/
                                            if($val['CarPayment']['currency']=='$')
                                            {
                                                echo $val['CarPayment']['sale_price'];
                                            }
                                            else if($val['CarPayment']['currency'] == '')
                                            {
                                                echo '-';
                                            }else
                                            {
                                                echo '-';
                                            }


                                            ?></span>
                                            <input type="text" style="display:none" value="<?php echo $val['CarPayment']['sale_price']; ?>" class="editbox" id="first_input_<?php echo $val['CarPayment']['id']; ?>"/>

                                            </td>


                                            <td class="center">
                                            <span id="first_<?php echo $val['CarPayment']['id']; ?>" class="text">
                                            <?php
                                             /*if($val['CarPayment']['currency'] =='￥')
                                                        {
                                                             echo @$val['CarPayment']['sale_price'] ;
                                                        }else
                                                        {
                                                            echo '-';
                                                        }*/

                                            if($val['CarPayment']['currency']=='￥')
                                            {
                                                echo $val['CarPayment']['sale_price'];
                                            }
                                            else if($val['CarPayment']['currency'] == '')
                                            {
                                                echo '-';
                                            }else
                                            {
                                                echo '-';
                                            }

                                             ?></span>
                                            <input type="text" style="display:none" value="<?php echo $val['CarPayment']['yen']; ?>" class="editbox" id="first_input_<?php echo $val['CarPayment']['id']; ?>" />

                                            </td>

                                        <!--<td class="center"><?php //echo $val['Shipping']['company_name'] ; ?></td>
                                        <td class="center"><?php //echo $val['Car']['stock'] ; ?></td>
                                        <td class="center"><?php //echo $val['Logistic']['remark'] ; ?></td>
                                        <td class="center"><?php //echo $val['Logistic']['status'] ; ?></td>-->
                                        <!--<td class="center">
                                <?php /*if(isset($val['Logistic']['created']) && empty($val['Logistic']['created']))
                                {
                                    echo $shipDate=  '';
                                }
                                elseif(!empty($val['Logistic']['created']))
                                {
                                    $str = $val['Logistic']['created'];
                                    if (substr_count($str, '-') > 0)
                                    {
                                        echo $shipDate = $val['Logistic']['created'];
                                    }
                                    else
                                    {
                                        if(is_numeric($val['Logistic']['created'])){
                                            //@$shipDate = date('d-m-Y',$val['Logistic']['created']);
                                            echo  $shipDate=  '';
                                        }
                                        else{
                                        echo  $shipDate=  '';
                                        }
                                    }
                                }
                                else{
                                    echo $shipDate=  '';
                                }*/ ?>

                                </td>-->
                                        <td class="center"><?php echo $val['Invoice']['invoice_no'] ; ?></td>
                                        <td class="center"><?php
                                            if($val['Invoice']['invoice_no'])
                                            {
                                            $st = explode("/",@$val['Invoice']['invoice_no']);

                                                    echo $this->Html->link(
                                                    '<i class="fa fa-download"></i>',
                                                    array(
                                                            'controller' => 'admin/invoices',
                                                            'action' => 'generate',$st[1]
                                                        ),
                                                    array(
                                                    'data-hint'=>'Download',
                                                    'class'=>'btn btn-success hint--bottom',
													'style' => 'background: #FFA500; border:#FFA500 1px solid;',
                                                    'escape'=>false
                                                    )
                                                );
                                                //echo " ";
                                            }

                                            if($val['Car']['price_editable'])
                                            { ?>
                                                <div id ="edit<?php echo $val['CarPayment']['id']; ?>" >
                                                <input type="button" id="abc"  onclick="editPrice('<?php echo $val['CarPayment']['id']; ?>');" value="Edit"  class=" btn btn-success hint--bottom"  data-hint='Edit'>
                                                </div>
                                            <?php }
                                            ?>
                                            </td>
                                        </tr>
                                        <?php $sno++; }}else {?>
                                        <tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
                                        <?php }?>
                                    </tbody>
                            </table>
                        </div>
				</div>
        </div>
        <div class="tab-pane" id="sale" role="tabpanel">
            <div class="col-md-12 col-lg-12">
                <div class="box-header well" data-original-title>
                    <h1 class="PageTitle">Sale <span>History</span></h1>
                    <div class="clearfix"></div>
                </div>
                <div class="box-content">
                    <div class="row">

                        <div class="col-lg-2">
                            <input id="selectbox-o2" name="optionvalue" data-placeholder="Enter Car Name for Search" class="form-control"/>
                        </div>
                        <div class="col-lg-2">
                            <input id="selectbox2" name="optionvalue" data-placeholder="Enter Chassis Number for Search" class="form-control"/>
                        </div>

                        <div class="col-lg-2">
                            <input type="text" class="datepicker form-control " id="date012" name="todate" placeholder="From Date" value="" />
                        </div>
                        <div class="col-lg-2">
                            <input type="text"class="datepicker form-control " placeholder="To Date" id="date022" name="todate" value="" />
                        </div>
                        <div class="col-lg-2">
                            <div class="col-lg-3 NoPadding"><button type="button"  id="salebutton" class="ProductDetailBuyNowButton hvr-pulse-grow" style="margin-top:0px; width:100%;"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div id="showAllUsrSaleDivBtn" style="display:none;">
                                <div class="col-lg-8 NoPadding pull-right"><button class="ProductDetailBuyNowButton hvr-pulse-grow" id="clearSellSearchHistory" style="margin-top:0px; background: #798899; width:100%;">Clear Search</button>	</div>
                            </div>

                        </div>
                        <div class="col-lg-2">


                            <div class="ProductDetailBuyNowButton col-lg-12 hvr-pulse-grow pull-right" style="margin-top:0px; background: #FFA500;" id='sale_search_div2'>
                                <?php
                                echo $this->Html->link( 'Download <i class="fa fa-download"></i> &nbsp;&nbsp; ',array('controller'=>'home','action' => 'export_sale_history_xls',$data
                                ),array(
                                        'data-hint'=>'Download',
                                        'class'=>'',
                                        'escape'=>false,
                                        'style'=>'margin-top:0px;',
                                    )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="clearfix">&nbsp;</div><br>
                    </div>
                </div>

                <div style="max-height:450px; overflow-y:auto;">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
                        <thead>
                        <tr style="background:#798899; color:#FFF">
                            <th>S No.</th>
                            <th>Sold Date</th>
                            <th>Car Name</th>
                            <th>Chassis Number</th>
                            <th>Sale Price($)</th>
                            <th>Sale Price(￥)</th>
                            <!--<th>Shipping Company</th>
                            <th>Stock</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Shipping Date</th>-->
                            <th>Invoice No.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="cardetail2">
                        <?php if($SaleDetails){
                            $sno=1;
                            foreach($SaleDetails as $val)
                            {

                                ?>
                                <tr>
                                    <td> <?php echo $sno; ?></td>
                                    <td> <?php
                                        $originalDate = $val['CarPayment']['updated_on'] ;
                                        if($originalDate == null || $originalDate == '' || $originalDate == '0000-00-00')
                                            $newDate = '00-00-0000';
                                        else
                                            $newDate = date("d-m-Y", strtotime($originalDate));
                                        echo $newDate;
                                        ?></td>
                                    <td class="center"><?php
                                        $carId = $val['CarPayment']['car_id'];
                                        echo $this->Html->link(@$val['CarName']['car_name'],array('controller'=>'home', 'action'=>'car_show',$carId),array('escape' => FALSE,'target'=>'_blank'));

                                        //echo @$val['Car']['CarName']['car_name'] ; ?></td>
                                    <td class="center"><?php echo $val['Car']['cnumber'] ; ?></td>

                                    <td class="center">
                                            <span id="first2_<?php echo $val['CarPayment']['id']; ?>" class="text">
                                            <?php
                                            /*if($val['CarPayment']['currency'] =='$')
                                                    {
                                                         echo @$val['CarPayment']['sale_price'] ;
                                                    }else
                                                    {
                                                        echo '-';
                                                    }*/
                                            if($val['CarPayment']['currency']=='$')
                                            {
                                                echo $val['CarPayment']['sale_price'];
                                            }
                                            else if($val['CarPayment']['currency'] == '')
                                            {
                                                echo '-';
                                            }else
                                            {
                                                echo '-';
                                            }


                                            ?></span>
                                        <input type="text" style="display:none" value="<?php echo $val['CarPayment']['sale_price']; ?>" class="editbox" id="first_input2_<?php echo $val['CarPayment']['id']; ?>"/>

                                    </td>


                                    <td class="center">
                                            <span id="first2_<?php echo $val['CarPayment']['id']; ?>" class="text">
                                            <?php
                                            /*if($val['CarPayment']['currency'] =='￥')
                                                       {
                                                            echo @$val['CarPayment']['sale_price'] ;
                                                       }else
                                                       {
                                                           echo '-';
                                                       }*/

                                            if($val['CarPayment']['currency']=='￥')
                                            {
                                                echo $val['CarPayment']['sale_price'];
                                            }
                                            else if($val['CarPayment']['currency'] == '')
                                            {
                                                echo '-';
                                            }else
                                            {
                                                echo '-';
                                            }

                                            ?></span>
                                        <input type="text" style="display:none" value="<?php echo $val['CarPayment']['yen']; ?>" class="editbox" id="first_input2_<?php echo $val['CarPayment']['id']; ?>" />

                                    </td>

                                    <!--<td class="center"><?php //echo $val['Shipping']['company_name'] ; ?></td>
                                        <td class="center"><?php //echo $val['Car']['stock'] ; ?></td>
                                        <td class="center"><?php //echo $val['Logistic']['remark'] ; ?></td>
                                        <td class="center"><?php //echo $val['Logistic']['status'] ; ?></td>-->
                                    <!--<td class="center">
                                <?php /*if(isset($val['Logistic']['created']) && empty($val['Logistic']['created']))
                                {
                                    echo $shipDate=  '';
                                }
                                elseif(!empty($val['Logistic']['created']))
                                {
                                    $str = $val['Logistic']['created'];
                                    if (substr_count($str, '-') > 0)
                                    {
                                        echo $shipDate = $val['Logistic']['created'];
                                    }
                                    else
                                    {
                                        if(is_numeric($val['Logistic']['created'])){
                                            //@$shipDate = date('d-m-Y',$val['Logistic']['created']);
                                            echo  $shipDate=  '';
                                        }
                                        else{
                                        echo  $shipDate=  '';
                                        }
                                    }
                                }
                                else{
                                    echo $shipDate=  '';
                                }*/ ?>

                                </td>-->
                                    <td class="center"><?php echo $val['Invoice']['invoice_no'] ; ?></td>
                                    <td class="center"><?php
                                        if($val['Invoice']['invoice_no'])
                                        {
                                            $st = explode("/",@$val['Invoice']['invoice_no']);

                                            echo $this->Html->link(
                                                '<i class="fa fa-download"></i>',
                                                array(
                                                    'controller' => 'admin/invoices',
                                                    'action' => 'generate',$st[1]
                                                ),
                                                array(
                                                    'data-hint'=>'Download',
                                                    'class'=>'btn btn-success hint--bottom',
                                                    'style' => 'background: #FFA500; border:#FFA500 1px solid;',
                                                    'escape'=>false
                                                )
                                            );
                                            //echo " ";
                                        }


                                if($val['Invoice']['invoice_no'] == '' && $val['CarPayment']['sale_price'] == '') {
                                    $carid = $val['Car']['id'];
                               ?>
                                    <a href="<?php echo $this->Html->url('/',true); ?>admin/cars/addnew_car/<?php echo $carid;?>">
                                        <span>&nbsp; &nbsp; &nbsp; &nbsp;Edit</span>
                                    </a>
                               <?php }


                                        if($val['Car']['price_editable'])
                                        { ?>
                                            <div id ="edit2<?php echo $val['CarPayment']['id']; ?>" >
                                                <input type="button" id="abc"  onclick="editPrice('<?php echo $val['CarPayment']['id']; ?>');" value="Edit"  class=" btn btn-success hint--bottom"  data-hint='Edit'>
                                            </div>
                                        <?php }
                                        ?>
                                    </td>
                                </tr>
                                <?php $sno++; }}else {?>
                            <tr><td colspan="10" style="text-align:center">Car details not found</td></tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="Balance" role="tabpanel">
            <div class="row-fluid sortable">
                <div class="box">
                    <div class="box-header well" data-original-title>
                        <h1 class="PageTitle">Balance <span>Overview</span></h1>
                        <div class="clearfix"></div>
                            <!-- <div class="box-icon">

                                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                            </div> -->
                    </div>
                </div>
                <div class="box-content">
                    <div style="color: #55595c;font-size: 1rem; font-weight:bold; margin-bottom:10px;">In Dollar ($)</div>
                    <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
                          <thead>
                              <tr style="background:#798899; color:#FFF">
                                  <th class="center">Sale Price($)</th>
                                  <th class="center">Payment($)</th>
                                  <th class="center">Balance($)</th>
                                 <!-- <th class="center">Balance(￥)</th>-->
                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td class="center"><?php echo $sTotalDoller ; ?></td>
                                <td class="center"><?php echo $pTotal ; ?></td>
                                <td class="center"><?php echo $balanceTotalDoller ; ?></td>
                                <!--<td class="center"><?php //echo $balanceTotal * $this->Session->read('yenRate'); ?></td>-->
                            </tr>

                          </tbody>
                     </table>

                     <div style="color: #55595c;font-size: 1rem; font-weight:bold; margin-bottom:10px;">IIn Yen (￥)</div>
                    <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
                          <thead>
                              <tr style="background:#798899; color:#FFF">
                                  <th class="center">Sale Price(￥)</th>
                                  <th class="center">Payment(￥)</th>
                                  <th class="center">Balance(￥)</th>
                                 <!-- <th class="center">Balance(￥)</th>-->
                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td class="center"><?php echo $sTotalYen ; ?></td>
                                <td class="center"><?php echo $pTotalYen ; ?></td>
                                <td class="center"><?php echo $balanceTotalYen ; ?></td>
                                <!--<td class="center"><?php //echo $balanceTotal * $this->Session->read('yenRate'); ?></td>-->
                            </tr>

                          </tbody>
                     </table>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="payment" role="tabpanel">
            <div>
                <div class="box-header well" data-original-title>
                    <h1 class="PageTitle">Payment <span>History</span></h1>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-3"><input type="text" class="datepicker form-control" id="date04" name="todate" placeholder="From date"  value="<?php   //  echo date("j-m-Y");?>" /></div>
                <div class="col-lg-3"><input type="text" class="datepicker form-control" id="date03" name="todate" placeholder="To date" value="" /></div>
                <div class="col-lg-3"><input type="button" id="button" class="ProductDetailBuyNowButton hvr-pulse-grow col-lg-12" style="margin-top:0px;" value="Search"></div>
                <div class="col-lg-3">
                    <div class="col-md-6">
                        <div id="showPaySearchDivBtn" style="display:none;">
                            <button class="ProductDetailBuyNowButton col-lg-12 hvr-pulse-grow" onclick="clearSearch();" style="margin-top:0px; background: #798899;">Clear Search</button>
                        </div>
                    </div>
                    <div class="col-md-6 NoPadding">
                    <div class="ProductDetailBuyNowButton hvr-pulse-grow" style="margin-top:0px; background: #FFA500; width:100%">
                        <?php
                            echo $this->Html->link( 'Download <i class="fa fa-download"></i> &nbsp; ',array('controller'=>'home','action' => 'export_payment_xls',$data
                                ),array(
                                'data-hint'=>'Download',
                                    'class'=>'',
                                    'escape'=>false,
                                    'style'=>'margin-top:25px;',
                                    'id'=>'download'
                                )
                            );
                            ?>
                        <div id="showPayDiv" style="display:none;">

                        </div>
                    </div>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>

                    <!-- <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div> -->

                <div class="box-content" style="max-height:450px; overflow:auto;">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
                         <thead>
                                  <tr style="background:#798899; color:#FFF">
                                      <th><?php echo __('S.No.');?></th>
                                      <!--<th><?php //echo __('Client Id');?></th> -->
                                      <th> <?php echo __('Date');?></th>
                                      <th> <?php echo __('Payment($)');?></th>
                                      <th> <?php echo __('Payment(￥)');?></th>
                                      <th> <?php echo __('Remark');?></th>
                                  </tr>
                              </thead>
                              <tbody id="PaymentDetails">
                            <?php
                                if($PaymentDetails)
                                {
                                    $count = 1;
                                foreach($PaymentDetails as $val) {?>
                                    <tr>
                                        <td class="center"><?php echo $count;  // echo $val['ClientPaymentHistory']['id'] ; ?></td>
                                        <!--<td class="center"><?php  //echo $val['ClientPaymentHistory']['client_id'] ; ?></td> -->
                                        <td class="center">
                                            <?php
                                                    $originalDate = $val['ClientPaymentHistory']['payment_date'];
                                                    $newDate = date("d-m-Y", strtotime($originalDate));
                                                    echo $newDate;
                                            ?>
                                        </td>
                                        <td class="center"><?php  echo $val['ClientPaymentHistory']['amount'] ; ?></td>
                                        <td class="center"><?php  echo $val['ClientPaymentHistory']['yen_amount'] ; ?></td>
                                        <td class="center"><?php  echo $val['ClientPaymentHistory']['remark'] ; ?></td>
                                    </tr>
                              <?php $count++;}}else{ ?>
                            <tr><td colspan="10" style="text-align:center">Payment History not found</td></tr>
                            <?php }?>
                              </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>
	<div class="clearfix"></div>
</div>

<script>
	function clearSearch(){
		$.ajax({
			url:"<?php echo $this->Html->url('clear_pay_detail_search',true);?>",
			type:"POST",
			data:{},
			dataType:"",
			beforeSend: function() {
					  $(".myloader").show();
				   },
			success:function(result)
			{
				$('#PaymentDetails').html(result);
				$("#showPayDiv").hide();
				$('#showPaySearchDivBtn').hide();
				$('#date03').val('');
				$('#date04').val('');
				$('#date03').attr("placeholder", "To Date");
				$('#date04').attr("placeholder", "From Date");
				$(".myloader").hide();



			}
		});
	}


	function saveData(form_id)
	{

		 var str = '[';
        $('[data-id = "client_check"]').each(function() {
			//alert(this.value);
			var keyTemp = this.value;
			var valTemp = $(this).prop('checked');
			//alert($(this).prop('checked'));
			str += '{ "'+keyTemp+'" : "'+valTemp+'" },';

        });
        var str = str.substring(0, str.length - 1);

        str += ']';

        var obj = jQuery.parseJSON(str);

		$.ajax({
			url:"<?php echo $this->Html->url('doc_status_mail',true);?>",
			type:"POST",
			data:{"data":obj},
			success:function(result)
			{
				var str = result.trim();
				var obj = jQuery.parseJSON(str);
				console.log(obj.status);
				if(obj.status == 'successSave')
				{
					$('#messageDivIdSucc').show();
					$('#messageDivIdSucc').html(obj.message);
					$('#messageDivIdSucc' ).delay(5000).fadeOut( "slow" );

				}
				if(obj.status == 'successCancel')
				{
					$('#messageDivIdSucc').show();
					$('#messageDivIdSucc').html(obj.message);
					$('#messageDivIdSucc' ).delay(5000).fadeOut( "slow" );
				}
				if(obj.status == 'successCancelErr')
				{
					$('#errmessageDiv').show();
					$('#errmessageDiv').html(obj.message);
					$('#errmessageDiv' ).delay(5000).fadeOut( "slow" );
				}
				if(obj.status == 'successSaveErr')
				{
					$('#errmessageDiv').show();
					$('#errmessageDiv').html(obj.message);
					$('#errmessageDiv' ).delay(5000).fadeOut( "slow" );
				}
			}

		});

	}



$(function() {


		$("#date03").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+20'});
		$( "#date04" ).datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+20'});
		$("#date01").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+20'});
		$( "#date02" ).datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+20'});
        $("#date012").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+20'});
        $( "#date022" ).datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-40:+20'});
		});


$("#button").click(function()
			{
				var fromDate  =$("#date04").val();
				var toDate  =$("#date03").val();
				var dataString = {'from':fromDate,'to':toDate};
				$.ajax({
					url:"<?php echo $this->Html->url('pay_detail_search',true);?>",
					type:"POST",
					data:dataString,
					beforeSend: function() {
					  $(".myloader").show();
				   },
					success:function(result)
					{
						$(".myloader").hide();
						$("#download").hide();

						var dwn_link = '<a id="download12" data-hint="Download" href="<?php echo $this->Html->url('export_payment_search_xls',true);?>?from_date='+fromDate+'&to_date='+toDate+'">Download<i class="fa fa-download"></i></a>';

						$("#showPayDiv").html(dwn_link);
						$("#showPayDiv").show();
						$('#PaymentDetails').html(result);
						$('#showPaySearchDivBtn').show();
					},
					faliure:function(result)
					{
						alert("Network Error");
					}
				});
		});


    $("#buybutton").click(function()
    {
        var fromDate  =$("#date01").val();
        var toDate  =$("#date02").val();

        var dataString = {'from':fromDate,'to':toDate};
        $.ajax({
            url:"<?php echo $this->Html->url('buy_detail_search',true);?>",
            type:"POST",
            data:dataString,
            beforeSend: function() {
                $(".myloader").show();
            },
            success:function(result)
            {
                $(".myloader").hide();
                $("#download_sale").hide();
                $('#cardetail').html(result);
                var dwn_link = '<a id="download12" data-hint="Download" href="<?php echo $this->Html->url('export_sale_history_search_xls',true);?>?from_date='+fromDate+'&to_date='+toDate+'">Download<i class="fa fa-download"></i></a>';
                $("#sale_search_div").html(dwn_link);
                $('#sale_search_div').show();
                $('#showAllUsrBuyDivBtn').show();

            },
            faliure:function(result)
            {
                alert("Network Error");
            }
        });
    });

	$("#salebutton").click(function()
			{
				var fromDate  =$("#date012").val();
				var toDate  =$("#date022").val();

				var dataString = {'from':fromDate,'to':toDate};
				$.ajax({
					url:"<?php echo $this->Html->url('sale_detail_search',true);?>",
					type:"POST",
					data:dataString,
					beforeSend: function() {
					  $(".myloader").show();
				   },
					success:function(result)
					{
						$(".myloader").hide();
						$("#download_sale").hide();
						$('#cardetail2').html(result);
						var dwn_link = '<a id="download12" data-hint="Download" href="<?php echo $this->Html->url('export_sale_history_search_xls',true);?>?from_date='+fromDate+'&to_date='+toDate+'">Download<i class="fa fa-download"></i></a>';
						$("#sale_search_div").html(dwn_link);
						$('#sale_search_div').show();
						$('#showAllUsrSaleDivBtn').show();

					},
					faliure:function(result)
					{
						alert("Network Error");
					}
				});
		});


 $(function(){
$('#hideDiv').delay(4000).fadeOut( "slow" );
});
    $(document).ready(function() {
        $('#selectbox-o').select2({

            minimumInputLength: 2,
            ajax: {
                url: '<?php echo $this->Html->url('carsearch', true);?>',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term
                    };
                },
                results: function (data, page) {

                    return {results: data};
                }
            }
        });


        $('#selectbox-o2').select2({

            minimumInputLength: 2,
            ajax: {
                url: '<?php echo $this->Html->url('carSellsearch', true);?>',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term
                    };
                },
                results: function (data, page) {

                    return {results: data};
                }
            }
        });

        $('#selectbox').select2({
            minimumInputLength: 2,
            ajax: {
                url: '<?php echo $this->Html->url('chassisSearch', true);?>',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term
                    };
                },
                results: function (data, page) {
                    //$('#userId').val(data.id);

                    return {results: data};
                }
            }
        });

        $('#selectbox2').select2({
            minimumInputLength: 2,
            ajax: {
                url: '<?php echo $this->Html->url('chassissellSearch', true);?>',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term
                    };
                },
                results: function (data, page) {
                    //$('#userId').val(data.id);

                    return {results: data};
                }
            }
        });
    });
    </script>
 <script>
	 // for invoice
		$(function()
		{
			$("#selectbox-o").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('car_detail_search',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o .select2-choice span").html(),id:$("#selectbox-o").val()},
					dataType:"html",
					beforeSend:function() {
					  $(".myloader").show();
				   },
					success:function(result)
					{
						 $(".myloader").hide();
						$('#cardetail').html(result);
						$('#showAllUsrBuyDivBtn').show();
					}
				});
		});

	});


     $(function()
     {
         $("#selectbox-o2").change(function()
         {
             $.ajax({
                 url:"<?php echo $this->Html->url('sell_car_detail_search',true);?>",
                 type:"POST",
                 data:{name:$("#s2id_selectbox-o2 .select2-choice span").html(),id:$("#selectbox-o2").val()},
                 dataType:"html",
                 beforeSend:function() {
                     $(".myloader").show();
                 },
                 success:function(result)
                 {
                     $(".myloader").hide();
                     $('#cardetail2').html(result);
                     $('#showAllUsrSaleDivBtn').show();
                 }
             });
         });

     });

	// for client

	$(function()
		{
			$("#selectbox").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('chassis_search_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html(),id:$("#selectbox").val()},
					dataType:"html",
					beforeSend:function() {
					  $(".myloader").show();
				   },
					success:function(result)
					{
						 $(".myloader").hide();
						$('#cardetail').html(result);
						$('#showAllUsrBuyDivBtn').show();


					}
				});
		});

	});

     $(function()
     {
         $("#selectbox2").change(function()
         {
             $.ajax({
                 url:"<?php echo $this->Html->url('chassis_search_detail',true);?>",
                 type:"POST",
                 data:{name:$("#s2id_selectbox2 .select2-choice span").html(),id:$("#selectbox2").val()},
                 dataType:"html",
                 beforeSend:function() {
                     $(".myloader").show();
                 },
                 success:function(result)
                 {
                     $(".myloader").hide();
                     $('#cardetail2').html(result);
                     $('#showAllUsrSaleDivBtn').show();


                 }
             });
         });

     });

</script>
<script>

	function showAllCarDetail(){
		$.ajax({
			url:"<?php echo $this->Html->url('cardetail',true);?>",
			type:"POST",
			data:{},
			dataType:"",
			success:function(result)
			{
				$('#cardetail').html(result);
				$('#selectbox-o').html('search......');
				$('#s2id_selectbox-o').find('span').html('Enter car name for search');
				$('#s2id_selectbox').find('span').html('Enter chassis no for search');
                $('#s2id_selectbox-o2').find('span').html('Enter car name for search');
                $('#s2id_selectbox2').find('span').html('Enter chassis no for search');
				$('#showAllUsrDivBtn').hide();
			}
		});
	}


</script>

<script type="text/javascript">

	function editPrice(ID)
	{
		$("#first_"+ID).hide();
		$("#first_input_"+ID).show();
		var price  =$("#first_input_"+ID).val();
		$("#edit"+ID).html('<input type="button" onclick="savePrice('+ID+');" value="Save"  class=" btn btn-success hint--bottom"  >');

	}

	function savePrice(ID)
	{
		var price  =$("#first_input_"+ID).val();
		var dataString = 'id='+ ID +'&price='+price;
		$.ajax({
		type: "POST",
		url:"<?php echo $this->Html->url('update_saleprice',true);?>",
		data: dataString,
		success: function(data)
		{
			var obj = jQuery.parseJSON( data );
			if(obj.status = 'success')
			$("#first_input_"+ID).hide();
			$("#first_"+ID).show();
			$("#first_"+ID).html("<span id='first_"+ID+"' class='text'>"+price+"</span>");
			$("#edit"+ID).html('<input type="button" onclick="editPrice('+ID+');" value="Edit"  class=" btn btn-success hint--bottom"  >');
		},
		failure: function(data)
		{
			alert('Error occur');
		}
		});

	}


	function docStatus(CarId)
	{

		var checkStatus= $("#checkbox_"+CarId).is(":checked");
		if(checkStatus==true)
		{
			var status = '1';
		}else
		{
			var status = '0';
		}

		var dataString = {'cId':CarId,'status':status};
		$.ajax({
		type: "POST",
		url:"<?php echo $this->Html->url('docStatus',true);?>",
		data: dataString,
		success: function(data)
		{

			var obj = jQuery.parseJSON( data );
			if(obj.status = 'checked')
			{

				/*var str = '<input type="checkbox"  id="checkbox_'+CarId+'"  onclick="docStatus('+CarId+')"  value="0" checked="unchecked" >';

				var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span class="checked"><input id="checkbox_'+CarId+'" type="checkbox" value="1" onclick="docStatus('+CarId+')" style="opacity: 0;"></span></div>';
				$("#td"+CarId).html(str1);*/
			}
			else
			{
				var str1 = '<div id="uniform-checkbox_'+CarId+'" class="checker"><span><input id="checkbox_'+CarId+'" type="checkbox" value="1" onclick="docStatus('+CarId+')" style="opacity: 0;"></span></div>';
				//var str = '<input type="checkbox"  id="checkbox_'+CarId+'"   onclick="docStatus('+CarId+')" value="1" checked="checked" >';
				$("#td"+CarId).html(str1);
			}

		},
		failure: function(data)
		{
			alert('Error occur');
		}
		});

	}

	function sendMail(CarId,email)
	{

		var checkStatus= $("#mail_"+CarId).is(":checked");
		if(checkStatus==true)
		{
			var status = '1';
		}else
		{
			var status = '0';
		}

		var dataString = {'cId':CarId,'status':status,'email':email};

		$.ajax({
			url:"<?php echo $this->Html->url('doc_status_mail',true);?>",
			type:"POST",
			data: dataString,
			success:function(result)
			{
			var obj = jQuery.parseJSON( result );
				if(obj.status=='success'){

					/*$('#messageDivIdSucc').show();
					$('#messageDivIdSucc').html(obj.message);
					$('#messageDivIdSucc' ).delay(5000).fadeOut( "slow" );*/
				}else{

					/*$('#errmessageDiv').show();
					$('#errmessageDiv').html(obj.message);
					$('#errmessageDiv' ).delay(5000).fadeOut( "slow" );*/
				}
			}
		});
	}

	 $(function(){
    $('#selectbox-a').select2({

    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('chassisSearch',true);?>',
    dataType: 'json',
    data: function (term, page) {
    return {
    q: term
    };
    },
    results: function (data, page) {

    return { results: data };
    }
    }
    });
    });

$(function()
		{
			$("#selectbox-a").change(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('all_history_search_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-a .select2-choice span").html(),id:$("#selectbox-a").val()},
					dataType:"html",
					success:function(result)
					{
						$('#all_history_data').html(result);
						$('#showAllUsrDivBtn').show();
					}
				});
		});

	});

$(function()
		{
			$("#clearSearchHistory").click(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('clear_all_history_search_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-a").html(),id:$("#selectbox-a").val()},
					dataType:"html",
					beforeSend:function() {
					  $(".myloader").show();
				   },
					success:function(result)
					{
						$(".myloader").hide();
						$('#all_history_data').html(result);
						$(".select2-choice span").html("Enter chechis no for search");
						//$("#selectbox-a").val("");
						$('#showAllUsrDivBtn').hide();

					}
				});
		});

	});

$(function()
		{
			$("#clearBuySearchHistory").click(function()
			{
				$.ajax({
					url:"<?php echo $this->Html->url('clear_all_buy_history_search_detail',true);?>",
					type:"POST",
					data:{name:$("#s2id_selectbox-o").html(),id:$("#selectbox-o").val(),client_id:$("#client_id option:selected").val()},
					dataType:"html",
					beforeSend:function() {
					  $(".myloader").show();
				   },
					success:function(result)
					{
						 $(".myloader").hide();
						$('#cardetail').html(result);
						//$('#cardetail2').html(result);
						$("#s2id_selectbox-o span").html("Enter car name for search");
						$("#s2id_selectbox span").html("Enter chechis no for search");
						$('#date01').val('');
						$('#date02').val('');
						$('#date02').attr("placeholder", "To Date");
						$('#date01').attr("placeholder", "From Date");
                        $('#date022').attr("placeholder", "To Date");
                        $('#date012').attr("placeholder", "From Date");
						$('#showAllUsrBuyDivBtn').hide();
						$("#download_sale").show();
						$('#sale_search_div').hide();

					}
				});
		});

	});


    $(function()
    {
        $("#clearSellSearchHistory").click(function()
        {
            $.ajax({
                url:"<?php echo $this->Html->url('clear_all_sell_history_search_detail',true);?>",
                type:"POST",
                data:{name:$("#s2id_selectbox-o2").html(),id:$("#selectbox-o2").val(),client_id:$("#client_id option:selected").val()},
                dataType:"html",
                beforeSend:function() {
                    $(".myloader").show();
                },
                success:function(result)
                {
                    $(".myloader").hide();
                    $('#cardetail2').html(result);
                    //$('#cardetail2').html(result);
                    $("#s2id_selectbox-o2 span").html("Enter car name for search");
                    $("#s2id_selectbox2 span").html("Enter chechis no for search");
                    $('#date01').val('');
                    $('#date02').val('');
                    $('#date02').attr("placeholder", "To Date");
                    $('#date01').attr("placeholder", "From Date");
                    $('#date022').attr("placeholder", "To Date");
                    $('#date012').attr("placeholder", "From Date");
                    $('#showAllUsrSaleDivBtn').hide();
                    $("#download_sale").show();
                    $('#sale_search_div').hide();

                }
            });
        });

    });


</script>
