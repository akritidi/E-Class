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

if(isset($_POST['submit_button'])){ 

    $sql = "SELECT file_directory FROM documents WHERE id = $document_id";
    $result = $conn->query($sql);
    $row = $result -> fetch_assoc();
    $previous_file = $row["file_directory"];

    $sql = "DELETE FROM documents WHERE id = $document_id";
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
    
    $sql = "SET @num := 0;";
    $result = $conn->query($sql);

    $sql = "UPDATE documents SET id = @num := (@num+1);";
    $result = $conn->query($sql);

    $sql = "ALTER TABLE documents AUTO_INCREMENT = 1;";
    $result = $conn->query($sql);      

    header("Location: ./documents.php?document_deleted");

    $conn->close();
} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Διαγραφή εγγράφου
        </title>
    </head>
    <body>
        <h1 class="page_header">Διαγραφή εγγράφου</h1>
        <div class="login_box">
            <form action="" method="post">
                <label id="field" for="date_field">Θέλετε σίγουρα να διαγράψετε το Έγγραφο <?php echo($document_id) ?>;</label><br>
                <p></p>
                <input type="submit" id="basic_button" name="submit_button" value="Ναι">
            </form>
            <p class="paragraph_end"></p>
            <p class="paragraph_text">
                <a class="text_link" href="documents.php">Επιστροφή χωρίς διαγραφή</a>
            </p>
        </div>
    </body>
</html>