<div class="ProductDetailLeftPanel">
	<div class="col-lg-3"></div>
    <div class="col-lg-4">
    	<h1 class="PageTitle">Chassis <span>Check</span></h1>
        <strong>Determining the date of issuance of the Japanese car:</strong>
        <p>Enter the number and select the brand:</p>
        
        
        <form name="frameno_form"  id="frameno_form"> 
        
        <label class="LoginFormLabel">Frame Number:</label>
        <div class="clearfix"></div>
        <input type="text" name="no" id="no" class="form-control BidAmountTextBox" placeholder="Frame Number">
        <div class="clearfix"></div>
        <br>
        
        
        <label class="LoginFormLabel">Firm:</label>
        <div class="clearfix"></div>
        <select name="firm" id="firm" class="form-control BidAmountTextBox">
            <option value="9">Toyota</option>
            <option value="6">Nissan</option>
            <option value="5">Mitsubishi</option>
            <option value="2">Honda</option>
            <option value="4">Mazda</option>
            <option value="7">Subaru</option>
            <option value="8">Suzuki</option>
            <option value="3">Isuzu</option>
            <option value="1">Daihatsu</option>
        </select>
        <div class="clearfix"></div>
        
        <div class="col-lg-6 NoPadding"><button type="button" onclick="getData();" class="ProductDetailBuyNowButton hvr-pulse-grow">Define</button></div>
        
        </form>
        
        
    </div>
    <div class="clearfix"></div>
</div>
	
<script >
function getData()
{
	var firm_id = document.getElementById("frameno_form").firm.value;
	var frame_no = document.getElementById("frameno_form").no.value;
	window.open("http://www.drom.ru/frameno/common.php?firm="+firm_id+"&no="+frame_no+"&lang=eng&httpreferer=<?php echo $this->Html->url('/home/chasis_check',true);?>","", "toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars="+1+", resizable=yes,width="+350+",height="+250+",top=100,left=100");
	return false;
}
</script>
