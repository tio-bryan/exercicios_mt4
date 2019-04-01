<!doctype html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Exercícios MT4</title>

        <script>
            function convert() {

                document.getElementById('info').style.visibility = "visible";

                document.getElementById('sha512_compare').textContent = ''
                document.getElementById('hmac_compare').textContent = ''
                document.getElementById('phash_compare').textContent = ''

                $.ajax({
                    url: 'model/_hash.php',
                    data: {text: document.getElementById('text').value},
                    type: 'post',
                    success:
                        function(output) {
                            document.getElementById("sha512").innerHTML = output[0];
                            document.getElementById("hmac").innerHTML = output[1];
                            document.getElementById("phash").innerHTML = output[2];
                        },
                    dataType: 'json'
                });
            }

            function compare() {

                var hash = document.getElementById('hash').value;

                if (hash != document.getElementById('sha512').textContent) {
                    document.getElementById('sha512_compare').textContent = 'Diferente'
                    document.getElementById('sha512_compare').style.color = "red";
                } else {
                    document.getElementById('sha512_compare').textContent = 'Igual'
                    document.getElementById('sha512_compare').style.color = "green";
                }

                if (hash != document.getElementById('hmac').textContent) {
                    document.getElementById('hmac_compare').textContent = 'Diferente'
                    document.getElementById('hmac_compare').style.color = "red";
                } else {
                    document.getElementById('hmac_compare').textContent = 'Igual'
                    document.getElementById('hmac_compare').style.color = "green";
                }

                if (hash != document.getElementById('phash').textContent) {
                    document.getElementById('phash_compare').textContent = 'Diferente'
                    document.getElementById('phash_compare').style.color = "red";
                } else {
                    document.getElementById('phash_compare').textContent = 'Igual'
                    document.getElementById('phash_compare').style.color = "green";
                }
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

        <button class="btn btn-primary" onclick="convert();">Converter</button>

        <div class="form-group">
            <label for="hash">Comparador de Hash:</label>
            <textarea class="form-control" id="hash" rows="1"></textarea>
        </div>

        <button class="btn btn-primary" onclick="compare();">Comparar</button>

        <div id="info" style="visibility:hidden;">
            <b><p>SHA512:</p></b>
            <div id="sha512"></div>
            <div id="sha512_compare"></div>

            <b><p>HMAC:</p></b>
            <div id="hmac"></div>
            <div id="hmac_compare"></div>

            <b><p>PHP password_hash:</p></b>
            <div id="phash"></div>
            <div id="phash_compare"></div>
        </div>
    </body>
</html>