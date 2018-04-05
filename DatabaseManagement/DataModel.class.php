<?php
require('DataModel_Base.class.php');
class DataModel extends DataModel_Base {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // define all the objects for your app here
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var $ProjectObjects                = array("Course","Assignment","Subscription");
    var $ProjectObjectAttributes = array (																										// The attributes for each of the defined objects
        "Course"        => array("Name","Price"),
        "Assignment"    => array("Name","Status","FinalMark"),
        "Subscription"  => array("StartDate","EndDate"),
    );

    var $ProjectObjectAttributeTypes = array (																									// The attribute type for each of the defined object attributes (Defines how it is stored in the db)
        "Course"        => array("VARCHAR(20)","INT(11)"),
        "Assignment"    => array("VARCHAR(20)","VARCHAR(20)","INT(11)"),
        "Subscription"  => array("DATE","DATE"),
    );

    var $ProjectObjectSingleRelations = array (
        "Subscription"              => array("Account","Course","Assignment"),
    );
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Special Renders
    //TODO: Support more renders here... REMEMBER: When adding new render types here, they must be implemented in sDevORM/index.php
    var $ProjectObjectSpecialRenders    = array(
        "PlaceHolder"                   => array(
            "DummyTwo"
                =>array("LIST","Test,Result","Result,Test","One more item"),
            "DummyThree"
                =>array("INPUT_GROUP","R",null),
            "DummyFour"
                =>array("BUTTON_TOGGLE","Checked","Unchecked"),
            ),
    );
    /*
     * The following Special render types are currently supported:
     * LIST -> Defined as an array where the first value is "LIST", followed by the list items
     * INPUT_GROUP -> Defined as an array where the first value is "INPUT_GROUP", followed by the input-group addon before the text box and then the input-group addon after the text box.
     *                If one of the input-group addons must not be shown, simply define it as "null", but do not leave out the item in the array
     * BUTTON_TOGGLE -> Defined as an array where the first value is "BUTTON_TOGGLE", followed by the text value of the button when toggled and then the text value of the button when not toggled.
     */

    // External API configuration
    // List the objects here that are to generated as API's
    var $ProjectObjectAPIs = array("PlaceHolder");
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // User role setup
    var $userRoleListToSetup = array("Administrator","User");

    function __construct() {
        parent::__construct();
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