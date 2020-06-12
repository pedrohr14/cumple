<?php

include_once("class/cumpleanno.php");

class tpl_class{
	var $nombre;
	
	function tpl_class($avalor){
		$this->nombre=$avalor;
	
	}
	
	function mostrar_contenido($cumple_semana,$rango,$modo){
		$contenido="";
                for ($i=0;$i<=count($cumple_semana)-1;$i++){
	
	        $fila=file_get_contents('tpl_fila_datos.htm');
	        $fila=str_replace('{nombre_apellido}',$cumple_semana[$i]->nombre,$fila);
	        $fila=str_replace('{edad}',$cumple_semana[$i]->edad,$fila);
	        $fila=str_replace('{fecha_Nac}',$cumple_semana[$i]->dia_Nac.' - '.$cumple_semana[$i]->mes_Nac.' - '.$cumple_semana[$i]->anno_Nac,$fila);
	        $fila=str_replace('{categ}',$cumple_semana[$i]->desc_categoria,$fila);
	        $fila=str_replace('{cargo}',$cumple_semana[$i]->desc_cargo,$fila);
	        $fila=str_replace('{sexo}',$cumple_semana[$i]->sexo,$fila);
	

	  $contenido.=$fila;
	
      }

      $lista=file_get_contents('tpl_tabla_cumple.htm');
      $lista=str_replace('{contenido}',$contenido,$lista);
      
        if ($modo=='S'){
      	$lista=str_replace('{Encabezado}',"Tabla de Cumplea&ntilde;os en la Semana del ".$rango['i']." al " .$rango['t']." de ".$this->nombre_mes($cumple_semana[0]->mes_Nac),$lista);
        
                  
              	
        }else {
      	$lista=str_replace('{Encabezado}'," Tabla de Cumplea&ntilde;os desde el mes de ".$this->nombre_mes($rango['i'])." hasta el mes de " .$this->nombre_mes($rango['t']),$lista);
 
        }
      
	 
        $result=file_get_contents('contenido.html');

        $result=str_replace('{select1}',$this->mostrar_select($rango['i'],'mes1'),$result);	  
        $result=str_replace('{select2}',$this->mostrar_select($rango['t'],'mes2'),$result);
        $result=str_replace('{titulo}',$this->nombre,$result);
        $result=str_replace('{fecha}',$this->fecha(),$result);

        $result=str_replace('{pagina}',$lista,$result);
	  return $result;
     
      
		
	}
	
	function nombre_mes($pmes)
	{
		switch ($pmes){
			case 0:$mes="mes";
			break;
			case 1:$mes="Enero";
			break;
			case 2:$mes="Febrero";
			break;
			case 3:$mes="Marzo";
			break;
			case 4:$mes="Abril";
			break;
			case 5:$mes="Mayo";
			break;
			case 6:$mes="Junio";
			break;
			case 7:$mes="Julio";
			break;
			case 8:$mes="Agosto";
			break;
			case 9:$mes="Septiembre";
			break;
			case 10:$mes="Octubre";
			break;
			case 11:$mes="Noviembre";
			break;
			case 12:$mes="Diciembre";
			break;
			}
			return $mes;
		}
		
		function nombre_dia($ndia)
		{
			switch ($ndia){
			case 0:$dia="Domingo";
			break;
			case 1:$dia="Lunes";
			break;
			case 2:$dia="Martes";
			break;
			case 3:$dia="Miercoles";
			break;
			case 4:$dia="Jueves";
			break;
			case 5:$dia="Viernes";
			break;
			case 6:$dia="Sabado";
			break;
			}
			return $dia;
		}
		
		function fecha ()
		{
			$temp=getdate();
			$dia=$this->nombre_dia($temp["wday"]);
			$mes=$this->nombre_mes($temp["mon"]);
            $fecha=$dia.", ".$temp["mday"]." de ".$mes." del ".$temp["year"];
			return $fecha;
		}
		
		function mostrar_select($selct,$name){
			$result=' <select class="w" name="'.$name.'" id="'.$name.'" size="1" >';
			for($i=0;$i<=12;$i++){
				if ($selct==$i){
			$result.='<option selected value="'.$i.'">'.$this->nombre_mes($i).'</option>';	
				}else{
					$result.='<option value="'.$i.'">'.$this->nombre_mes($i).'</option>';	
				}
			}
			$result.='</select>';
			return $result;
			
		}
	}
