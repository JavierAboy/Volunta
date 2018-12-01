<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "volunta1";

	$con = mysqli_connect($server, $user, $pass, $db) or die ("Error al conectar con la base de datos");
	
	function login($con, $dni){
		$result = mysqli_query($con, "select * from persona where dni='".$dni."'");
		if(mysqli_num_rows($result)==0){
			return 0; //Si no existe el usuario devuelvo 0
		}
		else{
			$usuario = mysqli_fetch_array($result);
			return $usuario;//Si existe el usuario devuelvo un array con sus datos
		}
	}
	
	function cerrarConexion($con){
		mysqli_close($con);
	}
	
	////////////////////////////////////////////// FUNCIONES DE ADMINISTRADOR //////////////////////////////////////////////
	
		/*
			FUNCIÓN PARA INSERTAR PERSONA
			
			ORDEN SQL --> INSERT INTO `persona`(`dni`, `nombre`, `apellidos`, `telefono`, `direccion`, `ciudad`, `email`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
	*/
	function insertarPersona($con, $dni, $nombre, $apellidos, $telefono, $direccion, $ciudad, $email){
		mysqli_query($con, "insert into persona values('$dni', '$nombre', '$apellidos', '$telefono', '$direccion', '$ciudad', '$email')");
	}
	function insertarVoluntario($con, $dni, $horas){
		mysqli_query($con, "INSERT INTO `voluntario`(`persona`, `horas`) VALUES ('$dni',$horas)");
	}

	//FUNCIÓN LISTAR PERSONAS
	function listarPersonas($con){
		$result = mysqli_query($con, "select * from persona");
		$personas = array();
		while($fila = mysqli_fetch_array($result)){
			$personas[] = $fila;
		}
		return $usuarios;//Devuelvo un array con los datos de todos los usuarios
	}
	function obtenerPersona($con, $dni){
		$resultado = mysqli_query($con, "select * from persona where dni='$dni'");
		if(mysqli_num_rows($resultado)==0){
			return 0; //Si no existe el usuario devuelvo 0
		}
		else{
			$persona = mysqli_fetch_array($resultado);
			return $persona;//Si existe el usuario devuelvo un array con sus datos
		}
	}
	
	function modificarPersona($con, $dni, $apellido, $tipo_usuario){
		mysqli_query($con, "update persona set apellido='$apellido', tipo_usuario=$tipo_usuario where dni='$dni'");
	}
	
	function borrarPersona($con, $dni){
		mysqli_query($con, "delete from persona where dni='$dni'");
	}
	
	////////////////////////////////////////////// FUNCIONES DE EVENTOS //////////////////////////////////////////////
	
	function insertarLocalizacion($con, $nombreLugar, $longitud, $latitud){
		mysqli_query($con, "insert into lugar(nombre, longitud, latitud) values('$nombreLugar', '$longitud', '$latitud')");
	}

/*
	function insertarEvento($con, $nombre){
		mysqli_query($con, "insert into evento (nombre, latitud, longitud) values('$nombre', '$latitud', '$longitud')");
	}
	

	function modificarEventoNombre($con, $id, $nombre){
		mysqli_query($con, "update evento set nombre='$nombre' where id=$id");
	}

	function modificarEventoLatitud($con, $id, $latitud){
		mysqli_query($con, "update evento set nombre='$latitud' where id=$id");
	}

	function modificarEventoLongitud($con, $id, $longitud){
		mysqli_query($con, "update evento set nombre='$longitud' where id=$id");
	}
	
	function borrarEvento($con, $id){
		mysqli_query($con, "delete from evento where id=$id");
	}
	*/
	
	////////////////////////////////////////////// PRUEBAS //////////////////////////////////////////////
	
	function listarVoluntarios($con){
		$result = mysqli_query($con, "select * from persona where tipo_usuario=1");
		$voluntarios = array();
		while($fila = mysqli_fetch_array($result)){
			$voluntarios[] = $fila;
		}
		return $voluntarios;//Devuelvo un array con los datos de todos los voluntarios
	}
		
?>