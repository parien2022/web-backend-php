<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
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
                <h1>Add Car Classification</h1>
                <?php
                if (isset($message)){
                    echo $message;
                }
                ?>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <label for="classificationName" class="formLabel">Classification Name<br><span class="condition">Make sure the classification name is not longer than 30 characters.</span>
                    <input id="classificationName" type="text" name="classificationName" class="carClassification" 
                    <?php if(isset($classificationName)){echo "value='$classificationName'";}?> pattern="^[a-zA-Z ]{1,30}$" required></label>
                    <input class="formButton" type="submit" name="addCarButton" value="add car">
                    <input type="hidden" name="action" value="addClassification">
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>