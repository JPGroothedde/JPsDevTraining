<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class CalendarForm extends QForm {
    protected $calendar;
    protected $calendarClickAction;
    protected $btnGetEvent;
    public function Form_Create() {
        parent::Form_Create();
        $this->calendarClickAction = new sUIElementsBase($this);
        $this->calendarClickAction->AddAction(new QClickEvent(), new QAjaxAction('calendarClickAction'));
        $this->calendar = new sUIElementsCalendar($this,null,$this->calendarClickAction->getJqControlId());
        $this->calendar->updateUI();
        $this->btnGetEvent = AppSpecificFunctions::getNewActionButton($this,'Get Event','btn btn-default','getEvent');
    }
    protected function getEvent($strFormId, $strControlId, $strParameter) {
        $this->calendar->getEvent('321');
    }
    protected function newEvent($date) {
        $theNewDate = new QDateTime($date,null,QDateTime::DateAndTimeType);
        $theNewEndDate = new QDateTime($date,null,QDateTime::DateAndTimeType);
        $theNewEndDate->AddHours(2);
        $this->calendar->createEvent('321','New Event',$theNewDate,$theNewEndDate,'black');
    }
    protected function calendarClickAction($strFormId, $strControlId, $strParameter) {
        $resultObj = json_decode($strParameter);

        if ($resultObj->Type == 'new')
            $this->newEvent($resultObj->Date);
        elseif ($resultObj->Type == 'click'){
            $this->calendar->updateEvent($resultObj->EventId,'Updated Title',QDateTime::Now(),QDateTime::Now()->AddHours(1));
        } elseif ($resultObj->Type == 'resize'){
            AppSpecificFunctions::DisplayAlert(json_encode($resultObj));
            $this->calendar->getEvent($resultObj->EventId);
        } elseif ($resultObj->Type == 'drag'){
            AppSpecificFunctions::DisplayAlert(json_encode($resultObj));
            $this->calendar->removeEvent($resultObj->EventId);
        }elseif ($resultObj->Type == 'get'){
            AppSpecificFunctions::DisplayAlert(json_encode($resultObj));
        }
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
CalendarForm::Run('CalendarForm');
?>