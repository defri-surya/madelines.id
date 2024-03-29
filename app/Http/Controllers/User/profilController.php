<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class profilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = User::where('referal', $id)->first();
        return view('user.profil.create', compact('user'));
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
        // dd($id);
        $request->validate([
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1000',
        ]);

        $data = User::findOrFail($id);

        if ($request->hasFile('foto')) {
            //upload new image
            $image = $request->file('foto');
            $new_foto = time() . 'fotoprofil' . $image->getClientOriginalName();
            $tujuan_uploud = 'upload/fotoprofil/';
            $image->move($tujuan_uploud, $new_foto);

            //delete old image in local
            if (file_exists(($data->foto))) {
                unlink(($data->foto));
            }

            //Update With New Image 
            $data->update([
                'foto'          => $tujuan_uploud . $new_foto,
                'name'          => $request->name,
                'no_hp'         => $request->no_hp,
                'no_rekening'   => $request->no_rekening,
                'atas_nama'     => $request->atas_nama,
                'alamat'        => $request->alamat,
            ]);
        } else {
            // update without new image 
            $data->update([
                'name'          => $request->name,
                'no_hp'         => $request->no_hp,
                'no_rekening'   => $request->no_rekening,
                'atas_nama'     => $request->atas_nama,
                'alamat'        => $request->alamat,
            ]);
        }

        return back();
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
