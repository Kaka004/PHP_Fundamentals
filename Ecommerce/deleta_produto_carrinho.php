<?php
    include("cabecalho2.php");
    $idprod = $_GET['var1'];
    $id = $_GET['var2'];
    $sql = "DELETE FROM item_carrinho WHERE
    fk_por_id = $idprod AND fk_car_id = $id";
    $resultado = mysqli_query($linl, $sql);
    #retorna ao carrinho
    header("Location: carrinho.php?id=$idusuario");
?>