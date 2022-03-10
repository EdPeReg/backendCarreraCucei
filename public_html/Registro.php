<?php
    // Crear las variables para conectarnos a la base de datos.
    $server = "localhost";          // Servidor en el cual se va a correr.
	$user = "id18477189_usuario";   // dbuser.
	$passuser = "L6s9GHQ?2N89YbOO"; // password para el database.
	$bd = "id18477189_carreraapp";  // db name

	// Recibir las variables de la app.
	$nombre = $_GET['nombre'];
	$codigo = $_GET['codigo'];
    $correo = $_GET['correo'];
    $telefono = $_GET['telefono'];
    $passpelon = $_GET['password'];
    $centro = $_GET['centro'];
    $semestre = $_GET['semestre'];

    // Encriptar el password
    $password = password_hash($passpelon, PASSWORD_DEFAULT);

    // Revisar si alguna variable está vacia, si lo está, regresar -1 como error.
    $variables = array($nombre, $codigo, $correo, $telefono, $password, $centro, $semestre);
    $vacio = false;
    foreach($variables as $variable)
    {
        if($variable == '') {
            $vacio = true;
            echo "-1";
            break;
        }
    }
    
    // Seguir con normalidad si todas las variables están llenas.
    if(!$vacio) {
        // Creamos la conexion a la base de datos.
        $conn = mysqli_connect($server, $user, $passuser, $bd);
        
        // Consultar si existe el usuario.
        $consulta = "Select Codigo from Corredor Where Codigo = $codigo";
        $resultado = mysqli_query($conn, $consulta);
        
        // El tres es si ya esta registrado.
        if(mysqli_num_rows($resultado) > 0)
        {
            // El usuario ya esta registrado.
            echo "3";
        }
        // El usuario no esta registrado.
        else 
        {
            // Crear el query de insercion.
            $sql = "INSERT INTO Corredor(Nombre, Codigo, Correo, Telefono, Password, Centro, Semestre) VALUES
                    ('$nombre', '$codigo', '$correo', '$telefono',
                     '$password', '$centro', '$semestre')";
            
            // Si el usuario se registro correctamente.
            if(mysqli_query($conn, $sql)) {
                echo "1";
            } 
            // El usuario no se registo correctamente, algo esta mal en el query.
            else {
                echo "0";
            }
        }
        
        mysqli_close($conn);
    }    
?>