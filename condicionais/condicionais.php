<?php
$var1 = 3;
$var2 = 2;

#CONDICIONALIDADE DE IGUALIDADE (COMPLETA)
if($var1 == $var2)
{
    echo("SÃO AS MESMAS PESSOAS");
}
else{
    echo ("NÃO SÃO AS MESMAS PESSOAS");
}

echo("<br><br>");


if($var1 === $var2) {
    echo("MESMO DATA TYPE");
}
else{
    echo("DATA TYPE DIFERENTE");
}

echo("<br><br>");

##OPERADOR TERNÁRIO
echo($var1 === $var2?"É IGUAL":"É DIFERENTE");
?>
