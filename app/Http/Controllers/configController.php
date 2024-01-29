<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Produk;
use App\Models\ShareProfit;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class configController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $users = User::where('status_akun', 'Member')->get();

        // Memanggil fungsi untuk memproses upgrade level
        $this->processLevelUpgrades($users);

        $saldo = User::find($user->id);
        $totalWD = Withdraw::where('user_id', auth()->user()->id)->where('status', 'Sukses')->sum('nominal');
        $saldoEnd = $saldo->saldo - $totalWD;
        $userCount = User::where(function ($query) {
            $query->where('by_referal', auth()->user()->referal)
                ->orWhere('referal_1', auth()->user()->referal)
                ->orWhere('referal_2', auth()->user()->referal)
                ->orWhere('referal_3', auth()->user()->referal)
                ->orWhere('referal_4', auth()->user()->referal);
        })
            ->where('status_akun', 'Member')
            ->count();

        $allUser = User::where('status_akun', 'Member')->count();
        $allCalonUser = User::where('status_akun', 'Calon Member')->count();
        $produk = Produk::all();

        // Setup Progress Bar
        // Count by_referal
        $currentUser = User::where('status_akun', 'Member')->where('id', auth()->user()->id)->first();
        $totalNetworkInfo = $this->countTotalNetwork($currentUser->referal);
        $countReferal = $totalNetworkInfo['total'];

        $cektransaksi = Histori::where('user_id', auth()->user()->id)
            ->where('status', 'Sukses')
            ->where('keterangan', 'Beli Produk')
            ->exists();

        $transaksiCount = Histori::where('user_id', auth()->user()->id)
            ->where('status', 'Sukses')
            ->where('keterangan', 'Beli Produk')
            ->count();

        $cekRegis = Histori::where('user_id', auth()->user()->id)
            ->where('keterangan', 'Registrasi')
            ->where('status', 'Sukses')
            ->exists();

        $cekProfitPionir = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_pionir')
            ->exists();

        $cekProfitNM = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_nm')
            ->exists();

        $cekProfitSNM = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_snm')
            ->exists();

        $cekProfitJD = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_jd')
            ->exists();

        $cekProfitDirector = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_director')
            ->exists();

        $cekProfitSD = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_sd')
            ->exists();

        $cekProfitPD = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_pd')
            ->exists();

        $cekProfitRetirement = ShareProfit::where('user_id', auth()->user()->id)
            ->whereNotNull('profit_persen_retirement')
            ->exists();

        return view('dashboard.dashboard', compact(
            'saldoEnd',
            'userCount',
            'saldo',
            'allUser',
            'allCalonUser',
            'produk',
            'countReferal',
            'cektransaksi',
            'transaksiCount',
            'cekRegis',
            'cekProfitPionir',
            'cekProfitNM',
            'cekProfitSNM',
            'cekProfitJD',
            'cekProfitDirector',
            'cekProfitSD',
            'cekProfitPD',
            'cekProfitRetirement',
        ));
    }

    private function processLevelUpgrades($users)
    {
        foreach ($users as $user) {
            $profit = ShareProfit::where('user_id', auth()->user()->id)->first();
            $cekProfitPionir = isset($profit->profit_persen_pionir);
            $cekProfitNM = isset($profit->profit_persen_nm);
            $cekProfitSNM = isset($profit->profit_persen_snm);
            $cekProfitJD = isset($profit->profit_persen_jd);
            $cekProfitDirector = isset($profit->profit_persen_director);
            $cekProfitSD = isset($profit->profit_persen_sd);
            $cekProfitPD = isset($profit->profit_persen_pd);
            $cekProfitRetirement = isset($profit->profit_persen_retirement);
            $childCount = $this->countChildren($user->referal);

            // Syarat 1: Jika parent memiliki 5 children maka naik ke level 2
            if ($childCount >= 5 && $user->level == 1) {
                $user->update(['level' => 2]);
                $profit = ShareProfit::where('user_id', $user->id)->first();
                $profit->update([
                    'profit_persen_mitra' => '3'
                ]);
            }

            // Syarat 2: Jika children dan sub-children memiliki 5 children masing-masing, naik ke level 3
            if ($childCount >= 5 && $user->level == 2) {
                $subChildrenCount = $this->countSubChildren($user->referal);

                if ($subChildrenCount >= 25) {
                    $this->updateParentLevel($user->referal, 3);
                }
            }

            // Syarat 3: Jika children dan sub-children memiliki 5 children masing-masing, naik ke level 4
            if ($childCount >= 5 && $user->level == 3) {
                $subChildrenCount = $this->countTotalNetwork($user->referal);

                if ($subChildrenCount['total'] >= 125 && $cekProfitPionir !== null) {
                    $this->updateParentLevel($user->referal, 4);
                }
            }

            // Syarat 4: Jika children dan sub-children memiliki 5 children masing-masing, naik ke level 5
            if ($childCount >= 5 && $user->level == 4) {
                $subChildrenCount = $this->countTotalNetwork($user->referal);

                if ($subChildrenCount['total'] >= 625 && $cekProfitNM !== null) {
                    $this->updateParentLevel($user->referal, 5);
                }
            }

            // Syarat 5: Jika children dan sub-children memiliki 5 children masing-masing, naik ke level 6
            if ($childCount >= 5 && $user->level == 5) {
                $subChildrenCount = $this->countTotalNetwork($user->referal);

                if ($subChildrenCount['total'] >= 3125 && $cekProfitSNM !== null) {
                    $this->updateParentLevel($user->referal, 6);
                }
            }
        }
    }

    // Total Network
    private function countTotalNetwork($referal)
    {
        $result = [
            'total' => 0,
            'subNetworks' => [],
        ];

        $children = User::where('by_referal', $referal)->where('status_akun', 'Member')->get();

        foreach ($children as $child) {
            $subNetworkInfo = $this->countTotalNetwork($child->referal);
            $result['total'] += 1 + $subNetworkInfo['total']; // Menambahkan 1 untuk setiap child
            $result['subNetworks'][] = [
                'name' => $child->name,
                'total' => 1 + $subNetworkInfo['total'], // Menambahkan 1 untuk setiap child
                'subNetworks' => $subNetworkInfo['subNetworks'],
            ];
        }

        return $result;
    }
    // End

    private function updateParentLevel($referal, $newLevel)
    {
        $parent = User::where('referal', $referal)->first();

        if ($parent) {
            $parent->update(['level' => $newLevel]);
        }
    }

    private function countChildren($referal)
    {
        return User::where('by_referal', $referal)
            ->where('status_akun', 'Member')
            ->count();
    }

    private function countSubChildren($referal)
    {
        $subChildrenCount = 0;
        $children = User::where('by_referal', $referal)
            ->where('status_akun', 'Member')
            ->get();

        foreach ($children as $child) {
            $subChildrenCount += $this->countChildren($child->referal);
        }

        return $subChildrenCount;
    }

    private function updateChildrenLevels($referal, $newLevel)
    {
        $children = User::where('by_referal', $referal)
            ->where('status_akun', 'Member')
            ->get();

        foreach ($children as $child) {
            $child->update(['level' => $newLevel]);
            $this->updateChildrenLevels($child->referal, $newLevel);
        }
    }
}
