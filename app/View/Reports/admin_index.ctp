<style>
ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px Tahoma; list-style-type:none; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }
ul.tsc_pagination li:first-child { margin-left:0px; }
ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }
ul.tsc_pagination li a img { border:none; }
ul.tsc_paginationC li a { color:#707070; background:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; border:solid 1px #DCDCDC; padding:6px 9px 6px 9px; }
ul.tsc_paginationC li { padding-bottom:1px; }
ul.tsc_paginationC li a:hover,
ul.tsc_paginationC li a.current { color:#FFFFFF; box-shadow:0px 1px #EDEDED; -moz-box-shadow:0px 1px #EDEDED; -webkit-box-shadow:0px 1px #EDEDED; }
ul.tsc_paginationC01 li a:hover,
ul.tsc_paginationC01 li a.current { color:#893A00; text-shadow:0px 1px #FFEF42; border-color:#FFA200; background:#FFC800; background:-moz-linear-gradient(top, #FFFFFF 1px, #FFEA01 1px, #FFC800); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #FFEA01), color-stop(1, #FFC800)); }
ul.tsc_paginationC li a.In-active {
   pointer-events: none;
   cursor: default;
}
</style> 
<?php echo $this->Html->css(array('select2'));?>
<?php echo $this->Html->script(array('select2.min'));?>
<?php if(isset($this->params->query['tab']))
	{
	 $class ="bid-tab-show"	;
	}else
	{
	 $class ="";
	}

	  
		//echo date_default_timezone_get();
		//echo date("Y/m/d H:i:s"); die;
	?>
<div id="content1"> 
	<div class="box col-md-12">
		<div class="box-header well">
			<div class="col-md-12">
				<h2><i class="fa fa-list-alt"></i> Report Management</h2></div>
			<div class="clearfix"></div>	
		</div>
		<div class="report-management">
			<div class="row"> 
				<div class="col-md-12">
					<ul id="myTab" class="nav nav-tabs admin_tab">
						<li class="active"><a data-toggle="tab" class="rounded_tab" id="daily" href="#daily-report">Daily Report</a></li>
						<li><a data-toggle="tab" class="rounded_tab " id="yearly" href="#yearly-report">Yearly Report</a></li>
						<!--<li><a data-toggle="tab" class="rounded_tab " id="sales" href="#sales-report">Sales Report</a></li>-->
						<li  class="<?php echo $class ; ?>"><a data-toggle="tab" class="rounded_tab " id="bidReport" href="#bid-report">Bid Report</a></li>
				    </ul>
				</div> 
			 </div>
			 <div id="my-tab-content" class="tab-content reports">
				<div class="tab-pane active" id="daily-report"><!--Daily Report-->
					<div class="row">
						<div class="col-md-12">
							<!--<form role="form" class="form-horizontal"> -->
								<div class="form-group">
									
									<div class="col-sm-4">
									
										<label class="control-label" for="datepickerSecond">Date:</label>
										<input type="text" class="form-control datepicker" id="date1" value="<?php  
										echo date('d-m-Y');?>" placeholder="DD-MM-YY">

									</div>
									
									<div class="col-sm-5">	
										<label class="control-label" for="Transport">Transport Company</label>
										<?php echo  $this->Form->input('transport_name',array('type'=>'select','options'=>$transports,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'transport_id','selected'=>"",'empty'=>'Select Transport')); ?>
										
										
									</div>
									
									<div class="col-sm-3">
										<button  class="btn btn-primary" id="clear1" onClick="clearSearchData();" style="display:none;margin-top:25px;">Clear</button>
										<button style="margin-top:25px;" class="btn btn-primary" onClick="generateDailyData();">Generate</button>
										
										<?php										
										echo $this->Html->link( '<i class="fa fa-download"></i>',array('action' => 'export_daily_xls','?' =>array('ids'=>$data) 
											),array(
											'data-hint'=>'Download',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false,
												'style'=>'margin-top:25px;',
												'id'=>'download'  
											)
										);
										?>
									</div>
									
								</div>
							<!--</form> -->
						</div>
					</div> 
					<div class="myloader" id="loading" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
					<div class="row" id="searchData" >
						
						<div class="col-md-12 export-excel">
						
							
						</div>
						<div class="col-md-12">
							<table class="table table-striped table-bordered custom_table">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Auction Name</th>
										<th>Lot No.</th>
										<th>Car Name</th>
										<th>Chassis No.</th>
										<th>Port Name</th>
										<th>Yard No.</th>
										<th>Remark</th>
									</tr>
								</thead>
								<tbody>
									
									<?php 
									if($dailyReports) 
									{
									$c= 1 ;
									foreach ($dailyReports as $report)
									{
									?>  
									<tr>
										<td><?php echo $c ;?></td>
										<td><?php echo @$report['CarPayment']['auction_name'] ;?></td>
										<td><?php echo @$report['Car']['lot_number'] ;?></td>
										<td><?php echo @$report['CarName']['car_name'] ;?></td>
										<td><?php echo $report['Car']['cnumber'] ;?></td>
										<td><?php echo @$report['Port']['port_name'] ;?></td>
										<td><?php echo @$report['Logistic']['yard_name'] ;?></td>
										<td><?php echo @$report['Logistic']['remark'] ;?></td>
									</tr>
									<?php $c++; }}else{?>
										
									<tr>
										<td colspan="8" style="text-align:center"> Result Not Found</td>
									</tr>
										
										<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div><!--Daily Report-->
				
				<div class="tab-pane" id="yearly-report"><!--Yearly Report-->
					<div class="row">
						<div class="col-md-12">
							
								<div class="form-group">
									<!-- <label class="control-label col-sm-1" for="datepickerSecond">Date:</label> -->
									<div class="col-sm-3">
										<input type="text" class="form-control datepicker" id="datepicker1" value="" placeholder="DD-MM-YY">
									</div>
									<label class="control-label col-sm-1">to</label>
									<div class="col-sm-3">
										<input type="text" class="form-control datepicker" id="datepicker2" value="<?php echo '' ?>" placeholder="DD-MM-YY">
									</div>
                                    
                                    <div class="col-sm-3">
										<input type="text" class="input-xlarge pull-left" style="width:100%;" placeholder="Enter Chassis Number For Search" id="selectbox">
									</div>
									
								</div>		
                                
                                <div class="clearfix">&nbsp;</div>
                                <br>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" style="width:100%;" id="client" placeholder="Enter Client Name">
                                </div>
                                <div class="col-sm-2" style="width:19%">
										<button class="btn btn-primary" onClick="showYearlyReport();">Generate</button>
										<button class="btn btn-primary" id="clear" onClick="clearSearch();" style="display:none">Clear</button>
									</div>
									
                                    
                                    <div class="clearfix"></div>				 
						 
						</div>
					</div>
					<div class="myloader" id="loading1" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div>
					<br>
					<div class="row" id="allDownload">
							<div class="col-sm-12 export-excel" style="margin-bottom:10px;">
				<?php										
										echo $this->Html->link( '<i class="fa fa-download"></i>',array('action' => 'export_yearly_xls',$fromDate,$toDate 
											),array(
											'data-hint'=>'Download',
												'class'=>'btn btn-primary pull-right hint--bottom',
												'escape'=>false  
											)
										);
										?>
							<!--<button class="btn btn-primary pull-right">Export <i class="fa fa-list-alt"></i></button> -->
						</div>
					</div>
					<div class="row" style="overflow-x: auto">						
						
						
						<div class="col-md-12" id="yearlyReport">
						</div>
							 
							 	
					</div>
					
				</div><!--Yearly Report-->
				
				
				<!--  Bit Report -->
				<div class="tab-pane" id="bid-report"><!--Sales Report-->
					<div class="row">
						<div class="col-md-12">
						<?php
								$success = $this->Session->flash(); 
								if($success) {?>
								<div id="hideDiv">
									<div class="alert alert-danger">
													<button type="button" class="close" data-dismiss="alert">×</button>
													<strong><?php echo $success ;?></strong>
									</div>
								</div>
								<?php }?>
						</div>
						<div id="successDiv"></div>
					</div>
						 
					<div class="row" id="report">
						<table class="table table-striped table-bordered custom_table" id="myTable">
								<thead>
									<tr>
										<th>Car Name(Count)</th>
										<th>Chechis No.</th>	
										<th>Unique ID</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									
								<?php 
								
								
								 foreach($bidresult as $key => $val){
										
										foreach($val as $k => $v){
									?>
								<tr  class ='car_<?php echo $v['Car']['id']; ?>' >
								
									<td><?php echo $this->Html->link(@h(@$v['Car']['CarName']['car_name']),array('controller'=>'reports', 'action'=>'car_bid_report',$v['Car']['id']),array('escape' => FALSE));?>  (<?php echo $countArr[$v['Bid']['car_id']]; ?>)</td>
									<td><?php echo $v['Car']['cnumber'] ;?></td>
									<td><?php echo $v['Car']['uniqueid'];?></td>									
									<td><?php $bidDate = date('d-m-Y',strtotime($v['Bid']['date']));echo $bidDate;?></td>	
									<!--<td>
										<?php /*
												 	echo $this->Form->postLink(
														'<i class="fa fa-trash-o"></i>',
														array('action' => 'AllBidDelete', $v['Car']['id']),
														array('confirm' => 'Are you sure you want to delete all bid of this car ID?','data-hint'=>'Delete All','class'=>'btn btn-danger hint--bottom','escape'=>false)
													);*/
												?>
										
						
										<!--<button onclick="deleteAllBid('<?php echo $v['Car']['id']; ?>');" title="Delete All" type="button" data-bb-handler="confirm"  class="fa fa-trash-o btn btn-danger hint--bottom"/>
									</td>--></tr>
								<?php }} ;?>	
								</tbody>
							</table>
					</div>
				</div>
				
				<!--  Bid Report -->
			 </div>
		</div>
	</div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="mypop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm? </h4>
      </div>
      <div class="modal-body" id='mypop_body'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='save_button'>Save</button>
      </div>
    </div>
  </div>  
</div>
<script>

	
	function deleteAllBid(CarId)
	{
			
			var msg = 'Are you sure you want to delete all bid of this car ID?';
			
			var str = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header "><button type="button" class="close" data-dismiss="modal">&times;</button><h3 class="text-error">Confirm?</h3></div><div class="modal-body"><div class="bootbox-body">'+msg+'</div></div><div class="modal-footer"><button onclick="deleteBidCar('+CarId+')" type="button" data-bb-handler="confirm" class="btn btn-primary">OK</button><button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button></div></div></div>';
			$("#mypop").html(str);
			$("#mypop").modal("show");

		
	}

	function deleteBidCar(carId)
	{

			$.ajax({
			type: "POST",
			url:"<?php echo $this->Html->url('/admin/reports/AllBidDelete',true);?>",
			data: {'cId':carId},
			success: function(data)
			{				
				$("#mypop").modal("hide");
				$(".car_"+carId).hide();
				$("#successDiv").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Bid Records is successfully deleted</strong></div>');
				$("#successDiv").show();
			},
			failure: function(data)
			{
				alert('Error occur');
			}
			});
		
	}

function generateDailyData()
{
	
	 $("#download").hide();
	var transport_id = $('#transport_id').val(); 
	var date = $('#date1').val(); 
	var datas  =  {'date':date,'id':transport_id}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/search_report',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading").show();
           },
		success:function(result)
		{
			$("#loading").hide();
			$('#clear1').show();
			$('#searchData').html(result);
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
		
	});	
}
$(function() {
    $("#date1").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker1").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker2").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker3").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker4").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
});
	
