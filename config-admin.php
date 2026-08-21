<?php
/*
 * Credenziale della sola area riservata (archivio.php).
 *
 * Il file e' separato da config-db.php per la stessa ragione per cui
 * quest'ultimo e' separato dal codice applicativo: sono parametri di
 * ambiente, non logica, e in un deployment reale vanno esclusi dal
 * versionamento (.gitignore).
 *
 * Qui non e' conservata la password ma la sua impronta calcolata con
 * password_hash(): l'algoritmo bcrypt e' lento per costruzione e usa un
 * "sale" diverso a ogni chiamata, quindi due impronte della stessa
 * password sono diverse fra loro e non sono confrontabili con una tabella
 * precalcolata. La verifica avviene con password_verify(), che confronta
 * in tempo costante.
 *
 * Per cambiare la password si rigenera l'impronta da riga di comando:
 *
 *   php -r 'echo password_hash("nuova-password", PASSWORD_DEFAULT), "\n";'
 *
 * L'impronta qui sotto corrisponde alla password dimostrativa "algora2025".
 */

return [
    'password_hash' => '$2y$12$hWFa5uXZKsYa4qYQUstSPuwmAa1LAQBGP.xNlhWDqQuKzXkRrRMXu',
];
