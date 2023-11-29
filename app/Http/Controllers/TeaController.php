<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tea;
use App\Models\Drink;
use Illuminate\Support\Facades\Gate;

class teaController extends Controller
{
    public function _construct()
    {
        $this->authorizeResource(Tea::class, 'tea');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teas = Tea::all();

        return view('teas/product_teas', [
            'teas' => $teas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teas/create_teas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:11',
            'description' => 'required|max:1000'
        ]);

        $tea = Tea::create($validated);

        return redirect()->route('teas.show', ['tea' => $tea->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tea = Tea::Find($id);
        return view('teas/show_teas', [
            'tea' => $tea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tea $tea)
    {
        return view('teas/edit_teas', ['tea' => $tea]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tea $tea)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:10',
            'description' => 'required|max:1000'
        ]);

        $tea->name = $validated['name'];
        $tea->price = $validated['price'];
        $tea->description = $validated['description'];

        $tea->save();

        return redirect()->route('teas.show', ['tea' => $tea->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tea $tea)
    {
        $tea->delete();
        return redirect()->route('teas.index');
    }
}