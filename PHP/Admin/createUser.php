<?php                   
if(isset($_POST["submit-create"])){
    $idCreate = $_POST["idUser"];
    $emailCreate = $_POST["Email"];
    $userCreate = $_POST["UserRegister"];
    $passwordCreate = $_POST["PwdRegister"];
    $passwordrepeatCreate = $_POST["PwdCheckRegister"];
    $typeCreate = $_POST["TypeUser"];

    $errors = array();  

    if(empty($idCreate) OR empty($emailCreate) OR empty($userCreate) OR empty($passwordCreate) OR empty($passwordrepeatCreate) OR empty($typeCreate)){
        array_push($errors, "All fields are required" );
    }
    if(!is_numeric($idCreate)){
        array_push($errors, "Id is not a number");
    }
    if(!filter_var($emailCreate, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
    }
    if(strlen($passwordCreate)<8){
        array_push($errors, "Password must be at least 8 characters long"); 
    }
    if($passwordCreate != $passwordrepeatCreate){
        array_push($errors, "Password does not match"); 
    }
    if($typeCreate != 'User' OR $typeCreate != 'Admin'){
        array_push($errors, "Type must be User or Admin"); 
    }
    if(count($errors) > 0){
        
        $_SESSION['errors'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{
        require_once "../DBConnect/DB_Conn.php";

        // Check si l'ID existe déjà dans la base de données
        $sqlCheck = "SELECT J_Id FROM t_joueur WHERE J_Id = '$idCreate'";
        $result = $conn->query($sqlCheck);

        if ($result->num_rows > 0) {
            // Si l'Id existe déjà, message d'erreur
            array_push($errors, "Id already exist"); 
        }

        if($typeCreate == 'User'){
            $userImage = './Assets/CardUser.png';
        }elseif($typeCreate == 'Admin'){
            $userImage = './Assets/CarteAdmin.png';
        }


        function sanitizeAndValidateEmail($emailCreate) {
            $sanitizedEmail = filter_var($emailCreate, FILTER_SANITIZE_EMAIL);
            if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
                return false; // L'email n'est pas valide
            }
            return $sanitizedEmail; // L'email est valide
        }
        $sanitizedEmail = sanitizeAndValidateEmail($emailCreate);
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
        $_SESSION['errors'] = $errors;
        // Assurez-vous d'avoir la logique côté client pour traiter ces erreurs
        header("Location: ./Admin.php"); // Ou une autre logique de gestion des erreurs
        exit();
    }
}