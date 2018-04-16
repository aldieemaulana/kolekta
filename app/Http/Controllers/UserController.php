<?php

namespace Kolekta\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kolekta\Category;
use Kolekta\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::User()->id);
        return view('templates.admin.pages.account', compact('user'));
    }

    public function detailEdit()
    {
        $user = User::findOrFail(Auth::User()->id);
        $categories = Category::wherePublic(true)->pluck('name', 'id');
        return view('templates.admin.pages.account_detail', compact('user', 'categories'));
    }

    public function detailEditStore(Request $request)
    {
        $user = User::findOrFail(Auth::User()->id);

        $email = ($request->email != $user->email) ? ["email" => 'required|string|email|max:255|unique:users'] : [];
        $password = ($request->password != "") ? ['password' => 'required|string|min:6|confirmed'] : [];

        $validation = $password;
        $validation = array_merge($validation, $email);
        $this->validate($request, $validation);

        $request["verified"] = ($request->email != $user->email) ? 0 : $user->verified;

        if ($request->password != "") {
            $request["password"] = Hash::make($request->password);
            $data = $request->all();
        }else{
            $data = $request->except("password");
        }

        $user->update($data);

        return redirect('user/account');
    }
}
