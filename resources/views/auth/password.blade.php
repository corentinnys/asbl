
<form method="post" action="{{route('passwordUpdated')}}">
    @csrf
    <label> votre adresse mail </label>
    <input type="email" name="mail" />
    @error('mail')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <label> votre ancien mot de pass</label>
    <input type="password" name="passwordOld" />
    @error('passwordOld')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <label> votre nouveau mot de pass</label>
    <input type="password" name="passwordNew" />
    @error('passwordNew')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
    <input type="submit" value="modifier">
</form>
