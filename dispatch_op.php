<!--https://stackoverflow.com/questions/40559551/how-to-retrieve-row-from-a-html-table-on-mouse-click-in-php-->
<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        <style>tr, th, td{border: 2px solid black;}</style>
    </head>
    <body>
    <table>
        <tbody>
            <tr>
                <th>ORDEM</th>
                <th>DESCRIÇÃO</th>
                <th>P/G</th>
                <th>NOME</th>
                <th>FUNÇÃO</th>

            </tr>
            <?php
                include "functions.php";
                include "connectDB.php";
                $connection = OpenCon ();
                $sql = "SELECT `dispatch_queue`.`id`, `dispatch_queue`.`description`, `dispatch_data`.`PG`, `dispatch_data`.`NOME`, `dispatch_data`.`FUNCAO` 
                FROM dispatch_queue 
                INNER JOIN dispatch_data
                WHERE `dispatch_data`.`codAcess` = `dispatch_queue`.`codAcess`
                ORDER BY id ASC";
                $return = $connection ->query($sql);
                
                if($return ->num_rows > 0){
                    while ($row = $return ->fetch_assoc()){
                        echo "<tr><td>" .$row["id"]."</td><td>".$row["description"]."</td><td>". PG($row["PG"])."</td><td>".$row["NOME"]."</td><td>".FUNCAO($row["FUNCAO"])."</td></tr>";
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
        <button type="submit" value="refresh" onclick="window.location.reload(true);">Atualizar Fila</button>   
        
        <div>
                STATUS DA FILA
                <?php
                    $sql = "SELECT id, codAcess
                            FROM dispatch_queue
                            ORDER BY ASC
                            LIMIT 1;"
                    
                ?>

        </div>

        <button type="submit" value="nextNode">Chamar próximo</button>
        <button type="submit" value="onHold">Em espera</button>
        <button type="submit" value="theEnd">Encerrar acessos</button>
    </body>
</html>