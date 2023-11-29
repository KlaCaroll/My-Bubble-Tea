<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Popping;
use App\Models\Tea;
use App\Models\Drink;
use App\Models\User;
use App\Http\Controllers\Auth;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Gate;

class DrinkController extends Controller
{
    public function _construct() {
        $this->authorizeResource(Order::class, 'order');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        if (! Gate::allows('access-user')) {
            return redirect()->route('register');
        } 
        
        $user = User::Find(auth()->user()->id);
        $poppings = Popping::all();
        $tea = Tea::Find($id);
        return view('drinks/create_drink')->with(compact('tea','poppings','user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Drink $drink, User $user)
    {
        //dd($user->name);
        //$user = User::Find(auth()->user());
        $validated = $request->validate([
            'drinker_name' => 'max:255',
            'poppings_id' => 'max:255',
            'teas_id' => 'required|max:255',
            'sugar' => 'max:5',
            'price' => 'max:40',
            'status' => 'max:15',
        ]);
        
        //dd($validated);
        $validated['user_id'] = $request->user()->id;
        $drink->poppings_id = $validated['poppings_id'];
        $drink->drinker_name = $validated['drinker_name'];
        $drink->teas_id = $validated['teas_id'];
        $drink->status = $validated['status'];
        //$drink->price = $validated['price'];
        $drink->sugar = $validated['sugar'];

        $drink = Drink::create($validated);
        //dd($drink);
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drink $drink)
    {
        $drink->delete();
        return redirect()->route('orders.index');
    }
}
