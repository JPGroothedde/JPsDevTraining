<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

class IndexForm extends QForm {
    protected $txtInputBox;
    protected $btnProcessInput;
    protected $Result;
	public function Form_Create() {
		parent::Form_Create();
		//Create input box
		$this->txtInputBox = new QTextBox($this);
		$this->txtInputBox->Name = "Course Name";
		// This creates the output received from queryDataBase function to the screen
        $this->Result = new sUIElementsBase($this);
        //Create Button
        try {
            $this->btnProcessInput = new QButton($this);
        } catch (QCallerException $e) {

        }
        $this->btnProcessInput->Text = "Search Course";
        try {
            $this->btnProcessInput->AddAction(new QClickEvent(), new QAjaxAction("queryDataBase"));
        } catch (QCallerException $e) {

        }
	}
	protected function queryDataBase() {
        try {
            $CourseArray = Course::QueryArray(
                QQ::AndCondition(
                    QQ::Like(QQN::Course()->CourseName, '%' . $this->txtInputBox->Text . '%')
                )
            );
        } catch (QCallerException $e) {

        }
        if ($CourseArray) {
	        $html = '<table class="table table-bordered table-striped">';
	        $html.= '<thead>';
	        $html.= '<tr>';
	        $html.= '<th scope="col">ID</th>';
	        $html.= '<th scope="col">Course Name</th>';
	        $html.= '<th scope="col">Course Price</th>';
	        $html.= '</tr>';
	        $html.= '</thead>';
	        $html.= '<tbody>';
	        foreach($CourseArray AS $Course) {
		        $html.= '<tr><td> '.$Course->Id.' </td><td>'.$Course->CourseName.'</td><td>'.$Course->CoursePrice.'</td></tr>';
		        //AppSpecificFunctions::AddCustomLog($Course->getJson());
	        }
	        $this->Result->updateControl($html);
	        $html.= '</tbody></table>';
        } else {
        	AppSpecificFunctions::DisplayAlert('No courses found.');
        }
        
        return $html;
    }
}

IndexForm::Run('IndexForm');
?>