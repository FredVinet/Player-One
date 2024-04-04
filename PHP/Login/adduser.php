<?php                   
if(isset($_POST["submit-register"])){
    $emailregister = $_POST["Email"];
    $Userregister = $_POST["UserRegister"];
    $passwordregister = $_POST["PwdRegister"];
    $passwordrepeatregister = $_POST["PwdCheckRegister"];

    $errors = array();      

    if(empty($emailregister) OR empty($Userregister) OR empty($passwordregister) OR empty($passwordrepeatregister)){
        array_push($errors, "All fields are required" );
    }
    if(!filter_var($emailregister, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
    }
    if(strlen($passwordregister)<8){
        array_push($errors, "Password must be at least 8 characters long"); 
    }
    if($passwordregister != $passwordrepeatregister){
        array_push($errors, "Password does not match"); 
    }
    if(count($errors) > 0){
        
        $_SESSION['errors'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: index.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{
        require_once "./PHP/Login/DB_Conn.php";
        $passwordHash = password_hash($passwordregister, PASSWORD_DEFAULT);
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


        function sanitizeAndValidateEmail($email) {
            $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
                return false; // L'email n'est pas valide
            }
            return $sanitizedEmail; // L'email est valide
        }
        $sanitizedEmail = sanitizeAndValidateEmail($emailregister);
        if (!$sanitizedEmail) {
            array_push($errors, "Email is not valid");
        } else {
            // Préparation de la requête pour vérifier si l'email existe déjà
            $sqlCheck = "SELECT J_Email FROM t_joueur WHERE J_Email = ?";
            $stmt = $conn->prepare($sqlCheck);
            $stmt->bind_param("s", $sanitizedEmail);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                array_push($errors, "Email already exists.");
            } else {
                // L'email n'existe pas dans la base de données, procéder à l'insertion
                
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
        $conn->close();
    }
    // Afficher les erreurs ou rediriger l'utilisateur
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        // Assurez-vous d'avoir la logique côté client pour traiter ces erreurs
        header("Location: index.php"); // Ou une autre logique de gestion des erreurs
        exit();
    }
}
    
?>