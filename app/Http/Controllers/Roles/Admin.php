<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\HomeHeroBanner;
use App\Models\AboutUs;
use App\Models\HowDoesItWork;
use App\Models\ForRequesterSection;
use App\Models\ForProviderSection;
use App\Models\CTA;
use App\Models\Social;
use App\Models\Services;
use App\Models\Faqs;
use App\Models\ReqStatus;
use App\Models\ReqServices;
use App\Models\Requests;
use Illuminate\Support\Carbon;
use DB;
use Image;

class Admin extends Controller
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
        return redirect()->route('admin.profile');

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


    public function allUsers(){
        $role = 1;
        $users= User::latest()->get()->where('role_id', $role);
        return view('Admin.menu.all_users', compact('users'));
    }
    public function rallUsers(){
        $role = 2;
        $users= User::latest()->get()->where('role_id', $role);
        return view('Admin.menu.all_users', compact('users'));
    }
    public function pallUsers(){
        $role = 3;
        $users= User::latest()->get()->where('role_id', $role);
        return view('Admin.menu.all_users', compact('users'));
    }

    public function addUserpage(){
        $id = Auth::User()->id;
        $user = User::find($id);
        $roles = Role::get();
        return view('Admin.menu.add_users', compact('roles','user'));
    }


    public function editUser($id){
        $accdata = DB::table('bank_accounts')->where('user_id',$id)->first();
        $user = DB::table('users')->where('id',$id)->first();
        $roles = Role::get();
        return view('Admin.menu.edit_user', compact('user','roles','accdata'));
    }


    public function updateUser(Request $request){
        $id = $request->id;

        $user = DB::table('users')->where('id',$id)->first();
        $role = Role::get();
        $data = array();
        if(! $request->role_id){
            }else{$data['role_id'] = $request->role_id;}

        


        // $data['role_id'] = $request->role_id;    
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->newpassword);

    
    DB::table('users')->where('id',$id)->update($data);
    session()->flash('message','User Updated Successfully');
        return redirect()->route('allUsers');
    }

    public function deleteUser($id){
        DB::table('users')->where('id',$id)->delete();
        session()->flash('message','User Deleted Successfully');
        return redirect()->back();
    }

    public function addUser(Request $request){
        $data = array();
        $data['role_id'] = $request->role_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phoneNumber'] = $request->phoneNumber;
        $data['password'] = Hash::make($request->newpassword);

    
    DB::table('users')->insert($data);
    session()->flash('message','User Added Successfully');
        return redirect()->back();
    }
