<?php if (!empty($doc['url'][0]) and !empty($doc['title'][0])): ?>
<?php
    $url = correctURL($doc['url'][0]);
    $title = $doc['title'][0];
?>
<a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a>
<?php endif; ?>
