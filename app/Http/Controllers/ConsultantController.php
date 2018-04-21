<?php

namespace Kolekta\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kolekta\User;
use Kolekta\SurveyCategory;
use Kolekta\RequestService;

class ConsultantController extends Controller
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
    public function index() {
        $request = RequestService::paginate(25);
        $category = SurveyCategory::pluck('name', 'id');
        $user = User::pluck('username', 'id');

        return view('templates.admin.pages.consultant.index', compact('request', 'category', 'user'));
    }
}