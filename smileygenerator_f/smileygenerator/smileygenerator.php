<?
  $font = realpath ("cour.ttf") ;
//  echo $font ;

  // Delete Slashes
  $text = stripslashes ($text) ;
  // Which width will the Text have
  $sizes = imagettfbbox ( 8, 0, $font, $text) ;

  //Load smiley
  $smileyimage = @imagecreatefrompng ("./smiley_".$smiley.".png") ;
  //Couldn't load smiley...
  if ($smileyimage == "")
  {
    //So replace by default smiley
    $smileyimage = imagecreatefrompng ("./smiley_normal.png") ;
    //Get size of default smiley
    $addy = getImageSize ("./smiley_normal.png") ;
  }
  else
  {
    //Get size of smiley
    $addy = getImageSize ("./smiley_".$smiley.".png") ;
  }

  //Minimumsize of Image for Smiley
  $w = max ($addy[0], $sizes[2]) ;
  //Create image
  $mainimage = imagecreate($w+10, $addy[1]+30);

  // allocate Colors
  $white = imagecolorallocate ($mainimage, 255, 255, 255) ;
  $black = imagecolorallocate ($mainimage, 0, 0, 0) ;
  $bg = imagecolorallocate ($mainimage, 255, 0, 255) ;

  //set wannabe-transparancy-color to background
  imagefill ($mainimage, 0, 0, $bg) ;

  //copy smiley into image
  imagecopyresized($mainimage, $smileyimage, (($w+10)-$addy[0]) / 2, 30, 0, 0, $addy[0], $addy[1], $addy[0], $addy[1]) ;

  //draw poster
  imagerectangle ($mainimage, 0, 0, $w+9, 29, $black) ;
  imagefilledrectangle ($mainimage, 1, 1, $w+8, 28, $white) ;

  //draw text
  imagettftext ($mainimage, 8, 0, (($w - $sizes[2]+10)/2), 18, $black, $font, $text) ;

  //do the rest *g*
  imagecolortransparent($mainimage, $bg) ;
  header("Content-Type: image/png");
  imagepng ($mainimage) ;
?>