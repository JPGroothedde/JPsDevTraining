<?php
class PlaceHolder_API_Base {
    public function __construct() {

    }
    public function getPlaceHolder($PlaceHolderId = null) {
        if ($PlaceHolderId){
            $thePlaceHolderObj = PlaceHolder::Load($PlaceHolderId);
            if ($thePlaceHolderObj) {
                $result = array("Result" => "Success","Obj" => json_decode($thePlaceHolderObj->getJson()));
                return $result;
            }
            $result = array("Result" => "Success","Obj" => null);
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Invalid Object Id");
        return $result;
    }
    public function createPlaceHolder($ = '') { 
        $newPlaceHolderObj = new PlaceHolder();
        if (strlen($) > 0)
            $newPlaceHolderObj-> = $;
        try {
            $newPlaceHolderObj->Save();
            $result = array("Result" => "Success","ObjId" => $newPlaceHolderObj->Id);
            return $result;
        } catch (QCallerException $e) {
            error_log('Could not create PlaceHolder object via API: '.$e->getMessage());
            $result = array("Result" => "Failed","Message" => $e->getMessage());
            return $result;
        }
        return null;
    }
    public function updatePlaceHolder($PlaceHolderId = null,$ = '') {
        if (!$PlaceHolderId) {
            $result = array("Result" => "Failed","Message" => "Invalid Object Id");
            return $result;
        }
        $existingPlaceHolderObj = PlaceHolder::Load($PlaceHolderId);
        if (!$existingPlaceHolderObj) {
            $result = array("Result" => "Failed","Message" => "Object not found");
            return $result;
        }
        if (strlen($) > 0)
            $existingPlaceHolderObj-> = $;
        try {
            $existingPlaceHolderObj->Save();
            $result = array("Result" => "Success","Message" => "Object Modified");
            return $result;
        } catch (QCallerException $e) {
            error_log('Could not update PlaceHolder object via API: '.$e->getMessage());
            $result = array("Result" => "Failed","Message" => $e->getMessage());
            return $result;
        }
        return null;
    }
    public function deletePlaceHolder($PlaceHolderId = null) {
        if ($PlaceHolderId){
            $thePlaceHolderObj = PlaceHolder::Load($PlaceHolderId);
            if ($thePlaceHolderObj) {
                $thePlaceHolderObj->Delete();
                $result = array("Result" => "Success");
                return $result;
            }
            $result = array("Result" => "Failed","Message" => "Object not found");
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Invalid Object Id");
        return $result;
    }
    
    public function getPlaceHolderList($QConditions = null,$limit = 50,$offset = 0) {
        if (!$QConditions){
            $PlaceHolderArray = PlaceHolder::QueryArray(QQ::All(),QQ::Clause(QQ::LimitInfo($limit,$offset)));
            $returnArray = array();
            foreach ($PlaceHolderArray as $obj) {
                array_push($returnArray,json_decode($obj->getJson()));
            }
            $result = array("Result" => "Success","ObjArray" => $returnArray);
            return $result;
        } else {
            $queryConditions = null;
            foreach ($QConditions as $condition) {
                if (is_array($condition)) {
                    $andCondition = array_key_exists('AND',$condition);
                    $orCondition = array_key_exists('OR',$condition);
                    if ($andCondition) {
                        $objQueryNode = QQN::PlaceHolder()->__get($condition['AND'][0]);
                        $strSymbol = $condition['AND'][1];
                        $mixValue = 0;
                        if (isset($condition['AND'][2]))
                            $mixValue = $condition['AND'][2];
                        $mixValueTwo = 0;
                        if (isset($condition['AND'][3]))
                            $mixValueTwo = $condition['AND'][3];
                    } elseif ($orCondition) {
                        $objQueryNode = QQN::PlaceHolder()->__get($condition['OR'][0]);
                        $strSymbol = $condition['OR'][1];
                        $mixValue = 0;
                        if (isset($condition['OR'][2]))
                            $mixValue = $condition['OR'][2];
                        $mixValueTwo = 0;
                        if (isset($condition['OR'][3]))
                            $mixValueTwo = $condition['OR'][3];
                    } else {
                        $result = array("Result" => "Failed","Message" => "Invalid Compare Symbol");
                        return $result;
                    }
                    try {
                        switch(strtolower(trim($strSymbol))) {
                            case '=': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::Equal($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case '!=': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotEqual($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case '>': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::GreaterThan($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case '<': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::LessThan($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case '>=': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::GreaterOrEqual($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case '<=': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::LessOrEqual($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case 'in': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::In($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case 'not in': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotIn($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case 'like': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::Like($objQueryNode, '%'.$mixValue.'%'),$andCondition,$orCondition);
                                break;
                            case 'not like': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotLike($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case 'is null': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::IsNull($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case 'is not null': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::IsNotNull($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case 'between': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::Between($objQueryNode, $mixValue, $mixValueTwo),$andCondition,$orCondition);
                                break;
                            case 'not between': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotBetween($objQueryNode, $mixValue, $mixValueTwo),$andCondition,$orCondition);
                                break;
                            default:
                                throw new QCallerException('Unknown Query Comparison Operation: ' . $strSymbol.'. '.$this->formatAvailableComparisonSymbols(), 0);
                        }
                    } catch (QCallerException $objExc) {
                        $result = array("Result" => "Failed","Message" => $objExc->getMessage());
                        return $result;
                    }
                }
            }
            $PlaceHolderArray = PlaceHolder::QueryArray($queryConditions,QQ::Clause(QQ::LimitInfo($limit,$offset)));

            $returnArray = array();
            foreach ($PlaceHolderArray as $obj) {
                array_push($returnArray,json_decode($obj->getJson()));
            }
            $result = array("Result" => "Success","ObjArray" => $returnArray);
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Unknown");
        return $result;
        
    }
    protected function BuildQueryCondition($queryConditionsStart = null,$queryConditionsToAdd = null,$and = false,$or = false) {
        if (!$queryConditionsToAdd)
            return null;
        if (!$queryConditionsStart)
            return $queryConditionsToAdd;
        if ($and) {
            return QQ::AndCondition($queryConditionsStart,$queryConditionsToAdd);
        } elseif ($or) {
            return QQ::OrCondition($queryConditionsStart,$queryConditionsToAdd);
        }
        return $queryConditionsStart;
    }
    protected function formatAvailableComparisonSymbols() {
        return 'Available symbols are: "=", "!=", ">", "<", ">=", "<=", "in", "not in", "like", "not like", "is null", "is not null", "between", "not between"';
    }
}
?>