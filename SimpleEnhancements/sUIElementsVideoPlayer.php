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
class sUIElementsVideoPlayer extends simpleHTML {
    protected $childControls = array();
    protected $sourceFile = '';
    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
    }

    // Current supports only mp4 files
    public function setSource($src = '') {
        $this->sourceFile = $src;
        $this->updateUI();
    }

    protected function checkFileFormat() {
        $validVideoFile = false;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type=finfo_file($finfo, __DOCROOT__.$this->sourceFile);
        if (strpos($mime_type,'video') !== false)
            $validVideoFile = true;
        finfo_close($finfo);
        return $validVideoFile;
    }
    public function updateUI() {
        if ($this->checkFileFormat()) {
            $html = '<video style="width:100%;" controls>
                <source src="'.$this->sourceFile.'" type="video/mp4">
                Your browser does not support HTML5 video.
                </video>';
        } else {
            $html = '   <div class="thumbnail">
                          <img src="'.__APP_IMAGE_ASSETS__.'/videonotfound.png" alt="Video Not Found">
                          <div class="caption">
                            <h3>No Valid Video</h3>
                            <p>We could not locate a video to play. Sorry about that...</p>
                          </div>
                        </div>';
        }
        $this->updateControl($html);
    }
}
?>
