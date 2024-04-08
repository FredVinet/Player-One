<?php  
session_start();
//Si l'utilisateur n'est pas Admin renvoie sur la page d'accueil
if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {
    header("Location: ../../index.php");
    exit();
}elseif(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true && isset($_GET['idchange']) && isset($_GET['userNameChange']) && isset($_GET['passwordChange'])){
    //Mise en place de la variables qui récupère l'id de l'utilisateur que l'admin veut changer par l'url
    

    //Si le bouton envoie submit-change rentre dans ce if  
    if(isset($_POST['submit-change'])) {
        

        //Mise en place des variables qui reprennent tout les champs rentrer dans le formulaire
        $userModify = $_POST["UserRegisterChange"];
        $typeModify = $_POST["TypeUserChange"];
        $userId  = $_GET['idchange'];
        $userName  = $_GET['userNameChange'];
        $password = $_GET['passwordChange'];
        $passwordModify = $_POST["PwdRegisterChange"];
        $passwordrepeatModify = $_POST["PwdCheckRegisterChange"];
        //Mise en place de la variables errors en tableau
        $errors = array(); 

        // Si le champ de changement de username est vide garde l'ancien username 
        if(empty($userModify)){
            $userModify = $userName;
        }
        // Check si les 2 passwords sont vide et s'ils sont vide garde l'ancien mot de passe 
        if(empty($passwordModify) && empty($passwordrepeatModify)){
            $passwordModify = $password;
            $passwordrepeatModify = $password;
        }
        //Check si le password est de plus de 8 charactères/string et si les mot de passe ne sont pas vides
        if(!empty($passwordModify) && !empty($passwordrepeatModifystrlen) && ($passwordModify)<8 && strlen($passwordrepeatModify)<8){
            array_push($errors, "Password must be at least 8 characters long"); 
        }
        //Check si le Password et Password check sont bien les mêmes
        if($passwordModify != $passwordrepeatModify){
            array_push($errors, "Password does not match"); 
        }
        //Varie les messages d'erreur si le password ou le repeat est vide
        if(empty($passwordModify) && !empty($passwordrepeatModify)){
            array_push($errors, "Your password is empty"); 
        }
        if(!empty($passwordModify) && empty($passwordrepeatModify)){
            array_push($errors, "You need to repeat the password"); 
        }
        //Check si les charactères sont bien 'User' ou 'Admin'
        if($typeModify != "User" && $typeModify != "Admin"){
            array_push($errors, "Type must be User or Admin"); 
        }
        //Mise en place de la variables pour la modification des images 
        if($typeModify == 'User'){
            $userImage = './Assets/CardUser.png';
        }elseif($typeModify == 'Admin'){
            $userImage = './Assets/CarteAdmin.png';
        }
        //Si il y a une erreurs renvoie le message d'erreur qui ouvre une modal
        if(count($errors) > 0){
            
            $_SESSION['errorschange'] = $errors;
            foreach($errors as $error){
                echo"<div class='alert alert-danger'>$error</div>";
            }
            header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
            exit();
        }else{//S'il n'y a pas d'erreur ouvre la base de données
            require_once "../DBConnect/DB_Conn.php";

            // Préparation de la requête pour vérifier si le Username existe déjà
            $sqlCheckUser = "SELECT J_Username FROM t_joueur WHERE J_Username = ?";
            $stmt = $conn->prepare($sqlCheckUser);
            $stmt->bind_param("s", $userModify);
            $stmt->execute();
            $resultuser = $stmt->get_result();

            if($resultuser->num_rows > 0 && $userModify != $userName) {

                // Si le Username existe déjà, message d'erreur
                array_push($errors, "Username already exists.");

            }
            
            //S'il y a une erreur renvoie l'erreur
            if(count($errors) > 0){

                $_SESSION['errorschange'] = $errors;
                foreach($errors as $error){
                    echo"<div class='alert alert-danger'>$error</div>";
                }
                header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
                exit();

            } else {//S'il y a pas d'erreur modifie la ligne concernée

                require_once "../DBConnect/DB_Conn.php";
                // Prépare la requête SQL UPDATE pour mettre à jour les enregistrements dans la base de données
                $sqlUpdate = "UPDATE t_joueur SET J_Username=?, J_Pwd=?, J_Type=?, J_Image=? WHERE J_Id=?";
                $stmt = $conn->prepare($sqlUpdate);
                $stmt->bind_param("sssss", $userModify, $passwordModify, $typeModify, $userImage ,$userId);
                $stmt->execute();
                
                // Exécutez la requête SQL UPDATE
                if($stmt->execute()){
                    // La mise à jour a réussi
                    array_push($errors, "User modified successfully.");
                } else {
                    // La mise à jour a échoué
                    array_push($errors, "Error modifying User.");
                }
                //Ferme la connection à la base de données
                $stmt->close();
            }
        }
        //S'il y a une erreur renvoie l'erreur
        if (count($errors) > 0) {
            $_SESSION['errorschange'] = $errors;
            header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
            exit();
        }
    }
}
