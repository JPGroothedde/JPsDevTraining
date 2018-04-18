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
class DataModel_Base {
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // User role setup
    var $userRoleListToSetup = array("Administrator","User");
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Do not change anything below this line...
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Do not change any of these. They are required by the sDev Framework
    var $sDevBaseObjects = array("Account","UserRole","LoginToken","AuditLogEntry","EmailMessage","PasswordReset","FileDocument","SummernoteEntry",
        "PageView","ApiKey","ApiEntity","RemoteAccess","EmailTemplate","EmailTemplateContentRow","EmailTemplateContentBlock","BackgroundProcess","BackgroundProcessUpdate");
    var $sDevBaseObjectAttributes = array (
        "Account"                   => array("FullName","FirstName","LastName","EmailAddress","Username","Password","ChangedBy"),
        "UserRole"                  => array("Role"),//Administrator,User
        "LoginToken"                => array("LoginToken"),
        "AuditLogEntry"             => array("EntryTimeStamp","ObjectName","ModificationType","UserEmail","ObjectId","AuditLogEntryDetail"),           // Type = Updated,Created,Deleted
        "EmailMessage"              => array("SentDate","FromAddress","ReplyEmail","Recipients","Cc","Bcc","Subject","EmailMessage","Attachments","ErrorInfo"),
        "PasswordReset"             => array("Token","CreatedDateTime"),
        "FileDocument"              => array("FileName","Path","CreatedDate"),
        "SummernoteEntry"           => array("EntryHtml","AuthorId","LastChangedDate"),
        "PageView"                  => array("TimeStamped","IPAddress","PageDetails","UserAgentDetails","UserRole","Username"/*If UserRole is not null*/),
        "ApiKey"                    => array("ApiKey","Status"/*Can be active or blocked*/),
        "ApiEntity"                 => array("EntityName"),
        "RemoteAccess"              => array("IpAddress","AccessDateTime"),
        "EmailTemplate"             => array("TemplateName","CcAddresses","BccAddresses","Published"),
        "EmailTemplateContentRow"   => array("Columns","RowOrder"),
        "EmailTemplateContentBlock" => array("ContentBlock","ContentType","Position"/*FullWidth,Left,Right*/),
	    "BackgroundProcess"         => array("PId","UserId","UpdateDateTime","Status","Summary","StartDateTime"),
	    "BackgroundProcessUpdate"   => array("UpdateDateTime","UpdateMessage"),
    );
    var $sDevBaseObjectAttributeTypes = array (																									// The attribute type for each of the defined object attributes (Defines how it is stored in the db)
        "Account"                   => array("VARCHAR(50)","VARCHAR(50)","VARCHAR(50)","VARCHAR(50)","VARCHAR(50) UNIQUE","VARCHAR(200)","VARCHAR(50)"),
        "UserRole"                  => array("VARCHAR(50) UNIQUE"),
        "LoginToken"                => array("VARCHAR(50) UNIQUE"),
        "AuditLogEntry"             => array("DATETIME","VARCHAR(50)","VARCHAR(15)","VARCHAR(100)","TEXT","TEXT"),
        "EmailMessage"              => array("DATETIME","VARCHAR(150)","VARCHAR(150)","TEXT","TEXT","TEXT","TEXT","TEXT","TEXT","TEXT"),
        "PasswordReset"             => array("VARCHAR(200) UNIQUE","DATETIME"),
        "FileDocument"              => array("VARCHAR(200)","VARCHAR(300)","DATETIME"),
        "SummernoteEntry"           => array("TEXT","VARCHAR(100)","DATETIME"),
        "PageView"                  => array("DATETIME","VARCHAR(50)","VARCHAR(500)","TEXT","VARCHAR(200)","VARCHAR(200)"/*If UserRole is not null*/),
        "ApiKey"                    => array("VARCHAR(200) UNIQUE","VARCHAR(50)"),
        "ApiEntity"                 => array("VARCHAR(50)"),
        "RemoteAccess"              => array("VARCHAR(50)","DATETIME"),
        "EmailTemplate"             => array("VARCHAR(200)","TEXT","TEXT","INT"),
        "EmailTemplateContentRow"   => array("INT","INT"),
        "EmailTemplateContentBlock" => array("TEXT","VARCHAR(50)","VARCHAR(50)"),
	    "BackgroundProcess"         => array("VARCHAR(50)","VARCHAR(50)","DATETIME","VARCHAR(50)","TEXT","DATETIME"),
	    "BackgroundProcessUpdate"   => array("DATETIME","TEXT"),
    );
    var $sDevBaseObjectSingleRelations = array (																									 // The list of objects that each object is related to once
        "Account"                   => array("UserRole"),
        "LoginToken"                => array("Account"),
        "PasswordReset"             => array("Account"),
        "ApiEntity"                 => array("ApiKey"),
        "EmailTemplateContentBlock" => array("EmailTemplateContentRow"),
        "EmailTemplateContentRow"   => array("EmailTemplate"),
	    "BackgroundProcessUpdate"   => array("BackgroundProcess"),
    );

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Special Renders
    var $sDevBaseObjectSpecialRenders =  array(
        "ApiKey"                   => array(
            "Status"
                =>array("LIST","Active","Blocked")),
        "EmailTemplateContentBlock"                   => array(
            "ContentType"
                =>array("LIST","Text","Image")),
	    "EmailTemplate"                   => array(
		    "Published"
		    =>array("BUTTON_TOGGLE","Published","Published")),
	    "BackgroundProcess"                   => array(
		    "Status"
		    =>array("LIST","Pending","Running","Completed Successfully","Completed Failed","Completed Interrupted")),
    );
    // To be removed...
    var $objectManyRelations = array (																									 	// The list of objects that each object is related to many times
    );

