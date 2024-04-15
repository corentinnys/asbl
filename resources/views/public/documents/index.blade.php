@extends("welcome")
@section("content")
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>--}}
{{--
<style>
    body {
        /*background-color:#1d1d1d !important;*/
        font-family: "Asap", sans-serif;
        color:#989898;
        margin:10px;
        font-size:16px;
    }

    #demo {
        height:100%;
        position:relative;
        overflow:hidden;
    }


    .green{
        background-color:#6fb936;
    }
    .thumb{
        margin-bottom: 30px;
    }

    .page-top{
        margin-top:85px;
    }


    img.zoom {
        width: 100%;
        height: 200px;
        border-radius:5px;
        object-fit:cover;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        -o-transition: all .3s ease-in-out;
        -ms-transition: all .3s ease-in-out;
    }


    .transition {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }
    .modal-header {

        border-bottom: none;
    }
    .modal-title {
        color:#000;
    }
    .modal-footer{
        display:none;
    }
.relative{
    position: relative;
}
.relative a div {
  color: black;
}
.absolute{
    position: absolute;
    top: 50%;
    left: 25%;
}



/*    .maincontainer
    {
        width: 302px;
        height: 299px;
        margin: 10px;
        float: left; !* stack each div horizontally *!
    }*/

    img
    {
        border-radius: 10px;
    }

    .back h2
    {
        position: absolute;
    }

    .back p
    {
        position: absolute;
        top: 50px;
        font-size: 15px;
    }

    .front h2
    {
        position: absolute;
        left: 60px;
        padding: 10px;
        top: 210px;
    }

    /* style the maincontainer class with all child div's of class .front */
    .maincontainer > .front
    {
        position: absolute;
        transform: perspective(600px) rotateY(0deg);

        width: 302px;
        height: 290px;

        backface-visibility: hidden; /* cant see the backside elements as theyre turning around */
        transition: transform .5s linear 0s;
    }

    /* style the maincontainer class with all child div's of class .back */
    .maincontainer > .back
    {
        position: absolute;
        transform: perspective(600px) rotateY(180deg);
        background: #262626;
        color: #fff;
        width: 302px;
        height: 290px;
        border-radius: 10px;
        padding: 5px;
        backface-visibility: hidden; /* cant see the backside elements as theyre turning around */
        transition: transform .5s linear 0s;
    }

    .maincontainer:hover > .front
    {
        transform: perspective(600px) rotateY(-180deg);
    }

    .maincontainer:hover > .back
    {
        transform: perspective(600px) rotateY(0deg);
    }
.w-10
{
    width: 10%;
    position: relative;
    left: 90%;
    top: 5%;
}

</style>
<div class="col-12 col-md-12 col-lg-12">
    <form class="card card-sm" method="get" action="{{route('searchDoc')}}">
        <div class="card-body row no-gutters align-items-center">
            <div class="col-auto">
                <i class="fas fa-search h4 text-body"></i>
            </div>
            <!--end of col-->
            <div class="col">
                <input name="search" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords">
            </div>
            <!--end of col-->
            <div class="col-auto">
                <button class="btn btn-lg btn-success" type="submit">Search</button>
            </div>
            <!--end of col-->
        </div>
    </form>
</div>

<!-- Page Content -->
<div class="container page-top">
    @if(\Illuminate\Support\Facades\Auth::user()->degreeID >1)
        <div class="row">
            @for ($i = 0; $i < Auth::user()->degreeID; $i++)

                <div class="col-2">
                    <a href="{{ route('triFolder', ['niveau' => ($i + 1)]) }}" class="degree" id="{{ 'degre_' . ($i + 1) }}">
                        <figure>
                            <img class="w-100" src="{{ asset('pictures/folder.png') }}">
                            <figcaption class="text-white" style="position: relative; bottom: 90px; left: 50px;">
                                Niveau {{ $i + 1 }}
                            </figcaption>
                        </figure>
                    </a>
                </div>


            @endfor

                <div class="col-2">
                    <figure>
                        <img class="w-100 degree"  src="{{asset("pictures/folder.png")}}">
                        <figcaption class="text-white " style="position: relative; bottom: 90px; left:50px">
                           Tous
                        </figcaption>
                    </figure>
                </div>
        </div>
    @endif

    <div class="row">

        @foreach($docs as $doc)

            <div class="card col-4" style="width: 18rem;">
                @if($doc->degree_id == 1)
                    <img class="w-10" src="{{asset("pictures/one.png")}}" alt="">
                @elseif($doc->degree_id == 2)
                    <img  class="w-10" src="{{asset("pictures/two.png")}}" alt="">
                @else
                    <img  class="w-10" src="{{asset("pictures/three.png")}}" alt="">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$doc->name}}</h5>
                    <p class="card-text">{{$doc->resume}}</p>
                    <a href="{{ asset("$doc->link") }}" class="card-link">voir</a>
                </div>
                   {{$doc->typeName}}
            </div>
