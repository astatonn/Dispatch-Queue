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
                <th>STATUS</th>
                <th colspan="3">FUNÇÕES</th>
            </tr>
            <?php
                include "functions.php";
                include "connectDB.php";
                $connection = OpenCon ();
                $sql = "SELECT `dispatch_queue`.`id`,`dispatch_queue`.`codAcess`, `dispatch_queue`.`description`, `dispatch_data`.`PG`, `dispatch_data`.`NOME`, `dispatch_data`.`FUNCAO`, `dispatch_queue`.`status`
                FROM dispatch_queue 
                INNER JOIN dispatch_data
                WHERE `dispatch_data`.`codAcess` = `dispatch_queue`.`codAcess`
                ORDER BY id ASC";
                $return = $connection ->query($sql);
                
                if($return ->num_rows > 0){
                    while ($row = $return ->fetch_assoc()){
                        switch ($row["status"]){
                            case 0:
                                echo "<tr><td>" .$row["id"]."</td><td>".$row["description"]."</td><td>". PG($row["PG"])."</td><td>".$row["NOME"]."</td><td>".FUNCAO($row["FUNCAO"])."</td><td>".$row["status"].
                                '</td><td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=1" class="btn">Chamar</a></td>
                                <td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=2" class="btn">Atendendo</a></td>
                                <td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            break;
                            case 1:
                                echo "<tr><td>" .$row["id"]."</td><td>".$row["description"]."</td><td>". PG($row["PG"])."</td><td>".$row["NOME"]."</td><td>".FUNCAO($row["FUNCAO"])."</td><td>".status($row["status"]).
                                '</td><td><div class="btn-off">Chamar</div></td>
                                <td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=2" class="btn">Atendendo</a></td>
                                <td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            break;
                            case 2:
                                echo "<tr><td>" .$row["id"]."</td><td>".$row["description"]."</td><td>". PG($row["PG"])."</td><td>".$row["NOME"]."</td><td>".FUNCAO($row["FUNCAO"])."</td><td>".$row["status"].
                                '</td><td><div class="btn-off">Chamar</div></td>
                                <td><div class="btn-off">Atendendo</div></td>
                                <td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            case 3:
                                $sql = "DELETE FROM `dispatch_queue` WHERE `dispatch_queue`.`codAcess` =".$row["codAcess"];
                                $connection ->query($sql);




                            }
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
                    $connection = OpenCon();
                    $SQL = "SELECT id, codAcess,status
                            FROM dispatch_queue
                            ORDER BY id ASC
                            LIMIT 1";
                    $RETURN = $connection->query ($SQL);
                    $ROW = $RETURN ->fetch_assoc();
                    echo "Senha: ".$ROW["id"]."<p>Código de acesso: ".$ROW["codAcess"]."<p>Status: ".status($ROW ["status"]);
                
                ?>

        </div>

        <button type="submit" value="nextNode">Chamar próximo</button>
        <button type="submit" value="onHold">Em espera</button>
        <button type="submit" value="theEnd">Encerrar acessos</button>
        

    </body>
</html>