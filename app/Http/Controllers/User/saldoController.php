<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Histori;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class saldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saldo = User::where('id', auth()->user()->id)->first();
        $transaksi = Histori::where('user_id', auth()->user()->id)->get();
        $totalWD = Withdraw::where('user_id', auth()->user()->id)->where('status', 'Sukses')->sum('nominal');
        $saldoEnd = $saldo->saldo - $totalWD;

        return view('user.saldo.index', compact('saldoEnd', 'transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        return view('user.saldo.create', compact('transaksi'));
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
