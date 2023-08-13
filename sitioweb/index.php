<?php include("template/cabecera.php")?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<link rel="stylesheet" href="FuncionesAdicionales/ButtonTop/ButtonTop.css">

        <div class="jumbotron">
            <h1 class="display-3">Encyclopet</h1>            
            <hr class="my-2">
            <p class="lead">
                <div class= "container-fluid h-100">
                    <div class="row w-100 align-items-center">

                 <p class="intro-text">Queremos proporcionar información acerca de tu perro o gato, esto lo hacemos pensando en el bienestar de tu mascota, intentando que tenga una buena calidad de vida en cuanto a su salud, siguiendo ciertos cuidados dependiendo de su raza. A parte de esto aconsejamos lugares para sus necesidades en cuanto a productos y servicios. Sin olvidar la ayuda que podemos hacerle a los animales que necesitan de una donación. </p>       
                <a class="btn btn-outline-dark btn-lg" href="mascotas.php" role="button">Mascotas</a>
                <br>
                <br>
                <br>
                <a class="btn btn-outline-dark btn-lg" href="lugares.php" role="button">Lugares</a>
                <br>
                <br>
                <br>
                <a class="btn btn-outline-dark btn-lg" href="donaciones.php" role="button">Donaciones</a>
                <br>
                <br>
                <br>   
                    </div>
                </div>
                
            </p>
        </div>

    <!-- Map Section -->
    <div class="content-section text-center">
		<iframe width="100%" height="350" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3043.6753227491627!2d-3.82101!3d40.282962!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd418e7adf68f543%3A0x841755428455a90b!2sUniversidad+Rey+Juan+Carlos!5e0!3m2!1ses!2ses!4v1423831564044"></iframe>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p><a href="http://github.com/dlumbrer">Encyclopet</a> &copy; </p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>


	<div class="go-top-container">
        <div class="go-top-button">
            <i class="fas fa-chevron-up">

            </i>
        </div>
    </div>
    
<script src="FuncionesAdicionales/ButtonTop/ButtonTop.js"></script>
</body>
</html>

<?php include("template/pie.php")?>