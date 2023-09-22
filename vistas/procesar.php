<?php
include  '../conf/_con.php'; // Incluye el archivo de configuración de la base de datos

// Crea una conexión PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_resultado', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit(); // Sale del script si hay un error de conexión
}

$query = 'SELECT * FROM medicamentos';
$ejecutar = $pdo->prepare($query);
$ejecutar->execute();
$data = $ejecutar->fetchAll(PDO::FETCH_OBJ); // Obtiene datos de la base de datos

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Medicamentos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .medicamento-imagen {
            width: 50px;
            height: 50px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }
        .medicamento-imagen:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">LISTA DE MEDICAMENTOS</h1>
        <a href="./insertar.php" class="btn btn-primary">Agregar</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Existencia</th>
                    <th>Fecha Registro</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $medicamento) : ?>
                    <tr>
                        <td><?php echo $medicamento->code; ?></td>
                        <td><?php echo $medicamento->nombre; ?></td>
                        <td><?php echo $medicamento->existencia; ?></td>
                        <td><?php echo $medicamento->fecharegistro; ?></td>
                        <td>
                            <img class="medicamento-imagen" src="../imgServer/img <?php echo $medicamento->imagen; ?>" alt="<?php echo $medicamento->nombre; ?>">
                        </td>
                        <td><?php echo $medicamento->precio; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>