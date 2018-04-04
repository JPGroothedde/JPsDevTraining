<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
/* Implementation of
 * https://fullcalendar.io/docs/
 */
class sUIElementsCalendar extends sUIElementsBase {
    protected $clickCallBackFunction,$parentFormId;
    protected $BusinessHoursStart,$BusinessHoursEnd;
    public function __construct($objParentObject, $strControlId = null,$clickCallBackFunction = null,$BusinessHoursStart = '08:00',$BusinessHoursEnd = '17:00') {
        parent::__construct($objParentObject, $strControlId);
        $this->AddJavascriptFile(__APP_JS_ASSETS__.'/FullCalendar/moment.min.js');
        $this->AddJavascriptFile(__APP_JS_ASSETS__.'/FullCalendar/fullcalendar.min.js');
        $this->AddJavascriptFile(__APP_JS_ASSETS__.'/FullCalendar/fullcalendar_helpers.js');
        $this->AddCssFile(__APP_CSS_ASSETS__.'/FullCalendar/fullcalendar.min.css');
        $this->clickCallBackFunction = $clickCallBackFunction;
        $this->parentFormId = $objParentObject->FormId;
        $this->BusinessHoursStart = $BusinessHoursStart;
        $this->BusinessHoursEnd = $BusinessHoursEnd;
    }

    public function updateUI() {
        // To be implemented by inheriting classes
        $html = '
            <div class="container-fluid">
                <div id="calendar_'.$this->getJqControlId().'"></div>
            </div>';

        $this->updateControl($html);
        $this->initJs();
    }
    public function createEvent($EventId = null,$Title = '',QDateTime $Start = null,QDateTime $End = null,$LabelColor = '',$TextColor = '') {
        if (!$EventId)
            return false;
        if ($Start) {
            $Start = $Start->format('Y-m-d H:i:s');
        } else
            $Start = '';

        if ($End) {
            $End = $End->format('Y-m-d H:i:s');
        } else
            $End = '';
        $theLabelstr = '';
        $theTextstr = '';
        if (strlen($LabelColor) > 0)
            $theLabelstr = 'color: \''.$LabelColor.'\',';
        if (strlen($TextColor) > 0)
            $theTextstr = 'textColor: \''.$TextColor.'\',';


        $js = '
        var source = {
                events: [
                    {
                        id:'.$EventId.',
                        title: \''.$Title.'\',
                        start: \''.$Start.'\',
                        end: \''.$End.'\'
                    }
                ],
                '.$theLabelstr.'
                '.$theTextstr.'
            };
        $(\'#calendar_'.$this->getJqControlId().'\').fullCalendar( \'addEventSource\', source );';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    public function getEvent($EventId = null) {
        if (!$EventId)
            return false;
        $js = 'var events = $(\'#calendar_'.$this->getJqControlId().'\').fullCalendar( \'clientEvents\', ['.$EventId.'] );
        events.forEach(function(item) {
           qc.pA(\''.$this->parentFormId.'\',\''.$this->clickCallBackFunction.'\', \'QClickEvent\', getFullCalendarEventJson(item,null,\'get\'));
            });';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    public function updateEvent($EventId = null,$Title = '',QDateTime $Start = null,QDateTime $End = null) {
        if (!$EventId)
            return false;
        if ($Start) {
            $Start = $Start->format('Y-m-d H:i:s');
        } else
            $Start = '';

        if ($End) {
            $End = $End->format('Y-m-d H:i:s');
        } else
            $End = '';

        $js = 'var events = $(\'#calendar_'.$this->getJqControlId().'\').fullCalendar( \'clientEvents\', ['.$EventId.'] );
        events.forEach(function(item) {
            modifyEvent(item,\''.$Title.'\',\''.$Start.'\',\''.$End.'\');
            $(\'#calendar_'.$this->getJqControlId().'\').fullCalendar( \'updateEvent\', item );
            });';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    public function removeEvent($EventId = null) {
        if (!$EventId)
            return false;

        $js = 'var events = $(\'#calendar_'.$this->getJqControlId().'\').fullCalendar( \'removeEvents\', ['.$EventId.'] );';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    protected function initJs() {
        $js = ' var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $(\'#calendar_'.$this->getJqControlId().'\').fullCalendar({
            eventClick: function(event, jsEvent, view) {
                qc.pA(\''.$this->parentFormId.'\',\''.$this->clickCallBackFunction.'\', \'QClickEvent\', getFullCalendarEventJson(event,null,\'click\'));
            },
            dayClick: function(date, jsEvent, view) {
                qc.pA(\''.$this->parentFormId.'\',\''.$this->clickCallBackFunction.'\', \'QClickEvent\', getFullCalendarEventJson(null,date.format(),\'new\'));
            },
            eventDragStop: function( event, jsEvent, ui, view ) { 
                qc.pA(\''.$this->parentFormId.'\',\''.$this->clickCallBackFunction.'\', \'QClickEvent\', getFullCalendarEventJson(event,null,\'drag\'));
            },
            eventResizeStop: function( event, jsEvent, ui, view ) { 
                qc.pA(\''.$this->parentFormId.'\',\''.$this->clickCallBackFunction.'\', \'QClickEvent\', getFullCalendarEventJson(event,null,\'resize\'));
            },
            businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                dow: [ 1, 2, 3, 4, 5 ], // Monday - Thursday
            
                start: \''.$this->BusinessHoursStart.'\', 
                end: \''.$this->BusinessHoursEnd.'\', 
            },
            weekNumbers:true,
            weekNumbersWithinDays:true,
            slotDuration: \'00:15:00\',';
        if (AppSpecificFunctions::GetDeviceType() != 'phone') {
            $js .= '
            header: {
                left: \'prev,next today\',
                center: \'title\',
                right: \'month,agendaWeek,agendaDay\'
            },
            footer: {
                left: \'\',
                center: \'\',
                right: \'\'
            },';
        } else {
            $js .= '
            height: $(window).height()-100,
            header: {
                left: \'prev,next\',
                center: \'\',
                right: \'month,agendaWeek,agendaDay\'
            },
            footer: {
                left: \'title\',
                center: \'\',
                right: \'today\'
            },';
        }
        $js .= '
            editable: true
        });';

        AppSpecificFunctions::ExecuteJavaScript($js);
    }


}
?>
