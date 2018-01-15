<div class="ProductDetailLeftPanel">
    <h1 class="PageTitle">Shipping <span>Schedule</span></h1>
    <div class="row">
        <div class="myloader" id="loading2" style="display:none;"><img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> </div>
        
        <div class="col-sm-3 form-group">
        <label class="LoginFormLabel" for="region">Region</label>
        <?php echo  $this->Form->input('region',array('type'=>'select','options'=>$region,'class'=>'form-control chosen-select FilterSelectBoxRight','label'=>false,'data-rel'=>'chosen','id'=>'region','value'=>"AFRICA",'empty'=>'Select Region')); ?>
        <!--<input type="text" class="form-control" name="region" id="region" placeholder="Please enter 1 more characters">-->
        </div>
        
        <div class="col-sm-3 form-group">
        <label class="LoginFormLabel" for="ship_name">Shipping Company</label>
        <?php echo  $this->Form->input('ship_name',array('type'=>'select','options'=>$dataShipName,'class'=>'form-control chosen-select FilterSelectBoxRight','label'=>false,'data-rel'=>'chosen','id'=>'ship_name','empty'=>'Select Ship Name')); ?>
        
        <!--<input type="text" class="form-control" name="ship_name" id="ship_name" placeholder="Please enter 1 more characters">-->
        
        </div>
        <div class="col-sm-3 form-group">
        <label class="LoginFormLabel" for="departure">Departure Port</label>
        <?php echo  $this->Form->input('departure_port',array('type'=>'select','options'=>$dataDepPort,'class'=>'form-control chosen-select FilterSelectBoxRight','label'=>false,'data-rel'=>'chosen','id'=>'departure_port','selected'=>"",'empty'=>'Select Departure Port')); ?>
        
        <!--<input type="text" class="form-control" name="departure_port" id="departure_port" placeholder="Please enter 1 more characters">-->
        
        </div>
        <div class="col-sm-3 form-group">
        <label class="LoginFormLabel" for="arrival">Arrival port</label>
        
        <?php echo  $this->Form->input('arrival_port',array('type'=>'select','options'=>$dataArrPort,'class'=>'form-control chosen-select FilterSelectBoxRight','label'=>false,'data-rel'=>'chosen','id'=>'arrival_port','selected'=>"",'empty'=>'Select Arrival Port')); ?>
        
        <!--<input type="text" class="form-control" name="arrival_port" id="arrival_port" placeholder="Please enter 1 more characters">-->
        
        </div>
        
        <div class="col-sm-3 form-group">
        <label class="LoginFormLabel" for="date_departure">Date of Departure</label>
        <input type="text" class="form-control BidAmountTextBox" placeholder="Date of Departure" name="departure_date" id="departure_date" >
        </div>
        
        <div class="col-sm-3 form-group">
        <label class="LoginFormLabel" for="date_arrival">Date of Arrival</label>
        <input type="text" class="form-control BidAmountTextBox" placeholder="Date of Arrival" name="arrival_date" id="arrival_date">
        </div>
        <div class="col-sm-3 form-group">
        <button class="ProductDetailBuyNowButton hvr-pulse-grow col-lg-12" id="search"  onclick="searchScedule();" style="margin-top:35px;">Search</button>
        </div>
        <!--</form>-->
    </div>
    <div style="max-height:380px; overflow:auto;">
    <table class="table table-hover table-bordered table-condence">
        <thead>
            <tr style="background:#798899; color:#FFF">
                <th class="active">Shipping Company</th>
                <th class="info">Ship Name</th>
                <th class="success">Departure Port</th>
                <th class="warning">Departure Date</th>
                <th class="ar_port">Arrival Port</th>
                <th class="ar_date">Arrival date</th>
                <th class="danger">ReShipping Companymark</th>
                <th>Via Location</th>
            </tr>
        </thead>
        <tbody id="searchData">
			<?php 
            if($regionWithAfrica)
            {
            foreach($regionWithAfrica as $details)
            {	
            ?>	
                <tr>
                    <td class="active"><?php echo $details['Shipschedule']['ship_name'];  ?></td>
                    <td class="info"><?php echo $details['Shipschedule']['ship_no'];  ?></td>
                    <td class="success"><?php echo $details['Shipschedule']['departure_port'];  ?></td>
                    <td class="warning"><?php echo date('d-M-Y',strtotime($details['Shipschedule']['departure_date'])); ?></td>
                    <td class="ar_port"><?php echo $details['Shipschedule']['arrival_port'];  ?></td>
                    <td class="ar_date"><?php echo date('d-M-Y',strtotime($details['Shipschedule']['arrival_date'])); ?></td>
                    <td class="danger"><?php echo $details['Shipschedule']['remark'];  ?></td>
                    <td><?php echo $details['Shipschedule']['via_location'];  ?></td>
                </tr>
            <?php }}else { ?>
            <tr>
            	<td colspan ="8" align="center" >Result not found</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <div class="clearfix"></div>
</div>
<script>
	
	$(function() {
		var region = 'AFRICA'; 
			 $.ajax({
					url:"<?php echo $this->Html->url('/home/search_shipping_company',true)?>",
					type:"POST",
					data:{'region':region},
					dataType:'JSON',
					success:function(result)
					{
						var select = '<option value =""> Select Ship Name</option>';	
						$.each(result, function( index, value ) {						
							select +='<option value ="'+ value.shipName+'">';
							select += value.shipName;
							select +='</option>';
						});			
						$("#ship_name").html(select);
						 $("#ship_name").trigger("liszt:updated");

					},
					failure:function(result)
					{
						alert('Network Problem');
					}
					
				}); 
		
		});
	
	
	$(function(){
	 $("#region").change(function(){
			var region = $(this).val(); 
			 $.ajax({
					url:"<?php echo $this->Html->url('/home/search_shipping_company',true)?>",
					type:"POST",
					data:{'region':region},
					dataType:'JSON',
					success:function(result)
					{
						var select = '<option value =""> Select Ship Name</option>';	
						$.each(result, function( index, value ) {
							
							select +='<option value ="'+ value.shipName+'">';
							select += value.shipName;
							select +='</option>';

						});			
						$("#ship_name").html(select);
						 $("#ship_name").trigger("liszt:updated");
						 console.log(select);
						
					},
					failure:function(result)
					{
						alert('Network Problem');
					}
					
				});	
		 });
	 });
	
	
	
	$(function() {
		$("#departure_date").datepicker({ changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy' ,yearRange: '-40:+0'}); 
		$("#arrival_date").datepicker({ changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy',yearRange: '-40:+0' }); 
		
		});	
		
	function searchScedule()
	{
		
		var region = $('#region').val();
		var ship_name = $('#ship_name').val(); 
		var departure_port = $('#departure_port').val();
		var arrival_port = $('#arrival_port').val();
		var departure_date = $('#departure_date').val();
		var arrival_date = $('#arrival_date').val();  	
		var datas  =  {'region':region,'shipName':ship_name,'departureDate':departure_date,'departure_port':departure_port,'arrivalPort':arrival_port,'arrivalDate':arrival_date}; 
		//alert(region+' '+ship_name+' == '+ departure_date+' == '+ departure_port+' == '+arrival_port +' == '+arrival_date);
		$.ajax({
			url:"<?php echo $this->Html->url('/home/ship_schedule_search',true)?>",
			type:"POST",
			data:datas,
			beforeSend: function() {
				  $("#loading2").show();
			   },
			success:function(result)
			{
				$("#loading2").hide();
				$('#searchData').html(result);
			},
			failure:function(result)
			{
				alert('Network Problem');
			}
			
		});	
	}	
		
</script>
