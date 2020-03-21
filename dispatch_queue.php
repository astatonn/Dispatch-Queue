<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        <style>tr, th, td{border: 2px solid black;}</style>
        <script>
            setTimeout(function(){
            window.location.reload(1);
            }, 5000);
        </script>
    </head>
    <body>
    <table>
        <tbody>
            <tr>
                <th>ID</th>
                <th>CÓDIGO DE ACESSO</th>
            </tr>
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
    <a href="/dispatch.html">Criar novo ticket </a>
                <?php
                    $connection = OpenCon();
                    $SQL = "SELECT id, codAcess,status
                            FROM dispatch_queue
                            ORDER BY id ASC
                            LIMIT 1";
                    $RETURN = $connection->query ($SQL);
                    $ROW = $RETURN ->fetch_assoc();
                    if ($ROW["status"]==0){
                        echo "Status: em espera";
                    }
                    else {
                    echo "Senha: ".$ROW["id"]."<p>Código de acesso: ".$ROW["codAcess"]."<p>Status: ".status($ROW ["status"]);
                    }
                ?>
    </body>
</html>