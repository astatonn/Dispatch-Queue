<!--https://stackoverflow.com/questions/40559551/how-to-retrieve-row-from-a-html-table-on-mouse-click-in-php-->
<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        
    </head>
    <body>
    <?php 
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['codAcess']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:dispatch.html');
    }
  ?>
    <table>
        <tr>
            <th>
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
                                echo "<tr><td>" .$row["id"]."</td><td>".$row["description"]."</td><td>". PG($row["PG"])."</td><td>".$row["NOME"]."</td><td>".FUNCAO($row["FUNCAO"])."</td><td>".status($row["status"]).
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
                                echo "<tr><td>" .$row["id"]."</td><td>".$row["description"]."</td><td>". PG($row["PG"])."</td><td>".$row["NOME"]."</td><td>".FUNCAO($row["FUNCAO"])."</td><td>".status($row["status"]).
                                '</td><td><div class="btn-off">Chamar</div></td>
                                <td><div class="btn-off">Atendendo</div></td>
                                <td><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            break;
                            case 3:
                                $sql = "DELETE FROM `dispatch_queue` WHERE `dispatch_queue`.`codAcess` =".$row["codAcess"];
                                $connection ->query($sql);
                            break;



                            }
                        }
                    echo "</table>";
                }
                else {
                    echo "SEM FILA!";
                }
            ?>
        </tbody>
    </table>
        <button type="submit" value="refresh" onclick="window.location.reload(true);">Atualizar Fila</button>   
       <?php echo '<a href="action.php?idAtendimento=resetqueue" class="btn">Encerrar Acessos</a>' ?>  
            

    </body>
</html>