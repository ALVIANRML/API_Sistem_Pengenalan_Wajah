<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\dosen;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = DB::table('dosen')->get();
        return response()->json([
            'data' => $dosen,
            'code'  => 200,
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
            'name'      => 'required',
            'nip'       => 'required',
        ]);

        // var_dump(20);
        // exit;
        $add = dosen::create([
            'name' => $request->name,
            'nip'   => $request->nip,
        ]);
        return response()->json([
            'message'   => 'dosen berhasil ditambahkan',
            'code'      => 200,
            'data'      => $add,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dosenexist = dosen::where('id',$id)->first();
         if ($dosenexist){
            return response()->json([
                'status'   => true,
                'code'     => 200,
                'message'  => 'dosen ditemukan',
                'data'    => [
                    'showDosen' => $dosenexist,
                ]
            ]);
         }
         return response()->json([
            'status'        => false,
            'code'          => 404,
            'message'       => 'dosen tidak ditemukan'
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
        $dosenexist = dosen::where('id',$id)->first();
        if ($dosenexist){
            $dosenexist->update([
                'name' => $request->name ?? $dosenexist-> name,
                'nip'  => $request->nip ?? $dosenexist-> nip,
            ]);

            return response()->json([
                'status'    => true,
                'code'      => 200,
                'message'   => 'dosen berhasil di update',
                'data'      => $dosenexist,
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
        $dosenexist = dosen::where('id',$id)->first();
        if($dosenexist){
            $dosenexist->delete();
            return response()->json([
                'message' => 'dosen berhasil di hapus',
                'code'      => 200,
                'status'    => true,
            ]);
        }
        
        return response()->json([
            'status'    => false,
            'message'   => 'dosen tidak ditemukan',
            'code'      => 404,
        ]);
    }
}
