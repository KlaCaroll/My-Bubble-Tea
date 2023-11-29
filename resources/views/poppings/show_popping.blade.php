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
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $popping->name }}</h1>
                <div class="fs-5 mb-5">
                    <span>price: {{ $popping->price }} euros</span>
                </div>
                <p class="lead">Le Thé Vert Chun Mee'n Matcha Bio : 
                    ce mélange végétal se déguste très bien avec une touche de lait (de vache ou végétal) et du miel. 
                    Associé à des perles de tapioca, il permet de confectionner de délicieux thés aux perles. 
                    Composition: Thé vert Chun Mee (97%), Thé vert Matcha (3%). 
                </p>
                <div class="d-flex">
                    @can ('update', $popping)
                        <a href="{{ route('poppings.edit', $popping->id) }}">
                            <button class="btn btn-outline-dark flex-shrink-0">Editer</button>
                        </a>
                    @endcan
                    @can ('delete', $popping)
                        <form action="{{ route('poppings.destroy', $popping->id) }}" method="post">
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