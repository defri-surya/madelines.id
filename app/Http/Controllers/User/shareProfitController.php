<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShareProfit;
use App\Models\User;
use Illuminate\Http\Request;

class shareProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        alert()->warning('Maaf', 'Halaman Sedang Dalam Pengembangan !');
        return redirect()->back();
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
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_pionir' => '2'
        ]);

        return redirect()->back();
    }

    public function storeNM(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_nm' => '1'
        ]);

        return redirect()->back();
    }

    public function storeSNM(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_snm' => '1'
        ]);

        return redirect()->back();
    }

    public function storeJD(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_jd' => '1'
        ]);

        return redirect()->back();
    }

    public function storeDirector(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_director' => '1'
        ]);

        return redirect()->back();
    }

    public function storeSD(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_sd' => '1'
        ]);

        return redirect()->back();
    }

    public function storePD(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_pd' => '1'
        ]);

        return redirect()->back();
    }

    public function storeRetirement(Request $request)
    {
        $data = $request->all();
        $profit = ShareProfit::where('user_id', $data['user_id'])->first();
        $profit->update([
            'profit_persen_retirement' => '1'
        ]);

        return redirect()->back();
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
        //
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
