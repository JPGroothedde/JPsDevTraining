<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateController.php');
require(__SDEV_CONTROLS__.'/BaseControls/sSummernoteInstance.php');

if (!checkRole(array('Administrator'))) {
    AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}
class EmailTemplate_DetailForm extends QForm {
    // EmailTemplate Object variables
    protected $EmailTemplateInstance;
    protected $btnSaveEmailTemplate,$btnDeleteEmailTemplate,$btnCancelEmailTemplate;

    protected $html_ContentBlocks,$action_AddSection,$action_RemoveSection,$action_EditContent;
    protected $btnSaveContent,$currentContentBlockId = -1;

    protected $SummerNoteInstance;
    protected $btnPreviewTemplate,$html_Preview;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = EmailTemplate::Load($objId);
            if ($theObject) {
                $this->EmailTemplateInstance->setObject($theObject);
                $this->EmailTemplateInstance->setValues($theObject);
                $this->EmailTemplateInstance->refreshAll();
                $this->btnDeleteEmailTemplate->Visible = true;
            } else {
                $this->EmailTemplateInstance->setObject(null);
                $this->EmailTemplateInstance->setValues(null);
                $this->btnDeleteEmailTemplate->Visible = false;
            }
        } else {
            $this->EmailTemplateInstance->setObject(null);
            $this->EmailTemplateInstance->setValues(null);
            $this->btnDeleteEmailTemplate->Visible = false;
        }
        $this->updateContentRows();
    }
    protected function InitEmailTemplateInstance() {
        $this->EmailTemplateInstance = new EmailTemplateController($this);

        $this->btnSaveEmailTemplate = new QButton($this);
        $this->btnSaveEmailTemplate->Text = 'Save';
        $this->btnSaveEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplate_Clicked'));

        $this->btnDeleteEmailTemplate = new QButton($this);
        $this->btnDeleteEmailTemplate->Text = 'Delete';
        $this->btnDeleteEmailTemplate->CssClass = 'btn btn-danger';
        $this->btnDeleteEmailTemplate->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplate_Clicked'));

        $this->btnCancelEmailTemplate = new QButton($this);
        $this->btnCancelEmailTemplate->Text = 'Cancel';
        $this->btnCancelEmailTemplate->CssClass = 'btn btn-default';
        $this->btnCancelEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmailTemplate_Clicked'));

        $this->html_ContentBlocks = new sUIElementsBase($this);
        $this->action_AddSection = new sUIElementsBase($this);
        $this->action_AddSection->AddAction(new QClickEvent(), new QAjaxAction('handleAddSection'));
        $this->action_RemoveSection = new sUIElementsBase($this);
        $this->action_RemoveSection->AddAction(new QClickEvent(), new QAjaxAction('handleRemoveSection'));

        $this->action_EditContent = new sUIElementsBase($this);
        $this->action_EditContent->AddAction(new QClickEvent(), new QAjaxAction('handleEditContent'));

        $this->btnSaveContent = new QButton($this);
        $this->btnSaveContent->Text = 'Save';
        $this->btnSaveContent->AddAction(new QClickEvent(), new QAjaxAction('btnSaveContent_Clicked'));

        $this->btnPreviewTemplate = new QButton($this);
        $this->btnPreviewTemplate->Text = 'Preview';
        $this->btnPreviewTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnPreviewTemplate_Clicked'));
        $this->html_Preview = new sUIElementsBase($this);

        $this->SummerNoteInstance = new sSummernoteInstance($this,false,AppSpecificFunctions::getCurrentAccountAttribute(),true,400);
    }
    protected function btnSaveEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
    protected function updateContentRows() {
        $AllContentRows = EmailTemplateContentRow::QueryArray(QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplateObject->Id,$this->EmailTemplateInstance->getObjectId()),
            QQ::Clause(QQ::OrderBy(QQN::EmailTemplateContentRow()->RowOrder)));
        $html = '<table style="border:none;width:100%;">';
        $count = 0;
        foreach ($AllContentRows as $cr) {
            $html .= '<tr style="border:1px dotted #dadada;border-bottom:none;">';
            $html .= $this->getContentBlocks($cr);
            $html .= '</tr>';
            $html .= '<tr style="border:1px dotted #dadada;border-top:none;"><td colspan="2" style="padding:5px;">'.$this->getAddContentButtons($cr->Id).'</td></tr>';
            $count++;
        }
        if ($count == 0) {
            $html = '<div class="alert alert-info" role="alert">No content defined</div>
                        '.$this->getAddContentButtons();
        } else {
            $html .= '</table>';
        }
        $this->html_ContentBlocks->updateControl($html);
        $js = '
            $(".addContentBlockButton").on("click", function() {
                qc.pA(\''.$this->FormId.'\',\''.$this->action_AddSection->getJqControlId().'\', \'QClickEvent\', $(this).attr("id"));
            });
            $(".removeContentBlockButton").on("click", function() {
                qc.pA(\''.$this->FormId.'\',\''.$this->action_RemoveSection->getJqControlId().'\', \'QClickEvent\', $(this).attr("id"));
            });
            $(".editContentBlockButton").on("click", function() {
                qc.pA(\''.$this->FormId.'\',\''.$this->action_EditContent->getJqControlId().'\', \'QClickEvent\', $(this).attr("id"));
            });
            $(function () {
              $(\'[data-toggle="tooltip"]\').tooltip()
            })';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    protected function getContentBlocks(EmailTemplateContentRow $Row = null) {
        if (!$Row)
            return '';
        $returnHtml = '';
        $AllContentBlocks = EmailTemplateContentBlock::QueryArray(QQ::Equal(QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id,$Row->Id));
        $TheFullWidthBlock = '';
        $TheLeftBlock = '';
        $TheRightBlock = '';
        foreach ($AllContentBlocks as $cb) {
            if ($cb->Position == 'Left') {
                $TheLeftBlock = $cb->ContentBlock.'<div style="width:100%;text-align: center;"> 
                                <button id="Edit_'.$cb->Id.'" type="button" class="btn btn-link editContentBlockButton">
                                  <span>Edit</span>
                                </button>
                                </div>';
            } elseif ($cb->Position == 'Right') {
                $TheRightBlock = $cb->ContentBlock.'<div style="width:100%;text-align: center;"> 
                                <button id="Edit_'.$cb->Id.'" type="button" class="btn btn-link editContentBlockButton">
                                  <span>Edit</span>
                                </button>
                                </div>';
            } else {
                $TheFullWidthBlock = $cb->ContentBlock.'<div style="width:100%;text-align: center;"> 
                                <button id="Edit_'.$cb->Id.'" type="button" class="btn btn-link editContentBlockButton">
                                  <span>Edit</span>
                                </button>
                                </div>';
            }
        }
        if ($Row->Columns == 1) {
            $returnHtml .= '<td colspan="2" style="padding:5px;vertical-align: top;">'.$TheFullWidthBlock.'</td>';
        } else {
            $returnHtml .= '<td style="width:50%;padding:5px;border-right:1px dotted #dadada;vertical-align: top;">'.$TheLeftBlock.'</td><td style="width:50%;padding:5px;vertical-align: top;">'.$TheRightBlock.'</td>';
        }
        return $returnHtml;
    }
    protected function getAddContentButtons($RowId = '') {
        $html = '<div style="text-align: center; width:100%;">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Actions
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a id="AddFullWidthSection'.$RowId.'" class="addContentBlockButton">Add Full Width Section</a></li>
                          <li><a id="AddTwoColumnSection'.$RowId.'" class="addContentBlockButton">Add 2 Column Section</a></li>
                          <li><a id="Remove_'.$RowId.'"  class="removeContentBlockButton">Remove Section</a></li>
                        </ul>
                      </div>
            </div>';

        return $html;
    }
    protected function handleAddSection($strFormId, $strControlId, $strParameter) {
        if (!$this->EmailTemplateInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Could not save template. Please try again...',false);
            return;
        }
        $theObject = $this->EmailTemplateInstance->getObject();
        $CurrentRow = null;
        if (strpos($strParameter,'AddFullWidthSection') !== false) {
            $newRow = new EmailTemplateContentRow();
            $newRow->EmailTemplateObject = $this->EmailTemplateInstance->getObject();
            $newRow->Columns = 1;
            if (strlen($strParameter) > strlen('AddFullWidthSection')) {
                $TheRowId = substr($strParameter,strlen('AddFullWidthSection'));
                $CurrentRow = EmailTemplateContentRow::QuerySingle(QQ::Equal(QQN::EmailTemplateContentRow()->Id,$TheRowId));
            } else {
                if ($theObject) {
                    $CurrentRow = EmailTemplateContentRow::QuerySingle(QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplateObject->Id,$theObject->Id),QQ::Clause(QQ::OrderBy(QQN::EmailTemplateContentRow()->RowOrder)));
                }
            }
            if ($CurrentRow) {
                $newRow->RowOrder = $CurrentRow->RowOrder+1;
            } else {
                $newRow->RowOrder = 1;
            }
            try {
                $newRow->Save();
                $this->updateRowOrders($newRow,$this->EmailTemplateInstance->getObject());
                $newContentBlock = new EmailTemplateContentBlock();
                $newContentBlock->EmailTemplateContentRowObject = $newRow;
                $newContentBlock->Save();
            } catch (QCallerException $e) {
                AppSpecificFunctions::ShowNotedFeedback('Could not save template. Please try again...',false);
            }
        }

        if (strpos($strParameter,'AddTwoColumnSection') !== false) {
            $newRow = new EmailTemplateContentRow();
            $newRow->EmailTemplateObject = $this->EmailTemplateInstance->getObject();
            $newRow->Columns = 2;
            if (strlen($strParameter) > strlen('AddTwoColumnSection')) {
                $TheRowId = substr($strParameter,strlen('AddTwoColumnSection'));
                $CurrentRow = EmailTemplateContentRow::QuerySingle(QQ::Equal(QQN::EmailTemplateContentRow()->Id,$TheRowId));
            } else {
                if ($theObject) {
                    $CurrentRow = EmailTemplateContentRow::QuerySingle(QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplateObject->Id,$theObject->Id),QQ::Clause(QQ::OrderBy(QQN::EmailTemplateContentRow()->RowOrder)));
                }
            }
            if ($CurrentRow) {
                $newRow->RowOrder = $CurrentRow->RowOrder+1;
            } else {
                $newRow->RowOrder = 1;
            }
            try {
                $newRow->Save();
                $this->updateRowOrders($newRow,$this->EmailTemplateInstance->getObject());
                $newContentBlock = new EmailTemplateContentBlock();
                $newContentBlock->EmailTemplateContentRowObject = $newRow;
                $newContentBlock->Position = 'Left';
                $newContentBlock->Save();
                $newContentBlock = new EmailTemplateContentBlock();
                $newContentBlock->EmailTemplateContentRowObject = $newRow;
                $newContentBlock->Position = 'Right';
                $newContentBlock->Save();
            } catch (QCallerException $e) {
                AppSpecificFunctions::ShowNotedFeedback('Could not save template. Please try again...',false);
            }
        }

        $this->updateContentRows();
    }

    protected function updateRowOrders(EmailTemplateContentRow $CurrentRow = null, EmailTemplate $Template = null) {
        if (!$CurrentRow)
            return;
        if (!$Template)
            return;
        $MustUpdate = EmailTemplateContentRow::QueryCount(QQ::AndCondition(QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplateObject->Id,$Template->Id),
            QQ::Equal(QQN::EmailTemplateContentRow()->RowOrder,$CurrentRow->RowOrder),QQ::NotEqual(QQN::EmailTemplateContentRow()->Id,$CurrentRow->Id)));
        if ($MustUpdate > 0) {
            $AllOtherRows = EmailTemplateContentRow::QueryArray(QQ::AndCondition(QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplateObject->Id,$Template->Id),
                QQ::GreaterOrEqual(QQN::EmailTemplateContentRow()->RowOrder,$CurrentRow->RowOrder),QQ::NotEqual(QQN::EmailTemplateContentRow()->Id,$CurrentRow->Id)));
            foreach ($AllOtherRows as $row) {
                $row->RowOrder = $row->RowOrder+1;
                try {
                    $row->Save();
                } catch (QCallerException $e) {

                }
            }
        }
    }
    protected function handleRemoveSection($strFormId, $strControlId, $strParameter) {
        $TheRowId = substr($strParameter,7);
        $TheRow = EmailTemplateContentRow::Load($TheRowId);
        if ($TheRow) {
            $TheRow->Delete();
            $this->updateContentRows();
        } else {
            AppSpecificFunctions::ShowNotedFeedback('Could not remove content. Please try again...',false);
        }
    }
    protected function handleEditContent($strFormId, $strControlId, $strParameter) {
        $contentBlockId = substr($strParameter,5);
        $TheContentBlock = EmailTemplateContentBlock::Load($contentBlockId);
        if ($TheContentBlock) {
            $this->currentContentBlockId = $TheContentBlock->Id;
            AppSpecificFunctions::ToggleModal('contentModal');
            $this->SummerNoteInstance->setContent($TheContentBlock->ContentBlock);
            $this->SummerNoteInstance->showSummernoteInstance();
        }
    }
    protected function btnSaveContent_Clicked($strFormId, $strControlId, $strParameter) {
        $TheContentBlock = EmailTemplateContentBlock::Load($this->currentContentBlockId);
        if ($TheContentBlock) {
            $TheContentBlock->ContentBlock = $this->SummerNoteInstance->getContent();
            try {
                $TheContentBlock->Save();
                AppSpecificFunctions::ToggleModal('contentModal');
                $this->updateContentRows();
            } catch(QCallerException $e) {

            }
        }
    }

    protected function btnPreviewTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        $AllContentRows = EmailTemplateContentRow::QueryArray(QQ::Equal(QQN::EmailTemplateContentRow()->EmailTemplateObject->Id,$this->EmailTemplateInstance->getObjectId()),
            QQ::Clause(QQ::OrderBy(QQN::EmailTemplateContentRow()->RowOrder)));
        $html = '<table style="border:none;width:100%;">';
        foreach ($AllContentRows as $row) {
            $html .= '<tr>';
            if ($row->Columns == 1) {
                $theContentBlock = EmailTemplateContentBlock::QuerySingle(QQ::Equal(QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id,$row->Id));
                if ($theContentBlock) {
                    $html .= '<td colspan="2" style="padding:10px;vertical-align: top;">'.$theContentBlock->ContentBlock.'</td>';
                } else {
                    $html .= '<td colspan="2" style="text-align: center;">No Content</td>';
                }
            } else {
                $theContentBlockLeft = EmailTemplateContentBlock::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id,$row->Id),
                    QQ::Equal(QQN::EmailTemplateContentBlock()->Position,'Left')));
                if ($theContentBlockLeft) {
                    $html .= '<td style="width:50%;padding:10px;vertical-align: top;">'.$theContentBlockLeft->ContentBlock.'</td>';
                } else {
                    $html .= '<td style="width:50%;text-align: center;">No Content</td>';
                }
                $theContentBlockRight = EmailTemplateContentBlock::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id,$row->Id),
                    QQ::Equal(QQN::EmailTemplateContentBlock()->Position,'Right')));
                if ($theContentBlockRight) {
                    $html .= '<td style="width:50%;padding:10px;vertical-align: top;">'.$theContentBlockRight->ContentBlock.'</td>';
                } else {
                    $html .= '<td style="width:50%;text-align: center;">No Content</td>';
                }
            }
            $html .= '</tr>';
        }
        AppSpecificFunctions::ToggleModal('previewModal');
        $this->html_Preview->updateControl($html);
    }
	protected function btnPublished_Clicked($strFormId, $strControlId, $strParameter) {
		$this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->Toggle(!$this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->IsToggled);
	}
}
EmailTemplate_DetailForm::Run('EmailTemplate_DetailForm');
?>