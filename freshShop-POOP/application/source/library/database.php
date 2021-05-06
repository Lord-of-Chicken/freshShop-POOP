<?php

/* retourne une connection à la base de données

@return PDO */

function getPdo()
{

    $pdo = new PDO('mysql:host=database;dbname=FreshShop;charset=utf8',  'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);

    return $pdo;
}
