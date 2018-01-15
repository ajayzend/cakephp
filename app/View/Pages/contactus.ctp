<div class="ProductDetailLeftPanel">
	<h1 class="PageTitle">Contact <span>Us</span></h1>
    <div class="col-md-8">
        <!-- Google Map starts here -->
        <iframe width="100%" height="415" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Nakagawa+chuo+Tsuzuki-ku+Yokohama+JAPAN&amp;aq=&amp;sll=35.527226,139.608045&amp;sspn=0.414083,0.837021&amp;ie=UTF8&amp;hq=Kanagawa+chuo&amp;hnear=Tsuzuki+Ward,+Yokohama,+Kanagawa+Prefecture,+Japan&amp;t=m&amp;ll=35.426546,139.621811&amp;spn=0.201427,0.76149&amp;z=11&amp;output=embed"></iframe>
        <!-- Google Map Ends Here -->
        
        
        
    <div class="contact_textbox"><h2>Contact Form</h2>
    <div style="display:none;" id="messageDivIdSucc" class="alert alert-success "></div>
    <div style="display:none;" id="errmessageDiv" class="alert alert-danger"></div>
    <div style="display:none;"  id="loader"><img style="height:50px;" src="<?php echo $this->webroot; ?>ajax-loader.gif"/><p>Sending...</p></div>
    
    <?php echo $this->Form->create('Home',array('id'=>'contactusFrmId'));?>
    <div class="form-group inline-form-input">
    <!-- <input type="text" name="your-name" value="" class="form-control" size="28" aria-required="true" placeholder="Name:"> -->
    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','size'=>'28','aria-required'=>true,'label'=>false,'placeholder'=>'Name:'));?>
    <div style="display:none;" id="errmessageDivIdName" class="alert alert-danger">
    </div>
    
    </div>
    <div class="form-group inline-form-input">
    <!-- <input type="email" name="your-email" value="" class="form-control" size="27" aria-required="true" placeholder="E-mail:"> -->
    <?php echo $this->Form->input('email',array('type'=>'email','class'=>'form-control','size'=>'27','aria-required'=>true,'label'=>false,'placeholder'=>'E-mail:'	));?>
    <div style="display:none;" id="errmessageDivIdEmail" class="alert alert-danger">
    </div>
    </div>
    <div class="form-group inline-form-input">
    <!-- <input type="text" id="" name="your-phone" value="" class="form-control" size="27" placeholder="Phone:"> -->
    <?php echo $this->Form->input('phone',array('type'=>'text','class'=>'form-control','size'=>'27','aria-required'=>true,'label'=>false,'placeholder'=>'Enter 10 digit number:'));?>
    <div style="display:none;" id="errmessageDivIdPhone" class="alert alert-danger">
    </div>
    </div>
    <div class="clearfix"></div>
    <p class="field">
    <!-- <textarea name="your-message" cols="40" rows="10" class="form-control" placeholder="Message:"></textarea> -->
    <?php echo $this->Form->input('msgInfo',array('type'=>'textarea','class'=>'form-control','rows'=>'10','cols'=>'40','aria-required'=>true,'label'=>false,'placeholder'=>'Message:'));?>
    </p>
    <p class="submit-wrap">
    <!-- <input type="reset" value="Clear" class="btn btn-danger btn-sm">
    <input type="button" value="Send" class="btn btn-danger btn-sm" 'onClick'="javascript:submitForm();">
    -->
    
    <div class="col-lg-4"><?php echo $this->Form->button('SEND', array('type' => 'button','onclick'=>'submitForm();', 'class' => 'ProductDetailBuyNowButton hvr-pulse-grow col-lg-12'));?></div>
    <div class="col-lg-4"><?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'ProductDetailBuyNowButton hvr-pulse-grow col-lg-12', 'style' => "background: #798899;"));?></div>
    
    
    
    </p>
    <!-- </form> -->
    <?php $this->Form->end();?>
    </div>
    </div>
    <?php echo $content; ?>
    
    <hr>
	<!--<img src="<?php echo $this->webroot; ?>images/contact-img.jpg" class="img-thumbnail img-responsive" alt="COntact Us">-->
    <div class="clearfix"></div>
