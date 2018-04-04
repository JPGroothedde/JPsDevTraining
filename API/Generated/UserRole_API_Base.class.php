<?php
class UserRole_API_Base {
    public function __construct() {

    }
    public function getUserRole($UserRoleId = null) {
        if ($UserRoleId){
            $theUserRoleObj = UserRole::Load($UserRoleId);
            if ($theUserRoleObj) {
                $result = array("Result" => "Success","Obj" => json_decode($theUserRoleObj->getJson()));
                return $result;
            }
            $result = array("Result" => "Success","Obj" => null);
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Invalid Object Id");
        return $result;
    }
    public function createUserRole($Role = '') { 
        $newUserRoleObj = new UserRole();
        if (strlen($Role) > 0)
            $newUserRoleObj->Role = $Role;
        try {
            $newUserRoleObj->Save();
            $result = array("Result" => "Success","ObjId" => $newUserRoleObj->Id);
            return $result;
        } catch (QCallerException $e) {
            AppSpecificFunctions::AddCustomLog('Could not create UserRole object via API: '.$e->getMessage());
            $result = array("Result" => "Failed","Message" => $e->getMessage());
            return $result;
        }
        return null;
    }
    public function updateUserRole($UserRoleId = null,$Role = '') {
        if (!$UserRoleId) {
            $result = array("Result" => "Failed","Message" => "Invalid Object Id");
            return $result;
        }
        $existingUserRoleObj = UserRole::Load($UserRoleId);
        if (!$existingUserRoleObj) {
            $result = array("Result" => "Failed","Message" => "Object not found");
            return $result;
        }
        if (strlen($Role) > 0)
            $existingUserRoleObj->Role = $Role;
        try {
            $existingUserRoleObj->Save();
            $result = array("Result" => "Success","Message" => "Object Modified");
            return $result;
        } catch (QCallerException $e) {
            AppSpecificFunctions::AddCustomLog('Could not update UserRole object via API: '.$e->getMessage());
            $result = array("Result" => "Failed","Message" => $e->getMessage());
            return $result;
        }
        return null;
    }
    public function deleteUserRole($UserRoleId = null) {
        if ($UserRoleId){
            $theUserRoleObj = UserRole::Load($UserRoleId);
            if ($theUserRoleObj) {
                $theUserRoleObj->Delete();
                $result = array("Result" => "Success");
                return $result;
            }
            $result = array("Result" => "Failed","Message" => "Object not found");
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Invalid Object Id");
        return $result;
    }
    
    public function getUserRoleList($QConditions = null,$limit = 50,$offset = 0) {
        if (!$QConditions){
            $UserRoleArray = UserRole::QueryArray(QQ::All(),QQ::Clause(QQ::LimitInfo($limit,$offset)));
            $returnArray = array();
            foreach ($UserRoleArray as $obj) {
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
                        $objQueryNode = QQN::UserRole()->__get($condition['AND'][0]);
                        $strSymbol = $condition['AND'][1];
                        $mixValue = 0;
                        if (isset($condition['AND'][2]))
                            $mixValue = $condition['AND'][2];
                        $mixValueTwo = 0;
                        if (isset($condition['AND'][3]))
                            $mixValueTwo = $condition['AND'][3];
                    } elseif ($orCondition) {
                        $objQueryNode = QQN::UserRole()->__get($condition['OR'][0]);
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
            $UserRoleArray = UserRole::QueryArray($queryConditions,QQ::Clause(QQ::LimitInfo($limit,$offset)));

            $returnArray = array();
            foreach ($UserRoleArray as $obj) {
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