@extends('layouts.editproduct')

@section('main')
<link rel="stylesheet" href="../../css/homepage.css">
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div id="addproduct">
    <h1>Edit popping</h1>
    <hr>
    <form action="{{ route('poppings.update', $popping->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="nom de popping"
            name="name" value="{{ $popping->name }}">
        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="prix du popping"
            name="price" value="{{ $popping->price }}">
        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="description du popping"
            name="description" value="{{ $popping->description }}">
        <button id="addbtn" class="btn btn-outline-dark mt-auto">Modifier</button>
    </form>
</div>
@endsection