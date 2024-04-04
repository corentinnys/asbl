
<form method="post" action="{{route('AdminConnexion')}}">
    @csrf
    <label> verifier le numero de securite</label>
    <input type="text" name="token"
           @isset($error)
               value="{{$error}}"
        @endisset/>
    <input type="submit" value="se connecter">
</form>
