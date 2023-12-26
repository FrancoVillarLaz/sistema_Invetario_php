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

    //Funcion para el paginador de tablas

    function paginadorTablas($paginaActual,$paginasTotal,$url,$botones){
        $tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

        //primera pagina y pagina anterior 
        if ($paginaActual<=1) {
            $tabla.='
            <a class="pagination-previous is-disabled" disabled >Anterior</a>
			<ul class="pagination-list">
            ';
        }else{
            $tabla.='
            <a class="pagination-previous" href="'.$url.($paginaActual-1).'" >Anterior</a>
			<ul class="pagination-list">
            <li><a class="pagination-link" href="'.$url.'1">1</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>'
            ;
        }

        //siguiente pagina y ultima pagina
        if ($paginaActual=$paginasTotal) {
            $tabla.='
            </ul>
            <a class="pagination-next is-disabled" disabled >Siguiente</a>
			<ul class="pagination-list">';
        }else{
            $tabla.='
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a class="pagination-link" href="'.$url.$paginasTotal.'1">'.$paginasTotal.'</a></li>
            </ul>
            <a class="pagination-next" href="'.$url.($paginaActual+1).'" >Siguiente</a>
			<ul class="pagination-list">
            ';
        }
        $tabla.='</nav>';
        return $tabla;
    }
