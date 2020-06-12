<?php

class conexion {

	var $host;
	var $user;
	var $pass;
	
	
	function conexion($h,$u,$p)
	{
		$this->link=mssql_connect($h,$u,$p);
		if (!$this->link){
			echo "No se pudo efectuar la conexión".mssql_min_error_severity(5);		
			exit();
		}else{
			$this->host=$h;
			$this->user=$u;
			$this->pass=$p;
		}
	
	}
	
	/**
	* @return unknown
	* @param unknown $q
	* @param unknown $bd
	* @desc Ejecuta una consulta SQL cualquiera en la BD especificada...
	*/
	function query($q,$bd){
		$existeBD=mssql_select_db($bd);
		if ($existeBD){
			$resultado=mssql_query($q,$this->link);
			return $resultado;
		}else{
			return false;
		}
	}
	
	function free(){
		mssql_close($this->link);
	}
	



}