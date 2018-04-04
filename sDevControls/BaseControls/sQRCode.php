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
class sQRCode {
    protected $sh_Html;
    public function __construct($objParentObject,$data = null,$ec_level = 3,$size = 8) {
        $this->sh_Html = new simpleHTML($objParentObject);
        $this->setData($data,$ec_level,$size);
    }
    public function setData($data = null,$ec_level = 4,$size = 8) {
        if ($data){
            $protocol = 'http://';
            if (QApplication::isSecure())
                $protocol = 'https://';
            $server = $_SERVER['SERVER_NAME'];
            $url = $protocol.$server.__SUBDIRECTORY__.'/sDevControls/BaseControls/QRCode/qrcodeIframe.php?data='.$data.'&ecl='.$ec_level.'&size='.$size;
            $html = '<iframe src="'.$url.'" style="border:none;width:100%;height:100%;"></iframe>';
            $this->updateQRCode($html);
        }
    }
    protected function updateQRCode($html = null) {
        if ($html)
            $this->sh_Html->updateControl($html);
    }
    public function RenderQRCode($printOutput = true) {
        return $this->sh_Html->Render($printOutput);
    }
}
?>