<?php
// Dados de acesso ao banco de dados do XAMPP.
$servidor = 'localhost';
$nomeBanco = 'login_faculdade';
$usuario = 'root';
$senhaBanco = '';

try {
    $pdo = new PDO(
        "mysql:host=$servidor;dbname=$nomeBanco;charset=utf8mb4",
        $usuario,
        $senhaBanco
    );

    // Faz o PDO mostrar erros como exceções.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die('Erro ao conectar com o banco de dados: ' . $erro->getMessage());
}
?>
