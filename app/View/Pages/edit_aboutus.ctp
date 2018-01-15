<div id="content1">   

	<div id="mainDiv">
		<div class="row sortable">
			<div class="box col-md-12">
				<div class="box-header well">
					<div class="col-md-12"><h2><i class="fa fa-asterisk sidebar_ico_margin">&nbsp;</i>Add About us</h2></div>
							<div class="clearfix"></div>	
					</div>
					<div class="pull-right" style="margin-bottom:20px">

						
						<?php echo $this->Html->link('Go Back',array('action' => 'aboutus_list'),array('class'=>'btn btn-primary'));?>  
						<div class="clearfix"></div>		
							

						</div>
					<div class="box-content">
						<?php
							$success = $this->Session->flash(); 
							if($success)
							 {
								 ?>
								<div id="hideDiv">
									<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert">×</button>
													<strong><?php echo $success ;?></strong>
									</div>
								</div>
						<?php }?>
					
						
					<?php echo $this->Form->create('Demo',array('id'=>'aboutusId','enctype'=>'multipart/form-data'));?>

									
									<div class="clearfix"></div>
									<p class="field">
										<?php echo $this->Form->input('discription',array('type'=>'textarea','class'=>'form-control','rows'=>'5','cols'=>'40','aria-required'=>true,'label'=>false,'placeholder'=>'Description:','value'=>@$About['About']['discription'],'required'));?>
									</p> 
									
								<div class="form-group inline-form-input">
									<?php echo $this->Form->input('img_path',array('type'=>'file','id'=>'img','class'=>'form-control','size'=>'27','label'=>false,
									'value'=>@$About['About']['img_source']));?>
									<img id="target" src="<?php echo $this->webroot.'uploads/about_img/'.@$About['About']['img_source'];?>"    alt="Image" />
									
								</div>
								
							<p class="submit-wrap">
							
								<?php echo $this->Form->button('<i class="fa fa-plus-circle">&nbsp;</i>Save', array('type' => 'submit','class' => 'btn btn-primary'));?>
								<?php echo $this->Html->link( 
										   '<i class="fa fa-plus-circle">&nbsp;</i>Cancel' ,
											array(
												'action' => 'aboutus_list'
											),array(
											'class'=>'btn btn-danger','escape'=>false  )
											
										);?>
							</p>
						
						<?php $this->Form->end();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>		
<script>
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#target').attr('src', e.target.result).width(553)
                .height(307);
                
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img").change(function(){
        readURL(this);
    });

</script>