--}}
{{--
            <a href="{{ asset("$doc->link") }}" target="_blank">
                <figure>
                    <img src="{{asset("pictures/file.png")}}" alt="">
                    <figcaption>
                        {{$doc->name}}
                    </figcaption>
                </figure>

            </a>--}}{{--


        @endforeach






</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>


    // $(document).ready(function(){
    //     $(".fancybox").fancybox({
    //         openEffect: "none",
    //         closeEffect: "none"
    //     });
    //
    //     $(".zoom").hover(function(){
    //
    //         $(this).addClass('transition');
    //     }, function(){
    //
    //         $(this).removeClass('transition');
    //     });
    // });


</script>
@endsection
--}}
<style>
    body{margin-top:20px;
        background:#eee;
    }

    .btn {
        margin-bottom: 5px;
    }

    .grid {
        position: relative;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
    }

    .grid .grid-body {
        padding: 15px 20px 15px 20px;
        font-size: 0.9em;
        line-height: 1.9em;
    }

    .search table tr td.rate {
        color: #f39c12;
        line-height: 50px;
    }

    .search table tr:hover {
        cursor: pointer;
    }

    .search table tr td.image {
        width: 50px;
    }

    .search table tr td img {
        width: 50px;
        height: 50px;
    }

    .search table tr td.rate {
        color: #f39c12;
        line-height: 50px;
    }

    .search table tr td.price {
        font-size: 1.5em;
        line-height: 50px;
    }

    .search #price1,
    .search #price2 {
        display: inline;
        font-weight: 600;
    }

