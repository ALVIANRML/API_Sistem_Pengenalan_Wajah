<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = DB::table('siswa')->get();
        return response()->json([
            'status' => true,
            'message'=> 'Seluruh data dapat di tampilkan',
            'data'  => $siswa,
            'code'  => 200,
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
            'nama'  => 'required',
            'nim'   => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        // var_dump(20);
        // exit;
        $photoName = null;
    if ($request->hasFile('gambar')) {
        $photoName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images'), $photoName);
    }
        $add = Siswa::create([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'gambar'   => $photoName,
        ]);

        return response()->json([
            'message'   => 'siswa berhasil ditambahkan',
            'status'    => true,
            'data'      => $add,
            'code'      => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswaexist = Siswa::where('id',$id)->first();

        if ($siswaexist){
            return response()->json([
                'status'   => true,
                'code'     => 200,
                'message'  => 'siswa ditemukan',
                'data'    => [
                    'showDosen' => $siswaexist,
                ]
            ]);
         }
         return response()->json([
            'status'        => false,
            'code'          => 404,
            'message'       => 'siswa tidak ditemukan'
         ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswaexist = Siswa::where('id',$id)->first();

        if ($siswaexist){
            $siswaexist->update([
                'name' =>$request->name,
                'nim' =>$request->nim,
                'gambar' =>$request->gambar,
            ]);
            return response()->json([
                'status'    => true,
                'code'      => 200,
                'message'   => 'siswa berhasil di update',
                'data'      => $siswaexist,
            ]);
        }
        return response()->json([
            'status'=> false,
            'code'  => 404,
            'message'   => 'data tidak ditemukan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswaexist = Siswa::where('id',$id)->first();
        if($siswaexist){
            $siswaexist->delete();
            return response()->json([
                'message' => 'siswa berhasil di hapus',
                'code'      => 200,
                'status'    => true,
            ]);
        }

        return response()->json([
            'status'    => false,
            'message'   => 'siswa tidak ditemukan',
            'code'      => 404,
        ]);
    }
}
