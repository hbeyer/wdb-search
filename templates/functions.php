<?php

function makeNavigation() {
    $categories = array(
        'search.php' => array('label' => 'Suchmaschine', 'active' =>  '')
    );

    $chunks = explode('/', $_SERVER['SCRIPT_FILENAME']);
    $current = array_pop($chunks);
    if (isset($categories[$current])) {
        $categories[$current]['active'] = ' class="active"';
    }
    include('navigation.php');
}

function correctURL($url) {
    $string = strtr($url, array('&amp;' => '&'));
    return($url);
}

// Legt fest, ob eine von Solr übermittelte Facette angezeigt werden soll
function hasMatches($facetArray) {
    foreach ($facetArray as $value => $count) {
        if ($count > 0) {
            return(true);
        }
    }
    return(false);
}


// Zur Erzeugung des Footers wird templates/footer.php direkt eingebunden

/*
function makeOSMLink($coordinates) {
    $link = '';
    $coordinates = explode(',', $coordinates);
    if (isset($coordinates[0]) and isset($coordinates[1])) {
        $link = 'https://www.openstreetmap.de/karte.html?zoom=12&lat='.$coordinates[0].'&lon='.$coordinates[1].'&layers=B000TT';
        }
    return($link);
}

function translateMediaType($type) {
	$translation = array(
		'Book' => 'Druck',
		'Manuscript' => 'Handschrift',
		'Physical Object' => 'Objekt'
		);
	$result = strtr($type, $translation);
	return($result);		
}

function translateAnchor($anchor) {
	$translate = array('Ä' => 'ae', 'Ö' => 'oe', 'Ü' => 'ue', 'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'ß' => 'ss', ' ' => '', '&' => 'et');
	$anchor = strtr($anchor, $translate);
	return($anchor);
}

function makeLinksHAB($shelfmarkString) {
        $shelfmarks = explode(';', $shelfmarkString);
        $translation = array('(' => '', ')' => '');
        $linksCopiesHAB = array();
        foreach ($shelfmarks as $shelfmark) {
            $shelfmarkSearch = urlencode(strtr($shelfmark, $translation));
            $linksCopiesHAB[] = '<a href="http://opac.lbs-braunschweig.gbv.de/DB=2/SRCH?TRM=sgb+'.$shelfmarkSearch.'" title="Exemplar im OPAC suchen" target="_blank">'.$shelfmark.'</a>';
        }
        return(implode(', ', $linksCopiesHAB));
}

// Die Funktion ersetzt kombinierende diakritische Zeichen (hier nicht als solche erkennbar) durch HMLT-Entities, um die versetzte Darstellung der Punkte in Firefox zu beheben.
function replaceUml($string) {
	$translate = array('Ä' => '&Auml;', 'Ö' => '&Ouml;', 'Ü' => '&Uuml;', 'ä' => '&auml;', 'ö' => '&ouml;', 'ü' => '&uuml;', 'ë' => '&euml;');
	$string = strtr($string, $translate);
	return($string);
}


*/

?>
