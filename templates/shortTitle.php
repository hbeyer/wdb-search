<?php
$title = '';
if (isset($doc['titleNormalized'][0])) {
    $title = $doc['titleNormalized'][0];
}
elseif (isset($doc['titleBib'][0])) {
    $title = $doc['titleBib'][0];
}
elseif (isset($doc['titleCat'][0])) {
    $title = $doc['titleCat'][0];
}
else {
    $title = '[Ohne Titel]';
}
if (strlen($title) > 140) {
    if (mb_substr($title, 140, 1, 'UTF-8') == ' ')  {
        $title = mb_substr($title, 0, 140, 'UTF-8').'&nbsp;&hellip;';
    }
    else {
        $title = mb_substr($title, 0, 140, 'UTF-8').'&hellip;';
    }
}
$authors = '';
if (isset($doc['author'])) {
    $authorArray = array();
    foreach ($doc['author'] as $singleAuthor) {
        $authorArray[] = explode('#', $singleAuthor)[0];
    }
    $authors = implode('/', $authorArray).': ';
}
$places = '';
if (isset($doc['place_1'][0])) {
    $places = ', '.$doc['place_1'][0];
    if (isset($doc['place_2'][0])) {
        $places .= '/'.$doc['place_2'][0];
    }
}
$publisher = '';
if (isset($doc['publisher_str'][0])) {
        if ($places == '') {
            $publisher = ', '.$doc['publisher_str'][0];
        }
        else {
            $publisher = ': '.$doc['publisher_str'][0];            
        }
    }
$year = ', ohne Jahr';
if (isset($doc['year'][0])) {
    $year = ', '.$doc['year'][0];
}
?>
<?php echo $authors.$title.$places.$publisher.$year; ?>&nbsp;<a data-toggle="collapse" href="#collapse<?php echo $countDocs; ?>" class="link-glyphicon"><span class="glyphicon glyphicon-plus-sign"></span></a>

