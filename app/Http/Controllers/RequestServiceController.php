<?php

namespace Kolekta\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kolekta\SurveyCategory;
use Kolekta\RequestService;

class RequestServiceController extends Controller
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
        $request = RequestService::whereUser(Auth::User()->id)->orderBy('created_at', 'desc')->paginate(25);
        $category = SurveyCategory::pluck('name', 'id');
        
        return view('templates.admin.pages.request.index', compact('request', 'category'));
    }
    
    public function create() {
        $category = SurveyCategory::all();
        
        return view('templates.admin.pages.request.create', compact('category'));
    }
    
    public function store(Request $req) {
        $data = [
            'name'              => $req->name,
            'survey_category'   => $req->survey_category,
            'descriptions'      => $req->descriptions,
            'type'              => $req->type,
            'user'              => Auth::user()->id,
            'status'            => 'pending'
        ];
        
        RequestService::create($data);
        
        return redirect('request-service');
    }
}