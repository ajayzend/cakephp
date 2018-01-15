<?php echo $this->Html->script('jquery-1.7.2.min'); ?>
<?php echo $this->Html->script('jquery.form');?>
<?php 
echo $this->Session->flash();?>
<div>
	<?php 
      echo $this->Common->breadcrumb(array($this->webroot.'admin'=>'Home',
									 'null'=>'Slider Management'
									));
      
      ?> 

<div class="row-fluid">	

	<div class="box span12">

				<div class="box-header well">
					<h2><i class="icon-cog"></i>Slider Management</h2>
					<div class="err_msg session_msg"></div>
				</div>



<div class="box-content">
		
			<table class="table table-striped table-bordered" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
						  <thead>
							  <tr role="row">
							  	
								
							  	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 204px;" aria-sort="ascending" aria-label="Username: activate to sort column ascending">S.No</th>
							  	
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 196px;" aria-label="Date registered: activate to sort column ascending">Car</th>
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 96px;" aria-label="Role: activate to sort column ascending">No. of Slides</th>
							  	<!--
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 106px;" aria-label="Status: activate to sort column ascending">Status</th>
							  	-->
							  	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 379px;" aria-label="Actions: activate to sort column ascending">Actions</th>
							  </tr>
							  
						  </thead>   
						  
					  <tbody role="alert" aria-live="polite" aria-relevant="all">
					  	<tr class="odd">
						<?php
						
							$i=1;
							foreach($slide_products as $slide_product){
								
								if(!empty($slide_product['SliderManagement'])){
								echo "<tr>";
						?>		
								
						<?php
								echo "<td class='sorting_1'>".$i."</td>";
								$i++;
								echo "<td class='sorting_1'>".$slide_product['Product']['name']."</td>";
								//pr(count($slide_product['SliderManagement']));die;
								echo "<td class='center '>".count($slide_product['SliderManagement'])."</td>";
								
								
							
						?>	
						
							
								<td class="center ">
									
									
								
								<?php echo $this->html->link($this->html->tag('i', '', array('class' => 'icon-pencil')) . ' Edit',array('action' => 'edit/'.$slide_product['Product']['id']), array('escape' => false,'class'=>array('btn btn-info'),'label'=>false,'title'=>'click here to edit')); ?> 
								
									<?php echo $this->html->link($this->html->tag('i', '', array('class' => 'icon-trash')) . ' Delete',array('action' => 'delete/'.$slide_product['Product']['id']), array('escape' => false,'confirm'=>'Are You Sure you want to delete',
'class'=>array('btn','btn-danger'),'label'=>false,'title'=>'click here to delete')); ?> 

								
							<?php	
							echo "</tr>";
								
								}
							}	
							?>	
							
							
							
							</tbody>
							</table>
						<?php echo $this->html->link($this->html->tag('i', '', array('class' => 'icon-plus-sign-alt')) . ' Add',array('action' => 'add'),
							array('escape' => false,'class'=>array('btn btn-info'),'label'=>false,'title'=>'click here to add')); 
							?>
							</tr>	


	
</div>	




