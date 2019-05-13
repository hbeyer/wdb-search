<div class="panel panel-default">
    <div class="panel-heading">
        <?php 
        include('templates/shortTitle.php'); 
        ?>
    </div>
    <div id="collapse<?php echo $countDocs; ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="row"><div class="col-sm-2"><i>ID</i></div><div class="col-sm-10"><a href="search.php?field=id&value=<?php echo $doc['id']; ?>" title="Permalink auf diesen Datensatz" target="_blank"><?php echo $doc['id']; ?></a></div></div>
<?php if (isset($doc['author'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Autor(inn)en</i></div><div class="col-sm-10"><?php $role = 'author'; include('templates/persons.php'); ?></div></div>
<?php endif;?>
<?php if (isset($doc['contributor'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Beiträger(innen)</i></div><div class="col-sm-10"><?php $role = 'contributor'; include('templates/persons.php'); ?></div></div>
<?php endif;?>
<?php if (isset($doc['titleBib'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Titel Ausgabe</i></div><div class="col-sm-10"><?php echo $doc['titleBib'][0]; ?></div></div>
<?php endif; ?>
<?php if (isset($doc['titleWork'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Enthaltenes Werk</i></div>
    <div class="col-sm-10"><?php include('templates/work.php'); ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['place_1'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Ort</i></div><div class="col-sm-10"><?php include('templates/places.php'); ?></div></div>
<?php endif; ?>
<?php if (isset($doc['publisher'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Drucker(innen)</i></div><div class="col-sm-10"><?php echo $doc['publisher'][0]; ?></div></div>
<?php endif; ?>
<?php if (isset($doc['year'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Jahr</i></div><div class="col-sm-10"><?php echo $doc['year'][0]; ?></div></div>
<?php endif; ?>
<?php if (isset($doc['mediaType'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Medium</i></div>
    <div class="col-sm-10"><?php echo translateMediaType($doc['mediaType'][0]); ?><?php if (isset($doc['bound'][0])): ?><?php if ($doc['bound'][0] == 0): ?>, ungebunden<?php endif; ?><?php endif; ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['volumes'][0])): ?>
<?php if ($doc['volumes'][0] > 1): ?>
<div class="row">
    <div class="col-sm-2"><i>Bände</i></div>
    <div class="col-sm-10"><?php echo $doc['volumes'][0]; ?></div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php if (isset($doc['format'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Format</i></div>
    <div class="col-sm-10"><?php echo $doc['format'][0]; ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['titleManifestation'][0]) and isset($doc['linkManifestation'][0])): ?>
            <div class="row"><div class="col-sm-2"><i>Nachweis</i></div><div class="col-sm-10"><a href="<?php echo $doc['linkManifestation'][0]; ?>" title="Nachweis dieser Ausgabe in <?php echo $doc['titleManifestation'][0]; ?>" target="_blank"><?php echo $doc['titleManifestation'][0]; ?></a></div></div>
<?php endif; ?>
<?php if (isset($doc['comment'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Kommentar</i></div>
    <div class="col-sm-10"><?php echo $doc['comment'][0]; ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['digitalCopy'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Digitalisat</i></div>
    <div class="col-sm-10"><a href="<?php echo $doc['digitalCopy'][0]; ?>" title="Digitalisat anzeigen" target="_blank"><?php echo $doc['digitalCopy'][0]; ?></a></div>
</div>
<?php endif; ?>
<?php if (isset($doc['copiesHAB'][0])): ?>
<div class="row">
    <div class="col-sm-2"><i>Exemplare HAB</i></div>
    <div class="col-sm-10"><?php echo makeLinksHAB($doc['copiesHAB'][0]); ?></div>
</div>
<?php endif; ?>
<?php if (isset($doc['languagesFull'][0]) or isset($doc['subjects'][0]) or isset($doc['genres'][0])): ?>
<hr />
<?php include('templates/subjectInfo.php'); ?>
<?php endif; ?>
<?php if (isset($doc['titleCat'][0]) or isset($doc['owner'][0]) or isset($doc['nameCollection'][0]) or isset($doc[''][0])): ?>
<hr />
<?php include('templates/catEntry.php'); ?>
<?php endif; ?>
<?php if (isset($doc['institutionOriginal'][0]) or isset($doc['shelfmarkOriginal'][0])): ?>
<hr />
<?php include('templates/originalItem.php'); ?>
<?php endif; ?>
        </div>
    </div>
</div>
