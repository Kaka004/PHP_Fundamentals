<?php 
include("cabecalholoja.php");

$id = $_GET['id'];

if(isset($idclientes)){
    $sql = "SELECT COUNT(fav_id) FROM favoritos WHERE fk_cli_id = $idclientes AND fk_pro_id =$id";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
        if ($cont == 0){
            $sql = "INSERT INTO favoritos (fk_cli_id, fk_pro_id) VALUES ($idclientes,$id)";
            mysqli_query($link,$sql);
        } else {
            $sql = "DELETE FROM favoritos WHERE fk_cli_id = $idclientes AND fk_pro_id = $id";
            mysqli_query($link,$sql);
        }
    }
} else {
    echo "<script>window.alert('FAÇA LOGIN PARA FAVORITAR');</script>";
    header("Location: loginusuario.php");
}
header("Location: verproduto.php?id=$id");
exit;
?>