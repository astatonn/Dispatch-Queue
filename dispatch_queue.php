<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        <script>
           /* setTimeout(function(){
            window.location.reload(1);
            }, 5000);*/
        </script>
        <link rel="stylesheet" type ="text/css" href="mystyle.css">
    </head>
    <body>
    
        <nav>ACOMPANHAMENTO DA FILA</nav>
    <div class="grid-container">
    <div class="queue">
    <table>
        <tbody>
            <thead>
            <tr>
                <th>ID</th>
                <th>CÓDIGO DE ACESSO</th>
            </tr>
            </thead>
            <?php
                include "functions.php";
                include "connectDB.php";
                $connection = OpenCon ();
                $sql = "SELECT id, codAcess FROM dispatch_queue ORDER BY id ASC";
                $return = $connection ->query($sql);
                
                if($return ->num_rows > 0){
                    while ($row = $return ->fetch_assoc()){
                        echo "<tr><td>" .$row["id"]."</td><td>".$row["codAcess"]."</td></tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "SEM FILA!";
                }
                CloseCon($connection);
            ?>
        </tbody>
    </table>
            </div>
            

            <div class="NewTicket">
                <a href="/dispatch.html">Criar novo ticket </a>
            </div>
            <div class="QueueStatus">
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
    </body>
</html>