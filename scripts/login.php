<?php
require_once "conexao.php";

// Obtém os dados do formulário de login
$email = $conn->real_escape_string($_POST['email']); // Escape para evitar injeção de SQL
$senha = $conn->real_escape_string($_POST['senha']); // Escape para evitar injeção de SQL

// Consulta SQL para verificar se o login existe
$sql = "SELECT * FROM usuarios WHERE login = '$email'";
$result = $conn->query($sql);

if ($result) {
    // Verifica se encontrou um usuário com o login informado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['senha'];
        $ativo = $row['ativo']; // Verifica o status da conta do usuário
        
        // Verifica se a conta do usuário está ativa
        if ($ativo == 1) {
            // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
            if (password_verify($senha, $hashed_password)) {
                // Usuário autenticado com sucesso
                // Verificar o nível de acesso do usuário
                $nivel_acesso = $row['nivel_id'];
                if ($nivel_acesso == 1) {
                    // Usuário é um administrador, redirecionar para admin.html
                    header('Location: ../admin.php');
                    exit();
                } else {
                    // Usuário é comum, redirecionar para comum.html
                    header('Location: ../comum.html');
                    exit();
                }
            } else {
                // Senha incorreta
                echo "Senha incorreta. Tente novamente.";
            }
        } else {
            // Conta do usuário está desativada
            echo "Seu login foi desativado. Entre em contato com o administrador.";
        }
    } else {
        // Usuário não encontrado
        echo "Email incorreto. Verifique seu email.";
    }
} else {
    // Erro na consulta SQL
    echo "Erro na consulta: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();

// Redirecionar para index.html após 5 segundos
header('Refresh: 5; URL=../index.html');
exit();
?>
