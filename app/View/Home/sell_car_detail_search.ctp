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
                echo $newDate ;
                ?></td>
            <td class="center"><?php
                $carId = $val['CarPayment']['car_id'];
                echo $this->Html->link(@$val['CarName']['car_name'],array('controller'=>'home', 'action'=>'car_show',$carId),array('escape' => FALSE,'target'=>'_blank'));

                //echo @$val['Car']['CarName']['car_name'] ; ?></td>
            <td class="center"><?php echo $val['Car']['cnumber'] ; ?></td>

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
