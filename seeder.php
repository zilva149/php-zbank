<?php

$admin = [
    ['name' => 'Jonas', 'email' => 'jonas.jonaitis@gmail.com', 'psw' => md5('mypassword111')]
];

$users = [
    ['id' => rand(1000000, 9999999), 'id_num' => '39502150645', 'bank_acc' => 'LT01 2345 6798 0123 4567', 'name' => 'Tomas', "surname" => 'Blaževičius', 'money' => 2850],
    ['id' => rand(1000000, 9999999), 'id_num' => '38709251195', 'bank_acc' => 'LT01 2345 6986 4562 0066', 'name' => 'Eglė', "surname" => 'Kaminskaitė', 'money' => 654],
    ['id' => rand(1000000, 9999999), 'id_num' => '39502150645', 'bank_acc' => 'LT01 2345 6032 8569 7741', 'name' => 'Matas', "surname" => 'Vieversys', 'money' => 14550]
];

file_put_contents(__DIR__ . '/admin.json', json_encode($admin));
file_put_contents(__DIR__ . '/users.json', json_encode($users));
