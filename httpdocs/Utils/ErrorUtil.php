<?php
  class ErrorUtil{
      
      public static function checkDulicateEntryError($exception){
          $msg  = $exception->getMessage();
          $trace = $exception->getTrace();
          if($trace[0]["args"][0][1] == "1062"){
            $msg = str_ireplace("entry","value",$msg);
            $msg = str_ireplace("key ","",$msg) ;
          }
          return $msg;
      }
  }
?>
