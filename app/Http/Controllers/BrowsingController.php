<?php

namespace App\Http\Controllers;

use App\Models\SparqlsModel;
use Illuminate\Http\Request;

class BrowsingController extends Controller
{
    //
    public function index()
    {
        $sparql = new  SparqlsModel;
        $jenisTembang =  $sparql->getQueryJenisTembang();
        $aktivitas =  $sparql->getQueryFilterByObjectTembang("MemilikiAktivitas");

        $listTembang = [];
        $jenis = "";
        if (!empty($_GET) && isset($_GET['jenis']) && isset($_GET['aktivitas'])) {
            $jeniss = $_GET['jenis'];
            $aktivis = $_GET['aktivitas'];
            $listTembang =  $sparql->getQueryTembangByJenis($jeniss, $aktivis);
            for ($i = 0; $i < count($listTembang); $i++) {
                $item = $listTembang[$i];
                $item['tembang'] = $sparql->cleanIRI($item['tembang']);
                $listTembang[$i] = $item;
            }
            $mode = 2;
        } elseif (!empty($_GET) && isset($_GET['jenis'])) {
            $jenis = $_GET['jenis'];
            $mode = 1;
        } else {
            $mode = 0;
        }

        return  view('page.browse', ["data" => $listTembang, "mode" => $mode, "pilihan" => $jenis, "aktivitas" => $aktivitas, 'jenis' => $jenisTembang]);
    }
}