<div id="divid127"> 
		<table id="myTable" border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
			<thead>
				<tr class="colr_body">
					<!-- <td>Sr.No</td> -->
					<td>Shipping Name</td>
					<td colspan="3">Actions</td>
				</tr>
			<tbody id="searchdata" class="colr_body">
			</thead>
			<?php 
					$srNo++;
					foreach($Shipping as $val){?>
						<tr id="shipTrId<?php echo $val['Shipping']['id'];?>">
							<!-- <td data-sorting="sort"><?php echo $srNo;?></td> -->
							
							<td id="shipTdNme<?php echo $val['Shipping']['id'];?>"><?php echo $val['Shipping']['company_name'];?></td>
							<td class="auction_carname">
								<a class="btn btn-info hint--bottom"  data-hint="Edit"  href="javascript:editName('<?php echo $val['Shipping']['id'];?>','<?php echo $val['Shipping']['company_name'];?>')"><i class="fa fa-pencil"></i></a>
								
								<a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['Shipping']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
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
