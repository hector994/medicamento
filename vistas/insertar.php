<?php
include '../conf/_con.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Configuracion de la base de datos
    
 
      
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $existencia = $_POST["existencia"];
    $fecharegistro = $_POST["fecharegistro"];
    $precio = $_POST["precio"];

    // Procesar y mover la imagen al servidor
    $imagen_tmp = $_FILES["imagen"]["tmp_name"];
    $imagen_nombre = $_FILES["imagen"]["name"];
    $imagen_extension = pathinfo($imagen_nombre, PATHINFO_EXTENSION);
    $imagen_agregar_nombre = uniqid() . "." . $imagen_extension; 
    $ruta_imagen = "../imgServer/img/" . $imagen_agregar_nombre; // Directorio donde se guardarán las imágenes
        
        
    if (move_uploaded_file($imagen_tmp, $ruta_imagen)){
        // Preparar la sentencia SQL para insertar datos
        $query = "INSERT INTO medicamentos (nombre, existencia, fecharegistro, imagen, precio) 
        VALUES (:nombre, :existencia, :fecharegistro, :imagen, :precio)";
        $ejecutar = $pdo->prepare($query);
        $ejecutar->bindParam(':nombre', $nombre);
        $ejecutar->bindParam(':existencia', $existencia);
        $ejecutar->bindParam(':fecharegistro', $fecharegistro);
        $ejecutar->bindParam(':imagen', $imagen_agregar_nombre);
        $ejecutar->bindParam(':precio', $precio);

        // Ejecutar la sentencia
        if ($ejecutar->execute()){
            echo "Medicamento agregado correctamente";
            header('Location: ./procesar.php');
            // No necesitas la redirección aquí ya que el formulario y el procesamiento están en el mismo archivo.
        } else {
            echo "Error al agregar medicamento";
            // No necesitas la redirección aquí ya que el formulario y el procesamiento están en el mismo archivo.
        }
        
    }else {
        echo "Error al subir la imagen";
        header('Location: ./insertar.php');
        exit;

    }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Add</title>
</head>
<body>
<div class="container mt-5">
        <h2>Agregar Medicamento</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre Medicamento:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="existencia">Existencia:</label>
                <input type="number" class="form-control" id="existencia" name="existencia" required>
            </div>
            <div class="form-group">
                <label for="fecharegistro">Fecha de Registro:</label>
                <input type="date" class="form-control" id="fecharegistro" name="fecharegistro" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Medicamento</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>