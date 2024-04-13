<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .change{
            background: #ef4444 !important;
        }
    </style>
</head>
<body>
<table class="table">
    <tr>
        <th>champ</th>
        <th>user </th>
        <th>modification</th>

    </tr>
    <tr>
        <th @if($user->email != $mail)
            class="change"
        @endif>adresse mail</th>
        <td @if($user->email != $mail)
                class="change"
            @endif>{{$user->email}}</td>
        <td @if($user->email != $mail)
                class="change"
            @endif>{{$mail}}</td>
    </tr>
    <tr>
        <th @if($user->Commune != $commune)
                class="change"
            @endif>commune</th>
        <td @if($user->Commune != $commune)
                class="change"
            @endif>{{$user->Commune}}</td>
        <td @if($user->Commune != $commune)
                class="change"
            @endif>{{$commune}}</td>
    </tr>
    <tr>
        <th @if($user->Rue != $street)
                class="change"
            @endif>rue</th>
        <td @if($user->Rue != $street)
                class="change"
            @endif>{{$user->Rue}}</td>
        <td @if($user->Rue != $street)
                class="change"
            @endif>{{$street}}</td>
    </tr>
    <tr>
        <th @if($user->CodePostal != $codePostal)
                class="change"
            @endif>code postal</th>
        <td @if($user->CodePostal != $codePostal)
                class="change"
            @endif>{{$user->CodePostal}}</td>
        <td @if($user->CodePostal != $codePostal)
                class="change"
            @endif>{{$codePostal}}</td>
    </tr>
</table>


</body>
</html>
