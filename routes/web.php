<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PoppingController;
use App\Http\Controllers\TeaController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Popping;
use App\Models\Tea;
//use DB;
use App\Models\Drink;
use App\Models\Order;

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
});

Route::get('/story', function () {
    if (! Gate::allows('access-user')) {
        return redirect()->route('register');
    } 

    $user = User::Find(auth()->user()->id);
    
    $orders = Drink::join('teas', 'drinks.teas_id', '=', 'teas.id')
                ->join('poppings', 'drinks.poppings_id', '=', 'poppings.id')
                ->join('users', 'drinks.user_id','=','users.id')
                ->where('user_id', '=', $user->id)
                ->where('drinks.status','=','OFF')
                ->select(['drinks.user_id AS user_id','drinks.status AS drink_status','drinks.id AS drink_id', 'teas.name AS tea_name', 'drinks.drinker_name', 'drinks.sugar', 'poppings.name AS popping_name'])    
                ->get();
    
    return view('/story', [
        'orders' => $orders,
        'user' => $user,
        ]);
});

Route::get('/admin', [UserController::class, 'index']);

Route::resource('teas', TeaController::class);
Route::resource('poppings', PoppingController::class);
Route::resource('drinks', DrinkController::class)->middleware('auth');
Route::resource('orders', OrderController::class);
Route::resource('users', UserController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/drinks/create/{id}', [DrinkController::class, 'create']);
Route::get('/drinks/index/{id}', [DrinkController::class, 'index']);

require __DIR__.'/auth.php';
