@extends('layouts.admin')

@section('main')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h1>Admin Section</h1>
    HELLO ADMIN


        @foreach ($users as $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <li>{{ $user->name }}, {{ $user->id }} , {{ $user->email }}</li>
            <button type="submit">delete user</button>
        </form>
        @endforeach




@endsection