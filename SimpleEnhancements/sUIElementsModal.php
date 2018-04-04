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
class sUIElementsModal extends sUIElementsBase {
    protected $ModalName,$ModalTitle,$ModalSize,$ShowHeader,$ShowFooter,$ShowCancelButton;
    protected $ModalBodyHtml,$ModalFooterHtml;
    public function __construct($objParentObject, $strControlId = null,$ModalName = 'New Modal',$ModalTitle = 'New Modal',$ModalSize = modalSize::_default,$ShowHeader = true,$ShowFooter = true,$ShowCancelButton = true) {
        parent::__construct($objParentObject, $strControlId);
        $this->ModalName = $ModalName;
        $this->ModalTitle = $ModalTitle;
        $this->ModalSize = $ModalSize;
        $this->ShowHeader = $ShowHeader;
        $this->ShowFooter = $ShowFooter;
        $this->ShowCancelButton = $ShowCancelButton;
        $this->ModalBodyHtml = '';
        $this->ModalFooterHtml = '';
    }
    public function AddChildControl(QControl $objControl) {
        array_push($this->childControls,$objControl);
    }

    public function RefreshChildren() {
        foreach ($this->childControls as $ctl) {
            $ctl->Refresh();
        }
    }
    public function setModalBodyContent($html) {
        $this->ModalBodyHtml = $html;
    }
    public function setModalFooterContent($html) {
        $this->ModalFooterHtml = $html;
    }
    public function updateUI() {
        $html = '<div id="'.$this->getJqControlId().'_'.$this->convertSpacesToUnderscores($this->ModalName).'Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="'.$this->getJqControlId().'_'.$this->convertSpacesToUnderscores($this->ModalName).'ModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog '.$this->ModalSize.'">
                        <div class="modal-content">
                            '.$this->getModalHeader().'
                            <div class="modal-body">
                                '.$this->ModalBodyHtml.'
                            </div>
                            '.$this->getModalFooter().'
                        </div>
                    </div>
                </div>';
        $this->updateControl($html);
    }
    protected function getModalHeader() {
        if ($this->ShowHeader) {
            $html = '<div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="'.$this->getJqControlId().'_'.$this->convertSpacesToUnderscores($this->ModalName).'ModalLabel">'.$this->ModalTitle.'</h4>
                    </div>';
            return $html;
        } else {
            $html = '<div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" style="margin-top: -10px;"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>';
            return $html;
        }
        return '';
    }
    protected function getModalFooter() {
        if ($this->ShowFooter) {
            $html = '<div class="modal-footer">
                         '.$this->ModalFooterHtml;
            if ($this->ShowCancelButton) {
                $html .= '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            }
            $html .= '</div>';
            return $html;
        }
        return '';
    }
    public function ToggleModal() {
        QApplication::ToggleModal($this->getJqControlId().'_'.$this->convertSpacesToUnderscores($this->ModalName).'Modal');
    }

}
abstract class modalSize {
    const _default = '';
    const large = 'modal-lg';
    const small = 'modal-sm';
}
?>
