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

class sSummernoteInstance {
    /**
     * @var
     */
    protected $parentFormId;
    /**
     * @var
     */
    /**
     * @var int
     */
    /**
     * @var int|string
     */
    protected $SummernoteObject,$SummernoteObjectId,$parameterString;
    /**
     * @var string
     */
    protected $fileName;
    /**
     * @var simpleHTML
     */
    /**
     * @var simpleHTML|string
     */
    protected $sh_SummernoteIframe;
    /**
     * @var bool
     */
    protected $clickToEdit = false;

    protected $isBasic = false;

    protected $FixedHeight;

    /**
     * @param $objParentObject The parent QForm that will render the editor
     * @param null $height The height of the editor
     * @param bool $clickToEdit Defines whether the user should click to edit
     * @param string $AuthorId_Prefix Defines an Author ID prefix to store in the DB
     */
    public function __construct($objParentObject,$clickToEdit = false,$AuthorId_Prefix = '',$isBasic = false,$FixedHeight = null) {
        ini_set('post_max_size', '500M');
        ini_set('upload_max_filesize', '500M');
        $this->parentFormId = $objParentObject->FormId;
        $currentUserId = AppSpecificFunctions::getCurrentAccountAttribute();
        $this->SummernoteObjectId = $this->getSummernoteObjectId($AuthorId_Prefix.$currentUserId);
        if (!$this->SummernoteObjectId)
            $this->SummernoteObjectId = -1;
        $this->fileName = 'content_'.$this->SummernoteObjectId.'.txt';
        $this->clickToEdit = $clickToEdit;
        $this->isBasic = $isBasic;
        $this->FixedHeight = $FixedHeight;
        $this->sh_SummernoteIframe = new simpleHTML($objParentObject);
        return;
    }

    /**
     * @throws Exception
     * @throws QCallerException
     */
    public function renderSummernoteInstance($printOutput = true) {
        return $this->sh_SummernoteIframe->Render($printOutput);
    }

    /**
     *
     */
    public function hideSummernoteInstance() {
        $this->sh_SummernoteIframe->Visible = false;
        $this->sh_SummernoteIframe->Refresh();
    }

    /**
     *
     */
    public function showSummernoteInstance($ContainerId = null) {
        $this->sh_SummernoteIframe->Visible = true;
        $this->sh_SummernoteIframe->Refresh();
        $this->FitToContainer($ContainerId);
    }

    /**
     * @param $html
     */
    public function setContent($html) {
        $this->setContentInDB($html);
        //$this->FitToContainer();
    }

    public function FitToContainer($ContainerId = null) {
        $click = $this->clickToEdit ? '1':'0';
        $basic = $this->isBasic ? '1':'0';
        $height = '';
        if ($this->FixedHeight) {
            $height = '&height='.$this->FixedHeight;
        }
        $this->parameterString = '?sn_id='.$this->SummernoteObjectId.'&click='.$click.$height.'&basic='.$basic;

        $html = '<div style="width:100%;height:'.$this->FixedHeight.'px;border:none;" class="ExternalEmbedFrame">
    					<iframe id="'.$this->sh_SummernoteIframe->getJqControlId().'_iframe" style="border:none;width:100%;height:95%;" scrolling="yes"
                src="'.__SUBDIRECTORY__.'/sDevControls/BaseControls/Summernote/nativestyle.php'.$this->parameterString.'"></iframe>
					</div>';
        $this->sh_SummernoteIframe->updateControl($html);

        if ($ContainerId) {
            $js = '
			var EmbedPosition = $(\'.ExternalEmbedFrame\').position();
			var EmbedTotalHeight = $( "#'.$ContainerId.'" ).height();
			var EmbedElHeight = EmbedTotalHeight - EmbedPosition.top;
			$(\'.ExternalEmbedFrame\').height(EmbedElHeight);';
        } else {
            if (!$this->FixedHeight) {
                $js = '
                var EmbedPosition = $(\'.ExternalEmbedFrame\').position();
                var EmbedTotalHeight = $( window ).height();
                var EmbedElHeight = EmbedTotalHeight - EmbedPosition.top - 100;
                $(\'.ExternalEmbedFrame\').height(EmbedElHeight);';
            } else {
                $js = '';
            }
        }
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    /**
     * @param $html
     */
    protected function setContentInDB($html) {
        $this->SummernoteObject = SummernoteEntry::Load($this->SummernoteObjectId);
        if ($this->SummernoteObject) {
            $this->SummernoteObject->EntryHtml = $html;
            try {
                $this->SummernoteObject->Save();
            } catch (QCallerException $e) {

            }
        }
    }

    /**
     * @return string
     */
    public function getContent() {
        $html = '';
        $this->SummernoteObject = SummernoteEntry::Load($this->SummernoteObjectId);
        if ($this->SummernoteObject) {
            $html = $this->SummernoteObject->EntryHtml;
        }
        return $this->add_image_responsive_class($html);
    }
    protected function add_image_responsive_class($content) {
        if (!$this->isHtml($content))
            return $content;
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {
            $existing_class = $img->getAttribute('class');
            $img->setAttribute('class', "img-responsive $existing_class");
        }

        $html = $document->saveHTML();
        require_once(__EXTERNAL_LIBRARIES__ . '/htmlpurifier/library/HTMLPurifier.auto.php');
        $objHTMLPurifierConfig = HTMLPurifier_Config::createDefault();
        $objHTMLPurifierConfig->set('HTML.ForbiddenElements', 'script,applet,embed,link,iframe,body,object');
        $objHTMLPurifierConfig->set('HTML.ForbiddenAttributes', '*@onfocus,*@onblur,*@onkeydown,*@onkeyup,*@onkeypress,*@onmousedown,*@onmouseup,*@onmouseover,*@onmouseout,*@onmousemove,*@onclick');
        $objPurifier = new HTMLPurifier($objHTMLPurifierConfig);
        $clean_html = $objPurifier->purify($html);
        return $clean_html;
    }
    protected function isHtml($string){
        if ( $string != strip_tags($string) )
        {
            return true; // Contains HTML
        }
        return false; // Does not contain HTML
    }

    /**
     * @param int $length
     * @return string
     */
    protected function generateRandomString($length = 200) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * @param null $currentAuthorId
     * @return int
     * @throws Exception
     * @throws QCallerException
     */
    protected function getSummernoteObjectId($currentAuthorId = null) {
        if ($currentAuthorId) {
            $existingSN = SummernoteEntry::QuerySingle(QQ::Equal(QQN::SummernoteEntry()->AuthorId,$currentAuthorId));
            if ($existingSN) {
                return $existingSN->Id;
            }
        }
        return $this->createNewSummernoteObject($currentAuthorId);
    }

    /**
     * @param null $currentAuthorId
     * @return int
     */
    protected function createNewSummernoteObject($currentAuthorId = null) {
        $newSN = new SummernoteEntry();
        if ($currentAuthorId)
            $newSN->AuthorId = $currentAuthorId;

        try {
            $newSN->Save(true);
            return $newSN->Id;
        } catch (QCallerException $e) {

        }
        return $newSN->Id;
    }
}
?>
