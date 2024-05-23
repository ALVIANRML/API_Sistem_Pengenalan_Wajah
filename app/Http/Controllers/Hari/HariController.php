<?php

namespace App\Http\Controllers\Hari;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Hari;

class HariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hari = DB::table('hari')->get();
        return response()->json([
            'status'        => true,
            'code'          => 200,
            'message'       => 'Data tersedia',
            'data'          => $hari,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
        ]);

        $add = Hari::create([
            'name' => $request->name,
        ]);
        return response()->json([
            'status'        => true,
            'code'          => 200,
            'message'       => 'Hari berhasil ditambah',
            'data'          => $add,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hariexist = Hari::where('id',$id)->first();
        if($hariexist){
            return response()->json([
                'status'        => true,
                'code'          => 200,
                'message'       => 'Hari ditemukan',
                'data'          => $hariexist,
            ]);
        }
        return response()->json([
            'status'        => false,
            'code'          => 404,
            'message'       => 'Hari tidak ditemukan',
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
        $hariexist = Hari::where('id',$id)->first();
        if($hariexist){
            $hariexist->update([
                'name' => $request -> name ?? $hariexist -> hari,
            ]);
            return response()->json([
                'status'        => true,
                'code'          => 200,
                'message'       => 'Hari berhasil di update',
                'data'          => $hariexist,
            ]);
        }
        return response()->json([
            'status'        => false,
            'code'          => 404,
            'message'       => 'Hari tidak ditemukan',
            // 'data'          => $hariexist,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hariexist = Hari::where('id',$id)->first();
        if($hariexist){
            $hariexist->delete();
            return response()->json([
                'status'        => true,
                'code'          => 200,
                'message'       => 'Hari berhasil dihapus',
            ]);
        }
        return response()->json([
            'status'        => false,
            'code'          => 404,
            'message'       => 'Hari tidak ditemukan',
        ]);
    }
}
