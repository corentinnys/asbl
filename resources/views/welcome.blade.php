<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{asset("MDB5/css/mdb.min.css")}}" rel="stylesheet">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</head>

    <body>

     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid">
             <a href="#" class="navbar-brand">asbl</a>
             <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                 <div class="navbar-nav">
                     <a href="#" class="nav-item nav-link active">Home</a>
                     <a href="{{route('documents')}}" class="nav-item nav-link"> mes documents</a>
                     <a href="{{route('profils',array('id'=>\Illuminate\Support\Facades\Auth::id()))}}" class="nav-item nav-link">mon profils</a>
                     <div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Messages</a>
                         <div class="dropdown-menu">
                             <a href="#" class="dropdown-item">Inbox</a>
                             <a href="#" class="dropdown-item">Sent</a>
                             <a href="#" class="dropdown-item">Drafts</a>
                         </div>
                     </div>
                 </div>
                 <div class="navbar-nav">
                     <a href="{{ route("deconnexion") }}" class="nav-item nav-link">se deconnecter</a>
                 </div>
             </div>
         </div>
     </nav>


        @yield("content")
    </body>
</html>
