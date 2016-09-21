<?PHP
  if (!isset($t)) $t = "GIF";
  $t = "PNG";

//  header ("Content-type: image/".strtolower($t));
//  $im = ImageCreate(15, 50);
//  imageinterlace($image,1);

 // ereg("([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})", $f, $c);

//  if ($c[0]) {
//    $c[1]= hexdec($c[1]);
//    $c[2]= hexdec($c[2]);
//    $c[3]= hexdec($c[3]);
//  }

  //$bg = ImageColorAllocate ($im, $c[1], $c[2], $c[3]);
//  $bg = ImageColorAllocate ($im, 155, 255, 6);
//ImagePNG ($im);
  //if (strtolower($t) == "png") ImagePNG ($im);
  //if (strtolower($t) == "gif") ImageGIF ($im);
  //if (strtolower($t) == "jpeg" OR strtolower($t) == "jpg") ImageJPEG ($im);

$image = imagecreate(10,10);
$farbe_b = imagecolorallocate($image,10,36,106);
$farbe_body=imagecolorallocate($image,243,243,243);
imagefill($image,0,0,$farbe_body);
header("Content-Type: image/gif");
imagegif($image);

?>