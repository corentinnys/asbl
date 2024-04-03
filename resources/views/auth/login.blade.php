
<form method="post" action="{{route('login')}}">
    @csrf
    <label> votre email</label>
    <input type="email" name="mail" />
    @isset($errorMail)
        {{$errorMail}}
    @endisset
    <label> votre mot de passe </label>
    <input type="password" name="password" />
    @isset($errorPassword)
        {{$errorPassword}}
    @endisset
    <input type="submit" value="se connecter">
</form>
