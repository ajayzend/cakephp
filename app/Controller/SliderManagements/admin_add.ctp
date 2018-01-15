<?php echo $this->Html->script('jquery-1.7.2.min'); ?>
<?php echo $this->Html->script('jquery.form');?>
<?php 
echo $this->Session->flash();?>
<div>
	<?php 
      echo $this->Common->breadcrumb(array($this->webroot.'admin'=>'Home',
									$this->webroot.'admin/SliderManagements'=>'Slider Management',
									'null'=>'add'
									));
      
      ?> 

<div class="row-fluid">	

	<div class="box span12">

				<div class="box-header well">
					<h2><i class="icon-cog	"></i>Slider Management</h2>
					<div class="err_msg session_msg"></div>
				</div>



<div class="box-content">

<script>
	
$(function()
{
	 
	 var id=<?php echo ((isset($this->params['pass'][0]) ? $this->params['pass'][0] : 0));?>;

	 if(id>0 && id != undefined){
		 $('#pd option').each(function(){
	  
			 if($(this).val()==id)
			 {
				$(this).attr('selected','selected');
				
			 } 
	  
  		});
	}
	 

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

//////--------Passing Id on selecting product----////// 
	 $("#pd").change(function()
		{
		    id=$("#pd").val();
		    //alert(id);
		    
		   location.href="<?php echo $this->Html->url('/',true); ?>admin/sliderManagements/add/"+id;
			
			
			
		});
}); //onload end		
		

</script>
<?php
//echo "<pre>";
//print_r($h);
		
?>		
		<div class="control-group row">
								<label for="selectError3" class="control-label"></label>
								<div class="controls span7">
								<?php	
								  
								 echo $this->Form->input('products',array('label'=>'', 'type'=>'select', 'empty'=>'select Product','id' => 'pd', 'data-rel' => 'chosen','options'=>$pid)); ?>
								  

								</div>
						
						
		</div>
						
		
	<div id='slide_number' class='row-fluid ' ><!-- row-fluid starts  -->
			<div class='span12 keyframe_area'>

			<?php
				    if(isset($select_pro)){
					echo $this->Form->create('SliderManagements'); 
					echo $this->Form->input('slide_numb',array('id'=>'slide_num'));
					echo $this->Form->submit('confirm',array('class'=>'btn btn-primary'));
					echo $this->Form->end();
				}
				
			?>
			</div>
	</div><!--row-fluid ends --> 
	<?php echo $this->Form->create('SliderManagements',array('action'=>'saveSlide','id'=>'slide_submit')); ?>
	<div id='slides'>
			<?php 
			
			if(isset($slide_numb)){
				     ?>
				     <script>
				     $(function()
				     {
				       $("#slide_number").hide();
				      });
				     </script>
				     
				     <?php
				     
					for($i=1;$i<=$slide_numb;$i++){
						?>	
						<label>Slide Title<?php echo $i;?></label>	
						<?php echo $this->Form->input('slide_title.',array('id'=>'title_id'.$i));?>	
						<div class='row-fluid slide_manage' id="<?php echo "div_".$i;?>">
							
						<label>Description<?php echo $i;?></label>	
						
						<?php echo $this->Form->input('slide_desc.',array('id'=>'desc_id'.$i,'class'=>'cleditor','type'=>'textarea'));?>
						<label>Image<?php echo $i;?></label>
						<?php echo $this->Form->input('image.', array('type'=>'file', 'enctype'=>'multipart/form-data','label'=>false));
						echo $this->Form->input('sid.',array('type'=>'hidden','value'=>$i));?>
						<?php echo $this->Form->input('pid',array('type'=>'hidden','value'=>$this->params['pass'][0]));?>
						<?php echo $this->Html->link('Make Static','javascript:changeMode_Static('.$i.')',array('id'=>'static_id'.$i));?>
						<?php	echo $this->Html->link('Make Dynamic','javascript:changeMode_Dynamic('.$i.')',array('id'=>'dynamic_id'.$i,'style'=>array('display:none;')));
						?>
			<!---To attach the keyfeatures for particular slider -->		
					
			<!---To attach the keyfeatures for particular slider ends here -->	
						</div>
						<?php
					}
					
						?>
		</div>
			<?php	
					echo $this->Form->submit('save',array('onclick'=>'SubmitAddNew()','type'=>'button','class'=>'btn btn-primary'));
					//echo $this->Form->button('Add',array('type'=>'button','class'=>'btn btn-primary','onclick'=>'addSlide('.$i++.')','id'=>'addId'));
					echo $this->Form->end();
			}
			
			
			
			?>
	
	
	
	
</div>
<?php
 
?>
<script>
////////---------To hide static link-----/////

function changeMode_Static(a){
	
	//alert($("#div_"+a+" .cleditorMain").html());
	$("#div_"+a+" .cleditorMain").hide();
	$("#desc_id"+a).html('static');
	
	//console.log($("#desc"+obj).closest().html());
	$("#desc_id"+a).hide();
	$("#static_id"+a).hide();
	$("#dynamic_id"+a).show();
	
	//alert(abc);	
	
	
}
///////////--------To hide dynamic link ------///////
function changeMode_Dynamic(b){
	//alert(data1);
	
	//var abc=$("#"+hide_Dynamic).val()
	$("#div_"+b+" .cleditorMain").show();
	$("#desc_id"+b).show();
	$("#static_id"+b).show();
	$("#dynamic_id"+b).hide();
	//alert(abc);	
	
	
}

//////////-----Form submission through AJAX----////
	function SubmitAddNew()
	{
		
		$("#slide_submit").ajaxSubmit({
			url: "<?php echo $this->webroot;?>admin/sliderManagements/saveSlide", 
			type: 'POST',
    		success: function(data)
    		{
    			 window.location="<?php echo $this->webroot;?>admin/sliderManagements/index";
    		}
    	});
    	
	}
////////////----------To add a slide in the page------/////

		function addSlide(c){
			//alert(c);
		var str= '<div id="div_'+c+'" class="row-fluid slide_manage"><div class="input textarea"><label for="desc_id'+c+'"></label><textarea name="data[SliderManagements][slide_desc][]" id="desc_id'+c+'" class="cleditor" cols="30" rows="6"></textarea></div><div class="input file"><label for="SliderManagementsImage"></label><input type="file" name="data[SliderManagements][image][]"  enctype="multipart/form-data" id="SliderManagementsImage"/></div><input type="hidden" name="data[SliderManagements][pid]" value="25" id="SliderManagementsPid"/><a href="javascript:changeMode_Static('+c+')" id="static_id'+c+'">Make Static</a><a href="javascript:changeMode_Dynamic('+c+')" id="dynamic_id'+c+'" style="display:none;">Make Dynamic</a></div></div>';	
		$("#slides").append(str);
		 $('.cleditor').cleditor();
		 $("input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
		 
		$("#addId").attr("onclick","addSlide("+(++c)+")");
		
		
		}
	
</script>
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
