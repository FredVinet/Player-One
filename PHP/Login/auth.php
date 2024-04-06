<?php
session_start();
if(isset($_POST["submit"])){


    $Userlogin = $_POST["Username"];
    $passwordlogin = $_POST["Password"];
    

    $errors = array();

    if(empty($Userlogin) OR empty($passwordlogin)){
        array_push($errors, "All fields are required");
    }
    if(isset($_POST['Username']) && isset($_POST['Password'])){

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
    $Userlogin = validate($_POST['Username']);
    $passwordlogin = validate($_POST['Password']);

    //------------------------------------
    // ____________   _____ _               _    
    // |  _  \ ___ \ /  __ \ |             | |   
    // | | | | |_/ / | /  \/ |__   ___  ___| | __
    // | | | | ___ \ | |   | '_ \ / _ \/ __| |/ /
    // | |/ /| |_/ / | \__/\ | | |  __/ (__|   < 
    // |___/ \____/   \____/_| |_|\___|\___|_|\_\
    //------------------------------------
    if(count($errors) > 0){
        
        $_SESSION['errors'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: ./index.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{
        require_once "./PHP/DBConnect/DB_Conn.php";

        $sql = "SELECT * FROM t_joueur WHERE J_Username = ? AND J_Pwd = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $Userlogin, $passwordlogin);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 1){

            $row = $result->fetch_assoc();

            if($row['J_Username'] === $Userlogin && $row['J_Pwd'] === $passwordlogin){

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

                    if($_SESSION['UserType'] == 'Admin'){
                        $_SESSION["Admin"] = true;
                    } else {
                        $_SESSION["User"] = true;
                    }
                    
                }
                header("Location: ./index.php");
                exit();
            } 
        } else {
            array_push($errors, "UserName or Password doesn't exist.");
        }
        }
        if(count($errors)>0){
            foreach($errors as $error){
                echo"<div class='alert alert-danger'>$error</div>";
            }
    }
}