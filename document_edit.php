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

$document_id = $_GET['document'];
$sql = "SELECT title, text, file_directory FROM documents WHERE id = $document_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $title = $row['title'];
      $text = $row['text'];
      $target_directory = $row['file_directory'];
    }
} 

if(isset($_POST['submit_button'])){ 
    $title = $_POST['document_title'];
    $text = $_POST['document_text'];
    
    if($_FILES['document_file']['size'] == 0) {
        // No file was selected for upload
        $new_file = false;
    }else{
        $new_file = true;
    }
    
    if($new_file){
        
        $sql = "SELECT file_directory FROM documents WHERE id = $document_id";
        $result = $conn->query($sql);
        $row = $result -> fetch_assoc();
        $previous_file = $row["file_directory"];
        
        $target_dir = "doc_files/";
        $target_file = $target_dir . basename($_FILES["document_file"]["name"]);
        move_uploaded_file($_FILES["document_file"]["tmp_name"], $target_file);

        $sql = "UPDATE documents SET title='$title', text='$text', file_directory='$target_file'  WHERE id = $document_id";
        $result = $conn->query($sql);

        $sql = "SELECT * FROM documents;";         //Έλεγχος για το εάν υπάρχει και αλλού το αρχείο που αλλάξαμε ώστε να μη διαγραφεί από το φάκελο
        $result = $conn->query($sql);
        
        $useless_file = true;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                if($row['file_directory'] == $previous_file){
                    $useless_file = false;
                }
            }
        }     
        if($useless_file){
            unlink($previous_file);
        }

    }else{
        $sql = "UPDATE documents SET title='$title', text='$text'  WHERE id = $document_id";
        $result = $conn->query($sql);
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ./documents.php?document_edited");
    } else {
        header("Location: ./documents.php");
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
            Επεξεργασία εγγράφου
        </title>
    </head>
    <body>
        <h1 class="page_header">Επεξεργασία εγγράφου</h1>
        <div class="login_box">
            <form action="" method="post" enctype="multipart/form-data">
                <label id="field" for="title_field">Τίτλος:</label><br>
                <input type="text" id="input_field" name="document_title" value="<?php echo($title) ?>"><br>
                <label id="field" for="text_field">Περιγραφή:</label><br>
                <input type="text" id="input_field" name="document_text" value="<?php echo($text) ?>"><br>
                <label id="field" for="file_field">Αρχείο:</label><br>
                <input type="text" id="input_field" name="document_current_file" value="<?php echo($target_directory)?>" readonly><br>
                <label id="field" for="file_field">Επιλογή νέου αρχείου:</label><br>
                <input type="file" id="document_field" name="document_file"><br>
                <input type="submit" id="basic_button" name="submit_button" value="Υποβολή">
            </form>
        </div>
    </body>
</html>