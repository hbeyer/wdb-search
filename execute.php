<?php

set_time_limit(1200);
require('vendor/autoload.php');

$edition = new edition('000228', 'christian2');
$repository = new index_repository;
$edition->extractIndexUnits($repository);
$repository->serializeSolrXML();

?>
