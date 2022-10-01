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
if(isset($_POST['submit_button'])){ 
    $date = $_POST['announcement_date'];
    $subject = $_POST['announcement_subject'];
    $text = $_POST['announcement_text'];

    $sql = "INSERT INTO announcement (date, subject, text) VALUES ('$date', '$subject', '$text');";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ./announcement.php?new_announcement_added");
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
            Νέα ανακοίνωση
        </title>
    </head>

    <body>
        <h1 class="page_header">Νέα ανακοίνωση</h1>
        <div class="login_box">
            <form action="" method="post">
                <label id="field" for="date_field">Ημερομηνία:</label><br>
                <input type="date" id="input_field" name="announcement_date"><br>
                <label id="field" for="subject_field">Θέμα:</label><br>
                <input type="text" id="input_field" name="announcement_subject"><br>
                <label id="field" for="text_field">Κείμενο:</label><br>
                <input type="text" id="input_field" name="announcement_text"><br>
                <input type="submit" id="basic_button" name="submit_button" value="Υποβολή">
            </form>
        </div>
    </body>
</html>