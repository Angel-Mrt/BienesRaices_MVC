<?php

function conectarDB() : mysqli
{
    $db = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
    );


    if (!$db) {
        echo "No Se Pudo Conectar";
        exit;
    }
    $db->set_charset('utf8');

    return $db;
}
