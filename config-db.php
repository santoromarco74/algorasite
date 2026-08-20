<?php
/*
 * Parametri di connessione al database.
 *
 * Sono isolati qui, fuori dalla logica applicativa, per due motivi:
 *  - il passaggio da ambiente locale (XAMPP/MAMP) a hosting richiede di
 *    modificare un solo file, non lo script che elabora il modulo;
 *  - in un deployment reale questo file va escluso dal versionamento
 *    (.gitignore) in modo che le credenziali non finiscano nel repository.
 *
 * I valori qui sotto sono quelli predefiniti di XAMPP/MAMP.
 */

return [
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'algora_db',
    'charset'  => 'utf8mb4',
];
