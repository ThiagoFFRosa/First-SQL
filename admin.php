<?php
require_once "scripts/conexao.php";

$id = $email = $senha = $ativo = $nivel = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if( !empty($_GET['acao']) && $_GET['acao'] == 'up' ) {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            $q = "SELECT * FROM usuarios WHERE id = '$id'";
            $sth = $conn->query($q);
            $row = $sth->fetch_array();
            $id = $row['id'];
            $email = $row['login'];
            //$senha = $row['senha'];
            $ativo = $row['ativo'];
            $nivel = $row['nivel_id'];
        }

    } else { // del
        $id = $_GET['id'];
    
        $q = "DELETE FROM usuarios WHERE id = '$id'";
        $sth = $conn->query($q);
    }

    
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page Title -->
    <title>Sistema de Cadastro de Clientes</title>

    <!-- Favicon -->
    <script src="https://kit.fontawesome.com/37b6c9c7b6.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--NAV BAR START -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <i class="fa-solid fa-code" style="color: #f4f4f4; margin-right: 15px"></i>
            <a class="navbar-brand" href="index.html" style="color: #ffffff">ADMIN ACESS</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" style="color: #ffffff">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://github.com/ThiagoFFRosa"
                            style="color: #ffffff">Github Thiago</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://github.com/unamed"
                            style="color: #ffffff">Github Leonardo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV AREA END-->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar/Update Usuário</h5>
                        <form action="" method="POST" id="addUserForm">
                            <input type="hidden" name="id" id="id" value="<?=$id?>">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control mb-2" required value="<?=$email?>">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" class="form-control mb-2" value="">
                            <label for="nivel">Nível de Acesso:</label>
                            <select name="nivel" id="nivel" class="form-control mb-2">
                                <option value="">**Selecione</option>
                                <option value="1" <?php if($nivel == 1) echo 'selected'; ?> >Administrador</option>
                                <option value="2" <?php if($nivel == 2) echo 'selected'; ?> >Comum</option>
                            </select>    
                            <label for="ativo">Ativo:</label>
                            <select name="ativo" id="ativo" class="form-control mb-2">
                                <option value="">**Selecione</option>
                                <option value="1" <?php if($ativo == 1) echo 'selected'; ?> >Sim</option>
                                <option value="2" <?php if($ativo == 2) echo 'selected'; ?> >Não</option>
                            </select> 
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Usuários</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nível de Acesso</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <!--aqui será mostrado os dados de usuario-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "scripts/admin.php";
}
?>


    <script>
        // Função para carregar os dados dos usuários via AJAX e preencher a tabela
        function loadUsers() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var users = JSON.parse(xhr.responseText);
                    var tbody = document.getElementById("userTableBody");
                    tbody.innerHTML = "";
                    users.forEach(function (user) {
                        var row = "<tr><td><a href='?acao=up&id=" + user.id + "' class='btn btn-primary'>" + user.id + "</a></td><td>" + user.login + "</td><td>" + user.cargo + "</td><td><a href='?acao=del&id=" + user.id + "' class='btn btn-danger'>Excluir</a></td></tr>";


                        tbody.innerHTML += row;
                    });
                }
            };
            xhr.open("GET", "scripts/get_users.php", true);
            xhr.send();
        }
    
        // Chama a função para carregar os usuários quando a página carregar
        window.onload = function () {
            loadUsers();
        };
    </script>


    <!-- Bootstrap JS (opcional, apenas se você precisar de funcionalidades do Bootstrap que dependem de JavaScript) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
