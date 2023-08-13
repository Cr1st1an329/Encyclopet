<?php include("../template/cabecera.php")?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtRaza=(isset($_POST['txtRaza']))?$_POST['txtRaza']:"";
$txtRazaInfo=(isset($_POST['txtRazaInfo']))?$_POST['txtRazaInfo']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/basededatos.php");

switch($accion){

    case"AgregarPerro":
        $sentenciaSQL= $conexion->prepare("INSERT INTO lugares (raza,informacion,imagen) VALUES (:raza,:informacion,:imagen);");
        $sentenciaSQL->bindParam(':raza',$txtRaza); 
        $sentenciaSQL->bindParam(':informacion',$txtRazaInfo); 

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            
                move_uploaded_file($tmpImagen,"../../imgLugar/".$nombreArchivo);
            
        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo); 
        $sentenciaSQL->execute();   
        echo"Agregado con exito";
        break;

    case"Modificar":

        $sentenciaSQL= $conexion->prepare("UPDATE lugares SET Raza=:Raza WHERE id=:id");
        $sentenciaSQL->bindParam(':Raza',$txtRaza);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
        $sentenciaSQL= $conexion->prepare("UPDATE lugares SET Informacion=:Informacion WHERE id=:id");
        $sentenciaSQL->bindParam(':Informacion',$txtRazaInfo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen !=""){
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../imgLugar/".$nombreArchivo);

            $sentenciaSQL= $conexion->prepare("SELECT lugares FROM mascotas WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute(); 
            $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            if(isset($mascota["imagen"]) && ($mascota["imagen"]!="imagen.jpg")){
                 if(file_exists("../../imgLugar/".$mascota["imagen"])){
                     unlink("../../imgLugar/".$mascota["imagen"]);
                   }
            }


             $sentenciaSQL= $conexion->prepare("UPDATE lugares SET imagen=:imagen WHERE id=:id");
             $sentenciaSQL->bindParam(':id',$txtID);
             $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
             $sentenciaSQL->execute(); 
        }
        header("Location:Lugares.php");
        //echo"Presionado boton Modificar";
        break;
    case"Cancelar":
        header("Location:Lugares.php");
        break;
    case"Seleccionar":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM lugares WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
        $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtRaza=$mascota['raza'];
        $txtRazaInfo=$mascota['informacion'];
        $txtImagen=$mascota['imagen'];
        

        // echo"Presionado boton Seleccionar ";
            break;
    case"Borrar":
        $sentenciaSQL= $conexion->prepare("SELECT imagen FROM lugares WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
        $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        if(isset($mascota["imagen"]) && ($mascota["imagen"]!="imagen.jpg")){
            if(file_exists("../../imgLugar/".$mascota["imagen"])){
                unlink("../../imgLugar/".$mascota["imagen"]);
            }
        }
        $sentenciaSQL= $conexion->prepare("DELETE FROM lugares where id=:id");
        $sentenciaSQL->bindParam(':id',$txtID); 
        $sentenciaSQL->execute(); 
        header("Location:Lugares.php");
         break;


}

$sentenciaSQL= $conexion->prepare("SELECT * FROM lugares");
$sentenciaSQL->execute(); 
$listamascotas=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);

?>


<div class="col-md-12">
     <div class="card">
        <div class="card-header">
            Datos de la raza
        </div>
        <div class="card-body">

      

    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtID">ID</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtID?>" name="txtID" id="txtID"  placeholder="ID">
    </div>

    
    <form>
    <div class = "form-group">
    <label for="txtRaza">Raza:</label>
    <input type="text" required class="form-control" value="<?php echo $txtRaza?>" name="txtRaza" id="txtraza"  placeholder="Nombre">
    </div>

    <form>
    <div class = "form-group">
    <label for="txtRazaInfo">Información:</label>
    <input type="text" required class="form-control" value="<?php echo $txtRazaInfo?>" name="txtRazaInfo" id="txtinformacion" placeholder="Información del lugar de donaciones">
    </div>

    <form>
    <div class = "form-group">
    <label for="txtImagen">Imagen:</label>


    <input type="file"  class="form-control" name="txtImagen" id="txtImagen"  placeholder="Imagen de la raza">
    </div>

        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion"<?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="AgregarPerro" class="btn btn-success">Agregar lugares</button>
            <button type="submit" name="accion"<?php echo ($accion!="Seleccionar")?"disabled":""; ?>  value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion"<?php echo ($accion!="Seleccionar")?"disabled":""; ?>   value="Cancelar"class="btn btn-info">Cancelar</button>
        </div>


  
    </form>
        </div>
        
    </div>

    <br/>  
    
    
</div>



<div class="col-md-12">
    

   <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Raza</th>
                <th>Información</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listamascotas as $listamascotas){?>
            <tr>
                <td ><?php echo $listamascotas['id'] ?></td>
                <td><?php echo $listamascotas['raza']?></td>
                <td><?php echo $listamascotas['informacion']?></td>
                <td>
                    
                <img src="../../imgLugar/<?php echo $listamascotas['imagen']?>" width="150" alt="" srcset="">
                
            
                </td>


                <td>

                   <form method="post">
                      <input type="hidden" name="txtID" id="txtID" value="<?php echo $listamascotas['id']; ?>"/>
                      <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                      <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
 
                </td>
                

            </tr>
            <?php }?>
    
        </tbody>
    </table>

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


<?php include("../template/pie.php")?>