<?php

/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 07082016
 * Time: 16:16
 * @package    ${NAMESPACE}
 * @subpackage AppMenus
 * @author     johangriesel <info@stratusolve.com>
 */
abstract class AppMenus {
    /**
     * AppMenus constructor.
     * @throws QCallerException
     */
    public final function __construct() {
        throw new QCallerException('Menu class cannot be instantiated...');
    }

    /**
     * @param string $MenuName
     * @param string $Type
     * @param string $PageTitle
     * @param bool $ShowBranding
     * @param string $BrandingHtml
     * @param string $Id
     * @return string
     */
    public static function getMenu($MenuName = 'Default', $Type = MenuType::navbar, $PageTitle = '', $ShowBranding = false, $BrandingHtml = '', $Id = 'Menu_1',$FullWidth = false) {
        $functionName = $MenuName.'Menu';
        $items = AppMenus::$functionName();
        $FullWidthCss = 'container-fluid';
        if (!$FullWidth && (($Type != MenuType::navbar) && ($Type != MenuType::navbarInverse)))
            $FullWidthCss = 'container';
        $navHtml = '<nav id="'.$Id.'" class="navbar '.$Type.'">
                      <div class="'.$FullWidthCss.'">';
        if ($ShowBranding) {
            $navHtml .= '<!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse_'.$Id.'" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="#">'.$BrandingHtml.'</a>
                        </div>';
        } else {
            $navHtml .= '<!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse_'.$Id.'" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>';
        }
        $navHtml .= '<!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="collapse_'.$Id.'">';

        $LeftItems = array();
        $RightItems = array();
        foreach ($items as $item) {
            if ($item->Position != 'Right')
                array_push($LeftItems,$item);
            else
                array_push($RightItems,$item);
        }
        $currentUser = getCurrentAccount();
        $UserRoleToCompare = '';
        if ($currentUser) {
            $currentRole = $currentUser->UserRoleObject;
            if ($currentRole)
                $UserRoleToCompare = $currentRole->Role;
        }
        $navHtml .= '<ul class="nav navbar-nav">';
        $navHtml .= AppMenus::renderMenuItems($LeftItems,$UserRoleToCompare,$PageTitle);
        $navHtml .= '</ul>';

        $navHtml .= '<ul class="nav navbar-nav navbar-right">';
        $navHtml .= AppMenus::renderMenuItems($RightItems,$UserRoleToCompare,$PageTitle);
        $navHtml .= '</ul>';

        $navHtml .= '</div><!-- /.navbar-collapse -->
                      </div><!-- /.container-fluid -->
                    </nav>';
        return $navHtml;
    }

