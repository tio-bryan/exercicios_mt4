<!doctype html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Exercícios MT4</title>
    </head>
    <body>
        <!-- Download jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <form action="index.php?classe=Ssh&metodo=autenticacao" method="post">
            <input type="hidden" name="ip" value="<?= $_GET['ip'] ?>">
            <h1>Usuário:</h1>
            <input type="text" name="user">
            <h1>Senha:</h1>
            <input type="text" name="senha"><br>
            <input type="submit" value="Logar">
        </form>
    </body>
</html>