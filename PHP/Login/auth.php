<?php
    session_start();
    
    //------------------------------------ 
    //  _____ _               _    
    // /  __ \ |             | |   
    // | /  \/ |__   ___  ___| | __
    // | |   | '_ \ / _ \/ __| |/ /
    // | \__/\ | | |  __/ (__|   < 
    //  \____/_| |_|\___|\___|_|\_\
    //------------------------------------  

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
        header("Location: index.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{
        require_once "./PHP/Login/DB_Conn.php";

        $sql = "SELECT * FROM t_joueur
                WHERE J_Username = '$Userlogin' AND J_Pwd='$passwordlogin'";

        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){

            $row = mysqli_fetch_assoc($result); 
            if($row['J_Username']===$Userlogin && $row['J_Pwd'] === $passwordlogin){

                $_SESSION['Image'] = $row['J_Image'];
                $_SESSION['Username'] = $row['J_Username'];
                $_SESSION['Id'] = $row['J_Id'];
                $_SESSION['UserType'] = $row['J_Type'];
                $_SESSION['Loggedin'] = $_SESSION['Username'];

                // Vérifiez si le type d'utilisateur n'est ni 'Admin' ni 'User'
                if($_SESSION['UserType'] != 'Admin' && $_SESSION['UserType'] != 'User') {
                    // Supprimez la variable de session 'UserType' car elle ne correspond à aucun rôle attendu
                    unset($_SESSION['UserType']);
                }else{
                    if($_SESSION['UserType'] == 'Admin'){
                        $_SESSION["Admin"] = true;
                    }else{
                        $_SESSION["User"] = true;
                    }
                }
                
                header("Location: ./index.php");

                exit();
            } 
        }else {
            array_push($errors, "UserName or Password doesn't exist.");
        }
    }
    if(count($errors)>0){
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
    }
}

?>