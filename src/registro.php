
<?php
    //Se requiere tener la conexión a la BD
    require_once('conexion_bd.php');
	  require_once('../lib/nusoap.php');
    /*
    * Se reciven los datos del formulario de registro
    * $con->real_escape_string Escapa la cadena de simbolos no admitidos
    */
    $emailRegistro = $con->real_escape_string($_POST['emailRegistro']);
    $nombreUsuario = $con->real_escape_string($_POST['nombreUsuario']);
    $nombreUser = $con->real_escape_string($_POST['nombreUser']);
    $apellidoUsuario = $con->real_escape_string($_POST['apellidoUsuario']);
    $passwordRegistro = $con->real_escape_string($_POST['passwordRegistro']);
    $passwordRegistro2 = $con->real_escape_string($_POST['passwordRegistro2']);
    //Se declaran variables para que el usuario las modifique después
    $amount = '500'; //Saldo se inicia en 0 por defecto
    $type_User = '0'; //El tipo de usuario por defecto es 0 (usuario)
    $phone = '0'; //El telefono por defecto es 0
    $address = $con->real_escape_string($_POST['calle']);

    $colonia = $con->real_escape_string($_POST['colonia']);
    $cliente = new nusoap_client('http://192.168.1.15:8080/CocoLocoWS/CocoJAXWS?WSDL', true);

    $params = array('CocoJAXWS' => '',
                    'User_Name' => $nombreUser,
                    'Password' => $passwordRegistro,
                    'Mail' => $emailRegistro,
                    'Amount' => $amount,
                    'Type_User' => $type_User,
                    'Name' => $nombreUsuario,
                    'Last_Name' => $apellidoUsuario,
                    'Phone_Number' => $phone,
                    'Adress' => $address,
                    'Neighborhood_Code' => $colonia,
                    //'Session' => 'ougda809u2',
              );

      $resultado = $cliente->call('registrarUser', $params);


      if ($resultado['return'] == "Exito") {
        header('Location: ../index.php');
      }

    //Se insertan los datos en la tabla 'user'
    /*$sql = "INSERT INTO User(`User_Name`, `Password`, `Mail`, `Amount`, `Type_User`, `Name`, `Last_Name`, `Phone_Number`, `Adress`, `Neighborhood_Code`) VALUES ('$nombreUser', '$passwordRegistro', '$emailRegistro', '$amount', '$type_User', '$nombreUsuario', '$apellidoUsuario', '$phone', '$address', '$colonia')";

    $sentencia = mysqli_query($con, $sql);

    if ($sql) {
        //echo "EXITO";
        //Si se realizó la consulta, se regresa al usuario a la página principal
        //header('Location: ../index.php');
    } else {
        //Si no se realizó la consulta se muestra un mensaje de error.
        echo "Error: ".mysqli_error($con)." <br />";
        echo "Usuario: ".$nombreUser."<br> Pass: ".$passwordRegistro."<br> Mail: ".$emailRegistro."<br> Saldo: ".$amount."<br> Tipo: ".$type_User."<br> Nombre: ".$nombreUsuario."<br> Apellidos: ".$apellidoUsuario."<br> Cel: ".$phone."<br> Dirección: ".$address;
    }
	*/
?>
