<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CageController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $datas = DB::table('cage')->where('type','like',"%".$request->search."%")->get();
            // $request->search;
            // $datas = DB::select("select * from cage where type like '%'.search.'%'");
        }else{
            $datas = DB::select('select * from cage WHERE deleted_at is null');
        }
        
        return view('cage.index',['datas'=> $datas]);
    }

    public function create() {
        return view('cage.add');
    }

    public function store(Request $request) {
        $request->validate([
            'cage_id' => 'required',
            'type' => 'required',
            'size' => 'required',
            'date_built' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan typed Bindings untuk valuesnya
        DB::insert('INSERT INTO cage(cage_id, type, size, date_built) VALUES (:cage_id, :type, :size, :date_built)',
        [
            'cage_id' => $request->cage_id,
            'type' => $request->type,
            'size' => $request->size,
            'date_built' => $request->date_built,
        ]
        );
        return redirect()->route('cage.index')->with('success', 'Data Cage berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('cage')->where('cage_id', $id)->first();

        return view('cage.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'cage_id' => 'required',
            'type' => 'required',
            'size' => 'required',
            'date_built' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan typed Bindings untuk valuesnya
        DB::update('UPDATE cage SET cage_id = :cage_id, type = :type, size = :size, date_built = :date_built WHERE cage_id = :id',
        [
            'id' => $id,
            'cage_id' => $request->cage_id,
            'type' => $request->type,
            'size' => $request->size,
            'date_built' => $request->date_built,
        ]
        );
        return redirect()->route('cage.index')->with('success', 'Data Cage berhasil diubah');
    }

    public function softDeleted($id){
        DB::update('UPDATE cage SET deleted_at = now() WHERE cage_id = :cage_id',
        [
            'cage_id' => $id,
        ]);
        return redirect('cage')->with('success', 'Data cage berhasil dibuang');
    }

    public function trash() {
        $datas = DB::select('select * from cage WHERE deleted_at is not null ');

        return view('cage.trash')
            ->with('datas', $datas);
    }

    public function restore($id){
        DB::update('UPDATE cage SET deleted_at = null WHERE cage_id = :cage_id',
        [
            'cage_id' => $id,
        ]);
        return redirect('cage/trash')->with('success', 'Data cage berhasil di restore');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan typed Bindings untuk valuesnya
        DB::delete('DELETE FROM cage WHERE cage_id = :cage_id', ['cage_id' => $id]);

        return redirect('cage/trash')->with('success', 'Data Cage berhasil dihapus');
    }
}
