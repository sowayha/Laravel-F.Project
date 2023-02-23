<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CTA;
use App\Models\Requests;
use App\Models\ReqServices;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function reqPage(){
        $cta = CTA::find(1);
        $services = ReqServices::orderBy('services','ASC')->get();
        $allreqs = Requests::latest()->paginate(3);
        return view('frontend.requests', compact('cta', 'allreqs', 'services'));
    }


    public function serReq($id){

        $cta = CTA::find(1);
        $services = ReqServices::orderBy('services','ASC')->get();
        $allreqs = Requests::latest()->paginate(3);
        return view('frontend.requests', compact('cta', 'allreqs', 'services'));

     } 

}
