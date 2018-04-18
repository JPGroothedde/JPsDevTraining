<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 22042016
 * Time: 14:47
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
?>
<script>
    // JS Config
    var baseUrl = '<?php echo AppSpecificFunctions::getBaseUrl();?>/';
    var connectionCheckInterval = 45000;
    <?php if (DEV_MODE) {?>
    var isInDevMode = true;
    <?php } else {?>
    var isInDevMode = false;
    <?php } ?>
    var isDevContentLoaded = false;
    var CheckableControlArray = {};
    var canRemoveNotedFeedback = true;

    var FavIconUrl = '<?php echo AppSpecificFunctions::getBaseUrl();?>/assets/images/apple-touch-icon-57x57.png';
    
    var mustCheckConnection = true;
</script>
