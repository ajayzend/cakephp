

<div class="main container">
	<div style="display:none;" id="load">		
		<img src="<?php echo $this->webroot;?>images/images.jpeg" />
	</div>	
	<div class="col-md-12 col-lg-12 col-sm-12 ">
 <h3><i class="fa fa-check-square"></i> Select Car</h3>
 </div>
 <div class="col-md-2 col-lg-2"></div>
<ul class="car_opt col-lg-8 col-md-8">
<?php foreach($detail as $val){
foreach($val as $car){
	//pr($car);
	  // echo'<td>'.$car['Car']['id'].'</td><td>';
	   echo'<li><button class="btn btn-width" data-toggle="modal" data-target="#myModal" onclick="getData('.$car['Car']['id'].'); ">'.$car['Car']['car_name'].'</button><input type ="hidden" value='.$car['Car']['id'].' class="ansar"/></li>';
}
}?>


</ul>
 <div class="col-md-2 col-lg-2"></div>
 </div>

					<script>
					  
					function getData(id)
					{
						
						$.ajax({
							  url:"<?php echo $this->Html->url('/',true);?>home/getData",
							  type:"POST",
							  data:{car_id:id},
							  dataType:"json",
							  success:function(result)
							  {
								 var obj=result.CarImage;
								 var carimg;
								 var img;
								 var other_image="";
								 other_image+="<ul>";
								 for (var i=0; i<result.CarImage.length; i++) {
									
									 if(i==0)
									 {
									 img='<div id="replace-img"><img src="<?php echo $this->webroot; ?>img/carimages/'+ result.CarImage[i].image_source +'"  width="400" height="300"/></div>';
									 }
									 else
									  {
										other_image+='<li><img src="<?php echo $this->webroot; ?>img/carimages/'+ result.CarImage[i].image_source +'" width="100" height="100"/ onClick=replaceImage("'+ result.CarImage[i].image_source +'")></li>';  
										  
									  }
									}
							       other_image+="</ul>";
								  var trHTML  = '';
							 
						trHTML += '<tr><td>Date</td><td>' + result.Car.pdate + '</td><td rowspan=7 >'+ img + '</td></tr><tr><td>Unique Number</td><td>' + result.Car.uniqueid + '</td></tr><tr><td>Chassis Number</td><td>' + result.Car.cnumber + '</td></tr><tr><td>Transmission</td><td>' + result.Car.transmission + '</td></tr><tr><td>CC</td><td>' + result.Car.cc + '</td></tr><tr><td>Stock</td><td>' + result.Car.stock + '</td></tr><tr><td>Kilo-Meter</td><td>' + result.Car.mileage + '</td></tr>';
						 $("#list").html(other_image);
						$('#CarResult').html(trHTML);
								  
							  }

							
						});
					}
					</script>
                           <script>
                          function replaceImage(srcImg){
							  $("#replace-img").html('<div id="replace-img"><img src="<?php echo $this->webroot; ?>img/carimages/'+ srcImg +'"  width="400" height="300"/></div>');							  							  
							  
							  }
                           </script>
                           
<!--   bootstrap modelpopup car detail-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog contt_model">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Test</h4>
      </div>
      <div class="modal-body container">
	     <table cellpadding =2 cellspacing = 1 border = 7>
			
			  <tbody id="CarResult" class="left_port-model">
			 
			 </tbody> 
       </table>
       
       <div id="list" class="car_list"></div>
      </div>
	  <div class="model-footer"></div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
