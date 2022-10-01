<?php

require ('db_connect.php');

if(!$_SESSION["login"]){
    header("Location: ./login.php?error=nologin");
    exit();
}
if(!$_SESSION["tutor"]){
    header("Location: ./login.php?error=nologin");
    exit();
}

$homework_id = $_GET['homework'];

if(isset($_POST['submit_button'])){ 

    $sql = "SELECT task_directory FROM homework WHERE id = $homework_id";
    $result = $conn->query($sql);
    $row = $result -> fetch_assoc();
    $previous_file = $row["task_directory"];

    $sql = "DELETE FROM homework WHERE id = $homework_id";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM homework;";         //Έλεγχος για το εάν υπάρχει και αλλού το αρχείο που αλλάξαμε ώστε να μη διαγραφεί από το φάκελο
    $result = $conn->query($sql);

    $useless_file = true;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { 
            if($row['task_directory'] == $previous_file){
                $useless_file = false;
            }
        }
    }     

    if($useless_file){
        unlink($previous_file);
    }
    
    $sql = "SET @num := 0;";
    $result = $conn->query($sql);

    $sql = "UPDATE homework SET id = @num := (@num+1);";
    $result = $conn->query($sql);

    $sql = "ALTER TABLE homework AUTO_INCREMENT = 1;";
    $result = $conn->query($sql);      

    header("Location: ./homework.php?homework_deleted");

    $conn->close();
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Διαγραφή εργασίας
        </title>
    </head>
    <body>
        <h1 class="page_header">Διαγραφή εργασίας</h1>
        <div class="login_box">
            <form action="" method="post">
                <label id="field" for="date_field">Θέλετε σίγουρα να διαγράψετε την Εργασία <?php echo($homework_id) ?>;</label><br>
                <p></p>
                <input type="submit" id="basic_button" name="submit_button" value="Ναι">
            </form>
            <p class="paragraph_end"></p>
            <p class="paragraph_text">
                <a class="text_link" href="homework.php">Επιστροφή χωρίς διαγραφή</a>
            </p>
        </div>
    </body>
</html>