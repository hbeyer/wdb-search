<?php echo $doc['place_1'][0]; ?><?php if (isset($doc['coordinates_place_1'][0])): ?> <a href="<?php echo makeOSMLink($doc['coordinates_place_1'][0]); ?>" title="Auf Karte anzeigen" target="_blank"><span class="glyphicon glyphicon-globe"></span></a><?php endif; ?>
<?php if (isset($doc['place_2'][0])): ?>
, <?php echo $doc['place_2'][0]; ?><?php if (isset($doc['coordinates_place_2'][0])): ?> <a href="<?php echo makeOSMLink($doc['coordinates_place_2'][0]); ?>" title="Auf Karte anzeigen" target="_blank"><span class="glyphicon glyphicon-globe"></span></a><?php endif; ?>
<?php endif; ?>
