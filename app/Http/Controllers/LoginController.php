<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{

	public function login(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$users = User::where('email',$request->email)->first();
			if ($users->active == 1) {
				dd('aktif');exit;
			}
			dd('tidak aktif');exit;
		}
	}

}
