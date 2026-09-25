<?php
session_start();
require_once 'conexao.php';

// Recebe os dados enviados pelo formulário.
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    $mensagem = 'Preencha o e-mail e a senha.';
    $tipoMensagem = 'erro';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mensagem = 'Digite um e-mail válido.';
    $tipoMensagem = 'erro';
} else {
    // O ? é um parâmetro que será preenchido pelo execute().
    $sql = 'SELECT id, email, senha FROM usuarios WHERE email = :email LIMIT 1';
    $consulta = $pdo->prepare($sql);
    $consulta->execute(['email' => $email]);
    $usuarioEncontrado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) {
        $_SESSION['usuario_id'] = $usuarioEncontrado['id'];
        $mensagem = 'Login realizado com sucesso!';
        $tipoMensagem = 'sucesso';
    } else {
        $mensagem = 'E-mail ou senha incorretos.';
        $tipoMensagem = 'erro';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="login-card resultado">
        <h1><?php echo $tipoMensagem === 'sucesso' ? 'Tudo certo!' : 'Não foi possível entrar'; ?></h1>
        <p class="mensagem <?php echo $tipoMensagem; ?>">
            <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <a class="voltar" href="index.php">Voltar para o login</a>
    </main>
</body>
</html>
