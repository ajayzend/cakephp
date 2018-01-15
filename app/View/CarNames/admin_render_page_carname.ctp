<div id="divid127">
		<table id="myTable" border="1" cellspacing="10" class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
			<thead>
				<tr class="colr_body">
					<!-- <td>S.No</td> -->
					<td>Car Name</td>
                    <td>Brand</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody id="searchdata" class="colr_body">
				
					<?php 
					$srNo++;
					foreach($CarName as $val){?>
						<tr id="carnameTrId<?php echo $val['CarName']['id'];?>">
                            <td id="carnameTdNme<?php echo $val['CarName']['id'];?>"><?php echo $val['CarName']['car_name'];?></td>
                            <td id="carBrandTdNme<?php echo $val['CarName']['id'];?>"><?php echo $val['Brand']['brand_name'];?></td>
                            <td class="auction_carname">
                                <a class="btn btn-info hint--bottom"  data-hint="Edit" href="javascript:editName('<?php echo $val['CarName']['id'];?>','<?php echo $val['CarName']['car_name'];?>')"><i class="fa fa-pencil"></i></a>
                                
                                <a class="btn btn-danger hint--bottom"  data-hint="Delete" href="javascript:checkDelete(<?php echo $val['CarName']['id'];?>,<?php echo $pages;?>)"><i class="fa fa-trash-o"></i></a>
                            </td>
						</tr>

					<?php $srNo++;} ?>
				
		</table>
		
		
		<!-- Modal -->
		<?php if($count > $limit) { ?>
			<div id="paginationDivId" class="col-md-6 pull-right">
				<ul class=" pagination pull-right">
					<?php
				echo	$this->Paginator->options(array('url'=>array('action'=>'add_carname')));
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
