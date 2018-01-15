<?php echo $this->Html->script(array('jquery-1.7.2.min','jquery-ui-1.8.21.custom.min','jquery.jcarousel.min','jquery.pikachoose.js',
'jquery.pikachoose.min.js','jquery.touchwipe.min.js'));?>


<script language="javascript">
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();
				});
</script>
<?php
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery-ui-1.8.21.custom.min');
		echo $this->Html->script('jquery.jcarousel.min');
		echo $this->Html->script('jquery.pikachoose.js');
		echo $this->Html->script('jquery.pikachoose.min.js');
		echo $this->Html->script('jquery.touchwipe.min.js');


	?>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Requested A Quote</h4>
      </div>
      <div class="modal-body">
        <form role="form">
<div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contact Number</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Contact Number">
  </div>
  
  
 
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Send</button>
        <button type="button" class="btn btn-primary">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container back_user">


<div class="row car-details">
<h2>Select Cars</h2>
	
	<div class="col-md-12">
	<div class="col-md-6">
	<div class="pikachoose">
	<ul id="pikame" >
		<li><a href="http://www.pikachoose.com"><img src="<?php echo $this->webroot;?>images/DUALIS01.jpg"/></a></li>
		<li><a href="http://www.pikachoose.com"><img src="<?php echo $this->webroot;?>images/DUALIS02.jpg"/></a></li>
		<li><a href="http://www.pikachoose.com"><img src="<?php echo $this->webroot;?>images/DUALIS03.jpg"/></a></li>
	</ul>
</div>






	</div>
	<?php $i = 1;
	foreach($carDetails as $key=>$value) {?>
	<div class="col-md-6">
	<!-- <h3>1. DUALIS - 20S FOUR 4WD TV DVD CAMERA PACKAGE</h3> -->
	<h3><?php echo $i;?>. <?php echo $value['Car']['package'];?></h3>
	
	
	<table class="table table-bordered">
		<tr>
			<Td>Year/Month</td>
			<Td><?php echo date("Y/W", strtotime($value['Car']['pdate']));?></td>
		</tr>
		<tr>
			<Td>Chassis-No</td>
			<Td><?php echo $value['Car']['cnumber'];?></td>
		</tr>
		<tr>
			<Td>Transmission</td>
			<Td><?php echo $value['Car']['transmission'];?></td>
		</tr>
		<tr>
			<Td>CC</td>
			<Td><?php echo $value['Car']['cc'];?> CC</td>
		</tr>
		<tr>
			<Td>Kilo-Meter</td>
			<Td><?php echo $value['Car']['mileage'];?> KM</td>
		</tr>
		<!--
		<tr>
			<Td>Number</td>
			<Td>NAA1206TKY116.53</td>
		</tr>
		-->
	</table>	
	<!-- <a class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal">Requested A Quote</a>	-->
	</div>
	<?php $i++; } ?>
    </div>	
	
	<div class="clearfix"></div><hr/>



	
	
</div>
</div>
