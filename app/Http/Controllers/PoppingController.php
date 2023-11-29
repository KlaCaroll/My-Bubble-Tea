<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Popping;
use Illuminate\Support\Facades\Gate;

class PoppingController extends Controller
{
    public function _construct()
    {
        $this->authorizeResource(Popping::class, 'popping');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poppings = Popping::all();

        return view('poppings/product_poppings', [
            'poppings' => $poppings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('poppings/create_poppings');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:11',
            'description' => 'required|max:1000',
        ]);

        $popping = Popping::create($validated);

        return redirect()->route('poppings.show', ['popping' => $popping->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $popping = Popping::Find($id);
        return view('poppings/show_popping', [
            'popping' => $popping
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Popping $popping)
    {
        return view('poppings/edit_poppings', ['popping' => $popping]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Popping $popping)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:10',
            'description' => 'required|max:1000'
        ]);

        $popping->name = $validated['name'];
        $popping->price = $validated['price'];
        $popping->description = $validated['description'];

        $popping->save();

        return redirect()->route('poppings.show', ['popping' => $popping->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Popping $popping)
    {
        $popping->delete();
        return redirect()->route('poppings.index');
    }
}