<!doctype html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Exercícios MT4</title>

        <script>
            function encode() {

                document.getElementById('info').style.visibility = "visible";

                $.ajax({
                    url: 'model/_encode.php',
                    data: {text: document.getElementById('text').value},
                    type: 'post',
                    success:
                        function(output) {
                            document.getElementById("caesar_cipher").innerHTML = output[0];
                            document.getElementById("aes").innerHTML = output[1];
                            document.getElementById("sodium").innerHTML = output[2];
                        },
                    dataType: 'json'
                });
            }

            function decode() {

                document.getElementById('info').style.visibility = "visible";

                $.ajax({
                    url: 'model/_decode.php',
                    data: {text: document.getElementById('text').value},
                    type: 'post',
                    success:
                        function(output) {
                            document.getElementById("caesar_cipher").innerHTML = output[0];
                            document.getElementById("aes").innerHTML = output[1];
                            document.getElementById("sodium").innerHTML = output[2];
                        },
                    dataType: 'json'
                });
            }
        </script>
    </head>
    <body>
        <!-- Download jQuery -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <div class="form-group">
            <label for="text">Texto:</label>
            <textarea class="form-control" id="text" rows="3"></textarea>
        </div>

        <button class="btn btn-primary" onclick="encode();">Criptografar</button>
        <button class="btn btn-primary" onclick="decode();">Descriptografar</button>

        <div id="info" style="visibility:hidden;">
            <b><p>Cifra de César:</p></b>
            <div id="caesar_cipher"></div>

            <b><p>AES256 com SALT:</p></b>
            <div id="aes"></div>

            <b><p>Sodium do PHP7 (com base64):</p></b>
            <div id="sodium"></div>
        </div>
    </body>
</html>