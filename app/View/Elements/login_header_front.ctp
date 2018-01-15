<script type="text/javascript">
  $(function() {
   $('.signIn').click(function() {
    $(this).toggleClass('new_highlight');
    $('.user_login').toggleClass('show');	
   });
  });
  
  $(function() {
   $('#close').click(function() {   
	$( ".user_login" ).fadeOut( "slow" );	
   });
  });
  
 </script> 
	<!--a href="javascript:void(0)" class="signIn">Login</a-->
	<form role="form" class="form-inline pull-right" action="javascript:void(0);">	
		<label class="errorMessage col-sm-12 pull-right" id="loginErrorDiv"  style="margin-bottom:10px;"></label>
		<div class="clearfix"></div>
		<div class="form-group">
				<input type="text" name="data[User][username]" class="form-control" id="exampleInputEmail1" placeholder="User Name">
				<input type="password" class="form-control" id="exampleInputPassword1"  placeholder="Password">
				<button onclick="loginW();" class="btn btn-default">Login</button>
			<!--button type="button" class="btn btn-default pull-right signIn">Cancel</button-->
			</div>
		<div class="clearfix"></div>
		</form>
	<!--Login Form End-->
