<?php

namespace App\Http\Controllers\Waktu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Waktu;

class WaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waktu = DB::table('waktu')->get();
        return response()->json([
            'message'       => 'seluruh data waktu',
            'code'          => 200,
            'status'        => true,
            'data'          => $waktu,
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
            'waktu_awal'    => 'required',
            'range'         => 'required',
            'waktu_akhir'   => 'required',
        ]);

        $add = Waktu::create([
            'waktu_awal'    => $request-> waktu_awal,
            'range'         => $request-> range,
            'waktu_akhir'   => $request-> waktu_akhir,
        ]);
        return response()->json([
            'message'       => 'waktu berhasil ditambahkan',
            'code'          => 200,
            'status'        => true,
            'data'          => $add,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $waktuexist = Waktu::where('id',$id)->first();

        if ($waktuexist){
            return response()->json([
                'message'       => 'waktu ditemukan',
                'code'          => 200,
                'status'        => true,
                'data'          => $waktuexist,
            ]);
        }
        return response()->json([
            'message'       => 'waktu tidak ditemukan',
            'code'          => 404,
            'status'        => false,
            // 'data'          => $waktuexist,
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
        $waktuexist = Waktu::where('id',$id)->first();
        if ($waktuexist){
            $waktuexist->update([
                'waktu_awal' => $request->waktu_awal ?? $waktuexist->waktu_awal,
                'range'      => $request->range ?? $waktuexist-> range,
                'waktu_akhir' => $request->waktu_akhir ?? $waktuexist->waktu_akhir,

            ]);
            return response()->json([
                'message'       => 'waktu berhasil di update',
                'code'          => 200,
                'status'        => true,
                'data'          => $waktuexist,
            ]);
        }
                return response()->json([
                    'message'       => 'waktu tidak ditemukan',
                    'code'          => 404,
                    'status'        => false,
                    // 'data'          => $waktuexist,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $waktuexist = Waktu::where('id',$id)->first();
        if ($waktuexist){
            $waktuexist->delete();
            return response()->json([
                'message'       => 'waktu berhasil di hapus',
                'code'          => 200,
                'status'        => true,

            ]);
    }
    return response()->json([
        'message'       => 'waktu tidak ditemukan',
        'code'          => 404,
        'status'        => false,
    ]);
}
}
