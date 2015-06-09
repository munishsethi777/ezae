<?php
  class ImageUtil{
    
    public static function uploadImage($path,$imgSource,$orgImageSource,$seq){
        $img = $imgSource;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $path . $seq . ".png"; 
        $uploaded = file_put_contents($file, $data);
                    
        $img = $orgImageSource;
        $img = str_replace('data:image/', '', $img);
        $ext  = strtok($img, ';');
        $img = str_replace($ext . ';base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $path . $seq . "_org" . ".jpg" ; 
        $uploaded = file_put_contents($file, $data);
        return  $uploaded;
    }  
  }
?>
