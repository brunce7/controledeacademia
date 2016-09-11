
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<?php
$hoje = getdate();
$dia = $hoje["mday"];
$mes = $hoje["mon"];
$ano = $hoje["year"];
$hora= $hoje['hours'];
$minutos= $hoje['minutes'];
if ($mes < 10) { $mes ='0'.$mes ; }
if ($dia < 10) { $dia ='0'.$dia ; }
if ($hora < 10) { $hora ='0'.$hora ; }
if ($minutos < 10 ) {$minutos='0'.$minutos; }
$segundos= $hoje['seconds'];
if ($hora >= 19 && $hora < 06 || $minutos <= 59 && $segundos <=59) {
	$saudacao = "Boa Noite! ";
}
if ($hora >= 06 && $hora < 12 && $minutos <= 59 && $segundos <=59) {
	$saudacao = "Bom dia! ";
}
if ($hora >= 12 && $hora < 19 && $minutos <= 59 && $segundos <= 59) {
	$saudacao = "Boa Tarde! ";
}
$datetime="$dia/$mes/$ano";
?>   
