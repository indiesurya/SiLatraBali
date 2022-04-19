<?php

namespace App\Http\Controllers;

use App\Models\SparqlsModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $sparql = new  SparqlsModel;
        $jenisTembang =  $sparql->getQueryJenisTembang();
        $listTembang =  $sparql->getQueryTembang();
        for ($i = 0; $i < count($listTembang); $i++) {
            $item = $listTembang[$i];
            $item['tembang'] = $sparql->cleanIRI($item['tembang']);
            $listTembang[$i] = $item;
        }


        $keyFilterFilter = array(
            "fungsi" => "MemilikiFungsi",
            "aktivitas" => "MemilikiAktivitas",
            "jenis" => "MemilikiJenisTembang",
            "pupuh" => "MemilikiJenisPupuh",
            "kidung" => "AdalahTermasukKidung",
            "gending" => "MerupakanBagianDari",
            "laras" => "MemilikiLaras",
            "variable" => "variable",
        );

        $filterTembang = array(
            "fungsi" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["fungsi"]),
            "aktivitas" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["aktivitas"]),
            "jenis" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["jenis"]),
            "pupuh" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["pupuh"]),
            "gending" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["gending"]),
            "kidung" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["kidung"]),
            "laras" => $sparql->getQueryFilterByObjectTembang($keyFilterFilter["laras"]),
        );
        $outputFilter = array(
            "semua" => "*",
            "jenis" => "jenis",
            "fungsi" => "fungsi",
            "aktivitas" => "aktivitas",
            "laras" => "laras",
            "lirik" => "lirik",
        );
        $data = [];
        if (!empty($_GET)) {
            $searchFilter = [];
            $searchKey = [];
            foreach ($_GET as $key => $value) {
                if (!empty($value)) {
                    $searchFilter[$keyFilterFilter[$key]] = $value;
                    $searchKey[$keyFilterFilter[$key]] = $key;
                }
            }
            $data = $sparql->getQuerySearchTembang($searchFilter, $searchKey);
        }

        return  view('page.search', ["data" => $data,   "output" => $outputFilter, "filter" => $filterTembang, 'jenis' => $jenisTembang]);
    }
}