</div>

<script>
	function submitForm(){
		var name=document.forms["contactusFrmId"]["HomeName"].value;
		var email=document.forms["contactusFrmId"]["HomeEmail"].value;
		var phone=document.forms["contactusFrmId"]["HomePhone"].value;
		//var x=document.forms["contactusFrmId"]["email"].value;
	if(name==''){
		//errmessageDivIdName
		$('#errmessageDivIdName').show();
		$('#errmessageDivIdName').html('Please Enter Your Name!');
		$('#errmessageDivIdName' ).delay(5000).fadeOut( "slow" );
		//document.contactusFrmId.HomeName.focus() ;
		
	}else if(email==''){
		$('#errmessageDivIdEmail').show();
		$('#errmessageDivIdEmail').html('Please Enter Your Email!');
		$('#errmessageDivIdEmail' ).delay(5000).fadeOut( "slow" );
		//document.contactusFrmId.HomeEmail.focus() ;
	}else if(email!=''){
		if(email.indexOf(' ') >= 0){
			$('#errmessageDivIdEmail').show();
			$('#errmessageDivIdEmail').html('Please Enter Your Correct Email without space!');
			$('#errmessageDivIdEmail' ).delay(5000).fadeOut( "slow" );
		}else{
		
			atpos = email.indexOf("@");
		   dotpos = email.lastIndexOf(".");
		   if (atpos < 1 || ( dotpos - atpos < 2 )) 
		   {
			    $('#errmessageDivIdEmail').show();
				$('#errmessageDivIdEmail').html('Please Enter Your Correct Email!');
				$('#errmessageDivIdEmail' ).delay(5000).fadeOut( "slow" );
			  // document.contactusFrmId.HomeEmail.focus() ;
			  
			   return false;
		   }else{
			   //validForm();
			   phoneValidate(phone);
			}
		}  
		   
		
	}
	
	/*else {
		$("#contactusFrmId").ajaxSubmit({
			url:"<?php echo $this->Html->url('/home/send_mail',true);?>",
			type:"POST",			
			success:function(result){
				//var obj = jQuery.parseJSON(result);
				console.log(result);
			}
			
			
		});
	
		
	}*/
	
}


function phoneValidate(phone){
	
	if(phone ==''){
		$('#errmessageDivIdPhone').show();
		$('#errmessageDivIdPhone').html('Please Enter Your Phone!');
		$('#errmessageDivIdPhone' ).delay(5000).fadeOut( "slow" );
	}else if(phone !=''){
		
			 validForm();
			/*var phoneno = /^\d{10}$/;
			if((phone.match(phoneno))){  
				 // return true;  
				 validForm();
			}else {  
				//alert("message"); 
				$('#errmessageDivIdPhone').show();
				$('#errmessageDivIdPhone').html('Please Enter Your Correct Phone!');
				$('#errmessageDivIdPhone' ).delay(5000).fadeOut( "slow" );
				return false;  
			} */ 
			
	}
}

	function validForm(){
		$("#contactusFrmId").ajaxSubmit({
				url:"<?php echo $this->Html->url('/home/send_mail',true);?>",
				type:"POST",
				beforeSend:function()
				{
					$('#loader').show();
				},
				success:function(result){
					$('#loader').hide();
					var obj = jQuery.parseJSON(result);
					if(obj.status!='error'){
						document.getElementById("contactusFrmId").reset();
						$('#messageDivIdSucc').show();
						$('#messageDivIdSucc').html(obj.message);
						$('#messageDivIdSucc' ).delay(5000).fadeOut( "slow" );
						
					}else{
						document.getElementById("contactusFrmId").reset();
						$('#errmessageDiv').show();
						$('#errmessageDiv').html(obj.message);
						$('#errmessageDiv' ).delay(5000).fadeOut( "slow" );
					}
						
				}
				
				
			});
	}
	
	
</script>
<style type="text/css">
@media ( max-width:630px){
	div.login-control {
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.298);
  color: rgb(255, 255, 255);
  font-family: Roboto,Arial;
  font-size: 11px;
  font-weight: 500;
  margin-right: 2px !important;
  margin-top: 10px;}
  }
</style>
