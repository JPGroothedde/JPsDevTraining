<?php
require_once(__SDEV_ORM__.'/Generated/ApiKey/ApiKeyController_Base.php');

class ApiKeyController extends ApiKeyController_Base {
    public function __construct($objParentObject,$InitObject = null) {
        parent::__construct($objParentObject,$InitObject);
    }
    public function validateObject()  {
        $hasNoErrors = true;
        $this->resetValidation();
        // Example of validating a field as required
        if (!(strlen($this->txtApiKey->Text) > 0)){
            $this->txtApiKey->WrapperCssClass = 'form-group has-error';
            $this->txtApiKey->Placeholder = 'Api Key is required.';
            $this->txtApiKey->Text = '';
            $this->txtApiKey->Blink();
            $this->txtApiKey->Refresh();
            $this->txtApiKey->Focus();
            $hasNoErrors = false;
        } else {
            $existingApiKey = ApiKey::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::ApiKey()->ApiKey,$this->txtApiKey->Text),QQ::NotEqual(QQN::ApiKey()->Id,$this->getObjectId())));
            if ($existingApiKey) {
                $this->txtApiKey->WrapperCssClass = 'form-group has-error';
                $this->txtApiKey->Placeholder = 'Api Key exists.';
                $this->txtApiKey->Text = '';
                $this->txtApiKey->Blink();
                $this->txtApiKey->Refresh();
                $this->txtApiKey->Focus();
                $hasNoErrors = false;
            }
        }
        // Example of validating a field as required
        /*if (!$this->lstStatus->SelectedValue){
            $this->lstStatus->WrapperCssClass = 'form-group has-error';
            $this->lstStatus->Blink();
            $this->lstStatus->Refresh();
            $this->lstStatus->Focus();
            $hasNoErrors = false;
        }*/
        // Example of validating an email address
        /*if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $this->txtApiKeyFIELD-->Text)){
            $this->txtApiKeyFIELD->WrapperCssClass = 'form-group has-error';
            $this->txtApiKeyFIELD->Placeholder = 'Invalid Email.';
            $this->txtApiKeyFIELD->Text = '';
            $this->txtApiKeyFIELD->Blink();
            $this->txtApiKeyFIELD->Refresh();
            $this->txtApiKeyFIELD->Focus();
            $hasNoErrors = false;
        };*/
        return $hasNoErrors;
    }
};
?>