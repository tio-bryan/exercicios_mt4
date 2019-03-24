<?php
$dispositivos = $_REQUEST['dispositivos'];
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Exercícios MT4</title>

        <script type = "text/javascript">
            function getConfirmation(ip) {
                var retVal = confirm('Realmente deseja excluir o IP ' + ip + '?');
                if( retVal == true ) {
                    // Mudar de GET para POST
                    window.location ='index.php?classe=Dispositivos&metodo=remover&ip=' + ip;
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <!-- Download jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    
        <h1>Dispositivos Cadastrados</h1>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Hostname</th>
                    <th>IP</th>
                    <th>Tipo</th>
                    <th>Fabricante</th>
                    <th>SSH</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($dispositivos as $dispositivo): ?>
                    <tr>
                        <td>
                            <button type="button" class="close" aria-label="Close" style="color:red;" onclick="getConfirmation('<?= $dispositivo['ip'] ?>');">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </td>
                        <td><input type="image" src="img/edit.png" width="18" height="18" onclick="window.location='index.php?classe=Dispositivos&metodo=preAtualizar&ip=<?= $dispositivo['ip'] ?>';"/></td>
                        <td><?= $dispositivo['hostname']; ?></td>
                        <td><?= $dispositivo['ip']; ?></td>
                        <td><?= $dispositivo['tipo']; ?></td>
                        <td><?= $dispositivo['fabricante']; ?></td>
                        <td><input type="image" src="img/connect.png" width="18" height="18" onmouseover="this.src='img/connected.png';" onmouseout="this.src='img/connect.png';" onclick="window.location='index.php?classe=Ssh&metodo=conecta&hostname=<?= $dispositivo['hostname']; ?>&ip=<?= $dispositivo['ip']; ?>';"/></td>
                    </tr>
                <?php endforeach; ?>
                
                <tr>
                    <form action="index.php">
                        <input type="hidden" name="classe" value="Dispositivos">
                        <input type="hidden" name="metodo" value="salvar">

                        <td></td>
                        <td><input type="image" src="img/add.ico" alt="Submit" width="18" height="18"/></td>
                        <td><input type="text" name="hostname" value=""></td>
                        <td><input type="text" name="ip" value=""></td>
                        <td><input type="text" name="tipo" value=""></td>
                        <td><input type="text" name="fabricante" value=""></td>
                        <td></td>
                    </form> 
                </tr>
                
            </tbody>
        </table>
    </body>
</html>