<div id="content1">
<div class="row sordiv">
<div class="box col-md-12">
			<div class="box-header well">				
				<h2 class="col-md-12"><i class="fa fa-file-text-o"></i> <?php echo __('Invoice Address List')?>				
				<?php echo $this->Html->link('Go Back',array('action' => 'page_list','controller'=>'pages'),array('class'=>'btn btn-primary pull-right'));?>
				
				<?php echo $this->Html->link('Add  Invoice Address',array('action' => 'add_address','controller'=>'pages'),array('class'=>'btn btn-primary pull-right'));?>  
				  </h2> 
				<div class="clearfix"></div>				
			</div>
			
			
			
							<div id="showmsg"></div>
							<div style="display:none;" id="messageDivIdSucc" class="alert alert-success "></div>
							<div style="display:none;" id="errmessageDiv" class="alert alert-danger"></div>
							<?php
							if(isset($msg))
							{?>
							
								<div class="alert alert-success">
										<strong><?php echo $msg ;?></strong>
								</div>
							
							<?php }?>
							<?php
							$success = $this->Session->flash(); 
							if($success) {?>
							
								<div class="alert alert-success">
										<strong><?php echo $success ;?></strong>
								</div>
							
							<?php }?>
							<div class="row">
					 
						<table class="table table-striped table-bordered  custom_table">
						<thead>								
							<tr class="colr_body">
								<th style="width:33%;">Sr No</th>
								<th style="width:33%;">Discription</th>
								<th>Action</th>
							</tr>
						</thead>   
					  <tbody class="searchData" id="searchdata">
						  <?php $i=1;
						  
							foreach($content as $result)
							{ 
							?>					
								<tr  data-placement="left" data-toggle="tooltip">
									<td><?php echo $i;?></td>							
									<td><?php echo $result['InvoiceAddress']['discription'];?></td>
								    <td><a data-hint="Edit" class="btn btn-info hint--bottom" 
								   href="<?php echo $this->Html->url('/',true); ?>pages/edit_address/<?php echo $result['InvoiceAddress']['id'];?>"><i class="fa fa-pencil"></i></a>	
									 </td>
								</tr> 
							<?php  $i++;
							} ?>
						</tbody>
					  </table>
					</div>
							
							

		</div><!--/fluid-row-->
</div>
</div>