    /**
     * @param null $ItemArray
     * @param string $UserRoleToCompare
     * @param string $PageTitle
     * @return string
     */
    public static function renderMenuItems($ItemArray = null, $UserRoleToCompare = '', $PageTitle = '') {
        if (!$ItemArray)
            return '';
        $html = '';
        foreach ($ItemArray as $item) {
            $activeClass = '';
            if ($item->CheckMenuItemUserRole($UserRoleToCompare)) {
                if (is_array($item->PageTitle)) {
                    if (in_array($PageTitle,$item->PageTitle)) {
                        $activeClass = 'active';
                    }
                } else {
                    if ($item->PageTitle == $PageTitle)
                        $activeClass = 'active';
                }
                if ($item->SubItemsArray) {
                    $html .= '<li class="dropdown '.$activeClass.'">
                              <a href="#" class="dropdown-toggle rippleclick" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$item->DisplayName.' <span class="caret"></span></a>
                              <ul class="dropdown-menu">';
                    $html .= AppMenus::renderMenuItems($item->SubItemsArray,$UserRoleToCompare,$PageTitle);
                    $html .= '</ul>
                            </li>';
                } else {
                    if ($item->Group)
                        $html .= '<li role="separator" class="divider"></li>';
                    $theClickId = '';
                    if (strlen($item->ClickActionId) > 0) {
                        $theClickId = 'id="'.$item->ClickActionId.'"';
                        $js = '$("#'.$item->ClickActionId.'").on("click", function() {
                            '.$item->ClickActionsJS.'
                        });';
                        AppSpecificFunctions::ExecuteJavaScript($js);
                    }
                    $theCssClass = '';
                    if (strlen($item->CssClass) > 0)
                        $theCssClass = 'class="'.$item->CssClass.'"';
                    $html .= '<li class="'.$activeClass.' rippleclick"><a '.$theCssClass.' '.$theClickId.' href="'.$item->URL.'">'.$item->DisplayName.'</a></li>';
                }
            }
        }
        return $html;
    }


    // Place your menu functions below
    public static function DefaultMenu() {
        $currentUser = getCurrentAccount();
        $UserNameToDisplay = 'My Details';
        if ($currentUser) {
            $UserNameToDisplay = $currentUser->FirstName;
        }

        $items = array(new MenuItem(array('User','Administrator'),$UserNameToDisplay,'#','Right','','','User Home',false,
                        array(new MenuItem(array('User','Administrator'),'My Account',__USRMNG__.'/account_edit/','','','My Account'),
                            new MenuItem(array('User','Administrator'),'Logout',__USRMNG__.'/logout/','','','','',true))),
            new MenuItem(array('Administrator'),'Accounts',__SUBDIRECTORY__.'/App/Administrator/Account_Overview/','Left','','','Account Overview'),
            new MenuItem(array('Administrator'),'Posts',__SUBDIRECTORY__.'/App/Administrator/Post_Overview/','Left','','','Post Overview'),
            new MenuItem(array('Administrator'),'API Keys',__SUBDIRECTORY__.'/App/Administrator/ApiKey_Overview/','Left','','','API Keys'),
            new MenuItem(array('Administrator'),'Audit Log',__SUBDIRECTORY__.'/App/Administrator/AuditLogEntry_Overview/','Left','','','AuditLogEntry Overview'),
            new MenuItem(array('Administrator'),'Page Views',__SUBDIRECTORY__.'/App/Administrator/PageView_Overview/','Left','','','PageView Overview'),
            new MenuItem(array('Administrator'),'Email History',__SUBDIRECTORY__.'/App/Administrator/EmailMessage_Overview/','Left','','','Email History'),
            new MenuItem(array('Administrator'),'Email Templates',__SUBDIRECTORY__.'/App/Administrator/EmailTemplate_Overview/','Left','','','Email Template Overview'),
            new MenuItem(array('User','Administrator'),'Profile Picture',__SUBDIRECTORY__.'/sDevORM/Implementations/ProfilePicture/index.php','Right','','','Profile Picture'),);
        return $items;
    }

    /**
     * @return array The menu items for this menu
     */
    public static function ExampleMenu() {
        $items = array(new MenuItem(array('User'),'Item1','#','Left','TestClickMe','alert("Hi! You can call any javascript function here. Simply define it in the page helper js file");','',false,null,'Test'),
            new MenuItem(array('User'),'Item2','#','Right','','','User Home',false,
                array(new MenuItem(array('User'),'SubItem1'),
                    new MenuItem(array('User'),'SubItem2','http://google.com','','','','',true))),
            new MenuItem(array('User'),'Item3'),
            new MenuItem(array('User'),'Item4'));
        return $items;
    }
}

/**
 * Class MenuType
 */
abstract class MenuType {
    const navbar = 'navbar-default';
    const navbarInverse = 'navbar-inverse';
    const navbarFixedTop = 'navbar-default navbar-fixed-top';
    const navbarInverseFixedTop = 'navbar-inverse navbar-fixed-top';
}

/**
 * Class MenuItem
 */
class MenuItem {
    public $AllowedUserRoles;
    public $DisplayName,$URL,$ClickActionId,$ClickActionsJS,$PageTitle,$Position,$Group,$CssClass;
    public $SubItemsArray;

    /**
     * MenuItem constructor.
     * @param null $AllowedUserRoles The User roles that are allowed to see this menu item
     * @param string $DisplayName The label that will be displayed on the menu
     * @param string $URL The url that the menu item will navigate to
     * @param string $Position Either "Left" or "Right, based on bootstrap's nav positions
     * @param string $ClickActionId The id to use when implementing click actions (We need to ensure that this is unique)
     * @param string $ClickActionsJS The javascript to execute when the item is clicked.
     * @param string $PageTitle The page title that will cause this item to be active
     * @param bool $Group If this is true, the drop down menu item will have a divider line above it
     * @param null $SubItemsArray This is an array of MenuItems that will be used to create a submenu in the current menu
     * @param string $CssClass An optional css class for styling purposes
     */
    public function __construct($AllowedUserRoles = null, $DisplayName = 'Item', $URL = '#', $Position = 'Left', $ClickActionId = '', $ClickActionsJS = '', $PageTitle = '', $Group = false, $SubItemsArray = null, $CssClass = '') {
        $this->AllowedUserRoles = $AllowedUserRoles;
        $this->DisplayName = $DisplayName;
        $this->URL = $URL;
        $this->Position = $Position;
        $this->ClickActionId = $ClickActionId;
        $this->ClickActionsJS = $ClickActionsJS;
        $this->PageTitle = $PageTitle;
        $this->Group = $Group;
        $this->CssClass = $CssClass;
        $this->SubItemsArray = $SubItemsArray;
    }

    /**
     * @param string $RoleToCheck
     * @return bool
     */
    public function CheckMenuItemUserRole($RoleToCheck = '') {
        if (!$this->AllowedUserRoles)
            return true;
        if (in_array($RoleToCheck,$this->AllowedUserRoles))
            return true;
        return false;
    }
}