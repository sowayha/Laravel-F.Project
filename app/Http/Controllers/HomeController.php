<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CTA;
use App\Models\Requests;
use App\Models\ReqServices;
use App\Models\ReqStatus;
use App\Models\Quotation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Illuminate\Support\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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



    public function reqDetails($id){

        if (Auth::check()){
        $userid = Auth::User()->id;
        $user = User::find($userid);} else{ $user = Auth::User(); }

        if (Quotation::where('req_id', $id)->exists()) {
            $title = " عروض مقدمي الخدمة ";

         }
         else{
            $title = " لا يوجد عروض بعد... ";

         }

        $req = Requests::findOrFail($id);
        $cta = CTA::find(1);
        $services = ReqServices::orderBy('services','ASC')->get();
        $allreqs = Requests::latest()->paginate(3);
        $quotes = Quotation::get()->where('req_id',$id);
        return view('frontend.requests.request_details', compact('user', 'req', 'cta', 'allreqs', 'services', 'quotes', 'title'));

     }


    public function reqPage(){
        $cta = CTA::find(1);
        $services = ReqServices::orderBy('id','ASC')->get();
        $status = ReqStatus::orderBy('id','ASC')->get();

        $allreqs = Requests::latest()->paginate(3);
        return view('frontend.requests.requests', compact('cta', 'allreqs', 'services', 'status'));
    }


// filter
    public function serReq($id){

        $cta = CTA::find(1);
        $services = ReqServices::orderBy('id','ASC')->get();
        $status = ReqStatus::orderBy('id','ASC')->get();
        $allreqs = Requests::get()->where('service_id',$id)->paginate(5);
        $filterStatus = Requests::get()->where('status_id',$id)->paginate(5);
        return view('frontend.requests.filterByService', compact('cta', 'allreqs', 'services', 'status', 'filterStatus'));

     }

     public function statusReq($id){

        $cta = CTA::find(1);
        $services = ReqServices::orderBy('id','ASC')->get();
        $status = ReqStatus::orderBy('id','ASC')->get();
        $filterStatus = Requests::get()->where('status_id',$id)->paginate(5);

        return view('frontend.requests.filterByStatus', compact('cta', 'services', 'status', 'filterStatus'));

     }

     public function requesterReq($id){

        $cta = CTA::find(1);
        $services = ReqServices::orderBy('id','ASC')->get();
        $status = ReqStatus::orderBy('id','ASC')->get();
        $filterByrequester = Requests::get()->where('user_id',$id)->paginate(5);
        return view('frontend.requests.filterByrequester', compact('cta', 'services', 'status', 'filterByrequester'));

     }


     public function addQuote(Request $request){
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['req_id'] = $request->req_id;
        $data['req_deadline'] = $request->req_deadline;
        $data['cost'] = $request->cost;
        $data['message'] = $request->message;
        $data['created_at'] = Carbon::now();



    DB::table('quotations')->insert($data);
    session()->flash('message','Your Quotation Added Successfully');
        return redirect()->back()->with('error', 'added');
    }

}
