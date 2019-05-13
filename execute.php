<?php

set_time_limit(1200);
require('vendor/autoload.php');

$edition = new edition('000228', 'christian2', 'Tagebücher des Fürsten Christian II. von Anhalt-Bernburg');
$repository = new index_repository;
$edition->extractIndexUnits($repository);
$repository->serializeSolrXML('christian2-solr.xml');

?>
