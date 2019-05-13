<?php 
    $url = '';
    if (isset($doc['systemWork'][0]) and isset($doc['idWork'][0])) {
        $reference = new reference($doc['systemWork'][0], $doc['idWork'][0], 'work');
        $url = $reference->url;
    }
?>
<?php if ($url): ?><a href="<?php echo $url; ?>" title="Nachweis in <?php echo $reference->nameSystem; ?>" target="_blank"><?php endif; ?>
<?php echo $doc['titleWork'][0]; ?>
<?php if ($url): ?></a><?php endif; ?>
