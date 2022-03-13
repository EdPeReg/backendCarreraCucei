<?php
    /* Credenciales para identificar en la base de datos, lo sacas de database manager. */
	$server = "localhost";          // Servidor en el cual se va a correr.
	$user = "id18477189_usuario";   // dbuser.
	$passuser = "L6s9GHQ?2N89YbOO"; // password para el database. 
	$bd = "id18477189_carreraapp";  // db name

    // Crear la conexion con el servidor.
    $conn = mysqli_connect($server, $user, $passuser, $bd);
    
    // Revisar si se conecto a la base de datos.
    if(!$conn) {
        die("Error al conectarse a la base de datos");
    }
    
    $query = "SELECT * FROM Corredor";
    $result = mysqli_query($conn, $query);    
    
    echo $result->num_rows;
    	
    mysqli_close($conn);    
?>