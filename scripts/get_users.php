<?php
// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "semtest1";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter todos os usuários
$sql = "SELECT t1.id, t1.login, t1.nivel_id, t2.cargo 
FROM usuarios t1
INNER JOIN niveis t2 ON t1.nivel_id = t2.id
";
$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    // Exibe os dados de cada usuário
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os dados dos usuários em formato JSON
echo json_encode($users);
?>
