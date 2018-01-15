<?php
?>
<div id="divid127">

	  <tbody id="searchdata" class="searchData">
		<!--<tr>
			<td>
				<label class="checkbox inline">
					<div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" value="option1" id="inlineCheckbox1" style="opacity: 0;"></span></div> 
			  </label>
			 </td>-->
			 <?//php pr($carDetail);?>
			 <?//php $serialNumber++;?>
			 <?php foreach($CarChassis as $Detail){
			//	 pr($Detail);
				 ?>
			
			<tr>
			<td><input type='checkbox' name='checkbox'  class="select_checkbox"  value='<?php echo $Detail['Car']['id'];?>'></td>
			<?php echo '
			<td>'.$Detail['Car']['uniqueid'].'</td>
			<td>'.$Detail['Country']['country_name'].'</td>
			<td>'.$Detail['CarName']['car_name'].'</td>
			<td>'.$Detail['Car']['cnumber'].'</td>
			<td>'.$Detail['Car']['transmission'].'</td>
			
			<td>'.$Detail['Car']['handle'].'</td>
			<td>'.$Detail['Car']['fuel'].'</td>
			<td>'.$Detail['Car']['stock'];?></td><td>
			<?php if ($Detail['Car']['publish']==1) {
										$status = "Publish";
										$style ="btn btn-success"; 
									} else {
										$status = "Unpublish";
										$style ="btn btn-danger";
									};?>
			
			<input type="button" class="<?php echo $style ;?>" id="carStatus<?php echo $Detail['Car']['id'];?>" onClick="CarStatus(<?php echo $Detail['Car']['id'];?>)" value="<?php echo $status ;?>" />
			<img id="loading<?php echo $Detail['Car']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/> 
			</td><td class="right_bordr1">
	 
	  <?php echo $this->Html->link('<i class="fa fa-pencil">&nbsp;</i>',array('action' => 'addnew_car', $Detail['Car']['id']),array('class' => 'btn btn-info hint--bottom','data-hint'=>'Edit','escape'=>false ));?>
	  <?php echo $this->Form->postLink('<i class="fa fa fa-trash-o">&nbsp;</i>',array('action' => 'delete', $Detail['Car']['id']), array('confirm' => 'Are you sure?','class' => 'btn btn-danger hint--bottom ','data-hint'=>'Delete','escape'=>false));?>
	  <?php echo $this->Html->link('<i class="fa fa-globe">&nbsp;</i>',array('action' => 'addnew_car',$Detail['Car']['id'],'?data=sale'),array('class' => 'btn btn-primary hint--bottom','data-hint'=>'Sale','escape'=>false)).'';
			 //  $serialNumber++;
			 } ?>
			</td></tr>
	</tbody>

<!-- Modal -->
<?php if($count > $limit) { ?>
<div id="paginationDivId" class="pull-right">
	<ul class=" pagination pull-right">
		<?php
	echo	$this->Paginator->options(array('url'=>array('action'=>'index')));
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
</div>  
<?php } ?>


</div>
</div>
