<?php
 /* Credenciales para identificar en la base de datos, lo sacas de database manager. */
	$server = "localhost";          // Servidor en el cual se va a correr.
	$user = "id18477189_usuario";   // dbuser.
	$passuser = "L6s9GHQ?2N89YbOO"; // password para el database. 
	$bd = "id18477189_carreraapp";  // db name

    $conn = mysqli_connect($server, $user, $passuser, $bd);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    $codigo = $_GET['codigo'];
    $sql="select * from EstadisticasC where Codigo = $codigo";
    $result = mysqli_query($conn, $sql);
    
    // Mientas haya datos.
    if (mysqli_num_rows($result) > 0) 
    {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) 
      {
          $distancia=(int)$row['Distancia'];
          $kilometros = $distancia/1000*10;
       
          $tiempo=(int)$row['Tiempo'];
          $hours = floor( $tiempo/ 60);
          $minutes = ($tiempo % 60);
          $hora = "$hours-$minutes";
          echo $kilometros;
      }
    } else {
      echo "0 results";
    }
    
    mysqli_close($conn);
?>