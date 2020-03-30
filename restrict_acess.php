<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" type ="text/css" href="mystyle2.css">
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width:">
    </head>
    <body>
    <div class="top-head">
        <img src="img/acanto.png"></img>
        <nav>ACESSO RESTRITO</nav>
        <ul>
                <li>Desenvolvido por 3º Sgt Souza Lima</li>
                
            </ul>
       <div class="header-nav">
            <ul>
        <li><a href="http://intranet.3bsup.eb.mil.br/suporte/">Suporte ao Usuário</a></li>
        <li><a href="dispatch.html">Criar Novo Ticket</a></li>
        <li><a href="dispatch_op.php">Acesso Restrito</a></li>
        <li><a href="dispatch_queue.php">Ver Fila</a></li>
        <li><a href="admin.php">Administrador</a></li>
        </ul>
        </div>
    </div>
    <div class="form-location">
        <div class="form-fill">
    <h1>ACESSO RESTRITO</h1>
        <form method="POST" action="ope.php">
            <label for="login">Usuário: </label><br>
            <input type="text" name="login" id="login" required="required"><br>
            <label for="codAcess" name="codAcess" id="codAcess">Código de Acesso: </label><br>
            <input type="text" name="codAcess" id="codAcess"><br><BR>
            <input type="submit" value="Enviar" class="myButton">


        </form>
        </div>

</div>
</body>
</html>