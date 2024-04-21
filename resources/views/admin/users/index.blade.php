@extends('welcome')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <a href="#" id="addUser">ajouter un nouvel utilisateur </a>

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
                    <div class="row">
                        <div class="col">
                            <a href="#" class="setting">
                                <img style="width: 30px" src="{{asset('pictures/settings-gears.png')}}">
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{route('removeUser',array('userID'=>$user->id))}}" class="remove">
                                <img style="width: 30px" src="{{asset('pictures/remove.png')}}">
                            </a>
                        </div>
                    </div>
                </td>
        @endforeach
        </tbody>
    </table>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>


        $(document).on('click', '.remove', function(e) {
            e.preventDefault();
            let source =$(e.target).closest('a').attr('href');
            console.log(source);
            $.ajax({
                url:source,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function () {
                   // console.log($(e.target).closest('tr'));
                    $(e.target).closest('tr').find('td').slideUp('slow', function() {
                        $(this).remove();
                    });

                }
            })
        });



        $("#addUser").click((e) => {
            e.preventDefault();
            let dataID = $('table').find('tr:last').attr('data-id')+1;
            var newRow =
                "<tr data-id="+dataID+">" +
                "<td data-key = 'name'>" +
                "<input type='text' name='name'>" +
                "</td>" +
                "<td data-key = 'lastName'>" +
                "<input type='text' name='lastName'>" +
                "</td>" +
                "<td data-key = 'mail'>" +
                "<input type='text' name='email'>" +
                "</td>" +
                "<td data-key = 'date_init'>" +
                "<input type='date' name='date_init'>" +
                "</td>" +
                "<td data-key = 'date_pass'>" +
                "<input type='date' name='date_pass'>" +
                "</td>" +
                "<td data-key = 'date_elev'>" +
                "<input type='date' name='date_elev'>" +
                "</td>" +
                "<td data-key = 'commune'>" +
                "<input type='text' name='Commune'>" +
                "</td>" +
                "<td data-key = 'codePostal'>" +
                "<input type='text' name='codePostal'>" +
                "</td>" +
                "<td data-key = 'rue'>" +
                "<input type='text' name='rue'>" +
                "</td>" +
                "<td>"+
                    '<a href="#"  id="insert">'+
                        '<img style="width: 30px" src="{{asset('pictures/check.png')}}">'+
                    "</a>"+

                "</td>"+
                "</tr>";

            // Ajouter la nouvelle ligne à la fin de la table
            $("table").prepend(newRow);

        });
        var userData = {}; // Déclarer l'objet userData

        $(document).on('click', '#insert', function(e) {
            e.preventDefault();

            // Récupérer la ligne parente (tr) de l'élément #insert
            var row = $(this).closest('tr');

            // Sélectionner tous les champs de saisie (input) à l'intérieur de la ligne
            var inputs = row.find('input[type="text"]');

            // Créer un objet pour stocker les données à envoyer dans la requête AJAX
            var postData = {};

            // Parcourir tous les champs de saisie pour récupérer leur valeur et les ajouter à l'objet postData
            inputs.each(function() {
                postData[$(this).attr('name')] = $(this).val();
            });

            // Envoyer les données à l'aide d'une requête AJAX
            $.ajax({
                url: '{{route("insertUser")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST', // Méthode HTTP pour envoyer les données (GET, POST, etc.)
                data: postData, // Les données à envoyer au serveur
                success: function(response) {
                    // Gestionnaire de succès
                    var tdElements = $(e.target).closest('tr').find('td');
                    tdElements.each(function (index, element) {
                        var inputVal = $(element).find('input').val(); // Récupère la valeur de l'élément <input>
                        $(element).text(inputVal); // Remplace le contenu de la cellule <td> par la valeur de l'input
                        userData[$(element).data('key')] = inputVal;
                        var trId = $(element).closest('tr').data('id');
                        userData['id'] = trId

                    });
                    $(e.target).attr("src", "{{ asset('pictures/settings-gears.png') }}");
                    $(e.target).closest('a').attr('class','setting');
                    $(e.target).closest('a').removeAttr('id');

                },
                error: function(xhr, status, error) {
                    // Gestionnaire d'erreur
                    console.error(error); // Afficher l'erreur dans la console
                }
            });
        });




        var firstClick = true;
        $(document).on('click', '.setting', function(e) {
            e.preventDefault();
            $(e.target).attr("src", "{{ asset('pictures/check.png') }}");
            $(e.target).closest('a').addClass("input-check");

            var tdElements = $(e.target).closest('tr').find('td:not(:first-child):not(:nth-of-type(2)):not(:last-child)');

            if (firstClick) {
                // Première fois que l'utilisateur clique sur l'élément "setting"
                tdElements.each(function (index, element) {
                    var text = $(element).text().trim();
                    if ($(element).attr('data-key') == "date_init" || $(element).attr('data-key') == "date_elev" || $(element).attr('data-key') == "date_pass") {
                        /*var date = new Date(text); // Convertir la chaîne de texte en objet Date
                        var formattedDate = date.toISOString().split('T')[0]; // Formater la date en format ISO (YYYY-MM-DD)
                       console.log(formattedDate);*/



                        $(element).html('<input type="date" value="'+text+'" class="check">');
                    } else {
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
