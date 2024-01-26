<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutOnCloseController extends Controller
{
    public function logoutOnClose(Request $request)
    {
        // Lakukan proses logout di sini
        Auth::logout();

        // Respon apa pun yang diperlukan kembali ke JavaScript
        return response()->json(['message' => 'Logout successful']);
    }
}
