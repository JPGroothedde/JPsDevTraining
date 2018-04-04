<?php $strPageTitle = 'Side Bars Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav_fluid.inc.php');?>

<?php $this->RenderBegin();?>
<h1>Side Bars Example</h1>
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae purus ac mi luctus cursus. Integer molestie metus vel malesuada mattis. Vestibulum vehicula vel tortor non varius. Quisque blandit, risus eu eleifend rutrum, mi neque tempus erat, a maximus lacus urna eget nibh. Proin turpis arcu, pharetra eu purus vel, feugiat rhoncus felis. Quisque interdum interdum massa. Quisque ut libero fringilla, vehicula orci eu, auctor mauris. Nullam malesuada pharetra leo non molestie. Integer elementum sed dolor quis sagittis.</p>

        <p>Donec vel sapien vitae sapien semper laoreet id eget lectus. Nunc ac leo faucibus, maximus sem eu, molestie dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean molestie, eros ut lobortis porttitor, velit velit porttitor ipsum, eu mattis nulla odio id felis. Etiam eleifend libero sodales ullamcorper placerat. Mauris laoreet finibus dignissim. Nulla a risus sapien. Integer efficitur tellus a neque egestas, vitae commodo ipsum porttitor. Pellentesque sodales in tellus id rutrum. Duis finibus lectus ac tempor pharetra. Aenean lacinia in urna at fermentum. Phasellus vitae gravida est. Maecenas rhoncus vel augue a pretium.</p>

        <p>Pellentesque non lacus vel nisl consectetur porta et nec dui. Morbi dictum mauris non nibh faucibus, nec iaculis neque tincidunt. Aliquam euismod velit commodo vehicula porttitor. Nam accumsan posuere justo et vulputate. Praesent at facilisis nisl. Donec id lorem vitae lacus dignissim tincidunt vel vitae sapien. Vestibulum a ligula hendrerit purus porttitor sollicitudin aliquam in eros. Cras tincidunt magna a auctor gravida. Suspendisse in feugiat sapien, ac faucibus metus. Phasellus at consectetur orci. Quisque non gravida nunc. Aliquam erat volutpat. Proin rhoncus urna id nisi fermentum, id iaculis libero luctus. Maecenas quis convallis arcu. Maecenas cursus auctor rhoncus. Nam sit amet elementum tortor.</p>

        <p>Aenean id turpis dapibus, eleifend augue id, consectetur nibh. Vestibulum condimentum erat ac arcu posuere placerat. Donec quis metus ex. Vestibulum magna lacus, mollis in magna et, hendrerit laoreet diam. Aenean imperdiet, tortor id fringilla elementum, neque nisl gravida ligula, eget elementum dui ipsum vel libero. Nullam imperdiet finibus nibh quis ornare. Nulla lobortis quam eu magna semper, ut sagittis nibh volutpat. Ut ex tellus, tincidunt sodales dolor nec, rutrum venenatis turpis.</p>

        <p>Donec sagittis arcu ac bibendum dignissim. Sed semper diam eros, quis luctus odio rutrum viverra. Vivamus rutrum sagittis enim, ultrices vestibulum eros tincidunt vitae. Phasellus volutpat quis lorem at pharetra. Morbi a tellus faucibus, tempor lorem in, congue urna. Curabitur luctus risus et quam vestibulum cursus. Pellentesque sit amet lectus quis arcu porta blandit. Vivamus mollis erat sed turpis sagittis rhoncus. Fusce metus ex, ornare quis nisl sit amet, finibus pharetra orci. Etiam elit velit, condimentum finibus mollis sit amet, mattis ut urna. Duis finibus, purus non porttitor commodo, mauris lectus mollis lectus, eu rhoncus odio tellus at est.</p>


    </div>
</div>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>addSideBar('LEFT','250','','','','','','','','','main','Test2',true)</script>
<script>addSideBar('RIGHT','100','','','','','','','','','dummy','Test3',false)</script>

