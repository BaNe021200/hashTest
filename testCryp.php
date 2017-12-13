<?php
$hashMdp = password_hash($_POST['passWord'],PASSWORD_DEFAULT);

$pdo= new PDO('mysql:host=localhost;dbname=test','root','nzB69yCSBDz9eK46');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoStat = $pdo->prepare('INSERT INTO membres VALUES (NULL,:pseudo,:PassWord,:email,NOW())');
$pdoStat->bindValue(':pseudo', $_POST['pseudo'],PDO::PARAM_STR);
$pdoStat->bindValue(':PassWord', $hashMdp,PDO::PARAM_STR);
$pdoStat->bindValue(':email', $_POST['email'],PDO::PARAM_STR);
$hashed=$pdoStat->execute();

if($hashed){
    $message = "mot de passe enregistré";
}else{
    $message = "une erreur est survenue";
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testCRYPt</title>
</head>
<body>
<h1>insertion des mots de passe</h1>
<p><?= $message ?></p>

</body>
</html>
