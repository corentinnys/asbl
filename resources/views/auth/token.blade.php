<form method="post" action="{{route('connexion')}}">
    @csrf
    <label> verifier le numero de securite</label>
    <input type="text" name="token" />
    <input type="submit" value="se connecter">
</form>
