<?php

namespace App\Http\Controllers\DaftarWajah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\DaftarWajah\DaftarWajahResource;
use App\Models\daftarWajah;

class DaftarWajahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarWajah = DB::table('daftar_wajah')->get();
        $daftarWajah = DaftarWajahResource::collection($daftarWajah);

        return response()->json([
            'status'    => true,
            'code'      => 200,
            'message'   => 'Seluruh data daftar wajah',
            'data'      => $daftarWajah,
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
            'kelas_id'      => 'required',
            'siswa_id'      => 'required',
        ]);

        $add = daftarWajah::create([
            'kelas_id'      => $request->kelas_id,
            'siswa_id'      => $request->siswa_id,
        ]);

        return response()->json([
            'message'   => 'wajah berhasil ditambahkan',
            'code'      => 200,
            'data'      => $add,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $daftarWajahExisted = daftarWajah::where('id',$id)->first();

        if ($daftarWajahExisted) {

           $showDaftarWajah =  new DaftarWajahResource($daftarWajahExisted);
            return response()->json([
                'message'   => 'daftar wajah tersedia',
                'code'      => 200,
                'data'      => $showDaftarWajah,
            ]);
        }
        return response()->json([
            'message'   => 'daftar wajah tidak tersedia',
            'code'      => 404,
            // 'data'      => $daftarWajahExisted,
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
        $daftarWajahExisted = daftarWajah::where('id',$id)->first();
        if ($daftarWajahExisted){
            $daftarWajahExisted->update([
                'kelas_id' => $request->kelas_id ?? $daftarWajahExisted->kelas_id,
                'siswa_id' => $request->siswa_id ?? $daftarWajahExisted->siswa_id,
            ]);
            return response()->json([
                'message'   => 'daftar wajah berhasil di update',
                'code'      => 200,
                'data'      => $daftarWajahExisted,
            ]);
        }
        return response()->json([
            'message'   => 'daftar wajah tidak tersedia',
            'code'      => 404,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daftarWajahExisted = daftarWajah::where('id',$id)->first();

        if($daftarWajahExisted){
            $daftarWajahExisted->delete();
            return response()->json([
                'message'   => 'daftar wajah berhasil di hapus',
                'code'      => 200,
                'data'      => $daftarWajahExisted,
            ]);
        }
        return response()->json([
            'message'   => 'daftar wajah tidak tersedia',
            'code'      => 404,
        ]);
    }
}
