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
    <h1>Add a new tea</h1>
    <hr>
    <form action="{{ route('teas.update', $tea->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="nom de tea" name="name"
            value="{{ $tea->name }}">
        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="prix du tea"
            name="price" value="{{ $tea->price }}">
        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="description"
            name="description" value="{{ $tea->description }}">
        <button id="addbtn" class="btn btn-outline-dark mt-auto">modifier</button>
    </form>
</div>
@endsection