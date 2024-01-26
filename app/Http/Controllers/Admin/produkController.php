<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.create');
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
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1000',
        ]);

        $data = $request->all();

        if ($request->has('foto')) {
            $foto = $request->foto;
            $new_foto = time() . 'fotoproduk' . $foto->getClientOriginalName();
            $tujuan_uploud = 'upload/fotoproduk/';
            $foto->move($tujuan_uploud, $new_foto);
            $data['foto'] = $tujuan_uploud . $new_foto;
        }

        Produk::create($data);
        return redirect('/produk?ref=' . auth()->user()->referal);
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
        $produk = Produk::where('id', $id)->first();
        return view('admin.produk.edit', compact('produk'));
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

        $data = Produk::findOrFail($id);

        if ($request->hasFile('foto')) {
            //upload new image
            $image = $request->file('foto');
            $new_foto = time() . 'fotoproduk' . $image->getClientOriginalName();
            $tujuan_uploud = 'upload/fotoproduk/';
            $image->move($tujuan_uploud, $new_foto);

            //delete old image in local
            if (file_exists(($data->foto))) {
                unlink(($data->foto));
            }

            //Update With New Image 
            $data->update([
                'foto'       => $tujuan_uploud . $new_foto,
                'title'      => $request->title,
                'harga'      => $request->harga,
            ]);
        } else {
            // update with new image 
            $data->update([
                'title'      => $request->title,
                'harga'      => $request->harga,
            ]);
        }

        return redirect('/produk?ref=' . auth()->user()->referal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect()->back();
    }
}
