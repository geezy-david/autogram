<?php 
session_start(); 
if(isset($_SESSION['username'])){
	$logedin = true;
}else{
	$logedin = false;
}
if($logedin){
	header('location:home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>WELCOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  .form-control{
padding: 10px;
}</style>

<?php include 'header.php'; ?>
</head>
<body>
  <div class="kk" style="display: none; height: 100%; z-index: 1; position: fixed; top: 0; left: 0; width: 100%; background-color: black;opacity: 0.3; "></div>
<?php if(!$logedin): ?>
<div class="sticky-top navbar-light bg-primary col-md-12 py-2" align="right">



<button class="btn btn-danger navbar-right" data-toggle="modal" data-target="#loginmodal">LOGIN</button>
    <button class="navbar-right btn btn-warning" data-toggle="modal" data-target="#signupmodal"></i> SIGNUP</button>
    </div>
<?php endif; ?>
<div class="adsarea py-5 text-center" >PLACE YOUR ADVERTS HERE!!!</div>
<div class="alert-success alert"></div>













<!-popup modal login-!>
<div class="modal" id="loginmodal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-title" ><h5 class="text-center bg-primary py-4">LOGIN TO YOUR AUTOALL ACCOUNT</h5></div>
<div class="modal-body">
	<div style="display: none;" id='errorlogin' class="text-center alert alert-danger"></div>
	<div style="display: none;" id='successlogin' class="text-center alert alert-success"></div>
<input type="text" id="num"  placeholder="EMAIL OR USERNAME"  class="form-control text-center">
<input type="password" id="pwdl"  placeholder="PASSWORD "  class="mt-3 form-control text-center">
<button class="btn btn-block form-control-ig btn-primary mt-3"  id="login">LOGIN</button>
</div>
<div class="modal-footer">

<button class="btn btn-default"  data-dismiss="modal">CLOSE</button>
</div>
</div>
</div>
</div>



<!-popup modal signup-!>
<div class="modal" id="signupmodal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-title" ><h5 class="text-center bg-primary py-4">CREATE A NEW AUTOALL ACCOUNT</h5></div>
<div class="modal-body"><div style="display: none;" id='error' class="text-center alert alert-danger"></div>
<div style="display: none;" id='success' class="alert text-center alert-success">SIGNUP SUCCESSFUL</div>
<input type="text" id="firstname"  placeholder="FIRSTNAME"  class="form-control mt-3 text-center">	
<input type="text" class="text-center mt-3  form-control" id='lastname' placeholder='LASTNAME'>
<input type="text" id="username"  placeholder="USERNAME"  class="form-control mt-3 text-center">
<input type="text" id="email"  placeholder="EMAIL"  class="form-control text-center mt-3">
<input type="password" id="pwd"  placeholder="PASSWORD "  class="form-control mt-3 text-center">
<button class="btn btn-primary btn-block form-control-ig mt-3"  id="btn" >SIGNUP</button>
</div>
<div class="modal-footer">

<button class="btn btn-default"  data-dismiss="modal">CLOSE</button>
</div>
</div>
</div>
</div>




<script type="text/javascript">

	$(document).ready(function(){
		
		$('#btn').on('click', function(){
var name = $('#firstname').val();
var name2    = $('#lastname').val();
var username   = $('#username').val();
var password  = $('#pwd').val();
var email  = $('#email').val();

if(name == '' || name2 =='' || username =='' || password =='' || email ==''){
$('#error').html('PLEASE FILL OUT ALL EMPTY FIELDS');
$('#error').show();
return true;
}else {
	
	$('#error').hide();
	$.ajax({
		url:'includes/signup.inc.php',
		method:'POST',
		dataType:'text',
		data:{signup:1,name:name,name2:name2,username:username,password:password,email:email},
     
		beforeSend:function(){
			$('#btn').attr('disabled','disabled');
			$('#btn').html("<i class='fas fa-circle-notch fa-spin'></i> PLEASE WAIT...");
		},
		success:function(response){
			$('#btn').attr('disabled',false);
			$('#btn').html("SIGNUP");
			if(response == 'failedname'){
				$('#error').html('PLEASE INPUT A VALID NAME');
				$("#success").hide();
				$('#error').show();
				return;
			}else if(response == "failedusername"){
				$('#error').html('PLEASE INPUT A VALID USERNAME');
				$("#success").hide();
				$('#error').show();
				return;
			}else if(response == "failedemail"){
				$('#error').html('PLEASE INPUT A VALID EMAIL ADDRESS');
				$("#success").hide();
				$('#error').show();
				return;
		}else if(response == "sqlerror"){
				$('#error').html('SQL PHASEING ERROR TRY AGAIN');
				$("#success").hide();
				$('#error').show();
				return;
		}else if(response == "emailused"){
				$('#error').html('THE EMAIL HAS BEEN USED BY ANOTHER USER');
				$("#success").hide();
				$('#error').show();
				return;
		}else if(response == "userused"){
				$('#error').html('PLEASE YOUR USERNAME HAS BEEN USED BY ANOTHER USER');
				$("#success").hide();
				$('#error').show();
				return;
		}else if(response == "done"){
				
				$('#success').show();
 
				$('#btn').attr('disabled','disabled');
				$('#btn').html("<i class='fas fa-circle-notch fa-spin'></i> PLEASE WAIT...");
				setTimeout(function(){
					window.location = window.location;
				}, 2000)
				return;
		}
	}
		
		});
	
	}
});


$("#login").on('click',function(){
	var name = $('#num').val();
	var pwd = $('#pwdl').val();
	if(name =='' || pwd == '' ){
		$('#errorlogin').text('PLEASE FILL OUT ALL FIELDS');
		$('#successlogin').hide();
		$('#errorlogin').show();

		return;
	}else{
		$.ajax({
			url:'includes/login.inc.php',
			method:'POST',
			dataType:"TEXT",
			data:{login:1,name:name,pwd:pwd},
			beforeSend:function(){
			$('#login').attr('disabled','disabled');
			$('#login').html("<i class='fas fa-circle-notch fa-spin'></i> PLEASE WAIT...");
		},
		success:function(response){
			$('#login').attr('disabled',false);
			$('#login').html("LOGIN");
			if(response == 'wrongnum'){
				$("#errorlogin").html('INVALID USERNAME OR EMAIL');
				$('#successlogin').hide();
				$('#errorlogin').show();

				return;
			}else if(response == 'wrongpwd'){
$("#errorlogin").html('WRONG PASSWORD');
$('#successlogin').hide();
				$('#errorlogin').show();
				return;
			}else if(response == 'sqlerror'){
				$("#errorlogin").html('SQL ERROR TRY AGAIN');
				$('#successlogin').hide();
				$('#errorlogin').show();
				return;

			}else if(response == 'logedin'){
				$('#errorlogin').hide();
				$('#successlogin').show();
				$('#successlogin').html('YOU HAVE BEEN LOGED IN SUCCESSFULLY');
				$('#login').attr('disabled','disabled');
			$('#login').html("<i class='fas fa-circle-notch fa-spin'></i>  PLEASE WAIT REDIRECTING...");
			}

		}
		})
	}
 })


		});
	


</script>

  <script src='frameworks/scripts.js'></script>
</body>
</html>
