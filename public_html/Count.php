<?php
    /* Este archivo se encargará de obtener el total de corredores que hay en nuestra base de datos,
    así como también obtener el nombre, código y escuela del usuario en base al código dado. */

    /* Credenciales para identificar en la base de datos, lo sacas de database manager. */
	$server = "localhost";          // Servidor en el cual se va a correr.
	$user = "id18477189_usuario";   // dbuser.
	$passuser = "L6s9GHQ?2N89YbOO"; // password para el database.
	$bd = "id18477189_carreraapp";  // db name

    // Obtener la información del url.
	$codigo = $_GET['codigo'];

    $foto = '';

    // Crear la conexion con el servidor.
    $conn = mysqli_connect($server, $user, $passuser, $bd);

    // Revisar si se conecto a la base de datos.
    if(!$conn) {
        die("Error al conectarse a la base de datos");
    }

    // Consulta para obtener el total de corredores.
    $query = "SELECT * FROM Corredor";
    $totalCorredores = mysqli_query($conn, $query);
    // Mostrar el total de corredores.
    //echo $result->num_rows;

    // Consulta para obtener los corredores dependiendo del codigo dado.
    $query = "SELECT * FROM Corredor WHERE Codigo = $codigo";
    $result = mysqli_query($conn, $query);

    // Consulta para obtener la foto del corredor.
    $query = "SELECT Foto FROM EstadisticasC WHERE Codigo = $codigo";
    $result_foto = mysqli_query($conn, $query);

    // Guardamos la informacion de la foto.
    if(mysqli_num_rows($result_foto) > 0)
    {
        while($row = mysqli_fetch_assoc($result_foto)) {
            $foto = $row['Foto'];
        }
    }

    // Si hay fila encontradas.
    if(mysqli_num_rows($result) > 0)
    {
        // Va a obtener la información de cada fila.
        while($row = mysqli_fetch_assoc($result)) {
            echo $row['Nombre'] . "," . $row['Codigo'] . "," . $row['Centro'] . "," . $totalCorredores->num_rows . "," . $foto;
        }
    }
    // El usuario no se registo correctamente, algo esta mal en el query.
    else {
        echo "0";
    }

    mysqli_close($conn);

    // Incluir el codigo de ranking aqui para obtener un solo output
    // donde mostrara la informacion del usuario mas el ranking separado por comas.
    include 'Ranking.php';
?>
