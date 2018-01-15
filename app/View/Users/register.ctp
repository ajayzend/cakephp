<?php
?> 

<div class="ProductDetailLeftPanel">
	<div class="col-lg-3"></div>
    <div class="col-lg-4">
    	<div class="bg-info"><?php echo $this->Session->flash(); ?></div>
    	<h1 class="PageTitle">Register</h1>
        
        <?php echo $this->Form->create('User', array('action' => 'register')); ?>
        
        
        <?php   if (count($userGroups) >2) { ?>
            <label class="LoginFormLabel"><?php echo __('Group');?><font color='red'>*</font></label>
            <div class="clearfix"></div>
            <?php echo $this->Form->input("user_group_id" ,array('type' => 'select', 'label' => false,'div' => false,'class'=>"form-control BidAmountTextBox" ))?>
            <div class="clearfix"></div>
            <br>
		<?php   }   ?>
        
        <label class="LoginFormLabel"><?php echo __('Username');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("username" ,array('label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "Username"))?>
        <div class="clearfix"></div>
        <br>
        
        
        <label class="LoginFormLabel"><?php echo __('First Name');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("first_name" ,array('label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "First Name"))?>
        <div class="clearfix"></div>
        <br>
        
        
        <label class="LoginFormLabel"><?php echo __('Last Name');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("last_name" ,array('label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "Last Name"))?>
        <div class="clearfix"></div>
        <br>
        
        <label class="LoginFormLabel"><?php echo __('Mobile');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("contact" ,array('label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "Mobile Number"))?>
        <div class="clearfix"></div>
        <br>
        
        
        <label class="LoginFormLabel"><?php echo __('Email');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("email" ,array('label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "Email"))?>
        <div class="clearfix"></div>
        <br>
        
        
        <label class="LoginFormLabel"><?php echo __('Password');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "Password", "id" => "password"))?>
        <div class="clearfix"></div>
        <div id="result" style="padding:5px; margin-top:5px;"></div>
        <br>
        
        
        <label class="LoginFormLabel"><?php echo __('Confirm Password');?><font color='red'>*</font></label>
        <div class="clearfix"></div>
        <?php echo $this->Form->input("cpassword" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"form-control BidAmountTextBox", "placeholder" => "Confirm Password"))?>
        <div class="clearfix"></div>
        <br>
        
        
        <?php   if(USE_RECAPTCHA && PRIVATE_KEY_FROM_RECAPTCHA !="" && PUBLIC_KEY_FROM_RECAPTCHA !="") { ?>
            <label class="LoginFormLabel"></label>
            <div class="clearfix"></div>
            <?php echo $this->UserAuth->showCaptcha(isset($this->validationErrors['User']['captcha'][0]) ? $this->validationErrors['User']['captcha'][0] : ""); ?>
            <div class="clearfix"></div>
            <br>
        <?php   } ?>
        
        <div class="col-lg-6 NoPadding"><button type="submit" onClick="return valid()" class="ProductDetailBuyNowButton hvr-pulse-grow">Sign Up</button></div>
        
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="clearfix"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
$('#password').keyup(function() {
$('#result').html(checkStrength($('#password').val()))
})
function checkStrength(password) {
var strength = 0
if (password.length < 6) {
$('#result').removeClass()
$('#result').addClass('alert-danger')
return 'Too short'
}
if (password.length > 7) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
if (strength < 2) {
$('#result').removeClass()
$('#result').addClass('alert-danger')
return 'Weak'
} else if (strength == 2) {
$('#result').removeClass()
$('#result').addClass('alert-warning')
return 'Good'
} else {
$('#result').removeClass()
$('#result').addClass('alert-success')
return 'Strong'
}
}
});

function valid()
{
	pass = $('#result').html();
	if(pass != "Strong")
	{
		alert("Please Enter Strong Password");
		return false;
	}
}
</script>