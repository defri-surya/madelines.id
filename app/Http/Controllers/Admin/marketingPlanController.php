<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingPlan;
use Illuminate\Http\Request;

class marketingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketplan = MarketingPlan::all();
        return view('admin.marketingPlan.index', compact('marketplan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marketingPlan.create');
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
            $new_foto = time() . 'fotomarketplan' . $foto->getClientOriginalName();
            $tujuan_uploud = 'upload/fotomarketplan/';
            $foto->move($tujuan_uploud, $new_foto);
            $data['foto'] = $tujuan_uploud . $new_foto;
        }

        MarketingPlan::create($data);
        return redirect('/marketplan?ref=' . auth()->user()->referal);
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
        $marketplan = MarketingPlan::where('id', $id)->first();
        return view('admin.marketingPlan.edit', compact('marketplan'));
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

        $data = MarketingPlan::findOrFail($id);

        if ($request->hasFile('foto')) {
            //upload new image
            $image = $request->file('foto');
            $new_foto = time() . 'fotomarketplan' . $image->getClientOriginalName();
            $tujuan_uploud = 'upload/fotomarketplan/';
            $image->move($tujuan_uploud, $new_foto);

            //delete old image in local
            if (file_exists(($data->foto))) {
                unlink(($data->foto));
            }

            //Update With New Image 
            $data->update([
                'foto'  => $tujuan_uploud . $new_foto,
            ]);
        }
        return redirect('/marketplan?ref=' . auth()->user()->referal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MarketingPlan::findOrFail($id)->delete();
        return redirect()->back();
    }
}
