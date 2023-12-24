<?php

    // Conexion a base de datos
    function conexion(){
        $conn = new PDO('mysql:host=localhost;dbname=inventario','root','');
        return $conn;
    }

    // funcion para verifica los datos

    function verificarDatos($filtro,$cadena){
        if(preg_match("/^".$filtro."$/",$cadena)){
            return false; //no hay error en la verificacion
        }else{
            return true; //si hay error
        }
    }

    // funcion para limpiar cadenas de texto para evitar inyeccion de codigo malisioso

    function limpiarCadenas($cadena){
        $cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
    }

    //funcion para renombrar imagen

    function renombrarImagen($nombre){
        $nombre=str_ireplace(" ","_",$nombre);
        $nombre=str_ireplace("/","_",$nombre);
        $nombre=str_ireplace("#","_",$nombre);
        $nombre=str_ireplace("-","_",$nombre);
        $nombre=str_ireplace("$","_",$nombre);
        $nombre=str_ireplace(".","_",$nombre);
        $nombre=str_ireplace(",","_",$nombre);
        $nombre=$nombre."_".rand(0,1000);
        return $nombre;
    }
    