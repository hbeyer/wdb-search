<?php 
$personsArray = array();
foreach($doc[$role] as $personString)  {
    $name = '';
    $split = explode('#', $personString);
    if (isset($split[0])) {
        $name = $split[0];
    }
    if (isset($split[1])) {
        $name .= ' <a href="personinfo.php?gnd='.$split[1].'" title="Informationsseite zur Person anzeigen" target="_blank"><span class="glyphicon glyphicon-info-sign"></span></a>';
    }
    if ($name) {
        $personsArray[] = $name;
    }
    // Das Folgende ist ein Notbehelf, weil in den SOLR-XML-Daten Personen teils dublett aufgeführt sind.    
    $personsArray = array_unique($personsArray);
}
echo implode(', ', $personsArray);
?>
