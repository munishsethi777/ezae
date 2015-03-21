<?php
  class StringUtil{
      
      public static function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str)==='');
      }
      
      public static function generatePassword( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
      }
  }
?>
