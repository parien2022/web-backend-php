<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
    header('Location: /phpmotors/');
    exit;
}
?>
<?php
$classificationList = "<select name='classificationId' class='selectOptions'>";
$classificationList .= "<option value='' disabled selected>Choose car classification</option>";
foreach ($classifications as $classification){
    $classificationList .= "<option value=".urlencode($classification['classificationId'])."";
    if (isset($classificationId) && $classification['classificationId'] == $classificationId){
        $classificationList .= " selected";
    }
    $classificationList .= ">".urlencode($classification['classificationName'])."";
    $classificationList .= "</option>";
}
$classificationList .= "</select>";
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
                <h1>Add Vehicle</h1>
                <?php
                if (isset($message)){
                    echo $message;
                }
                ?>
                <h2>*Note all fields are required</h2>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <?php 
                    echo $classificationList; 
                    ?>
                    <label for="invMake" class="formLabel">Make<input id="invMake" type="text" name="invMake" 
                    <?php if(isset($invMake)){echo "value='$invMake'";}?> required></label>
                    <label for="invModel" class="formLabel">Model<input id="invModel" type="text" name="invModel" 
                    <?php if(isset($invModel)){echo "value='$invModel'";}?> required></label>
                    <label for="invDescription" class="formLabel">Description<textarea id="invDescription" type="text" name="invDescription" required><?php if(isset($invDescription)){echo "$invDescription";}?></textarea></label>
                    <label for="invImage" class="formLabel">Image Path<input id="invImage" type="text" name="invImage" 
                    <?php if(isset($invImage)){echo "value='$invImage'";}else{echo "value='/images/no-image.png'";}?> required></label>
                    <label for="invThumbnail" class="formLabel">Thumbnail Path<input id="invThumbnail" type="text" name="invThumbnail"
                    <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}else{echo "value='/images/no-image.png'";}?> required></label>
                    <label for="invPrice" class="formLabel">Price<input id="invPrice" type="number" name="invPrice" step="0.01" pattern="\d+(\.\d{1,2})?"
                    <?php if(isset($invPrice)){echo "value='$invPrice'";}?> required></label>
                    <label for="invColor" class="formLabel">Color<input id="invColor" type="text" name="invColor"
                    <?php if(isset($invColor)){echo "value='$invColor'";}?> required></label>
                    <input class="formButton" type="submit" name="addVehicleButton" value="Add Vehicle">
                    <input type="hidden" name="action" value="addVehicle">
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>