<?php if (isset($doc['genres'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Gattung</i></div>
    <div class="col-sm-10"><?php echo implode(', ', $doc['genres']); ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['subjects'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Inhalt</i></div>
    <div class="col-sm-10"><?php echo implode(', ', $doc['subjects']); ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['languagesFull'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Sprache</i></div>
    <div class="col-sm-10"><?php echo implode(', ', $doc['languagesFull']); ?></div>
</div>
<?php endif; ?>
