<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 24042016
 * Time: 12:38
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require('../../sdev.inc.php');
if (isset($_POST['clearLog'])){
    clearLog();
}
if (isset($_POST['getLog'])){
    echo getLog();
}
if (isset($_POST['getModalCode'])){
	echo getModalCode();
}
if (isset($_POST['getTabsCode'])){
	echo getTabsCode();
}
if (isset($_POST['getCollapsePanelsCode'])){
	echo getCollapsePanelsCode();
}
if (isset($_POST['getClickableHtmlCode'])){
	echo getClickableHtmlCode();
}
if (isset($_POST['getBlankPageCode'])){
	echo getBlankPageCode();
}
function clearLog() {
    file_put_contents('CustomLog.txt','');
}
function getLog() {
    return file_get_contents('CustomLog.txt');
}
function getModalCode() {
	return '<div class="modal fade" id="'.$_POST['ModalId'].'" tabindex="-1" role="dialog" aria-labelledby="'.$_POST['ModalId'].'Label" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="'.$_POST['ModalId'].'Label">'.$_POST['ModalTitle'].'</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-md-4">
            
            </div>
            <div class="col-md-4">
            
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Trigger the modal using bootstrap\'s data targets -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$_POST['ModalId'].'">
  Launch '.$_POST['ModalTitle'].'
</button>
';
}

function getTabsCode() {
	$TabArray = explode(',',$_POST['TabSet']);
	$html = '<div class="row">
    <div class="col-xs-12">
	<ul class="nav nav-tabs" role="tablist">
	    ';
	$count = 0;
	foreach($TabArray as $Tab) {
		$TabId = $_POST['TabContainer'].'_'.AppSpecificFunctions::getCleanString($Tab);
		$ActiveClass = '';
		if ($count == 1) {
			$html .= '<?php if (AppSpecificFunctions::GetDeviceType() == \'phone\') { ?>
                <li role="presentation" class="dropdown"> <a href="#" class="dropdown-toggle" id="'.$_POST['TabContainer'].'_MoreOptions" data-toggle="dropdown" aria-controls="'.$_POST['TabContainer'].'_MoreOptions-contents">More <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="'.$_POST['TabContainer'].'_MoreOptions" id="'.$_POST['TabContainer'].'_MoreOptions-contents">
                    ';
			$first = true;
			foreach ($TabArray as $InnerTab) {
				$InnerTabId = $_POST['TabContainer'].'_'.AppSpecificFunctions::getCleanString($InnerTab);
				if (!$first) {
					$html .= '<li role="presentation"'.$ActiveClass.'><a href="#'.$InnerTabId.'" aria-controls="'.$InnerTabId.'" role="tab" data-toggle="tab">'.$InnerTab.'</a></li>
		    ';
				}
				$first = false;
			}
			$html .= '
                ';
			$html .= '</ul>
                </li>
	    <?php } else { ?>
	    ';
		}
		if ($count == 0)
			$ActiveClass = ' class="active"';
		$html .= '<li role="presentation"'.$ActiveClass.'><a href="#'.$TabId.'" aria-controls="'.$TabId.'" role="tab" data-toggle="tab">'.$Tab.'</a></li>
	    ';
		$count++;
	}
	$html = substr($html,0,strlen($html)-6);
	$html .= '
            <?php } ?>
	</ul>';
	$html .= '
        <div class="tab-content mrg-top10">
            ';
	
	$first = true;
	foreach ($TabArray as $Tab) {
		$TabId = $_POST['TabContainer'].'_'.AppSpecificFunctions::getCleanString($Tab);
		$ActiveClass = '';
		if ($first)
			$ActiveClass = ' in active';
		$html .= '<div role="tabpanel" class="tab-pane fade'.$ActiveClass.'" id="'.$TabId.'">['.$Tab.' Content]</div>
            ';
		$first = false;
	}
	$html = substr($html,0,strlen($html)-13);
	$html .= '
        ';
	$html .= '</div>';
	$html .= '
    ';
	$html .= '</div>
</div>';
	return $html;
}

