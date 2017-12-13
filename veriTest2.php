<?php
require ('model/MonException.php');
require ('model/Manager.php');
//use PDO;
use model\Manager;

try {

    $Mdp = $_POST['passWord'];
    $login = $_POST['pseudo'];

    $bdd= new Manager();
    $pdo=$bdd->dbConnect();

//$pdo= new PDO('mysql:host=localhost;dbname=test','root','nzB69yCSBDz9eK46');

    $pdoStat=$pdo->prepare("SELECT id,pass  FROM membres WHERE pseudo = :pseudo " );
    $pdoStat->bindValue(':pseudo', $login,PDO::PARAM_STR);

    $hashedPass = $pdoStat->execute();

    $hashedPass = $pdoStat->fetch();
//var_dump($hashedPass['pass']);die;
    $verifyPass = $hashedPass['pass'];



if(password_verify($Mdp, $verifyPass)){
        session_start();
        $_SESSION['login']=$login;

        $message = $_SESSION['login'];
        require ('home.php');
    }else
    {
        throw new MonException ('mauvais identifiant ou mot de passe');

    }


 }
catch (MonException $e){

    $errorMessage=$e;
    require_once 'errorPage.php';
}












