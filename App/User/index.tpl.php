<?php $strPageTitle = 'User Home';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>
<style>
    .JpSeTimestamp {
        font-size: 10px;
        color: #949494;
    }
</style>
<?php
if (!checkRole(array('User')))
	AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
?>
<?php $this->RenderBegin();?>

<div class="container">
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="background-color: #FFFFFF; padding: 15px; padding-bottom: 40px; margin-bottom: 10px; margin-top: 15px; border-radius: 10px;">
        <?php $this->NewPostInputBox->Render();?><?php $this->btnProcessNewPost->Render(); ?>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"><a id="ReloadLink" style="display:none;" href="javascript:location.reload();">There are new posts available...</a></div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" id="PostData">
        <?php $this->HtmlResults->Render(); ?>
    </div>
    <div class="col-md-2"></div>
</div>
</div>
<!-- Modal -->
    <div class="modal fade" id="PostCommentModal" tabindex="-1" role="dialog" aria-labelledby="PostCommentModalLabel" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="PostCommentModalLabel">Post Comment</h4>
                </div>
                <div class="modal-body">
                <?php $this->PostCommentInputBox->Render(); ?>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <?php $this->btnPostNewComment->Render();?>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal End -->
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script type="text/javascript">
    $(window).scroll(function () {
        if($(window).scrollTop()+$(window).height() >= $(document).height()) {
            //alert("Test");
            qc.pA("<?php echo $this->FormId;?>","<?php echo $this->action_HandlePageRequest->getJqControlId();?>","QClickEvent", "loadmore");
        }
    });
    setInterval(function() {
        if (!$("#ReloadLink").is(":visible")) {
            qc.pA("<?php echo $this->FormId;?>","<?php echo $this->action_HandlePageRequest->getJqControlId();?>","QClickEvent", "checknewposts");
        }
    },10000)
</script>