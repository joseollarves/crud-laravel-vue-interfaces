<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<div class="w3-top">
        <div class="w3-bar w3-black w3-card" id="myNavbar">
            <a href="#home" class="w3-bar-item w3-button w3-wide"><img src="{{URL::asset('favicon.ico')}}"
                    style="width: 30px; height: 30px;">
                JACKS RENTALS</a>
            <!-- Right-sided navbar links -->
            <div class="w3-right w3-hide-small">
                <a href="#about" class="w3-bar-item w3-button">Sobre nosotros</a>
                <a href="#team" class="w3-bar-item w3-button"> Productos</a>
                <a href="#contact" class="w3-bar-item w3-button"> Ubicacion</a>
                <a href="{{ route('login') }}" class="w3-bar-item w3-button" > Perfil</a>
            </div>
            <!-- Hide right-floated links on small screens and replace them with a menu icon -->

            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                onclick="w3_open()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="w3-bar w3-black">
        <a href="#home" class="w3-button w3-bar-item"><img src="{{URL::asset('/img/car2.png')}}" width="25" height="25"></a>
        <a href="#band" class="w3-button w3-bar-item">Servicios</a>
        <a href="#tour" class="w3-button w3-bar-item">Vehiculos</a>
        <a class="w3-button w3-bar-item" href="{{ route('login') }}">Perfil</a>
    </nav>

    <!-- Slide Show -->
    <section style="padding-top: 37px;">
        <img class="mySlides" src="{{URL::asset('/img/banner1.png')}}" style="width:100%">
        <img class="mySlides" src="{{URL::asset('/img/banner2.png')}}" style="width:100%">
        <img class="mySlides" src="{{URL::asset('/img/banner3.png')}}" style="width:100%">
    </section>

    <main>
        @yield('content')
    </main>


    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        var current = 0;
        var imagenes = new Array();

        $(document).ready(function() {
            var numImages = 6;
            if (numImages <= 3) {
                $('.right-arrow').css('display', 'none');
                $('.left-arrow').css('display', 'none');
            }

            $('.left-arrow').on('click', function() {
                if (current > 0) {
                    current = current - 1;
                } else {
                    current = numImages - 3;
                }

                $(".carrusel").animate({
                    "left": -($('#product_' + current).position().left)
                }, 600);

                return false;
            });

            $('.left-arrow').on('hover', function() {
                $(this).css('opacity', '0.5');
            }, function() {
                $(this).css('opacity', '1');
            });

            $('.right-arrow').on('hover', function() {
                $(this).css('opacity', '0.5');
            }, function() {
                $(this).css('opacity', '1');
            });

            $('.right-arrow').on('click', function() {
                if (numImages > current + 3) {
                    current = current + 1;
                } else {
                    current = 0;
                }

                $(".carrusel").animate({
                    "left": -($('#product_' + current).position().left)
                }, 600);

                return false;
            });
        });
    </script>
</body>

</html>
