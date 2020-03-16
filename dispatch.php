<html>
    <head>
        <meta charset="utf-8">
        <title>Dispatch</title>
    </head>
    <body>
    <?php
        include "connectDB.php";
        $codAcess = isset ($_POST["codAcess"]) ? $_POST["codAcess"] : FALSE;
        $description = isset ($_POST["description"]) ? $_POST["description"] : FALSE;
        $tamCodAcess = strlen($codAcess);

        $connection = OpenCon();
        if ($tamCodAcess == 16)
        {    
            if (OpenCon()){
                // PRIMEIRO VERIFICAR SE O CÓDIGO DE ACESSO EXISTE
                // $query = mysql_query("SELECT * FROM dispatch_data") or die (mysql_error());

                $query = "SELECT codAcess 
                FROM dispatch_data
                WHERE codAcess =$codAcess";

                $returnSQL = $connection->query($query) or die ("CÓDIGO DE ACESSO NÃO ENCONTRADO");
                $totalRow = mysqli_num_rows ($returnSQL);

                if ($totalRow == 1){
                    $query = "SELECT codAcess
                    FROM dispatch_queue
                    WHERE codAcess = $codAcess";

                    $returnSql = $connection->query($query);
                    $totalRow = mysqli_num_rows ($returnSQL);
                    
                    if ($totalRow != 0)
                    {
                        mysqli_autocommit($connection, FALSE);

                        mysqli_query ($connection, "INSERT INTO `dispatch_queue` (`id`, `codAcess`, `description`) 
                        VALUES (NULL, '$codAcess', '$description')");

                        if ($connection-> commit()){
                            echo "
                            <H2> DADOS SALVOS COM SUCESSO, REDIRECIONANDO... </H2>
                                <script>
                                    setTimeout(function() {
                                        window.location = 'dispatch_queue.php';
                                    }, 3000);
                                </script>
                            ";
                            CloseCon ($connection);
                        }
                        else {
                            CloseCon ($connection);
                            echo "
                            <H2> NÃO FOI POSSÍVEL SALVAR OS DADOS </H2>
                                <script>
                                    setTimeout(function() {
                                        window.location = 'dispatch.html';
                                    }, 2000);
                                </script>
                            ";
                        }
                    }    
                    else {
                        CloseCon ($connection);
                        echo "TICKET JÁ ABERTO, DESEJA APAGAR O TICKET? REDIRECIONANDO PARA A PÁGINA ANTERIOR";
                    }
                }

                // CONCATENAR AS DUAS TABELAS
                // FAZER O INSERT NO DISPATCH_QUEUE DA NOVA ENTRADA
            }

            else {
                CloseCon ($connection);
                echo "FALHA AO CONECTAR NO BANCO DE DADOS, VOCÊ SERÁ REDIRECIONADO A PÁGINA ANTERIOR CONTATE O ADMINISTRADOR";
            }
        }

        else {
            CloseCon ($connection);
            echo "
            <H2> CÓDIGO DE ACESSO INVÁLIDO, REDIRECIONANDO... </H2>
                <script>
                    setTimeout(function() {
                        window.location = 'dispatch.html';
                    }, 3000);
                </script>
            ";
        }

    ?>
    </body>
</html>