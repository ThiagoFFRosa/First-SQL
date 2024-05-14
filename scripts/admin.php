<?php
// Obtém os dados do formulário de adição de usuário
$id = intval($_POST['id']); // Converte para inteiro
$login = $conn->real_escape_string($_POST['email']); // Escape para evitar injeção de SQL
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Encripta a senha
$nivel_id = intval($_POST['nivel']); // Converte para inteiro
$ativo = intval($_POST['ativo']);

// Consulta SQL para verificar se o login já existe no banco de dados
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$result = $conn->query($sql);

if ($result) {
    // Verifica se encontrou um usuário com o login informado
    if ($result->num_rows > 0) {
        // Atualiza as informações do usuário existente
        if (!empty($senha)) {
            $update_sql = "UPDATE usuarios SET login = '$login', senha = '$senha', nivel_id = $nivel_id, ativo = $ativo WHERE id = '$id'";
        } else {
            $update_sql = "UPDATE usuarios SET login = '$login', nivel_id = $nivel_id, ativo = $ativo WHERE id = '$id'";
        }
        if ($conn->query($update_sql) === TRUE) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar usuário: " . $conn->error;
        }
    } else {
        // Insere um novo usuário no banco de dados
        $insert_sql = "INSERT INTO usuarios (login, senha, nivel_id, ativo) VALUES ('$login', '$senha', $nivel_id, $ativo)";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Novo usuário adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar novo usuário: " . $conn->error;
        }
    }
} else {
    // Erro na consulta SQL
    echo "Erro na consulta: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
