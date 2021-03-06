<?php


class solr_request extends solr_interaction {
    
    public $url = '';
    public $errorMessage;
       
    /*  Variablen für die Suche */
    private $queries; // Enthält assoziative Arrays mit den Indices 'field' und 'value'
    private $filters_active = array();
    private $start = 0;

    function __construct($get = null) {
        if (isset($get['start'])) {
            $this->start = $get['start'];
        }
        if (isset($get['field']) and isset($get['value'])) {
            $value = htmlspecialchars($get['value']);
            if ($get['fuzzy'] == 'yes' and $value != '*' and $value != '') {
                $value = rtrim('*', $value);
                $value .= '~';
            }
            $this->queries[] = array('field' => htmlspecialchars($get['field']), 'value' => $value);
            if (isset($get[$this->filter_field])) {
                if (in_array('all', $get[$this->filter_field]) == false)  {
                    foreach ($get[$this->filter_field] as $edoc) {
                        $this->filters_active[] = $edoc;
                    }
                }
            }

            if (isset($get['refine'])) {
                foreach ($get['refine'] as $refine) {
                    $keyValue = explode(':', $refine);
                    if (isset($keyValue[0]) and isset($keyValue[1])) {
                        $this->queries[] = array('field' =>  htmlspecialchars($keyValue[0]), 'value' => '"'.htmlspecialchars($keyValue[1]).'"');
                    }
                }
            }
        
        }
        $this->url = $this->toURL();
    }

    private function toURL() {

        if ($this->validate() == false) {
            return;
        }
                
        $filterString = '';
        if (isset($this->filters_active[0])) {
            $filters = array();
            foreach ($this->filters_active as $edoc) {
                $filters[] = $this->filter_field.':'.$edoc;
            }
            $filterString = 'fq='.implode(urlencode(' OR '), $filters).'&';
            unset($filters);
        }

        $queryArray = array();
        foreach ($this->queries as $query) {
            $query['value'] = urlencode($query['value']);
            if ($query['value'] == '') {
                $query['value'] = '*';
            }        
            if ($query['field'] == 'fullText') {
                $queryArray[] = $query['value'];
            }
            else {
                $queryArray[] = $query['field'].':'.$query['value'];
            }
        }
        $queryString = 'q='.implode('+AND+', $queryArray);

        $start = '';
        if ($this->start > 0) {
            $start = '&start='.$this->start;
        }

        $facetArray = array();
        foreach ($this->facet_fields as $field => $label) {
            $facetArray[] = 'facet.field='.$field;
        }
        $facetString = implode('&', $facetArray);
        $facetString .= '&facet=on&';

        return(solr_request::BASE_SELECT.$facetString.$filterString.$queryString.$start.'&hl=true&hl.snippets=10&wt='.solr_request::FORMAT);

    }

    private function validate() {
        if (!is_array($this->queries)) {
            return(false);
        }
        foreach ($this->queries as $query) {
            if (isset($this->search_fields[$query['field']]) == false and isset($this->facet_fields[$query['field']]) == false) {
                $this->errorMessage = 'Ungültiges Feld: '.$query['field'];
                return(false);
            }
            if (strlen($query['value']) > 150) {
                $this->errorMessage = 'Suchwort zu lang (maximal 150 Zeichen)';
                return(false);
            }
        }
        foreach ($this->filters_active as $edoc) {
            if (isset($this->filters[$edoc]) == false) {
                $this->errorMessage = 'Unzulässiger Filter: '.$gnd;
                return(false);
            }
        }
        return(true);
    }

}

?>
