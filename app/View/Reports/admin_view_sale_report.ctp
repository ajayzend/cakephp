<?php echo $this->Html->css(array('select2'));?>
<?php echo $this->Html->script(array('select2.min'));?>
<div id="content1"> 
	<div class="box col-md-12">
		<div class="box-header well">
			<div class="col-md-12">
				<h2><i class="fa fa-list-alt"></i> Sales Report</h2></div>
			<div class="clearfix"></div>	
		</div>
		<div class="report-management">
			
			 <div id="my-tab-content" class="tab-content reports">
				<div class="row">
						<div class="col-md-12">
							<!--<form role="form">-->
								<div class="form-group col-sm-3">
									<label class="control-label" for="brand">Brand Wise:</label>
									<?php echo  $this->Form->input('brand_name',array('type'=>'select','options'=>$Brands,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'brand_id','selected'=>"",'empty'=>'Select Brands')); ?>
								</div>
								<div class="form-group col-sm-3">
									<label class="control-label" for="country">Country Wise:</label>
									<?php echo  $this->Form->input('country_name',array('type'=>'select','options'=>$Country,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'country_id','selected'=>"",'empty'=>'Select Country')); ?>
								</div>
								<div class="form-group col-sm-3">
									<label class="control-label" for="chassis">Chassis wise /UID wise:</label>
									<?php echo  $this->Form->input('cnumber',array('type'=>'select','options'=>$Cars,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'cnumber','selected'=>"",'empty'=>'Select Chassis No.')); ?>
								</div>
								<div class="form-group col-sm-3">
									<label class="control-label" for="client">Client wise:</label>
									<?php echo  $this->Form->input('user',array('type'=>'select','options'=>$Users,'class'=>'form-control','label'=>false,'data-rel'=>'chosen','id'=>'user_id','value'=>'Select User','empty'=>'Select User')); ?>
								</div>
								<div class="form-group">
									
									<div class="col-sm-3">
										<input type="text" class="form-control datepicker" id="datepicker3" value="" placeholder="DD-MM-YY">
									</div>
									<label class="control-label col-sm-1">to</label>
									<div class="col-sm-3">
										<input type="text" class="form-control datepicker" id="datepicker4" value="" placeholder="DD-MM-YY"> 
									</div>
									<div class="col-sm-5" >
										<!--<button class="btn btn-primary" onClick="showSalesReportByDate();">Search</button>-->
										<button class="btn btn-primary pull-right" onClick ="resetFields();" >Clear</button>  
										<button class="btn btn-primary pull-right" onClick ="showSalesReport();" >Generate</button>
									</div>
								</div>
							<!--</form> -->
						</div>
					</div>
					<div class="myloader" id="loading2" style="display:none;">
					<img src="<?php echo $this->webroot; ?>ajax-loader.gif"/> 
					</div> 
					<div class="row" id="saleReport">
						
					</div>
				</div><!--Sales Report--> 
			 </div>
		</div>
	</div>
</div>

<script>

$(function() {
    $("#date1").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker1").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker2").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker3").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
    $("#datepicker4").datepicker({changeMonth: true,changeYear: true, dateFormat: "dd-mm-yy",yearRange: '-20:+10'});
});
	


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
		
	});		
}
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
							$('#yearlyReport').html(result);
						},
						failure:function(result)
						{
							alert('Network Problem');
						}
				});
		});
	   
	});             
</script>