function getCollapsePanelsCode() {
	$PanelArray = explode(',',$_POST['PanelSet']);
	$html = '<div class="row">
    <div class="col-xs-12">
        ';
	if (sizeof($PanelArray) == 1){
		$PanelId = $_POST['PanelContainer'].'_'.AppSpecificFunctions::getCleanString($PanelArray[0]);
		$html .= '<div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="'.$PanelId.'">
	      <h4 class="panel-title">
	        <a class="accordion-toggle" role="button" data-toggle="collapse" href="#collapse'.$PanelId.'" aria-expanded="true" aria-controls="collapse'.$PanelId.'">
	          '.$PanelArray[0].'
	        </a>
	      </h4>
	    </div>
	    <div id="collapse'.$PanelId.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="'.$PanelId.'">
	      <div class="panel-body">
	        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
	      </div>
	    </div>
	</div>
    </div>
</div>';
		return $html;
	}
	$html .= '<div class="panel-group" id="'.AppSpecificFunctions::getCleanString($_POST['PanelContainer']).'" role="tablist" aria-multiselectable="true">
            ';
	$first = true;
	foreach ($PanelArray as $Panel) {
		$AnchorCss = ' collapsed';
		$PanelCss = '';
		if ($first) {
			$AnchorCss = '';
			$PanelCss = ' in';
		}
		$PanelId = $_POST['PanelContainer'].'_'.AppSpecificFunctions::getCleanString($Panel);
		$html .= '<div class="panel panel-default">
	        <div class="panel-heading" role="tab" id="'.$PanelId.'">
	          <h4 class="panel-title">
	            <a class="accordion-toggle'.$AnchorCss.'" role="button" data-toggle="collapse" href="#collapse'.$PanelId.'" data-parent="#'.AppSpecificFunctions::getCleanString($_POST['PanelContainer']).'" aria-expanded="true" aria-controls="collapse'.$PanelId.'">
	              '.$Panel.'
	            </a>
	          </h4>
	        </div>
	        <div id="collapse'.$PanelId.'" class="panel-collapse collapse'.$PanelCss.'" role="tabpanel" aria-labelledby="'.$PanelId.'">
	          <div class="panel-body">
	            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
	          </div>
	        </div>
	    </div>
	    ';
		$first = false;
	}
	$html = substr($html,0,strlen($html)-4);
	$html .= '</div>
    </div>
</div>';
	return $html;
}

function getClickableHtmlCode() {
	$ActionName = str_replace(' ','_',trim($_POST['ActionName']));
	$Trigger = '.'.$ActionName;
	if (strlen($_POST['TriggerClass']) > 0) {
		$Trigger = '.'.$_POST['TriggerClass'];
	}
	$Code = 'Variables to declare in controller class:
// Action '.$ActionName.' variables
//===========================================================================
protected $action_'.$ActionName.';
//===========================================================================
// Variable initialization for action '.$ActionName.':
//===========================================================================
$this->action_'.$ActionName.' = new sUIElementsBase($this);
$this->action_'.$ActionName.'->AddAction(new QClickEvent(), new QAjaxAction(\'handleAction_'.$ActionName.'\'));
$js_Action_'.$ActionName.' = \'$(document).on("click","'.$Trigger.'", function() {
            qc.pA(\\\'\'.$this->FormId.\'\\\',\\\'\'.$this->action_'.$ActionName.'->getControlId().\'\\\', \\\'QClickEvent\\\', $(this).attr("id"));
        });
        var style = document.createElement(\\\'style\\\');
        style.type = \\\'text/css\\\';
        style.innerHTML = \\\''.$Trigger.':hover{cursor:pointer;}\\\';
        document.getElementsByTagName(\\\'head\\\')[0].appendChild(style);\';
    AppSpecificFunctions::ExecuteJavaScript($js_Action_'.$ActionName.');
//===========================================================================
// Controller function to handle action '.$ActionName.':
//===========================================================================
protected function handleAction_'.$ActionName.'($strFormId, $strControlId, $strParameter) {
    // Your code to handle the action here
}
//===========================================================================
// Html for clickable component:
//===========================================================================
<span id="[TO BE SET]" class="'.$_POST['TriggerClass'].'">[Component HTML here]</span>
//===========================================================================';
	
	return $Code;
}
function getBlankPageCode() {
	$PageVariableName = str_replace(' ','_',trim($_POST['PageName']));
	return '
Controller File Code:
=============================================================================
<?php
require(\'../../sdev.inc.php\');
require(__PAGE_CONTROL__.\'/pageManager.php\');

if (!AppSpecificFunctions::checkPageAccess(array(\'User\')))
    AppSpecificFunctions::Redirect(__USRMNG__.\'/login/\');

class '.$PageVariableName.'Form extends QForm {
	public function Form_Create() {
        parent::Form_Create();
    }
}
'.$PageVariableName.'Form::Run(\''.$PageVariableName.'Form\');

?>
=============================================================================

Template File Code:
=============================================================================
<?php $strPageTitle = \''.$_POST['PageName'].'\';?>
<?php require(__CONFIGURATION__ . \'/header_with_nav.inc.php\');?>

<?php $this->RenderBegin();?>
<h3 class="page-header">'.$_POST['PageName'].' page</h3>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>
=============================================================================';
}
?>


