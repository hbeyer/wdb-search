<?php if (!empty($doc['titleEdition'][0])): ?>
<div class="row">
<div class="col-sm-2"><i>Edition</i></div><div class="col-sm-10"><?php echo $doc['titleEdition'][0]; ?> (Edoc <?php echo $doc['edoc'][0]; ?>)</div>
</div>
<?php endif; ?>
<?php if (!empty($doc['title'][0])): ?>
<div class="row">
<div class="col-sm-2"><i>Dokument</i></div><div class="col-sm-10"><?php echo $doc['title'][0]; ?></div>
</div>
<?php endif; ?>
<?php if (!empty($doc['date'][0])): ?>
<div class="row">
<div class="col-sm-2"><i>Datum</i></div><div class="col-sm-10"><?php echo $doc['date'][0]; ?></div>
</div>
<?php endif; ?>
<?php if (!empty($doc['author'][0])): ?>
<div class="row">
<div class="col-sm-2"><i>Autor(inn)en</i></div><div class="col-sm-10"><?php echo implode('; ', $doc['author']); ?></div>
</div>
<?php endif; ?>
<?php if (!empty($doc['editor'][0])): ?>
<div class="row">
<div class="col-sm-2"><i>Editor(inn)en</i></div><div class="col-sm-10"><?php echo implode('; ', $doc['editor']); ?></div>
</div>
<?php endif; ?>
<?php if (!empty($doc['funder'][0])): ?>
<div class="row">
<div class="col-sm-2"><i>Förderer</i></div><div class="col-sm-10"><?php echo $doc['funder'][0]; ?></div>
</div>
<?php endif; ?>