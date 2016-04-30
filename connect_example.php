<?php

$mysqli= new mysqli("localhost" , "user" , "pw", "db");
$pdo = new PDO('mysql:host=localhost;dbname=db', 'user', 'pw');

define ('SECRET_CODE', 'someSecretCharacters', true);