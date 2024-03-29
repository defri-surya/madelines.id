<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status_akun', 'Member')->get();
        $treeCM = User::where('status_akun', 'Calon Member')->get();

        $tree = [];

        foreach ($users as $user) {
            $tree[] = $this->buildTree($user);
        }

        return view('admin.anggota.index', compact('tree', 'treeCM'));
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
        // dd($tree);
        return view('admin.anggota.show', compact('tree'));
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
