<?php
$id = $doc['id'];
$highlighting = $this->responsePHP['highlighting'][$id];
?>
<?php if (empty($highlighting)): ?>
	<?php echo substr($doc['fullText'][0], 0, 140).' &hellip;'; ?>
	<?php //var_dump($highlighting); ?>
<?php else: ?>
<?php foreach ($highlighting as $field => $snippets): ?>
<p><?php echo implode(' &hellip; ', $snippets); ?></p>
<?php endforeach; ?>
<?php endif; ?>