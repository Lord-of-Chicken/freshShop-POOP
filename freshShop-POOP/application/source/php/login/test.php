<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login/db.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/header.php'; ?>
<?php

function str_random($lenght)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}
echo (str_random(60)); ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php';
