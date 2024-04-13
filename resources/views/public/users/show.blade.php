<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body{
            margin-top:20px;
            background:#F0F8FF;
        }
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #e5e9f2;
            border-radius: .2rem;
        }
        .card-header:first-child {
            border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
        }
        .card-header {
            border-bottom-width: 1px;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            color: inherit;
            background-color: #fff;
            border-bottom: 1px solid #e5e9f2;
        }
    </style>
</head>
<body>
<div class="container p-0">
    <h1 class="h3 mb-3">Settings</h1>
    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <div class="card-body">
                            <form method="Post" action="{{route("userUpdate")}}">
                                @csrf
                                <input type="hidden" name="id" id="identifiant" value="{{$user->id}}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">First name</label>
                                        <input type="text" class="form-control" id="inputFirstName" value="{{$user->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputLastName">Last name</label>
                                        <input type="text" class="form-control" id="inputLastName"  value="{{$user->lastName}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" value="{{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress2">Rue</label>
                                    <input type="text" class="form-control" id="inputAddress2" name="street"  value="{{$user->Rue}}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Commune</label>
                                        <input type="text" class="form-control" id="commune" name="commune" value="{{$user->Commune}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">Code postal</label>
                                        <input type="text" class="form-control" id="inputZip" name="codePostal" value="{{$user->CodePostal}}">
                                    </div>
                                </div>
                                <input  class="btn btn-primary" type="submit" value ="signaler un changement" >
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<script>
$("form").click((e)=>{
    e.preventDefault();
   $.ajax({
       url:"{{route("userUpdate")}}",
       method:"POST",
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data :
           {
               id : $('#identifiant').val(),
               email :$('#inputEmail4').val(),
               street: $('#inputAddress2').val() ,
               commune: $('#commune').val() ,
               codePostal : $('#inputZip').val()
           } ,
       success:function () {
           alert("le mail à bien été envoyer")
       }
   })
})
</script>
</body>
</html>
