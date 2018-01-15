                          
						 <?php
								$srNo=1;	
							  foreach($invoiceDetails as $data=>$val){
							  ?>
								<tr>
									<!--<td data-sorting="sort"><?php //echo $srNo; ?></td>-->
									<td class="center"><?php echo $val['Invoice']['invoice_no'] ;?></td>
									<td class="center"><?php $date = date('d-m-Y',strtotime($val['Invoice']['created']));   echo $date ;?></td>
									
									<td class="center">
									<?php $st = explode("/",$val['Invoice']['invoice_no']);?>
										<?php //echo $this->Html->link('Download',array('action' => 'generate',$st[2]),array('class'=>'btn btn-success'));?>
										<?php										
echo $this->Html->link(
   '<i class="fa fa-download"></i>',
    array(
    	'action' => 'generate',$st[1] 
    ),
    array(
    
        'data-hint'=>'Download',
        'class'=>'btn btn-success hint--bottom',
        'escape'=>false  
    )
);
?>
									</td>
								</tr>
							<?php $srNo++; }?>
