<?php

function convertSplitArray($array, $prefix = '') {
	$result = array('#' => array_shift($array));
	$key = null;
	foreach ($array as $value) {
		if ($key === null) {
			$key = '#'.$prefix.$value;
		}
		else {
			$result[$key] = $value;
			$key = null;
		}
	}
	return($result);
}

function processText($index, $blanks = false) {
	if ($blanks == true) {
		$index = array_map('insertAdditionalBlanks', $index);
	}
	$index = array_map('strip_tags', $index); // Hierbei müssen nur durch Tags getrennte Wörter zusätzlich getrennt in den Index eingespielt werden.
	$index = array_map('removeArrows', $index);
	$index = array_map('normalizeSpace', $index);
	$index = array_map('trim', $index);
	return($index);
}

function normalizeSpace($string) {
	$result = preg_replace('/\s+/', ' ', $string);
	return($result);
}

function insertAdditionalBlanks($string) {
	$result = strtr($string, array('<a href="javascript:void(0)' => ' <a href="javascript:void(0)'));
	return($result);
}

function removeArrows($string) {
	$translation = array('<' => '', '>' => '', '&lt;' => '', '&gt;' => '');
	return(strtr($string, $translation));
}

?>