<?php

$admin = [
    ['name' => 'Jonas', 'email' => 'jonas.jonaitis@gmail.com', 'psw' => md5('mypassword111')]
];

$users = [
    ['id' => rand(1000000, 9999999), 'id_num' => '39502150645', 'bank_acc' => 'LT01 2345 6798 0123 4567', 'name' => 'Tomas', "surname" => 'Blaževičius', 'money' => number_format(2695, 2, '.', ',')],
    ['id' => rand(1000000, 9999999), 'id_num' => '38709251195', 'bank_acc' => 'LT01 2345 6986 4562 0066', 'name' => 'Eglė', "surname" => 'Kaminskaitė', 'money' => number_format(1399, 2, '.', ',')],
    ['id' => rand(1000000, 9999999), 'id_num' => '39502150645', 'bank_acc' => 'LT01 2345 6032 8569 7741', 'name' => 'Matas', "surname" => 'Vieversys', 'money' => number_format(14822, 2, '.', ',')]
];

file_put_contents(__DIR__ . '/admin.json', json_encode($admin));
file_put_contents(__DIR__ . '/users.json', json_encode($users));