    // External API configuration
    var $sDevBaseObjectAPIs = array("Account","UserRole");
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Merge the sDevObjects with the Project-Defined Objects
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var $objects;
    var $objectAttributes;
    var $objectAttributeTypes;
    var $objectSingleRelations;
    var $objectSpecialRenders;
    var $objectAPIs;

    function __construct() {
        $this->objects = array_merge($this->sDevBaseObjects,$this->ProjectObjects);
        $this->objectAttributes = array_merge($this->sDevBaseObjectAttributes,$this->ProjectObjectAttributes);
        $this->objectAttributeTypes = array_merge($this->sDevBaseObjectAttributeTypes,$this->ProjectObjectAttributeTypes);
        $this->objectSingleRelations = array_merge($this->sDevBaseObjectSingleRelations,$this->ProjectObjectSingleRelations);
        $this->objectSpecialRenders = array_merge($this->ProjectObjectSpecialRenders,$this->sDevBaseObjectSpecialRenders);
        $this->objectAPIs = array_merge(array_filter($this->ProjectObjectAPIs),array_filter($this->sDevBaseObjectAPIs));
        $possibleApiEntities = array("LIST");
        foreach ($this->objectAPIs as $api) {
            array_push($possibleApiEntities,$api);
        }
        $this->objectSpecialRenders = array_merge($this->objectSpecialRenders,array("ApiEntity" => array(
            "EntityName" => $possibleApiEntities)));
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Retrieve functions
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getObjectAttributes($object)
    {
        if (array_key_exists($object,$this->objectAttributes))
            return $this->objectAttributes[$object];
        return array("");
    }
    function getObjectAttributeType($object,$objectAttribute)
    {
        if (array_key_exists($object,$this->objectAttributes))
        {
            $index = array_search($objectAttribute, $this->objectAttributes[$object]);
            return $this->objectAttributeTypes[$object][$index];
        }
        return "Not Defined";
    }
    function getObjectSingleRelations($object) {
        if (array_key_exists($object,$this->objectSingleRelations))
            return $this->objectSingleRelations[$object];
        return null;
    }
    function getObjectAttributeSpecialRenders($object,$objectAttribute) {
        if (array_key_exists($object,$this->objectSpecialRenders)) {
            if (is_array($this->objectSpecialRenders[$object])) {
                if (array_key_exists($objectAttribute,$this->objectSpecialRenders[$object]))
                    return $this->objectSpecialRenders[$object][$objectAttribute];
            }
        }
        return null;
    }

}
/*
// Define your objects' attribute types below. The list below shows the available types. You can indicate the length for strings by adding it in brackets after the type, ex VARCHAR (30)	
//"DECIMAL";	
//"TINYINT";	
//"SMALLINT";	
//"INTEGER";	
//"FLOAT";	
//"DOUBLE";	
//"TIMESTAMP";	
//"BIGINT";	
//"MEDIUMINT";	
//"DATE";	
//"TIME";	
//"DATETIME";	
//"YEAR";	
//"DATE";	
//"BIT";	
//"DECIMAL";	
//"ENUM";	
//"SET";	
//"TINYBLOB";	
//"MEDIUMBLOB"	
//"LONGBLOB";	
//"TEXT";	
//"VARCHAR";	
//"CHAR";	
//"GEOMETRY";	
*/
?>