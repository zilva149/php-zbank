<?php
session_start();

$title = 'ZBank | Nuskaičiuoti Lėšas';
$_SESSION['admin'] = 'Jonas';

if (!isset($_SESSION['admin'])) {
    header('Location: href="http://localhost:8080/intro/personal-projects/php-zbank/login.php"');
    die;
}

require(__DIR__ . '/inc/header.php');
?>

<main class="main-withdraw-money">

</main>