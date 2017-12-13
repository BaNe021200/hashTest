<?php

$Mdp = $_POST['passWord'];
$login = $_POST['pseudo'];

$pdo= new PDO('mysql:host=localhost;dbname=test','root','nzB69yCSBDz9eK46');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdoStat=$pdo->prepare("SELECT id,pass  FROM membres WHERE pseudo = :pseudo " );
$pdoStat->bindValue(':pseudo', $login,PDO::PARAM_STR);

$hashedPass = $pdoStat->execute();

$hashedPass = $pdoStat->fetch();
//var_dump($hashedPass['pass']);die;
$verifyPass = $hashedPass['pass'];

if(password_verify($Mdp, $verifyPass)){
    session_start();
    $_SESSION['login']=$login;

    echo "bienvenue ". $_SESSION['login'];
}else
{
   echo 'mauvais identifiant ou mot de passe';

}


