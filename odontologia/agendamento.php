<?php
require_once 'db_connection.php';

class Agendamento {
    public function cadastraAgendamento($dentista_id, $paciente_id, $data) {
        global $conn;
        $sql = "INSERT INTO agendamentos (dentista_id, paciente_id, data) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $dentista_id, $paciente_id, $data);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public function listaAgendamentos() {
        global $conn;

        $sql = "SELECT * FROM agendamentos";
        $result = $conn->query($sql);

        $conn->close();

        return $result;
    }
}
?>