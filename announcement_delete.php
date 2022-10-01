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

$announcement_id = $_GET['announcement'];

if(isset($_POST['submit_button'])){ 

    $sql = "DELETE FROM announcement WHERE id = $announcement_id";
    
    if ($conn->query($sql) === TRUE) {
        $sql = "SET @num := 0;";
        $result = $conn->query($sql);

        $sql = "UPDATE announcement SET id = @num := (@num+1);";
        $result = $conn->query($sql);

        $sql = "ALTER TABLE announcement AUTO_INCREMENT = 1;";
        $result = $conn->query($sql);                            

        header("Location: ./announcement.php?announcement_deleted");
    } else {
        header("Location: ./announcement.php");
    }

$conn->close();
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Διαγραφή ανακοίνωσης
        </title>
    </head>
    <body>
        <h1 class="page_header">Διαγραφή ανακοίνωσης</h1>
        <div class="login_box">
            <form action="" method="post">
                <label id="field" for="date_field">Θέλετε σίγουρα να διαγράψετε την Ανακοίνωση <?php echo($announcement_id) ?>;</label><br>
                <p></p>
                <input type="submit" id="basic_button" name="submit_button" value="Ναι">
            </form>
            <p class="paragraph_end"></p>
            <p class="paragraph_text">
                <a class="text_link" href="announcement.php">Επιστροφή χωρίς διαγραφή</a>
            </p>
        </div>
    </body>
</html>