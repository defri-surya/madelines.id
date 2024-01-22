<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Histori;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class withdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $WDProses = Withdraw::where('status', 'Proses')->get();
        $WDSukses = Withdraw::where('status', 'Sukses')->get();
        return view('admin.withdraw.index', compact('WDProses', 'WDSukses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saldo = User::where('id', auth()->user()->id)->first();
        $withdraw = Withdraw::where('user_id', auth()->user()->id)->get();
        $totalWD = Withdraw::where('user_id', auth()->user()->id)->where('status', 'Sukses')->sum('nominal');
        $saldoEnd = $saldo->saldo - $totalWD;
        return view('user.withdraw.create', compact('withdraw', 'saldoEnd'));
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
        $now = Carbon::now();
        $dateOnly = $now->toDateString();

        $randomNumber = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $data['kode_wd'] = 'WD2024' . $randomNumber;
        $data['status'] = 'Proses';
        $data['tgl_wd'] = $dateOnly;
        $data['user_id'] = auth()->user()->id;
        // dd($data);
        Withdraw::create($data);

        $histori = new Histori;
        $histori->user_id = $data['user_id'];
        $histori->expenditure = $data['nominal'];
        $histori->tgl = $data['tgl_wd'];
        $histori->keterangan = 'Withdraw';
        $histori->status = $data['status'];
        $histori->save();

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
        // dd($id);
        $konfirm = Withdraw::where('kode_wd', $id)->first();
        $histori = $konfirm->id;
        $konfirm->update([
            'status' => 'Sukses'
        ]);

        $histori->update([
            'status' => 'Sukses'
        ]);

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
