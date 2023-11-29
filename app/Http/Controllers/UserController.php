<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drink;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PoppingController;
use App\Http\Controllers\TeaController;
use App\Http\Controllers\DrinkController;
use db;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function _construct() {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $users = User::all();

        return view('admins.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // $this->aurthorize('create', User::class);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->aurthorize('create', User::class);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'tel' => 'required|max:10',
            'email' => 'required|max:50'
            
        ]);

        $validated['user_id'] = 1;
        $user = User::create($validated);

        return redirect()->route('user.show', ['user' => $user->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$this->aurthorize('view', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //$this->aurthorize('update', $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$this->aurthorize('update', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Drink $drink)
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $drink = Drink::where('user_id', '=', $user->id)
            ->delete();
        //return $user;
        $user->delete();
        //$user->delete();
        return view('/admin');
    }
}
