



<form method="post" action="{{route('login')}}">
    @csrf
    <label> votre email</label>
    <input type="email" name="mail" />
    @error('mail')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <label> votre mot de passe </label>
    <input type="password" name="password" />

    @error('password')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <input type="submit" value="se connecter">
</form>
