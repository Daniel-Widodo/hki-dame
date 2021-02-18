<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Http\Request;
use DB;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluargas = Keluarga::all();
        return view('master.keluarga.index', ['keluargas' => $keluargas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show(Keluarga $keluarga)
    {
        $keluargas =  DB::table('keluarga')
            ->join('detail_keluarga', 'keluarga.id', '=', 'detail_keluarga.keluarga_id')
            ->join('jemaat', 'jemaat.id' , '=', 'detail_keluarga.jemaat_id')
            ->where('keluarga.id', '=', $keluarga->id)
            ->orderBy('jemaat.tanggal_lahir', 'asc')
            ->get();
        
        return view('master.keluarga.show', ['keluargas' => $keluargas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluarga $keluarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluarga $keluarga)
    {
        //
    }
}
