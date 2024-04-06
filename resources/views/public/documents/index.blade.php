{{--
@foreach($docs as $doc)
    <a href="{{ asset("$doc->link") }}" target="_blank">
        <figure>
            <img src="{{asset("pictures/file.png")}}" alt="">
            <figcaption>
                {{$doc->name}}
            </figcaption>
        </figure>

    </a>

@endforeach
--}}

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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



    .maincontainer
    {
        width: 302px;
        height: 299px;
        margin: 10px;
        float: left; /* stack each div horizontally */
    }

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


</style>


<!-- Page Content -->
<div class="container page-top">



    <div class="row">

        @foreach($docs as $doc)
            <div class="maincontainer">
                <div class="back">
                    <h2>{{$doc->name}}</h2>
                    <p>{{$doc->resume}}</p>
                    <a class="btn btn-outline-primary"  style="display: block; position: relative;top: 220px" href="{{ asset("$doc->link") }}" target="_blank">lire</a>
                </div>
                <div class="front">
                    <div class="image">
                        <img class="w-100" src="{{asset("pictures/file.png")}}">
                        <h2 class="font-weight-bold text-white ">{{$doc->name}}</h2>
                    </div>
                </div>
            </div>
{{--
            <a href="{{ asset("$doc->link") }}" target="_blank">
                <figure>
                    <img src="{{asset("pictures/file.png")}}" alt="">
                    <figcaption>
                        {{$doc->name}}
                    </figcaption>
                </figure>

            </a>--}}

        @endforeach






</div>
<script>
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });

        $(".zoom").hover(function(){

            $(this).addClass('transition');
        }, function(){

            $(this).removeClass('transition');
        });
    });
</script>

