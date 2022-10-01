<?php

require ('db_connect.php');

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$sql = "SELECT loginame, password, role FROM users WHERE loginame like '%".$user_email."%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row["password"] == $user_password){
            $_SESSION["login"] = true;
            if($row["role"] == true){
                $_SESSION["tutor"] = true;
            }else{
                $_SESSION["tutor"] = false;
            }
            header("Location: ./index.php");
            exit();
        } else {
            header("Location: ./login.php?error=wrongpwd");
            exit();
        }
    }
} else {
    header("Location: ./login.php?error=nouser");
    exit();
}
$conn->close();

?>