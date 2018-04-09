<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

class IndexForm extends QForm {
    protected $txtInputBox;
    protected $btnProcessInput;
    protected $html_Result;
	public function Form_Create() {
		parent::Form_Create();
		//Create input box
		$this->txtInputBox = new QTextBox($this);
		$this->txtInputBox->Name = "Course Name";
		// This creates the output received from queryDataBase function to the screen
        $this->html_Result = new sUIElementsBase($this);
        //Create Button
        try {
            $this->btnProcessInput = new QButton($this);
        } catch (QCallerException $e) {

        }
        $this->btnProcessInput->Text = "Search Course";
        try {
            $this->btnProcessInput->AddAction(new QClickEvent(), new QAjaxAction("handleProcessInput"));
        } catch (QCallerException $e) {

        }
        
        //AppSpecificFunctions::DisplayAlert(AppSpecificFunctions::PathInfo(0));
	}
	protected function handleProcessInput($strFormId,$strControlId,$strParameter) {
		$html = '';
        try {
            $CourseArray = Course::QueryArray(
                QQ::Like(QQN::Course()->Name, '%' . $this->txtInputBox->Text . '%')
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
		        $html.= '<tr class="NoPointer"><td> '.$Course->Id.' </td><td>'.$Course->Name.'</td><td>'.$Course->Price.'</td></tr>';
		        //AppSpecificFunctions::AddCustomLog($Course->getJson());
	        }
	        $html.= '</tbody></table>';
	       
        } else {
            $html = '<div class="alert alert-danger" role="alert"><strong>Oops! </strong> No courses found...</div>';
        }
		$this->html_Result->updateControl($html);
    }
}

IndexForm::Run('IndexForm');
?>