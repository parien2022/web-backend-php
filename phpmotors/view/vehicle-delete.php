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
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} elseif (isset($invMake) && isset($invModel)){
                echo "Delete $invMake $invModel";} ?> | PHP Motors</title>
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
                <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} elseif (isset($invMake) && isset($invModel)){
                echo "Delete $invMake $invModel";} ?></h1>
                <?php
                if (isset($message)){
                    echo $message;
                }
                ?>
                <h2>*Note all fields are required</h2>
                <p>Confirm Vehicle Deletion. The delete is permanent.</p>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <label for="invMake" class="formLabel">Make<input id="invMake" type="text" name="invMake" readonly
                    <?php if(isset($invMake)){echo "value='$invMake'";}elseif(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";}?>></label>
                    <label for="invModel" class="formLabel">Model<input id="invModel" type="text" name="invModel" readonly
                    <?php if(isset($invModel)){echo "value='$invModel'";}elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>> </label>
                    <label for="invDescription" class="formLabel">Description
                    <textarea id="invDescription" type="text" name="invDescription" readonly><?php if(isset($invDescription)){echo "$invDescription";}elseif(isset($invInfo['invDescription'])){echo $invInfo['invDescription'];}?></textarea></label>
                    <input class="formButton" type="submit" name="submit" value="Delete Vehicle">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];}elseif(isset($invId)){echo $invId;}?>">
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>