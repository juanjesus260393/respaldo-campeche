<?php
    //parte de la conexion
    $con = mysqli_connect("localhost", "id1830571_juanjesus123", "guilmon333", "id1830571_sistemaexperto");
    //Recibir parametros de la aplicacion
    $numerodeboleta= $_POST["numerodeboleta"];
    $passalumno = $_POST["passalumno"];
    $nombrealumno = $_POST["nombrealumno"];
    $clavedelamateriaa = $_POST["clavedelamateria"];
    //Realizar consulta del profesor
    $statement = mysqli_prepare($con, "SELECT * FROM materia WHERE clavedelamateria = ?");
    mysqli_stmt_bind_param($statement, "s", $clavedelamateriaa);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $clavedelamateria, $nombredelamateria);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        $response["success"] = true;  
        $response["clavedelamateria"] = $clavedelamateria;
        $response["nombredelamateria"] = $nombredelamateria;
    }
    //si coinciden los nombres de los profesores se realiza el registro
    if($clavedelamateriaa == $clavedelamateria){
    //Parte del registro
    $statement = mysqli_prepare($con, "INSERT INTO alumno (numerodeboleta,passalumno,nombrealumno,clavedelamateria) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, "ssss", $numerodeboleta,$passalumno,$nombrealumno, $clavedelamateriaa);
    mysqli_stmt_execute($statement);
    
    $response = array();
    $response["success"] = true;     
    }
else {
    $response = array();
    $response["success"] = false; 
}
  
    
    echo json_encode($response);
?>