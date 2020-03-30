<!--https://stackoverflow.com/questions/40559551/how-to-retrieve-row-from-a-html-table-on-mouse-click-in-php-->
<html>
    <head>
        <meta charset="utf-8">
        <title>Fila Despacho</title>
        <link rel="stylesheet" type="text/css" href="dispatch_op.css">
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script>
           setTimeout(function(){
            window.location.reload(1);
            }, 10000);
        </script>
    </head>
    <body>
    <?php 
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['codAcess']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:restrict_acess.php');
    }
  ?>
  <div class="top-head">
        <img src="img/acanto.png"></img>
        <nav>GERENCIAMENTO DA FILA</nav>
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
    <div class="page-location">
    <button type="submit" class="myButton" value="refresh" onclick="window.location.reload(true);">Atualizar Fila</button>   
    <?php echo '<a href="action.php?idAtendimento=resetqueue" class="myButton">Encerrar Acessos</a>' ?>  
    </div>
    <div class="table-position">
    <table class="table-fill">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">DESCRIÇÃO</th>
                <th class="text-left">P/G</th>
                <th class="text-left">NOME</th>
                <th class="text-left">FUNÇÃO</th>
                <th class="text-left">STATUS</th>
                <th colspan="3" class="text-left">FUNÇÕES</th>
            </tr>
        </thead>
        <tbody class="table-hover">
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
                                echo '<tr><td class="text-left">' .$row["id"].'</td><td class="text-left">'.$row["description"].'</td><td class="text-left">'. PG($row["PG"]).'</td><td class="text-left">'.$row["NOME"].'</td><td class="text-left">'.FUNCAO($row["FUNCAO"]).'</td><td class="text-left">'.status($row["status"]).
                                '</td><td class="text-left"><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=1" class="btn">Chamar</a></td>
                                <td class="text-left"><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=2" class="btn">Atendendo</a></td>
                                <td class="text-left"><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            break;
                            case 1:
                                echo '<tr><td class="text-left">' .$row["id"].'</td><td class="text-left">'.$row["description"].'</td><td class="text-left">'. PG($row["PG"]).'</td><td class="text-left">'.$row["NOME"].'</td><td class="text-left">'.FUNCAO($row["FUNCAO"]).'</td><td class="text-left">'.status($row["status"]).
                                '</td><td class="text-left-btn-off">Chamar</td>
                                <td class="text-left"><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=2" class="btn">Atendendo</a></td>
                                <td class="text-left"><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            break;
                            case 2:
                                echo '<tr><td class="text-left">' .$row["id"].'</td><td class="text-left">'.$row["description"].'</td><td class="text-left">'. PG($row["PG"]).'</td><td class="text-left">'.$row["NOME"].'</td><td class="text-left">'.FUNCAO($row["FUNCAO"]).'</td><td class="text-left">'.status($row["status"]).
                                '</td><td class="text-left-btn-off">Chamar</td>
                                <td class="text-left-btn-off">Atendendo</td>
                                <td class="text-left"><a href="action.php?idAtendimento='.$row["codAcess"].'&idStatus=3" class="btn">Finalizar</a></td></tr>';
                            break;
                            case 3:
                                $sql = "DELETE FROM `dispatch_queue` WHERE `dispatch_queue`.`codAcess` =".$row["codAcess"];
                                $connection ->query($sql);
                            break;



                            }
                        }
                }
                else {
                    echo "SEM FILA!";
                }
            ?>
        </tbody>
    </table>
            
        
       </div>  

    </body>
</html>