<?php foreach ($this->responsePHP['facet_counts']['facet_fields'] as $field => $facetArray): ?>
<?php if (hasMatches($facetArray) == true): ?>
                <h4><?php echo $this->facet_fields[$field]; ?> <i class="fas fa-dot-circle"></i></h4>
                <ul id="facet-<?php echo $field; ?>">
<?php 
    $count = 0;
    $max = 10;
    $class = '';
?>
<?php foreach ($facetArray as $value => $hits): ?>
<?php if ($hits > 0): ?>
<?php 
    if ($count > $max) {
        $class = ' class="overhang"';
    }
    $count++;
?>
                    <li<?php echo $class; ?>><a href="<?php echo $this->buildFacetLink($field.':'.$value); ?>" class="facetLink"><?php echo $value; ?></a> <span class="badge"><?php echo $hits; ?></span></li>
<?php endif; ?>
<?php endforeach; ?>
<?php if ($class != ''): ?>
                    <li class="link-expand"><a href="javascript:expandFacet('facet-<?php echo $field; ?>', '<?php echo $count; ?>')">Alle <?php echo $count; ?></a></li>
<?php endif; ?>
                </ul>
<?php endif; ?>
<?php endforeach; ?>
