<?php
$from = $this->start + 1;
$to = $from + $this->rows -1;
if ($from > $this->numFound)  {
    $from = $this->numFound;
}
if ($to > $this->numFound)  {
    $to = $this->numFound;
}
?>
<div class="well well-sm" style="text-align:center;">
    <div style="float:left;">
        <?php if ($this->start > 0): ?>
        <a href="<?php echo $this->buildPaginationLink(0); ?>" class="link-glyphicon" title="An den Anfang"><span class="glyphicon glyphicon-fast-backward"></span></a>
        <?php endif; ?>
        <?php if (($this->start - $this->rows) > 0): ?>
        <a href="<?php echo $this->buildPaginationLink($this->start - $this->rows); ?>" class="link-glyphicon" title="Zurück"><span class="glyphicon glyphicon-backward"></span></a>
        <?php endif; ?>
    </div>
    Zeige Treffer <?php echo $from; ?> bis <?php echo $to; ?> von <?php echo $this->numFound; ?>
    <div style="float:right;">
        <?php if (($this->numFound - $to) > 0 ): ?>
        <a href="<?php echo $this->buildPaginationLink($this->start + $this->rows); ?>" class="link-glyphicon" title="Nächste Seite"><span class="glyphicon glyphicon-forward"></span></a>
        <?php endif; ?>
        <?php if (($this->numFound - $this->start) > $this->rows): ?>
        <a href="<?php echo $this->buildPaginationLink($this->numFound - $this->rows); ?>" class="link-glyphicon" title="Ans Ende"><span class="glyphicon glyphicon-fast-forward"></span></a>
        <?php endif; ?>
    </div>
</div>
