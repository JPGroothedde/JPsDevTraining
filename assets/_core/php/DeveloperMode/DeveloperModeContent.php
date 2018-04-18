<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 22042016
 * Time: 14:53
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require('../../sdev.inc.php');
InitContent();


function InitContent() {
    echo getHeader();
    echo getDashboard();
    echo getUI();
    echo getReference();
    echo getFunctionLibrary();
    echo getExamples();
    echo getFooter();
}

function getHeader() {
	$html = '<div class="modal fade" id="BlankPageGeneratorModal" tabindex="-1" role="dialog" aria-labelledby="ModalGeneratorModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalGeneratorModalLabel">Generate code for a blank page</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Page Name</label>
                                    <input type="text" class="form-control" id="BlankPageGenerator_PageName" placeholder="Name of your page">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <pre>
<span id="BlankPageGenerator_ResultCode" style="width:100%;">Waiting for input...</span>
                            </pre>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="BlankPageGenerator_GenerateBtn" type="button" class="btn btn-primary">Get Code</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
	$html .= '<div class="modal fade" id="ModalGeneratorModal" tabindex="-1" role="dialog" aria-labelledby="ModalGeneratorModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalGeneratorModalLabel">Generate Modal Code</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Modal Title</label>
                                    <input type="text" class="form-control" id="GenerateModal_ModalTitle" placeholder="User friendly title">
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Modal CSS ID</label>
                                    <input type="text" class="form-control" id="GenerateModal_ModalId" placeholder="CSS ID to toggle modal">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <pre>
<span id="GenerateModal_ResultCode" style="width:100%;">Waiting for input...</span>
                            </pre>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="GenerateModal_GenerateBtn" type="button" class="btn btn-primary">Get Code</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
	$html .= '<div class="modal fade" id="TabsGeneratorModal" tabindex="-1" role="dialog" aria-labelledby="TabsGeneratorModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="TabsGeneratorModalLabel">Generate Tabs Code</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tab Container CSS ID</label>
                                    <input type="text" class="form-control" id="GenerateTabs_TabContainer" placeholder="To uniquely reference the tabs for this component">
                              </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tabs (Tab titles separated by commas)</label>
                                    <textarea class="form-control" id="GenerateTabs_TabSet" placeholder="CSS ID to toggle tab" rows="5"></textarea>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <pre>
<span id="GenerateTabs_ResultCode" style="width:100%;">Waiting for input...</span>
                            </pre>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="GenerateTabs_GenerateBtn" type="button" class="btn btn-primary">Get Code</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
	$html .= '<div class="modal fade" id="CollapsePanelsGeneratorModal" tabindex="-1" role="dialog" aria-labelledby="CollapsePanelsGeneratorModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="CollapsePanelsGeneratorModalLabel">Generate Collapsible Panels Code</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Panels Container CSS ID</label>
                                    <input type="text" class="form-control" id="GenerateCollapsePanels_CollapseContainer" placeholder="To uniquely reference the panels for this component">
                              </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Panels (Panel titles separated by commas)</label>
                                    <textarea class="form-control" id="GenerateCollapsePanels_PanelSet" placeholder="CSS ID to toggle panel collapse" rows="5"></textarea>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <pre>
<span id="GenerateCollapsePanels_ResultCode" style="width:100%;">Waiting for input...</span>
                            </pre>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="GenerateCollapsePanels_GenerateBtn" type="button" class="btn btn-primary">Get Code</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
	$html .= '<div class="modal fade" id="ClickableHtmlGeneratorModal" tabindex="-1" role="dialog" aria-labelledby="ModalGeneratorModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalGeneratorModalLabel">Generate Javascript for clickable component</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Action Name</label>
                                    <input type="text" class="form-control" id="ClickableHtmlGenerator_ActionName" placeholder="Name of action to be triggered">
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Event Trigger Class</label>
                                    <input type="text" class="form-control" id="ClickableHtmlGenerator_EventTriggerClass" placeholder="CSS Class to trigger event">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <pre>
<span id="ClickableHtmlGenerator_ResultCode" style="width:100%;">Waiting for input...</span>
                            </pre>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="ClickableHtmlGenerator_GenerateBtn" type="button" class="btn btn-primary">Get Code</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
    $html .= '<div class="container-fluid"><div class="row"><div class="col-md-12">';
    $html .= '<h4 class="page-header">Developer Centre<span id="DevModeWrapperHide" class="pull-right"><i class="fa fa-times" aria-hidden="true"></i></span></h4>';
    $html .= '</div></div><!--Row & col-md-12-->';
    return $html;
}
function getFooter() {
    $html = '</div><!--Container-->';
    return $html;
}
function getDashboard() {
    $html = '<div id="Dev_Dashboard_Wrapper">';
    $html .= '<div class="col-md-12"><h5>Dashboard</h5></div>';
    $html .= '<div class="col-md-12 mrg-bottom15"><button class="btn btn-default fullWidth" id="Dev_App_Config_Button" type="button">App Configuration</button></div>';
    $html .= '<div class="col-md-6 mrg-bottom15"><button class="btn btn-default fullWidth" id="Dev_UI_Button" type="button">UI</button></div>';
    $html .= '<div class="col-md-6 mrg-bottom15"><button class="btn btn-default fullWidth" id="Dev_Reference_Button" type="button">Reference</button></div>';
    $html .= '<div class="col-md-6 mrg-bottom15"><button class="btn btn-default fullWidth" id="Dev_FunctionLib_Button" type="button">Global Function Library</button></div>';
    $html .= '<div class="col-md-6 mrg-bottom15"><button class="btn btn-default fullWidth" id="Dev_Examples_Button" type="button">Examples</button></div>';
    $html .= '<div class="col-md-12"><h5 style="margin-top: 10px;">Custom Logs<span class="pull-right"><button id="Dev_ClearCustomLog" class="btn btn-danger btn-xs">Clear</button></span></h5></div>';
    $html .= '<div class="col-md-12" id="CustomLogsWrapper">';
    $html .= '</div><!--CustomLogsWrapper-->';
    $html .= '</div><!-- Dev_Dashboard_Wrapper-->';
    return $html;
}
function getCustomLogs() {
    return file_get_contents('CustomLog.txt');
}
function getUI() {
    $html = '<div id="Dev_UI_Wrapper">';
    $html .= '<div class="col-md-12"><h5>UI<span class="pull-right"><button class="btn btn-default btn-xs backToDevDashboard"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Dashboard</button></span></h5></div>';
    $html .= '<div class="col-md-12 DevModeContentArea"><p>Use the shortcuts below to generate quick code snippets for frequently used UI components</p></div>';
    $html .= '<div class="col-md-12 DevModeContentArea">
                <div class="list-group">
                <a href="#" class="list-group-item" data-toggle="modal" data-target="#BlankPageGeneratorModal">
                    Blank Page
                  </a>
                  <a href="#" class="list-group-item" data-toggle="modal" data-target="#ModalGeneratorModal">
                    Bootstrap Modal
                  </a>
                  <a href="#" class="list-group-item" data-toggle="modal" data-target="#TabsGeneratorModal">Bootstrap Tabs</a>
                  <a href="#" class="list-group-item" data-toggle="modal" data-target="#CollapsePanelsGeneratorModal">Bootstrap Collapsible panel(s)</a>
                  <a href="#" class="list-group-item" data-toggle="modal" data-target="#ClickableHtmlGeneratorModal">
                    Clickable html component with post back action
                  </a>
                </div>
              </div>';
    $html .= '</div><!-- Dev_Dashboard_Wrapper-->';
    return $html;
}
function getReference() {
    $html = '<div id="Dev_Reference_Wrapper">';
    $html .= '<div class="col-md-12"><h5>Reference<span class="pull-right"><button class="btn btn-default btn-xs backToDevDashboard"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Dashboard</button></span></h5></div>';
    $html .= '<div class="col-md-12 DevModeContentArea">
                <div class="panel-group" id="QQAccordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="QQIntro">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#QQAccordion" href="#QQIntroContent" aria-expanded="true" aria-controls="QQIntroContent">
                    Introduction to QCubed Query
                </a>
            </h4>
        </div>
        <div id="QQIntroContent" class="panel-collapse collapse" role="tabpanel" aria-labelledby="QQIntro">
            <div class="panel-body">
                <p>The querying logic behind all the Load methods in your ORM classes is powered by <strong>QCubed Query</strong>,
                or <strong>QQ</strong> for short.  Put simply, <strong>QQ</strong> is a completely object oriented API to perform any SELECT-based
                query on your database to return any result or hierarchy of your ORM objects.</p>
        
                <p>While the ORM classes utilize basic, straightforward SELECT statements in its Load methods,
                <strong>QQ</strong> is capable of infinitely more complex queries.  In fact, any SELECT a developer
                would need to do against a database should be possible with <strong>QQ</strong>.</p>
        
                <p>At its core, any <strong>QQ</strong> query will return a collection of objects of the same type (e.g. a collection of
                Account objects).  But the power of <strong>QQ</strong> is that we can branch beyond this core collection by bringing in
                any related objects, performing any SQL-based clause (including WHERE, ORDER BY, JOIN, aggregations, etc.) on both
                the core set of Account rows <i>and</i> any of these related objects rows.</p>
        
                <p>Every code generated class in your ORM will have the three following static <strong>QCubed Query</strong> methods:</p>
                <ul>
                    <li><strong>QuerySingle</strong>: to perform a QCubed Query to return just a single object (typically for queries where you expect only one row)</li>
                    <li><strong>QueryArray</strong>: to perform a QCubed Query to return just an array of objects</li>
                    <li><strong>QueryCount</strong>: to perform a QCubed Query to return an integer of the count of rows (e.g. "COUNT (*)")</li>
                </ul>
        
                <p>All three QCubed Query methods expect two parameters, a <strong>QQ Condition</strong> and an optional set of <strong>QQ Clauses</strong>.
                <strong>QQ Conditions</strong> are typically conditions that you would expect to find in a SQL WHERE clause, including <strong>Equal</strong>,
                <strong>GreaterThan</strong>, <strong>IsNotNull</strong>, etc.  <strong>QQ Clauses</strong> are additional clauses that you could add to alter
                your SQL statement, including methods to perform SQL equivalents of JOIN, DISTINCT, GROUP BY, ORDER BY and LIMIT.</p>
        
                <p>And finally, both <strong>QQ Condition</strong> and <strong>QQ Clause</strong> objects will expect <strong>QQ Node</strong> parameters.  <strong>QQ Nodes</strong> can
                either be tables, individual columns within the tables, or even association tables.  <strong>QQ Node</strong> classes for your
                entire ORM is code generated for you.</p>
                
                <p>The next few examples will examine all three major constructs (<strong>QQ Node</strong>, <strong>QQ Condition</strong> and <strong>QQ Clause</strong>) in greater
                detail.</p>
                
                <p>And as a final note, notice that <strong>QCubed Query</strong> doesn\'t have any construct to describe what would normally be your SELECT clause.
                This is because we take advantage of the code generation process to allow <strong>QCubed Query</strong> to automagically "know" which
                fields that should be SELECT-ed based on the query, conditions and clauses you are performing.  This will allow a lot
                greater flexbility in your data model.  Because the framework is now taking care of column names, etc., instead of the
                developer needing to manually hard code it, you can make changes to columns in your tables without needing to rewrite
                your <strong>QCubed Query</strong> calls.</p>
                <h4 class="page-header">Example</h4>
                <pre>//Retrieve a single Account from the database<br>$objAccount = Account::QuerySingle(QQ::All());</pre>
                <pre>//Retrieve all Accounts from the database<br>$arrAccount = Account::QueryArray(QQ::All());</pre>
                <pre>//Count all Accounts in the database<br>$AccountCount = Account::QueryCount(QQ::All());</pre>
                <pre>//Retrieve all Accounts from the database where the FirstName is "Dude" <br>$arrAccount = Account::QueryArray(QQ::Equal(QQN::Account()->FirstName,"Dude"));</pre>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="QQNodeClasses">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#QQAccordion" href="#QQNodeClassesContent" aria-expanded="false" aria-controls="QQNodeClassesContent">
                    QCubed Query Nodes
                </a>
            </h4>
        </div>
        <div id="QQNodeClassesContent" class="panel-collapse collapse" role="tabpanel" aria-labelledby="QQNodeClasses">
            <div class="panel-body">
                <p><strong>QQ Nodes</strong> are any object table or association table (type tables are excluded), as well as any
                column within those tables.  <strong>QQ Node</strong> classes for your entire data model is generated for you
                during the code generation process.</p>
            
                <p>But in addition to this, <strong>QQ Nodes</strong> are completely interlinked together, matching the relationships
                that you have defined as foreign keys (or virtual foreign keys using a relationships script) in your
                database.</p>
            
                <p>To get at a specific <strong>QQ Node</strong>, you will need to call <strong>QQN::ClassName()</strong>, where "ClassName" is the name of the class
                for your table (e.g. "Account").  From there, you can use property getters to get at any column or relationship.</p>
            
                <p>Naming standards for the columns are the same as the naming standards for the public getter/setter properties on the object, itself.
                So just as <strong>$objAccount->FirstName</strong> will get you the "First Name" property of a Account object,
                <strong>QQN::Account()->FirstName</strong> will refer to the "account.first_name" column in the database.</p>
            
                <p>Naming standards for relationships are the same way.  The tokenization of the relationship reflected in a class\'s
                property and method names will also be reflected in the QQ Nodes.  So just as <strong>$objProject->ManagerAccount</strong> will
                get you a Account object which is the manager of a given project, <strong>QQN::Project()->ManagerAccount</strong> refers to the
                account table\'s row where account.id = project.manager_account_id.</p>
            
                <p>And of course, because <em>everything</em> that is linked together in the database is also linked together in your <strong>QQ Nodes</strong>,
                <strong>QQN::Project()->ManagerAccount->FirstName</strong> would of course refer to the account.first_name of the account who is the
                project manager of that particular row in the project table.</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="QQConditionClasses">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#QQAccordion" href="#QQConditionClassesContent" aria-expanded="false" aria-controls="QQConditionClassesContent">
                    QCubed Query Conditions
                </a>
            </h4>
        </div>
        <div id="QQConditionClassesContent" class="panel-collapse collapse" role="tabpanel" aria-labelledby="QQConditionClasses">
            <div class="panel-body">	
                <p>All <strong>QCubed Query</strong> method calls require a <strong>QQ Condition</strong>. <strong>QQ Conditions</strong> allow you
                to create a nested/hierarchical set of conditions to describe what essentially becomes your
                WHERE clause in a SQL query statement.</p>
        
                <p>The following is the list of QQ Condition classes and what parameters they take:</p>
                <ul>
                    <li>QQ::All()</li>
                    <li>QQ::None()</li>
                    <li>QQ::Equal(QQNode, Value)</li>
                    <li>QQ::NotEqual(QQNode, Value)</li>
                    <li>QQ::GreaterThan(QQNode, Value)</li>
                    <li>QQ::LessThan(QQNode, Value)</li>
                    <li>QQ::GreaterOrEqual(QQNode, Value)</li>
                    <li>QQ::LessOrEqual(QQNode, Value)</li>
                    <li>QQ::IsNull(QQNode)</li>
                    <li>QQ::IsNotNull(QQNode)</li>
                    <li>QQ::In(QQNode, array of string/int/datetime)</li>
                    <li>QQ::Like(QQNode, string)</li>
                </ul>
                
                <p>For almost all of the above <strong>QQ Conditions</strong>, you are comparing a column with some value.  The <strong>QQ Node</strong> parameter
                represents that column.  However, value can be either a static value (like an integer, a string, a datetime, etc.)
                <i>or</i> it can be another <strong>QQ Node</strong>.</p>
                
                <p>And finally, there are three special <strong>QQ Condition</strong> classes which take in any number of additional <strong>QQ Condition</strong> classes:</p>
                <ul>
                    <li>QQ::AndCondition()</li>
                    <li>QQ::OrCondition()</li>
                    <li>QQ::Not() - "Not" can only take in one <strong>QQ Condition</strong> class</li>
                </ul>
                <p>(conditions can be passed in as parameters and/or as arrays)</p>
                
                <p>Because And/Or/Not conditions can take in <i>any</i> other condition, including other And/Or/Not conditions, you can
                embed these conditions into other conditions to create what ends up being a logic tree for your entire SQL Where clause.  See
                below for more information on this.</p>
                <h4 class="page-header">Example</h4>
                <pre>//Select all Accounts where: <br>the first name is alphabetically "greater than" the last name<br>$arrAccount = Account::QueryArray(
                QQ::GreaterThan(QQN::Account()->FirstName, QQN::Account()->LastName)
                );</pre>
                <pre>//Select all Projects where: <br>the manager\'s first name is alphabetically "greater than" the last name, or who\'s name contains "Website"<br>$arrProject = Project::QueryArray(
                            QQ::OrCondition(
                                QQ::GreaterThan(QQN::Project()->ManagerAccount->FirstName, QQN::Project()->ManagerAccount->LastName),
                                QQ::Like(QQN::Project()->Name, \'%Website%\')
                            )
                    );</pre>
                <pre>//Select all Projects where: <br>the Project ID <= 2 AND (the manager\'s first name is alphabetically "greater than" the last name, or who\'s name contains "Website")<br>$arrProject = Project::QueryArray(
                    QQ::AndCondition(
                        QQ::OrCondition(
                            QQ::GreaterThan(QQN::Project()->ManagerAccount->FirstName, QQN::Project()->ManagerAccount->LastName),
                            QQ::Like(QQN::Project()->Name, \'%Website%\')
                        ),
                        QQ::LessOrEqual(QQN::Project()->Id, 2)
                    )
                );</pre>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="QQQueryConditions">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#QQAccordion" href="#QQQueryConditionsContent" aria-expanded="false" aria-controls="QQQueryConditionsContent">
                    QCubed Query Clauses
                </a>
            </h4>
        </div>
        <div id="QQQueryConditionsContent" class="panel-collapse collapse" role="tabpanel" aria-labelledby="QQQueryConditions">
            <div class="panel-body">
                <p>All <strong>QCubed Query</strong> method calls take in an optional set of <strong>QQ Clauses</strong>. <strong>QQ Clauses</strong> allow you
                alter the result set by performing the equivalents of most of your major SQL clauses, including JOIN, ORDER BY,
                GROUP BY and DISTINCT.</p>
            
                <p>The following is the list of QQ Clause classes and what parameters they take:</p>
                <ul>
                    <li>QQ::OrderBy(array/list of QQNodes or QQConditions)</li>
                    <li>QQ::GroupBy(array/list of QQNodes)</li>
                    <li>QQ::Having(QQSubSqlNode)</li>
                    <li>QQ::Count(QQNode, string)</li>
                    <li>QQ::Minimum(QQNode, string)</li>
                    <li>QQ::Maximum(QQNode, string)</li>
                    <li>QQ::Average(QQNode, string)</li>
                    <li>QQ::Sum(QQNode, string)</li>
                    <li>QQ::LimitInfo(integer[, integer = 0])</li>
                    <li>QQ::Distinct()</li>
                </ul>
            
                <p><strong>OrderBy</strong> and <strong>GroupBy</strong> follow the conventions of SQL ORDER BY and GROUP BY.  It takes in a
                list of one or more <strong>QQ Column Nodes</strong>. This list could be a parameterized list and/or an array.</p>
            
                <p>Specifically for <strong>OrderBy</strong>, to specify a <strong>QQ Node</strong> that you wish to order by in descending
                order, add a "false" after the QQ Node.  So for example, <strong>QQ::OrderBy(QQN::Account()->LastName, false,
                QQN::Account()->FirstName)</strong> will do the SQL equivalent of "ORDER BY last_name DESC, first_name ASC".</p>
            
                <p><strong>Count</strong>, <strong>Minimum</strong>, <strong>Maximum </strong>, <strong>Average</strong> and <strong>Sum</strong> are aggregation-related clauses, and
                only work when <strong>GroupBy</strong> is specified.  These methods take in an attribute name, which
                can then be restored using <strong>GetVirtualAttribute()</strong> on the object.</p>
            
                <p><strong>Having</strong> adds a SQL Having clause, which allows you to filter the results of your query based
                on the results of the aggregation-related functions. <strong>Having</strong> requires a Subquery, which is a SQL code
                snippet you create to specify the criteria to filter on. (See the Subquery section
                later in this tutorial for more information on those).</p>
            
                <p><strong>LimitInfo</strong> will limit the result set.  The first integer is the maximum number of rows
                you wish to limit the query to.  The <em>optional</em> second integer is the offset (if any).</p>
            
                <p>And finally, <strong>Distinct</strong> will cause the query to be called with SELECT DISTINCT.</p>
            
                <p>All clauses must be wrapped around a single <strong>QQ::Clause()</strong> call, which takes in any
                number of clause classes for your query.</p>
                <h4 class="page-header">Example</h4>
                <pre>//Select all Accounts, Ordered by Last Name then First Name<br>$arrAccount = Account::QueryArray(
                QQ::All(),
		QQ::Clause(
			QQ::OrderBy(QQN::Account()->LastName, QQN::Account()->FirstName)
		)
                );</pre>
                <pre>//Select all People, Ordered by Last Name then First Name, <br>Limited to the first 4 results<br>$arrAccount = Account::QueryArray(
                QQ::All(),
		QQ::Clause(
			QQ::OrderBy(QQN::Account()->LastName, QQN::Account()->FirstName),
			QQ::LimitInfo(4)
		)
                );</pre>
            </div>
        </div>
    </div>
