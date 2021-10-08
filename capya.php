<?php
session_start();
define('CAPYAINC','/web/user/askapache.com/includes/capya/'); // the directory where the fonts and bg image are stored
define('CAPYAURI','https://www.askapache.com/s/s.askapache.net/i/');  // the web uri where the captcha image will be located
define('CAPYADIR','/web/user/s.askapache.net/public_html/i/');  the directory where the captcha image will be stored

function askapache_captcha($type=1,$numletters=4,$fontsize=22){
    $capya_string=capya_string($numletters);        // the letters and numbers displayed on captcha
    $capya_bgfile=CAPYAINC.'n.png';              // the background image for the captcha
    $capya_filename='askapache-'.rand(1111,999999).'.jpg';    // the filename of finished captcha
    $capya_file=CAPYADIR.$capya_filename;          // the full path to finished captcha
    $capya_uri=CAPYAURI.$capya_filename;          // the public web address to finished captcha
    $rgb[0]=array(204,0,0);
    $rgb[1]=array(34,136,0);
    $rgb[2]=array(51,102,204);
    $rgb[3]=array(141,214,210);
    $rgb[4]=array(214,141,205);
    $rgb[5]=array(100,138,204);

    // create image from background image
    $image=imagecreatefrompng($capya_bgfile);

    // store the md5 of the captcha string
    $_SESSION['askapache_captcha'] = md5($capya_string);

  // add chars to captcha image
  $g=$fontsize;
  for($i=0; $i<$numletters; $i++){
    $L[]=substr($capya_string,$i,1);    // each char from string into individual variable
    $A[]=rand(-20, 20);      // random angle for each char
    $F[]=CAPYAINC.rand(1, 10).".ttf";  // random font for each char
    $C[]=rand(0, 5);      // random color for each char
    $T[]=imagecolorallocate($image,$rgb[$C[$i]][0],$rgb[$C[$i]][1],$rgb[$C[$i]][2]);  // allocate colors for chars
    imagettftext($image, $fontsize, $A[$i], $g, $fontsize+15, $T[$i], $F[$i], $L[$i]);  // write chars to image
    $g+=$fontsize+10;
  }

  // save jpeg image to public web folder
  imagejpeg($image, $capya_file);

  if($type===1){
  // output the image url
    echo '<p><label for="capya" class="S"><input id="capya" name="capya" type="text" value="" size="5" class="S" style="width:150px" maxlength="5" /></label></p>';
  } else echo '';

    // destroy image
    imagedestroy($image);

    // delete all captcha images at 12 and 3 oclock if more than 100 are found
    $dt=date('g');
    if(($dt==12)||($dt=='12'))capya_cleanup();
    else if(($dt==3)||($dt=='3'))capya_cleanup();
}

function capya_cleanup(){
$files=glob(CAPYADIR."apache*.jpg");
  if(sizeof($files)>100){
    foreach ($files as $filename) {
        unlink($filename);
      //echo "$filename size " . filesize($filename) . "n";
    }
  }
}

function capya_string($len){
  $str='';
    for($i=1; $i<=$len; $i++) {
        $ord=rand(48, 90);
        if((($ord >= 48) && ($ord <= 57)) || (($ord >= 65) && ($ord<= 90))) $str.=chr($ord);
        else $str.=capya_string(1);
    }
    return $str;
}
?>
