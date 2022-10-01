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
    $goals = $_POST['homework_goals'];
    $deliverable = $_POST['homework_deliverable'];
    $date = $_POST['homework_date'];

    $target_dir = "doc_tasks/";
    $target_file = $target_dir . basename($_FILES["homework_task"]["name"]);
    move_uploaded_file($_FILES["homework_task"]["tmp_name"], $target_file);

    $sql = "INSERT INTO homework (goals, task_directory, deliverable, date) VALUES ('$goals', '$target_file', '$deliverable', '$date');";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM homework;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $max_homework_id = $row['id'];
        }
    } 

    $date = date("Y-m-d") ;
    $subject = "Υποβλήθηκε η εργασία " . $max_homework_id ;
    $text = "Η ημερομηνία παράδοσης της εργασίας είναι " . $_POST['homework_date'];

    $sql = "INSERT INTO announcement (date, subject, text) VALUES ('$date', '$subject', '$text');";
    $result = $conn->query($sql);
    
    header("Location: ./homework.php?new_homework_added");

    $conn->close();
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Νέα Εργασία
        </title>
    </head>

    <body>
        <h1 class="page_header">Νέα Εργασία</h1>
        <div class="login_box">
            <form action="" method="post" enctype="multipart/form-data">
                <label id="field" for="title_field">Στόχοι:</label><br>
                <input type="text" id="input_field" name="homework_goals"><br>
                <label id="field" for="text_field">Εκφώνηση:</label><br>
                <input type="file" id="document_field" name="homework_task"><br>
                <label id="field" for="file_field">Παραδοτέα:</label><br>
                <input type="text" id="input_field" name="homework_deliverable"><br>
                <label id="field" for="date_field">Ημερομηνία παράδοσης:</label><br>
                <input type="date" id="input_field" name="homework_date"><br>
                <input type="submit" id="basic_button" name="submit_button" value="Υποβολή">
            </form>
        </div>
    </body>
</html>