<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        <script>
           setTimeout(function(){
            window.location.reload(1);
            }, 5000);
        </script>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" type ="text/css" href="mystyle2.css">
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width:">
    </head>
    <body>
    <div class="top-head">
        <img src="img/acanto.png"></img>
        <nav>ACOMPANHAMENTO DA FILA</nav>
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
    <div class="container-queue">
        <div class="table-position">
        <div class="table-fill">
        <table>
                <thead>
                <tr>
                    <th class="text-left">ID</th>
                    <th class="text-left">CÓDIGO DE ACESSO</th>
                </tr>
                </thead>
                <tbody class="table-hover">
                <?php
                    include "functions.php";
                    include "connectDB.php";
                    $connection = OpenCon ();
                    $sql = "SELECT id, codAcess FROM dispatch_queue ORDER BY id ASC";
                    $return = $connection ->query($sql);
                    
                    if($return ->num_rows > 0){
                        while ($row = $return ->fetch_assoc()){
                            echo '<tr><td class="text-left">' .$row["id"].'</td><td class="text-left">'.$row["codAcess"].'</td></tr>';
                        }
                    }
                    else {
                        echo "SEM FILA!";
                    }
                    CloseCon($connection);
                ?>
                </tbody>
    
        </table>
                </div>
                </div>

            <div class="status-position">
            <div class="container-a-link">
                <a href="/dispatch.html">Criar novo ticket </a>
                </div>
           <br>
           <div class="container-sq">
               <h1>STATUS DA FILA</h1>
           <div class='container-status-queue'>
                <?php
                    $connection = OpenCon();
                    $SQL = "SELECT id, codAcess,status
                            FROM dispatch_queue
                            ORDER BY id ASC
                            ";
                    $RETURN = $connection->query ($SQL);
                    $c = 0;
                    while ($ROW = $RETURN ->fetch_assoc()){
                    
                        if ($ROW["status"]==1 || $ROW["status"]==2){
                            echo "Senha: ".$ROW["id"]."<br><br><p>Código de acesso: ".$ROW["codAcess"]."<br><br><p>Status: ".status($ROW ["status"]);
                        $c = 1;
                        break;
                        }
                        else {
                            if ($ROW["status"] == 0){
                                $c =0;
                            }
                        }
                    }
                        if ($c == 0){
                            echo "EM ESPERA";
                        }
                ?>
                </div>
          </div>      
                    </div>
  
    </body>
</html>