<?php
    include "connectDB.php";
    session_start ();
    $connection = OpenCon ();

    $login = $_POST["login"];
    $codAcess = $_POST["codAcess"];

    if ($login == "ordenanca" && $codAcess == "5159742757346462")
    {
        $_SESSION ['login'] = $login;
        $_SESSION ['codAcess'] = $codAcess;
        echo "entrou";
        echo "<script>
            setTimeout(function() {
                window.location = 'dispatch_op.php';
            }, 0000);
        </script>";

    }
    else{
        unset($_SESSION["login"]);
        unset ($_SESSION["codAcess"]);

        echo "<script>
            setTimeout(function() {
                window.location = 'dispatch.html';
            }, 0);
        </script>";
        
    }


?>