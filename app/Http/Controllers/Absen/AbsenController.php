<?php

namespace App\Http\Controllers\Absen;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Absen\AbsenResource;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absen = DB::table('absen')->get();
        $absen = AbsenResource::collection($absen);

        return response()->json([
           'message'    => 'seluruh absen',
           'code'       => 200,
           'data'       => $absen,
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
            'kelas_id'=> 'required',
            'siswa_id'=> 'required',
            'present' => 'required|integer|between:0,1', // Ensure present is 0 or 1
        ]);

        // Convert present value from 0/1 to false/true
        $presentValue = $request->present == 1 ? true : false;
        $presentLabel = $presentValue ? 'hadir' : 'tidak hadir';
        $add = Absen::create([
            'kelas_id'  => $request->kelas_id,
            'siswa_id'  => $request->siswa_id,
            'present'   => $presentValue,
            'waktu_id'  => $request->waktu_id,

        ]);

        return response()->json([
            'message'   => 'absen berhasil ditambahkan',
            'data'      => $add,
            'kehadiran' => $presentLabel,
            'code'      => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $absenexisted = Absen::where('id',$id)->first();

        if($absenexisted){
            $showAbsen = new AbsenResource($absenexisted);
            return response()->json([
                'message'   => 'absen tersedia',
                'data'      => $absenexisted,
                'code'      => 200,
            ]);
        }
        return response()->json([
            'message'   => 'absen tidak tersedia',
            // 'data'      => $absenexisted,
            'code'      => 404,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $absenexisted = Absen::where('id',$id)->first();
        if ($absenexisted) {
            $presentValue = $request->present == 1 ? true : false;
        $presentLabel = $presentValue ? 'hadir' : 'tidak hadir';
            $absenexisted->update([
                'kelas_id' => $request->kelas_id ?? $absenexisted->kelas_id,
                'siswa_id' => $request->siswa_id ?? $absenexisted->siswa_id,
                'present' => $presentValue,
                'waktu_id' => $request->waktu_id ?? $absenexisted->waktu_id,

            ]);
            return response()->json([
                'message'=> 'absen berhasil di update',
                'data'  => $absenexisted,
                'code'  => 200,
            ]);


        }
        return response()->json([
            'message'=> 'absen tidak ditemukan',
            // 'data'  => $absenexisted,
            'code'  => 404,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     $absenexisted = Absen::where('id',$id)->first();
        if ($absenexisted){
            $absenexisted->delete();

            return response()->json([
                'message'=> 'absen berhasil di hapus',
                // 'data'  => $absenexisted,
                'code'  => 200,
            ]);
        }
        return response()->json([
            'message'=> 'absen tidak ditemukan',
            // 'data'  => $absenexisted,
            'code'  => 404,
        ]);
    }
}
