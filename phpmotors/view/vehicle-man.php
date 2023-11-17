<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /phpmotors/');
    exit;
}
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
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
                <h1>Vehicles management</h1>
                <ul>
                    <li><a href='../vehicles/index.php?action=classification'>Add Classification</a></li>
                    <li><a href='../vehicles/index.php?action=vehicle'>Add Vehicle</a></li>
                </ul>

                <?php if(isset($message)){
                    echo $message;
                }
                if(isset($classificationList)){
                    echo '<h2>Vehicles By Classification</h2>';
                    echo '<p>Choose a classification to see those vehicles</p>';
                    echo $classificationList;
                }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>

                <table id="inventoryDisplay">

                </table>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
        <script src="/phpmotors/js/inventory.js"></script>
    </body>
</html><?php unset($_SESSION['message']); ?>