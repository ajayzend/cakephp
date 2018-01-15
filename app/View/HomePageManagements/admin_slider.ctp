<?php	
	//pr($products);die;
	echo $this->Html->script('jquery-1.9');
	echo $this->Html->script('jquery-ui-1.10.3');
	//echo $this->Html->script('jquery-touch');
	echo $this->Html->script('jquery.slimscroll.min');
	echo $this->Html->script('jquery-1.7.2.min'); 
	echo $this->Html->script('jquery.form');
	//echo $this->Html->script('ckeditor/ckeditor');

?>

<script>
	
$(function()
{

	$( "#drop" ).sortable({items: "li:not(.ui-state-disabled)"});
	$( "#drop" ).disableSelection();

	/*
	*Trigger function for connect list.
	*/
	$( "#items_drop, #items_origin" ).sortable({
		connectWith: ".box-header-keyfeature",
		receive:function(event,li){
			
			if(this.id=="items_origin")
			{
				$("#items_origin #iconCross").show();
				$("#items_origin #iconPlus").hide();

			}	
			if(this.id=="items_drop")
			{
				$("#items_drop ul li span .icon-plus").show();
				$("#items_drop ul li span .icon-remove").hide();
			}

		

		}
		

	}).disableSelection();



}); //onload end

function add_li(obj)
		{
		
		var b = $(obj).parents("li");
		
		$(b).detach().appendTo('#items_origin'); 
		
		$("#items_origin #iconCross").show();
		$("#items_origin #iconPlus").hide();
		


		}

		function remove_li(obj)
		{
			
		
		 var b = $(obj).parents("li");
		console.log(obj);
		//console.log($(obj).closest("li")[0]);
		//alert(b);
		$(b).detach().appendTo('#items_drop'); 

		$("#items_drop #iconCross").hide();
		$("#items_drop #iconPlus").show();
		

		}
</script>

<script>

/*
* @hello function info.
* Parrameter required (e) ->  
* Sets order for Key Features..
* 
*/	

function update_order(e)
{


	//$('#load_img').show();

	$('#load_img').fadeIn();
			
		   	
	$.post('<?php echo $this->Html->url("/",true); ?>/admin/Keyfeatures/saveorder/'+$("#pd").val(),$('#items_drop').sortable('serialize'),
		function(data) {
			//alert('success');
			$('#alert-success').fadeIn().fadeOut(2000);
			$('#load_img').fadeOut();
			$('#check_img').fadeIn().fadeOut(10000);

		}
	); 

	
}	
	
</script>
<div class="row-fluid">	
	<div class="box span12">
		<div class="box span6">
					<div data-original-title="" class="box-header well">
						<h2><i class="icon-picture"></i> Total Products</h2>
						<div class="box-icon">
							<a class="btn btn-setting btn-round" href="#"><i class="icon-cog"></i></a>
							<a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a>
							<a class="btn btn-close btn-round" href="#"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content productlist">
						<div class="chzn-container select-product-dropdown-menu">		
		               <ul id="items_drop" class="chzn-results productlist-keyfeature ">
							<?php foreach($remaining_products as $val){ 
								
							//echo '<li class="group-result ui-state-disabled"  style="display: list-item;">'.$val['ProductCategory']['name'].'</li>';
							foreach($val['Product'] as $remainingProduct){
							echo '<li  id="sorted_'.$remainingProduct['id'].'" class="active-result group-option" >'.$remainingProduct['name'].'<span style="cursor:pointer;display:none;" id="iconCross" onclick="remove_li(this);"><i class="icon-remove pull-right"></i></span><span id="iconPlus" onclick="add_li(this);" style="cursor:pointer;"><i class="icon-plus pull-right"></i></span></li>';
							
						}
					}?>
							</ul>
						</div>
					
					</div>
		</div>
			<div class="box span6">
					<div data-original-title="" class="box-header well">
						<h2><i class="icon-picture"></i> Gallery</h2>
						<div class="box-icon">
							<a class="btn btn-setting btn-round" href="#"><i class="icon-cog"></i></a>
							<a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a>
							<a class="btn btn-close btn-round" href="#"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<br>
						<ul id="items_origin" class="thumbnails box-header-keyfeature gallerylist">
															<?php foreach($selected_products as $item){
																foreach($item as $key=>$val){
																 ?>
															
														<li class="thumbnail" id="sorted_<?php echo $val['id'];?>">
															<span id="iconCross" onclick="remove_li(this);" style="cursor:pointer">
				<i class="icon-remove pull-right"></i>
				</span>
				<span id="iconPlus" style="cursor:pointer;display:none;" onclick="add_li(this);"><i class="icon-plus pull-right"></i></span>
								<p><?php echo $val['name'];?></p>
							</li>
							<?php }} ?>
						
						</ul>
					</div>
					<a href="javascript:saveSlider()" class="btn btn-info" />Save</a>
			</div>
			
			<a href="javascript:addSlide();" class="btn btn-info" >Add Slide</a>
			
	</div>
