<?php
//WHILE
//$numero = 0;
//while($numero <= 10){
    //echo (" $numero <br>");
    //$numero = $numero + 5;

    //echo (" $numero++ ");
//}
echo ("<br>");
echo ("<br>");
echo ("<br>");

//SWITCH CASE
$porta = "Verde";
    switch ($porta){
        case "Azul":
            echo("VOCÊ ENCONTROU UM HOBBIT <br>");
            echo " Olá aventureiro! bla bla bla";
            break;
            case "azul":
                echo("VOCÊ ENCONTROU UM HOBBIT <br>");
                echo " Olá aventureiro! bla bla bla";
                break;
        case "Verde":
            echo "VOCÊ ENCONTROU UM GUAXINIM";
            echo "LANÇAR GUAXINIM?";
            $lancamento = 's';
            break;
            default:
            echo "NÃO FOI DETECTADA PORTA DE ACESSO";

    }

//DO WHILE
$variavel = 4;
do{
    echo $variavel++;
}while($variavel <=10);

echo ("<br>");
echo ("<br>");
echo ("<br>");

//FOR

//for($variavel = 0; $variavel1 <= 10; $variavel1++){
   //echo $variavel++;
//}
