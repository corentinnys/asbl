<form method="post" action="{{route('createUser')}}">
    @csrf
    <label> votre nom</label>
    <input type="text" name="name" />
    <label> votre mail</label>
    <input type="email" name="mail" />
    <label> votre password</label>
    <input type="password" name="password" />
    <input type="submit" value="inscrire">
</form>
