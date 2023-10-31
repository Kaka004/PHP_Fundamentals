<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $nome = trim($nome);
    $descricao = $_POST['descricao'];
    $descricao = trim($descricao);
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_POST['imagem'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);

        if ($tipo !== false) {
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
        } else {
            $imagem = file_get_contents("C:\\xamp\\htdocs\\Ecommerce\\img\\alert.jpg");
        }
    }

    $sql = "UPDATE produtos SET pro_nome = '$nome', pro_quantidade = '$quantidade', pro_preco = '$valor', pro_descricao = '$descricao', imagem1 = '$imagem' WHERE pro_id = $id";
    mysqli_query($link, $sql);

    echo "<script>window.alert('PRODUTO ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='listaproduto.php';</script>";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = $id";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nome = $tbl[1];
    $quantidade = $tbl[2];
    $valor = $tbl[3];
    $descricao = $tbl[4];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>ALTERAR PRODUTO</title>
</head>
<body>
    <div>
        <form action="alteraproduto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            
            <label>Quantidade</label>
            <input type="number" name="quantidade" value="<?= $quantidade ?>" required>

            <label>Valor</label>
            <input type="text" name="valor" value="<?= $valor ?>" required>
            
            <label>Descrição</label>
            <input type="text" name="descricao" value="<?= $descricao ?>" required>

            <label>Imagem</label>
            <input type="file" name="imagem" required>

            <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>
