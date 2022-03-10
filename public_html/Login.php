<?php
    /* Credenciales para identificar en la base de datos, lo sacas de database manager. */
	$server = "localhost";          // Servidor en el cual se va a correr.
	$user = "id18477189_usuario";   // dbuser.
	$passuser = "L6s9GHQ?2N89YbOO"; // password para el database. 
	$bd = "id18477189_carreraapp";  // db name

	// Será la información que se obtendrá de la url.
	$codigo = $_GET['codigo'];
	$pass = $_GET['password'];

    // Validar si alguna variable está vacia, usar -1 si hay alguna vacia.
    $variables = [$codigo, $pass];
    $vacio = false;
    foreach($variables as $variable)
    {
        if($variable == '') {
            $vacio = true;
            echo "-1";
            break;
        }
    }
    
    // Sino está vacio, continuar con normalidad.
    if(!$vacio) 
    {
        // Crear la conexion con el servidor.
    	$conn = mysqli_connect($server, $user, $passuser, $bd);
    
    	// Revisar si se conecto a la base de datos.
    	if(!$conn) {
    		die("Error al conectarse");
    	}
    
    	// Hacer el query para la busqueda del usuario, los datos deben de ir conforme va en la base de datos.
    	$sql = "SELECT Codigo,Password FROM Corredor where Codigo = $codigo";
    
    	// Ejecucion del query, toma el servidor donde se va a correr el query y el query
    	$result = mysqli_query($conn, $sql);
    
    	// Si hay datos los compara y muestra
    	if(mysqli_num_rows($result) > 0) 
    	{
    		while($row = mysqli_fetch_assoc($result)) 
    		{
    			// comparar el pass que le enviamos desde la aplicacion con el password que le enviamos a la base de datos, regresa true o false
    			$sonigualespass = password_verify($pass, $row['Password']);
    	
    			if($sonigualespass) {
    				//echo "Usuario autentificado";
    				echo "1";
    			} else {
    				//echo "Password erroneo intente de nuevo";
    				echo "2";
    			}
    		}
    	} else {
    	    //echo "No existe el usuario";
    	    echo 0;
    	}
    
        mysqli_close($conn);    
    }
?>