<?php include('templates/numFound.php'); ?>
<?php $countDocs = 0; ?>
<div class="panel-group">
<?php foreach ($this->responsePHP['response']['docs'] as $doc): ?>
<?php
    include('templates/doc.php');
    $countDocs++;
?>
<?php endforeach; ?>
</div>
