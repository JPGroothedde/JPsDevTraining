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
        $this->btnProcessNewPost->Text = "New Post";
        $this->btnProcessNewPost->CssClass = 'btn btn-primary rippleclick pull-right fullWidth mrg-bottom5';
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
                $html.= '<div class="panel-heading"><img style="width:50px;" src="'.$ProfilePictureSrc.'">'.$PostAccountFirstName. ' '.$PostAccountLastName;
                $html.= '<div class="row"><div class="col-md-12"><div class="small">'.$PostTimeStamp.'</div></div></div>';
                $html.= '</div>';
                $html.= '<div class="panel-body">';
                $html.= '<div class="row"><div class="col-md-12"><pre><p>'.$Post->PostText.'</p></pre></div></div>';
                $PostCommentArray = PostComment::QueryArray(QQ::Equal(QQN::PostComment()->PostObject->Id,$Post->Id));
                if ($PostCommentArray) {
                    $html.= '<div class="panel-group">';
                    $html.= '<div class="panel panel-default">';
                    $html.= '<div class="panel-heading">';
                    $html.= '<h4 class="panel-title">';
                    $html.= '<a data-toggle="collapse" href="#collapse'.$Post->Id.'">Comments</a>';
                    $html.= '</h4>';
                    $html.= '</div>';
                    $html.= '<div id="collapse'.$Post->Id.'" class="panel-collapse collapse">';
                    $html.= '<ul class="list-group">';
                    foreach ($PostCommentArray as $PostComment) {
                        $html .= '<li class="list-group-item"><div class="row"><div class="col-md-12"><pre><p>' . $PostComment->PostCommentText . '</p></pre></div></div></li>';
                    }
                    $html.= '</ul>';
                    $html.= '</div>';
                    $html.= '</div>';
                    $html.= '</div>';
                }
                $html.= '</div>';
                $html.= '<div class="panel-footer">';
                $html.= '<div class="row">';
                $LikeCount = PostLike::QueryCount(QQ::Equal(QQN::PostLike()->PostObject->Id,$Post->Id));
                if ($LikeCount) {
                    $LikeCountBadge = '<span class="badge">'.$LikeCount.'</span>';
                }else{
                    $LikeCountBadge = '';
                }
                $html.= '<div class="col-md-8"></div>';
                $html.= '<div class="col-md-2"><a href="#" id="PostLike_'.$Post->Id.'" role="button" class="LikePost btn btn-primary rippleclick pull-right fullWidth "><span class="glyphicon glyphicon-thumbs-up"></span> Like '.$LikeCountBadge.'</a></div>';
                $html.= '<div class="col-md-2"><a href="#" id="PostComment_'.$Post->Id.'" role="button" class="PostCommentBtn btn btn-default rippleclick pull-right fullWidth "><span class="glyphicon glyphicon-pencil"></span> Comment</a></div>';
                $html.= '</div>';
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
        $PostLikeObj = new PostLike();
        $PostLikeObj->PostObject = $PostObj;
        $PostLikeObj->AccountObject = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute());
        try {
            $PostLikeObj->Save();
        } catch(QCallerException $e) {

        }
        $this->loadPosts();
    }

	protected function initPostComments() {
        $this->PostCommentInputBox = new QTextBox($this);
        $this->PostCommentInputBox->TextMode = 'MultiLine';
        $this->PostCommentInputBox->Rows = 5;
        $this->PostCommentInputBox->Placeholder = "What's on your mind?";

        $this->btnPostNewComment = new QButton($this);
        $this->btnPostNewComment->Text = "Post Comment";
        $this->btnPostNewComment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnPostNewComment->AddAction(new QClickEvent(), new QAjaxAction("createNewPostComment"));

        $this->action_PostComment = new sUIElementsBase($this);
        $this->action_PostComment->AddAction(new QClickEvent(), new QAjaxAction('handleAction_PostComment'));

        $js_Action_PostComment = '$(document).on("click",".PostCommentBtn", function() {
            qc.pA(\''.$this->FormId.'\',\''.$this->action_PostComment->getControlId().'\', \'QClickEvent\', $(this).attr("id"));
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
		AppSpecificFunctions::ToggleModal('PostCommentModal');
	}
}
PostListForm::Run('PostListForm');

?>

