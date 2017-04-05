<?php

if (($url = getenv('DATABASE_URL')) !== false) {
    // Configuración para Heroku:
    $config = parse_url($url);
    $host = $config['host'];
    $port = $config['port'];
    $dbname = substr($config['path'], 1);
    $username = $config['user'];
    $password = $config['pass'];
} else {
    // Configuración para entorno local:
    $host = 'localhost';
    $port = '5432';
    $dbname = 'proyecto';
    $username = 'proyecto';
    $password = 'proyecto';
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=$host;port=$port;dbname=$dbname",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
];

