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
        $sentenciaSQL= $conexion->prepare("INSERT INTO gatos (raza,informacion,imagen) VALUES (:raza,:informacion,:imagen);");
        $sentenciaSQL->bindParam(':raza',$txtRaza); 
        $sentenciaSQL->bindParam(':informacion',$txtRazaInfo); 

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            
                move_uploaded_file($tmpImagen,"../../imgGatos/".$nombreArchivo);
            
        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo); 
        $sentenciaSQL->execute();   
        echo"Agregado con exito";
        break;

    case"Modificar":

        $sentenciaSQL= $conexion->prepare("UPDATE gatos SET Raza=:Raza WHERE id=:id");
        $sentenciaSQL->bindParam(':Raza',$txtRaza);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
        $sentenciaSQL= $conexion->prepare("UPDATE gatos SET Informacion=:Informacion WHERE id=:id");
        $sentenciaSQL->bindParam(':Informacion',$txtRazaInfo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen !=""){
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../imgGatos/".$nombreArchivo);

            $sentenciaSQL= $conexion->prepare("SELECT gatos FROM mascotas WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute(); 
            $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            if(isset($mascota["imagen"]) && ($mascota["imagen"]!="imagen.jpg")){
                 if(file_exists("../../imgGatos/".$mascota["imagen"])){
                     unlink("../../imgGatos/".$mascota["imagen"]);
                   }
            }


             $sentenciaSQL= $conexion->prepare("UPDATE gatos SET imagen=:imagen WHERE id=:id");
             $sentenciaSQL->bindParam(':id',$txtID);
             $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
             $sentenciaSQL->execute(); 
        }
        header("Location:Gatos.php");
        //echo"Presionado boton Modificar";
        break;
    case"Cancelar":
        header("Location:Gatos.php");
        break;
    case"Seleccionar":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM gatos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
        $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtRaza=$mascota['raza'];
        $txtRazaInfo=$mascota['informacion'];
        $txtImagen=$mascota['imagen'];
        

        // echo"Presionado boton Seleccionar ";
            break;
    case"Borrar":
        $sentenciaSQL= $conexion->prepare("SELECT imagen FROM gatos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 
        $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        if(isset($mascota["imagen"]) && ($mascota["imagen"]!="imagen.jpg")){
            if(file_exists("../../imgGatos/".$mascota["imagen"])){
                unlink("../../imgGatos/".$mascota["imagen"]);
            }
        }
        $sentenciaSQL= $conexion->prepare("DELETE FROM gatos where id=:id");
        $sentenciaSQL->bindParam(':id',$txtID); 
        $sentenciaSQL->execute(); 
        header("Location:Gatos.php");
         break;


}

$sentenciaSQL= $conexion->prepare("SELECT * FROM gatos");
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
    <input type="text" required class="form-control" value="<?php echo $txtRaza?>" name="txtRaza" id="txtraza"  placeholder="Raza del gato">
    </div>

    <form>
    <div class = "form-group">
    <label for="txtRazaInfo">Información:</label>
    <input type="text" required class="form-control" value="<?php echo $txtRazaInfo?>" name="txtRazaInfo" id="txtinformacion" placeholder="Información de la raza del gato">
    </div>

    <form>
    <div class = "form-group">
    <label for="txtImagen">Imagen:</label>


    <input type="file"  class="form-control" name="txtImagen" id="txtImagen"  placeholder="Imagen de la raza">
    </div>

        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion"<?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="AgregarPerro" class="btn btn-success">Agregar Gato</button>
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
                    
                <img src="../../imgGatos/<?php echo $listamascotas['imagen']?>" width="150" alt="" srcset="">
                
            
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



<?php include("../template/pie.php")?>