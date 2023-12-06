CREATE DATABASE odontoPlus;

USE odontoPlus;

CREATE TABLE medicos (
    med_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    med_nome VARCHAR(255) NOT NULL,
    med_sobrenome VARCHAR(255) NOT NULL,
    med_especialidade VARCHAR(255) NOT NULL,
    med_bio TEXT
);

CREATE TABLE especialidades (
    esp_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    esp_nome VARCHAR(255) NOT NULL,
    esp_descricao TEXT
);

CREATE TABLE horarios (
    hor_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    medico_id INT NOT NULL,
    especialidade_id INT NOT NULL,
    data DATE NOT NULL,
    hor_hora TIME NOT NULL,
    status ENUM('agendado', 'cancelado', 'concluído') NOT NULL,
    FOREIGN KEY (medico_id) REFERENCES medicos(id),
    FOREIGN KEY (especialidade_id) REFERENCES especialidades(id)
);

CREATE TABLE agendamentos (
    agen_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    agen_nome VARCHAR(255) NOT NULL,
    agen_sobrenome VARCHAR(255) NOT NULL,
    agen_email VARCHAR(255) NOT NULL,
    agen_telefone VARCHAR(20) NOT NULL,
    agen_horario_id INT NOT NULL,
    FOREIGN KEY (horario_id) REFERENCES horarios(id)
);