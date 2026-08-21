<?php
/*
 * Parametri di connessione al database.
 *
 * Sono isolati qui, fuori dalla logica applicativa, perche' in un deployment
 * reale questo file va escluso dal versionamento (.gitignore), in modo che le
 * credenziali non finiscano nel repository.
 *
 * L'ambiente locale e' configurato con lo stesso nome di database, lo stesso
 * utente e la stessa password dell'hosting: il file e' percio' identico nei
 * due ambienti e la pubblicazione non richiede di modificarlo. Serve a non
 * ritrovarsi in produzione con i parametri di sviluppo, ne' a sovrascrivere
 * quelli di produzione alla sincronizzazione successiva.
 *
 * I valori qui sotto sono segnaposto: vanno sostituiti con le credenziali
 * effettive, che essendo valide anche in produzione non vanno committate.
 */

return [
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'algora_db',
    'charset'  => 'utf8mb4',
];
