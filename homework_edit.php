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
$sql = "SELECT goals, task_directory, deliverable, date FROM homework WHERE id = $homework_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $goals = $row['goals'];
      $target_directory = $row['task_directory'];
      $deliverable = $row['deliverable'];
      $date = $row['date'];
    }
} 

if(isset($_POST['submit_button'])){ 
    $goals = $_POST['homework_goals'];
    $deliverable = $_POST['homework_deliverable'];
    $date = $_POST['homework_date'];

    if($_FILES['homework_task']['size'] == 0) {
        // No file was selected for upload
        $new_file = false;
    }else{
        $new_file = true;
    }
    
    if($new_file){
        
        $sql = "SELECT task_directory FROM homework WHERE id = $homework_id";
        $result = $conn->query($sql);
        $row = $result -> fetch_assoc();
        $previous_file = $row["task_directory"];
        
        $target_dir = "doc_tasks/";
        $target_file = $target_dir . basename($_FILES["homework_task"]["name"]);
        move_uploaded_file($_FILES["homework_task"]["tmp_name"], $target_file);

        $sql = "UPDATE homework SET goals='$goals', task_directory='$target_file', deliverable='$deliverable', date='$date'  WHERE id = $homework_id";
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

    }else{
        $sql = "UPDATE homework SET goals='$goals', deliverable='$deliverable', date='$date'  WHERE id = $homework_id";
        $result = $conn->query($sql);
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ./homework.php?homework_edited");
    } else {
        header("Location: ./homework.php");
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
            Επεξεργασία εργασίας
        </title>
    </head>
    <body>
        <h1 class="page_header">Επεξεργασία εργασίας</h1>
        <div class="login_box">
            <form action="" method="post" enctype="multipart/form-data">
                <label id="field" for="title_field">Στόχοι:</label><br>
                <input type="text" id="input_field" name="homework_goals" value="<?php echo($goals) ?>"><br>
                <label id="field" for="file_field">Αρχείο εκφώνησης:</label><br>
                <input type="text" id="input_field" name="homework_current_task" value="<?php echo($target_directory)?>" readonly><br>
                <label id="field" for="file_field">Επιλογή νέου αρχείου:</label><br>
                <input type="file" id="homework_field" name="homework_task"><br>
                <label id="field" for="text_field">Περιγραφή:</label><br>
                <input type="text" id="input_field" name="homework_deliverable" value="<?php echo($deliverable) ?>"><br>
                <label id="field" for="date_field">Ημερομηνία παράδοσης:</label><br>
                <input type="date" id="input_field" name="homework_date" value="<?php echo($date) ?>"><br>
                <input type="submit" id="basic_button" name="submit_button" value="Υποβολή">
            </form>
        </div>
    </body>
</html>