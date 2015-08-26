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
                $html .= '<div class="form-group">';
                $html .= '<label class="col-sm-3 control-label">'. $labelTitle .'</label>';
                $html .= '<div class="col-sm-9">'. $inputCode .'</div>';
                $html .= '</div>';
            }
            return $html;
        }

        private function getDraggableHtmlForEachField($userCustomField,$isRequired = false,$isVisible = false){
            $customFieldObj = new UserCustomField();
            $customFieldObj = $userCustomField;              
            $html = '<div class="ibox border-bottom" id="block_'.$customFieldObj->getSeq()  . '">';
            $html .= '<input type="hidden" name="seq[]" value="' . $customFieldObj->getSeq() . '" />';
            $html .= '<input type="hidden" name="fieldName_'. $customFieldObj->getSeq() . '" value="' . $customFieldObj->getName() . '" />';
            $html .= '<input type="hidden" name="fieldType_'. $customFieldObj->getSeq() . '" value="' . $customFieldObj->getFieldType() . '" />';
            $html .= '<div class="ibox-title" style="padding-bottom:40px;">';
            $html .= '<div class="col-sm-6"><h3>Field Name: '. $customFieldObj->getTitle() .'</h3></div>';
            $html .= '<div class="col-sm-2"><h3>Field Type: '. $customFieldObj->getFieldType() .'</h3></div>';
            $html .= '<div class="col-sm-2">';
            $html .= '<div class="checkbox i-checks">';
            $html .= '<label style="padding-left:0px">';            
            $visibleChecked = "";
            $requiredChecked = "";
            if($isVisible){
                $visibleChecked = 'checked="checked"';
            }
            if($isRequired){
                $requiredChecked = 'checked="checked"';
            }
            $html .= '<input type="checkbox" name="required_'. $customFieldObj->getSeq() .'"' . $requiredChecked . '>';
            $html .= '<i></i> Required Field</label>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-sm-2">';
            $html .= '<div class="checkbox i-checks">';
            $html .= '<label style="padding-left:0px">';
            $html .= '<input type="checkbox" name="show_'. $customFieldObj->getSeq() .'"'. $visibleChecked. '>';
            $html .= '<i></i> Show on Form </label>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            return $html;
        }
    }
?>