</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <!-- BEGIN SEARCH RESULT -->
        <div class="col-md-12">
            <div class="grid search">
                <div class="grid-body">
                    <div class="row">
                        <!-- BEGIN FILTERS -->
                        <div class="col-md-3">
                            <h2 class="grid-title"><i class="fa fa-filter"></i> Filtre</h2>
                            <hr>

                            <!-- BEGIN FILTER BY CATEGORY -->
                            <h4>Categorie:</h4>
                            <div class="checkbox">
                                <label><input type="checkbox" class="icheck category" name="category" value="1"> Procedure</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" class="icheck category" name="category" value="2"> Rapport </label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" class="icheck category" name="category" value="3"> Bibliotheque</label>
                            </div>
                            <!-- END FILTER BY CATEGORY -->

                            <div class="padding"></div>

                            <!-- BEGIN FILTER BY DEGREE -->
                            <h4>Degré:</h4>
                            <div class="checkbox">
                                <label><input type="checkbox" class="icheck degre" name="degree" value="1"> Degré 1</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" class="icheck degre" name="degree" value="2"> Degré 2 </label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" class="icheck degre" name="degree" value="3"> Degré 3</label>
                            </div>
                            <!-- END FILTER BY DEGREE -->

                            <div class="padding"></div>

                            <!-- BEGIN FILTER BY PRICE -->

                            <!-- END FILTER BY PRICE -->
                        </div>
                        <!-- END FILTERS -->
                        <!-- BEGIN RESULT -->
                        <div class="col-md-9">
                            <h2><i class="fa fa-file-o"></i> Résultats</h2>
                            <hr>
                            <!-- BEGIN SEARCH INPUT -->
                            <form method="get" action="{{ route('searchDoc') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <!-- END SEARCH INPUT -->
                            <div class="padding"></div>
                            <!-- BEGIN TABLE RESULT -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($docs as $doc)
                                        <tr>
                                            <td class="image"><img src="https://www.bootdey.com/image/400x300/FF8C00" alt=""></td>
                                            <td class="product">{{$doc->name}}</td>
                                            <td class="rate text-right">
                                                <span>
                                                    @for ($i = 0; $i < $doc->degree_id; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </span>
                                            </td>
                                            <td class="text-right"> <a href="{{$doc->link}}"> <img src="{{asset("pictures/eye.jpg")}}" alt=""> </a></td>
                                           @if($doc->telechargeable == 0)
                                            <td class="text-right">
                                                <a href="{{ route('download', ['filename' => $doc->name]) }}">
                                                    <img src="{{ asset("pictures/download.png") }}" alt="">
                                                </a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END TABLE RESULT -->
                        </div>
                        <!-- END RESULT -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END SEARCH RESULT -->
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        // checkedValues contient maintenant les valeurs de toutes les cases cochées

       $('.degre').change((e)=>{
           var checkedValues = [];
           $('.degre:checked').each(function() {
               // Ajoutez la valeur de chaque case cochée au tableau
               checkedValues.push($(this).val());
           });

           //let valeur  = e.currentTarget.value;
           $('tbody tr').remove();
           $.ajax({
               url:"{{route("searchDegre")}}",
               data:{
                   "degre":checkedValues
               },
               success:function (responsePHP)
               {
                   responsePHP.forEach((element) => {
                       let stars = '';
                       for (let i = 0; i < element.degree_id; i++) {
                           stars += "<span><i class='fa fa-star'></i></span>";
                       }
                       $('tbody').append(
                           "<tr>" +
                           "<td class='image'><img src='https://www.bootdey.com/image/400x300/FF8C00' alt=''></td>" +
                           "<td class='product'>" + element.name + "</td>" +
                           "<td class='rate text-right'>" + stars + "</td>" +
                           "<td class='text-right'> <a href='" + element.link + "'> <img src='{{asset('pictures/eye.jpg')}}' alt=''> </a></td>" +
                           "</tr>"
                       );
                   });

               },
               error:function ($code){
                   console.log($code)
               }
           })
       });

        $('.category').change((e)=>{
            var categoryValues = [];
            $('.category:checked').each(function() {
                // Ajoutez la valeur de chaque case cochée au tableau
                categoryValues.push($(this).val());
            });

            //let valeur  = e.currentTarget.value;
            $('tbody tr').remove();
            $.ajax({
                url:"{{route("searchByCategory")}}",
                data:{
                    "category":categoryValues
                },
                success:function (responsePHP)
                {
                    responsePHP.forEach((element) => {
                        let stars = '';
                        for (let i = 0; i < element.degree_id; i++) {
                            stars += "<span><i class='fa fa-star'></i></span>";
                        }
                        $('tbody').append(
                            "<tr>" +
                            "<td class='image'><img src='https://www.bootdey.com/image/400x300/FF8C00' alt=''></td>" +
                            "<td class='product'>" + element.name + "</td>" +
                            "<td class='rate text-right'>" + stars + "</td>" +
                            "<td class='text-right'> <a href='" + element.link + "'> <img src='{{asset('pictures/eye.jpg')}}' alt=''> </a></td>" +
                            "</tr>"
                        );
                    });

                },
                error:function ($code){
                    console.log($code)
                }
            })
        });
    </script>
@endsection
