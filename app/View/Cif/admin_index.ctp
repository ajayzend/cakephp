<?php
?>
<div id="content1">   
<div id="mainDiv">
<div class="row sortable">
<div class="box col-md-12">
<div class="box-header well">
    <div class="col-md-12"><h2><i class="fa fa-cogs">&nbsp;</i>Cif Price Query</h2></div>
    <div class="clearfix"></div>	
</div>
				
                <form method="post" name="form1" id="form1">
						<div id="divid127">
						
                        <table class="table table-striped table-bordered bootstrap-datatable datatable custom_table">
							  <thead>
								  <tr class="colr_body">
									 <th>Name</th>
									  <th>Country</th>
                                      <th>Email</th>
                                      <th>Stock Id</th>
                                      <th>Chassis No.</th>
                                      <th>Contact No.</th>
                                      <th>Query</th>
									<th>Price</th>
									  <th>Date</th>                                          
								  </tr>
							  </thead>   
							  <tbody class="colr_body" id="portBody">
							  <?php 
							  $srNo++;
							  foreach($RecordsData as $val){
							  ?>
								<tr>
									<td class="center"><?php echo $val['Cif']['cif_name']?></td>
									<td class="center"><?php echo $val['Cif']['cif_country']?></td>
                                    <td class="center"><?php echo $val['Cif']['cif_email']?></td>
                                    <td class="center"><?php echo $val['Cif']['cif_stock']?></td>
                                    <td class="center"><?php echo $val['Cif']['cif_chassis']?></td>
                                    <td class="center"><?php echo $val['Cif']['cif_contact']?></td>
                                    <td class="center"><?php echo nl2br($val['Cif']['cif_message'])?></td>
									<td class="center"><?php echo $val['Cif']['cif_price']?></td>

                                    <td class="center"><?php echo date("d F, Y", strtotime($val['Cif']['cif_date']))?></td>
								</tr>
							<?php $srNo++;}?>	                          
							  </tbody>
						 </table> 
						
                        
						
		<?php if($count > $limit) { ?>
		<div id="paginationDiv" class="pull-right">  
		<ul class=" pagination">
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
				echo $this->Paginator->next(__('Next'), array(
				'tag' => 'li',
				'label' => false,
				'class' => null
				));
			?>


						</ul>
		<?php }?> 
					</div>
					</div>
                    
                    </form>
		
		<div class="clearfix"></div>
				</div>
				</div>
				</div>
		</div>
	</div>