</div>
<script>
	function saveText(){

			/*$.ajax({
			type: "POST",
			url: url,
			data: data,
			success: success,
			dataType: dataType
			}); */
	}
		
		
/*
	JS saveSlider function is used to call server method to save and update
	homepage slider slides and track their ordering
	@ params products ids
	@ return success or faliure in success method

*/		
	function saveSlider(){
        
         var data = $("#items_origin").sortable("serialize");
			$.ajax({
				type: "POST",
				url: '<?php echo $this->webroot;?>admin/homePageManagements/saveSlider',
				data: data,
				success: function(result){
						alert(result);
					}
				});
			
		
	}
	
	function addSlide(){
			var str ='<div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h3>Select Type Of Slide</h3></div><div><div class="modal-body"><a href="javascript:staticSlide();" class="btn btn-info pull-left">Static Slide</a><a class="btn btn-info pull-right" href="javascript:dynamicSlide()">Dyanamic Slide</a></div><div></div><div class="modal-footer"></div></div>';
			$("#myModal").html(str);
			$("input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
			$("#myModal").modal('show');
			
			
		
		}
	
	function staticSlide(){
			//$("#myModal").modal('hide');
			var str ='<form id ="staticSlide" ><div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h3>Static Slide</h3></div><table class="table table-stripped"><tbody><tr><td>Slide Name</td><td><input type="text" class="input-xlarge focused" name="data[slide_name]"/></td></tr><tr><td>Banner Image</td><td><input type="file" class="input-xlarge focused" name="data[slide_image]"/></td></tr><tr><td>URL link</td><td><input type="text" class="input-xlarge focused" name="data[url_link]"/></td></tr><tr></tr><tr><td><a href="javascript:formSubmit(\'staticSlide\');" class="btn btn-info">Save</a><a href="javascript:addSlide();" class="btn btn-info">Back</a></td><td><img alt="" id="load_img" style="position: absolute;z-index: 2; display:none;" src="<?php echo $this->webroot;?>img/loader.gif"><img alt="" id="check_img" style="display:none; color:green;" src="<?php echo $this->webroot;?>img/ok_icon.png">	</td></tr></tbody></table></form>';
			$("#myModal").html(str);
			$("input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
			$("#myModal").modal('show');
		
		}
		
	function dynamicSlide(){
			var str ='<form id ="staticSlide" action="<?php echo $this->webroot;?>admin/homePageManagements/staticSlideAdd" ><div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h3>Dynamic Slide</h3></div><table class="table table-stripped"><tbody><tr><td>Slide Name</td><td><input type="text" class="input-xlarge focused" required name="data[slide_name]"/></td></tr><tr><td>Banner Image</td><td><input type="file" class="input-xlarge focused" required name="data[slide_image]"/></td></tr><tr><td>Product Name</td><td><input type="text" class="input-xlarge focused" name="data[product_name]"/></td></tr><tr><td>Lable</td><td><input type="text" class="input-xlarge focused" name="data[label]"/></td></tr><tr><td>Content</td><td><textarea cols="3" rows="2" class="ckeditor" name="data[feature]"></textarea></td></tr><tr><td>URL link</td><td><input type="text" class="input-xlarge focused" name="data[url_link]"/></td></tr><tr></tr><tr><td><a href="javascript:formSubmit(\'staticSlide\');" class="btn btn-info">Save</a><a href="javascript:addSlide();" class="btn btn-info">Back</a></td><td><img alt="" id="load_img" style="position: absolute;z-index: 2; display:none;" src="<?php echo $this->webroot;?>img/loader.gif"><img alt="" id="check_img" style="display:none; color:green;" src="<?php echo $this->webroot;?>img/ok_icon.png">	</td></tr></tbody></table></form>';
			$("#myModal").html(str);
			
			 $('.ckeditor').cleditor({width:300, height:150});
			 
			$("input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
			$("#myModal").modal('show');
		
		
		
		}
		
	function formSubmit(formId){
			$("#"+formId).ajaxSubmit({
				url: '<?php echo $this->webroot;?>admin/homePageManagements/staticSlideAdd', 
				type: 'POST',
				beforeSubmit: function() { 
					$("#load_img").show();
					$("#check_img").hide();
				},
				success: function(data) {
				$("#check_img").show().fadeOut(2000);
				$("#load_img").hide();
				if(data == 1 ){
					location.refresh();
					}
				},
				dataType: 'text'
			});

		
		}
</script>
