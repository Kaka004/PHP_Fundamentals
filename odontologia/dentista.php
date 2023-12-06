<?php
require_once 'db_connection.php';

class Dentista {
    public function cadastraDentista($nome, $email, $telefone, $crm) {
        global $conn;
        $sql = "INSERT INTO dentistas (nome, email, telefone, crm) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $telefone, $crm);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public function listaDentistas() {
        global $conn;

        $sql = "SELECT * FROM dentistas";
        $result = $conn->query($sql);

        $conn->close();

        return $result;
    }
}
?>