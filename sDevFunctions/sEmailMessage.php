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
/* Example Usage :
 * $theMailToSend = new sEmailMessage(array('joe@email.com','john@email.com),'Subject','HtmlMessage',
array(__FILE_UPLOADED_PATH__.'filename.png' => array('File Name','image/png')),null,array('info@stratusolve.com'));
 */
class sEmailMessage {
    protected $smtpServer;
    protected $smtpPort;
    protected $smtpUser;
    protected $smtpPassword;
    protected $recipientArray,$ccArray,$bccArray;
    protected $subject;
    protected $messageHTML;
    protected $attachmentArray;

    protected $sentFromName,$sentFromEmail;
    protected $replyToName,$replyToEmail;

    protected $phpMailerObject;
    public function __construct($recipientArray,$subject,$messageHTML,$attachmentArray = null,$ccArray = null,$bccArray = null,
                                $sentFromName = __APPNAME__,$sentFromEmail = __SMTP_USER__,
                                $replyToName = __APPNAME__,$replyToEmail = __SMTP_USER__,
                                $smtpServer = __SMTP_SERVER__,$smtpPort = __SMTP_PORT__,$smtpUser = __SMTP_USER__,$smtpPassword = __SMTP_PASSWORD__) {
        $this->smtpServer = $smtpServer;
        $this->smtpPort = $smtpPort;
        $this->smtpUser = $smtpUser;
        $this->smtpPassword = $smtpPassword;
        $this->recipientArray = $recipientArray;
        $this->subject = $subject;
        $this->messageHTML = $messageHTML;
        $this->attachmentArray = $attachmentArray;

        $this->ccArray = $ccArray;
        $this->bccArray = $bccArray;

        $this->sentFromName = $sentFromName;
        $this->sentFromEmail = $sentFromEmail;
        $this->replyToName = $replyToName;
        $this->replyToEmail = $replyToEmail;

        $this->phpMailerObject = $this->GetNewPHPMailer($this->smtpServer,$this->smtpPort,$this->smtpUser,$this->smtpPassword,
            $this->sentFromName,$this->sentFromEmail,$this->ccArray,$this->bccArray,$this->replyToName,$this->replyToEmail,
            $this->recipientArray,$this->subject,$this->messageHTML,$this->attachmentArray);
    }
    protected function GetNewPHPMailer($smtpServer,$smtpPort,$smtpUser,$smtpPassword,$sentFromName,$sentFromEmail,
                                        $ccArray,$bccArray,
                                       $replyToName,$replyToEmail,$recipientAddressArray,$subject,$messageHTML,$attachmentArray) {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        /*$mail->isHTML(false);
        $mail->ContentType = 'text/plain';*/
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = $smtpServer;
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $smtpPort;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = $smtpUser;
        //Password to use for SMTP authentication
        $mail->Password = $smtpPassword;
        //Set who the message is to be sent from
        $mail->setFrom($sentFromEmail, $sentFromName);
        //Set an alternative reply-to address
        $mail->addReplyTo($replyToEmail, $replyToName);
        //Set who the message is to be sent to
        foreach ($recipientAddressArray as $address)
            $mail->addAddress($address);
        //Set a cc
        if ($ccArray) {
            foreach ($ccArray as $address)
                $mail->addCC($address);
        }
        //Set a bcc
        if ($bccArray) {
            foreach ($bccArray as $address)
                $mail->addBCC($address);
        }
        //Set the subject line
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($messageHTML);
        //$mail->Body = $messageHTML;
        //Replace the plain text body with one created manually
        $mail->AltBody = $messageHTML;

        $attachments = $this->getAttachmentPathArray();
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment,$this->getAttachmentFileName($attachment),
                    'base64',$this->getAttachmentFileType($attachment));
            }
        }

        return $mail;
    }
    protected function getAttachmentPathArray() {
        if ($this->attachmentArray)
            return array_keys($this->attachmentArray);
        return null;
    }
    protected function getAttachmentFileName($attachment) {
        if (array_key_exists($attachment,$this->attachmentArray)) {
            if (isset($this->attachmentArray[$attachment][0]))
                return $this->attachmentArray[$attachment][0];
        }
        return '';
    }
    protected function getAttachmentFileType($attachment) {
        if (array_key_exists($attachment,$this->attachmentArray))
            if (isset($this->attachmentArray[$attachment][1]))
                return $this->attachmentArray[$attachment][1];
        return '';
    }
    protected function getAttachmentInformation() {
        $attachments = $this->getAttachmentPathArray();
        if (!$attachments)
            return '';
        $returnString = '';
        foreach ($attachments as $attachment) {
            $returnString .= 'Attachment => '.$this->getAttachmentFileName($attachment).'<br>';
        }
        return $returnString;
    }
    protected function getStringFromArray($array) {
        $returnString = '';
        if ($array) {
            foreach ($array as $instance) {
                $returnString .= $instance.',';
            }
            return substr($returnString,0,strlen($returnString) - 1);
        }
        return '';
    }

    public function sendMail($debugMode = false) {
        if ($debugMode)
            $success = true;
        else
            $success = $this->phpMailerObject->send();
        // Here we must adapt to use EmailMessage object
        $newEmailMessage = new EmailMessage();
        $newEmailMessage->SentDate = QDateTime::Now(true);
        $newEmailMessage->FromAddress = $this->sentFromEmail;
        $newEmailMessage->ReplyEmail = $this->replyToEmail;
        $newEmailMessage->Recipients = $this->getStringFromArray($this->recipientArray);
        $newEmailMessage->Cc = $this->getStringFromArray($this->ccArray);
        $newEmailMessage->Bcc = $this->getStringFromArray($this->bccArray);
        $newEmailMessage->Subject = $this->subject;
        $newEmailMessage->EmailMessage = $this->messageHTML;
        $newEmailMessage->Attachments = $this->getAttachmentInformation();
        if ($debugMode)
            $newEmailMessage->ErrorInfo = 'Debug Mode. Email not sent.';
        else
            $newEmailMessage->ErrorInfo = $this->phpMailerObject->ErrorInfo;
        try {
            $newEmailMessage->Save();
            return $success;
        } catch (QCallerException $e) {
            return $success;
        }
    }
}
?>
