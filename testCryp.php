<?php
require ('model/MonException.php');
require ('model/Manager.php');
use model\Manager;

try{
    if(!empty($_POST['passWord'])) {
        $login = $_POST['pseudo'];
        $hashMdp = password_hash($_POST['passWord'], PASSWORD_DEFAULT);

        $bdd= new Manager();
        $pdo=$bdd->dbConnect();
        $reqLogin=$pdo->query("SELECT id FROM membres WHERE pseudo = '$login' ");
        $result=$reqLogin->execute();
        $result=$reqLogin->fetch();
        $final= $result['id'];
       // var_dump($final);die;


        if($final===null) {

            $pdoStat = $pdo->prepare('INSERT INTO membres VALUES (NULL,:pseudo,:PassWord,:email,NOW())');
            $pdoStat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $pdoStat->bindValue(':PassWord', $hashMdp, PDO::PARAM_STR);
            $pdoStat->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $hashed = $pdoStat->execute();


            if ($hashed) {
                header('Location:verifForm.php');
            } else {
                throw new PDOException('une erreur est survenue');
            }


        }
        else{
            throw new Exception("Le login ".$login." existe déjà !");
        }
    }else{
        throw new MonException('Le champs passWord ne peut être vide');
    }

}
catch (MonException $e){
    $errorMessage= $e;
    require_once 'errorPage.php';
}
catch (Exception $e){

    $errorMessage=$e;
  $errorMessage=  $e->getMessage();
    require_once 'errorPage.php';
}

