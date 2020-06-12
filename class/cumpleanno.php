<?php

include_once("class/persona.php");

class Cumpleanno{
	
	var $list_Persona;
	var $cant;
	                   
	
	/**
	* @return Cumpleanno
	* @param unknown $alista
	* @desc Inicializa la clase cumpleaño
	*/
	function Cumpleanno($alista){
		
		$this->cant=mssql_num_rows($alista);
		$i=0;
		while ($temp=mssql_fetch_array($alista)){
		$prosona=new Persona($temp);
		$this->list_Persona[$i]=$prosona;
		$i++;
		}	
	}
	/**
     * @return unknown
     * @param unknown $modo
     * @desc Ordena el listado de personas por Mes de Nacimiento por el modo especificado("A" o "D")...
     */
	function Ordenar_por_Mes($modo,$lista){
	  switch ($modo) {
        case 'D':
         for ($i=0;$i<=count($lista)-2;$i++){
			for ($j=$i;$j<=count($lista)-2;$j++){
				if ($lista[$i]->mes_Nac < $lista[$j+1]->mes_Nac){
					$temp=$lista[$i];
					$lista[$i]=$lista[$j+1];
					$lista[$j+1]=$temp;
				}
			}
		  }
		  return $lista;
         break;
         case 'A':
           for ($i=0;$i<=count($lista)-2;$i++){
			for ($j=$i;$j<=count($lista)-2;$j++){
				if ($lista[$i]->mes_Nac > $lista[$j+1]->mes_Nac){
					$temp=$lista[$i];
					$lista[$i]=$lista[$j+1];
					$lista[$j+1]=$temp;
				}
			}
		  }
		  return $lista;
         break;    
        }

		
	}
	 /**
      * @return unknown
      * @param unknown $modo
      * @desc Ordena el listado de personas por Dia de Nacimiento por el modo especificado("A" o "D")...
      */
	function Ordenar_por_Dia($modo,$lista){
	   switch ($modo) {
        case 'D':
         for ($i=0;$i<=count($lista)-2;$i++){
			for ($j=$i;$j<=count($lista)-2;$j++){
				if ($lista[$i]->dia_Nac < $lista[$j+1]->dia_Nac){
					$temp=$lista[$i];
					$lista[$i]=$lista[$j+1];
					$lista[$j+1]=$temp;
				}
			}
		  }
		  return $lista;
         break;
         case 'A':
          for ($i=0;$i<=count($lista)-2;$i++){
			for ($j=$i;$j<=count($lista)-2;$j++){
				if ($lista[$i]->dia_Nac > $lista[$j+1]->dia_Nac){
					$temp=$lista[$i];
					$lista[$i]=$lista[$j+1];
					$lista[$j+1]=$temp;
				}
			}
		  }
		  return $lista;
         break;    
        }}
        
      
	 
	function Ordenar_por_Mes_Dia($modo,$lista){
	   switch ($modo) {
        case 'D':
         for ($i=0;$i<=count($lista)-2;$i++){
			for ($j=$i;$j<=count($lista)-2;$j++){
				$fecha1=gregoriantojd($lista[$i]->mes_Nac,$lista[$i]->dia_Nac,9999);
				$fecha2=gregoriantojd($lista[$j+1]->mes_Nac,$lista[$j+1]->dia_Nac,9999);
				if ($fecha1 < $fecha2){
					$temp=$lista[$i];
					$lista[$i]=$lista[$j+1];
					$lista[$j+1]=$temp;
				}
			}
		  }
		  return $lista;
         break;
         case 'A':
          for ($i=0;$i<=count($lista)-2;$i++){
			for ($j=$i;$j<=count($lista)-2;$j++){
				$fecha1=gregoriantojd($lista[$i]->mes_Nac,$lista[$i]->dia_Nac,9999);
				$fecha2=gregoriantojd($lista[$j+1]->mes_Nac,$lista[$j+1]->dia_Nac,9999);
				if ($fecha1 > $fecha2){
					$temp=$lista[$i];
					$lista[$i]=$lista[$j+1];
					$lista[$j+1]=$temp;
				}
			}
		  }
		  return $lista;
         break;    
        }}
        
        /**
        * @return unknown $result
        * @param unknown 
        * @desc Devuelve que dia del mes que empieza la semana y el que termina(semana actual)...
        */
        function cal_dia_por_semana(){
        	
        	$temp=getdate();
        	$dia_sem=$temp["wday"];
        	$dia_mes=$temp["mday"];
        	if ($dia_mes<$dia_sem){
        		$result['i']=1;
        	    $result['t']=$dia_mes+6-$dia_sem;        		
        		}else {
        			$result['i']=$dia_mes-$dia_sem;
        			$t=$dia_mes+6-$dia_sem;
        			if ($t > cal_days_in_month(1,$temp['mon'],$temp['year'])){
        			$result['t']=cal_days_in_month(1,$temp['mon'],$temp['year']);
        			}else{
        				$result['t']=$t;
        			}
        		}
        		return $result;
        		
        }
        //Devuelve las personas que cumplen año en un mes dado
        /**
        * @return unknown $result
        * @param unknown $mes
        * @desc Devuelve las personas que cumplen años en un mes dado...
        */
        function Cumple_por_el_mes($mes){
        	$j=0;
        	for ($i=0;$i<=$this->cant-1;$i++){
        		if ($this->list_Persona[$i]->mes_Nac==$mes){
        			$result[$j]=$this->list_Persona[$i];
        			$j++;
        		}
        	}
        	return $result;
        }
        //
        /**
        * @return unknown $result
        * @param unknown $list_mes
        * @desc Devuelve los que cumple aña en la semana actual de una lista de un mes dado...
        */
        function Cumpleanno_de_la_semana($list_mes){
        	
        	$temp=$this->cal_dia_por_semana();
        	$j=0;
        	for ($i=0;$i<=count($list_mes)-1;$i++){
        		if (($list_mes[$i]->dia_Nac >= $temp['i']) and ($list_mes[$i]->dia_Nac <= $temp['t'])){
       			$result[$j]=$list_mes[$i];
        			$j++;
        		}
        	}
        	return $this->Ordenar_por_Dia('A',$result);
        }
        
        function Rango_mes($mes1,$mes2){
        	$j=0;
        	for ($i=0;$i<=$this->cant-1;$i++){
        		if ($this->list_Persona[$i]->mes_Nac >=$mes1 and $this->list_Persona[$i]->mes_Nac <= $mes2)
        		$result[$j++]=$this->list_Persona[$i];
        	}
        	return $result;
        }
		
	
}