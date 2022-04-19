<?php

namespace App\Http\Controllers;

use App\Models\SparqlsModel;

class HomeController extends Controller
{
    public function index()
    {
        $sparql = new  SparqlsModel;
        $jenisTembang =  $sparql->getQueryJenisTembang();
        return  view('page.home',[ 'jenis'=>$jenisTembang] );
    }
}
