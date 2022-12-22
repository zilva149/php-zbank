<?php

$admin = [
    ['name' => 'Jonas', 'email' => 'jonas.jonaitis@gmail.com', 'psw' => md5('mypassword111')]
];

$users = [
    ['id' => rand(1000000, 9999999), 'id_num' => '39502150645', 'bank_acc' => 'LT01 6249 9798 0123 4567', 'name' => 'Tomas', "surname" => 'Blaževičius', 'money' => 2695],
    ['id' => rand(1000000, 9999999), 'id_num' => '38709251195', 'bank_acc' => 'LT56 6249 9986 4562 0066', 'name' => 'Eglė', "surname" => 'Kaminskaitė', 'money' => 1399],
    ['id' => rand(1000000, 9999999), 'id_num' => '39502150645', 'bank_acc' => 'LT44 6249 9032 8569 7741', 'name' => 'Matas', "surname" => 'Vieversys', 'money' => 14822]
];

file_put_contents(__DIR__ . '/admin.json', json_encode($admin));
file_put_contents(__DIR__ . '/users.json', json_encode($users));
