<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./style.css">
        <title>
            Σελίδα πιστοποίησης
        </title>
    </head>

    <body>
        <h1 class="page_header">Σελίδα πιστοποίησης</h1>
        <div class="login_box">
            <form action="login_check.php" method="post">
                <label id="field" for="email_field">E-mail:</label><br>
                <input type="text" id="input_field" name="user_email"><br>
                <label id="field" for="password_field">Password:</label><br>
                <input type="password" id="input_field" name="user_password"><br>
                <input type="submit" id="basic_button" value="Login">
            </form>
        </div>
    </body>
</html>
