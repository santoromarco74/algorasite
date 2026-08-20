-- Creazione e selezione del database
CREATE DATABASE IF NOT EXISTS algora_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE algora_db;

-- Tabella delle richieste di contatto inviate dal modulo web.
--
-- La colonna consenso_privacy non registra soltanto che la casella era
-- spuntata: l'articolo 7 del GDPR richiede di poter dimostrare che il
-- consenso e' stato prestato, quindi si conserva anche il momento in cui
-- e' avvenuto. Coincide con data_invio, ma tenerlo separato mantiene il
-- dato leggibile se in futuro il consenso venisse raccolto altrove.
CREATE TABLE IF NOT EXISTS contatti (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nome             VARCHAR(100) NOT NULL,
    ente             VARCHAR(100),
    email            VARCHAR(100) NOT NULL,
    tipo             VARCHAR(50),
    messaggio        TEXT         NOT NULL,
    consenso_privacy TINYINT(1)   NOT NULL DEFAULT 0,
    data_consenso    DATETIME     DEFAULT NULL,
    data_invio       DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Se la tabella esiste gia' da una versione precedente, le due colonne
-- vanno aggiunte cosi' (l'istruzione fallisce se sono gia' presenti):
--
--   ALTER TABLE contatti
--     ADD COLUMN consenso_privacy TINYINT(1) NOT NULL DEFAULT 0,
--     ADD COLUMN data_consenso    DATETIME   DEFAULT NULL;
