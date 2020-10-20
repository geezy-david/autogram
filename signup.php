<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SIGNUP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php include 'header.php'; ?>
<body>


<div class="container" >
	<div class="row">
		 

		<div style="background-color: #ccc" class="col-md-3 offset-md-4  ">
			<H5 class="text-center mt-4 alert-primary" style='margin-bottom: 20px'>SIGNUP</H5>
		<div class="alert alert-danger text-center" id="error"></div>
			<div class="dropdown-divider"></div>
			<form method="post" action="includes/signup.inc.php">
		<div class="form-group ">
	<input class="form-control text-center " value="" id="firstname" placeholder="FIRSTNAME" name="name"></input>
</div>
<div class="form-group ">
	<input class="form-control text-center " id="lastname" value="" placeholder="LASTNAME" name="name2"></input>
</div>
<div class="form-group ">
	<input class="form-control text-center " value="" id="username" placeholder="USERNAME" name="username"></input>
</div>
<div class="form-group ">
	<input class="form-control text-center"  value="" id="email" placeholder="EMAIL" name="email"></input>
</div>
<div class="form-group ">
	<input class="form-control text-center"  type="password" id="pwd" placeholder="PASSWORD" name="pwd"></input>
	<div class="dropdown-divider"></div>

</div>


<div class="form-group "><button type="button" class="btn btn-outline-primary btn-block form-control-ig " id="btn" name="signup">SIGNUP</button></div>
</form>
<div class="dropdown-divider"></div>


<div class="text-center">
ALREADY A MEMBER??<a href="login.php" > LOGIN</a>
</div>
<div class="text-center">
<a href="pwd-reset.php" >FORGOTTEN PASSWORD??</a>
</div>
	</div>
</div>
</div>

		
<script type="text/javascript">

	$(document).ready(function(){
		$('#error').hide();
		$('#btn').on('click', function(){
var name = $('#firstname').val();
var name2    = $('#lastname').val();
var username   = $('#username').val();
var password  = $('#pwd').val();
var email  = $('#email').val();

if(name == '' || name2 =='' || username =='' || password =='' || email ==''){
$('#error').html('please fill out all empty fields');
$('#error').show();
return true;
}else {
	
	$('#error').hide();
	$.ajax({
		url:'includes/signup.inc.php',
		method:'POST',
		dataType:'text',
		data:{signup:1,name:name,name2:name2,username:username,password:password,email:email},
     
		beforesend:function(){
			$('#btn').attr('disabled','disabled');
			$('#btn').html("<i class='fas fa-circle-notch fa-spin'></i>PLEASE WAIT...");
		},
		success:function(response){
			$('#btn').attr('disabled',false);
			$('#btn').html("SIGNUP");
			if(response == 'failedname'){
				$('#error').html('PLEASE INPUT A VALID NAME');
				$('#error').show();
				return;
			}else if(response == "failedusername"){
				$('#error').html('PLEASE INPUT A VALID USERNAME');
				$('#error').show();
				return;
			}else if(response == "failedemail"){
				$('#error').html('PLEASE INPUT A VALID EMAIL ADDRESS');
				$('#error').show();
				return;
		}else if(response == "sqlerror"){
				$('#error').html('SQL PHASEING ERROR TRY AGAIN');
				$('#error').show();
				return;
		}else if(response == "emailused"){
				$('#error').html('THE EMAIL HAS BEEN USED BY ANOTHER USER');
				$('#error').show();
				return;
		}else if(response == "userused"){
				$('#error').html('PLEASE YOUR USERNAME HAS BEEN USED BY ANOTHER USER');
				$('#error').show();
				return;
		}else if(response == "done"){
				$('#error').html('PLEASE YOU HAVE BEEN SUCESSFULLY REGISTERED');
				$('#error').show();
				return;
		}
	}
		
		});
	
	}
})
		});
	

</script>
</body>
</html>
