<?php
$DB_SERVER = "db"; // локалхост
$DB_USER = "root"; // имя пользователя
$DB_PASSWORD = "root"; // пароль если существует
$DB_NAME = "camaguru"; // база данных
$DB_DSN_FIRST = "mysql:host=$DB_SERVER";
$DB_DSN = "mysql:host=$DB_SERVER;dbname=$DB_NAME";
$OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];


