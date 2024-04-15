@extends('welcome')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table class="table">
        <thead>
        <tr>

            <th scope="col">Prenom</th>
            <th scope="col">Nom de famille</th>
            <th scope="col">email</th>
            <th scope="col">date inti</th>
            <th scope="col">date elev</th>
            <th scope="col">date pass</th>
            <th scope="col">Commune</th>
            <th scope="col">Code postal</th>
            <th scope="col">Rue</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr data-id ="{{$user->id}}">

                <td data-key="name">{{$user->name}}</td>
                <td data-key="lastName">{{$user->lastName}}</td>
                <td data-key="mail">{{$user->email}}</td>
                <td data-key="date_init">
                    @if(is_null($user->date_init))
                        {{"/"}}
                    @else
                        {{$user->date_init}}
                    @endif
                </td>
                <td  data-key="date_elev">
                    @if(is_null($user->date_elev))
                        {{"/"}}
                    @else
                        {{$user->date_elev}}
                    @endif</td>
                <td  data-key="date_pass">
                    @if(is_null($user->date_pass))
                        {{"/"}}
                    @else
                        {{$user->date_pass}}
                    @endif
                </td>
                <td data-key="commune">
                    @if(is_null($user->Commune))
                        {{"/"}}
                    @else
                        {{$user->Commune}}
                    @endif

                </td>
                <td data-key="codePostal">
                    @if(is_null($user->CodePostal))
                        {{"/"}}
                    @else
                        {{$user->CodePostal}}
                    @endif
                </td>
                <td data-key="rue">
                    @if(is_null($user->Rue))
                        {{"/"}}
                    @else
                        {{$user->Rue}}
                    @endif

                </td>
                <td>
                    <a href="#" class="setting">
                        <img style="width: 30px" src="{{asset('pictures/settings-gears.png')}}">
                    </a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>


        var firstClick = true;

        $('.setting').click((e) => {
            e.preventDefault();
            $(e.target).attr("src", "{{ asset('pictures/check.png') }}");
            $(e.target).closest('a').addClass("input-check");

            var tdElements = $(e.target).closest('tr').find('td:not(:first-child):not(:nth-of-type(2)):not(:last-child)');

            if (firstClick) {
                // Première fois que l'utilisateur clique sur l'élément "setting"
                tdElements.each(function (index, element) {
                    var text = $(element).text().trim();
                    if ($(element).attr('data-key')=="date_init" || $(element).attr('data-key')=="date_elev" || $(element).attr('data-key')=="date_pass")
                    {
                        console.log(element)
                        var date= Date.parse(text);

                        //var formattedDate = date.toISOString().split('T')[0];
                        $(element).html('<input type="date" value="' + date + '" class="check">');
                    }else
                    {
                        $(element).html('<input type="text" value="' + text + '" class="check">');
                    }

                });
                firstClick = false;
            } else {
                var userData = {};
                $(e.target).attr("src", "{{ asset('pictures/settings-gears.png') }}");
                // Deuxième fois que l'utilisateur clique sur l'élément "setting"
                tdElements.each(function (index, element) {
                    console.log(element)
                    var inputVal = $(element).find('input').val(); // Récupère la valeur de l'élément <input>
                    $(element).text(inputVal); // Remplace le contenu de la cellule <td> par la valeur de l'input
                    userData[$(element).data('key')] = inputVal;
                    var trId = $(element).closest('tr').data('id');
                    userData['id'] = trId
                });

                $.ajax({
                    url : "{{route('updateUsers')}}",
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: userData,
                    success:function (responsePHP){}
                })
                firstClick = true;
            }
        });




    </script>
@endsection
