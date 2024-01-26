<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoPerusahaan;
use Illuminate\Http\Request;

class infoPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = InfoPerusahaan::first();
        return view('admin.infoPerusahaan.edit', compact('info'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1000',
        ]);

        $data = InfoPerusahaan::findOrFail($id);

        if ($request->hasFile('foto')) {
            //upload new image
            $image = $request->file('foto');
            $new_foto = time() . 'fotoperusahaan' . $image->getClientOriginalName();
            $tujuan_uploud = 'upload/fotoperusahaan/';
            $image->move($tujuan_uploud, $new_foto);

            //delete old image in local
            if (file_exists(($data->foto))) {
                unlink(($data->foto));
            }

            //Update With New Image 
            $data->update([
                'foto'      => $tujuan_uploud . $new_foto,
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'cp'        => $request->cp,
                'no_cs_1'   => $request->no_cs_1,
                'no_cs_2'   => $request->no_cs_2,
                'no_cs_3'   => $request->no_cs_3,
            ]);
        } else {
            // update with new image 
            $data->update([
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'alamat'    => $request->alamat,
                'cp'        => $request->cp,
                'no_cs_1'   => $request->no_cs_1,
                'no_cs_2'   => $request->no_cs_2,
                'no_cs_3'   => $request->no_cs_3,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
