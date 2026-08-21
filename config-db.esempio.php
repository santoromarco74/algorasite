<?php
/*
 * MODELLO dei parametri di connessione al database.
 *
 * Questo file sta in repository; quello che il sito legge davvero,
 * config-db.php, no. Per far funzionare il progetto dopo un clone:
 *
 *   1. copiare questo file in config-db.php
 *   2. sostituire i valori qui sotto con quelli veri
 *
 * Il file vero e' escluso dal versionamento (.gitignore) perche' contiene
 * una password valida anche in produzione: l'ambiente locale e' infatti
 * configurato con le stesse credenziali dell'hosting, cosi' che la
 * pubblicazione non richieda di modificarlo (§5.5 della relazione).
 *
 * Se la password cambia, cambia in un punto solo e in nessun commit.
 */

return [
    'host'     => 'localhost',
    'user'     => 'nome_utente_mysql',
    'password' => 'password_del_database',
    'dbname'   => 'nome_del_database',
    'charset'  => 'utf8mb4',
];
