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
        public function getDivsForFormSettings($customFields){
            $html = "";
            foreach($customFields as $customField){
                $html .= self::getDraggableHtmlForEachField($customField);
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

        private function getFormForCustomFields($customFieldsArr){
            $html = "";
            foreach($customFieldsArr as $userCustomField){
                $usrCustomFld = new UserCustomField();
                $usrCustomFld = $userCustomField;
                $labelTitle = $usrCustomFld->getTitle();
                $inputCode = '<input type="text" id="'. $usrCustomFld->getName()
                        .'" placeholder="'. $usrCustomFld->getTitle() .'" id="exampleInputEmail2" class="form-control">';

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

        private function getDraggableHtmlForEachField($userCustomField){
            $customFieldObj = new UserCustomField();
            $customFieldObj = $userCustomField;
            $html = '<div class="ibox border-bottom">';
            $html .= '<div class="ibox-title" style="padding-bottom:40px;">';
            $html .= '<div class="col-sm-6"><h3>Field Name: '. $customFieldObj->getTitle() .'</h3></div>';
            $html .= '<div class="col-sm-2"><h3>Field Type: '. $customFieldObj->getFieldType() .'</h3></div>';
            $html .= '<div class="col-sm-2">';
            $html .= '<div class="checkbox i-checks">';
            $html .= '<label style="padding-left:0px"><input type="checkbox" name="required_'. $customFieldObj->getSeq() .'"><i></i> Required Field</label>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-sm-2">';
            $html .= '<div class="checkbox i-checks">';
            $html .= '<label style="padding-left:0px"><input type="checkbox" name="show'. $customFieldObj->getSeq() .'"checked="checked"><i></i> Show on Form </label>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            return $html;
        }
    }
?>
