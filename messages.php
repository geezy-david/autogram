<?php 
session_start(); 
if(isset($_SESSION['username'])){
	$logedin = true;
}else{
	$logedin = false;

}
if(!$logedin){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>HOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">

  }
  
 </style>
<?php include 'header.php'; ?>
</head>
<body id='message'>
  <div class="kk" style="display: none; height: 100%; z-index: 1; position: fixed; top: 0; left: 0; width: 100%; background-color: black;opacity: 0.3; "></div>
<?php if(!$logedin): ?>
<div class="sticky-top navbar-light bg-primary col-md-12 py-2" align="right">
<a class="navbar-brand" style="float: left; position: absolute; font-weight: bolder; padding: 2px" href="#">AUTOGRAM</a>
<button class="btn btn-danger navbar-right" data-toggle="modal" data-target="#loginmodal"><i class="fas fa-sign-in-alt"></i> LOGIN</button>
    <button class="navbar-right btn btn-warning" data-toggle="modal" data-target="#signupmodal"><i class="fas fa-user"></i> SIGNUP</button>
    </div>
<?php endif; ?>
<?php if($logedin): ?>
<nav  class="navbar  navbar-light bg-light sticky-top  "  >
<div class="container-fluid">
<a class="dropdown-toggle  navbar-brand " id="show" href="javascript:void(0);" data-target='show'    id="navbarDropdown" role="button" aria-haspopup="true">
<img src="images/<?php echo($_SESSION['image']) ?>" width='30' height='30' style='border-radius: 50%'>
</a>


<div class="dropdown-menu" style=""   >
<a class="dropdown-item" id='url' href="profile.php"><i class="fas    fa-user"></i>&nbsp&nbsp PROFILE</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" id='url' href="#"><i class="fas   fa-cog"></i>&nbsp&nbspSETTINGS</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" id='url' href="share.php"><i class="fas   fa-share"></i>&nbsp&nbspSHARE COINS</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" id='url' href="earncoins.php"><i class="fas   fa-coins"></i>&nbsp&nbspEARN COINS</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" id='url' href="logout.php"><i class="fas   fa-sign-out-alt"></i>&nbsp&nbspLOGOUT</a>
</div>



	<a id='url' style="display: none;" class="nav-link m " style="position: relative;"  href="home.php" ><i    class="fas text-danger  fa-2x fa-house-user"></i></a>
	<a  style="display: none;" class="nav-link link m" href="javascript:void(0);"  onclick="searchopen();" ><i    class="fas fa-2x fa-search text-danger"></i></a>
	<a style="display: none; color: black;" id='url' class=" nav-link m" href="messages.php" ><i   class="fab  fa-2x fa-facebook-messenger"></i></a>

	<a style="display: none;" id='url' class="link4 nav-link m" href="messages.php" ><i   class="fas text-danger fa-2x  fa-bell"></i></a>

	<a style="display: none;" id='url' class="link5 nav-link m" href="messages.php" ><i   class=" text-danger fas fa-2x  fa-user-plus"></i></a>
<a  href="home.php"  class="nav-link nav-mobile"><i  class="fas text-danger fa-2x  fa-search"></i></a>
</div>

</nav>


<div class="col-md-8 offset-md-2 mt-2">
<?php endif; ?>

<div class="card">
	<div class="text-center mt-2"><h3>CREATE POST...</h3></div>
<div class="card-body">
<div class="card-title"><textarea class='form-control text-center' name="" placeholder="WRITE SOMETHING HERE..." id="" cols="5" ></textarea>
</div>
<div class="card-text mt-2"><a  class="p" href="javascript:void(0);" onclick='' style='color:black; margin-buttom:5px; ' ><i class="fas fa-plus"></i> ADD PHOTO</a><buton class="btn btn-primary" style='float:right;' >POST</buton></div>
</div>
</div>


<footer id="footer" class="buttom container-fluid navbar-light bg-light py-2" style="border-top: 0.4px solid gray; display: none; left: 0;right: 0; align: center; position: fixed; bottom: 0em;">
	
	<div style="width: 100%;clear: both;">
<a id='url'   href="home.php" ><i style="width: 17%; "  class="fas  fa-2x text-danger   fa-house-user"></i>

<a id='url' href="notifications.php.php"><i style="width: 17%; margin-left: 10% "  class="fas text-danger fa-2x  fa-bell"></i></a>

<a id='url'  href="friendscenter.php"><i style="width: 17%; float: right;"  class="fas text-danger fa-2x  fa-user-plus"></i></a>
<a id='url' style="color: black;" href="messages.php"><i style="width:17%; float: right; margin-right: 10%"   class="fab  fa-2x  fa-facebook-messenger"></i></a></div>
<footer>
</div>
  <script src='frameworks/scripts.js'></script>
  <script type="text/javascript">
 
  setInterval(function () {
  	a =	$(window).width();
if(a <= 461){
  	$('footer').css('display','block');
  		$('.m').css('display','none');
  		$('.nav-mobile').css('display','inline');

  }else if (a > 461){
  	$('footer').css('display','none');
$('.m').css('display','inline');
$('.nav-mobile').hide();
  }
  }, 20)
  
  </script>
</body>
</html>
