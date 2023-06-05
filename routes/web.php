<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Chat;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\MyApplication;
use App\Http\Livewire\MyBoxer;
use App\Http\Livewire\MyBoxingShow;
use App\Http\Livewire\MyClient;
use App\Http\Livewire\MyFightPost;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Signature;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('get-states-by-country', 'CountryStateCityController@getState');
Route::post('get-cities-by-state', 'CountryStateCityController@getCity');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile/{id?}', Profile::class)->name('profile');
    Route::get('/my_boxers', MyBoxer::class)->name('myboxer');
    Route::get('/contract', Signature::class)->name('contract');
    Route::get('/chat', Chat::class)->name('chat');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('can:boxer')->group(function () {
    Route::get('/my_clients', MyClient::class)->name('myclient');
    Route::get('/boxer/application', MyApplication::class)->name('boxer.application');
});

Route::middleware('can:match-maker')->group(function () {
    Route::get('/match-maker/post', MyFightPost::class)->name('matchmaker.post');
});

Route::middleware('can:promoter')->group(function () {
    Route::get('/my_boxing_show', MyBoxingShow::class)->name('myboxingshow');
});

require __DIR__ . '/auth.php';