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
            <a href="<?php echo $this->Html->url('/',true); ?>home/request_car"><div class="StockPanelText" style="color:#55b640">Order A Car</div></a>
        </div>
        <div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/request_part"><div class="StockPanelText">Order A Part</div></a>
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
		<div class="PageContent"><?php echo $order_a_car; ?></div>
        <div class="request-form row">
                <div id="request-car" class="tab-pane active request-car">
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
                        <div class="form-group col-sm-4"> 
                            <label for="stock" class="LoginFormLabel">Stock No.</label>
                            <?php echo $this->Form->input('stock',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'stock','label'=>false,'div'=>false, 'placeholder' => "Stcok No."));?>
                        
                        </div>
                        
                        <div class="form-group col-sm-4"> 
                            <label for="name" class="LoginFormLabel">Name:</label>
                        <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'nameId','label'=>false,'div'=>false, 'placeholder' => "Name"));?>
                        
                        </div>
                        
                        <div class="form-group col-sm-4"> 
                            <label for="email" class="LoginFormLabel">Email:<span>*</span></label>
                        <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'emailId','label'=>false,'div'=>false, 'placeholder' => "Email"));?>
                        
                        </div>
    
                        <div class="form-group col-sm-4"> 
                            <label for="contact" class="LoginFormLabel">Contact No.:<span>*</span></label>
                        <?php echo $this->Form->input('contact',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'contactId','label'=>false,'div'=>false, 'placeholder' => "Contact No."));?>
                        
                        </div>
                        <div class="form-group col-sm-4"> 
                            <label for="make" class="LoginFormLabel">Make:</label>
                        <?php echo $this->Form->input('make',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'makeId','label'=>false,'div'=>false, 'placeholder' => "Make"));?>
                        
                        </div>
                        <div class="form-group col-sm-4"> 
                            <label for="model" class="LoginFormLabel">Model:</label>
                        <?php echo $this->Form->input('model',array('type'=>'text','class'=>'form-control BidAmountTextBox','id'=>'modelId','label'=>false,'div'=>false, 'placeholder' => "Model"));?>
                        </div>
                        
                        <div class="form-group col-sm-4"> 
                            <label for="year" class="LoginFormLabel">Year:</label>
                            <?php  echo $this->element('year');?>
                        
                        </div>
                        
                        <div class="form-group col-sm-4"> 
                            <label for="country" class="LoginFormLabel">Country:</label>
                        <?php echo $this->element('country');?> 
                        
                        </div>
                        
                        <div class="form-group col-sm-4"> 
                            <label for="comments" class="LoginFormLabel">Comments:</label>
                            <?php echo $this->Form->input('comment',array('type'=>'textarea','rows'=>'3','class'=>'form-control BidAmountTextBox','id'=>'commentsId','label'=>false,'div'=>false, 'placeholder' => "Comments"));?>
                            
                        </div>
                        <div class="col-lg-4 pull-right">
                        <?php echo $this->Form->submit('Request a Car',array('type'=>'submit','div'=>false,'class'=>'ProductDetailBuyNowButton hvr-pulse-grow'));?>
                        </div>
                        <div class="clearfix"></div>
                        <?php echo $this->Form->end();?>
                    
                </div>
                <div class="clearfix"></div>
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
