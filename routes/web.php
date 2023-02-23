<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/requests', [App\Http\Controllers\HomeController::class, 'reqPage'])->name('front.reqPage');
Route::get('/services/request/{id}', [App\Http\Controllers\HomeController::class, 'serReq'])->name('serReq');





Route::group(['prefix'=>'a' ,  'middleware'=>['auth','admin']], function(){
    Route::get('dashboard', [App\Http\Controllers\Roles\Admin::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [App\Http\Controllers\Roles\Admin::class, 'profilePage'])->name('admin.profile');
    Route::get('edit/profile', [App\Http\Controllers\Roles\Admin::class, 'editProfile'])->name('admin.editProfile');
    Route::post('update/profile', [App\Http\Controllers\Roles\Admin::class, 'updateProfile'])->name('admin.update.profile');
    Route::get('change/password', [App\Http\Controllers\Roles\Admin::class, 'changePass'])->name('admin.changePassword');
    Route::post('update/password', [App\Http\Controllers\Roles\Admin::class, 'UpdatePassword'])->name('admin.change');
    Route::get('logout', [App\Http\Controllers\Roles\Admin::class, 'destroy'])->name('admin.logout');
    Route::get('admins', [App\Http\Controllers\Roles\Admin::class, 'allUsers'])->name('allUsers');
    Route::get('requesters', [App\Http\Controllers\Roles\Admin::class, 'rallUsers'])->name('rallUsers');
    Route::get('providers', [App\Http\Controllers\Roles\Admin::class, 'pallUsers'])->name('pallUsers');
    Route::get('add/user', [App\Http\Controllers\Roles\Admin::class, 'addUserpage'])->name('addUser');
    Route::get('edit/user/{id}', [App\Http\Controllers\Roles\Admin::class, 'editUser'])->name('admin.editUser');
     Route::post('update/user', [App\Http\Controllers\Roles\Admin::class, 'updateUser'])->name('admin.updateUser');
    Route::get('delete/user/{id}', [App\Http\Controllers\Roles\Admin::class, 'deleteUser'])->name('admin.deleteUser');

    Route::post('add/new/user', [App\Http\Controllers\Roles\Admin::class, 'addUser'])->name('admin.addnewUser');

    Route::get('requests', [App\Http\Controllers\Roles\Admin::class, 'adminAllReq'])->name('admin.allReq');


//------------------------------ Home Page Control ---------------------------------
//----------------------------------------------------------------------------------


    Route::get('hero/banner', [App\Http\Controllers\Roles\Admin::class, 'openheroBanner'])->name('openheroBanner');

     Route::post('update/hero/banner', [App\Http\Controllers\Roles\Admin::class, 'updateHeroBanner'])->name('updateHeroBanner');

     Route::get('about', [App\Http\Controllers\Roles\Admin::class, 'openAboutUs'])->name('openAboutUs');

     Route::post('update/about/us', [App\Http\Controllers\Roles\Admin::class, 'updateAboutUs'])->name('updateAboutUs');

     Route::get('steps', [App\Http\Controllers\Roles\Admin::class, 'openHDIW'])->name('openHDIW');

     Route::post('update/steps', [App\Http\Controllers\Roles\Admin::class, 'updateHDIW'])->name('updateHDIW');

      Route::get('requesters/section', [App\Http\Controllers\Roles\Admin::class, 'forRequesters'])->name('forRequesters');

     Route::post('update/requesters/section', [App\Http\Controllers\Roles\Admin::class, 'updateforRequesters'])->name('updateforRequesters');

     Route::get('providers/section', [App\Http\Controllers\Roles\Admin::class, 'forProviders'])->name('forProviders');

     Route::post('update/providers/section', [App\Http\Controllers\Roles\Admin::class, 'updateforProviders'])->name('updateforProviders');

     Route::get('cta', [App\Http\Controllers\Roles\Admin::class, 'cta'])->name('cta');

     Route::post('update/cta', [App\Http\Controllers\Roles\Admin::class, 'updatecta'])->name('updatecta');

     Route::get('socials', [App\Http\Controllers\Roles\Admin::class, 'social'])->name('social');

     Route::post('update/social', [App\Http\Controllers\Roles\Admin::class, 'updatesocial'])->name('updatesocial');


     //-------------------------------------------------------------------------------
//------------------------ services ---------------------------------------------------
     //--------------------------------------------------------------------------------


     Route::get('services', [App\Http\Controllers\Roles\Admin::class, 'services'])->name('allServices');

     Route::get('new/service', [App\Http\Controllers\Roles\Admin::class, 'NewService'])->name('NewService');

     Route::post('add/new/service', [App\Http\Controllers\Roles\Admin::class, 'addService'])->name('addNewService');


     Route::get('edit/service/{id}', [App\Http\Controllers\Roles\Admin::class, 'editService'])->name('editService');
     Route::post('update/service', [App\Http\Controllers\Roles\Admin::class, 'updateService'])->name('updateService');

    Route::get('delete/service/{id}', [App\Http\Controllers\Roles\Admin::class, 'deleteService'])->name('deleteService');


        //-------------------------------------------------------------------------------
//------------------------ Faqs ---------------------------------------------------
     //--------------------------------------------------------------------------------


Route::get('faqs', [App\Http\Controllers\Roles\Admin::class, 'faqs'])->name('allFaqs');

     Route::get('new/faqs', [App\Http\Controllers\Roles\Admin::class, 'NewFaqs'])->name('NewFaqs');

     Route::post('add/new/faqs', [App\Http\Controllers\Roles\Admin::class, 'addFaqs'])->name('addNewFaqs');


     Route::get('edit/faqs/{id}', [App\Http\Controllers\Roles\Admin::class, 'editFaqs'])->name('editFaqs');
     Route::post('update/faqs', [App\Http\Controllers\Roles\Admin::class, 'updateFaqs'])->name('updateFaqs');

    Route::get('delete/faqs/{id}', [App\Http\Controllers\Roles\Admin::class, 'deleteFaqs'])->name('deleteFaqs');
    





});




Route::group(['prefix'=>'r' ,  'middleware'=>['auth','requester']], function(){
    Route::get('dashboard', [App\Http\Controllers\Roles\Requester::class, 'index'])->name('requester.dashboard');
     Route::get('profile', [App\Http\Controllers\Roles\Requester::class, 'profilePage'])->name('requester.profile');
    Route::get('edit/profile', [App\Http\Controllers\Roles\Requester::class, 'editProfile'])->name('requester.editProfile');
    Route::post('update/profile', [App\Http\Controllers\Roles\Requester::class, 'updateProfile'])->name('requester.update.profile');
    Route::get('change/password', [App\Http\Controllers\Roles\Requester::class, 'changePass'])->name('requester.changePassword');
    Route::post('update/password', [App\Http\Controllers\Roles\Requester::class, 'UpdatePassword'])->name('requester.change');
    Route::get('logout', [App\Http\Controllers\Roles\Requester::class, 'destroy'])->name('requester.logout');

    Route::get('bank/account/page', [App\Http\Controllers\Roles\Requester::class, 'addBankAcc'])->name('requester.addBankAcc');
    Route::get('edit/bank/account', [App\Http\Controllers\Roles\Requester::class, 'editBankAcc'])->name('requester.editBankAcc');
    Route::post('update/bank/account', [App\Http\Controllers\Roles\Requester::class, 'updateBankAcc'])->name('requester.updateBankAcc');



    Route::post('add/bank/account', [App\Http\Controllers\Roles\Requester::class, 'saveBankAcc'])->name('requester.saveBankAcc');


    Route::get('add/request', [App\Http\Controllers\Roles\Requester::class, 'reqPage'])->name('addReqPage');

    Route::get('all/services', [App\Http\Controllers\Roles\Requester::class, 'allServices'])->name('allServices');

    Route::post('save/service', [App\Http\Controllers\Roles\Requester::class, 'addService'])->name('addReqService');


    Route::get('edit/service/{id}', [App\Http\Controllers\Roles\Requester::class, 'editService'])->name('editReqService');
    Route::post('update/service', [App\Http\Controllers\Roles\Requester::class, 'updateService'])->name('updateReqService');

   Route::get('delete/service/{id}', [App\Http\Controllers\Roles\Requester::class, 'deleteService'])->name('deleteReqService');

});





Route::group(['prefix'=>'p' ,  'middleware'=>['auth','provider']], function(){
    Route::get('dashboard', [App\Http\Controllers\Roles\Provider::class, 'index'])->name('provider.dashboard');
     Route::get('profile', [App\Http\Controllers\Roles\Provider::class, 'profilePage'])->name('provider.profile');
    Route::get('edit/profile', [App\Http\Controllers\Roles\Provider::class, 'editProfile'])->name('provider.editProfile');
    Route::post('update/profile', [App\Http\Controllers\Roles\Provider::class, 'updateProfile'])->name('provider.update.profile');
    Route::get('change/password', [App\Http\Controllers\Roles\Provider::class, 'changePass'])->name('provider.changePassword');
    Route::post('update/password', [App\Http\Controllers\Roles\Provider::class, 'UpdatePassword'])->name('provider.change');
    Route::get('logout', [App\Http\Controllers\Roles\Provider::class, 'destroy'])->name('provider.logout');


    Route::get('bank/account/page', [App\Http\Controllers\Roles\Provider::class, 'paddBankAcc'])->name('provider.addBankAcc');
    Route::get('edit/bank/account', [App\Http\Controllers\Roles\Provider::class, 'peditBankAcc'])->name('provider.editBankAcc');
    Route::post('update/bank/account', [App\Http\Controllers\Roles\Provider::class, 'pupdateBankAcc'])->name('provider.updateBankAcc');



    Route::post('add/bank/account', [App\Http\Controllers\Roles\Provider::class, 'psaveBankAcc'])->name('provider.saveBankAcc');
});

