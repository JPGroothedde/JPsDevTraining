<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

if (!checkRole(array('User')))
    AppSpecificFunctions::Redirect(__USRMNG__.'/login/');

class PostListForm extends QForm {
	protected $NewPostInputBox;
	protected $PostCommentInputBox;
	protected $btnProcessNewPost;
	protected $HtmlResults;
	protected $action_LikePost;
	protected $action_PostComment;
	protected $btnPostNewComment;
	protected $PostId;
	protected $CurrentPostListOffset = 0;
	protected $TotalPostArray = array();
	protected $action_HandlePageRequest;
	protected $LastLoadCheckTime = null;
	protected $PostCommentInput;

    public function Form_Create() {
        parent::Form_Create();

        $this->initPostList();
        $this->initPostLikes();
        $this->initPostComments();
    }

    protected function initPostList() {
        $this->NewPostInputBox = new QTextBox($this);
        $this->NewPostInputBox->TextMode = 'MultiLine';
        $this->NewPostInputBox->Rows = 5;
        $this->NewPostInputBox->Placeholder = "What's on your mind?";

        $this->btnProcessNewPost = new QButton($this);
        $this->btnProcessNewPost->Text = "Post";
        $this->btnProcessNewPost->CssClass = 'btn btn-primary rippleclick pull-right mrg-bottom5';
        $this->btnProcessNewPost->AddAction(new QClickEvent(), new QAjaxAction("createNewPost"));

        $this->HtmlResults = new sUIElementsBase($this);

        $this->action_HandlePageRequest = new sUIElementsBase($this);
        $this->action_HandlePageRequest->AddAction(new QClickEvent(),new QAjaxAction('handleCustomPageRequest'));
        $this->loadPosts();
	}
	protected function handleCustomPageRequest($strFormId,$strControlId,$strParameter) {
        if ($strParameter == 'loadmore')
		    $this->loadPosts(true);
        elseif ($strParameter == 'checknewposts') {
            if (!is_null($this->LastLoadCheckTime)) {
                $NewPostCount = Post::QueryCount(QQ::GreaterThan(QQN::Post()->PostTimeStamp,$this->LastLoadCheckTime));
                if ($NewPostCount != 0) {
                    $js = '$("#ReloadLink").show();';
                    AppSpecificFunctions::ExecuteJavaScript($js);
                }
            }
        }
	}
    protected function loadPosts($blnLoadMore = false) {
        $this->LastLoadCheckTime = QDateTime::Now();
        $PostLimit = 3;
        if ($blnLoadMore) {
        	$this->CurrentPostListOffset += $PostLimit;
		}
        $html = '';
        $PostArray = Post::QueryArray(QQ::All(),
            QQ::Clause(
                QQ::OrderBy(QQN::Post()->Id,false),
                QQ::LimitInfo($PostLimit,$this->CurrentPostListOffset)
            )
        );

        if ($blnLoadMore) {
            $this->TotalPostArray = array_merge($this->TotalPostArray,$PostArray);
		} else {
        	if (sizeof($this->TotalPostArray) == 0)
        		$this->TotalPostArray = $PostArray;
		}

        if ($this->TotalPostArray) {
            foreach($this->TotalPostArray AS $Post) {
            	$PostAccountId = -1;
            	$PostAccountFirstName = '';
            	$PostAccountLastName = '';
            	$PostTimeStamp = 'Some time in the past...';
            	if ($Post->AccountObject) {
                    $PostAccountId = $Post->AccountObject->Id;
                    $PostAccountFirstName = $Post->AccountObject->FirstName;
                    $PostAccountLastName = $Post->AccountObject->LastName;
				}
				if ($Post->PostTimeStamp)
					$PostTimeStamp = $Post->PostTimeStamp->format(DATE_TIME_FORMAT_HTML.' H:i:s');

                $ProfilePictureObj = ProfilePicture::QuerySingle(QQ::Equal(
                    QQN::ProfilePicture()->AccountObject->Id,$PostAccountId),
                    QQ::Clause(
                        QQ::OrderBy(QQN::ProfilePicture()->Id,false)
                    ));
                $ProfilePictureSrc = __APP_IMAGE_ASSETS__.'/image_not_available.jpg';
                if ($ProfilePictureObj) {
					$ProfilePictureSrc = $ProfilePictureObj->ProfilePicturePath;
					$ProfilePictureSrcExplode = explode('/',$ProfilePictureSrc);
					$ProfilePictureSrc = '../'.$ProfilePictureSrcExplode[3].'/'.$ProfilePictureSrcExplode[4];
                }
                $html.= '<div class="PostId panel panel-primary" id="Post_'.$Post->Id.'">';
                $html.= '<div class="panel-heading"><img class="img-circle" style="width:30px; height: 30px;" src="'.$ProfilePictureSrc.'"> '.$PostAccountFirstName. ' '.$PostAccountLastName.' <span class="JpSeTimestamp">'.$PostTimeStamp.'</span>';
                $html.= '</div>';
                $html.= '<div class="panel-body" style="padding: 0 15px;">';
                $html.= '<div class="row"><div class="col-md-12"><p>'.$Post->PostText.'</p></div></div>';
	            $html.= '<div class="row">';
	            $LikeCount = PostLike::QueryCount(QQ::Equal(QQN::PostLike()->PostObject->Id,$Post->Id));
	            if ($LikeCount) {
		            $LikeCountBadge = '<span class="badge">'.$LikeCount.'</span>';
	            } else {
		            $LikeCountBadge = '';
	            }
	            $html.= '<div class="col-md-11"></div>';
	            $html.= '<div class="col-md-1"><button type="button" id="PostLike_'.$Post->Id.'" role="button" class="LikePost btn btn-primary rippleclick pull-right "><span class="glyphicon glyphicon-thumbs-up"></span> '.$LikeCountBadge.'</button></div>';
	            $html.= '</div>';
	            $html.= '<div style="padding-top: 10px;">';
	            $html.= '<div class="input-group">';
	            $html.= '<input type="text" id="PostCommentInputBox_'.$Post->Id.'" name="PostCommentInputBox" class="form-control" style="padding:10px;" placeholder="Write a comment.... "/>';
	            $html.= '<span class="input-group-btn">';
	            $html.= '<button type="button" id="PostComment_'.$Post->Id.'" role="button" class="PostCommentBtn btn btn-default rippleclick pull-right "><span class="glyphicon glyphicon-send"></span></button>';
	            $html.= '</span>';
	            
	            $html.= '</div>';
	            $html.= '</div>';
                $PostCommentArray = PostComment::QueryArray(QQ::Equal(QQN::PostComment()->PostObject->Id,$Post->Id));
                
                if ($PostCommentArray) {
                    $html.= '<div class="panel-heading">';
                    $html.= '<a class="pull-right" style="text-decoration:none; color:#949494;" data-toggle="collapse" href="#collapse'.$Post->Id.'">Comments <span class="glyphicon glyphicon-arrow-down"></span> </a>';
                    $html.= '</div>';
                    $html.= '<div id="collapse'.$Post->Id.'" class="panel-collapse collapse">';
                    $html.= '<ul class="list-group">';
                    foreach ($PostCommentArray as $PostComment) {
	                    if ($PostComment->AccountObject) {
		                    $PostCommentAccountId = $PostComment->AccountObject->Id;
		                    $PostCommentAccountFirstName = $PostComment->AccountObject->FirstName;
		                    $PostCommentAccountLastName = $PostComment->AccountObject->LastName;
	                    }
	                    if ($PostComment->PostTimeStamp)
		                    $PostCommentTimeStamp = $PostComment->PostTimeStamp->format(DATE_TIME_FORMAT_HTML.' H:i:s');
	                    else
	                    	$PostCommentTimeStamp = 'Sometime in the past...';
                    	$PostCommentProfilePictureObj = ProfilePicture::QuerySingle(QQ::Equal(
                    		QQN::ProfilePicture()->AccountObject->Id,$PostComment->AccountObject->Id),
	                        QQ::Clause(
	                        	QQ::OrderBy(QQN::ProfilePicture()->Id,false)
	                        )
	                    );
                    	$PostCommentProfilePictureSrc = __APP_IMAGE_ASSETS__.'/image_not_available.jpg';
                    	if ($PostCommentProfilePictureObj) {
                    		$PostCommentProfilePictureSrc = $PostCommentProfilePictureObj->ProfilePicturePath;
                    		$PostCommentProfilePictureSrcExplode = explode('/', $PostCommentProfilePictureSrc);
                    		$PostCommentProfilePictureSrc = '../'.$PostCommentProfilePictureSrcExplode[3].'/'.$PostCommentProfilePictureSrcExplode[4];
	                    }
                        $html.= '<li class="list-group-item">';
                    	$html.= '<img class="img-circle" style="width:30px; height: 30px;" src="'.$PostCommentProfilePictureSrc.'"> '.$PostCommentAccountFirstName. ' '.$PostCommentAccountLastName.' <span class="JpSeTimestamp">'.$PostCommentTimeStamp.'</span>';
                    	$html.= '<div class="row"><div class="col-md-12"><p>' . $PostComment->PostCommentText . '</p></div></div>';
                    	$html.= '</li>';
                    }
                    $html.= '</ul>';
                    $html.= '</div>';
                }
                
                
                
                $html.= '<div class="panel-footer"></div>';
                $html.= '</div>';
                $html.= '</div>';
            }
        } else {
            $html = '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> No posts found....</div>';
        }
        $this->HtmlResults->updateControl($html);
    }
    protected function createNewPost($strFormId,$strControlId,$strParameter) {
        $Validate = AppSpecificFunctions::validateFieldAsRequired($this->NewPostInputBox);
        if ($Validate!='') {
            $PostObj = new Post();
            $PostObj->PostText = $this->NewPostInputBox->Text;
            $PostObj->PostTimeStamp = QDateTime::Now(true);
            $PostObj->AccountObject = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute());
            try {
                $PostObj->Save();
            } catch(QCallerException $e) {

            }
            $js = 'location.reload();';
            AppSpecificFunctions::ExecuteJavaScript($js);
        }
    }

	protected function initPostLikes() {
        $this->action_LikePost = new sUIElementsBase($this);
        $this->action_LikePost->AddAction(new QClickEvent(), new QAjaxAction('handleAction_LikePost'));

        $js_Action_LikePost = '$(document).on("click",".LikePost", function() {
            qc.pA(\''.$this->FormId.'\',\''.$this->action_LikePost->getControlId().'\', \'QClickEvent\', $(this).attr("id"));
        });
        var style = document.createElement(\'style\');
        style.type = \'text/css\';
        style.innerHTML = \'.LikePost:hover{cursor:pointer;}\';
        document.getElementsByTagName(\'head\')[0].appendChild(style);';
        AppSpecificFunctions::ExecuteJavaScript($js_Action_LikePost);
	}
    protected function handleAction_LikePost($strFormId, $strControlId, $strParameter) {
        $ParameterArray = explode('_',$strParameter);
        if (sizeof($ParameterArray) < 2) {
            AppSpecificFunctions::ShowNotedFeedback("Something weird happened here... Oops",false);
            return;
        }
        $PostObj = Post::Load($ParameterArray[1]);
        if (is_null($PostObj)) {
            AppSpecificFunctions::ShowNotedFeedback("Something weird happened here... Oops",false);
            return;
        }
        $checkIfPostIsLiked = PostLike::QuerySingle(
        	                    QQ::AndCondition(
						            QQ::Equal(QQN::PostLike()->AccountObject->Id,AppSpecificFunctions::getCurrentAccountAttribute()),
							        QQ::Equal(QQN::PostLike()->PostObject->Id,$ParameterArray[1]))
                                );
        if ($checkIfPostIsLiked) {
	        try {
		        $checkIfPostIsLiked->Delete();
	        } catch(QUndefinedPrimaryKeyException $e) {
	        
	        }
	        //$js = '$("#'.$strParameter.'").reload();';
	        //AppSpecificFunctions::ExecuteJavaScript($js);
        } else {
	        $PostLikeObj = new PostLike();
	        $PostLikeObj->PostObject = $PostObj;
	        $PostLikeObj->AccountObject = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute());
	        try {
		        $PostLikeObj->Save();
	        } catch(QCallerException $e) {
		
	        }
        }
	    $this->loadPosts();
    }

	protected function initPostComments() {
        $this->PostCommentInputBox = new QTextBox($this);
        $this->PostCommentInputBox->TextMode = 'MultiLine';
        $this->PostCommentInputBox->Rows = 5;
        $this->PostCommentInputBox->Placeholder = "What's on your mind?";

        $this->btnPostNewComment = new QButton($this);
        $this->btnPostNewComment->Text = "Post";
        $this->btnPostNewComment->CssClass = 'btn btn-primary rippleclick mrg-top10 fullWidth';
        $this->btnPostNewComment->AddAction(new QClickEvent(), new QAjaxAction("createNewPostComment"));

        $this->action_PostComment = new sUIElementsBase($this);
        $this->action_PostComment->AddAction(new QClickEvent(), new QAjaxAction('handleAction_PostComment'));

        $js_Action_PostComment = '$(document).on("click",".PostCommentBtn", function() {
            var BtnId = $(this).attr("Id").split("_");
            var InputText = BtnId[1]+"_"+$("#PostCommentInputBox_"+BtnId[1]).val();
            qc.pA(\''.$this->FormId.'\',\''.$this->action_PostComment->getControlId().'\', \'QClickEvent\', InputText);
        });
        var style = document.createElement(\'style\');
        style.type = \'text/css\';
        style.innerHTML = \'.PostCommentBtn:hover{cursor:pointer;}\';
        document.getElementsByTagName(\'head\')[0].appendChild(style);';
        AppSpecificFunctions::ExecuteJavaScript($js_Action_PostComment);
	}
	protected function createNewPostComment($strFormId,$strControlId,$strParameter) {
    	if (!AppSpecificFunctions::validateFieldAsRequired($this->PostCommentInputBox)) {
    		return;
		}
    	
		$PostCommentObj = new PostComment();
		$PostCommentObj->PostCommentText = $this->PostCommentInputBox->Text;
		$PostCommentObj->AccountObject = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute());
		$PostCommentObj->PostObject = Post::Load($this->PostId);
		try {
			$PostCommentObj->Save();
			AppSpecificFunctions::ShowNotedFeedback('New comment created.');
		} catch(QCallerException $e) {
		
		}
		AppSpecificFunctions::ToggleModal('PostCommentModal');
		$this->PostCommentInputBox->Text = '';
		$this->loadPosts();
	}
	protected function handleAction_PostComment($strFormId, $strControlId, $strParameter) {
    	$CommentInput = explode('_', $strParameter);
    	if (sizeof($CommentInput) != 2) {
		    AppSpecificFunctions::ShowNotedFeedback('Something weird happened ... Oops',false);
		    return;
	    }
    	if (!$this->doManualCrossSiteScriptPrevention($CommentInput[1])) {
    		AppSpecificFunctions::ShowNotedFeedback("That comment was not valid you poepol",false);
    		return;
	    }
    	
	    $PostObj = Post::Load($CommentInput[0]);
		if (is_null($PostObj)) {
			AppSpecificFunctions::ShowNotedFeedback("Something weird happened here... Oops",false);
			return;
		}
		$PostCommentObj = new PostComment();
		$PostCommentObj->PostCommentText = $CommentInput[1];
		$PostCommentObj->AccountObject = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute());
		$PostCommentObj->PostTimeStamp = QDateTime::Now(true);
		$PostCommentObj->PostObject = $PostObj;
		try {
			$PostCommentObj->Save();
			AppSpecificFunctions::ShowNotedFeedback('New comment created.');
		} catch(QCallerException $e) {
		
		}
		$this->loadPosts();
    	/*
        $ParameterArray = explode('_',$strParameter);
        if (sizeof($ParameterArray) < 2) {
            AppSpecificFunctions::ShowNotedFeedback("Something weird happened here... Oops",false);
            return;
        }
        $PostObj = Post::Load($ParameterArray[1]);
        if (is_null($PostObj)) {
            AppSpecificFunctions::ShowNotedFeedback("Something weird happened here... Oops",false);
            return;
        }
        $this->PostId = $PostObj->Id;
		AppSpecificFunctions::ToggleModal('PostCommentModal');*/
	}
	
	protected function doManualCrossSiteScriptPrevention($strText) {
		$strText = mb_strtolower($strText, QApplication::$EncodingType);
		if ((mb_strpos($strText, '<script', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<applet', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<embed', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<style', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<link', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<body', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<iframe', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, 'javascript:', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onfocus=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onblur=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onkeydown=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onkeyup=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onkeypress=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onmousedown=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onmouseup=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onmouseover=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onmouseout=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onmousemove=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, ' onclick=', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, '<object', 0, QApplication::$EncodingType) !== false) ||
			(mb_strpos($strText, 'background:url', 0, QApplication::$EncodingType) !== false))
			return false;
		return true;
	}
}
PostListForm::Run('PostListForm');

?>

