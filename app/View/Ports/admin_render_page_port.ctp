<div id="divid127">
		<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr class="colr_body">
									  <th></th>
									  <th>Port Name</th>
									  <th>Country Name</th>
									  <th>Auction</td>
									  <th>Transport Name</th>
									  <th>Rickshaw</th>
									  <th>Actions</th>                                          
								  </tr>
							  </thead>   
							  <tbody id="portBody">
							  <?php 
							  $srNo++;
							  foreach($portDetails as $data=>$val){
							  ?>
								<tr id="portId_<?php echo $val['Port']['id'];?>">
                                	<td data-sorting="sort"><input type="checkbox" value="<?php echo $val['Port']['id'];?>" name="PortIds[]"></td>
									<td class="center"><?php echo $val['Port']['port_name'] ;?></td>
									<td class="center"><?php echo $val['Country']['country_name'] ;?></td>
									<td class="center"><?php echo $val['Auction']['auction_name'].'-'.$val['Auction']['auction_place'] ;?></td>
									<td class="center"><?php echo $val['Transport']['transport_name'] ;?></td>
									<td class="center"><?php echo $val['Port']['rickshaw'] ;?></td>
									<td class="center">
										
										<button onclick="editPort(<?php echo $val['Port']['id'];?>,<?php echo $pages;?>);" class='btn btn-info hint--bottom' data-hint="Edit" ><i class="fa fa-pencil " ></i></button>
						 
										<a href="javascript:checkDelete(<?php echo $val['Port']['id'];?>,<?php echo $pages;?>);" class='btn btn-danger hint--bottom' data-hint="Delete"><i class="fa fa-trash-o"></i></a>
										
									</td>
								</tr>
							<?php $srNo++;}?>	                          
							  </tbody>
						 </table> 
		
		
		<!-- Modal -->
		<?php if($count > $limit) { ?>
			<div id="paginationDivId" class="col-md-6 pull-right">
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
