<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Groups::orderBy('id', 'desc')->get();
        if ($groups) {
            return response()->json([
                "Success" => true,
                "Message" => "Daftar Data Groups",
                "Data" => $groups
            ], 200);
        } else {
            return  response()->json([
                "Success" => false,
                "Message" => "Daftar Data Groups Tidak Ada",
                "Data" => $groups
            ], 409);
        }
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
            'name' => 'required|unique:groups|max:255',
            'description' => 'required'
        ]);

        $group = Groups::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if($group){
            return response()->json([
                "Success" => true,
                "Message" => "Berhasil Menambahkan Group",
                "Data" => $group
            ], 200);
        } else {
            return response()->json([
                "Success" => false,
                "Message" => "Gagal Menambahkan Group",
                "Data" => $group
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
        $group = Groups::where('id',$id)->first();

        if($group){
            return response()->json([
                "Success" => true,
                "Mesaage" => "Detail Group",
                "Data" => $group
            ], 200);
        } else {
            return response()->json([
                "Success" => false,
                "Mesaage" => "Detail Group Tidak Ditemukan",
                "Data" => $group
            ], 200);
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
            'name' => 'required|unique:groups|max:255',
            'description' => 'required'
        ]);

        $group = Groups::find($id)
        ->update([
                    'name' => $request->name,
                    'description' => $request->description
        ]);
        
        if($group){
            return response()->json([
                'Success' => true,
                'Message' => "Data Group Berhasil Dirubah",
                'Data' => $group
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Data Group Gagal Dirubah ',
                'Data' => $group
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
        $group = Groups::find($id)->delete();
        if($group){
            return response()->json([
                'Success' => true,
                'Message' => "Data Group Berhasil Dihapus",
                'Data' => $group
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Detail Group Gagal Dihapus ',
                'Data' => $group
            ], 409);
        }
    }
}
