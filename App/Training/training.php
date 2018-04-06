<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

//if (!checkRole(array('User')))
//AppSpecificFunctions::Redirect(__USRMNG__.'/login/');

class trainingForm extends QForm {

    public function Form_Create() {
        parent::Form_Create();
        //$PlaceHolderCount = PlaceHolder::QueryCount(QQ::All());
        //$RandomId = rand(1,$PlaceHolderCount+1);
        //$RandomPlaceHolderObj = PlaceHolder::Load($RandomId);

        /// start date and end date use rand() to generate;
        /// Assign FinalMark with rand() as well
        for($i=0;$i<10;$i++) {
            $FirstName = AppSpecificFunctions::generateRandomString(10);
            $LastName = AppSpecificFunctions::generateRandomString(10);
            $AccountObj = new Account();
            $AccountObj->FirstName = $FirstName;
            $AccountObj->LastName = $LastName;
            $CourseName = AppSpecificFunctions::generateRandomString(10);
            $CoursePrice = 1000;
            $CourseObj = new Course();
            $CourseObj->CourseName = $CourseName;
            $CourseObj->CoursePrice = $CoursePrice;
            $AssignmentName = AppSpecificFunctions::generateRandomString(10);
            $AssignmentFinalMark = rand(1,100);
            $AssignmentObj  = new Assignment();
            $AssignmentObj->AssignmentName = $AssignmentName;
            $AssignmentObj->FinalMark = $AssignmentFinalMark;
            try {
                //$AccountObj->Save();
                //$CourseObj->Save();
                //$AssignmentObj->Save();
            } catch (QCallerException $e){

            }
            //AppSpecificFunctions::AddCustomLog($AccountObj->getJson());
        }

        for($i=0;$i<10;$i++) {
            $StudentCount = Account::QueryCount(QQ::All());
            $RandomStudentId = rand(1, $StudentCount + 1);
            $CourseCount = Course::QueryCount(QQ::All());
            $RandomCourseId = rand(1, $CourseCount + 1);
            $AssignmentCount = Assignment::QueryCount(QQ::All());
            $RandomAssignmentCount = rand(1, $AssignmentCount + 1);
            $StartDate = QDateTime::Now();
            $EndDate = QDateTime::Now();
            $RandomMonthsToDate = rand(0, 60);
            $StartDate->AddMonths(-$RandomMonthsToDate);
            $EndDate->AddMonths(-$RandomMonthsToDate);
            $EndDate->AddMonths(+12);
            $SubscriptionObj = new Subscription();
            $SubscriptionObj->Account = $RandomStudentId;
            $SubscriptionObj->Course = $RandomCourseId;
            $SubscriptionObj->Assignment = $RandomAssignmentCount;
            $SubscriptionObj->StartDate = $StartDate;
            $SubscriptionObj->EndDate = $EndDate;
            try {
                //$SubscriptionObj->Save();
            } catch (QCallerException $e) {

            }
            //AppSpecificFunctions::AddCustomLog($SubscriptionObj->getJson());
        }

        $SubscriptionObj = Subscription::QuerySingle(
            QQ::AndCondition(
                QQ::Equal(QQN::Subscription()->AccountObject->FirstName,"QVSImPn508"),
                QQ::Equal(QQN::Subscription()->CourseObject->CourseName,"aoXCUA1uhQ")
            )
        );
        //AppSpecificFunctions::AddCustomLog($SubscriptionObj->getJson());
        if ($SubscriptionObj) {
            $AssignmentArray = Assignment::QueryArray(QQ::Equal(QQN::Assignment()->Id,$SubscriptionObj->Assignment));
            foreach ($AssignmentArray AS $Assignment) {
                //AppSpecificFunctions::AddCustomLog($Assignment->getJson());

                $AssignmentTotal = 0;
                $AssignmentTotal+= $Assignment->FinalMark;
            }
            $AssignmentAverage = 0;
            if (sizeof($AssignmentArray) > 0) {
                $AssignmentAverage = $AssignmentTotal / sizeof($AssignmentArray);
            }
            //AppSpecificFunctions::DisplayAlert('Firstname: '.$FirstName.' Surname: '.$LastName.' Course:'.$CourseName .' Average Mark: '.$AssignmentAverage);
        } else {
            AppSpecificFunctions::DisplayAlert('Could not locate subscription.');
        }
        $Date = QDateTime::Now();
        $Date->AddMonths(-12);
        $CourseArray = Course::QueryArray(QQ::All());
        foreach ($CourseArray AS $Course) {
            try {
                $SubscriptionArray = Subscription::QueryArray(
                    QQ::AndCondition(
                        QQ::Equal(QQN::Subscription()->CourseObject->Id, $Course->Id),
                        QQ::Equal(QQN::Subscription()->AccountObject->Id, 17),//1,3,5,17
                        QQ::OrCondition(
                            QQ::GreaterThan(QQN::Subscription()->EndDate, $Date),
                            QQ::GreaterThan(QQN::Subscription()->StartDate, $Date)
                        )
                    )
                );
            } catch (QCallerException $e) {

            }
            foreach ($SubscriptionArray AS $Subscription) {
                AppSpecificFunctions::AddCustomLog($Subscription->getJson());
            }
        }


    }
}
trainingForm::Run('trainingForm');

?>