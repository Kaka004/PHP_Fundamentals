<?php
//*INICIA A CONEXÃO COM O BANCO DE DADOS 
include("cabecalho.php");

//*COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $nome = trim($nome);
    $descricao = $_POST['descricao'];
    $descricao = trim($descricao);
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_POST['imagem'];



    if(isset($_FILES['imagem']) && $_FILES['imagem']
    ['error'] === UPLOAD_ERR_OK){
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);

        if($tipo !== false) {
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $image_base64 = base64_encode($imagem);
            ;
        } else {
                $imagem = file_get_contents("C:\\xampp\\htdocs\\Ecommerce\\img\\alert.jpg");
                $image_base64 = base64_encode($imagem);
            }
        
    } else {
        $imagem = file_get_contents("C:\\xampp\\htdocs\\Ecommerce\\img\\alert.jpg");
                $image_base64 = base64_encode($imagem);
    }
    
    $sql = "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome = '$nome' AND pro_ativo = 's'";
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }

    if($cont == 1) {
        echo "<script>window.alert('PRODUTO JÁ CADASTRADO!');</script>";
    }
    else{
        $sql = "INSERT INTO produtos (pro_nome, pro_quantidade, pro_preco, pro_descricao, imagem1, pro_ativo) VALUES('$nome','$quantidade','$valor','$descricao','$image_base64','n')";
        echo $sql;
        mysqli_query($link, $sql);
        echo "<script>window.alert('PRODUTO CADASTRADO!');</script>";
        echo "<script>window.location.href='cadastraproduto.php';</script>";
    }
}
?> 








<html>
    <head>
        <link rel="stylesheet" href="./css/estiloadm.css">
        <title>CADASTRO DE PRODUTO</title>
    </head>
    <body>
        <div>
            <form action="cadastraproduto.php" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome do Produto">
                <p></p>
                <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade">
                <p></p>
                <input type="decimal" name="valor" id="valor" placeholder="Valor">
                <p></p>
                <input id = "desc" type="text" name="descricao" id="descricao" placeholder="Descrição">
                <p></p>
                <input type="file" name="imagem" id="imagem" placeholder="Imagem">
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" placeholder="Cadastrar">
            </form>
        </div>
    </body>
</html>