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
    }elseif(isset($invInfo['classificationId']) && $classification['classificationId'] == $invInfo['classificationId']){
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
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
            echo "Modify $invInfo[invMake] $invInfo[invModel]";} elseif (isset($invMake) && isset($invModel)){
                echo "Modify $invMake $invModel";} ?> | PHP Motors</title>
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
            echo "Modify $invInfo[invMake] $invInfo[invModel]";} elseif (isset($invMake) && isset($invModel)){
                echo "Modify $invMake $invModel";} ?></h1>
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
                    <?php if(isset($invMake)){echo "value='$invMake'";}elseif(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";}?> required></label>
                    <label for="invModel" class="formLabel">Model<input id="invModel" type="text" name="invModel" 
                    <?php if(isset($invModel)){echo "value='$invModel'";}elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> required></label>
                    <label for="invDescription" class="formLabel">Description
                    <textarea id="invDescription" type="text" name="invDescription" required><?php if(isset($invDescription)){echo "$invDescription";}elseif(isset($invInfo['invDescription'])){echo $invInfo['invDescription'];}?></textarea></label>
                    <label for="invImage" class="formLabel">Image Path<input id="invImage" type="text" name="invImage" 
                    <?php if(isset($invImage)){echo "value='$invImage'";}elseif(isset($invInfo['invImage'])){echo "value='$invInfo[invImage]'";}?> required></label>
                    <label for="invThumbnail" class="formLabel">Thumbnail Path<input id="invThumbnail" type="text" name="invThumbnail"
                    <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}elseif(isset($invInfo['invThumbnail'])){echo "value='$invInfo[invThumbnail]'";}?> required></label>
                    <label for="invPrice" class="formLabel">Price<input id="invPrice" type="number" name="invPrice"
                    <?php if(isset($invPrice)){echo "value='$invPrice'";}elseif(isset($invInfo['invPrice'])){echo "value='$invInfo[invPrice]'";}?> required></label>
                    <label for="invStock" class="formLabel"># In Stock<input id="invStock" type="number" name="invStock"
                    <?php if(isset($invStock)){echo "value='$invStock'";}elseif(isset($invInfo['invStock'])){echo "value='$invInfo[invStock]'";}?> required></label>
                    <label for="invColor" class="formLabel">Color<input id="invColor" type="text" name="invColor"
                    <?php if(isset($invColor)){echo "value='$invColor'";}elseif(isset($invInfo['invColor'])){echo "value='$invInfo[invColor]'";}?> required></label>
                    <input class="formButton" type="submit" name="submit" value="Update Vehicle">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];}elseif(isset($invId)){echo $invId;} ?>">
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>