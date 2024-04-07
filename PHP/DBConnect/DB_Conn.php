<?php
    //Variables de connexion à la base de donnée
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'bddcassebrique';

    //Connexion à la base de données
    $conn = mysqli_connect($host, $user, $password, $dbname);
    
    //Sécurité
    if(!$conn){
        die ("Connection Failed");
    }
?>