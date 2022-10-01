<?php

require ('db_connect.php');

if(!$_SESSION["login"]){
    header("Location: ./login.php?error=nologin");
    exit();
}
if($_SESSION["tutor"]){
    $show_flag=true;
}else{
    $show_flag=false;
}

$sql = "SELECT * FROM announcement;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Ανακοινώσεις
        </title>
    </head>

    <body>
        <h1 class="page_header">Ανακοινώσεις</h1>
        <div class="box_1">
            <a class="navigate_link" href="index.php">Αρχική σελίδα</a>
            <a class="navigate_link" href="announcement.php">Ανακοινώσεις</a>
            <a class="navigate_link" href="communication.php">Επικοινωνία</a>
            <a class="navigate_link" href="documents.php">Έγγραφα μαθήματος</a>
            <a class="navigate_link" href="homework.php">Εργασίες</a>
        </div>
        <div class="box_2">
            <a class="text_link" href="announcement_add.php"<?php if ($show_flag==false){?>style="display:none"<?php } ?>><h3>Προσθήκη νέας ανακοίνωσης</h3><p class="paragraph_end"></p></a>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                        <h2 class="page_header_2">Ανακοίνωση <?php echo $row['id']?></h2>
                        <p class="paragraph_header">
                            Ημερομηνία: 
                        </p>
                        <p class="paragraph_text">
                            <?php echo $row['date']?>
                        </p>
                        <p class="paragraph_header">
                            Θέμα: 
                        </p>
                        <p class="paragraph_text">
                            <?php echo $row['subject']?> 
                        </p>
                        <p class="paragraph_header">
                            Κείμενο: 
                        </p>
                        <p class="paragraph_text">
                            <?php echo $row['text']?> 
                        </p>
                        <?php $announcement_id = $row['id'] ?>
                        <a class="text_link" href="announcement_edit.php?announcement=<?php echo $announcement_id ?>"<?php if ($show_flag==false){?>style="display:none"<?php } ?>>[Επεξεργασία]</a>
                        <a class="text_link" href="announcement_delete.php?announcement=<?php echo $announcement_id ?>"<?php if ($show_flag==false){?>style="display:none"<?php } ?>>[Διαγραφή]</a>
                        <p class="paragraph_end"></p>
                    <?php }
                }            
            ?>
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <script>
            var mybutton = document.getElementById("myBtn");
            window.onscroll = function() {scrollFunction()};
            function scrollFunction() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
              } else {
                mybutton.style.display = "none";
              }
            }
            function topFunction() {
              document.body.scrollTop = 0;
              document.documentElement.scrollTop = 0;
            }
        </script>
    </body>
</html>