<?php
    include("cabecalho2.php");
    #COLETA DADOS DO GET
    $idprod = $_GET['var1'];
    $id = $_GET['var2'];
    #Atualiza a quantidade do item no banco de dados
    $sql = "UPDATE item_carrinho SET car_item_quantidade
    = $quantidade WHERE fk_pro_id = $id";
    #echo $sql;
    $resultado = mysqli_query($link, $sql);
    #retorna ao carrinho
    header("Location: carrinho.php?id=$idusuario");
?>