<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(Request $request) {
        //gagal search
        // if ($request->has('search')) {
        //     $datas = DB::table('service')->where('service_id','like',"%".$request->search."%")->get();
        // }else{

        // }

        $datas = DB::table('service')
        ->join('animal', 'service.animal_id', '=', 'animal.animal_id')
        ->join('zoo_keeper', 'service.zookeeper_id', '=', 'zoo_keeper.zookeeper_id')
        ->select('service.service_id', 'zoo_keeper.name as penjaga','animal.name as animal', 'service.service_type', 'service.service_date' )
        ->orderBy('service.service_id','asc')
        ->get();
        
        return view('service.index',['datas'=> $datas]);
    }

}