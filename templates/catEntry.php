<!-- Hier muss der Titel des Altkatalogs und ein Link zum Digitalisat eingefügt werden -->
<?php if (isset($doc['nameCollection'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Sammlung</i></div>
    <div class="col-sm-10"><?php echo $doc['nameCollection'][0]; ?><?php if (isset($doc['dateCollection'][0])): ?> (<?php echo $doc['dateCollection'][0]; ?>)<?php endif; ?><?php if (isset($doc['GeoBrowserLink'][0])): ?> <a href="<?php echo $doc['GeoBrowserLink'][0]; ?>" title="Sammlungsübersicht im GeoBrowser" target="_blank"><span class="glyphicon glyphicon-globe"></span></a><?php endif; ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['owner'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Besitzer(in)</i></div>
    <div class="col-sm-10"><?php echo $doc['owner'][0]; ?><?php if (isset($doc['ownerGND'])): ?> <a href="personinfo.php?gnd=<?php echo $doc['ownerGND'][0]; ?>" title="Informationsseite zur Person anzeigen" target="_blank"><span class="glyphicon glyphicon-info-sign"></span></a><?php endif; ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['titleCat'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Eintrag</i></div>
    <div class="col-sm-10">&bdquo;<?php echo $doc['titleCat'][0]; ?>&rdquo;<?php if (isset($doc['pageCat'][0]) or isset($doc['numberCat'][0])): ?> (<?php if (isset($doc['pageCat'][0])): ?>S. <?php echo $doc['pageCat'][0]; ?><?php endif; ?><?php if (isset($doc['pageCat'][0]) and isset($doc['numberCat'][0])): ?>, <?php endif; ?><?php if (isset($doc['numberCat'][0])): ?>Nr. <?php echo $doc['numberCat'][0]; ?><?php endif; ?>)<?php endif; ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['histSubject'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Rubrik</i></div>
    <div class="col-sm-10">&bdquo;<?php echo $doc['histSubject'][0]; ?>&rdquo;</div>
</div>
<?php endif; ?>
