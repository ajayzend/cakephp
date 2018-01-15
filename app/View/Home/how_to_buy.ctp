<script type="text/javascript">
        $("document").ready(function () {
            $("#leftdiv a").click(function () {
                var id = $(this).attr("data-val");
                $("#rightdiv").scrollTo($("#" + id), 600, { easing: 'swing' });
                $("#leftdiv li a").removeClass("active");
                $(this).addClass("active");
            });

        });
        
        $("document").ready(function () {
            $("#leftdiv1 a").click(function () {
                var id = $(this).attr("data-val");
                $("#rightdiv1").scrollTo($("#" + id), 600, { easing: 'swing' });
                $("#leftdiv1 li a").removeClass("active");
                $(this).addClass("active");
            });

        });
</script>

<div class="ProductDetailLeftPanel" style="padding:40px 0px;">
	<div class="col-lg-3">
    	<div class="LeftStockRow" style="padding:15px 0px 15px 15px">
            <a href="<?php echo $this->Html->url('/',true); ?>home/how_to_buy"><div class="StockPanelText" style="color:#55b640">How to Buy</div></a>
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
    	<h1 class="PageTitle">How to <span>Buy</span></h1>
        <div class="PageContent"><?php echo $content; ?></div>
    </div>
    <div class="clearfix"></div>
</div>
