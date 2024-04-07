<?php                   
if(isset($_POST["submit-register"])){

    //Mise en place des variables avec les Name dans le formulaire html
    $emailregister = $_POST["Email"];
    $Userregister = $_POST["UserRegister"];
    $passwordregister = $_POST["PwdRegister"];
    $passwordrepeatregister = $_POST["PwdCheckRegister"];

    //Mise en place de la variables errors en tableau
    $errors = array();      

    // Message d'erreur si les champs sont vide 
    if(empty($emailregister) OR empty($Userregister) OR empty($passwordregister) OR empty($passwordrepeatregister)){
        array_push($errors, "All fields are required" );
    }
    //Filtre l'email
    if(!filter_var($emailregister, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
    }
    //Check si le password est de plus de 8 charactères/string
    if(strlen($passwordregister)<8){
        array_push($errors, "Password must be at least 8 characters long"); 
    }
    //Check si le Password et Password check sont bien les mêmes
    if($passwordregister != $passwordrepeatregister){
        array_push($errors, "Password does not match"); 
    }
    //Si il y a une erreurs renvoie le message d'erreur qui ouvre une modal
    if(count($errors) > 0){
        
        $_SESSION['errors'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: ../Home/index.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{ //S'il n'y a pas d'erreur ouvre la base de données
        require_once "../DBConnect/DB_Conn.php";

        // Fonction pour génèrer un random ID 
        function generateRandomId() {
            return rand(1, 999999);
        }

        // Génère un random ID
        $randomId = generateRandomId();

        // Check si l'ID existe déjà dans la base de données
        $sqlCheck = "SELECT J_Id FROM t_joueur WHERE J_id = '$randomId'";
        $result = $conn->query($sqlCheck);

        if ($result->num_rows > 0) {
            // Si l'Id existe déjà, génère une nouvelle
            $randomId = generateRandomId();
        }

        //Fonction pour filtrer l'email
        function sanitizeAndValidateEmail($email) {
            $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
                return false; // L'email n'est pas valide
            }
            return $sanitizedEmail; // L'email est valide
        }
        //Filtre l'email via la variables
        $sanitizedEmail = sanitizeAndValidateEmail($emailregister);
        //Si l'email n'est pas valide retourne une erreur
        if (!$sanitizedEmail) {
            array_push($errors, "Email is not valid");
        } else { //Si pas d'erreur rentre dans la base de données

            // Préparation de la requête pour vérifier si l'email existe déjà
            $sqlCheckMail = "SELECT J_Email FROM t_joueur WHERE J_Email = ?";
            $stmt = $conn->prepare($sqlCheckMail);
            $stmt->bind_param("s", $sanitizedEmail);
            $stmt->execute();
            $resultmail = $stmt->get_result();

            // Préparation de la requête pour vérifier si le username existe déjà
            $sqlCheckUser = "SELECT J_Username FROM t_joueur WHERE J_Username = ?";
            $stmt = $conn->prepare($sqlCheckUser);
            $stmt->bind_param("s", $Userregister);
            $stmt->execute();
            $resultuser = $stmt->get_result();
            
            //Si l'email existe déjà retourne une erreur
            if ($resultmail->num_rows > 0) {
                array_push($errors, "Email already exists.");
            } 
            //Si l'email existe déjà retourne une erreur
            if($resultuser->num_rows > 0) {
                array_push($errors, "Username already exists.");
            }
            //Si une erreur renvoie les erreurs
            if(count($errors) > 0){
                $_SESSION['errors'] = $errors;
                foreach($errors as $error){
                    echo"<div class='alert alert-danger'>$error</div>";
                }
                header("Location: ../Home/index.php"); // Redirection vers la même page pour afficher la modal d'erreur
                exit();
            }else { // Si pas d'erreur ajoute l'utilisateur dans la base de données
                
                //Ajoute dans les colonnes une nouvelles ligne
                $sql = "INSERT INTO t_joueur (J_Id, J_Email, J_Pwd, J_Username) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                if($preparestmt){
                    mysqli_stmt_bind_param($stmt, "ssss", $randomId, $emailregister, $passwordregister, $Userregister);
                    mysqli_stmt_execute($stmt);
                }else{
                    array_push($errors, "Something went wrong"); 
                }
                }
            $stmt->close();
        }
    }
    //Si une erreur renvoie les erreurs
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        
        header("Location: ../Home/index.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }
}