<html>
    <head>
        <title>
            Requisição a API VidaClass
        </title>
    </head>
    <body>
        <form name="frmcpf" method="post" action="processa.php">
            <p>Digite o CPF para busca: <input type="text" name="cpf" size="25" data-mask="000.000.000-00"></p>
            <button type="submit">Enviar</button>
        </form>



        <script src="js/validaCampoCpf.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    </body>
</html>