<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PoppingController;
use App\Http\Controllers\TeaController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use App\Models\Popping;
use App\Models\Tea;
use DB;
use App\Models\Drink;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function _construct() {
        $this->authorizeResource(Drink::class, 'drink');
        $this->middleware('auth');
    }

    public function index()
    {
        if (! Gate::allows('access-user')) {
            return redirect()->route('register');
        } 

        $user = User::Find(auth()->user()->id);
        $drinks = Drink::join('teas', 'drinks.teas_id', '=', 'teas.id')
                ->join('poppings', 'drinks.poppings_id', '=', 'poppings.id')
                ->where('user_id', '=', $user->id)
                ->where('drinks.status','=','ON')
                ->select(['drinks.status AS drink_status','drinks.id', 'teas.name AS tea_name', 'drinks.drinker_name', 'drinks.sugar', 'poppings.name AS popping_name'])    
                ->get();


        //return $drinks;
        return view('drinks/show_orders', [
        'drinks' => $drinks,
        'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Drink $drink, Order $order, User $user)
    {
        if (! Gate::allows('access-user')) {
            return redirect()->route('register');
        } 
        $user = User::Find(auth()->user()->id);
        $orders = Drink::join('teas', 'drinks.teas_id', '=', 'teas.id')
                    ->join('poppings', 'drinks.poppings_id', '=', 'poppings.id')
                    ->join('users', 'drinks.user_id','=','users.id')
                    ->where('user_id', '=', $user->id)
                    ->where('drinks.status','=','ON')
                    ->select(['drinks.user_id AS user_id','drinks.status AS drink_status','drinks.id AS drink_id', 'teas.name AS tea_name', 'drinks.drinker_name', 'drinks.sugar', 'poppings.name AS popping_name'])    
                    ->get();
        

        //return $orders;
        
        return view('payement', [
            'orders' => $orders,
            'user' => $user,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        
        if (! Gate::allows('access-user')) {
            return redirect()->route('register');
        } 
        $user = User::Find(auth()->user()->id);
        $id_user = $user->id;
        
        $orders = DB::table('drinks')
                    ->where('user_id','=',$id_user)
                    ->update(['status' => "OFF"]);
        //return $orders;
        //return $orders;

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = User::Find(auth()->user()->id);
        
        $orders = Drink::join('teas', 'drinks.teas_id', '=', 'teas.id')
                    ->join('poppings', 'drinks.poppings_id', '=', 'poppings.id')
                    ->join('users', 'drinks.user_id','=','users.id')
                    ->where('user_id', '=', $user->id)
                    ->where('drinks.status','=','OFF')
                    ->select(['drinks.user_id AS user_id','drinks.status AS drink_status','drinks.id AS drink_id', 'teas.name AS tea_name', 'drinks.drinker_name', 'drinks.sugar', 'poppings.name AS popping_name'])    
                    ->get();
        
        return view('drinks/show_orders', [
            'drinks' => $drinks,
            'user' => $user,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if (! Gate::allows('access-user')) {
            return redirect()->route('register');
        } 

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('dashboard');
    }

}

