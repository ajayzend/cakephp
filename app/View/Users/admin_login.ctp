<div class="ProductDetailLeftPanel">
	<div class="col-lg-3"></div>
    <div class="col-lg-4">
    	<?php
        switch($status)
		{
			case 1 : echo '<div class="alert alert-danger" role="alert">Invalid Username or Password</div>'; break;
			case 2 : echo '<div class="alert alert-danger" role="alert">Sorry your account is not active, please contact to Administrator</div>'; break;
			case 3 : echo '<div class="alert alert-danger" role="alert">Your registration has not been confirmed please verify your email or contact to Administrator</div>';
		}
		?>
    	<h1 class="PageTitle">Registered User <span>LogIn</span></h1>
        <?php echo $this->Form->create('User', array('action' => 'login','class'=>'form-horizontal')); ?>
            <label class="LoginFormLabel">User Id</label>
            <div class="clearfix"></div>
			<?php echo $this->Form->input('username',array('type'=>'text','label' => false,'div' => false,'placeholder'=>'User Id','class'=>'form-control BidAmountTextBox', 'required' => true, 'autofocus'=>true));?>            
            <div class="clearfix"></div>
            <br>
            
            <label class="LoginFormLabel">Password</label>
            <div class="clearfix"></div>
			<?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'placeholder'=>'Password','div' => false,'class'=>"form-control BidAmountTextBox", 'required' => true))?>
            
            <div class="clearfix"></div>
            <br>
            
            <div class="pull-xs-left remember_be_text"><?php echo $this->Form->input("remember" ,array("type"=>"checkbox",'label' => false,'div'=>false))?> &nbsp; Remember Me</div>
            <div class="pull-xs-right forgot-password"><?php echo $this->html->link("Forgot Password ?",'/users/forgotPassword');?></div>
            
            <div class="clearfix"></div>
            <hr>
            <div class="col-lg-6 NoPadding"><button type="submit" class="ProductDetailBuyNowButton hvr-pulse-grow">Login</button></div>
            
            
            <div class="clearfix">&nbsp;</div>
            <div class="PrductDetailAcceptTerms" style="margin-top:20px;">Not a Registered User? <a href="<?php echo $this->Html->url('/',true); ?>register" style="color:#55b640">Register</a> Now</div>
            <!--<div class="PrductDetailAcceptTerms" style="margin-top:20px;">Forgot my <a href="" target="_blank">User ID</a></div>-->
            
    <?php echo $this->Form->end(); ?>
    </div>
    <div class="clearfix"></div>
</div>