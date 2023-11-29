@extends('layouts.productspage') 


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

<section class="py-5">

@can ('create', App\Models\Popping::class)
<div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                        <!-- Product name-->
                        <p>Create a new popping</p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            
                                <a href="{{ route('poppings.create') }}">
                                    <button class="btn btn-outline-dark mt-auto">Add a new popping</button>
                                </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endcan


    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($poppings as $popping)
            @if ($popping->id != 4)
            <div class="col mb-5">
                <div class="card h-100">
                <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                        <!-- Product name-->
                            <h5 class="fw-bolder">
                            <a href="{{ route('poppings.show', $popping->id) }}">{{ $popping->name }}</a>
                            </h5>
                            <!-- Product price-->
                            {{ $popping->price }} euros
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                        @can ('update', $popping)
                            <a  href="{{ route('poppings.edit', $popping->id) }}">
                                <button class="btn btn-outline-dark mt-auto" >edit</button>
                            </a>
                        @endcan
                        @can ('delete', $popping)
                            <form action="{{ route('poppings.destroy', $popping->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-dark mt-auto" type="submit">delete</button>
                            </form>
                        @endcan
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection

