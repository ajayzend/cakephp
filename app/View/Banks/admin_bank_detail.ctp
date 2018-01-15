<div class="box col-md-12">
<table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr class="colr_body">
									  <!-- <th>S.No</th> -->
									  <td>Bank Name</td>
									  <td>Branch Name</td>
									  <td>Swift Name</td>
									  <td>Account No</td>
									  <td>Account Name</td>  
									  <td>Discription</td>
									  <td>Action</td>                                        
								  </tr>
							  </thead>   
							  <tbody class="colr_body" id="bankBody">
							  <?php 
							  $srNo =1;
							  foreach($Bank as $data=>$val){
							  ?>
								<tr id="bankId_<?php echo $val['Bank']['id'];?>">
									<!-- <td data-sorting="sort"><?php echo $srNo ;?> </td> -->
									<td class="center"><?php echo $val['Bank']['bank_name'] ;?></td>
									<td class="center"><?php echo $val['Bank']['branch_name'] ;?></td>
									<td class="center"><?php echo $val['Bank']['swift_name'];?></td>
									<td class="center"><?php echo $val['Bank']['account_no'] ;?></td>
									<td class="center"><?php echo $val['Bank']['account_name'] ;?></td>
									<td class="center"><?php echo $val['Bank']['discription'] ;?></td>
									<td class="center">
										
										<button onclick="editBank(<?php echo $val['Bank']['id'];?>,<?php echo $pages;?>);" class='btn btn-info hint--bottom' data-hint="Edit" ><i class="fa fa-pencil " ></i></button>
						 
										<a href="javascript:checkDelete(<?php echo $val['Bank']['id'];?>,<?php echo $pages;?>);" class='btn btn-danger hint--bottom' data-hint="Delete"><i class="fa fa-trash-o"></i></a>
										
									</td>
								</tr>
							<?php $srNo++;}?>	                          
							  </tbody>
						 </table> 
						
						
		<?php if($count > $limit) { ?>
		<div id="paginationDiv" class="pull-right">  
		<ul class=" pagination">
			<?php
			echo $this->Paginator->options(array('url'=>array('controller'=>'banks','action'=>'paginate_search','searchName'=>$searchName)));
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
				echo $this->Paginator->next(__('Next'), array(
				'tag' => 'li',
				'label' => false,
				'class' => null
				));
			?>


						</ul>
						</div>
		<?php }?> 
					
					</div>
</div>
