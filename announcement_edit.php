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
$sql = "SELECT date, subject, text FROM announcement WHERE id = $announcement_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $date = $row['date'];
      $subject = $row['subject'];
      $text = $row['text'];
    }
}

if(isset($_POST['submit_button'])){ 
    $date = $_POST['announcement_date'];
    $subject = $_POST['announcement_subject'];
    $text = $_POST['announcement_text'];

    $sql = "UPDATE announcement SET date='$date', subject='$subject', text='$text' WHERE id = $announcement_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ./announcement.php?announcement_edited");
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
            Επεξεργασία ανακοίνωσης
        </title>
    </head>
    <body>
        <h1 class="page_header">Επεξεργασία ανακοίνωσης</h1>
        <div class="login_box">
            <form action="" method="post">
                <label id="field" for="date_field">Ημερομηνία:</label><br>
                <input type="date" id="input_field" name="announcement_date" value="<?php echo($date) ?>"><br>
                <label id="field" for="subject_field">Θέμα:</label><br>
                <input type="text" id="input_field" name="announcement_subject" value="<?php echo($subject) ?>"><br>
                <label id="field" for="text_field">Κείμενο:</label><br>
                <input type="text" id="input_field" name="announcement_text" value="<?php echo($text) ?>"><br>
                <input type="submit" id="basic_button" name="submit_button" value="Υποβολή">
            </form>
        </div>
    </body>
</html>