</div>
</div>';
    $html .= '</div><!-- Dev_Dashboard_Wrapper-->';
    return $html;
}
function getFunctionLibrary() {
    $rc = new ReflectionClass('AppSpecificFunctions');
    $html = '<div id="Dev_FunctionLibrary_Wrapper">';
    $html .= '<div class="col-md-12"><h5>Function Library<span class="pull-right"><button class="btn btn-default btn-xs backToDevDashboard"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Dashboard</button></span></h5></div>';
    $html .= '<div id="Dev_FunctionLibrary_Content">';
    $html .= '<div class="col-md-12"><p>Functions found in class AppSpecificFunctions. This class extends class QApplicationBase, which is where the core app functions reside.</p>
                <p>To define functions that are available throughout your application, simply add them to class AppSpecificFunctions in the sDevFunctions folder.</p>
                <p>'.$rc->getDocComment().'</p><br><h5>Methods: </h5><br></div>';
    $html .= '<div class="col-md-12">';
    $Methods = $rc->getMethods();
    foreach ($Methods as $m) {
       $html .= '<strong>Function: </strong>'.$m->getName().'<br><strong>Description: </strong>'.$m->getDocComment().'<br><br>';
    }
    $html .= '</div>';
    $html .= '</div></div><!-- Dev_FunctionLibrary_Content Dev_FunctionLibrary_Wrapper-->';
    return $html;
}
function getExamples() {
    $html = '<div id="Dev_Examples_Wrapper">';
    $html .= '<div class="col-md-12"><h5>Examples<span class="pull-right"><button class="btn btn-default btn-xs backToDevDashboard"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Dashboard</button></span></h5></div>';
    $html .= '<div class="col-md-12"><p>Open an example below to see its result. You can view the code in your IDE under sDevExamples.</p>';
    $html .= '<div class="list-group">
                <a href="#" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Entity Views</h4>
                    <p class="list-group-item-text">Still to come</p>
                </a>
                <a href="#" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Entity Grids (Data Grids)</h4>
                    <p class="list-group-item-text">Still to come</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/EntityList/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Entity Lists (Cleaner version of data grids)</h4>
                    <p class="list-group-item-text">Data lists are similar to data grids in that they allow you to display a grid or list of an object. The main difference is that 
                    data lists do not use standard pagination, rather a load more effect.</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/EntitySelect/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Entity Select</h4>
                    <p class="list-group-item-text">An example of how to select an entity to link it to something on the current page</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/Wysiwyg/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Wysiwyg Editor</h4>
                    <p class="list-group-item-text">Basic implementation of a simple wysiwyg editor (based) on Summernote js library</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/sImageCropper/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Image Cropping</h4>
                    <p class="list-group-item-text">An image cropper that allows you to crop images to a square/rectangle that is adjustable to your requirements</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/FileUploads/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">File Uploads</h4>
                    <p class="list-group-item-text">An example of the default file uploader for the sDev framework</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/Charts/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Charting</h4>
                    <p class="list-group-item-text">sDev Implements Chart.js. View the example page</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/ProgressBars/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Progress Bars</h4>
                    <p class="list-group-item-text">An example of how to use progress indicators</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/SideBars/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Side Bars</h4>
                    <p class="list-group-item-text">An example of how to use side bars</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/Calendars/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Calendars</h4>
                    <p class="list-group-item-text">An example of how to use calendars</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/Animations/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Animations</h4>
                    <p class="list-group-item-text">An example of how to use animations</p>
                </a>
                <a href="#" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">PDF Generation</h4>
                    <p class="list-group-item-text">Still to come</p>
                </a>
                <a href="#" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">Emailing</h4>
                    <p class="list-group-item-text">Still to come</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/CSVExport/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">CSV Export</h4>
                    <p class="list-group-item-text">sDev supports 2 methods for CSV export. A direct file download which uses the standard php csv functions and a custom
                    method that generates a csv file that can be downloaded later.</p>
                </a>
                <a href="'.__SUBDIRECTORY__.'/sDevExamples/CSVImport/" class="list-group-item" target="blank">
                    <h4 class="list-group-item-heading">CSV Import</h4>
                    <p class="list-group-item-text">An example of how to import an object called "PlaceHolder". The idea with the CSV importer is to import to a staging object which needs
                    to be created in the datamodel first, so in this case "PlaceHolder" is just an example. From there one can use the imported staging object to create the desired data</p>
                </a>
            </div>';
    $html .= '</div></div><!-- Dev_Dashboard_Wrapper-->';
    return $html;
}
?>
<script>
    // Setup elements
    hideAllDevWrappers();
    $('#Dev_Dashboard_Wrapper').show();
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $('.backToDevDashboard').click(function(){
        hideAllDevWrappers();
        $('#Dev_Dashboard_Wrapper').show();
    });

    $('#Dev_App_Config_Button').click(function(){
        window.open(baseUrl+"assets/_core/php/_devtools/start_page.php");
    });

    $('#Dev_UI_Button').click(function(){
        hideAllDevWrappers();
        initWrapperStyle('Dev_UI_Wrapper');
    });
    $('#Dev_Reference_Button').click(function(){
        hideAllDevWrappers();
        initWrapperStyle('Dev_Reference_Wrapper');
    });
    $('#Dev_FunctionLib_Button').click(function(){
        hideAllDevWrappers();
        initWrapperStyle('Dev_FunctionLibrary_Wrapper');
    });
    $('#Dev_Examples_Button').click(function(){
        hideAllDevWrappers();
        initWrapperStyle('Dev_Examples_Wrapper');
    });

    $('#Dev_ClearCustomLog').click(function() {
        clearDeveloperLog();
    });
    $("#DevModeWrapperHide").on("click", function () {
        // Set the effect type
        var effect = 'slide';

        // Set the options for the effect type chosen
        var options = { direction: 'right' };

        // Set the duration (default: 400 milliseconds)
        var duration = 500;

        $('#DevModeWrapper').toggle(effect, options, duration);
        $('#DevModeWrapperSideButton').toggle(effect, options, duration);

    });
    function hideAllDevWrappers() {
        $('#Dev_Dashboard_Wrapper').hide();
        $('#Dev_FunctionLibrary_Wrapper').hide();
        $('#Dev_UI_Wrapper').hide();
        $('#Dev_Reference_Wrapper').hide();
        $('#Dev_Examples_Wrapper').hide();
    }
    function initWrapperStyle(WrapperId) {
        $('#'+WrapperId).show();
        var position = $('#'+WrapperId).position();
        var totalHeight = $( window ).height();
        var elHeight = totalHeight - position.top - 10;
        $('#'+WrapperId).height(elHeight);
        $('#'+WrapperId).css("overflow","scroll");
        $('#'+WrapperId).css("border","2px solid #f1f1f1");
        $('#'+WrapperId).css("border-radius","5px");
    }


    $(document).on('click', '#GenerateModal_GenerateBtn', function(e) {
	    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { getModalCode: "1",ModalId: $("#GenerateModal_ModalId").val(),ModalTitle: $("#GenerateModal_ModalTitle").val()})
		    .done(function( data ) {
			    $("#GenerateModal_ResultCode").text(data);
		    });
    });

    $(document).on('click', '#GenerateTabs_GenerateBtn', function(e) {
	    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { getTabsCode: "1",TabContainer: $("#GenerateTabs_TabContainer").val(),TabSet: $("#GenerateTabs_TabSet").val()})
		    .done(function( data ) {
			    $("#GenerateTabs_ResultCode").text(data);
		    });
    });
    
    $(document).on('click', '#GenerateCollapsePanels_GenerateBtn', function(e) {
	    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { getCollapsePanelsCode: "1",PanelContainer: $("#GenerateCollapsePanels_CollapseContainer").val(),PanelSet: $("#GenerateCollapsePanels_PanelSet").val()})
		    .done(function( data ) {
			    $("#GenerateCollapsePanels_ResultCode").text(data);
		    });
    });

    $(document).on('click', '#ClickableHtmlGenerator_GenerateBtn', function(e) {
	    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { getClickableHtmlCode: "1",ActionName: $("#ClickableHtmlGenerator_ActionName").val(),TriggerClass: $("#ClickableHtmlGenerator_EventTriggerClass").val()})
		    .done(function( data ) {
			    $("#ClickableHtmlGenerator_ResultCode").text(data);
		    });
    });
    $(document).on('click', '#BlankPageGenerator_GenerateBtn', function(e) {
	    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { getBlankPageCode: "1",PageName: $("#BlankPageGenerator_PageName").val()})
		    .done(function( data ) {
			    $("#BlankPageGenerator_ResultCode").text(data);
		    });
    });
</script>
