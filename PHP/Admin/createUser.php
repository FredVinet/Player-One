<?php 

if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {
    //Si l'utilisateur n'est pas Admin retourne vers la page d'accueil
    header("Location: ../../index.php");
    exit();
}elseif(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true && isset($_POST["submit-create"])){

    //Mise en place des Variables par rapport au champs remplies dans le formulaires
    $idCreate = $_POST["idUser"];
    $emailCreate = $_POST["Email"];
    $userCreate = $_POST["UserRegister"];
    $passwordCreate = $_POST["PwdRegister"];
    $passwordrepeatCreate = $_POST["PwdCheckRegister"];
    $typeCreate = $_POST["TypeUser"];

    //Mise en place de la variables errors en tableau
    $errors = array();  

    // Message d'erreur si les champs sont vide 
    if(empty($idCreate) OR empty($emailCreate) OR empty($userCreate) OR empty($passwordCreate) OR empty($passwordrepeatCreate) OR empty($typeCreate)){
        array_push($errors, "All fields are required" );
    }
    //Vérifie si l'id est un nombre
    if(!is_numeric($idCreate)){
        array_push($errors, "Id is not a number");
    }
    //Filtre l'email
    if(!filter_var($emailCreate, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
    }
    //Check si le password est de plus de 8 charactères/string
    if(strlen($passwordCreate)<8){
        array_push($errors, "Password must be at least 8 characters long"); 
    }
    //Check si le Password et Password check sont bien les mêmes
    if($passwordCreate != $passwordrepeatCreate){
        array_push($errors, "Password does not match"); 
    }
    //Check si les charactères sont bien 'User' ou 'Admin
    if($typeCreate != "User" && $typeCreate != "Admin"){
        array_push($errors, "Type must be User or Admin"); 
    }
    //Si il y a une erreurs renvoie le message d'erreur qui ouvre une modal
    if(count($errors) > 0){
        
        $_SESSION['errorsAdd'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{ //S'il n'y a pas d'erreur ouvre la base de données
        require_once "../DBConnect/DB_Conn.php";

        
        //Si le type que l'admin rentre est User ou Admin change la photo de l'utilisateur par rapport au choix 
        if($typeCreate == 'User'){
            $userImage = './Assets/CardUser.png';
        }elseif($typeCreate == 'Admin'){
            $userImage = './Assets/CarteAdmin.png';
        }

        //Fonction pour filtrer l'email
        function sanitizeAndValidateEmail($emailCreate) {
            $sanitizedEmail = filter_var($emailCreate, FILTER_SANITIZE_EMAIL);
            if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
                return false; // L'email n'est pas valide
            }
            return $sanitizedEmail; // L'email est valide
        }
        //Refiltre l'email
        $sanitizedEmail = sanitizeAndValidateEmail($emailCreate);

        //Si l'email n'est pas bon message d'erreur
        if (!$sanitizedEmail) {
            array_push($errors, "Email is not valid");
        } else {//S'il n'y a pas d'erreur ouvre la base de données

            // Préparation de la requête pour vérifier si l'Id existe déjà
            $sqlCheckid = "SELECT J_Id FROM t_joueur WHERE J_Id = ?";
            $stmt = $conn->prepare($sqlCheckid);
            $stmt->bind_param("s", $idCreate);
            $stmt->execute();
            $resultid = $stmt->get_result();

            if ($resultid->num_rows > 0) {

                // Si l'Id existe déjà, message d'erreur
                array_push($errors, "Id already exist"); 

            }
            
            // Préparation de la requête pour vérifier si l'email existe déjà
            $sqlCheckmail = "SELECT J_Email FROM t_joueur WHERE J_Email = ?";
            $stmt = $conn->prepare($sqlCheckmail);
            $stmt->bind_param("s", $sanitizedEmail);
            $stmt->execute();
            $resultmail = $stmt->get_result();

            if ($resultmail->num_rows > 0) {

                // Si l'Email existe déjà, message d'erreur
                array_push($errors, "Email already exists.");

            }

            // Préparation de la requête pour vérifier si le Username existe déjà
            $sqlCheckUser = "SELECT J_Username FROM t_joueur WHERE J_Username = ?";
            $stmt = $conn->prepare($sqlCheckUser);
            $stmt->bind_param("s", $userCreate);
            $stmt->execute();
            $resultuser = $stmt->get_result();

            if($resultuser->num_rows > 0) {

                // Si le Username existe déjà, message d'erreur
                array_push($errors, "Username already exists.");

            }
            
            if(count($errors) > 0) {
                $_SESSION['errorsAdd'] = $errors;
                foreach($errors as $error){
                    echo"<div class='alert alert-danger'>$error</div>";
                }
                header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
                exit();
            }else{// Rien n'existe pas dans la base de données, procéder à l'insertion
                
                //Insertion dans la base de données
                $sql = "INSERT INTO t_joueur (J_Id, J_Username, J_Email, J_Pwd, J_Image, J_Type) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                if($preparestmt){
                    mysqli_stmt_bind_param($stmt, "ssssss", $idCreate, $userCreate, $emailCreate, $passwordCreate, $userImage,$typeCreate);
                    mysqli_stmt_execute($stmt);
                }else{
                    array_push($errors, "Something went wrong"); 
                }

            }
            $stmt->close();
        }
    }
    // Afficher les erreurs ou rediriger l'utilisateur
    if (count($errors) > 0) {
        $_SESSION['errorsAdd'] = $errors;
        // Assurez-vous d'avoir la logique côté client pour traiter ces erreurs
        header("Location: ./Admin.php"); // Ou une autre logique de gestion des erreurs
        exit();
    }
}