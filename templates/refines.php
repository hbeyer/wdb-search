<div class="panel panel-default">
    <div class="panel-heading">Eingeschränkt auf</div>
    <div class="panel-body">
<?php foreach ($_GET['refine'] as $refine): ?>
        <?php 
            $removeLink = $this->buildRemoveLink($refine); 
            $contentRefine = $this->getRefineContent($refine);
        ?>
        <p><?php echo $contentRefine['label']; ?>: <?php echo $contentRefine['content']; ?> <a href="<?php echo $removeLink; ?>" class="link-glyphicon" title="Diese Einschränkung aufheben"><span class="glyphicon glyphicon-remove"></span></a></p>
<?php endforeach; ?>
</div>
</div>
