<div id="content1"> 
	<div class="box col-md-12">
		<div class="box-header well">
			<div class="col-md-12">
				<h2><i class="fa fa-list-alt"></i>Slider Management</h2></div>
			<div class="clearfix"></div>	
		</div>
		<div class="report-management">
		<div class="pull-right" style="margin-bottom:20px">	
						<?php echo $this->Html->link('Go Back',array('action' => '/'),array('class'=>'btn btn-primary'));?>  
						<div class="clearfix"></div>		
		    </div>
			<div class="col-sm-12">
				<?php echo $this->Form->create('homePageManagements',array('action'=>'saveSlide','class'=>'add_home_mgmt','id'=>'slide_submit','enctype'=>'multipart/form-data')); ?>										
						<div class='control-group'>
							<div class="col-sm-3">
								<label for="title_id">Order</label>
							</div>
							<div class="col-sm-9">								
								<?php echo $this->Form->input('HomePageSlide.order', array('class'=>'form-control','type'=>'text','label'=>false));?>
							</div>
							<div style="clear:both"></div>
						</div>	
						
						
						<div class='control-group'>
							<div class="col-sm-3">
								<label for="title_id">Slide Name</label>
							</div>
							<div class="col-sm-9">								
								<?php echo $this->Form->input('HomePageSlide.slide_name', array('class'=>'form-control','type'=>'text','label'=>false));?>
							</div>
							<div style="clear:both"></div>
						</div>	
						
						<div class='control-group'>
							<div class="col-sm-3">
								<label for="title_id">Image</label>
							</div>
							<div class="col-sm-9">
								<?php echo $this->Form->input('HomePageSlide.image', array('class'=>'form-control','type'=>'file','label'=>false,'id'=>'image'));?>
							</div><div style="clear:both"></div>
						</div>
						<div class='control-group'>
							
							<img id="target" height='366' width='852' src="#" alt="" />
							
						</div>
					<div class='control-group'>	
						<?php echo $this->Form->submit('save',array('type'=>'submit','class'=>'btn btn-info'));?>		
					</div>		
				<?php echo $this->Form->end();?>			
							
			</div>
		</div>
	</div>
</div>

<script>
	
$(function()
{
	
	 
	$("#productId").chosen();
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

	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#target').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image").change(function(){
        readURL(this);
    });

</script>
