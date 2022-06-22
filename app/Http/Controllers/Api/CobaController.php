<?php

namespace App\Http\Controllers\Api;

use App\Models\Friends;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CobaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friends::orderBy('id', 'desc')->paginate(3);
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Teman',
            'data' => $friends
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:friends|max:255',
            'no_tlp' => 'required|numeric',
            'alamat' => 'required'
        ]);


        $friends = Friends::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_tlp,
            'alamat' => $request->alamat
        ]);

        if ($friends) {
            return response()->json([
                'success' => true,
                'message' => 'Data Teman Berhasil Ditambahkan',
                'data' => $friends
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Teman Gagal Ditambahkan',
                'data' => $friends
            ], 409);
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
        $friend = Friends::where('id', $id)->first();

        if ($friend) {
            return response()->json([
                'success' => true,
                'message' => "Detail Teman",
                'data' => $friend
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Detail Teman Tidak Ditemukan '
            ], 409);
        }
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
        $request->validate([
            'nama' => 'required|unique:friends|max:255',
            'no_tlp' => 'required|numeric',
            'alamat' => 'required'
        ]);

        $friend = Friends::find($id)
        ->update([
                    'nama' => $request->nama,
                    'no_telp' => $request->no_tlp,
                    'alamat' => $request->alamat
        ]);
        
        if($friend){
            return response()->json([
                'success' => true,
                'message' => "Data Teman Berhasil Dirubah",
                'data' => $friend
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Detail Teman Gagal Dirubah ',
                'data' => $friend
            ], 409);
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
        $friend = Friends::find($id)->delete();
        if($friend){
            return response()->json([
                'success' => true,
                'message' => "Data Teman Berhasil Dihapus",
                'data' => $friend
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Detail Teman Gagal Dihapus ',
                'data' => $friend
            ], 409);
        }
    }
}
