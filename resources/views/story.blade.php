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
<h1 class="center_1">Historique des commandes</h1>
<hr>
<div id="story">
    @foreach ($orders as $order)
    <div>
        <p>{{ $order->drinker_name}}</p>
        <p>{{ $order->tea_name }}, {{ $order->popping_name}}</p>
    </div>
    @endforeach
</div>
<form action="/" method="GET">
    <button id="addbtn" class="btn btn-outline-dark mt-auto">home page</button>
</form>

@endsection