<?php
/**
 * Conexão com o banco AchouIFRO.
 */
$host = getenv('DB_HOST') ?: 'localhost';
$banco = getenv('DB_NAME') ?: 'achou_ifro';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS') ?: 'sthe';

$dsn = "mysql:host={$host};dbname={$banco};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log('Falha na conexão com o banco Achou.IFRO: ' . $e->getMessage());
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados. Verifique a configuração do servidor.');
}

