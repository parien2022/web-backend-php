<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen">
        <title>PHP Motors</title>
    </head>
    <body>
        <img id="main-background" src="../images/site/small_check.jpg" alt="square background">
        <div class="container">
            <header>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
            </header>
            <nav>
                <!--<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->
                <?php echo $navList; ?>
            </nav>
            <main class="mainClass">
                <h1>Registration</h1>
                <?php
                if (isset($message)){
                    echo $message;
                }
                ?>
                <form action="/phpmotors/accounts/index.php" method="post">
                    <fieldset>
                        <legend>Sign up information</legend>
                        <label for="clientFirstname" class="formLabel">First name*<input id="clientFirstname" type="text" name="clientFirstname" 
                        <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}?> required></label>
                        <label for="clientLastname" class="formLabel">Last name*<input id="clientLastname" type="text" name="clientLastname" 
                        <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>required></label>
                        <label for="clientEmail" class="formLabel">Email*<input id="clientEmail" type="email" name="clientEmail" 
                        <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>required></label>
                        <label for="clientPassword" class="formLabel">Password*<br><span class="condition">Make sure the password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>
                        <input id="clientPassword" type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
                    </fieldset>
                    <input class="formButton" type="submit" name="signInButton" value="Sign up">
                    <input type="hidden" name="action" value="register">
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>