function showYearlyReport()
{
	
	var fromdate = $('#datepicker1').val();
	var todate = $('#datepicker2').val();  
	var client = $('#client').val();  
	var model = $('#model').val(); 
	var datas  =  {'from':fromdate,'todate':todate,'client':client,'model':model}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/yearly_report',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading1").show();
           },
		success:function(result)
		{
			$("#loading1").hide();
			$('#clear').show();
			$("#allDownload").hide();
			$('#yearlyReport').html(result);
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
		
	});	
}

function showSalesReportByDate()
{
	var from = $('#datepicker3').val();
	var to = $('#datepicker4').val(); 
		
	var datas  =  {'fromDate':from,'toDate':to}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/sales_report_search',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading2").show();
           },
		success:function(result)
		{
			$("#loading2").hide();
			$('#saleReport').html(result);
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
		
	});	
}

function showSalesReport()
{
	
	var brand = $('#brand_id').val();
	var country = $('#country_id').val(); 
	var cnumber = $('#cnumber').val();
	var user = $('#user_id').val(); 
	var from = $('#datepicker3').val();
	var to = $('#datepicker4').val();
	var datas  =  {'brand':brand,'country':country,'cnumber':cnumber,'user':user,'from':from,'toDate':to}; 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/sales_report',true)?>",
		type:"POST",
		data:datas,
		beforeSend: function() {
              $("#loading2").show();
           },
		success:function(result)
		{
			$("#loading2").hide();
			$('#saleReport').html(result);
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
		
	});	
}
function resetFields() 
{   
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/clear_search',true)?>",
		success:function(result)
		{
			$('#user_id').val("");
			$('#brand_id').val("");
			$('#country_id').val("");
			$('#cnumber').val("");
			
			 $('#datepicker3').val('').prop("placeholder","DD-MM-YY");
			 $('#datepicker4').val('').prop("placeholder","DD-MM-YY");
			 
			
			
			$("#user_id").trigger("liszt:updated");
			$("#brand_id").trigger("liszt:updated");
			$("#country_id").trigger("liszt:updated");
			$("#cnumber").trigger("liszt:updated");
			
			//$('#datepicker2').val("DD-MM-YY");
			$('#saleReport').html(" ");
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
		
	});	
}

