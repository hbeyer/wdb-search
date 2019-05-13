<div class="row">
    <div class="col-sm-2"><i>Originalexemplar</i></div>
    <div class="col-sm-10"><?php if (isset($doc['institutionOriginal'])): ?><?php echo $doc['institutionOriginal'][0]; ?><?php endif; ?><?php if (isset($doc['shelfmarkOriginal'])): ?>, <?php echo $doc['shelfmarkOriginal'][0]; ?><?php endif; ?><?php if (isset($doc['originalLink'])): ?> | <a href="<?php echo $doc['originalLink'][0]; ?>" title="Originalexemplar im OPAC anzeigen" target="_blank">OPAC</a><?php endif; ?><?php if (isset($doc['digitalCopyOriginal'])): ?> | <a href="<?php echo $doc['digitalCopyOriginal'][0]; ?>" title="Digitalisat des Originalexemplars anzeigen" target="_blank">Digitalisat</a><?php endif; ?>
</div>
<?php if (isset($doc['provenanceAttribute'][0])): ?>
    <div class="col-sm-2"><i>Provenienzhinweis</i></div>
    <div class="col-sm-10"><?php echo $doc['provenanceAttribute'][0]; ?></div>
<?php endif; ?>
</div>
