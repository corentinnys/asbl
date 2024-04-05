@extends('auth.index')

@section("content")

    <div class="login">
        <h1>Login</h1>
        <form method="post" action="{{route('login')}}">
            @csrf
            <input type="email" name="mail" placeholder="email"  id="inputEmail4" value="{{ old('mail') }}">
            @error('mail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="password"  name="password" placeholder="password" id="inputPassword4">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn btn-primary btn-block btn-large">se connecter.</button>
        </form>
    </div>




   {{-- <div class="container">

        <form class="row g-3"  method="post" action="{{route('login')}}">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="mail" class="form-control" id="inputEmail4" value="{{ old('mail') }}">
                @error('mail')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password"  name="password" class="form-control" id="inputPassword4">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">se connecter</button>
            </div>
        </form>

    </div>--}}

@endsection