function clearSearch()
{
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/yearly_report_ajax',true)?>",
		beforeSend: function() {
              $("#loading1").show();
           },
		success:function(result)
		{
			$("#loading1").hide();			
			$('#yearlyReport').html(result);
			$('#s2id_selectbox span').html('Enter chassis number for search');
			$('#selectbox').val('');
			$('#selectbox').trigger("liszt:updated");
			$("#1_no").children().addClass("In-active current");
			$("#clear").hide();	
			$("#datepicker1").val('');
			$("#datepicker2").val('');	
			$("#datepicker1").attr('placeholder','DD-MM-YY');
			$("#datepicker2").attr('placeholder','DD-MM-YY');		
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
	});
	
	
	/*$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/clear_search',true)?>",
		success:function(result)
		{
			$('#datepicker1').val("01-01-2013");
			$('#datepicker2').val("DD-MM-YY");
			$('#yearlyReport').html(" ");
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
		
	});*/		
}
function clearSearchData()
{
	 
	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/clear_search',true)?>",
		success:function(result)
		{
			$('#datepicker').val("DD-MM-YY");
			$('#searchData').html(" ");
			$('#transport_id').val("");
			$("#transport_id").trigger("liszt:updated");
			$("#clear1").hide();
			$("#download").show();
		},
		failure:function(result)
		{
			alert('Network Problem');
		}	
	});	
}

