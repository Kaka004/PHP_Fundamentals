<?php
require_once 'db_connection.php';

class Paciente {
    public function cadastraPaciente($nome, $email, $telefone, $cpf) {
        global $conn;
        $sql = "INSERT INTO pacientes (nome, email, telefone, cpf) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $telefone, $cpf);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public function listaPacientes() {
        global $conn;

        $sql = "SELECT * FROM pacientes";
        $result = $conn->query($sql);

        $conn->close();

        return $result;
    }
}
?>