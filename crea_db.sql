-- Creazione e selezione del database
CREATE DATABASE IF NOT EXISTS algora_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE algora_db;

-- Tabella delle richieste di contatto inviate dal modulo web
CREATE TABLE IF NOT EXISTS contatti (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100) NOT NULL,
    ente       VARCHAR(100),
    email      VARCHAR(100) NOT NULL,
    tipo       VARCHAR(50),
    messaggio  TEXT         NOT NULL,
    data_invio DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
