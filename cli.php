<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'myfinances'
], 'root', '');

$search = "testtest1";
$query = "SELECT * FROM users WHERE username=:name";

$stmt = $db->query($query);

$stmt->bindValue('name', $search, PDO::PARAM_STR);

$stmt->execute();

var_dump($stmt->fetchAll(PDO::FETCH_OBJ));
