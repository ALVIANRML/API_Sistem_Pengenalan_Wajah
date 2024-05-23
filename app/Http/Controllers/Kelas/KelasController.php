<?php

namespace App\Http\Controllers\Kelas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = DB::table('kelas')->first();
        return response()->json([
            'status'    => true,
            'message'   => 'all data',
            'data'      => $dosen,
            'code'      => 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'semester' => 'required',
        ]);
        $add = Kelas::create([
            'name' => $request->name,
            'semester' => $request->semester,
        ]);
        return response()->json([
            'message'   => 'berhasil menambahkan kelas',
            'data'      => $add,
            'code'      => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelasexist = Kelas::where('id',$id)->first();

        if ($kelasexist){
            return response()->json([
                'message'       => "kelas tersedia",
                'code'          => 200,
                'status'        => true,
                'data'          => $kelasexist,
            ]);
        }
        return response()->json([
            'message'       => "kelas tidak tersedia",
            'code'          => 404,
            'status'        => false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelasexist = Kelas::where('id',$id)->first();
        // var_dump(20);
        // exit;

        if ($kelasexist){
            $kelasexist->update([
                'name' => $request -> name ?? $kelasexist -> name,
                'semester' => $request -> semester ?? $kelasexist -> semester,
            ]);

            return response()->json([
                'message'       => "kelas berhasil di update",
                'code'          => 200,
                'status'        => true,
                'data'          => $kelasexist,
            ]);
        }
        return response()->json([
            'message'       => "kelas tidak tersedia",
            'code'          => 404,
            'status'        => false,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelasexist = Kelas::where('id', $id)->first();
        if ($kelasexist){
            $kelasexist->delete();
            return response()->json([
                'message'       => "kelas berhasil di hapus",
                'code'          => 200,
                'status'        => true,
            ]);
        }
        return response()->json([
            'message'       => "kelas tidak ditemukan",
            'code'          => 404,
            'status'        => false,
        ]);
    }
}
