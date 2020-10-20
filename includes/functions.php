<?php


function makeavatar($string){


  
    $imageFilePath = "../images/".time() . ".png";

    //base avatar image that we use to center our text string on top of it.
    $avatar = imagecreatetruecolor(60,60);
   $r = mt_rand(0,255);
$g = mt_rand(0,255);
$b = mt_rand(0,255);
    $bg_color = imagecolorallocate($avatar, $r, $g, $b);

    imagefill($avatar,0,0,$bg_color);
    $avatar_text_color = imagecolorallocate($avatar, 225, 225, 225);
	// Load the gd font and write 
    $font = imageloadfont('../gd-files/ok.gdf');
    imagestring($avatar, $font, 10, 10, $string, $avatar_text_color);

    imagepng($avatar, $imageFilePath);
  
    imagedestroy($avatar);
   
    return $imageFilePath;



}


