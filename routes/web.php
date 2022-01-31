<?php
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Event;

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
    Alert::success('WELCOME');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login/custom', [
    'uses' => 'LoginController@login',
    'as' => 'login.custom'
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', function () {
        $events = Event::whereBetween('startDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status','Approve')
        ->where('part','!=','Committee Member')
        ->orderBy('startDate')
        ->get();
        //dd($events);
        return view('user')->with(compact('events'));
    })->name('user');

    Route::get('/committee', function () {
        $events = Event::whereBetween('startDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status','Approve')
        ->orderBy('startDate')
        ->get();
        return view('committee')->with(compact('events'));
    })->name('committee');

    Route::get('/kambing', function () {
        $events = Event::whereBetween('startDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status','Approve')
        ->orderBy('startDate')
        ->get();
        //dd($events);
        return view('admin')->with(compact('events'));
    })->name('kambing');
});

Route::put('committees/{user}', 'UserController@updateCom')->name('users.updateCom');
Route::resource('users', 'UserController');

Route::resource('bookingDetails', 'BookingDetailController');

Route::get('uCommittees', 'CommitteeController@uCommitteeIndex')->name('uCommittees.index');
Route::get('committeeUsers/{committee}', 'CommitteeController@showCom')->name('committees.showCom');
Route::get('adminProfile/{user}', 'CommitteeController@adminProfile')->name('committees.adminProfile');
Route::get('committeeP/{committeeP}', 'CommitteeController@comProfile')->name('committees.comProfile');
Route::get('committees/{user}/edit', 'CommitteeController@edit')->name('committees.edit');
Route::resource('committees', 'CommitteeController');

Route::get('myBookings', 'EventController@myBookingIndex')->name('myBookings.index');
Route::get('myBookings/create', 'EventController@myBookingCreate')->name('myBookings.create');
Route::post('myBookings', 'EventController@myBookingStore')->name('myBookings.store');
Route::get('myBookings/{event}', 'EventController@myBookingShow')->name('myBookings.show');
Route::get('myBookings/{event}/edit', 'EventController@myBookingEdit')->name('myBookings.edit');
Route::put('myBookings/{event}', 'EventController@myBookingUpdate')->name('myBookings.update');
Route::get('myBookingCancels/{event}', 'EventController@myBookingCancel')->name('myBookings.cancel');
Route::get('active/{event}', 'EventController@changeActive')->name('myBookings.active');

Route::get('uEvents', 'EventController@uEventIndex')->name('uEvents.index');
Route::get('admin', 'EventController@pendingIndex')->name('events.pending');
Route::get('adminApproved', 'EventController@approveIndex')->name('events.approve');
Route::get('overlap/{event}/approve', 'EventController@approveAnyway')->name('events.approveAnyway');
Route::get('overlapList', 'EventController@overlapList')->name('events.overlap');
Route::get('myEvent', 'EventController@myEvent')->name('myEvent.index');//myEvebt utk admin
Route::get('kambing/create', 'EventController@createAdmin')->name('events.createAdmin');
Route::post('uEvents', 'EventController@uEventStore')->name('uEvents.store');
Route::get('uEvents/{event}', 'EventController@uEventShow')->name('uEvents.show');
Route::get('uEvents/{event}/edit', 'EventController@uEventEdit')->name('uEvents.edit');
Route::put('uEvents/{event}', 'EventController@uEventUpdate')->name('uEvents.update');
Route::get('upcomings', 'EventController@upcoming')->name('upcomings.index');
Route::get('cancels/{event}', 'EventController@cancelEvent')->name('events.cancel');
Route::get('events/findForm', 'EventController@findForm')->name('events.findForm');
Route::post('find', 'EventController@getRecord')->name('events.find');

Route::get('committeeList', 'EventController@cBcommittee')->name('events.committee');
Route::get('createByuser', 'EventController@cBuser')->name('events.user');
Route::get('approve/{event}/notification', 'EventController@emailApprove')->name('email.approve');//nak view kan
Route::get('/sendemail/send', 'SendEmailController@send')->name('send.email');;//nak send email
Route::get('decline/{event}/notification', 'EventController@emailDecline')->name('email.decline');//nak view kan
Route::get('/sendemailDecline/send', 'SendEmailController@decline')->name('send.decline');//nak send email
Route::resource('events', 'EventController');

Route::get('myParts', 'ParticipateController@myPartIndex')->name('participates.myPartIndex');
Route::get('participates', 'ParticipateController@index')->name('participates.index');
Route::get('participates/create', 'ParticipateController@create')->name('participates.create');//others join
Route::get('myself/{event}', 'ParticipateController@myself')->name('participates.myself');//register formyself
Route::post('participates', 'ParticipateController@store')->name('participates.store');
Route::delete('myParts/{participate}', 'ParticipateController@destroy')->name('participates.destroy');
Route::get('participates/{event}/list', 'ParticipateController@listIndex')->name('participates.list');
Route::get('participates/{event}/manage', 'ParticipateController@manage')->name('participates.manage');
//Route::resource('participates', 'ParticipateController');

Route::get('adminEvent', 'EventController@eventAdmin')->name('events.adminEvent');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
Route::get('changeActive', 'EventController@changeActive')->name('change.active');

Route::get('/students','PrintController@index');
Route::get('/prnpriview','PrintController@prnpriview');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


