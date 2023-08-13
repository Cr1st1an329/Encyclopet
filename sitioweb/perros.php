<?php include("template/cabecera.php")?>

<!--- Bootsrap CSS -->

<link rel="stylesheet" href="./css/bootstrap.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--- Main CSS -->
<link href="FuncionesAdicionales/CartasCristal/stylePerros.css" rel="stylesheet">

<?php
include("administrador/config/basededatos.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM mascotas");
$sentenciaSQL->execute(); 
$listamascotas=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
?>

<?php foreach($listamascotas as $Mascota) { ?>

 <!--- Cartas Cristal -->

<div class="col-md-4 d-flex justify-content-center">
<div class="card m-2 cb1 text-center">
<img class="card-img-top" src="./img/<?php echo$Mascota['imagen']; ?>" alt="" >
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

<?php include("template/pie.php")?>