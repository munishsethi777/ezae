<?php
  class DateUtil{
      
      public static function StringToDate($dateStr){
        return DateTime::createFromFormat('m/d/Y h:i A', $dateStr);  
      }
      public static function StringToDateByGivenFormat($format,$dateStr){
        return DateTime::createFromFormat($format, $dateStr);  
      }    
  }
?>
