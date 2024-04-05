@extends('auth.index')
@section('title')
    <h1>page de connection - jeton de securite</h1>
@endsection
@section("content")



    <div class="login">
        <h1>Login</h1>
        <form method="post" action="{{route('connexion')}}">
            @csrf
            <input type="text" name="token" class="form-control" id="token" placeholder="introduire le jeton de securite" >
            @isset($error)
                <span class="text-danger">{{ $error }}</span>
            @endisset
            <button type="submit" class="btn btn-primary btn-block btn-large">se connecter.</button>
        </form>
    </div>





 {{--   <div class="container">
<form method="post" action="{{route('connexion')}}" class="row">
    @csrf
    <div class="col-md-6">
        <label for="token" class="form-label">Numero de sécurité</label>
        <input type="text" name="token" class="form-control" id="token" >
        @isset($error)
        <span class="text-danger">{{ $error }}</span>
        @endisset
    </div>

    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-primary">se connecter</button>
    </div>
</form>
    </div>--}}
@endsection
