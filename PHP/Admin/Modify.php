<?php                   
if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){
    $idModify = $_POST["idUserChange"];
    $emailModify = $_POST["EmailChange"];
    $userModify = $_POST["UserRegisterChange"];
    $passwordModify = $_POST["PwdRegisterChange"];
    $passwordrepeatModify = $_POST["PwdCheckRegisterChange"];
    $typeModify = $_POST["TypeUserChange"];
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        die("Invalid ID");
    }

    $errors = array();  

    if(empty($idModify) OR empty($emailModify) OR empty($userModify) OR empty($passwordModify) OR empty($passwordrepeatModify) OR empty($typeModify)){
        array_push($errors, "All fields are required" );
    }
    if(!is_numeric($idModify)){
        array_push($errors, "Id is not a number");
    }
    if(!filter_var($emailModify, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
    }
    if(strlen($passwordModify)<8){
        array_push($errors, "Password must be at least 8 characters long"); 
    }
    if($passwordModify != $passwordrepeatModify){
        array_push($errors, "Password does not match"); 
    }
    if($typeModify != "User" && $typeModify != "Admin"){
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

        

        if($typeModify == 'User'){
            $userImage = './Assets/CardUser.png';
        }elseif($typeModify == 'Admin'){
            $userImage = './Assets/CarteAdmin.png';
        }


        function sanitizeAndValidateEmail($emailModify) {
            $sanitizedEmail = filter_var($emailModify, FILTER_SANITIZE_EMAIL);
            if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
                return false; // L'email n'est pas valide
            }
            return $sanitizedEmail; // L'email est valide
        }
        $sanitizedEmail = sanitizeAndValidateEmail($emailModify);
        if (!$sanitizedEmail) {
            array_push($errors, "Email is not valid");
        } else {

            // Préparation de la requête pour vérifier si l'Id existe déjà
            $sqlCheckid = "SELECT J_Id FROM t_joueur WHERE J_Id = ?";
            $stmt = $conn->prepare($sqlCheckid);
            $stmt->bind_param("s", $idModify);
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
            $stmt->bind_param("s", $userModify);
            $stmt->execute();
            $resultuser = $stmt->get_result();

            if($resultuser->num_rows > 0) {

                // Si le Username existe déjà, message d'erreur
                array_push($errors, "Username already exists.");

            }
            
            if(count($errors) > 0){
                array_push($errors, "Something went wrong.");
            } else {
                require_once "../DBConnect/DB_Conn.php";
                // Préparez la requête SQL UPDATE pour mettre à jour les enregistrements dans la base de données
                $sqlUpdate = "UPDATE t_joueur SET J_id = ?, J_Email=?, J_Username=?, J_Pwd=?, J_Type=? J_Image=? WHERE J_Id=?";
                $stmt = $conn->prepare($sqlUpdate);
                $stmt->bind_param("issssss",$idModify, $emailModify, $userModify, $passwordModify, $typeModify, $userImage ,$id);
        
                // Exécutez la requête SQL UPDATE
                if($stmt->execute()){
                    // La mise à jour a réussi
                    array_push($errors, "Record updated successfully.");
                } else {
                    // La mise à jour a échoué
                    array_push($errors, "Error updating record.");
                }
            $stmt->close();
            header("Location: ./Admin.php");
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
}