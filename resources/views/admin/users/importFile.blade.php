<form method="post" action="{{route('importFile')}}" enctype="multipart/form-data">
    @csrf
    <label> votre fichier csv</label>
    <input type="file" name="users" />
    <input type="submit" value="valider">
</form>

