
<form method="post" action="{{route('passwordUpdated')}}">
    @csrf
    <label> votre adresse mail </label>
    <input type="email" name="mail" />
    <label> votre ancien mot de pass</label>
    <input type="password" name="passwordOld" />
    <label> votre nouveau mot de pass</label>
    <input type="password" name="passwordNew" />
    <input type="submit" value="modifier">
</form>
