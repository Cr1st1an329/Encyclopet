<?php include("template/cabecera.php")?>

<!--- Bootsrap CSS -->

<link rel="stylesheet" href="./css/bootstrap.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--- Main CSS -->
<link href="FuncionesAdicionales/CartasCristal/styleLugares.css" rel="stylesheet">

<?php
include("administrador/config/basededatos.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM lugares");
$sentenciaSQL->execute(); 
$listamascotas=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
?>

<?php foreach($listamascotas as $Mascota) { ?>

 <!--- Cartas Cristal -->

<div class="col-md-4 d-flex justify-content-center">
<div class="card m-2 cb2 text-center">
<img class="card-img-top" src="./imgLugar/<?php echo$Mascota['imagen']; ?>" alt="" >
<div class="card-body">
    <h4 class="card-title mb-4"><?php echo $Mascota['raza']; ?> </h4>
    <p class="card-text"><?php echo $Mascota['informacion']; ?></p>
    <a href="#" class="btn btn-outline-dark">Ver mas</a>

 <!--------------------->

</div>
</div>
</div>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<link rel="stylesheet" href="FuncionesAdicionales/ButtonTop/ButtonTop.css">


    <div class="go-top-container">
        <div class="go-top-button">
            <i class="fas fa-chevron-up">

            </i>
        </div>
    </div>
    
<script src="FuncionesAdicionales/ButtonTop/ButtonTop.js"></script>


<?php } ?>

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

<?php include("template/pie.php")?>