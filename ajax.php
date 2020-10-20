<?php 
session_start();
if(isset($_SESSION['username'])){
	$logedin = true;
}else{
	$logedin = false;
} ?>
<!DOCTYPE html>
<html id="html">
<head>
	<?php 

include 'header.php'; ?>

	<title>AJAX</title>
</head>
<body>
	<div class="kk" style="display: none; height: 100%; z-index: 1; position: fixed; top: 0; left: 0; width: 100%; background-color: black;opacity: 0.3; "></div>
	<a href="index.php" id='form' >swicw</a>
	<a href="index">euhfcoierb</a>
	<a href="http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?&tags=everest&tagmode=any&format=json">Click Me</a>
igufiv






<script type="text/javascript">
/*	$("a").loadingbar({
  target: "body",
  replaceURL: true,
  direction: "right",
 
Default Ajax Parameters.  

 
  
});*/

	$('a').on('click',function(e){
		e.preventDefault();
		purl = $(this).attr('href');
		$.ajax({
			url:purl,
		
			beforeSend:function(){
				$(".kk").show();
				if ($("#loadingbar").length === 0) {
              $("body").append("<div id='loadingbar'></div>");
              $("#loadingbar").addClass("waiting").append($("<dt/><dd/>"));
             
                   $("#loadingbar").width((50 + Math.random() * 30) + "%");
                  
          }
		},
			success:function(response){
				$('body').html(response);
			}
		})
		if(purl !== window.location){
window.history.pushState(null,null,purl)
		}

	});

	$(window).bind('popstate',function(){
		$.ajax({url:location.pathname,
success:function(data){
			$('html').html(data);
		}
	})
		
	});

</script>
</body>
</html>
