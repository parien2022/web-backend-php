<?php if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
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
                <h1>Account Update</h1>
                <?php if(isset($accountMessage)){
                    echo $accountMessage;
                } ?>
                <form action="/phpmotors/accounts/" method="post">
                    <fieldset>
                    <label for="clientFirstname" class="formLabel">First name*<input id="clientFirstname" type="text" name="clientFirstname" 
                    value="<?php if(isset($clientFirstname)){echo $clientFirstname;}elseif(isset($_SESSION['clientData']['clientFirstname'])){echo $_SESSION['clientData']['clientFirstname'];}?>" required></label>
                    <label for="clientLastname" class="formLabel">Last name*<input id="clientLastname" type="text" name="clientLastname" 
                    value="<?php if(isset($clientLastname)){echo $clientLastname;}elseif(isset($_SESSION['clientData']['clientLastname'])){echo $_SESSION['clientData']['clientLastname'];}?>" required></label>
                    <label for="clientEmail" class="formLabel">Email*<input id="clientEmail" type="email" name="clientEmail" 
                    value="<?php if(isset($clientEmail)){echo $clientEmail;}elseif(isset($_SESSION['clientData']['clientEmail'])){echo $_SESSION['clientData']['clientEmail'];}?>" required></label>
                    </fieldset>
                    <input class="formButton" type="submit" name="Update Account" value="Update Account">
                    <input id="hidden" type="hidden" name="action" value="updateAccount">
                    <input id="hidden" type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];}?>">
                </form>

                <h1>Change Password</h1>
                <?php if(isset($passMessage)){
                    echo $passMessage;
                } ?>
                <form action="/phpmotors/accounts/" method="post">
                    <fieldset>
                    <label for="clientPassword" class="formLabel">Password*<br><span class="condition">Make sure the password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.<br>This action will change the existing Password.</span>
                    <input id="clientPassword" type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
                    </fieldset>
                    <input class="formButton" type="submit" name="Update password" value="Change Password">
                    <input id="hidden" type="hidden" name="action" value="updatePassword">
                    <input id="hidden" type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];}?>">
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>