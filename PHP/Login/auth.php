<?php
session_start();
function validate($data){
    $data = trim($data); //Supprime les espaces en début et fin de chaîne de caractères 
    $data = stripslashes($data); //Supprime les barres obliques inverses (backslashes) de la chaîne de caractères.
    $data = htmlspecialchars($data); //Convertit les caractères spéciaux en entités HTML
    return $data; //Retourne la variables $data
}
if(isset($_POST["submit"])){

    //Mise en place des variables avec les Name dans le formulaire html
    $Userlogin = $_POST["Username"];
    $passwordlogin = $_POST["Password"];
    
    //Mise en place de la variables errors en tableau
    $errors = array();

    // Message d'erreur si le champ Username ou Password est vide 
    if(empty($Userlogin) OR empty($passwordlogin)){
        array_push($errors, "All fields are required");
    }
    // Si Username et Password sont remplies rentre dans cette fonction
    if(isset($_POST['Username']) && isset($_POST['Password'])){

        //Validation des variables de Username et Password
        $Userlogin = validate($_POST['Username']); 
        $passwordlogin = validate($_POST['Password']);

    }

    //Si il y a une erreurs renvoie le message d'erreur qui ouvre une modal
    if(count($errors) > 0){
        
        $_SESSION['errors'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: ./Index.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    
    }else{ //S'il n'y a pas d'erreur ouvre la base de données
        require_once "./PHP/DBConnect/DB_Conn.php";

        //Selection de toutes la ligne ou J_Username et J_Pwd sont égal à $Userlogin et $passwordlogin
        $sql = "SELECT * FROM t_joueur WHERE J_Username = ? AND J_Pwd = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $Userlogin, $passwordlogin);
        $stmt->execute();
        $result = $stmt->get_result();
        
        //S'il y a un résultat rentre dans le if 
        if($result->num_rows === 1){

            //Extrait chaque ligne sous form de tableau où les clés sont les noms des colonnes de la table et les valeurs sont les valeurs correspondantes pour cette ligne.
            $row = $result->fetch_assoc();

            //Recheck si dans la ligne J_Username = $Userlogin et J_Pwd = $passwordlogin
            if($row['J_Username'] === $Userlogin && $row['J_Pwd'] === $passwordlogin){

                //Ajout des variables de sessions, l'utilisateur est connecter
                $_SESSION['Image'] = $row['J_Image'];
                $_SESSION['Username'] = $row['J_Username'];
                $_SESSION['Id'] = $row['J_Id'];
                $_SESSION['UserType'] = $row['J_Type'];
                $_SESSION['Loggedin'] = $_SESSION['Username'];

                // Vérifie si le type d'utilisateur n'est ni 'Admin' ni 'User'
                if($_SESSION['UserType'] != 'Admin' && $_SESSION['UserType'] != 'User') {
                    // Supprime la variable de session 'UserType' car elle correspond à aucun rôle attendu
                    unset($_SESSION['UserType']);
                } else {

                    //Check si UserType est un Admin ou un User
                    if($_SESSION['UserType'] == 'Admin'){
                        $_SESSION["Admin"] = true;
                    } else {
                        $_SESSION["User"] = true;
                    }
                    
                }
                //Redirection vers la page d'accueil
                header("Location: ./Index.php");
                exit();
            } 
        } else {
            array_push($errors, "UserName or Password doesn't exist.");
        }
        }
        //Si il y a une erreurs renvoie le message d'erreur qui ouvre une modal
        if(count($errors)>0){
            $_SESSION['errors'] = $errors;
            foreach($errors as $error){
                echo"<div class='alert alert-danger'>$error</div>";
            }
            header("Location: ./Index.php"); // Redirection vers la même page pour afficher la modal d'erreur
            exit();
    }
}