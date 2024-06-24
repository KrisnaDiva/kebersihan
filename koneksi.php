<?php
function getKoneksi(): PDO
{
    $host = "localhost";
    $port = 3306;
    $database = "kebersihan";
    $username = "root";
    $password = "";
    return new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
}