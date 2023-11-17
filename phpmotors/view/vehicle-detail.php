<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen">
        <title><?php if(isset($vehicleDetails['invMake']) && isset($vehicleDetails['invModel'])){echo "$vehicleDetails[invMake] $vehicleDetails[invModel]";} ?> | PHP Motors</title>
    </head>
    <body>
        <img id="main-background" src="../images/site/small_check.jpg" alt="square background">
        <div class="container">
            <header>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
            </header>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main class="mainClass">
                <h1><?php if(isset($vehicleDetails['invMake']) && isset($vehicleDetails['invModel'])){echo "$vehicleDetails[invMake] $vehicleDetails[invModel]";} ?></h1>
                <?php if(isset($message)){echo $message;} ?>
                <?php if(isset($displayVehiclesDetails)){ echo $displayVehiclesDetails;} ?>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>