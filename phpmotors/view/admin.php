<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen">
        <title>Admin</title>
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
                <h1>
                    <?php if(isset($_SESSION['clientData']['clientFirstname']) && isset($_SESSION['clientData']['clientLastname'])){
                        echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'];
                    } ?>
                </h1>
                <?php if(isset($message)){echo $message;}elseif(isset($_SESSION['message'])){echo $_SESSION['message'];} $_SESSION['message'] = "";?>
                <ul>
                    <li>First name: <?php if(isset($_SESSION['clientData']['clientFirstname'])){echo $_SESSION['clientData']['clientFirstname'];} ?></li>
                    <li>Last name: <?php if(isset($_SESSION['clientData']['clientLastname'])){echo $_SESSION['clientData']['clientLastname'];} ?></li>
                    <li>Email address: <?php if(isset($_SESSION['clientData']['clientEmail'])){echo $_SESSION['clientData']['clientEmail'];} ?></li>
                </ul>
                <?php if($_SESSION['loggedin']){
                    echo "<div class='manageInvDiv'><h3>Account management</h3>";
                    echo "<p>Use this link to update account information:</p>";
                    echo "<p><a href='/phpmotors/accounts/index.php?action=updateClient'>Update account<a/></p></div>";
                } ?>
                <?php if($_SESSION['loggedin'] && $_SESSION['clientData']['clientLevel'] > 1 ){
                    echo "<div class='manageInvDiv'><h3>Inventory management</h3>";
                    echo "<p>Use this link to manage the Inventory:</p>";
                    echo "<p><a href='/phpmotors/vehicles/'>Vehicle inventory management<a/></p></div>";
                } ?>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>