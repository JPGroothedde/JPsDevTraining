<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

class IndexForm extends QForm {
	public function Form_Create() {
		parent::Form_Create();
		
		
		
	}
}

IndexForm::Run('IndexForm');
?>