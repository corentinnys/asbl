@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form method="post" action="{{route('AdminLogin')}}">
    @csrf
    <label> votre email</label>
    <input type="email" name="mail" />

    <label> votre mot de passe </label>
    <input type="password" name="password" />

    <input type="submit" value="se connecter">
</form>
