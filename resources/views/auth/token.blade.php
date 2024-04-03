
<form method="post" action="{{route('connexion')}}">
    @csrf
    <label> verifier le numero de securite</label>
    <input type="text" name="token"
           @isset($error)
               value="{{$error}}"
        @endisset/>
    <input type="submit" value="se connecter">
</form>