//-----------------------------------------------------------------------
// --------------------- Home Page Control ------------------------------
//-----------------------------------------------------------------------


        public function openheroBanner(){
        $hero = HomeHeroBanner::find(1);
        return view('Admin.home.heroBanner', compact('hero'));
    }

    public function updateHeroBanner(Request $request){

         $hero_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(430,327)->save('upload/hero/'.$name_gen);
            $save_url = 'upload/hero/'.$name_gen;

            HomeHeroBanner::findOrFail($hero_id)->update([
                'sub_title' => $request->sub_title,
                'title' => $request->title,
                
                'description' => $request->description,
                'button' => $request->button,
                'image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Hero Banner Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('openheroBanner')->with($notification);

        } else{

            HomeHeroBanner::findOrFail($hero_id)->update([
                'sub_title' => $request->sub_title,
                'title' => $request->title,
                'description' => $request->description,
                'button' => $request->button,

            ]); 

            $notification = array(
            'message' => 'Hero Banner Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('openheroBanner')->with($notification);

        } // end Else

    }


      public function openAboutUs(){
        $about = AboutUs::find(1);
        return view('Admin.home.aboutUs', compact('about'));
    }

    public function updateAboutUs(Request $request){

         $about = $request->id;

          AboutUs::findOrFail($about)->update([
                'vision' => $request->vision,
                'mission' => $request->mission,
                'description' => $request->description,
                'l1' => $request->l1,
                'l2' => $request->l2,
                'l3' => $request->l3,

            ]); 

            $notification = array(
            'message' => 'About Us Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('openAboutUs')->with($notification);

    }



      public function openHDIW(){
        $hdiw = HowDoesItWork::find(1);
        return view('Admin.home.howDoesItWork', compact('hdiw'));
    }

    public function updateHDIW(Request $request){

         $hdiw = $request->id;

          HowDoesItWork::findOrFail($hdiw)->update([
                'tab1' => $request->tab1,
                'tab2' => $request->tab2,
                'tab3' => $request->tab3,
                'tab11' => $request->tab11,
                'tab12' => $request->tab12,
                'tab13' => $request->tab13,
                'tab14' => $request->tab14,
                'tab21' => $request->tab21,
                'tab22' => $request->tab22,
                'tab23' => $request->tab23,
                'tab24' => $request->tab24,
                'tab31' => $request->tab31,
                'tab32' => $request->tab32,
                'tab33' => $request->tab33,
                'tab34' => $request->tab34,

            ]); 

            $notification = array(
            'message' => 'How Does It Work Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('openHDIW')->with($notification);

    }


       public function forRequesters(){
        $req = ForRequesterSection::find(1);
        return view('Admin.home.forRequesters', compact('req'));
    }

    public function updateforRequesters(Request $request){

         $req = $request->id;

          ForRequesterSection::findOrFail($req)->update([
                'description' => $request->description,
                'title1' => $request->title1,
                'description1' => $request->description1,
                'title2' => $request->title2,
                'description2' => $request->description2,
                'title3' => $request->title3,
                'description3' => $request->description3,
                'title4' => $request->title4,
                'description4' => $request->description4,
                
            ]); 

            $notification = array(
            'message' => 'For Requesters Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('forRequesters')->with($notification);

    }

      public function forProviders(){
        $prov = ForProviderSection::find(1);
        return view('Admin.home.forProviders', compact('prov'));
    }


    public function updateforProviders(Request $request){

         $prov_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(430,327)->save('upload/provider/'.$name_gen);
            $save_url = 'upload/provider/'.$name_gen;

            ForProviderSection::findOrFail($prov_id)->update([
                
                'description' => $request->description,
                'title1' => $request->title1,
                'description1' => $request->description1,
                'title2' => $request->title2,
                'description2' => $request->description2,
                'title3' => $request->title3,
                'description3' => $request->description3,
                'image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'For Provider Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('forProviders')->with($notification);

        } else{

            ForProviderSection::findOrFail($prov_id)->update([
                'description' => $request->description,
                'title1' => $request->title1,
                'description1' => $request->description1,
                'title2' => $request->title2,
                'description2' => $request->description2,
                'title3' => $request->title3,
                'description3' => $request->description3,

            ]); 

            $notification = array(
            'message' => 'For Provider Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('forProviders')->with($notification);

        } // end Else

    }


           public function cta(){
        $cta = CTA::find(1);
        return view('Admin.home.cta', compact('cta'));
    }

    public function updatecta(Request $request){

         $cta = $request->id;

          CTA::findOrFail($cta)->update([
                
                'title' => $request->title,
                'description' => $request->description,
                
                
            ]); 

            $notification = array(
            'message' => 'CTA Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('cta')->with($notification);

    }

       public function social(){
        $social = Social::find(1);
        return view('Admin.home.social', compact('social'));
    }

    public function updatesocial(Request $request){

         $social = $request->id;

          Social::findOrFail($social)->update([
                
                'facebook' => $request->facebook,
                'tw' => $request->tw,
                'insta' => $request->insta,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                
                
            ]); 

            $notification = array(
            'message' => 'Social Media Updated Successfully', 
            'alert-type' => 'success'
        );

       return redirect()->route('social')->with($notification);

    }

//-----------------------------------------------------------------------
// --------------------- Services ------------------------------
//-----------------------------------------------------------------------

     public function services(){
        $services= Services::latest()->get();
        return view('Admin.services.all_services', compact('services'));
    }

     public function NewService(){
        
        return view('Admin.services.add_service');
    }


    public function addService(Request $request){
        $data = array();
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        

    
    DB::table('services')->insert($data);
    session()->flash('message','Service Added Successfully');
        return redirect()->route('allServices');
    }


     public function deleteService($id){
        DB::table('services')->where('id',$id)->delete();
        session()->flash('message','Service Deleted Successfully');
        return redirect()->back();
    }


     public function editService($id){
        $service = DB::table('services')->where('id',$id)->first();
        
        return view('Admin.services.edit_service', compact('service'));
    }


    public function updateService(Request $request){
        $id = $request->id;
        $services = DB::table('services')->where('id',$id)->first();
        $data = array();
       
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        

    
    DB::table('services')->where('id',$id)->update($data);
    session()->flash('message','Service Updated Successfully');
        return redirect()->route('allServices');
    }




//-----------------------------------------------------------------------
// --------------------- Faqs ------------------------------
//-----------------------------------------------------------------------

     public function faqs(){
        $faqs= Faqs::latest()->get();
        return view('Admin.faqs.all_faqs', compact('faqs'));
    }

     public function NewFaqs(){
        
        return view('Admin.faqs.add_faqs');
    }


    public function addFaqs(Request $request){
        $data = array();
        $data['question'] = $request->question;
        $data['answer'] = $request->answer;
        

    
    DB::table('faqs')->insert($data);
    session()->flash('message','Faqs Added Successfully');
        return redirect()->route('allFaqs');
    }


     public function deleteFaqs($id){
        DB::table('Faqs')->where('id',$id)->delete();
        session()->flash('message','Faqs Deleted Successfully');
        return redirect()->back();
    }


     public function editFaqs($id){
        $faqs = DB::table('Faqs')->where('id',$id)->first();
        
        return view('Admin.faqs.edit_faqs', compact('faqs'));
    }


    public function updateFaqs(Request $request){
        $id = $request->id;
        $faqs = DB::table('faqs')->where('id',$id)->first();
        $data = array();
       
        $data['question'] = $request->question;
        $data['answer'] = $request->answer;
        

    
    DB::table('faqs')->where('id',$id)->update($data);
    session()->flash('message','Faqs Updated Successfully');
        return redirect()->route('allFaqs');
    }

//------------------------------ All Requests ---------------------------------
//----------------------------------------------------------------------------------

    public function adminAllReq(){
        
            $user= Auth::User()->id;
            $services= ReqServices::latest()->get();
            $requests= Requests::latest()->get();
            return view('Admin.requests.allRequests', compact('services', 'requests', 'user'));
    
    }

}
