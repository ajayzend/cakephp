 <?php if(isset($port_id))
			$port_id = $port_id;
		else
			$port_id = '';
  ?>
 
 <label class="control-label" for="inputbodystyle"> Port Name </label> <!-- 'selected'=>$portId, -->
			   <?php echo $this->Form->input('port_id',array('type'=>'select','options'=>@$GetAuction,'name'=>"data[Car][port_id]",'id'=>'portData_id','data-rel'=>'chosen','selected'=>@$port_id ,'empty'=>'Select Port','div'=>false,'label'=>false));?>

				
