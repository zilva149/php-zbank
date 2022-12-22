<?php

function redirect(string $url): void
{
    header("Location: http://localhost:8080/intro/personal-projects/php-zbank/$url");
    die;
}

function validateIDNum(array $users, string $num): bool
{
    foreach ($users as $user) {
        if ($user->id_num == $num) {
            return false;
        }
    }
    return true;
}

function generateIBAN(array $users, string $IBAN = ''): string
{
    $IBAN = 'LT' . rand(0, 9) . rand(0, 9) . ' ' . '6249' . ' ' . '9' . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    foreach ($users as $user) {
        if ($user->bank_acc == $IBAN) {
            generateIBAN($users, $IBAN);
        }
    }
    return $IBAN;
}

function generateID(array $users, int $ID = null): int
{
    $ID = rand(1000000, 9999999);
    foreach ($users as $user) {
        if ($user->id == $ID) {
            generateID($users, $ID);
        }
    }
    return $ID;
}
