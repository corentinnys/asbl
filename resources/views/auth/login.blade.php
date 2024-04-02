
<form method="post" action="{{route('login')}}">
    @csrf
    <label> votre email</label>
    <input type="email" name="mail" />
    <label> votre mot de passe </label>
    <input type="password" name="password" />
    <input type="submit" value="se connecter">
</form>
