<?php
    include('conexion_bd.php');

    $nombreProveedor = $con->real_escape_string($_POST['nombreProveedor']);
    $apellido = $con->real_escape_string($_POST['apellido']);
    $telefono = $con->real_escape_string($_POST['telefono']);
    $correoProveedor = $con->real_escape_string($_POST['correoProveedor']);
    $contrasenaProveedor = $con->real_escape_string($_POST['contrasenaProveedor']);
    $usernameProveedor = $con->real_escape_string($_POST['usernameProveedor']);
    $calle = $con->real_escape_string($_POST['calle']);
    $colonia = $con->real_escape_string($_POST['colonia']);
    $tipoUsuario = $con->real_escape_string($_POST['Type_User']);

    $sql = "INSERT INTO User (User_Name, Password, Mail, Amount, Type_User, Name, Last_Name, Phone_Number, Adress, Neighborhood_Code) VALUES ('$usernameProveedor', '$contrasenaProveedor', '$correoProveedor', '0', '$tipoUsuario', '$nombreProveedor', '$apellido', '$telefono', '$calle', '$colonia')";

    $sentencia = $con->prepare($sql);
    $sentencia->execute();
    $sentencia->close();

    if ($sql) {
        //echo "Se insertó";
        $msg = "Se agregó proveedor.";
        header('Location: ../panelAdmin.php?msg='.$msg);
    } else {
        echo "No se insertó <br />";
        echo "Error SQL ".mysqli_error($con);
    }
?>