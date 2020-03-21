<?php
include "connectDB.php";
session_start ();
$connection = OpenCon ();

function redirecionar (){
    echo "NÃO FOI POSSÍVEL ALTERAR O STATUS, RETORNANDO A PÁGINA ANTERIOR
    <script>
        setTimeout(function() {
        window.location = 'dispatch_op.php';
        }, 3000);
    </script>"; 
    }


if (isset ($_GET["idAtendimento"]) && isset($_GET["idStatus"])){
    
    $idUsuario = isset ($_GET["idAtendimento"]) ? $_GET["idAtendimento"] : redirecionar() ;
    $idStatus = isset ($_GET["idStatus"]) ? $_GET["idStatus"] : redirecionar ();

    $sql = "UPDATE `dispatch_queue` SET `status` = '$idStatus' WHERE `dispatch_queue`.`codAcess` = ".$idUsuario; 
    $returnSql =$connection ->query($sql);
    if ($returnSql){
        echo "
    <script>
        setTimeout(function() {
        window.location = 'dispatch_op.php';
        }, 0);
    </script>"; 
    }
    
}
if ($_GET["idAtendimento"]=='resetqueue'){
        $sql = 'DELETE FROM `dispatch_queue`';
        $connection -> query($sql);
        $sql = 'ALTER TABLE `dispatch_queue` AUTO_INCREMENT = 0';
        $connection -> query ($sql);
        session_destroy ();
        echo "
        <script>
        setTimeout(function() {
        window.location = 'http://intranet.3bsup.eb.mil.br';
        }, 0);
    </script>";
        
    }
    else{
    redirecionar ();
}
?>