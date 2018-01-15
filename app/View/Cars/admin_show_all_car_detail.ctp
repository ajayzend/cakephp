<?php $i=1;?>
						  <?php foreach($carDetail as $Detail){?>

						<tr>
						
						<?php echo '<td>'.$i.'</td>
						<td>'.$Detail['Car']['uniqueid'].'</td>
						<td>'.$Detail['Car']['country_name'].'</td>
						<td>'.$Detail['Car']['car_name'].'</td>
						<td>'.$Detail['Car']['cnumber'].'</td>
						<td>'.$Detail['Car']['transmission'].'</td>
					
						<td>'.$Detail['Car']['handle'].'</td>
						<td>'.$Detail['Car']['fuel'].'</td>
						<td>'.$Detail['Car']['stock'].'</td>
						<td>'.$Detail['Car']['uniqueid'];?></td><td class="right_bordr1">
				 <?//php echo $this->Html->link('View',array('action' => 'view', $Detail['Car']['id']),array('class' => 'btn btn-success'));?></td><td  class="right_bordr">
                  <?php echo $this->Html->link('Edit',array('action' => 'addnew_car', $Detail['Car']['id']),array('class' => 'btn btn-info'));?></td><td  class="right_bordr">
				  <?php echo $this->Form->postLink('Delete',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger')).'</td></tr>';
                           $i++;
						 } ?>
<div id="paginationDiv" class="col-md-6 pull-right">
								<ul class=" pagination pull-right">
								<?php
    echo $this->Paginator->prev('Prev', array(
        'tag' => 'li',
        'label' => false
    ));
?>
								<?php
    echo $this->Paginator->numbers(array(
        'tag' => "li",
        'separator' => null,
        'currentClass' => 'active'
    ));
?>
								<?php
    echo $this->Paginator->next(__('next'), array(
        'tag' => 'li',
        'label' => false,
        'class' => null
    ));
?>
							</ul>
				
				</div><!--/span-->
               <div class="clear"></div>
