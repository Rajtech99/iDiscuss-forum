<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    $existSQL = "Select * from `users` where user_email = '$email'";
    $result = mysqli_query($conn, $existSQL);
    $numRows = mysqli_num_rows($result);
    $showError = false;
    if($numRows>0){
        $showError = 'Email already in use';
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `date`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                header("location: /forums/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password do not match";
        }
    }
    header("location: /forums/index.php?signupsuccess=false&error=$showError");

}

?>