$('#yearly').click(function(){

	$.ajax({
		url:"<?php echo $this->Html->url('/admin/reports/yearly_report_ajax',true)?>",
		beforeSend: function() {
              $("#loading1").show();
           },
		success:function(result)
		{
			$("#loading1").hide();			
			$('#yearlyReport').html(result);
			$('#s2id_selectbox span').html('Enter chassis number for search');
			$("#1_no").children().addClass("In-active current");
			
			
			
		},
		failure:function(result)
		{
			alert('Network Problem');
		}
	});

})


</script>
<script>
    $(document).ready(function(){
		
    $('#selectbox').select2({
    minimumInputLength: 2,
    ajax: {
    url: '<?php echo $this->Html->url('/admin/reports/chassis_yearly_report_search',true)?>',
    dataType: 'json',
    data: function (term, page) {
    return {
    q: term
    };
    },
    results: function (data, page) {
	
    return { results: data };
    }
    }
    });
    });
    </script>
 <script>
		$(function()
		{
			
			$("#selectbox").change(function()
			{
			
				$.ajax({
					url:"<?php echo $this->Html->url('/admin/reports/chassis_search_report',true)?>",
					type:"POST",
					data:{name:$("#s2id_selectbox .select2-choice span").html()},
					dataType:"html",
					beforeSend: function() {
					$("#loading1").show();
					},
						success:function(result)
						{
							$("#loading1").hide();
							$('#clear').show();
							$("#allDownload").hide();
							$('#yearlyReport').html(result);
						},
						failure:function(result)
						{
							alert('Network Problem');
						}
				});
		});
	   
	}); 
	
	
function changePagination(pageId,liId){
    
     var dataString = 'pageId='+ pageId;
     $.ajax({
           type: "POST",
          url:"<?php echo $this->Html->url('/admin/reports/yearly_report_ajax_find',true)?>",
			beforeSend: function() {
              $("#loading1").show();
           },
           data: dataString,
           cache: false,
           success: function(result){
                
                 $(".link a").removeClass("In-active current") ;
                 $("#"+liId+" a").addClass( "In-active current" );
                 $("#loading1").hide();
				 $('#seacrh_pagination').html(result);
           }
      });
}

function changePagination1(pageId,liId,frm_date,to_date){
    
     var dataString = 'pageId='+ pageId+ '&frm_date='+ frm_date + '&to_date='+ to_date;
     $.ajax({
           type: "POST",
          url:"<?php echo $this->Html->url('/admin/reports/yearly_report_ajax_find_cal',true)?>",
			beforeSend: function() {
              $("#loading1").show();
           },
           data: dataString,
           cache: false,
           success: function(result){
                
                 $(".link a").removeClass("In-active current") ;
                 $("#"+liId+" a").addClass( "In-active current" );
                 $("#loading1").hide();
				 $('#seacrh_pagination').html(result);
           }
      });
}
	
	            
</script>
<script>
	
$(document).ready(function(){
	
	
	
	if($('li').hasClass('bid-tab-show')){
		$('li').removeClass('active');
		$('.tab-pane').removeClass('active');
		$('li.bid-tab-show').addClass('active');
		$('#bid-report').addClass('active');
	}else{
	}
});
</script>
