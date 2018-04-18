<?php
require_once(__SDEV_ORM__.'/Generated/EmailTemplate/EmailTemplateController_Base.php');

class EmailTemplateController extends EmailTemplateController_Base {
    public function __construct($objParentObject,$InitObject = null) {
        parent::__construct($objParentObject,$InitObject);
        $this->btnPublished->CssClass = 'btn btn-link mrg-top10 fullWidth';
    }
};
?>