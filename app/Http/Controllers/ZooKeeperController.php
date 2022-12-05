<?php

namespace App\Http\Controllers;

use App\Models\ZooKeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ZooKeeperController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $datas = DB::table('zoo_keeper')->where('name','like',"%".$request->search."%")->get();
        }else{
            $datas = DB::select('select * from zoo_keeper where deleted_at is null');
        }
        return view('zoo_keeper.index',['datas'=> $datas]);
    }

    public function create() {
        return view('zoo_keeper.add');
    }

    public function store(Request $request) {
        $request->validate([
            'zookeeper_id' => 'required',
            'name' => 'required',
            'year_hired' => 'required',
            'age' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO zoo_keeper(zookeeper_id, name, year_hired, age) VALUES (:zookeeper_id, :name, :year_hired, :age)',
        [
            'zookeeper_id' => $request->zookeeper_id,
            'name' => $request->name,
            'year_hired' => $request->year_hired,
            'age' => $request->age,
        ]
        );
        return redirect()->route('zoo_keeper.index')->with('success', 'Data Zoo Keeper berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('zoo_keeper')->where('zookeeper_id', $id)->first();

        return view('zoo_keeper.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'zookeeper_id' => 'required',
            'name' => 'required',
            'year_hired' => 'required',
            'age' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE zoo_keeper SET zookeeper_id = :zookeeper_id, name = :name, year_hired = :year_hired, age = :age WHERE zookeeper_id = :id',
        [
            'id' => $id,
            'zookeeper_id' => $request->zookeeper_id,
            'name' => $request->name,
            'year_hired' => $request->year_hired,
            'age' => $request->age,
        ]
        );
        return redirect()->route('zoo_keeper.index')->with('success', 'Data Zoo Keeper berhasil diubah');
    }

    public function softDeleted($id){
        DB::update('UPDATE zoo_keeper SET deleted_at = now() WHERE zookeeper_id = :zookeeper_id',
        [
            'zookeeper_id' => $id,
        ]);
        return redirect('zoo')->with('success', 'Data zoo keeper berhasil dibuang');
    }

    public function trash() {
        $datas = DB::select('select * from zoo_keeper WHERE deleted_at is not null ');

        return view('zoo_keeper.trash')
            ->with('datas', $datas);
    }

    public function restore($id){
        DB::update('UPDATE zoo_keeper SET deleted_at = null WHERE zookeeper_id = :zookeeper_id',
        [
            'zookeeper_id' => $id,
        ]);
        return redirect('zoo_keeper/trash')->with('success', 'Data zoo keeper berhasil di restore');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM zoo_keeper WHERE zookeeper_id = :zookeeper_id', ['zookeeper_id' => $id]);

        return redirect()->route('zoo_keeper.index')->with('success', 'Data zoo keeper berhasil dihapus');
    }
}
