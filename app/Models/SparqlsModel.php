<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SparqlsModel extends Model
{
    public $IRI = "http://www.semanticweb.org/diantiparasmitha/ontologies/2022/1/tembangbali#";

    public static function sPrint($anyData)
    {
        echo "<pre>";
        print_r($anyData);
        echo "</pre>";
    }

    public function getAttributes()
    {
        return array(
            "type" => "individu",
            "domain" => "Ontology Tembang Bali",
            "prefix" => "TembangBali"
        );
    }
    public  function cleanIRI($anyData)
    {
        $result =  str_replace(strval($this->IRI), "", $anyData);
        $result =   str_replace("_", "", $result);
        return  str_replace("-", "", $result);
    }



    public function getQueryJenisTembang()
    {
        $sparql = new SPARQL;
        $sparql->prefixe('tembang', $this->IRI)
            ->variable('?nama ?tembang')
            ->where('{ ?tembang tembang:AdalahJenisTembangDari ?dari }', ' { ?tembang tembang:MemilikiNama ?nama }  ', '');


        $response = $sparql->launch();
        $response = $response['results']['bindings'];
        for ($i = 0; $i < count($response); $i++) {
            $item = $response[$i];
            $item['tembang'] = $this->cleanIRI($item['tembang']);
            $response[$i] = $item;
        }
        return  $response;
    }
    public function getQueryFilterTembang($attribute)
    {
        $sparql = new SPARQL;
        $sparql->prefixe('tembang', $this->IRI)
            ->prefixe('rdf', "http://www.w3.org/1999/02/22-rdf-syntax-ns")
            ->prefixe('rdfs', "http://www.w3.org/2000/01/rdf-schema#")
            ->prefixe('owl', "http://www.w3.org/2002/07/owl#")
            ->variable('?filter')
            ->where('{ ?filter rdfs:subClassOf tembang:' . $attribute . ' }', '  { ?filter rdfs:subClassOf ?className }', ' ')
            ->groupBy("?filter");
        $response = $sparql->launch();
        $response = $response['results']['bindings'];
        for ($i = 0; $i < count($response); $i++) {
            $item = $response[$i];
            $item['filter'] = $this->cleanIRI($item['filter']);
            $response[$i] = $item;
        }
        return  $response;
    }

    public function getQueryFilterByObjectTembang($attribute)
    {
        $sparql = new SPARQL;
        $sparql->prefixe('tembang', $this->IRI)
            ->prefixe('rdf', "http://www.w3.org/1999/02/22-rdf-syntax-ns")
            ->prefixe('rdfs', "http://www.w3.org/2000/01/rdf-schema#")
            ->prefixe('owl', "http://www.w3.org/2002/07/owl#")
            ->variable('?filter')
            ->where('{ ?tembang tembang:' . $attribute . ' ?filter  } ', '', '')
            ->groupBy("?filter");
        $response = $sparql->launch();
        $response = $response['results']['bindings'];
        for ($i = 0; $i < count($response); $i++) {
            $item = $response[$i];
            $item['filter'] = $this->cleanIRI($item['filter']);
            $response[$i] = $item;
        }
        return  $response;
    }
    public function getQueryTembang()
    {
        $sparqlALl = new SPARQL;
        $sparqlALl->prefixe('tembang', 'http://www.semanticweb.org/diantiparasmitha/ontologies/2022/1/tembangbali#')
            ->variable(' ?nama  ?tembang')
            ->where(
                '{ ?tembang tembang:MemilikiJenisTembang tembang:SekarAlit } ',
                ' UNION { ?tembang tembang:MemilikiJenisTembang tembang:SekarMadya } ',
                ' UNION { ?tembang tembang:MemilikiJenisTembang tembang:SekarRare }'
            )
            ->where(
                '{ ?tembang tembang:MemilikiNama ?nama } ',
                '{ ?tembang tembang:MemilikiJenisTembang ?jenisMain } ',
                '{ ?jenisMain tembang:MemilikiNama  ?jenis }'
            )
            ->where(
                '{ ?tembang tembang:MemilikiLaras ?larasMain }  ',
                '{ ?larasMain tembang:MemilikiNama  ?laras } ',
                '{ ?tembang tembang:MemilikiLirik ?lirik }  '
            )
            ->where(
                '{ ?tembang tembang:MemilikiAktivitas ?aktivitasMain }
                 { ?aktivitasMain tembang:MemilikiNama  ?aktivitas }',
                '{ ?tembang tembang:MemilikiFungsi ?fungsiMain }  ',
                '{ ?fungsiMain tembang:MemilikiNama  ?fungsi }'
            )
            ->groupBy("?nama ?tembang");

        $response = $sparqlALl->launch();
        return  $response['results']['bindings'];
    }
    public function getQueryTembangByJenis($jenis, $aktivitas)
    {
        $sparqlALl = new SPARQL;
        $sparqlALl->prefixe('tembang', 'http://www.semanticweb.org/diantiparasmitha/ontologies/2022/1/tembangbali#')
            ->variable(' ?nama  ?tembang')
            ->where(
                '{ ?tembang tembang:MemilikiJenisTembang tembang:' . $jenis . ' } ',
                '   { ?tembang tembang:MemilikiAktivitas tembang:' . $aktivitas . ' } ',
                ''
            )
            ->where(
                '{ ?tembang tembang:MemilikiNama ?nama } ',
                '{ ?tembang tembang:MemilikiJenisTembang ?jenisMain } ',
                '{ ?jenisMain tembang:MemilikiNama  ?jenis }'
            )
            ->where(
                '{ ?tembang tembang:MemilikiLaras ?larasMain }  ',
                '{ ?larasMain tembang:MemilikiNama  ?laras } ',
                '{ ?tembang tembang:MemilikiLirik ?lirik }  '
            )
            ->where(
                '{ ?tembang tembang:MemilikiAktivitas ?aktivitasMain }
                 { ?aktivitasMain tembang:MemilikiNama  ?aktivitas }',
                '{ ?tembang tembang:MemilikiFungsi ?fungsiMain }  ',
                '{ ?fungsiMain tembang:MemilikiNama  ?fungsi }'
            )
            ->groupBy("?nama ?tembang");

        $response = $sparqlALl->launch();
        return  $response['results']['bindings'];
    }

    public function getQuerySearchTembang($searcgFilter, $searchKey, $detail = False)
    {
        $sparqlALl = new SPARQL;

        $searhStr = "";
        $strSelect = "?nama ?tembang ";
        foreach ($searcgFilter as $key => $value) {
            if ($key == 'variable') {
                $strSelect .= ($value != "*" ? " ?" : " ") . $searcgFilter[$key] . " ";
                $strSelect  = ($value != "*" ? $strSelect : "*");
                continue;
            }
            if ($searhStr != "") {
                $searhStr .= " . ";
            }
            if ($detail) {
                $strSelect = " *  ";
                $searhStr .= " { ?tembang tembang:" . $key . " " . $value . " } ";
            } else {
                $searhStr .= " { ?tembang tembang:" . $key . " tembang:" . $value . " } ";
            }
        }
        $strWhere  =  '{ ?tembang tembang:MemilikiNama ?nama } ' .
            '{ ?tembang tembang:MemilikiJenisTembang ?jenisMain } ' .
            '{ ?jenisMain tembang:MemilikiNama  ?jenis }'  .
            '{ ?tembang tembang:MemilikiLaras ?larasMain }  ' .
            '{ ?larasMain tembang:MemilikiNama  ?laras } ' .
            '{ ?tembang tembang:MemilikiLirik ?lirik }  '  .
            '{ ?tembang tembang:MemilikiFungsi ?fungsiMain }  ' .
            '{ ?fungsiMain tembang:MemilikiNama  ?fungsi }' .
            '{ ?tembang tembang:MemilikiAktivitas ?aktivitasMain }  ' .
            '{ ?aktivitasMain tembang:MemilikiNama  ?aktivitas }';

        $sparqlALl->prefixe('tembang', 'http://www.semanticweb.org/diantiparasmitha/ontologies/2022/1/tembangbali#')
            ->variable($strSelect)
            ->where($searhStr,  $strWhere, '  ');
        $response = $sparqlALl->launch();
        $response["query"] = $sparqlALl->getQuery();
        $responseItem = $response['results']['bindings'];
        for ($i = 0; $i < count($responseItem); $i++) {
            $item = $responseItem[$i];
            $item['tembang'] = $this->cleanIRI($item['tembang']);
            foreach ($item as $key => $value) {
                if (str_contains($key, "Main")) {
                    $item[$key]["value"] =   $this->cleanIRI($value["value"]);
                }
            }
            $responseItem[$i] = $item;
        }
        $response['results']['bindings'] = $responseItem;

        return  $response;
    }


    private function cleanQuery($query)
    {
        return trim(str_replace("\n", " ", $query));
    }
}