<?php

class Persona{
	
	var $nombre;
	var $apellido1;
	var $apellido2;
	var $edad;
	var $mes_Nac;
	var $dia_Nac;
	var $anno_Nac;
	var $fecha_cont;
	var $sexo;
	var $desc_cargo;
	var $desc_categoria;
	var $militancia;
        var $nsexo;
        	
	function Persona($aValor)
	{
                
                $this->nombre=ucwords(strtolower($aValor['nombre']));
		$this->apellido1=ucwords(strtolower($aValor['']));
		$this->apellido2=ucwords(strtolower($aValor['']));
		$this->mes_Nac=intval(substr($aValor['numident'],2,2));
		$this->dia_Nac=intval(substr($aValor['numident'],4,2));
		$this->anno_Nac=intval('19'.substr($aValor['numident'],0,2));
		$this->edad=$this->cal_edad($this->anno_Nac);
		$this->fecha_cont=$aValor['numident'];
		$this->desc_cargo=ucwords(strtolower($aValor['descripcion']));
		$this->desc_categoria=ucwords(strtolower($aValor['str_descripcion']));
		$this->nsexo=intval(substr($aValor['numident'],9,1));
                $this->sexo= $this->sexo();
                
		
	}
	function sexo()
	{
		$ni=$this->nsexo;
                
                if ( $ni & 1 )
                {
                $result='F';
                }
                else 
                {
                $result='M';
                }
                return $result;
	}
        
        function cal_edad()
	{
		return date('Y')-$this->anno_Nac;
	}
	
       	function Ann_trabajo()
	{
		$fecha1=strftime('%Y',strtotime($this->fecha_cont));
		$result=date('Y')-$fecha1;
		return $result;
	}
}