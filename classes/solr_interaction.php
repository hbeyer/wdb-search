<?php

class solr_interaction {

    const BASE_SELECT = 'http://localhost:8983/solr/wdb/select?';
    const FORMAT = 'php';

    public $search_fields = array(
        'fullText' => 'Volltext', 
        'title' => 'Titel', 
        'date' => 'Datum', 
        'author' => 'Autor(in)', 
        'editor' => 'Editor(in)', 
        'funder' => 'Förderer',
        'titleEdition' => 'Edition',
        'edoc' => 'Edoc'
    );
    public $filter_field = 'edoc';
    public $filters = array(
        'all' => 'Alle',
        '000228' => 'Tagebücher des Fürsten Christian II. von Anhalt-Bernburg',
        '000216' => 'Schriften und Briefe Andreas Bodensteins von Karlstadt, Teil 1',
        '000240' => 'Schriften und Briefe Andreas Bodensteins von Karlstadt, Teil 2',
        '000086' => 'Historische Methode und Arbeitstechnik der Magdeburger Zenturien'
    );
    public $facet_fields = array(
        'titleEdition_str' => 'Edition',
        'title_str' => 'Dokument',
        'author_str' => 'Autor(in)',
        'editor_str' => 'Editor(in)',
        'date_str' => 'Datum',
        'funder_str' => 'Förderer',
        'fullText' => 'Wörter'
    );

}

?>
