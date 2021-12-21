<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \App\Paper::all();
        if(count($data)>0){
            return response()->json([
                'message'=>'succes',
                'values'=> $data
            ]);
        }else{
            return response()->json([
                'message'=>'EMPTY'
            ]);
        }
        
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
        $judul = $request->input('judul');
        $jenis = $request->input('jenis');
        $penulis = $request->input('penulis');
        $link = $request->input('link');
        $lisensi = $request->input('lisensi');
        $batasan_umur = $request->input('batasan_umur');
        $deskripsi = $request->input('deskripsi');
        $id_user = $request->input('id_user');

        $data = new \App\Paper();
        $data->judul = $judul;
        $data->jenis = $jenis;
        $data->penulis = $penulis;
        $data->link = $link;
        $data->lisensi = $lisensi;
        $data->batasan_umur = $batasan_umur;
        $data->deskripsi = $deskripsi;
        $data->id_user = $id_user;

        if($data->save()){
            return response()->json([
                'message'=>'succes',
                'values'=> $data
            ]);
        }else{
            return response()->json([
                'message'=>'Failed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \App\Paper::where('id', $id)->get();

        if(count($data)>0){
            return response()->json([
                'message'=>'succes',
                'values'=> $data
            ]);

        }else{
            return response()->json([
                'message'=>'Failed'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $judul = $request->input('judul');
        $jenis = $request->input('jenis');
        $penulis = $request->input('penulis');
        $link = $request->input('link');
        $lisensi = $request->input('lisensi');
        $batasan_umur = $request->input('batasan_umur');
        $deskripsi = $request->input('deskripsi');
        $id_user = $request->input('id_user');

        $data = \App\Paper::where('id', $id)->first();
        $data->judul=$judul;
        $data->jenis=$jenis;
        $data->penulis=$penulis;
        $data->link=$link;
        $data->lisensi=$lisensi;
        $data->batasan_umur=$batasan_umur;
        $data->deskripsi=$deskripsi;
        $data->id_user=$id_user;

        if($data->save()){
            return response()->json([
                'message'=>'succes',
                'values'=> $data
            ]);
        }else{
            return response()->json([
                'message'=>'Failed'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\Paper::where('id', $id)->first();
        if($data->delete()){
            return response()->json([
                'message'=>'succes',
                'values'=> $data
            ]);
        }else{
            return response()->json([
                'message'=>'Failed'
            ]);
        }
    }
}
