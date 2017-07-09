<?php
    session_start();
    require_once("data/maria.php");
    $conn = new Conexion("users");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #echo count($_POST); #Funciona para ver cuantos campos trae el post
    #$nombres = array_keys($_POST); #Asigna los nombres de los campos en un array
    /*foreach ($_POST as $clave => $value) #Crea variables automaticamente de cada campo de post con su respectivo nombre
    {
        ${$clave}=$_POST[$clave];
    }*/
    if(isset($_POST["nick"]) && isset($_POST["passwd"]))
    {
        $sql = $conn->prepare("SELECT u.nick,u.passwd FROM usuario u where u.nick = :user and u.passwd = :password and u.nivel<=1");
        $sql->execute(array(':user'=>$_POST["nick"],':password'=>$_POST["passwd"]));
        $data = $sql->fetch();
        $sql = $conn->prepare("SELECT FOUND_ROWS()");
        $sql->execute();
        $filas =$sql->fetchColumn();
        if ($filas == "1")
        {
            $_SESSION["user"] = $data["nick"];
            echo "1";
        }
        else
        {
            echo "error no existes";
        }
    }
    else
    {
        echo "error no viene nada de afuera";
    }
?>