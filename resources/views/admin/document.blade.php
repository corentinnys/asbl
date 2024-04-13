@inject("TypeController","App\Http\Controllers\Admin\TypesController")
<form method="post" action="{{route('createDocument')}}" enctype="multipart/form-data">
    @csrf
    <label> le non du document</label>
    <input type="text" name="name" />
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <label> le degree du document</label>
    <input type="number" name="degree" />
    @error('degree')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <label for=""></label>
    <input type="file" name="file">
    @error('file')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <select name="type">
        @foreach($TypeController->index() as $type)
            <option value="{{$type->id}}">{{$type->name}}</option>
        @endforeach
    </select>
    <input type="submit" value="enregistrer">
</form>
