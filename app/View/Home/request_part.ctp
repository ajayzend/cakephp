<div class="ProductDetailLeftPanel" style="padding:40px 0px;">
	<div class="col-lg-3">
    	<div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy"><div class="StockPanelText">How to Buy</div></a>
        </div>
        
        <div class="LeftStockRow" style="padding:15px 0px 15px 25px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/steps_to_buy"><div class="StockPanelText">Steps to Buy</div></a>
        </div>
        <div class="LeftStockRow" style="padding:15px 0px 15px 25px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/steps_to_bid"><div class="StockPanelText">Steps to Bid</div></a>
        </div>
        <div class="LeftStockRow" style="padding:15px 0px 15px 25px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/step_to_register"><div class="StockPanelText">Step to Register</div></a>
        </div>
        
        <div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/request_car"><div class="StockPanelText">Order A Car</div></a>
        </div>
        <div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/request_part"><div class="StockPanelText" style="color:#55b640">Order A Part</div></a>
        </div>

        <div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>pages/aboutus"><div class="StockPanelText">Company Info</div></a>
        </div>
        <div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>pages/terms_condition"><div class="StockPanelText">Terms & Conditions</div></a>
        </div>
        <div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>pages/policy"><div class="StockPanelText">Payment Policy</div></a>
        </div>        
    </div>



	<div class="col-lg-9">
	<div class="PageContent"><?php echo $order_a_part; ?></div>
	<div class="request-form"> 
        
            <?php echo $this->Form->create('Home',array('class'=>'col-sm-12'));?>
            <?php 
             $msg1 = $this->Session->flash();
                    if($msg1 != '') 
                        { 
                 ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <?php echo $msg1; ?>
                            </div>
                    <?php } ?>
                <p>Request any part and we will buy it from the auction for you.
                </p>
            
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="name">Name:</label>
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'secondnameId','label'=>false,'div'=>false, 'placeholder' => "Name"));?>
                
                </div>
                
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="email">Email:<span>*</span></label>
                    <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'emailId','label'=>false,'div'=>false, 'placeholder' => "Email"));?>
                
                </div>
    
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="contact">Contact No.:<span>*</span></label>
                    <?php echo $this->Form->input('contact',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'contactId','label'=>false,'div'=>false, 'placeholder' => "Contact No."));?>
                </div>
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="make">Make:</label>
                    <?php echo $this->Form->input('make',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'makeId','label'=>false,'div'=>false, 'placeholder' => "Make"));?>
                </div>
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="model">Model:</label>
                    <?php echo $this->Form->input('model',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'modelId','label'=>false,'div'=>false, 'placeholder' => "Model"));?>
                
                </div>
                
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="part">Part:</label>
                    <?php echo $this->Form->input('part',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'partId','label'=>false,'div'=>false, 'placeholder' => "Part"));?>
                
                </div>
                                    
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="year">Year:</label>
                    <?php  echo $this->element('year');?>
                
                </div>
                
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="country">Country:</label>						
                <?php echo $this->element('country');?> 
                
                </div>
                
                <div class="form-group col-sm-4"> 
                    <label class="LoginFormLabel" for="comments">Comments:</label>
                    <?php echo $this->Form->input('comment',array('type'=>'textarea','rows'=>'3','class'=>'form-control BidAmountTextBox','id'=>'commentsId','label'=>false,'div'=>false, 'placeholder' => "Comments"));?>
        
                </div>
                <div class="col-lg-4 pull-right">
                <?php echo $this->Form->submit('Request a Part',array('type'=>'submit','div'=>false,'class'=>'ProductDetailBuyNowButton hvr-pulse-grow'));?>
                </div>
                <div class="clearfix"></div>
                <?php echo $this->Form->end();?>
            </form>
        </div>
    
    </div>
    <div class="clearfix"></div>
</div>

<script>
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

$(function(){
	 
jQuery(document).ready(function(){
	jQuery("#year").chosen();
	jQuery("#country").chosen();
	
});
});
</script>
