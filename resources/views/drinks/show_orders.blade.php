@extends('layouts.commande')

@section('main')
<link rel="stylesheet" href="css/homepage.css">
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@csrf
<div id="order">
    @foreach ($drinks as $drink)
    <div>
        <p>{{ $drink->user_name }} commande pour : {{ $drink->drinker_name }}</p>
        <p>avec {{ $drink->popping_name }}</p>
        <p>{{ $drink->tea_name }} avec {{ $drink->sugar }} sucre(s)</p>

        <form action="{{ route('drinks.destroy', $drink->id ) }}" method="POST">
            @csrf
            @method('DELETE')
            <button id="addbtn" class="btn btn-outline-dark mt-auto" type="submit">delete</button>
        </form>

    </div>
    @endforeach
</div>

<form action="{{ route('orders.create') }}" method="GET">
    @csrf
    <button id="addbtn" class="btn btn-outline-dark mt-auto right" type="submit">pay</button>
</form>



@endsection