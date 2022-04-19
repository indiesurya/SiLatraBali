<?php

namespace App\Http\Controllers;

use App\Models\SparqlsModel;
use Illuminate\Http\Request;

class DetailController extends Controller
{

    public function  index()
    {
        $sparql = new  SparqlsModel;
        $jenisTembang =  $sparql->getQueryJenisTembang();

        $attribute = $sparql->getAttributes();
        $data=[];
        if (!empty($_GET)){
            $searcgFilter = [];
            $searchKey= [];
            $searcgFilter["MemilikiNama"] = "'".$_GET['nama']."'";
            $searchKey["MemilikiNama"] = "nama";
            $data = $sparql->getQuerySearchTembang($searcgFilter,$searchKey,true);
        }

        return  view('page.detail',["data"=>$data,  "attribute"=>$attribute,  'jenis'=>$jenisTembang] );
    }
}
