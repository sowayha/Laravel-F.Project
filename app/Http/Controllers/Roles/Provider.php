<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\BankAccount;
use DB;


class Provider extends Controller
{
    public function index(){
        return view('Admin.dashboard');

    }

     public function profilePage(){
        $id = Auth::User()->id;
        $adminData = User::find($id);
        return view('Admin.profile.profile', compact('adminData'));

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
        return redirect()->route('provider.profile');

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

        return view('Admin.profile.add_bank_account');

    }



     public function paddBankAcc(){
          $id = Auth::User()->id;
        $accdata = DB::table('bank_accounts')->where('user_id',$id)->first();

        return view('Admin.profile.add_bank_account', compact('accdata'));

    }


     public function psaveBankAcc(Request $request){
        $data = array();
        $data['user_id'] = Auth::User()->id;
        $data['account_number'] = $request->accNumber;
        $data['account_name'] = $request->accName;

    
    DB::table('bank_accounts')->insert($data);
    session()->flash('message','Your Bank Account Added Successfully');
        return redirect()->back();
    }

     public function peditBankAcc(){
        $id = Auth::User()->id;
        $accdata = DB::table('bank_accounts')->where('user_id',$id)->first();

        return view('Admin.profile.edit_bank_account', compact('accdata'));

    }


    public function pupdateBankAcc(Request $request){
      $data = array();
        $data['user_id'] = Auth::User()->id;
        $data['account_number'] = $request->accNumber;
        $data['account_name'] = $request->accName;

    
    DB::table('bank_accounts')->update($data);
    session()->flash('message','Your Bank Account Updated Successfully');
        return redirect()->route('provider.addBankAcc');
}

}
