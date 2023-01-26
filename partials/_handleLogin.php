<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $existSQL = "Select * from users where user_email = '$email'";
    $result = mysqli_query($conn, $existSQL);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['user_password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            header("location: /forums/index.php");
            exit();
        }
        else{
            header("location: /forums/index.php");
        }
    }
    else{
        header("location: /forums/index.php");
    }
}

?>