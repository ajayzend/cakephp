
<?php //echo $this->Html->script('jquery-1.7.2.min'); ?>
<?php //echo $this->Html->script('jquery.form');?>
<?php 
//echo $this->Session->flash();?>
<!--<div>
	//<?php 
     // echo $this->Common->breadcrumb(array($this->webroot.'admin'=>'Home',
//'null'=>'Slider Management'
									//));
      
      ?> 
</div>-->
<div class="row-fluid">	

	<div class="box box_margn span12">

				<div class="box-header well">
					<h2><i class="icon-cog	"></i>Slider Management</h2>
					<button data-dismiss="modal" class="close product-featureclsbtn " type="button">x</button>
					<div class="err_msg session_msg"></div>
				</div>

		<div class="box-content">
			
<script>

$(function()
{
	$( "#drop" ).sortable();
	$( "#drop" ).disableSelection();
/*
	*Trigger function for connect list.
	*/
	$( "#items_drop, #items_origin" ).sortable({
		connectWith: ".box-header-keyfeature",
		receive:function(event,li){
			//alert(this.id);
			if(this.id=="items_origin")
			{
			$("#origin ul li span .icon-plus").show();
			$("#origin ul li span .icon-remove").hide();

			}	
			if(this.id=="items_drop")
			{
				$("#drop ul li span .icon-plus").hide();
				$("#drop ul li span .icon-remove").show();
			}

		

		}
		

	}).disableSelection();
	
}); //onload end		

///////To update the keyfeatures for Slide
		

function update_order(e)
{	   	
	$.post('<?php echo $this->Html->url("/admin/sliderManagements/saveorder/",true); ?><?php echo $slideId;?>',$('#items_drop').sortable('serialize'),
		function(data) {
			if(data.trim() == 'success'){
						$("#myModal").modal('hide');
				}else{
					alert("Exception"+data);
					}
			//alert('success');
			// window.location="<?php echo $this->webroot;?>admin/sliderManagements/index";
		}
	); 

	
}	
	
	
</script>			
			
			
	
					<!--To check for slide editing	starts
					
						<?php echo $this->Form->create(); ?>
						<label>Slide Title</label>	
						<?php echo $this->Form->input('slide_title',array('label'=>false));?>	
						
							
						<label>Description</label>	
						
						<?php echo $this->Form->input('slide_desc',array('label'=>false));?>
						<label>Image</label>
						<?php echo $this->Form->input('image', array('type'=>'file', 'enctype'=>'multipart/form-data','label'=>false));
						echo $this->Form->input('sid',array('type'=>'hidden'));?>
						
						
					ends-->
					
					
			
					<?php
		
							echo $this->Form->create('SlideKey',array('default'=>'false'));
							
				    ?>
							
							
							
							
							<div id='origin_key' name='origin' class='span6 slider_manage '>
							<h6>Total keyfeature</h6>
							<br/>
							<div id='origin' class='span10 key_feature'>
							<div class='inner-content-div'>
							<ul id='items_origin'  class='box-header-keyfeature'>
					<?php			
								foreach($kid as $v)
								{
									 
									echo "<li id='order_".$v['Keyfeature']['id']."'>".$v['Keyfeature']['features']."<span 
									style='cursor:pointer' onclick='add_li(this);'><i class='icon-plus pull-right'></i></span>&nbsp;
									<span style='cursor:pointer' onclick='remove_li(this);'><i class='icon-remove pull-right'></i></span></li> ";
								}
					?>
							</ul></div></div></div>
							<div id='drop_key' name='drop' class='span6 slider_manage_add'  >
							<h6>Slide Feature</h6>
							<br/>
							<div id='drop' class='span10 product_key_feature'>
							<div class='inner-content-div'>
							<ul id='items_drop'  class='box-header-keyfeature'>
					<?php		
								foreach($product_keyfeature as $v)
								{
									 
									echo "<li id='order_".$v['Keyfeature']['id']."' >".$v['Keyfeature']['features'].
									"<span 
									style='cursor:pointer' onclick='remove_li(this);'>
									<i class='icon-remove pull-right'></i>
									</span>&nbsp;	
									<span style='cursor:pointer' onclick='add_li(this);'>
									<i class='icon-plus pull-right'></i>
									</span> </li> ";
								}
					?>			
							</ul></div></div></div>
							<div class='clearfix'></div></div>
							
							
							<!--
							<span id='check_img' style='display:none;position:absolute;z-index:1; color:green;'><i class='icon-ok' ></i></span>
						-->
							<div class="modal-footer btn_saved ">	
							<a  onclick="update_order();" class="btn btn-info btn_save ">Save</a></div>
							<?php
							//echo $this->Form->button('save',array('class'=>'btn btn-primary','onclick'=>'update_order()'));
							echo $this->Form->end();	
							echo "</div></div></div>";
					
						?>
					
					
			
	
		</div>
			
</div>
<script>

$('document').ready(function(){

$("#drop ul li span .icon-plus").hide();
$("#origin ul li span .icon-remove").hide();

});
		function add_li(obj)
		{
		
		var b = $(obj).parents("li");
		console.log(obj);
		$(b).detach().appendTo('#items_drop'); 
		

		$("#drop ul li span .icon-plus").hide();
		$("#drop ul li span .icon-remove").show();


		}

		function remove_li(obj)
		{
			
		
		 var b = $(obj).parents("li");
		console.log(obj);
		//console.log($(obj).closest("li")[0]);
		
		$(b).detach().appendTo('#items_origin'); 

		$("#origin ul li span .icon-plus").show();
		$("#origin ul li span .icon-remove").hide();


		}




</script>
