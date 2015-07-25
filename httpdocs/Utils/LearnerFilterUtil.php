<?php
  require_once($ConstantsArray['dbServerUrl'] ."Utils/StringUtil.php");
  class LearnerFilterUtil{
      public static function getPagination(){
           if(isset($_GET['pagenum'])){
                $pagenum = intval($_GET['pagenum']);
                $pagesize = intval($_GET['pagesize']);
                $start = $pagenum;
                if($pagenum > 0){
                     $start = $pagenum * $pagesize;    
                }       
                $filter["start"] = $start;
                $filter["limit"] = $pagesize;
                return $filter;
           }
      }
  
  private static function appendLimit($query){
    if(isset($_GET['pagenum'])){
        $pagenum = intval($_GET['pagenum']);
        $pagesize = intval($_GET['pagesize']);
        $start = $pagenum;
        if($pagenum > 1){
             $start = $pagenum * $pagesize;    
        }       
        $query = $query . " limit " . $start . "," . $pagesize;
    }    
    return $query;         
  }
  
  public static function sortByCustomField($fullArr){       
       
        if (isset($_GET['sortdatafield']))
        {
            $sortfield = $_GET['sortdatafield'];
            if(StringUtil::startsWith($sortfield,"cus_") || StringUtil::startsWith($sortfield,"prof_")){                
            }else{
                return $fullArr;    
            }
            $sortorder = $_GET['sortorder'];            
            if ($sortfield != NULL)
            {
                if ($sortorder == "desc")
                {
                    usort($fullArr, function($a, $b)
                    {
                        return strcmp($b[$_GET['sortdatafield']], $a[$_GET['sortdatafield']]);
                    });
                }
                else if ($sortorder == "asc")
                {
                    usort($fullArr, function($a, $b)
                    {
                        return strcmp($a[$_GET['sortdatafield']], $b[$_GET['sortdatafield']]);
                    });
                }            
            }
        } 
        return $fullArr;
         
  }
  
  private static function appendSorting($query){
    if (isset($_GET['sortdatafield']))
    {
        $sortfield = $_GET['sortdatafield'];
        if(StringUtil::startsWith($sortfield,"cus_") || StringUtil::startsWith($sortfield,"prof_")){
            return $query;
        }
        $sortorder = $_GET['sortorder'];            
        if ($sortfield != NULL)
        {
            if ($sortorder == "desc")
            {
                $query = $query . " ORDER BY" . " " . $sortfield . " DESC";
            }
            else if ($sortorder == "asc")
            {
                $query = $query . " ORDER BY" . " " . $sortfield . " ASC";
            }            
        }
    }  
    return $query;  
  }
  public static function applyFilter($query,$isApplyLimit = true){
    // filter data.
    if (isset($_GET['filterscount']))
    {
        $filterscount = $_GET['filterscount'];
        $flag = false;
        
        if ($filterscount > 0)
        {
            if (strpos(strtolower ($query),'where') !== false) {
                $where = " AND (";
            }else{
                 $where = " WHERE (";    
            }
            $tmpdatafield = "";
            $tmpfilteroperator = "";
            $cusFieldprefix = "cus_";
            $profileFieldPrefix = "prof_";
            for ($i=0; $i < $filterscount; $i++)
            {
                // get the filter's value.
                $filtervalue = $_GET["filtervalue" . $i];
                // get the filter's condition.
                $filtercondition = $_GET["filtercondition" . $i];
                // get the filter's column.
                $filterdatafield = $_GET["filterdatafield" . $i];
                // get the filter's operator.
                $filteroperator = $_GET["filteroperator" . $i];
                if(StringUtil::startsWith($filterdatafield,$cusFieldprefix) || StringUtil::startsWith($filterdatafield,"prof_")){
                    continue;
                }
                $flag = true;
                if ($tmpdatafield == "")
                {
                    $tmpdatafield = $filterdatafield;            
                }
                else if ($tmpdatafield <> $filterdatafield)
                {
                    $where .= ")AND(";
                }
                else if ($tmpdatafield == $filterdatafield)
                {
                    if ($tmpfilteroperator == 0)
                    {
                        $where .= " AND ";
                    }
                    else $where .= " OR ";    
                }
              
                // build the "WHERE" clause depending on the filter's condition, value and datafield.
                switch($filtercondition)
                {
                    case "NOT_EMPTY":
                    case "NOT_NULL":
                        $where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";
                        break;
                    case "EMPTY":
                    case "NULL":
                        $where .= " " . $filterdatafield . " LIKE '" . "" ."'";
                        break;
                    case "CONTAINS_CASE_SENSITIVE":
                        $where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                        break;
                    case "CONTAINS":
                        $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                        break;
                    case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                        break;
                    case "DOES_NOT_CONTAIN":
                        $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                        break;
                    case "EQUAL_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";
                        break;
                    case "EQUAL":
                        $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                        break;
                    case "NOT_EQUAL_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";
                        break;
                    case "NOT_EQUAL":
                        $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                        break;
                    case "GREATER_THAN":
                        $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                        break;
                    case "LESS_THAN":
                        $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                        break;
                    case "GREATER_THAN_OR_EQUAL":
                        $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                        break;
                    case "LESS_THAN_OR_EQUAL":
                        $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                        break;
                    case "STARTS_WITH_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                        break;
                    case "STARTS_WITH":
                        $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                        break;
                    case "ENDS_WITH_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                        break;
                    case "ENDS_WITH":
                        $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                        break;
                }
                                
                if ($i == $filterscount - 1)
                {
                    $where .= ")";
                }
                
                $tmpfilteroperator = $filteroperator;
                $tmpdatafield = $filterdatafield;            
            }
            if(!$flag){
                return $query;
            }
            // build the query.
            $query = $query . $where; 
        }
        
      }
      //apply Sorting
        $query = LearnerFilterUtil::appendSorting($query);
        
      //apply limit
      if($isApplyLimit){
        $query = LearnerFilterUtil::appendLimit($query);
      }
      
      return $query;
  }
  
      public static function applyFilterOnCustomfield($customFields,$isCustomField = true){
        $flag = true;
        $query = "";
        $prefix = "cus_";
        if(!$isCustomField){
            $prefix = "prof_";    
        }
        if (isset($_GET['filterscount']))            
        {
            $filterscount = $_GET['filterscount'];            
            if ($filterscount > 0)                
                {
                    for ($i=0; $i < $filterscount; $i++)
                    {
                        // get the filter's value.
                        $filtervalue = $_GET["filtervalue" . $i];
                        // get the filter's condition.
                        $filtercondition = $_GET["filtercondition" . $i];
                        // get the filter's column.
                        $filterdatafield = $_GET["filterdatafield" . $i];
                        // get the filter's operator.
                        $filteroperator = $_GET["filteroperator" . $i];
                        if(!StringUtil::startsWith($filterdatafield,$prefix)){
                            continue;
                        }
                        $flag = false;
                        // build the "WHERE" clause depending on the filter's condition, value and datafield.
                        $value = $customFields[$filterdatafield];
                        $value = strtolower($value);
                        $filtervalue = strtolower($filtervalue);
                        switch($filtercondition)
                        {
                            case "CONTAINS":
                               if (strpos($value, $filtervalue) !== false){
                                    $flag = true;
                               }
                               break;
                            case "DOES_NOT_CONTAIN":
                                if (strpos($value, $filtervalue) !== true){
                                    $flag = true;
                                }
                                break;
                            case "EQUAL":
                               if ($value == $filtervalue){
                                    $flag = true;
                                }
                                break;
                            case "NOT_EQUAL":
                                if ($value != $filtervalue){
                                    $flag = true;
                                }
                                break;
                        }
                    }
                }
            }
        return $flag;    
      }
}
?>
