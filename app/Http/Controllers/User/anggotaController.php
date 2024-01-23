<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class anggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $tree = $this->buildTree($user);
        $treeCM = $this->calonMember($user);

        return view('user.anggota.index', compact('tree', 'treeCM'));
    }

    private function buildTree($user)
    {
        $tree = [];

        if ($user) {
            $tree['user'] = $user->toArray();

            $children = User::where('by_referal', $user->referal)
                ->where('status_akun', 'Member')
                ->get();

            if ($children) {
                foreach ($children as $child) {
                    $tree['user']['children'][] = $this->buildTree($child);
                }
            }
        }

        return $tree;
    }

    private function calonMember($user)
    {
        $treeCM = [];

        if ($user) {
            $treeCM['user'] = $user->toArray();

            $childrenCM = User::where('by_referal', $user->referal)
                ->where('status_akun', 'Calon Member')
                ->get();

            if ($childrenCM->isNotEmpty()) {
                foreach ($childrenCM as $childCM) {
                    $treeCM['user']['children'][] = $this->calonMember($childCM);
                }
            } else {
                $treeCM['user']['children'] = [];
            }
        }

        return $treeCM;
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
        $user = User::where('referal', $id)->first();
        $tree = $this->buildTrees($user);
        $treeCM = $this->calonMembers($user);
        // dd($tree);
        return view('user.anggota.show', compact('tree', 'treeCM'));
    }

    private function buildTrees($user)
    {
        $tree = [];

        if ($user) {
            $tree['user'] = $user->toArray();

            $children = User::where('by_referal', $user->referal)
                ->where('status_akun', 'Member')
                ->get();

            if ($children) {
                foreach ($children as $child) {
                    $tree['user']['children'][] = $this->buildTrees($child);
                }
            }
        }

        return $tree;
    }

    private function calonMembers($user)
    {
        $treeCM = [];

        if ($user) {
            $treeCM['user'] = $user->toArray();

            $childrenCM = User::where('by_referal', $user->referal)
                ->where('status_akun', 'Calon Member')
                ->get();

            if ($childrenCM->isNotEmpty()) {
                foreach ($childrenCM as $childCM) {
                    $treeCM['user']['children'][] = $this->calonMembers($childCM);
                }
            } else {
                $treeCM['user']['children'] = [];
            }
        }

        return $treeCM;
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
