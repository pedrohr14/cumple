<?php

include_once("config/config.php");
include_once("class/conexion.php");
include_once("class/query.php");
include_once("class/cumpleanno.php");
include_once("class/data.php");

$conn=new conexion($host,$usuario,$contraseña);
$result=$conn->query($query,$RH_bd);
$conn->free();

$Cumple = new Cumpleanno($result);

$t=getdate();

if (isset($_POST["aceptar"])){
$temp=$Cumple->Rango_mes($_POST["mes1"],$_POST["mes2"]);
$temp=$Cumple->Ordenar_por_Mes_Dia('A',$temp);
$contenido= new tpl_class($sitio);
$rango['i']=$_POST["mes1"];
$rango['t']=$_POST["mes2"];

$lista=$contenido->mostrar_contenido($temp,$rango,'M');

}else{
$lista_mes=$Cumple->Cumple_por_el_mes($t['mon']);
$cumple_semana=$Cumple->Cumpleanno_de_la_semana($lista_mes);

$contenido= new tpl_class($sitio);
$rango=$Cumple->cal_dia_por_semana();
$lista=$contenido->mostrar_contenido($cumple_semana,$rango,'S');
}

echo $lista;