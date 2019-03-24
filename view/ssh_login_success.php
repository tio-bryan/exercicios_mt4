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
    
        <h1>Digite a senha para <?= $_GET['hostname'] ?>@<?= $_GET['ip'] ?>:</h1>
        <form action="index.php?classe=Ssh&metodo=autenticacao" method="post">
            <input type="text" name="senha"/>
            <input type="submit"/>
        </form>
    </body>
</html>