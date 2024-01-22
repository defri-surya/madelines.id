<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Histori;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/dashboard?ref=' . auth()->user()->referal);
    }

    public function allTransaksi()
    {
        $allTransaksi = Transaksi::all();
        return view('admin.transaksi.index', compact('allTransaksi'));
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
        $usedNumbers = Transaksi::pluck('kode_payment')->toArray();

        // Mendefinisikan batas atas percobaan pengambilan nomor acak
        $maxAttempts = 10;

        // Menginisialisasi variabel
        $randomNumber = null;

        // Melakukan percobaan maksimum
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            // Menghasilkan nomor acak
            $randomNumber = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Memeriksa apakah nomor acak sudah digunakan
            if (!in_array($randomNumber, $usedNumbers)) {
                // Jika belum digunakan, keluar dari loop
                break;
            }

            // Jika sudah digunakan, coba lagi hingga mencapai batas maksimum
        }
        $kode_payment = 'DEP' . date('Y') . $randomNumber;
        $data['kode_payment'] = $kode_payment;
        $data['tgl_payment'] = date('Y-m-d');
        $data['user_id'] = auth()->user()->id;
        $data['status_payment'] = 'Proses';

        $transaksi = Transaksi::create($data);

        $histori = new Histori;
        $histori->user_id = $data['user_id'];
        $histori->income = $data['nominal'];
        $histori->tgl = $data['tgl_payment'];
        $histori->keterangan = 'Deposit';
        $histori->status = $data['status_payment'];
        $histori->save();

        // Start Cookie For Payment
        $user = User::where('id', $transaksi->user_id)->first();
        $payment = json_decode(request()->cookie('payment'), true);
        $payment = [
            'order_code' => $transaksi->kode_payment,
            'nominal' => $transaksi->nominal,
            'nama' => $user->name,
            'email' => $user->email,
            // 'no_hp' => $user->no_hp,
        ];

        $cookie = cookie('payment', json_encode($payment), 2880);
        return redirect()->route('payment')->cookie($cookie);
    }

    public function payment()
    {
        $payment = json_decode(request()->cookie('payment'), true);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payment['order_code'],
                'gross_amount' => $payment['nominal'],
            ),
            'customer_details' => array(
                'first_name' => $payment['nama'],
                'email' => $payment['email'],
                // 'phone' => $payment['no_hp'],
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $url = "https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken";

        return redirect()->away($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
