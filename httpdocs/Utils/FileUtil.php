<?php
  class FileUtil{
    public static function uploadFiles($file,$path){
        if(move_uploaded_file($file['tmp_name'], $path .basename($file['name'])))
        {
            return $file['name'];
        }
        else
        {
            throw new Exception("Error During file upload");
        }
    }
    
    public static function uploadImageFiles($file,$path,$name){
        if(move_uploaded_file($file['tmp_name'], $path.$name))
        {
            return $name;
        }
        else
        {
            throw new Exception("Error During file upload");
        }
    }
  }
?>
