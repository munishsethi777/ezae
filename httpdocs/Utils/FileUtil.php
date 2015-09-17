<?php
  class FileUtil{
    public static function uploadFiles($file,$path){
        if(move_uploaded_file($file['tmp_name'], $path .basename($file['name'])))
        {
            return $path .$file['name'];
        }
        else
        {
            throw new Exception("Error During file upload");
        }
    }
  }
?>
