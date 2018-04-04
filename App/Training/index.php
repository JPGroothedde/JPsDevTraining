<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

class IndexForm extends QForm {
	public function Form_Create() {
		parent::Form_Create();
		
		//AppSpecificFunctions::DisplayAlert("This is an alert");
		//AppSpecificFunctions::ExecuteJavaScript("console.log('Tst')");


		for($i=0;$i<10;$i++){
            $FirstName = AppSpecificFunctions::generateRandomString(5);
            $LastName   = AppSpecificFunctions::generateRandomString(5);
            $AccountObj = new Account();
            $AccountObj->FirstName = $FirstName;
            $AccountObj->LastName   = $LastName;
            try{
                //$AccountObj->Save();
            } catch (QCallerException $e){

            }
            //AppSpecificFunctions::AddCustomLog($AccountObj->getJson());
        }
        $AccountCount = Account::QueryCount(QQ::All());
        for($i=0;$i<$AccountCount;$i++) {
            $PostText = AppSpecificFunctions::generateRandomString(20);
            $PostObj = new Post();
            $PostObj->PostText = $PostText;
            $AccountToAssign = Account::Load($i);
            $PostObj->AccountObject = $AccountToAssign;
		    try{
                //$PostObj->Save();
            } catch (QCallerException $e){

            }
            //AppSpecificFunctions::AddCustomLog($PostObj->getJson());
		}
        $PostCount = Post::QueryCount(QQ::All());
        for ($i=0;$i<$PostCount;$i++){
            $CommentText = AppSpecificFunctions::generateRandomString(20);
            $CommentObj = new Comment();
            $CommentObj-> CommentText = $CommentText;
            $AccountToAssign = Account::Load($i-1);
            $PostToAssign   = Post::Load($i-1);
            $CommentObj->AccountObject = $AccountToAssign;
            $CommentObj->PostObject = $PostToAssign;
            try{
                //$CommentObj->Save();
            } catch(QCallerException $e) {

            }
            //AppSpecificFunctions::AddCustomLog($CommentObj->getJson());
        }
        for($i=0;$i<$PostCount;$i++) {
            $PostLike = new PostLike();
            $AccountToAssign = Account::Load($i-1);
            $PostToAssign = Post::Load($i-2);
            $PostLike->AccountObject = $AccountToAssign;
            $PostLike->PostObject = $PostToAssign;
            try {
                //$PostLike->Save();
            } catch (QCallerException $e) {

            }
            //AppSpecificFunctions::AddCustomLog($PostLike->getJson());
        }
        $PostArray = Post::QueryArray(QQ::Equal(QQN::Post()->AccountObject->FirstName,'uC0DL'));
        foreach ($PostArray as $Item) {
            AppSpecificFunctions::AddCustomLog("uC0DL Posts from the db:" . $Item->getJson());
        }
        $PostCount = Post::QueryCount(QQ::Equal(QQN::Post()->AccountObject->FirstName,'uC0DL'));
        AppSpecificFunctions::DisplayAlert("Total Posts By uC0DL: $PostCount");

        $PostArray = Post::QueryArray(QQ::Equal(QQN::Post()->AccountObject->LastName,'Pghea'));
        foreach ($PostArray as $Post) {
            $CommentArray = Comment::QueryArray(
                QQ::Equal(QQN::Comment()->PostObject->Id,$Post->Id));
            AppSpecificFunctions::AddCustomLog("Comments for post $Post->Id");
            foreach ($CommentArray as $Comment) {
                AppSpecificFunctions::AddCustomLog("Comment:" . $Comment->getJson());
            }
        }
	}
}

IndexForm::Run('IndexForm');
?>