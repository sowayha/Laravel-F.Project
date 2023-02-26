<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\BankAccount;
use App\Models\ReqStatus;
use App\Models\ReqServices;
use App\Models\Requests;
use Illuminate\Support\Carbon;

use DB;



class Requester extends Controller
{
    public function index(){
        return view('Admin.dashboard');

    }

     public function profilePage(){
        $id = Auth::User()->id;
        $adminData = User::find($id);
        $accdata = DB::table('bank_accounts')->where('user_id',$id)->first();
        return view('Admin.profile.profile', compact('adminData','accdata'));

    }
    public function editProfile(){
        $id = Auth::User()->id;
        $user = User::find($id);
        $roles = Role::get();
        return view('Admin.profile.edit_profile', compact('user','roles'));

    }
    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phoneNumber = $request->phoneNumber;

        // $data->role_id = $request->role_id;
        $data->save();
        session()->flash('message','Profile Updated Successfully');
        return redirect()->route('requester.profile');

    }

    public function changePass(){

        return view('Admin.profile.change_password');

    }

    public function UpdatePassword(Request $request){
    $validateData = $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirm_password' => 'required|same:newpassword',

    ]);

    $hashedPassword = Auth::user()->password;
    if (Hash::check($request->oldpassword,$hashedPassword )) {
        $users = User::find(Auth::id());
        $users->password = bcrypt($request->newpassword);
        $users->save();

        session()->flash('message','Password Updated Successfully');
        return redirect()->back();
    } else{
        session()->flash('message','Old password is not match');
        return redirect()->back();
    }

}


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function addBankAcc(){
          $id = Auth::User()->id;
        $accdata = DB::table('bank_accounts')->where('user_id',$id)->first();

        return view('Admin.profile.add_bank_account', compact('accdata'));

    }


     public function saveBankAcc(Request $request){
        $data = array();
        $data['user_id'] = Auth::User()->id;
        $data['account_number'] = $request->accNumber;
        $data['account_name'] = $request->accName;


    DB::table('bank_accounts')->insert($data);
    session()->flash('message','Your Bank Account Added Successfully');
        return redirect()->back();
    }

     public function editBankAcc(){
        $id = Auth::User()->id;
        $accdata = DB::table('bank_accounts')->where('user_id',$id)->first();

        return view('Admin.profile.edit_bank_account', compact('accdata'));

    }


    public function updateBankAcc(Request $request){
      $data = array();
        $data['user_id'] = Auth::User()->id;
        $data['account_number'] = $request->accNumber;
        $data['account_name'] = $request->accName;


    DB::table('bank_accounts')->update($data);
    session()->flash('message','Your Bank Account Updated Successfully');
        return redirect()->route('requester.addBankAcc');
}



//-----------------------------------------------------------------------
// --------------------- Services ------------------------------
//-----------------------------------------------------------------------

public function allServices(){
    $user= Auth::User()->id;
    $services= ReqServices::latest()->get();
    $requests= Requests::latest()->where('user_id',$user)->get();
    return view('Admin.requests.allRequests', compact('services', 'requests'));
}

 public function reqPage(){
    $id = Auth::User()->id;
        $user = User::find($id);
        $status = ReqStatus::find(1);
        $services = ReqServices::orderBy('id','ASC')->get();
    return view('Admin.requests.addRequest', compact('user', 'status', 'services'));
}


public function addService(Request $request){
    $data = array();
    $data['user_id'] = $request->user_id;
    $data['service_id'] = $request->service_id;
    $data['title'] = $request->title;
    $data['description'] = $request->description;
    $data['cost'] = $request->cost;

    $data['created_at'] = Carbon::now();



DB::table('requests')->insert($data);
session()->flash('message','Service Added Successfully');
    return redirect()->route('allServices');
}


 public function deleteService($id){
    DB::table('requests')->where('id',$id)->delete();
    session()->flash('message','Service Deleted Successfully');
    return redirect()->back();
}


 public function editService($id){
    $req = DB::table('requests')->where('id',$id)->first();
    $service = ReqServices::get();
    $status = ReqStatus::get();
    return view('Admin.requests.editRequest', compact('service', 'req', 'status'));
}


public function updateService(Request $request){
    $id = $request->id;
    $requests = DB::table('requests')->where('id',$id)->first();
    $data = array();

    $data['service_id'] = $request->service_id;
    $data['title'] = $request->title;
    $data['description'] = $request->description;
    $data['cost'] = $request->cost;
    $data['status_id'] = $request->status_id;




DB::table('requests')->where('id',$id)->update($data);
session()->flash('message','Service Updated Successfully');
    return redirect()->route('allServices');
}


}
