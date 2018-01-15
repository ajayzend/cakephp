<div class="ProductDetailLeftPanel">
	<div class="col-lg-3"></div>
    <div class="col-lg-4">
    	<h1 class="PageTitle">FORGOT <span>PASSWORD</span></h1>
        
        <?php
        switch($status)
		{
			case 1 : echo '<div class="alert alert-danger" role="alert">Incorrect Email/Username</div>'; break;
			case 2 : echo '<div class="alert alert-danger" role="alert">Your registration has not been confirmed yet please verify your email before reset password</div>'; break;
			case 3 : echo '<div class="alert alert-success" role="alert">Please check your mail for reset your password</div>';
		}
		?>
        
        <p>Enter the emailaddress associated with your account to reset your Password</p>
        
        <?php echo $this->Form->create('User', array('action' => 'forgotPassword','class'=>'form-horizontal')); ?>
        
            <label class="LoginFormLabel">Email Id</label>
            <div class="clearfix"></div>
            <?php echo $this->Form->input('email',array('type'=>'text','label' => false,'placeholder'=>'E-mail','div' => false,'class'=>'form-control BidAmountTextBox','autofocus'=>true, 'required' => true));?>
            <div class="clearfix"></div>
            <div class="col-lg-6 NoPadding"><button type="submit" class="ProductDetailBuyNowButton hvr-pulse-grow">Send</button></div>
            
            <div class="clearfix">&nbsp;</div>
            <div class="PrductDetailAcceptTerms" style="margin-top:20px;">Registered User? <a href="<?php echo $this->Html->url('/',true); ?>login" style="color:#55b640">Back to Login</a></div>
            
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="clearfix"></div>
</div>