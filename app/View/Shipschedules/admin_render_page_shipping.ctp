<div id="divid127">
		<table id="myTable" border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
			<thead>
				<tr class="colr_body">
					<td>Ship Name</td>
					<td>Region</td>
					<td>VOYAGE NO</td>
					<td>Departure Port</td>
					<td>Departure Date</td>				
					<td>Arrival Port</td>
					<td>Arrival Date</td>
					<td>Via Location</td>
					<td>Remark</td>
                    <td>Chasis Number</td>
					<td>Status</td>
					<td>Actions</td>
				</tr>
			<tbody id="searchdata" class="colr_body">
			</thead>
			<?php 
					$srNo++;
					foreach($shippingSchedule as $val){?>
						<tr id="shipTrId<?php echo $val['Shipschedule']['id'];?>">
							<!-- <td data-sorting="sort"><?php echo $srNo;?></td> -->
							
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['ship_name'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['region'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['ship_no'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['departure_port'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php  echo date('d-M-Y',strtotime($val['Shipschedule']['departure_date'])); ?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['arrival_port'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo date('d-M-Y',strtotime($val['Shipschedule']['arrival_date'])); ?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['via_location'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['remark'];?></td>
                            <td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>"><?php echo $val['Shipschedule']['chasis'];?></td>
							<td id="shipTdNme<?php echo $val['Shipschedule']['id'];?>">
							
							<?php 
											if ($val['Shipschedule']['status']==0) {
													$status = "Publish";
													$style ="btn btn-success"; 
												} else {
													$status = "Unpublish";
													$style ="btn btn-danger";
												} 
											?>
											
											<input type="button" class="<?php echo $style ;?>" id="status<?php echo $val['Shipschedule']['id'];?>" onClick="ShipStatus(<?php echo $val['Shipschedule']['id'];?>)" value="<?php echo $status ;?>" />
											<img id="loading<?php echo $val['Shipschedule']['id'];?>" src="<?php echo $this->webroot; ?>img/loading.gif" height="20px" width="15px" style="display:none;"/>
							
							</td>
							
							
							
							<td class="auction_carname">
								<a class="btn btn-info hint--bottom"  data-hint="Edit"  href="javascript:editName('<?php echo $val['Shipschedule']['id'];?>','<?php echo $val['Shipschedule']['ship_name'];?>','<?php echo $val['Shipschedule']['ship_no'];?>','<?php echo $val['Shipschedule']['region'];?>','<?php echo $val['Shipschedule']['departure_port'];?>','<?php echo $val['Shipschedule']['departure_date'];?>','<?php echo $val['Shipschedule']['arrival_port'];?>','<?php echo $val['Shipschedule']['arrival_date'];?>','<?php echo $val['Shipschedule']['via_location'];?>','<?php echo $val['Shipschedule']['remark'];?>', '<?php echo $val['Shipschedule']['chasis'];?>')"><i class="fa fa-pencil"></i></a>
								
								<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Shipschedule']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>

					<?php $srNo++;} ?>
		</table>
		
		
		<!-- Modal -->
		<?php if($count > $limit) { ?>
			<div id="paginationDivId" class="col-md-6 pull-right">
				<ul class=" pagination pull-right">
					<?php
				echo	$this->Paginator->options(array('url'=>array('action'=>'add_shipping')));
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
