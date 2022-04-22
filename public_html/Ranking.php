<?php
    function hola()
    {
        return "hola como estas";
    }

    /* Credenciales para identificar en la base de datos, lo sacas de database manager. */
	$server = "localhost";          // Servidor en el cual se va a correr.
	$user = "id18477189_usuario";   // dbuser.
	$passuser = "L6s9GHQ?2N89YbOO"; // password para el database.
	$bd = "id18477189_carreraapp";  // db name

    // Crear la conexion con el servidor.
    $conn = mysqli_connect($server, $user, $passuser, $bd);

    if(!$conn) {
        die("Error al conectarse a la base de datos");
    }

    // Seleccionar y ordenar a los corredores dependiendo de sus puntos (calculados como distancia / tiempo).
    // originando una nueva tabla donde ahora se tiene los puntos del corredor.
    $query = "SELECT Codigo, Distancia, Tiempo, (Distancia / Tiempo) AS Puntos FROM EstadisticasC ORDER BY Puntos DESC";
    $resultado = mysqli_query($conn, $query);

    if(mysqli_num_rows($resultado) > 0)
    {
        // Imprimir los resultados de la nueva tabla.
        while($row = mysqli_fetch_assoc($resultado)) {
            // La columna Puntos tendrá como valor default NULL, si se deja null, en el echo no imprimirá
            // nada, mejor que su valor sea 0, con eso ya lo imprimirá en el echo.
            if(is_null($row['Puntos'])) {
                $row['Puntos'] = 0;
            }

            echo $row['Codigo'] . "," . $row['Distancia'] , "," . $row['Tiempo'] . "," . $row['Puntos'] . ",";
        }
    } else {
        echo "0";
    }

    mysqli_close($conn);
?>
