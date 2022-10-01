<?php

require ('db_connect.php');

if(!$_SESSION["login"]){
    header("Location: ./login.php?error=nologin");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Αρχική σελίδα
        </title>
    </head>

    <body>
        <h1 class="page_header">Αρχική σελίδα</h1>
        <div class="box_1">
            <a class="navigate_link" href="index.php">Αρχική σελίδα</a>
            <a class="navigate_link" href="announcement.php">Ανακοινώσεις</a>
            <a class="navigate_link" href="communication.php">Επικοινωνία</a>
            <a class="navigate_link" href="documents.php">Έγγραφα μαθήματος</a>
            <a class="navigate_link" href="homework.php">Εργασίες</a>
        </div>
        <div class="box_2">
            <p class="paragraph_text">
                Σας καλωσορίζουμε στο μάθημα των Εφαρμοσμένων Μαθηματικών και σας ευχόμαστε καλή επιτυχία!
            </p>
            <p class="paragraph_text">
                Στόχος του είναι να εισάγει του φοιτητές του Τμήματος σε θέματα Μαθηματικών απαραίτητα για τη μελέτη και κατανόηση των ιδιοτήτων των υλικών.
                Τα θέματα αυτά, τα οποία αποτελούν και τις τέσσερις βασικές ενότητες του μαθήματος, είναι η Μιγαδική Ανάλυση, η Γραμμική Άλγεβρα, η Ανάλυση Fourier και οι Πιθανότητες.
            </p>    
            <p class="paragraph_text">
                Τα περιεχόμενα σε κάθε μία από τις σελίδες του μαθήματος είναι τα παρακάτω.
            </p>
            <p class="paragraph_text">
                • Ανακοινώσεις: Στη συγκεκριμένη ιστοσελίδα περιέχονται ανακοινώσεις σχετικές με το μάθημα.
            </p>
            <p class="paragraph_text">
                • Επικοινωνία: Στη συγκεκριμένη ιστοσελίδα παρέχονται δυνατότητες για την επικοινωνία με τον καθηγητή.
            </p>
            <p class="paragraph_text">
                • Έγγραφα μαθήματος: Στη συγκεκριμένη ιστοσελίδα περιέχονται έγγραφα σχετικά με το μάθημα τα οποία μπορούν να κατεβάσουν οι φοιτητές. 
            </p>
            <p class="paragraph_text">
                • Εργασίες: Στη συγκεκριμένη ιστοσελίδα περιέχονται εκφωνήσεις εργασιών που μπορούν να κατεβάσουν οι φοιτητές.
            </p>
            <img class="image_box" src="images/learning.jpg" alt="Image of learning">
        </div>
    </body>
</html>