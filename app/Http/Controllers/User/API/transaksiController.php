<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use App\Models\Histori;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class transaksiController extends Controller
{
    public function statusbayar(Request $request)
    {
        $json = json_decode($request->getContent());
        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($signature_key != $json->signature_key) {
            return abort(404);
        }

        // Ubah Status Payment
        $data = Transaksi::where('kode_payment', $json->order_id)->get();
        if ($json->transaction_status == 'pending') {
            foreach ($data as $value) {
                $value->update([
                    'status_payment' => 'Proses',
                ]);
            }
        }
        if ($json->transaction_status == 'settlement') {
            foreach ($data as $value) {
                $value->update([
                    'metode_payment' => $json->payment_type,
                    'status_payment' => 'Sukses',
                ]);

                $histori = Histori::where('user_id', $value->user_id)->first();
                $histori->update([
                    'status' => 'Sukses'
                ]);

                $user = User::where('id', $value->user_id)->first();
                if ($user->saldo === null) {
                    // Jika saldo null, gunakan nilai 10000
                    $newSaldo = $user->saldo + 10000;
                    $user->update([
                        'status_akun' => 'Member',
                        'saldo' => $newSaldo,
                    ]);

                    // Memberikan bonus ke 5 tingkat user yang berhubungan
                    $bonusNominals = [10000, 3000, 2000, 1000, 1000]; // Bonus nominal untuk masing-masing tingkat

                    // Mendapatkan referal_1 hingga referal_5 dari tabel
                    $referals = [
                        $user->by_referal,
                        $user->referal_1,
                        $user->referal_2,
                        $user->referal_3,
                        $user->referal_4,
                    ];

                    foreach ($referals as $index => $referal) {
                        if ($referal) {
                            // Temukan pengguna berdasarkan referal
                            $referralUser = User::where('referal', $referal)
                                ->where('status_akun', 'Member')
                                ->first();

                            // Update saldo untuk pengguna yang merujuk
                            if ($referralUser) {
                                $bonus = $bonusNominals[$index]; // Bonus sesuai dengan tingkatnya
                                $referralUser->saldo += $bonus;
                                $referralUser->save();
                            }
                        }
                    }
                } else {
                    // Jika saldo tidak null, gunakan nilai dari $json->gross_amount
                    $newSaldo = $user->saldo + (int) $json->gross_amount;
                    $user->update([
                        'saldo' => $newSaldo,
                    ]);
                }
            }
        }
        if ($json->transaction_status == 'expire') {
            foreach ($data as $value) {
                $value->update([
                    'status_payment' => 'Gagal',
                ]);
            }
        }
    }
}
