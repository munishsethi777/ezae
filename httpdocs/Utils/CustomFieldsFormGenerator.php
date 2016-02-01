<?php
    class CustomFieldsFormGenerator{

        private static $customFieldsFormGenerator;
        public static function getInstance(){
            if (!self::$customFieldsFormGenerator)
            {
                self::$customFieldsFormGenerator = new CustomFieldsFormGenerator();
                return self::$customFieldsFormGenerator;
            }
            return self::$customFieldsFormGenerator;
        }
        
        public function getCustomfieldsFromArr($customFieldArr){
            $userCustomFields = "";
             foreach($customFieldArr as $key=>$value){
                $userCustomFields .= $key . ":" . $value . ";";            
            }
            return $userCustomFields;
        }
        
        public function getDivsForFormSettings($customFields,$isAlreadyExists = false){
            $html = "";
            if(!$isAlreadyExists){
                foreach($customFields as $customField){
                    $html .= self::getDraggableHtmlForEachField($customField);
                }    
            }else{
                foreach($customFields as $customField){
                    $cfObj = new UserCustomField();
                    $cfObj->setSeq($customField["seq"]);
                    $cfObj->setTitle($customField["title"]);
                    $cfObj->setFieldType($customField["fieldtype"]);
                    $cfObj->setPossibleValues($customField["possiblevalues"]);
                    $cfObj->setName($customField["name"]);
                    $isRequired = $customField["isrequired"] == "1" ? true : false;
                    $isVisible = $customField["isvisible"] == "1" ? true : false;
                    $html .= self::getDraggableHtmlForEachField($cfObj,$isRequired,$isVisible);
                }
            }
            
            return $html;
        }

        //Method is used to create Form with custom fields
        public function getFormHtmlForCompany($companySeq){
           $UCFDS = UserCustomFieldsDataStore::getInstance();
           $customFieldsArr = $UCFDS->findByCompany($companySeq);
           $customFieldForm = self::getFormForCustomFields($customFieldsArr);
           return $customFieldForm;
        }
        
        public function getFormHtmlForUser($userSeq){
           $UserMgr = UserMgr::getInstance();
           $sessionUtil =  SessionUtil::getInstance();
           $companySeq = $sessionUtil->getUserLoggedInCompanySeq();
           $customfields = $UserMgr->getCustomFields($userSeq);
           $customFieldValuearr = $this->getCustomFieldsArray($customfields);
           $UCFDS = UserCustomFieldsDataStore::getInstance();
           $customFieldsArr = $UCFDS->findByCompany($companySeq);
           $customFieldForm = self::getFormForCustomFields($customFieldsArr,$customFieldValuearr);
           return $customFieldForm;
        }
        
        public function getCustomFieldsArray($customFields,$removeLast = true){           
            $fields = explode(";", $customFields);
            if($removeLast){
                unset($fields[count($fields)-1]);    
            }
            
            // Output array
            $customFieldArray = array();
            
            // Loop over the first explode() result
            foreach ($fields as $field) {
              // Assign each pair to $s, $q
              list($s, $q) = explode(":", $field);
              // And put them onto an array keyed by size
              $customFieldArray[$s] = $q;
            }    
            return $customFieldArray;
        }
        
        public function getFormForCustomFields($customFieldsArr,$customfieldValueArr = null){
            $html = "";
            foreach($customFieldsArr as $userCustomField){
                $usrCustomFld = new UserCustomField();
                $usrCustomFld = $userCustomField;
                $labelTitle = $usrCustomFld->getTitle();
                $value = "";
                if($customfieldValueArr != null){
                    $value =   $customfieldValueArr[$labelTitle] ;
                }
                $inputCode = '<input type="text" onkeyup="fillFormData(this)" name="cus_'. $usrCustomFld->getName() .'" value="'. $value .'" id=cus_'. $usrCustomFld->getName()
                        .' placeholder="'. $usrCustomFld->getTitle() .'" class="form-control">';

                if($usrCustomFld->getFieldType() == "boolean"){
                    $inputCode = '<div class="checkbox i-checks">'.
                        '<label style="padding-left:0px"><input type="checkbox" value=""><i></i> '.
                        $usrCustomFld->getTitle().' </label></div>';
                    $labelTitle = "";
                }
                if($usrCustomFld->getFieldType() == "Dropdown"){
                    $dropdown = '<select id="cus_'. $usrCustomFld->getName() . '" name="'.  $usrCustomFld->getName() . '" class="form-control">';
                    $pValues = explode("\r\n",$userCustomField->getPossibleValues());
                   foreach($pValues as $key=>$value){
                        $dropdown .= '<option value="'. $value . '">' . $value . '</option>';     
                    }
                    $dropdown .= '</select>';                                
                    $inputCode = $dropdown;
                }
                $html .= '<div class="form-group">';
                $html .= '<label class="col-sm-3 control-label">'. $labelTitle .'</label>';
                $html .= '<div class="col-sm-9">'. $inputCode .'</div>';
                $html .= '</div>';
            }
            return $html;
        }

        private function getDraggableHtmlForEachField($userCustomField,$isRequired = false,$isVisible = false){
            $matchingRulesMgr = MatchingRuleMgr::getInstance();
            $matchingRules =$matchingRulesMgr->getMatchingRule();
            $customFieldObj = new UserCustomField();
            $customFieldObj =  $userCustomField;
            $fieldName = $customFieldObj->getTitle();
            $acutalName = $customFieldObj->getName();
            $possibleValues = $customFieldObj->getPossibleValues();
            $fieldNameLbl = "";
            $flag = true;
            if($acutalName == $matchingRules->getUserNameField()){
                    $fieldNameLbl = $fieldName . " (UserName)";      
            }
            if($acutalName == $matchingRules->getPasswordField()){
                    $fieldNameLbl = $fieldName . " (Password)"; 
            }
            if($acutalName == $matchingRules->getPasswordField() && 
                                        $fieldName == $matchingRules->getUserNameField()){
                    $fieldNameLbl = $fieldName .  " (UserName,Password)";      
            } 
            if(empty($fieldNameLbl)){
                $fieldNameLbl = $fieldName;
                $flag = false;
            }                       
            $customFieldObj = $userCustomField;              
            $html = '<div class="ibox border-bottom" id="block_'. $customFieldObj->getSeq() . '">';
            $html .= '<input type="hidden" name="seq[]" value="' . $customFieldObj->getSeq() . '" />';
            $html .= '<input type="hidden" name="fieldName_'. $customFieldObj->getSeq() . '" value="' . $fieldName . '" />';
            $html .= '<input type="hidden" name="fieldType_'. $customFieldObj->getSeq() . '" value="' . $customFieldObj->getFieldType() . '" />';
            $html .= '<input type="hidden" name="fieldActualName_'. $customFieldObj->getSeq() . '" value="' . $acutalName . '" />';
            $html .= '<input type="hidden" name="possibleValues_'. $customFieldObj->getSeq() . '" value="' . $possibleValues . '" />';
            $html .= '<div class="ibox-title" style="padding-bottom:40px;">';
            $html .= '<div class="col-sm-6"><h3>Field Name: '. $fieldNameLbl .'</h3></div>';
            $html .= '<div class="col-sm-2"><h3>Field Type: '. $customFieldObj->getFieldType() .'</h3></div>';
            $html .= '<div class="col-sm-2">';
            $html .= '<div class="checkbox i-checks">';
            $html .= '<label style="padding-left:0px">';            
            $visibleChecked = "";
            $requiredChecked = "";
            if($isVisible || $flag){
                $visibleChecked = 'checked="checked"';
            }
            if($isRequired || $flag){
                $requiredChecked = 'checked="checked"';
            }
            $disabled = "";
            if($flag){
                //$disabled = "disabled";    
            }
            $html .= '<input type="checkbox"'. $disabled .' name="required_'. $customFieldObj->getSeq() .'"' . $requiredChecked . '>';
            $html .= '<i></i> Required Field</label>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-sm-2">';
            $html .= '<div class="checkbox i-checks">';
            $html .= '<label style="padding-left:0px">';
            $html .= '<input type="checkbox"'.$disabled.' name="show_'. $customFieldObj->getSeq() .'"'. $visibleChecked. '>';
            $html .= '<i></i> Show on Form </label>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            return $html;
        }
    }
?>
