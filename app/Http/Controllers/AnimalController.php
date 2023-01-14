<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AnimalController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $datas = DB::table('animal')
            ->where('name','like',"%".$request->search."%")
            ->orWhere('species','like',"%".$request->search."%")
            ->paginate(3);
            // ->get();

            // $request->search;
            // $datas = DB::select("select * from animal where type like '%'.search.'%'");
        }else{
            $datas = DB::table('animal')
            ->where('deleted_at', null)
            ->paginate(3);
            // $datas = DB::select('select * from animal WHERE deleted_at is null');
        }
        
        return view('animal.index',['datas'=> $datas]);
    }

    public function create() {
        return view('animal.add');
    }

    public function store(Request $request) {
        $request->validate([
            'animal_id' => 'required',
            'species' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'weight' => 'required',
            'age' => 'required',
            'cage_id' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan typed Bindings untuk valuesnya
        DB::insert('INSERT INTO animal(animal_id, species, name, gender, weight, age, cage_id) VALUES (:animal_id, :species, :name, :gender, :weight, :age, :cage_id)',
        [
            'animal_id' => $request->animal_id,
            'species' => $request->species,
            'name' => $request->name,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'age' => $request->age,
            'cage_id' => $request->cage_id,
        ]
        );
        return redirect()->route('animal.index')->with('success', 'Data animal berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('animal')->where('animal_id', $id)->first();

        return view('animal.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'animal_id' => 'required',
            'species' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'weight' => 'required',
            'age' => 'required',
            'cage_id' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan typed Bindings untuk valuesnya
        DB::update('UPDATE animal SET animal_id = :animal_id, species = :species, name = :name, gender = :gender, weight = :weight, age = :age, cage_id = :cage_id WHERE animal_id = :id',
        [
            'id' => $id,
            'animal_id' => $request->animal_id,
            'species' => $request->species,
            'name' => $request->name,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'age' => $request->age,
            'cage_id' => $request->cage_id,
        ]
        );
        return redirect()->route('animal.index')->with('success', 'Data animal berhasil diubah');
    }

    //
    public function softDeleted($id){
        DB::update('UPDATE animal SET deleted_at = now() WHERE animal_id = :animal_id',
        [
            'animal_id' => $id,
        ]);
        return redirect('animal')->with('success', 'Data animal berhasil dibuang');
    }

    public function trash() {
        $datas = DB::select('select * from animal WHERE deleted_at is not null ');

        return view('animal.trash')
            ->with('datas', $datas);
    }

    public function restore($id){
        DB::update('UPDATE animal SET deleted_at = null WHERE animal_id = :animal_id',
        [
            'animal_id' => $id,
        ]);
        return redirect('animal/trash')->with('success', 'Data animal berhasil di restore');
    }
    //

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan typed Bindings untuk valuesnya
        DB::delete('DELETE FROM animal WHERE animal_id = :animal_id', ['animal_id' => $id]);

        return redirect('animal/trash')->with('success', 'Data animal berhasil dihapus');
    }
}
