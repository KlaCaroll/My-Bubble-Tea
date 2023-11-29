@extends('layouts.drink')

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

    <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $tea->name }}</h1>
                <div class="fs-5 mb-5">
                    <span>price: {{ $tea->price }} euros</span>
                </div>
                <div class="d-flex">
                    <form action="{{ route('drinks.store') }}" method="POST">
                        @csrf
                        <h4>Who will drinks ?</h4>
                        <input id="name_drinker" class="form-control text-center me-3" type="text" placeholder="Who will drinks ?" name="drinker_name">
                        <input id="name_drinker" class="form-control text-center me-3" type="hidden" value="{{ $tea->id }}" name="teas_id">
                        <input id="name_drinker" class="form-control text-center me-3" type="hidden" value="ON" name="status">
                        <h4>Some popping ?</h4>
                        <select class="btn btn-outline-dark flex-shrink-0" id="popping" name="poppings_id">
                            @foreach ($poppings as $popping)
                            <option value="{{ $popping->id }}">{{ $popping->name }}</option>
                            @endforeach
                        </select>
                        <h4>With sugar ?</h4>
                        <select class="btn btn-outline-dark flex-shrink-0" id="sugar" name="sugar">
                            <option value="0">No sugar</option>
                            <option value="1">little sugar</option>
                            <option value="2">So much sugar</option>
                        </select>
                        <button class="btn btn-outline-dark flex-shrink-0">creation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection