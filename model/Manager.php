<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 04/12/2017
 * Time: 09:48
 */
namespace model;
use PDO;

class Manager
{
    public function dbConnect(){
        try
        {

        $databe = new \PDO('mysql:host=localhost;dbname=test', 'root','nzB69yCSBDz9eK46');
        $databe->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $databe;
        }
        catch (\PDOException $e){
            echo 'La connexion a échoué.<br />';

            echo 'Informations : [', $e->getCode(), '] ', $e->getMessage();
        }
    }
}