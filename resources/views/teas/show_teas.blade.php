@extends('layouts.viewproduct')

@section('main')
<link rel="stylesheet" href="../css/homepage.css">
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                    src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $tea->name }}</h1>
                <div class="fs-5 mb-5">
                    <span>price: {{ $tea->price }} euros</span>
                </div>
                <p class="lead">
                    {{ $tea->description }}
                </p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1"
                        style="max-width: 3rem" />
                    <a href="{{url('drinks/create', $tea->id)}}">
                        @csrf
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            add to shop
                        </button>
                    </a>
                    @can ('update', $tea)
                    <a href="{{ route('teas.edit', $tea->id) }}">
                        <button class="btn btn-outline-dark flex-shrink-0">Editer</button>
                    </a>
                    @endcan
                    @can ('delete', $tea)
                    <form action="{{ route('teas.destroy', $tea->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">suppression</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>

@endsection