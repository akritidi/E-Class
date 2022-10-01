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
    $title = $_POST['document_title'];
    $text = $_POST['document_text'];

    $target_dir = "doc_files/";
    $target_file = $target_dir . basename($_FILES["document_file"]["name"]);
    move_uploaded_file($_FILES["document_file"]["tmp_name"], $target_file);

    $sql = "INSERT INTO documents (title, text, file_directory) VALUES ('$title', '$text', '$target_file');";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ./documents.php?new_document_added");
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
            Νέο έγγραφο
        </title>
    </head>

    <body>
        <h1 class="page_header">Νέο έγγραφο</h1>
        <div class="login_box">
            <form action="" method="post" enctype="multipart/form-data">
                <label id="field" for="title_field">Τίτλος:</label><br>
                <input type="text" id="input_field" name="document_title"><br>
                <label id="field" for="text_field">Περιγραφή:</label><br>
                <input type="text" id="input_field" name="document_text"><br>
                <label id="field" for="file_field">Αρχείο:</label><br>
                <input type="file" id="document_field" name="document_file"><br>
                <input type="submit" id="basic_button" name="submit_button" value="Υποβολή">
            </form>
        </div>
    </body>
</html>