<?php

require ('db_connect.php');

if(!$_SESSION["login"]){
    header("Location: ./login.php?error=nologin");
    exit();
}

$email='tutor@csd.auth.test.gr';
$subject = 'Tutor auto mail';
$message = 'Send example';

mail($email, $subject, $message);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Επικοινωνία
        </title>
    </head>

    <body>
        <h1 class="page_header">Επικοινωνία</h1>
        <div class="box_1">
            <a class="navigate_link" href="index.php">Αρχική σελίδα</a>
            <a class="navigate_link" href="announcement.php">Ανακοινώσεις</a>
            <a class="navigate_link" href="communication.php">Επικοινωνία</a>
            <a class="navigate_link" href="documents.php">Έγγραφα μαθήματος</a>
            <a class="navigate_link" href="homework.php">Εργασίες</a>
        </div>
        <div class="box_2">
            <h2 class="page_header_2">Αποστολή e-mail μέσω web φόρμας</h2>
            <form class="form_field">
                <label id="field" for="sender_field">Αποστολέας:</label><br>
                <input type="text" id="input_field" name="sender_field" value="<πεδίο για την δν/ση του αποστολέα>"><br>
                <label id="field" for="subject_field">Θέμα:</label><br>
                <input type="text" id="input_field" name="subject_field" value="<πεδίο για το θέμα>"><br>
                <label id="field" for="text_field">Κείμενο:</label><br>
                <input type="text" id="input_field" name="text_field" value="<πεδίο για το κείμενο>"><br>
            </form>
            <p class="paragraph_end"></p>
            <h2 class="page_header_2">Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
            <p class="paragraph_text">
                Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου:
              <a class="text_link" href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a>
            </p>
            <form method="POST" action="">
            <p>
            <label id="field" for="email">Πατήστε "Αποστολή" για να σταλεί αυτόματα το μήνυμα στους διδάσκοντες:</label>
            </p>
            <input type="submit" id="basic_button" value="Αποστολή" />
            </form>
        </div>

    </body>
</html>